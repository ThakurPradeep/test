<?php
echo "pradeep";
$obj =& get_instance();
echo "pradeep";
//$CI->load->helper('url');
//$CI->load->library('masterhub');
//$CI->config->item('base_url');
 //$this->load->library('masterhub');
  //     require_once('../application/controllers/admin_masterhub.php');
      // include_once('/var/www/html/CIadmin/application/controllers/admin_masterhub.php');
       //require_once('Riderapp_class.php');     
       //s$masterObj = new Masterhub();
       echo "asda";
       //$riderObj = new Riderregistration();
       //$wsd =  $masterObj->getRiderList(14);
       $params = $_REQUEST;
      print_r($_REQUEST);
      echo "asda";exit;
      if($params['fun']=='onChangeStoreData'){
		echo $ret =  $masterObj->onChangeStoreData($params);
		die;
	  }elseif($params['fun']=='deleteAction'){
		echo $ret =  $masterObj->deleteAction($params);
		die;
   }     
   
   
      if($params['fun']=='onChangeMasterhubStoreData'){
		echo $ret =  $masterObj->onChangeMasterhubStoreData($params);
		die;
	  }elseif($params['fun']=='onclickAction'){
		echo $ret =  $masterObj->statusAction($params);
		die;
	}elseif($params['fun']=='exportdata'){ 
		echo $ret =  $masterObj->getExportData($params);
		die;
	  }elseif($params['fun']=='onChangeMasterStore'){ 
		echo $ret =  $masterObj->getAllStoreRider($params);
		die;
	  }elseif($params['fun']=='onChangeTransactionStore'){ 
		echo $ret =  $masterObj->getAllStoreMaster($params);
		die;
	  }  
	    
	  
/*	  
   if($params['fun']=='onSelectStoreId'){
		echo $ret =  $riderObj->onChangeStoreData($params);
		die;
	  }elseif($params['fun']=='onclickStatus'){
		echo $ret =  $riderObj->statusAction($params);
		die;
   }
  */ 
       
        
?>
