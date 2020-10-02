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
                    <h4 class="card-title">Form  unapprove Printing</h4>
                  </div>
                </div>
                <div class="card-body ">
				        <form method="post" action="<?php echo base_url();?><?php echo $url;?>" class="form-horizontal">
				        <input type="hidden" class="form-control" name="id_surat_order" value="<?php echo $id_surat_order;?>">
                    <div class="row">
                      <label class="col-sm-2 col-form-label">Nomer SO</label>
                      <div class="col-sm-10">
                        <div class="form-group">
                          <input type="text" class="form-control" name="splod" placeholder="No. Splod" value="<?php echo $number_so;?>" readonly>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <label class="col-sm-2 col-form-label">Nama Pekerjaan</label>
                      <div class="col-sm-10">
                        <div class="form-group">
                          <input type="text" class="form-control" name="job_name"  value="<?php echo $job_name;?>" readonly>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <label class="col-sm-2 col-form-label">Pekerjaan Masuk</label>
                      <div class="col-sm-10">
                        <div class="form-group">
                          <input type="text" class="form-control" name="incoming_date"  value="<?php echo $incoming_date;?>" readonly>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <label class="col-sm-2 col-form-label">PIC Pemberi Order</label>
                      <div class="col-sm-10">
                        <div class="form-group">
                          <input type="text" class="form-control" name="name_pic"  value="<?php echo $name_pic;?>" readonly>
                        </div>
                      </div>
                    </div>

					<div class="row">
                      <label class="col-sm-2 col-form-label">Cost Center</label>
                      <div class="col-sm-10">
                        <div class="form-group">
                          <input type="text" class="form-control" name="cost_center"  value="<?php echo $cost_center;?>" readonly>
                          <!-- <span class="bmd-help">Enter No. Splod</span> -->
                        </div>
                      </div>
                    </div>

					<div class="row">
                      <label class="col-sm-2 col-form-label">Target SLA</label>
                      <div class="col-sm-10">
                        <div class="form-group">
                          <input type="text" class="form-control" name="sla"  value="<?php echo $sla;?> Jam" readonly>
                          <!-- <span class="bmd-help">Enter No. Splod</span> -->
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <label class="col-sm-2 col-form-label">Alasan</label>
                      <div class="col-sm-10">
                        <select class="selectpicker" data-size="7" data-style="select-with-transition" title="Alasan" name="alasan" id="alasan">
                        <option value="" disabled diselected>-- Selected --</option>
                          <option value="FILE BELUM TERSEDIA">FILE BELUM TERSEDIA</option>
                          <option value="MATERIAL BELUM TERSEDIA">MATERIAL BELUM TERSEDIA</option>
                        </select>
                      </div>
                    </div>
                    </div>
                    <div class="card-footer ml-auto mr-auto">
                    <button type="submit" class="btn btn-info">Submit</button>
					<a href="<?php echo base_url();?>upload_log_dnr"  class="btn btn-info">Cancel</a>
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


