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
          <a href="#">Update</a>
        </li>
      </ul>
      
      <div class="page-header">
        <h2>
          Updating <?php echo ucfirst($this->uri->segment(2));?>
        </h2>
      </div>

 
      <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> rider updated with success.';
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
      $attributes = array('class' => 'form-horizontal', 'id' => '');

		$allStores = Mage::app()->getStores();
		//$options_store = array('' => "Select");
		
		foreach ($allStores as $_eachStoreId => $val){
		$_storeName = $val->getName();
		$_storeId   = $val->getStoreId();
        $options_store[$_storeId] = $_storeName;
      }
      
      //form validation
      echo validation_errors();

      echo form_open('admin/rider/update/'.$this->uri->segment(4).'', $attributes);
      
      
      ?>
        <fieldset>          
                <div class="control-group">
            <label for="inputError" class="control-label">Rider Name</label>            
            <div class="controls">
              <input type="text" id="" name="name" value="<?php echo $rider[0]['rider_name']; ?>" >
              <!--<span class="help-inline">Woohoo!</span>-->
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">IMEI NO</label>            
            <div class="controls">
              <input type="text" id="" name="imeino" value="<?php echo $rider[0]['RegistrationNo']; ?>" >
              <!--<span class="help-inline">Woohoo!</span>-->
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Emp Code</label>            
            <div class="controls">
              <input type="text" id="" name="empCode" value="<?php echo $rider[0]['rider_emp_no']; ?>" >
              <!--<span class="help-inline">Woohoo!</span>-->
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Password</label>            
            <div class="controls">
              <input type="password" id="" name="password" value="<?php echo $rider[0]['password']; ?>" >
              <!--<span class="help-inline">Woohoo!</span>-->
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Email Id</label>            
            <div class="controls">
              <input type="text" id="" name="emailid" value="<?php echo $rider[0]['email_id']; ?>" >
              <!--<span class="help-inline">Woohoo!</span>-->
            </div>
          </div>
       
            <?php 
          echo '<div class="control-group">';
            echo '<label for="store_id" class="control-label">Store Name</label>';
            echo '<div class="controls" id="store-dropdown">';   
              //echo form_dropdown('store_id', $options_store, $masterhub[0]['store_id'], 'class="span2"');                      
              echo form_dropdown('store_id', $options_store, $rider[0]['rider_storeid'], 'class="span2"');
            echo '</div>';
          echo '</div">';
          ?> 
          
          
          <div class="form-actions">
            <button class="btn btn-primary" type="submit">Save changes</button>
            <button class="btn" type="reset">Cancel</button>
          </div>
        </fieldset>

      <?php echo form_close(); ?>

    </div>
     
