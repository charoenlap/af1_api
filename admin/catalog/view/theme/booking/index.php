<div class="row">
	<div class="col-12">
		<h1>Booking</h1>
	</div>
	<div class="col-12">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="#">Home</a></li>
				<li class="breadcrumb-item active" aria-current="page">Booking</li>
			</ol>
		</nav>
	</div>
	<div class="col-12 text-right mb-3">
		<a href="<?php echo route('booking/create');?>" class="btn btn-primary">Create Booking</a>
	</div>
	<div class="col-12">
		<div class="table-responsive">
			<table class="table table-bordered table-striped w-100">
				<thead>
					<tr>
						<th><input type="checkbox" id="select_all"></th>
						<?php foreach($log_booking['columns'] as $val){ ?> 
						<th><?php echo $val;?></th>
						<?php } ?>
					</tr>
				</thead>
				<tbody>
					<?php foreach($log_booking['data'] as $val){ ?> 
					<tr>
						<td><input type="checkbox"></td>
						<td><?php echo $val['ShipmentDetails_NumberOfPieces'];?></td>
						<td><?php echo $val['file_name'];?></td>
						<td><?php echo $val['file_date_create'];?></td>
						<td><?php echo $val['ShipmentDetails_AccountType'];?></td>
						<td><?php echo $val['ShipmentDetails_BillToAccountNumber'];?></td>
						<td><?php echo $val['Requestor_PersonName'];?></td>
						<td><?php echo $val['Requestor_Phone'];?></td>
						<td><?php echo $val['Place_CompanyName'];?></td>
						<td><?php echo $val['Place_Address1'];?></td>
						<td><?php echo $val['Place_City'];?></td>
						<td><?php echo $val['ConsigneeDetails_CountryCode'];?></td>
						<td><?php echo $val['Place_LocationType'];?></td>
						<td><?php echo $val['Place_PackageLocation'];?></td>
						<td><?php echo $val['Pickup_PickupDate'];?></td>
						<td><?php echo $val['Pickup_PickupTypeCode'];?></td>
						<td><?php echo $val['Pickup_ReadyByTime'];?></td>
						<td><?php echo $val['Pickup_CloseTime'];?></td>
						<td><?php echo $val['PickupContact_PersonName'];?></td>
						<td><?php echo $val['PickupContact_Phone'];?></td>
						<td><?php echo $val['ShipmentDetails_Weight'];?></td>
						<td><?php echo $val['ShipmentDetails_WeightUnit'];?></td>
						<td><?php echo $val['ShipmentDetails_LocalProductCode'];?></td>
						<td><?php echo $val['ShipmentDetails_DoorTo'];?></td>
						<td><?php echo $val['ShipmentDetails_DimensionUnit'];?></td>
						<td><?php echo $val['ConsigneeDetails_CompanyName'];?></td>
						<td><?php echo $val['ConsigneeDetails_AddressLine'];?></td>
						<td><?php echo $val['ConsigneeDetails_City'];?></td>
						<td><?php echo $val['ConsigneeDetails_Phone'];?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$('#select_all').click(function(event) {
			if(this.checked) {
			      $(':checkbox').each(function() {
			          this.checked = true;
			      });
			  }
			  else {
			    $(':checkbox').each(function() {
			          this.checked = false;
			      });
			  }
		});
	});
</script>