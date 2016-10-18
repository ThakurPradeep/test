<?php   

 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once('/var/www/html/spencer/app/Mage.php'); //Path to Magento
	umask(0);
	Mage::app();
   
	class Masterhub{
		
	  //print_r($_REQUEST);exit;

		public function sendMailToUser($readData,$user){

			$body ='<html><body>';
			$body .= '<h1>Hi '.$readData['rider_name'].',</h1>';
			$body .= '<p style="font-size:18px;">Thanks for registering at our site</p>';
			$body .= '<p style="font-size:18px;">You can find your credentials below :</p>';
			$body .= '<p style="font-size:18px;">User Name :'.$readData['email_id'].'</p>';
			$body .= '<p style="font-size:18px;">User Name :'.$readData['user_id'].'</p>';
			$body .= '<p style="font-size:18px;">Password  :'.$readData['password'].'</p>';
			$body .= '</body></html>';

			$storeName = Mage::app()->getStore($readData['rider_storeid'])->getName();
			
			$subject = $user.'registration confirmation mail';
			$emailTemplate = Mage::getModel('core/email');
			$emailTemplate->setFromName($storeName);
			$emailTemplate->setBody($body);
			$emailTemplate->setSubject($subject);
			$emailTemplate->setType('html');
			$emailTemplate->setToEmail($readData['email_id']);
			$emailTemplate->send();
			header("location:userlist.php");
		}

		public function readConnection(){
		   $resource =  Mage::getSingleton('core/resource');
           $readConnection = $resource->getConnection('core_read');
          return $readConnection;
		}
    
        public function writeConnection(){
		   $resource =  Mage::getSingleton('core/resource');
           $writeConnection = $resource->getConnection('core_write');
           return $writeConnection;
         }

		public function onChangeStoreData($post){
		  $cond   = '';
		  $cond   .= (!empty($post[storeid]))  ? "store_id=".$post[storeid] : 1;  
		  $selQry =  "SELECT *FROM `rider_masterhub` WHERE  $cond ";     
          $collections = $this->readConnection()->fetchAll($selQry);  
          $html    ='';
			$html .='<table width="100%" border="1" style="0px #cccccc">';
			$html .='<tr>';
            $html .='<th>S.No</th>';
            $html .='<th>Rider Name</th>';
            $html .='<th>IMEI No.</th>';            
            $html .='<th>Email Id</th>';
            $html .='<th>Store Name</th>';
            $html .='<th>Created At</th>';
            $html .='<th>Action</th>';
            $html .='<th>Status</th>';            
			$html .='</tr>';
           if($collections) {
				$colNo = 1; 
				
      foreach ($collections as $col) {
		     $status   = $col['status']=='1' ? 'Active' : 'Inactive';
             $storeName = $_storeName = Mage::app()->getStore($col['store_id'])->getName();
		     $html .="<tr>";
			 $html .="<td>".$colNo."</td>";
			 $html .="<td>".$col[master_name]."</td>";
			 $html .="<td>".$col[imei_no]."</td>";
			 $html .="<td>".$col[email_id]."</td>";
			 $html .="<td>".$storeName."</td>";
			 $html .="<td>".$col[created_at]."</td>";
			 $html .="<td><a href='useredit.php?id=".$col[id]."'>edit</a></td>";
			 $html .="<td><a id='status_".$col[id]."' href='javascript:void(0);' onclick='return deleteAction(".$col[id].",".$col[status].")'>$status</a></td>";
			 $html .="<tr>";
			 $colNo++;   
	    }
	    return $html .="</table>";
   	}else{
		 //$html .="<tr>No Rider Registered Under This Store</tr>";
		 $html .="</table>";
		 $html .="No User List under this store";
		 return $html;
		 }
	}
	
	public function onChangeMasterhubStoreData($post){
		//print_r($post);
		$cond   = '';
		$cond   .= (!empty($post[storeid]))  ? "store_id=".$post[storeid] : 1;  
		$selQry =  "SELECT *FROM `rider_masterhub` WHERE  status ='1' AND $cond  ";     
        $collections = $this->readConnection()->fetchAll($selQry);  
        $html    ='';
		$html .='<select id="master_imeiNo" name="master_imeiNo" >';
		//$html .='<option value="" >Please Select User</option>';
        if($collections) {
		   $colNo = 1;
      foreach ($collections as $dataVal) {
		     //$status   = $col['status']=='1' ? 'Active' : 'Inactive';
             $storeName = $_storeName = Mage::app()->getStore($dataVal['store_id'])->getName();
		     $html .="<option value='".$dataVal['imei_no']."' >".$dataVal['master_name']."";
			 $html .="</option>";
			 $colNo++;   
	    }
	    return $html .="</select>";
   	  }else{
		  $html .='<option value="" >No Master User</option>';
		  return $html .="</select>";
		  }
	}
	
		public function getAllStoreRider($post){
		///print_r($post);
		$cond   = '';
		$cond   .= (!empty($post[storeid]))  ? "rider_storeid=".$post[storeid] : 1;  
		echo $selQry =  "SELECT *FROM `rider` WHERE  status ='1' AND $cond  ";     
        $collections = $this->readConnection()->fetchAll($selQry);  
        $html    ='';
		$html .='<select id="rider_imeiNo" name="rider_imeiNo" >';
		//$html .='<option value="" >Please Select User</option>';
        if($collections) {
		   $colNo = 1;
      foreach ($collections as $dataVal) {
		     //$status   = $col['status']=='1' ? 'Active' : 'Inactive';
             $storeName = $_storeName = Mage::app()->getStore($dataVal['store_id'])->getName();
		     $html .="<option value='".$dataVal['RegistrationNo']."' >".$dataVal['rider_name']."";
			 $html .="</option>";
			 $colNo++;   
	    }
	    return $html .="</select>";
   	  }else{
		  $html .='<option value="" >No Rider User</option>';
		  return $html .="</select>";
		  }
	}
	

	public function deleteAction($post){
		if($post[status]==1){
				$status = 0;
				$statusVal = 'Inactive';
			}else{
				$status = 1;
				$statusVal = 'Active';
				}
		$updateQry =  "UPDATE `rider_masterhub` SET `status` = '$status'  WHERE id='$post[id]'";
        $collections = $this->writeConnection()->query($updateQry);
        //echo $status = "<a id='status_".$post[id]."' href='javascript:void(0);' onclick='return deleteAction(".$post[id].",".$status.")'>$statusVal</a>";  
	}
	
		public function getExportData($post){
		
		//$xml ='';
       // $xml .="header('Content-Type: text/csv; charset=utf-8')";
		//$xml .="header('Content-Disposition: attachment; filename=calls.csv')";

		// create a file pointer connected to the output stream
		$output = fopen('php://output', 'w');

		// loop over the rows, outputting them
		$query = "SELECT *FROM `rider_masterhub_cashdetails` as mp WHERE mp.store_id='".$post[storeId]."'";    
        $collections = $this->readConnection()->query($query);
        
		// output the column headings
		fputcsv($output, array('id', 'rider_name','imei_no','store_id','cash_date','cash_amount','thousands','five_hundred','one_hundred','fifty','twenty','ten','five','two','one','status','create_at','modified_at'));

		foreach ($collections as $fields) {
			fputcsv($output, $fields);
		 }
		 fclose($output);
	}


	public function getRiderPaymentView($post){
			$from_date   = date('d / m / Y', strtotime($post[from]));
			$from_to     = date('d / m / Y', strtotime($post[to]));

			$cond   = '';
			$cond   .= (!empty($post[store]))  ? "store_id='".$post[store]."'"  : 1;  
			$cond   .= " AND `cash_date`>='".$from_date."' AND  `cash_date` <='".$from_to."' ";
			$selQry =  "SELECT *FROM `rider_masterhub_cashdetails` WHERE imei_no='".$post[master_imeiNo]."' AND $cond "; 
			$collections = $this->readConnection()->fetchAll($selQry);  
			$html    ='';
			$html .='<table width="100%" border="1" style="0px #cccccc">';
			$html .='<tr>';
			$html .='<th>S.No</th>';
			$html .='<th>Rider Name</th>';
			$html .='<th>Paid Amount</th>';
			$html .='<th>IMEI No.</th>';
			//$html .='<th>Email Id</th>';
			$html .='<th>Store Name</th>';
			$html .='<th>Created At</th>';
			$html .='</tr>';
           if($collections) {
				$colNo = 1; 

      foreach ($collections as $col) {
            $storeName = $_storeName = Mage::app()->getStore($col['store_id'])->getName();
			$html .="<tr>";
			$html .="<td>".$colNo."</td>";
			$html .="<td>".$col[rider_name]."</td>";
			$html .="<td>".$col[cash_amount]."</td>";
			$html .="<td>".$col[imei_no]."</td>";
			//$html .="<td>".$col[email_id]."</td>";
			$html .="<td>".$storeName."</td>";
			$html .="<td>".$col[create_at]."</td>";
			$html .="<tr>";
		}
	     return $html .="</table>";

   	}else{
		 //$html .="<tr>No Rider Registered Under This Store</tr>";
		 $html .="</table>";
		 $html .="No User List under this store";
		 return $html;
		 }
	}
	
	public function getRiderListaa($storeid){
		$cond   = '';
		//$cond   .= (!empty($storeid))  ? "rider_storeid='".$storeid."'" : '';  
		//$selQry =  "SELECT rider_name,RegistrationNo FROM `rider` WHERE  status ='1' AND $cond  ";  
		$selQry =  "SELECT rider_name,RegistrationNo FROM `rider` WHERE  status ='1'  ";  
        $collections = $this->readConnection()->fetchAll($selQry);  
        /*$html    ='';
		$html .='<select id="rider_imeiNo" name="rider_imeiNo" >';
		//$html .='<option value="" >Please Select User</option>';
        if($collections) {
		   $colNo = 1;
      foreach ($collections as $dataVal) {
             //$storeName = $_storeName = Mage::app()->getStore($dataVal['store_id'])->getName();
		     $html .="<option value='".$dataVal['RegistrationNo']."' >".$dataVal['rider_name']."";
			 $html .="</option>";
			 $colNo++;   
	    }
	    return $html .="</select>";
   	  }else{
		  $html .='<option value="" >No Master User</option>';
		  return $html .="</select>";
		  */
		  foreach($collections as $data){
		  print_r($data);  
		  exit;
	  }
		  //return  $collections;
		  //}
		
		}
}    
?>
