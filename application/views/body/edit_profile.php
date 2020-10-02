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
        <?php echo $this->session->flashdata("msg");?>
        <div class="row">
        <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-icon card-header-rose">
                  <div class="card-icon">
                  <img src="<?php echo base_url();?>assets/img/icons/baseline_portrait_white_18dp.png">
                  </div>
                  <h4 class="card-title">Edit Profile
                    <!-- <small class="category"></small> -->
                  </h4>
                </div>
                <div class="card-body">
                <form method="post" action="<?php echo base_url();?><?php echo $save_profile;?>" class="form-horizontal"> 
                    
                    <div class="row">
                      <label class="col-sm-2 col-form-label">Old Password</label>
                      <div class="col-sm-10">
                      <div class="form-group">
                      <input class="form-control form-password" placeholder="Password" name="old_password" id="old_password" type="password">
                      <span class="bmd-help">Enter Old Password</span>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <label class="col-sm-2 col-form-label">New Password</label>
                      <div class="col-sm-10">
                      <div class="form-group">
                      <input class="form-control form2-password" placeholder="Password" name="new_password" id="new_password" type="password">
                      <span class="bmd-help">Enter New Password</span>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <label class="col-sm-2 col-form-label">Confirm Password</label>
                      <div class="col-sm-10">
                      <div class="form-group">
                      <input class="form-control form3-password" placeholder="Password" name="confirm_password" id="confirm_password" type="password">
                      <span class="bmd-help">Enter Confirm Password</span>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <label class="col-sm-2 col-form-label"></label>
                      <div class="col-sm-10">
                        <div class="form-group">
                          <label class="form-check-label">
                            <input class="form-check-input form-checkbox" type="checkbox">Show Password
                            <span class="form-check-sign">
                              <span class="check"></span>
                            </span>
                          </label>
                        </div>
                      </div>
                    </div>

                    <div class="card-footer ml-auto mr-auto">
                    <button type="submit" class="btn btn-rose pull-right">Cancel</button>
                    <button type="submit" class="btn btn-rose pull-right">Save Profile</button>
                    </div> 
                    <div class="clearfix"></div>
                  </form>
                </div>
              </div>
            </div>
            <!-- end col-md-12 -->
            </div>
            <!-- end col-md-12 -->
          </div>


