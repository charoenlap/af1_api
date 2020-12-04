<div class="row">
	<div class="col-12">
		<h1>Connote</h1>
	</div>
	<div class="col-12">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="#">Home</a></li>
				<li class="breadcrumb-item active" aria-current="page">Connote</li>
			</ol>
		</nav>
	</div>
	<div class="col-12 text-right mb-3">
		<a href="<?php echo route('connote/create');?>" class="btn btn-primary">Create Connote</a>
	</div>
	<div class="col-12">
		<div class="table-responsive">
			<table class="table table-bordered table-striped w-100">
				<thead>
					<tr>
						<th><input type="checkbox" id="select_all"></th>
						<th>id_log_connote</th>
						<th>file_name</th>
						<th>file_date_create</th>
						<th>Request_ServiceHeader_MessageTime</th>
						<th>Request_ServiceHeader_MessageReference</th>
						<th>Request_ServiceHeader_SiteID</th>
						<th>Request_ServiceHeader_Password</th>
						<th>Request_MetaData_SoftwareName</th>
						<th>Request_MetaData_SoftwareVersion</th>
						<th>LanguageCode</th>
						<th>PiecesEnabled</th>
						<th>Billing_ShipperAccountNumber</th>
						<th>Billing_ShippingPaymentType</th>
						<th>Billing_BillingAccountNumber</th>
						<th>Consignee_CompanyName</th>
						<th>Consignee_AddressLine</th>
						<th>Consignee_City</th>
						<th>Consignee_PostalCode</th>
						<th>Consignee_CountryCode</th>
						<th>Consignee_CountryName</th>
						<th>Consignee_Contact_PersonName</th>
						<th>Consignee_Contact_PhoneNumber</th>
						<th>ShipmentDetails_NumberOfPieces</th>
						<th>ShipmentDetails_PieceID</th>
						<th>ShipmentDetails_PackageType</th>
						<th>ShipmentDetails_Weight</th>
						<th>ShipmentDetails_DimWeight</th>
						<th>ShipmentDetails_Width</th>
						<th>ShipmentDetails_Height</th>
						<th>ShipmentDetails_Depth</th>
						<th>ShipmentDetails_Weight_2</th>
						<th>ShipmentDetails_WeightUnit</th>
						<th>ShipmentDetails_GlobalProductCode</th>
						<th>ShipmentDetails_LocalProductCode</th>
						<th>ShipmentDetails_Date</th>
						<th>ShipmentDetails_Contents</th>
						<th>ShipmentDetails_DoorTo</th>
						<th>ShipmentDetails_DimensionUnit</th>
						<th>ShipmentDetails_PackageType_2</th>
						<th>ShipmentDetails_CurrencyCode</th>
						<th>Shipper_ShipperID</th>
						<th>Shipper_CompanyName</th>
						<th>Shipper_AddressLine</th>
						<th>Shipper_AddressLine2</th>
						<th>Shipper_City</th>
						<th>Shipper_PostalCode</th>
						<th>Shipper_CountryName</th>
						<th>Shipper_contact_PersonName</th>
						<th>Shipper_contact_PhoneNumber</th>
						<th>Place_ResidenceOrBusiness</th>
						<th>Place_CompanyName</th>
						<th>Place_AddressLine</th>
						<th>Place_City</th>
						<th>Place_CountryCode</th>
						<th>LabelImageFormat</th>
						<th>RequestArchiveDoc</th>
						<th>Label_LabelTemplate</th>
						<th>Label_Logo</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($log_connote['data'] as $val){ ?> 
					<tr>
						<td><input type="checkbox"></td>
						<td><?php echo $val['id_log_connote'];?></td>
						<td><?php echo $val['file_name'];?></td>
						<td><?php echo $val['file_date_create'];?></td>
						<td><?php echo $val['Request_ServiceHeader_MessageTime'];?></td>
						<td><?php echo $val['Request_ServiceHeader_MessageReference'];?></td>
						<td><?php echo $val['Request_ServiceHeader_SiteID'];?></td>
						<td><?php echo $val['Request_ServiceHeader_Password'];?></td>
						<td><?php echo $val['Request_MetaData_SoftwareName'];?></td>
						<td><?php echo $val['Request_MetaData_SoftwareVersion'];?></td>
						<td><?php echo $val['LanguageCode'];?></td>
						<td><?php echo $val['PiecesEnabled'];?></td>
						<td><?php echo $val['Billing_ShipperAccountNumber'];?></td>
						<td><?php echo $val['Billing_ShippingPaymentType'];?></td>
						<td><?php echo $val['Billing_BillingAccountNumber'];?></td>
						<td><?php echo $val['Consignee_CompanyName'];?></td>
						<td><?php echo $val['Consignee_AddressLine'];?></td>
						<td><?php echo $val['Consignee_City'];?></td>
						<td><?php echo $val['Consignee_PostalCode'];?></td>
						<td><?php echo $val['Consignee_CountryCode'];?></td>
						<td><?php echo $val['Consignee_CountryName'];?></td>
						<td><?php echo $val['Consignee_Contact_PersonName'];?></td>
						<td><?php echo $val['Consignee_Contact_PhoneNumber'];?></td>
						<td><?php echo $val['ShipmentDetails_NumberOfPieces'];?></td>
						<td><?php echo $val['ShipmentDetails_PieceID'];?></td>
						<td><?php echo $val['ShipmentDetails_PackageType'];?></td>
						<td><?php echo $val['ShipmentDetails_Weight'];?></td>
						<td><?php echo $val['ShipmentDetails_DimWeight'];?></td>
						<td><?php echo $val['ShipmentDetails_Width'];?></td>
						<td><?php echo $val['ShipmentDetails_Height'];?></td>
						<td><?php echo $val['ShipmentDetails_Depth'];?></td>
						<td><?php echo $val['ShipmentDetails_Weight_2'];?></td>
						<td><?php echo $val['ShipmentDetails_WeightUnit'];?></td>
						<td><?php echo $val['ShipmentDetails_GlobalProductCode'];?></td>
						<td><?php echo $val['ShipmentDetails_LocalProductCode'];?></td>
						<td><?php echo $val['ShipmentDetails_Date'];?></td>
						<td><?php echo $val['ShipmentDetails_Contents'];?></td>
						<td><?php echo $val['ShipmentDetails_DoorTo'];?></td>
						<td><?php echo $val['ShipmentDetails_DimensionUnit'];?></td>
						<td><?php echo $val['ShipmentDetails_PackageType_2'];?></td>
						<td><?php echo $val['ShipmentDetails_CurrencyCode'];?></td>
						<td><?php echo $val['Shipper_ShipperID'];?></td>
						<td><?php echo $val['Shipper_CompanyName'];?></td>
						<td><?php echo $val['Shipper_AddressLine'];?></td>
						<td><?php echo $val['Shipper_AddressLine2'];?></td>
						<td><?php echo $val['Shipper_City'];?></td>
						<td><?php echo $val['Shipper_PostalCode'];?></td>
						<td><?php echo $val['Shipper_CountryName'];?></td>
						<td><?php echo $val['Shipper_contact_PersonName'];?></td>
						<td><?php echo $val['Shipper_contact_PhoneNumber'];?></td>
						<td><?php echo $val['Place_ResidenceOrBusiness'];?></td>
						<td><?php echo $val['Place_CompanyName'];?></td>
						<td><?php echo $val['Place_AddressLine'];?></td>
						<td><?php echo $val['Place_City'];?></td>
						<td><?php echo $val['Place_CountryCode'];?></td>
						<td><?php echo $val['LabelImageFormat'];?></td>
						<td><?php echo $val['RequestArchiveDoc'];?></td>
						<td><?php echo $val['Label_LabelTemplate'];?></td>
						<td><?php echo $val['Label_Logo'];?></td>
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