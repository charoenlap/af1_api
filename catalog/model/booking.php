<?php 
	class BookingModel extends db {
		public function insertBooking($data=array()){
			$result = array();
			$date_now = date('Y-m-d');
			$time_now = date('H:i:s');
			$merge_date = $date_now.' '.$time_now;
			$data_insert_booking = array(
				'status' 		=> 'pending',
				'customer_id' 	=> '1000',
				'customer_key'	=> 'BS000001',
				'customer_name'	=> 'Brightstar warehouse',
				'address'		=> 'Unit A&B,16/F,Gemstar Tower,23 Man Lok Street',
				'district'		=> '',
				'province'		=> 'Hung Hom',
				'postcode'		=> '',
				'person'		=> '',
				'cod'			=> '0',
				'express'		=> '0',
				'car_id'		=> '1',
				'get_datetime'	=> $merge_date,
				'msg_key'		=> '',
				'msg_name'		=> '',
				'cs_key'		=> '',
				'cs_name'		=> '',
				'note'			=> '',
				'created_at'	=> $merge_date,
				'updated_at'	=> $merge_date,
				'signature'		=> '',
				'file'			=> '',
				'comment'		=> '',
			);
			$booking_id = $this->insert('bookings',$data_insert_booking);
			$booking_key = get_booking_key($booking_id);
			$data_update_booking_key = array(
				'key'			=> $booking_key
			);
			$result_booking_update = $this->update('bookings',$data_update_booking_key,"id='".$booking_id."'");
			$data_insert_connote = array(
				'key'					=> $booking_key,
				'booking_id'			=> $booking_id,
				'status'				=> 'pending',
				'shipper_name'			=> 'BrightStar',
				'shipper_company'		=> 'Brightstar warehouse',
				'shipper_address'		=> 'Unit A&B,16/F,Gemstar Tower,23 Man Lok Street',
				'shipper_phone'			=> '852 2980 8080',
				'consignee_name'		=> '',
				'consignee_company'		=> '',
				'consignee_address'		=> '',
				'consignee_phone'		=> '',
				'consignee_district'	=> '',
				'consignee_province'	=> '',
				'consignee_postcode'	=> '',
				'customer_ref'			=> '',
				'service'				=> '',
				'cod'					=> '',
				'express'				=> '',
				'cod_value'				=> '',
				'details'				=> '',
				'created_at'			=> $date_now,
				'updated_at'			=> $time_now,
				'deleted_at'			=> '',
				'points_id'				=> '',
				'customers_id'			=> '',
				'comment'				=> '',
				'AccountType'			=> $data['AccountType'],
				'AccountNumber'			=> $data['AccountNumber'],
				'BillToAccountNumber'	=> $data['BillToAccountNumber'],
				'NumberOfPieces'		=> $data['NumberOfPieces'],
				'Weight'				=> $data['Weight'],
				'WeightUnit'			=> $data['WeightUnit'],
				'GlobalProductCode'		=> $data['GlobalProductCode'],
				'LocalProductCode'		=> $data['LocalProductCode'],
				'DoorTo'				=> $data['DoorTo'],
				'DimensionUnit'			=> $data['DimensionUnit'],
				'Pieces'				=> count($data['Pieces']),		
			);
			$connote_id = $this->insert('connotes',$data_insert_connote);
			$connote_arr_id = array();
			if( is_array($data['Pieces']) ){
				foreach($data['Pieces'] as $val){
					$data_insert_connote_detail = array(
						'connote_id' => $connote_id,
						'Weight'	=> $val['Weight'],
						'Width'		=> $val['Width'],
						'Height'	=> $val['Height']
					);
					$connote_arr_id[] = $this->insert('connotes_detail',$data_insert_connote_detail);
				}
			}
			$result = array(
				'Status' 				=> 'success',
				'BookingKey'			=> $booking_key,
				'booking_date'			=> $date_now,
				'bookingTime'			=> $time_now,
				'booking_detail' 		=> array(
					'AccountType'			=> $data['AccountType'],
					'AccountNumber'			=> $data['AccountNumber'],
					'BillToAccountNumber'	=> $data['BillToAccountNumber'],
					'NumberOfPieces'		=> $data['NumberOfPieces'],
					'Weight'				=> $data['Weight'],
					'WeightUnit'			=> $data['WeightUnit'],
					'GlobalProductCode'		=> $data['GlobalProductCode'],
					'LocalProductCode'		=> $data['LocalProductCode'],
					'DoorTo'				=> $data['DoorTo'],
					'DimensionUnit'			=> $data['DimensionUnit'],
				),
				'connotes'				=> $connote_arr_id
			);
			return $result;
		}
	}
?>