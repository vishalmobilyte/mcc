<?php
// src/Controller/UsersController.php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\Network\Email\Email;
use Cake\Core\Configure;

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;

use Cake\Validation\Validation;

require_once(ROOT . DS  . 'vendor' . DS  . 'FedEx' . DS . 'TrackService'. DS . 'Track.php');
use Track;

class TracksController extends AppController
{
 
    public function beforeFilter(Event $event){
		
        parent::beforeFilter($event);
         $this->Auth->allow(['index','trackOrder','trackPackage','fedexTracking','yrcTracking','estesTracking','upsTracking','dhlTracking','completedOrderStatus']);
         $this->viewBuilder()->layout('guest');
    }
    
    public function index(){   
       
    }
    
	function trackOrder(){
	
		$this->loadModel('OrderAssignmentLogs');
		$this->loadModel('OrderTracking');
		$this->loadModel('Orders');
		$descartes_app_id = isset($this->request->data['descartes_id'])?$this->request->data['descartes_id']:'';
		if(!empty($descartes_app_id)){
			
			$orderQuery = $this->Orders->find('all')->where(['Orders.descrates_app_id' => $descartes_app_id])->contain(['OrderPackages']); 		
			
			if($orderQuery->count() <= 0){
				$this->Flash->error('Kindly provide valid tracking number.');
				return $this->redirect(['action' => 'index']);
			}
			$orderData = $orderQuery->first();
		
		}else{
			$this->Flash->error('Please provide tracking number.');
			return $this->redirect(['action' => 'index']);
		}
		
		$this->set('orderData', @$orderData);
	}
	
	function trackPackage($order_id=null,$package_id=null){
		
		$this->loadModel('OrderAssignmentLogs');
		$this->loadModel('OrderTracking');
		$this->loadModel('Orders');
		
		$orderID = convert_uudecode(base64_decode($order_id));
		$pkg_id = convert_uudecode(base64_decode($package_id));
		
		if(!empty($orderID) || !empty($pkg_id)){
			$orderData = $this->Orders->find('all')->where(['Orders.id' => $orderID])->contain(['OrderPackages'])->first();
			//CHECK ORDER IS ASSIGNED OR NOT
			$assignData = $this->OrderAssignmentLogs->find('all')
							   ->where(['OrderAssignmentLogs.order_id' => $orderID,'OrderAssignmentLogs.package_id' => $pkg_id,'OrderAssignmentLogs.status IN' => [2,3]])
							    ->contain(['ShippingCarriers']);
			
			if($assignData->count() <=0){
				
				$msg = 'Order not assigned yet. you can view the tacking once order get assigned to agent/driver';
			
			}else{
				
				$orderAssignmentData = $assignData->first();
				$trackingBy = $orderAssignmentData->shipment_type;
				
				if(strtolower($orderAssignmentData->shipment_type)=='driver'){
					
					//GET DIRECT TRACKING WHICH IS DONE BY SCANNING THE LABELS
					$trackingRecords = $this->Orders->find('all')
									   ->where(['Orders.id' => $orderID,'Orders.status IN' => [2,3]])
									   ->contain(['OrderTracking'=> function($q) use($pkg_id) {
																return $q->where(['package_id'=>$pkg_id])
																->order(['OrderTracking.id' =>'DESC']);
															},'OrderPackages'=> function($q) use($pkg_id) {
																return $q->where(['id'=>$pkg_id]);
															}])
									   ->hydrate(false)
									   ->toArray();
				}else{
					$trackingRecords = $this->Orders->find('all')
									   ->where(['Orders.id' => $orderID,'Orders.status IN' => [2,3]])
									    ->contain(['OrderTracking'=> function($q) use($pkg_id) {
																return $q->where(['package_id'=>$pkg_id])
																->order(['OrderTracking.id' =>'DESC']);
															},'OrderPackages'=> function($q) use($pkg_id) {
																return $q->where(['id'=>$pkg_id]);
															}])
									   ->hydrate(false)
									   ->toArray();
								   
					$third_party_data = $orderAssignmentData->shipping_carrier;
					$yrcDetails = array('order_id'=>$orderID,
										'pkg_id'=>$pkg_id,
										'user_id'=>$orderAssignmentData->assign_to,
										'tracking_number'=>$orderAssignmentData->tracking_number
								  );
								  
					switch ($orderAssignmentData->shipping_carrier->carrier_name) {
							case 'fedex':
								
								$this->fedexTracking($yrcDetails);
								break;
								
							case 'yrc':
								
								$this->yrcTracking($yrcDetails);
								break;		
					
							case 'estes':
								$this->estesTracking($yrcDetails);
								break;
								
							case 'ups':
								$this->upsTracking();
								break;
								
							case 'dhl':
								$this->dhlTracking();
								break;
					}
				}
				
			}
			
		}else{
			$msg = 'Please provide order id and package id.';
		}
		
		///echo "<pre>"; print_r($trackingRecords); die;
		$this->set('orderData', @$orderData);
		$this->set('trackingBy', @$trackingBy);
		$this->set('trackingBy', @$trackingBy);
		$this->set('descrates_app_id', @$orderData->descrates_app_id);
		$this->set('trackingRecords', @$trackingRecords);
	}
	
	function fedexTracking($fedExDetails=array()){
		
		$tracking = new \Track(FEDEX_ACCESS_KEY, FEDEX_PASSWORD, FEDEX_ACCOUNT_NUMBER, FEDEX_METER_NUMBER);
		
		try{
			$shipment = $tracking->getByTrackingId($fedExDetails['tracking_number']);
				
			
		}catch (Exception $e){
			$shipment=array();
		}
		
		//echo "<pre>"; print_r($shipment->CompletedTrackDetails->TrackDetails->Events); die;
		//return $shipment;
		if(!empty($shipment->CompletedTrackDetails->TrackDetails->Events)){
			
			foreach($shipment->CompletedTrackDetails->TrackDetails->Events as $eventData){
				$order_tracking_rec = $this->OrderTracking->find('all')
													  ->where(['OrderTracking.package_id'=>$fedExDetails['pkg_id'],
															   'OrderTracking.user_id'=>$fedExDetails['user_id'],
															   'OrderTracking.order_id'=>$fedExDetails['order_id'],'OrderTracking.third_party_status'=>$eventData->EventType])
													  ->count();
					if($order_tracking_rec <=0){
							$orderScannedData = $this->OrderTracking->newEntity();
							$orderScannedData = $this->OrderTracking->patchEntity($orderScannedData, $this->request->data);
							
							$orderScannedData->order_id = $fedExDetails['order_id'];
							$orderScannedData->user_id = $fedExDetails['user_id'];
							$orderScannedData->package_id = $fedExDetails['pkg_id'];
							
							$orderScannedData->location = $eventData->Address->City." ".@$eventData->Address->StateOrProvinceCode." ".$eventData->Address->CountryName;
							
							$orderScannedData->third_party_status = $eventData->EventType;
							$orderScannedData->third_party_status_date = ($eventData->Timestamp !='')?date("Y-m-d", strtotime($eventData->Timestamp)):'';
							$orderScannedData->tracking_description = $eventData->EventDescription;
							$this->OrderTracking->save($orderScannedData);
							
							if($eventData->EventType=='DL'){
								$this->completedOrderStatus($fedExDetails['order_id'],$fedExDetails['pkg_id'],$fedExDetails['user_id']);
							}
					}	
			
			
			}
		}
		
	}
	
	function yrcTracking($yrcDetails=array()){
		
		$ch = curl_init();
		$url = 'http://my.yrc.com/myyrc-api/national/servlet?CONTROLLER=com.rdwy.ec.rextracking.http.controller.PublicTrailerHistoryAPIController&xml=Y&PRONumber='.$yrcDetails['tracking_number'];
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_VERBOSE, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		$result_xml = curl_exec($ch);
		$result_xml = str_replace(array(':','-'), '', $result_xml);
		$result = @simplexml_load_string($result_xml);
		
	
		//CHECK SUCCESS RESPONSE
		if($result->SHIPMENT->returnMessage=='SUCCESS'){
			
			$yrc_status_array = array(
				'Delivered'=>'Delivered',
				'SPOT'=>'Spotted at Consignee',
				'OFD'=>'Out for Delivery',
				'LDD'=>'Loaded for Delivery',
				'ENR'=>'Shipment enroute to next destination',
				'LDG'=>'Shipment is loading at this terminal',
				'CLS'=>'Shipment’s trailer was closed at this terminal and is ready to move to next point',
				'ONH'=>'Shipment is on-hand at this  terminal',
				'OHD'=>'Shipment is on-hand at the destination terminal',
				'UNL'=>'Shipment is un-loaded and on hand at this terminal location ',
				'OFL'=>'Trailer or Container to carrier at city, state',
				'Tendered ICMX'=>'Internal code marking Shipment is destined to Mexico',
				'FBO'=>'Shipment is picked up and at this terminal',
				'Unloaded'=>'The shipment has been unloaded at the given location',
				'Loaded'=>'This shipment has been loaded onto a trailer'
				
			);
			
			$order_tracking_rec = $this->OrderTracking->find('all')
													  ->where(['OrderTracking.package_id'=>$yrcDetails['pkg_id'],
															   'OrderTracking.user_id'=>$yrcDetails['user_id'],
															   'OrderTracking.order_id'=>$yrcDetails['order_id'],'OrderTracking.third_party_status'=>$result->SHIPMENT->currentStatusCode])
													  ->count();
			if($order_tracking_rec <=0){
				
				$orderScannedData = $this->OrderTracking->newEntity();
				$orderScannedData = $this->OrderTracking->patchEntity($orderScannedData, $this->request->data);
				
				$orderScannedData->order_id = $yrcDetails['order_id'];
				$orderScannedData->user_id = $yrcDetails['user_id'];
				$orderScannedData->package_id = $yrcDetails['pkg_id'];
				$orderScannedData->third_party_status = $result->SHIPMENT->currentStatusCode;
				$orderScannedData->location = $result->SHIPMENT->currentStatusMessage;
				$orderScannedData->third_party_status_date = ($result->SHIPMENT->currentStatusDate !='')?date("Y-m-d", strtotime($result->SHIPMENT->currentStatusDate)):'';
				$orderScannedData->tracking_description = $yrc_status_array[$result->SHIPMENT->currentStatusCode]." ".$result->SHIPMENT->currentStatusMessage;
				$this->OrderTracking->save($orderScannedData);
				if($result->SHIPMENT->currentStatusCode=='Delivered'){
					$this->completedOrderStatus($yrcDetails['order_id'],$yrcDetails['pkg_id'],$yrcDetails['user_id']);
				}
			}
			
		}
	}	
		
	function estesTracking($estesDetails=array()){
				
        $soapUrl = "http://www.estes-express.com/shipmenttracking/services/ShipmentTrackingService?wsdl"; // asmx URL of WSDL

        $xml_post_string = '<?xml version="1.0" encoding="utf-8"?>
                            <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ship="http://ws.estesexpress.com/shipmenttracking" xmlns:ship1="http://ws.estesexpress.com/schema/2012/12/shipmenttracking">
                                <soapenv:Header>
                                <ship:auth>
                                <ship:user>Sky2c1</ship:user>
                                <ship:password>sky2c1</ship:password>
                                </ship:auth>
                                </soapenv:Header>
                                <soapenv:Body>
                                <ship1:search>
                                <ship1:requestID>2013-01-21.1643</ship1:requestID>
                                <ship1:pro>'.$estesDetails['tracking_number'].'</ship1:pro>
                                </ship1:search>
                                </soapenv:Body>
                                </soapenv:Envelope>';   // data from the form, e.g. some ID number

           $headers = array(
                        "Content-type: text/xml;charset=\"utf-8\"",
                        "Accept: text/xml",
                        "Cache-Control: no-cache",
                        "Pragma: no-cache",
                        "SOAPAction: http://tracmedia.org/InTheLife", 
                        "Content-length: ".strlen($xml_post_string),
                    ); //SOAPAction: your op URL
                    
	    // PHP cURL  for https connection with auth
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_URL, $soapUrl);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		//curl_setopt($ch, CURLOPT_USERPWD, $soapUser.":".$soapPassword); // username and password - declared at the top of the doc
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_post_string); // the SOAP request
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		// converting
		$response = curl_exec($ch); 
		curl_close($ch);

		$soap_response = $response;

		$plainXML = $this->parse_xml_into_array($soap_response);
		$estesresponse = json_decode(json_encode(SimpleXML_Load_String($plainXML, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
		
		// FUNCTION TO MUNG THE XML SO WE DO NOT HAVE TO DEAL WITH NAMESPACE
		if(!empty($estesresponse['soapenv_Body']['ship_trackingInfo']['ship_shipments']['ship_shipment'])){
			
		
			$org_status = $estesresponse['soapenv_Body']['ship_trackingInfo']['ship_shipments']['ship_shipment']['ship_status'];
			$ship_status_1 = str_replace(",","",$org_status);
			$ship_status = str_replace(" ","_ ",$ship_status_1);
			
			if(trim($org_status)=='Delivered'){
				$delivery_date = $estesresponse['soapenv_Body']['ship_trackingInfo']['ship_shipments']['ship_shipment']['ship_deliveryDate'];
				$message = "Order ".$ship_status_1;
			}else{
				$delivery_date = $estesresponse['soapenv_Body']['ship_trackingInfo']['ship_shipments']['ship_shipment']['ship_estimatedDeliveryDate'];
				$message = "Order reached at ".$ship_status_1;
			}
			 
			$location = @$estesresponse['soapenv_Body']['ship_trackingInfo']['ship_shipments']['ship_shipment']['ship_destinationTerminal']['ship_address']['ship_line1']." ".@$estesresponse['soapenv_Body']['ship_trackingInfo']['ship_shipments']['ship_shipment']['ship_destinationTerminal']['ship_name'];
			
			$this->loadModel('OrderTracking');
			$order_tracking_rec = $this->OrderTracking->find('all')
													  ->where(['OrderTracking.package_id'=>$estesDetails['pkg_id'],
															   'OrderTracking.user_id'=>$estesDetails['user_id'],
															   'OrderTracking.order_id'=>$estesDetails['order_id'],'OrderTracking.third_party_status'=>$ship_status])
													  ->count();
			if($order_tracking_rec <=0){
				
				$orderScannedData = $this->OrderTracking->newEntity();
				$orderScannedData = $this->OrderTracking->patchEntity($orderScannedData, $this->request->data);
				
				$orderScannedData->order_id = $estesDetails['order_id'];
				$orderScannedData->user_id = $estesDetails['user_id'];
				$orderScannedData->package_id = $estesDetails['pkg_id'];
				$orderScannedData->location = $location;
				$orderScannedData->third_party_status = $ship_status;
				$orderScannedData->third_party_status_date = ($delivery_date !='')?date("Y-m-d", strtotime($delivery_date)):'';
				$orderScannedData->tracking_description = $message;
				$this->OrderTracking->save($orderScannedData);
				if($ship_status=='Delivered'){
					$this->completedOrderStatus($estesDetails['order_id'],$estesDetails['pkg_id'],$estesDetails['user_id']);
				}
			}
		}
		
	  
	}
		
	/*function for use dhl tracking info from dhl API*/
	function upsTracking($upsDetails=array()){
		
		$data ="<?xml version=\"1.0\"?>
			<AccessRequest xml:lang='en-US'>
				<AccessLicenseNumber>".UPS_ACCESS_CODE."</AccessLicenseNumber>
				<UserId>".UPS_USER_ID."</UserId>
				<Password>".UPS_PWD."</Password>
			</AccessRequest>
			<?xml version=\"1.0\"?>
				<TrackRequest>
					<Request>
						<TransactionReference>
							<CustomerContext>
								<InternalKey>".$upsDetails['tracking_number']."</InternalKey>
							</CustomerContext>
							<XpciVersion>1.0</XpciVersion>
						</TransactionReference>
						<RequestAction>Track</RequestAction>
					</Request>
					<TrackingNumber>".$upsDetails['tracking_number']."</TrackingNumber>
				</TrackRequest>";
					
		$ch = curl_init("https://www.ups.com/ups.app/xml/Track");
		curl_setopt($ch, CURLOPT_HEADER, 1);
		curl_setopt($ch,CURLOPT_POST,1);
		curl_setopt($ch,CURLOPT_TIMEOUT, 60);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
		$result=curl_exec ($ch);

		$data = strstr($result, '<?');
		$xml_parser = xml_parser_create();
		xml_parse_into_struct($xml_parser, $data, $vals, $index);
		xml_parser_free($xml_parser);
		$params = array();
		$level = array();
		
		foreach ($vals as $xml_elem) {
			
			if ($xml_elem['type'] == 'open') {
				
				if (array_key_exists('attributes',$xml_elem)) {
					
					list($level[$xml_elem['level']],$extra) = array_values($xml_elem['attributes']);
				
				}else{
					
					$level[$xml_elem['level']] = $xml_elem['tag'];
				}
			
			}
			
			if ($xml_elem['type'] == 'complete') {
			
				$start_level = 1;
				$php_stmt = '$params';
				while($start_level < $xml_elem['level']) {
					
					$php_stmt .= '[$level['.$start_level.']]';
					$start_level++;
				}
				
				$php_stmt .= '[$xml_elem[\'tag\']] = $xml_elem[\'value\'];';
				eval($php_stmt);
			}
		}
		
		curl_close($ch);
		return $params;		
	
	}
	
	function dhlTracking($trackingNumber='7070000000'){
		
		$data  = '<?xml version="1.0" encoding="ISO-8859-1" ?>';
		$data .= '<data appname="nol-public" password="anfang" request="get-status-for-public-user" language-code="de">';
		$data .= '  <data piece-code="'.$trackingnumber.'"></data>';
		$data .= '</data>';
	 
		// URL bauen und File hohlen
		$xml = simplexml_load_file(sprintf(
			'http://nolp.dhl.de/nextt-online-public/direct/nexttjlibpublicservlet?xml=%s', $data
		));
	 
		// FALSE, wenn Syntax oder HTTP Error
		if ($xml === false) return false;
	 
		// Wandelt das SimpleXML Objekt in ein Array um
		foreach ($xml->data->data->attributes() as $key => $value) {
			$return[$key] = (string) $value;
		}
		
		
	}
	
	function completedOrderStatus($order_id,$package_id,$user_id){
		
		$this->loadModel('Orders');
		$this->loadModel('OrderPackages');
		$this->loadModel('OrderTracking');
		$this->loadModel('OrderAssignments');
		$this->loadModel('OrderAssignmentLogs');
		$this->loadModel('UserLogs');
		$OrderAssignmentLogsQuery =  $this->OrderAssignmentLogs->query();
									
		//UPDATE ORDER ASSIGNMENT LOG TABLE STATUS
		if($OrderAssignmentLogsQuery->update()
						->set(['status'=>3])
						->where(['order_id' => $order_id,'package_id' => $package_id,'assign_to' => $user_id])->execute()){
							
			//GET ORDER ASSIGNMENT ID			
			$OrderAssignmentLogsData = $this->OrderAssignmentLogs->find('all')->where(['OrderAssignmentLogs.order_id' => $order_id,'OrderAssignmentLogs.package_id' =>  $package_id,'OrderAssignmentLogs.assign_to' => $user_id])->hydrate(false)->first();	
			
			$order_assignment_id = $OrderAssignmentLogsData['order_assignment_id'];
			
			//UPDATE ORDER ASSIGNMENT TABLE 
			$OrderAssignmentsQuery =  $this->OrderAssignments->query();
			if($OrderAssignmentsQuery->update()
						->set(['status_to'=>3,'status_by'=>3])
						->where(['id' => $order_assignment_id])
						->execute()){
				
				$OrderPackagesQuery =  $this->OrderPackages->query();
				if($OrderPackagesQuery->update()
						->set(['status'=>3])
						->where(['id' =>  $package_id])
						->execute()){
							
					//GET All Packages Status of orders		
					$OrderPackagesCount = $this->OrderPackages->find('all')->where(['OrderPackages.order_id' => $order_id,'OrderPackages.status IN' => ['1','2']])->count();	
					if($OrderPackagesCount<=0){
						$OrdersQuery =  $this->Orders->query();
						$OrdersQuery->update()
											->set(['status'=>3])
											->where(['id' =>  $order_id])
											->execute();
					}
				}//End Update  package status
			
			}//End Update Order assignment status
							
		}//End Update Order assignment log status
	}
	
	
}
?>
