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
              <div class="card">
                <div class="card-header card-header-primary card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">assignment</i>
                  </div>
                  <h4 class="card-title">DataTables.net</h4>
                </div>
                <div class="card-body">
                  <div class="toolbar">
                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                  </div>
                  <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                      <thead>
                        <tr>
                          <th>Machine Name</th>
                          <th>Name Jobs</th>
                          <th>Jobs Status</th>
                          <th>Start</th>
                          <th>Finish</th>
                          <th>Pages</th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr>
						  <th>Machine Name</th>
                          <th>Jobs</th>
                          <th>Jobs Status</th>
                          <th>Start</th>
                          <th>Finish</th>
                          <th>Pages</th>
                        </tr>
                      </tfoot>
                      <tbody>
                      <?php $no = 0; foreach($view_log_nuvera as $row) : $no++;?>
                        <tr>
                            <td style="font size=6"><?php echo $row->machine_name;?></td>
                         	<td style="font size=6"><?php echo $row->document_name;?></td>
                          	<td style="font size=6"><?php echo $row->job_status;?></td>
                            <td style="font size=6"><?php echo $row->start_rip_time;?></td>
							<td style="font size=6"><?php echo $row->completion_date;?></td>
							<td style="font size=6"><?php echo $row->total_impressions_printed;?></td>
                        </tr>
                        <?php endforeach;?>
                      </tbody>
                    </table>
                  </div>
                </div>
                <!-- end content-->
              </div>
              <!--  end card  -->
            </div>
            <!-- end col-md-12 -->
            </div>
            <!-- end col-md-12 -->
          </div>