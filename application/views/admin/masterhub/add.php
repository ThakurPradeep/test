<?php 
    /*require_once('/var/www/html/spencer/app/Mage.php'); //Path to Magento
	umask(0);
	Mage::app();

 $resource =  Mage::getSingleton('core/resource');
 $readConnection = $resource->getConnection('core_read');
*/
//$wsd =  $this->masterhub->getRiderList(14);
//https://supundharmarathne.wordpress.com/2013/03/13/simple-ajax-drop-down-filtering-with-codeigniter/

?>
    <div class="container top">
      
      <ul class="breadcrumb">
        <li>
          <a href="<?php echo site_url("admin"); ?>">
            <?php echo ucfirst($this->uri->segment(1));?>
          </a> 
          <span class="divider">/</span>
        </li>
        <li>
          <a href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>">
            <?php echo ucfirst($this->uri->segment(2));?>
          </a> 
          <span class="divider">/</span>
        </li>
        <li class="active">
          <a href="#">New</a>
        </li>
      </ul>
      
      <div class="page-header">
        <h2>
          Adding <?php echo ucfirst($this->uri->segment(2));?>
        </h2>
      </div>

      <?php 
      //flash messages
      if(isset($flash_message)){
        if($flash_message == TRUE)
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> new masterhub user created with success.';
          echo '</div>';       
        }else{
          echo '<div class="alert alert-error">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Oh snap!</strong> change a few things up and try submitting again.';
          echo '</div>';          
        }
      }
      ?>
      
      <?php
      //form data
     // $attributes = array('class' => 'form-horizontal', 'id' => '');
  //form data
      $attributes = array('class' => 'form-horizontal', 'id' => '');
      $options_manufacture = array('' => "Select");
      foreach ($manufactures as $row)
      {

        $options_manufacture[$row['id']] = $row['name'];
      }
      
      //form data
      $attributes = array('class' => 'form-horizontal', 'id' => '');
     //echo "<pre>";
     $allStores = Mage::app()->getStores();
	 //$options_store = array('' => "Select");
		foreach ($allStores as $_eachStoreId => $val){
		$_storeName = $val->getName();
		$_storeId   = $val->getStoreId();
        $options_store[$_storeId] = $_storeName;
      }
      
       $riderlist = $this->masterhub->getRiderList();
		//foreach($riderlist as $data){
			//$dataa[]= $data;
			//}
			//print_r($riderlist);
			//exit;
			
      //print_r($options_store);
      //print_r($riderlist);exit;
      
      //form validation
      echo validation_errors();
      
      echo form_open('admin/masterhub/add', $attributes);
      ?>
        <fieldset>
          <div class="control-group">
            <label for="inputError" class="control-label">Master Name</label>            
            <div class="controls">
              <input type="text" id="" name="name" value="<?php echo set_value('name'); ?>" >
              <!--<span class="help-inline">Woohoo!</span>-->
            </div>
          </div>
          <!--div class="control-group">
            <label for="inputError" class="control-label">IMEI NO</label>            
            <div class="controls">
              <input type="text" id="" name="imeino" value="<?php echo set_value('imeino'); ?>" >
              <!--<span class="help-inline">Woohoo!</span>- ->
            </div>
          </div-->
          <div class="control-group">
            <label for="inputError" class="control-label">Password</label>            
            <div class="controls">
              <input type="password" id="" name="password" value="<?php echo set_value('password'); ?>" >
              <!--<span class="help-inline">Woohoo!</span>-->
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Email Id</label>            
            <div class="controls">
              <input type="text" id="" name="emailid" value="<?php echo set_value('emailid'); ?>" >
              <!--<span class="help-inline">Woohoo!</span>-->
            </div>
          </div>
          <!--div class="control-group">
            <label for="inputError" class="control-label">Store Name</label>            
            <div class="controls">
              <input type="text" id="" name="storename" value="<?php echo set_value('storename'); ?>" >              
            </div>
          </div-->
              
          
         <div class="control-group">
            <label for="store_id" class="control-label">Store Name</label>
            <div class="controls" id="store-dropdown">
           <?php
              //echo form_dropdown('manufacture_id', $options_manufacture, '', 'class="span2"');              
              echo form_dropdown('store_id', $options_store, set_value('store_id'), 'class="span2"');
              ?>
           </div>
         </div>
          
          <!--div class="control-group">
            <label for="rider_id" class="control-label">Rider Name</label>
            <div class="controls" id="rider-dropdown">
			<?php         
			  echo form_dropdown('rider_id', $riderlist, set_value('rider_id'), 'class="span2"');
			  ?>
            </div>
             </div-->
                    
          <div class="form-actions">
            <button class="btn btn-primary" type="submit">Save changes</button>
            <button class="btn" type="reset">Cancel</button>
          </div>
        </fieldset>

      <?php echo form_close(); ?>

    </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="<?php //echo base_url('assets/js/app.js'); ?>"></script>
<!--script type="application/javascript">
    $(document).ready(function () { 
        $('#store-dropdown select').change(function () { 
			var baseurl = "<?php print base_url().'index.php/'; ?>";
			var storeId = $(this).val();
			var target_url = "<?php echo $this->masterhub->getRiderList(storeId) ?>";
			alert(target_url);
           
            alert(storeId); // <-- change this line
            //console.log(storeId);
				$('#rider-dropdown').html(target_url);
           /* $.ajax({
                url: target_url,
                async: false,
                type: "POST",
                //data: "storeId="+storeId,
                //dataType: "html",
				data: "{storeId:'" + storeId + "'}",
			    contentType: "application/json",
			    dataType: 'json',
				success: function(data) { alert(data)
                   // $('#ciudad').html(data);
                }
            })*/
        });
    });
</script-->
<!--script type="text/javascript">
    var baseurl = "<?php print base_url(); ?>";
    jQuery('#store_id').change(function() { alert('aas');
        var passedvalue = jQuery('#store_id').val();
        
        var path = base_url+"masterhub/getRiderList";
        jQuery.ajax({
            type: "POST",
            url: path,
            data: {'storeId': passedvalue},
            success: function(data) {
                if (data) {
                    alert(success);//task done on success
                }
            },
            error: function() {
                    alert('some error occurred');
                },
          });
      })
    
    
    </script-->
    
     <!--script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $('#store-dropdown select').change(function () {
                    var selState = $(this).attr('value');
                    alert(selState)
                    console.log(selState);
                    $.ajax({   
                        //url: "<?php base_url().'masterhub/getRiderListByStoreId' ;?>", //The url where the server req would we made.
                        url: "<?php echo base_url().'includes/ajax.php' ;?>",
                        async: false,
                        type: "POST", //The type which you want to use: GET/POST
                        data: "state="+selState, //The variables which are going.
                        dataType: "html", //Return data type (what we expect).
                         
                        //This is the function which will be called if ajax call is successful.
                        success: function(data) {
                            //data is the html of the page where the request is made.
                            $('#city').html(data);
                        }
                    })
                });
            });
        </script--->
     
