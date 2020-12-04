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
						<th>id_log_booking</th>
						<th>file_name</th>
						<th>file_date_create</th>
						<th>Request_ServiceHeader_MessageTime</th>
						<th>Request_ServiceHeader_MessageReference</th>
						<th>Request_ServiceHeader_SiteID</th>
						<th>Request_ServiceHeader_Password</th>
						<th>Request_MetaData_SoftwareName</th>
						<th>Request_MetaData_SoftwareVersion</th>
						<th>Requestor_AccountType</th>
						<th>Requestor_AccountNumber</th>
						<th>Requestor_PersonName</th>
						<th>Requestor_Phone</th>
						<th>Requestor_CompanyName</th>
						<th>Requestor_Address1</th>
						<th>Requestor_City</th>
						<th>Requestor_CountryCode</th>
						<th>Place_LocationType</th>
						<th>Place_CompanyName</th>
						<th>Place_Address1</th>
						<th>Place_PackageLocation</th>
						<th>Place_City</th>
						<th>Place_CountryCode</th>
						<th>Pickup_PickupDate</th>
						<th>Pickup_PickupTypeCode</th>
						<th>Pickup_ReadyByTime</th>
						<th>Pickup_CloseTime</th>
						<th>Pickup_Pieces</th>
						<th>PickupContact_PersonName</th>
						<th>PickupContact_Phone</th>
						<th>ShipmentDetails_AccountType</th>
						<th>ShipmentDetails_AccountNumber</th>
						<th>ShipmentDetails_BillToAccountNumber</th>
						<th>ShipmentDetails_NumberOfPieces</th>
						<th>ShipmentDetails_Weight</th>
						<th>ShipmentDetails_WeightUnit</th>
						<th>ShipmentDetails_GlobalProductCode</th>
						<th>ShipmentDetails_LocalProductCode</th>
						<th>ShipmentDetails_DoorTo</th>
						<th>ShipmentDetails_DimensionUnit</th>
						<th>ConsigneeDetails_CompanyName</th>
						<th>ConsigneeDetails_AddressLine</th>
						<th>ConsigneeDetails_City</th>
						<th>ConsigneeDetails_CountryCode</th>
						<th>ConsigneeDetails_PersonName</th>
						<th>ConsigneeDetails_Phone</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($log_booking['data'] as $val){ ?> 
					<tr>
						<td><input type="checkbox"></td>
						<td><?php echo $val['id_log_booking'];?></td>
						<td><?php echo $val['file_name'];?></td>
						<td><?php echo $val['file_date_create'];?></td>
						<td><?php echo $val['Request_ServiceHeader_MessageTime'];?></td>
						<td><?php echo $val['Request_ServiceHeader_MessageReference'];?></td>
						<td><?php echo $val['Request_ServiceHeader_SiteID'];?></td>
						<td><?php echo $val['Request_ServiceHeader_Password'];?></td>
						<td><?php echo $val['Request_MetaData_SoftwareName'];?></td>
						<td><?php echo $val['Request_MetaData_SoftwareVersion'];?></td>
						<td><?php echo $val['Requestor_AccountType'];?></td>
						<td><?php echo $val['Requestor_AccountNumber'];?></td>
						<td><?php echo $val['Requestor_PersonName'];?></td>
						<td><?php echo $val['Requestor_Phone'];?></td>
						<td><?php echo $val['Requestor_CompanyName'];?></td>
						<td><?php echo $val['Requestor_Address1'];?></td>
						<td><?php echo $val['Requestor_City'];?></td>
						<td><?php echo $val['Requestor_CountryCode'];?></td>
						<td><?php echo $val['Place_LocationType'];?></td>
						<td><?php echo $val['Place_CompanyName'];?></td>
						<td><?php echo $val['Place_Address1'];?></td>
						<td><?php echo $val['Place_PackageLocation'];?></td>
						<td><?php echo $val['Place_City'];?></td>
						<td><?php echo $val['Place_CountryCode'];?></td>
						<td><?php echo $val['Pickup_PickupDate'];?></td>
						<td><?php echo $val['Pickup_PickupTypeCode'];?></td>
						<td><?php echo $val['Pickup_ReadyByTime'];?></td>
						<td><?php echo $val['Pickup_CloseTime'];?></td>
						<td><?php echo $val['Pickup_Pieces'];?></td>
						<td><?php echo $val['PickupContact_PersonName'];?></td>
						<td><?php echo $val['PickupContact_Phone'];?></td>
						<td><?php echo $val['ShipmentDetails_AccountType'];?></td>
						<td><?php echo $val['ShipmentDetails_AccountNumber'];?></td>
						<td><?php echo $val['ShipmentDetails_BillToAccountNumber'];?></td>
						<td><?php echo $val['ShipmentDetails_NumberOfPieces'];?></td>
						<td><?php echo $val['ShipmentDetails_Weight'];?></td>
						<td><?php echo $val['ShipmentDetails_WeightUnit'];?></td>
						<td><?php echo $val['ShipmentDetails_GlobalProductCode'];?></td>
						<td><?php echo $val['ShipmentDetails_LocalProductCode'];?></td>
						<td><?php echo $val['ShipmentDetails_DoorTo'];?></td>
						<td><?php echo $val['ShipmentDetails_DimensionUnit'];?></td>
						<td><?php echo $val['ConsigneeDetails_CompanyName'];?></td>
						<td><?php echo $val['ConsigneeDetails_AddressLine'];?></td>
						<td><?php echo $val['ConsigneeDetails_City'];?></td>
						<td><?php echo $val['ConsigneeDetails_CountryCode'];?></td>
						<td><?php echo $val['ConsigneeDetails_PersonName'];?></td>
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