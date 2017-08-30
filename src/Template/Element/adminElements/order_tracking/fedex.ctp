<div class="portlet-title">
	<h4> Shipment travel history</h4>
	<hr>
		<div class="tools"></div>
	</div>
	<p class="margin-top-15">All shipment travel activity is displayed in local time for location</p>
	<div class="table-scrollable">
		<table class="table table-striped table-bordered  dt-responsive dataTable no-footer dtr-column collapsed" role="grid" aria-describedby="sample_2_info" style="width: 100%;" width="100%">
			<thead>
				<tr role="row">
					<th class="control sorting_disabled " rowspan="1" colspan="1" aria-label="">Date/Time</th>
					<th class="control sorting_disabled  " rowspan="1" colspan="1" aria-label="">Location</th>
					<th class="all sorting_disabled" tabindex="0" aria-controls="sample_2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="">Details</th>
				</tr>
				
			</thead>
			<tbody>
				
				<?php 
					//pr($trackingRecords[0]['tracking_records']->CompletedTrackDetails->TrackDetails->Notification->Severity); die;
					$j=1;
					//foreach($trackingRecords[0]['tracking_records']->CompletedTrackDetails->TrackDetails as $trackingDet){
						if($j%2==0){
							$class="even";	
						}else{
							$class="odd";
						}
				?>
					<tr role="row" class="<?=@$class;?>">
						<td>
							<?php
							echo !empty($trackingRecords[0]['tracking_records']->CompletedTrackDetails->TrackDetails->Notification->Severity)?$trackingRecords[0]['tracking_records']->CompletedTrackDetails->TrackDetails->Notification->Severity:"";
							?>
						</td>
						<td>
							<?php
							echo !empty($trackingRecords[0]['tracking_records']->CompletedTrackDetails->TrackDetails->Notification->Severity)?$trackingRecords[0]['tracking_records']->CompletedTrackDetails->TrackDetails->Notification->Severity:"";
							?>
						</td>
						<td>
							<?php echo (!empty($trackingRecords[0]['tracking_records']->CompletedTrackDetails->TrackDetails->Notification->Message))?$trackingRecords[0]['tracking_records']->CompletedTrackDetails->TrackDetails->Notification->Message:"---"; ?>
						</td>
						
					</tr>
					
				<?php 
					//$j++;
					//}
				 ?>
			</tbody>
		</table>
	</div>
</div>
