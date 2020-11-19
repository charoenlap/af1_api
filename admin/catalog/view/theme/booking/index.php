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
						<th>file_name</th>
						<th>file_date_create</th>
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
					<tr>
						<td><input type="checkbox"></td>
						<td>1605683322_booking</td>
						<td>2020-11-18 14:08:42</td>
						<td>D</td>
						<td>963720405</td>
						<td>R300 HK</td>
						<td>8888888888</td>
						<td>Apple Store apm Hong Kong</td>
						<td>418 Kwun Tong Road</td>
						<td>Kwun Tong</td>
						<td>HK</td>
						<td>B</td>
						<td>Apple Store apm Hong Kong</td>
						<td>418 Kwun Tong Road</td>
						<td>Reception</td>
						<td>Kwun Tong</td>
						<td>HK</td>
						<td>2020-05-27</td>
						<td>A</td>
						<td>15:00</td>
						<td>17:30</td>
						<td>1</td>
						<td>Brightstar warehouse</td>
						<td>852 2980 8080</td>
						<td>D</td>
						<td>963720405</td>
						<td>963720405</td>
						<td>1</td>
						<td>6</td>
						<td>K</td>
						<td>N</td>
						<td>N</td>
						<td>DD</td>
						<td>C</td>
						<td>Brightstar</td>
						<td>Unit A&B,16/F,Gemstar Tower,23 Man Lok Street</td>
						<td>Hung Hom</td>
						<td>HK</td>
						<td>Brightstar warehouse</td>
						<td>852 2980 8080</td>
					</tr>
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