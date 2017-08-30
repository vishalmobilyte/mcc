<div class="timeline">
	<?php 
	if(!empty($trackingRecords[0]['order_tracking'])){
	
	
		$j=1;
		foreach($trackingRecords[0]['order_tracking'] as $trackingDet){
			if($j%2==0){
				$class="even";	
			}else{
				$class="odd";
			}
			$columnStatus = '';
			if($trackingDet['status']==4 || in_array($trackingDet['third_party_status'],array("DL","Delivered"))){
				$columnStatus = 'track_process_completed';
			}else if($trackingDet['status']==3){
				$columnStatus = 'track_underprocess';
			}
	?>	
	<div class="timeline-item <?= $columnStatus; ?>">
		<div class="timeline-badge">
			<div class="timeline-icon">
				<i class="fa fa-truck"></i>
			</div>
		</div>
		<div class="timeline-body">
			<div class="timeline-body-arrow"> </div>
			<div class="timeline-body-head">
				<div class="timeline-body-head-caption">
					<span href="javascript:;" class="timeline-body-title font-blue-madison">
						<?php echo (!empty($trackingDet['tracking_description']))?$trackingDet['tracking_description']:"---"; ?>
					</span>
					<!--<span class="timeline-body-time font-grey-cascade">-->
				</div>
			</div>
			<div class="timeline-body-content">
				<span class="font-grey-cascade">
				<?php if($authUser['role'] != 5){ ?>
				by <?php
					echo !empty($trackingDet['user']['name'])?ucwords($trackingDet['user']['name'])." (".$trackingDet['user']['phone'].")":"";
					?>
				<?php } ?>	
				</span>
				
				<span class="font-grey-cascade">
					on <?php
						echo !empty($trackingDet['created'])?(date('M jS, Y', strtotime($trackingDet['created']))):"";
						?>
				</span>
				
				<span class="font-grey-cascade">
					<br><?php echo (!empty($trackingDet['city']))?$trackingDet['city']." -":""; ?> <?php echo (!empty($trackingDet['zip']))?$trackingDet['zip'].", ":""; ?><?php echo (!empty($trackingDet['state']))?$trackingDet['state'].", ":""; ?>  <?php echo (!empty($trackingDet['country']))?$trackingDet['country']:""; ?>
				</span>
			</div>
		</div>
	</div>
	
	<?php 
		$j++;
		}
	 }else{
	 ?>
	 <div class="timeline-item">
		<div class="timeline-badge">
			<div class="timeline-icon">
				<i class="fa fa-coffee"></i>
			</div>
		</div>	
		<div class="timeline-body">
			<div class="timeline-body-arrow"> </div>
			<div class="timeline-body-head">
				<div class="timeline-body-head-caption">
					<h3>Shipment not started yet.</h3>
				</div>
			</div>		
		</div>		
	</div>		
	 <?php		
	 }
	 ?>
</div>
