
	<form action="http://brightstar.af1express.com/index.php?route=home" method="POST">
		<textarea name="testtext" id="" cols="300" rows="10" style="width:100%;"><?xml version="1.0"?>
			<req:BookPURequest xsi:schemaLocation="http://www.dhl.com book-pickup-global-req.xsd" schemaVersion="3.0" xmlns:req="http://www.dhl.com" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
				  <Request>
				    <ServiceHeader>
				      <MessageTime>2020-05-26T05:25:27.103+05:30</MessageTime>
				      <MessageReference>3678b1663dd14229a47ccdedfe61f29f</MessageReference>
				      <SiteID>brightstar</SiteID>
				      <Password>B!ightstar!</Password>
				    </ServiceHeader>
				    <MetaData>
				      <SoftwareName>XMLPI</SoftwareName>
				      <SoftwareVersion>3.0</SoftwareVersion>
				    </MetaData>
				  </Request>
				  <Requestor>
				    <AccountType>D</AccountType>
				    <AccountNumber>963720405</AccountNumber>
				    <RequestorContact>
				      <PersonName>R300 HK</PersonName>
				      <Phone>8888888888</Phone>
				    </RequestorContact>
				    <CompanyName>Apple Store apm Hong Kong</CompanyName>
				    <Address1>418 Kwun Tong Road</Address1>
				    <City>Kwun Tong</City>
				    <CountryCode>HK</CountryCode>
				  </Requestor>
				  <Place>
				    <LocationType>B</LocationType>
				    <CompanyName>Apple Store apm Hong Kong</CompanyName>
				    <Address1>418 Kwun Tong Road</Address1>
				    <PackageLocation>Reception</PackageLocation>
				    <City>Kwun Tong</City>
				    <CountryCode>HK</CountryCode>
				  </Place>
				  <Pickup>
				    <PickupDate>2020-05-27</PickupDate>
				    <PickupTypeCode>A</PickupTypeCode>
				    <ReadyByTime>15:00</ReadyByTime>
				    <CloseTime>17:30</CloseTime>
				    <Pieces>1</Pieces>
				    <weight>
				      <Weight>6</Weight>
				      <WeightUnit>K</WeightUnit>
				    </weight>
				  </Pickup>
				  <PickupContact>
				    <PersonName>Brightstar warehouse</PersonName>
				    <Phone>852 2980 8080</Phone>
				  </PickupContact>
				  <ShipmentDetails>
				    <AccountType>D</AccountType>
				    <AccountNumber>963720405</AccountNumber>
				    <BillToAccountNumber>963720405</BillToAccountNumber>
				    <NumberOfPieces>1</NumberOfPieces>
				    <Weight>6</Weight>
				    <WeightUnit>K</WeightUnit>
				    <GlobalProductCode>N</GlobalProductCode>
				    <LocalProductCode>N</LocalProductCode>
				    <DoorTo>DD</DoorTo>
				    <DimensionUnit>C</DimensionUnit>
				    <Pieces>
				      <Piece>
				        <Weight>6</Weight>
				        <Width>47</Width>
				        <Height>25</Height>
				      </Piece>
				    </Pieces>
				  </ShipmentDetails>
				  <ConsigneeDetails>
				    <CompanyName>Brightstar</CompanyName>
				    <AddressLine>Unit A&amp;B,16/F,Gemstar Tower,23 Man Lok Street</AddressLine>
				    <City>Hung Hom</City>
				    <CountryCode>HK</CountryCode>
				    <Contact>
				      <PersonName>Brightstar warehouse</PersonName>
				      <Phone>852 2980 8080</Phone>
				    </Contact>
				  </ConsigneeDetails>
				</req:BookPURequest>
		</textarea>
		<br>
		<input type="submit">
		<textarea name="" id="" cols="300" rows="10" style="width:100%;"><?php echo $result;?></textarea>
		<input type="hidden" name="route" value="home">
	</form>