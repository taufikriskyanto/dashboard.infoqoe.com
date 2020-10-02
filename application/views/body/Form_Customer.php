<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-minimize">
              <button id="minimizeSidebar" class="btn btn-just-icon btn-white btn-fab btn-round">
              <i class="text_align-center visible-on-sidebar-regular"><img src="<?php echo base_url();?>assets/img/icons/baseline_more_vert_black_18dp.png"></i>
                <i class="design_bullet-list-67 visible-on-sidebar-mini"><img src="<?php echo base_url();?>assets/img/icons/baseline_view_list_black_18dp.png"></i>
              </button>
            </div>
            <a class="navbar-brand" href="#pablo">Dashboard Monitoring</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end">
          <span><h6 id="update_time"></h6></span>
          </div>
        </div>
      </nav>
<div class="content">
        <div class="container-fluid">
        <div class="row">
		<div class="col-md-12">
              <div class="card ">
                <div class="card-header card-header-rose card-header-text">
                  <div class="card-text">
                    <h4 class="card-title">Form Customers</h4>
                  </div>
                </div>
                <div class="card-body ">
				        <form method="post" action="<?php echo base_url();?><?php echo $url;?>" class="form-horizontal">
                  <input type="hidden" class="form-control" name="customer_id" value="<?php echo $customer_id;?>">
                    <div class="row">
                      <label class="col-sm-2 col-form-label">Customers Name</label>
                      <div class="col-sm-10">
                        <div class="form-group">
                          <input type="text" class="form-control" name="customer_name" id="customer_name" placeholder="Customers Name" value="<?php echo $customer_name;?>" required>
                          <span class="bmd-help">Enter The Name Of Company</span>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <label class="col-sm-2 col-form-label">Customers Type</label>
                      <div class="col-lg-5 col-md-6 col-sm-3">
                        <select class="selectpicker" data-size="7" data-style="select-with-transition" title="Customer Type" name="customer_type_id" id="customer_type_id">
                        
                        <option value="" disabled diselected>-- Selected --</option>
                        <?php 
                          foreach($customer_type as $row)
                          { ?>
                          <option <?php if ($row->customer_type_id == $customer_type_id){echo 'selected="selected"';}?> value="<?php echo$row->customer_type_id?>"><?php echo $row->customer_type_name?></option>
                          <?php }?>
                        </select>
                      </div>
                    </div>
					          <div class="row">
                      <label class="col-sm-2 col-form-label">Customers Code</label>
                      <div class="col-sm-10">
                        <div class="form-group">
                          <input type="text" class="form-control" name="customer_code" id="customer_code" placeholder="Customers Code" value="<?php echo $customer_code;?>" required>
                          <span class="bmd-help">Enter The Code Of Company</span>
                        </div>
                      </div>
                    </div>
                    </div>
                    <div class="card-footer ml-auto mr-auto">
                    <button type="submit" class="btn btn-info">Submit</button>
					          <a href="<?php echo base_url();?>customer/list_customer"  class="btn btn-info">Cancel</a>
                  </div>
                  </form>
                </div>
              </div>
            </div>
            </div>
            <!-- end col-md-12 -->
            </div>
            <!-- end col-md-12 -->
          </div>