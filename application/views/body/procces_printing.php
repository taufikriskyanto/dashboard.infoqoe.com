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
      
      <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Finish Printing</h4>
              </div>
              <div class="card-body">
              <form method="post" action="<?php echo base_url();?><?php echo $finish_jobs;?>" class="form-horizontal">
                    <div class="row">
                    <label class="col-sm-4 col-form-label">Number Splod</label>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <input id="splod" name="splod" type="text" class="form-control" required>
                          <span class="bmd-help">Enter Splod Number</span>
                        </div>
                      </div>
                    </div>
                    </div>
                    <div class="card-footer ml-auto mr-auto">
                    <button type="submit" class="btn btn-info">Submit</button>
                  </div>
              </form>
              </div>
			</div>
			
			
			<div class="col-md-6">
            <div class="card">
            <div class="card-header">
              <h4 class="card-title">Reject Printing</h4>
              </div>
              <div class="card-body">
              <form method="post" action="<?php echo base_url();?><?php echo $reject_job;?>" class="form-horizontal">
                    <div class="row">
                    <label class="col-sm-4 col-form-label">Number Splod</label>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <input id="splod" name="splod" type="text" class="form-control" >
                          <span class="bmd-help">Enter Splod Number</span>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <label class="col-sm-4 col-form-label">Alasan</label>
                      <div class="col-sm-3">
                        <select class="selectpicker" data-size="7" data-style="select-with-transition" title="REJECT PRINTING" name="reject_printing" id="reject_printing" >
                        <option value="" disabled diselected>-- Selected --</option>
                          <option value="Material Tidak Ada">Material tidak ada</option>
                          <option value="Mesin Rusak">Mesin Rusak</option>
                          <option value="Data Belum Masuk">Data Belum Masuk</option>
                          <option value="Kroscek Data Dahulu">Kroscek Data Dahulu</option>
                          <option value="Slot Mesin Tidak Available">Slot Mesin Tidak Available</option>
                        </select>
                      </div>
                    </div>
                    </div>
                    <div class="card-footer ml-auto mr-auto">
                    <button type="submit" class="btn btn-info">Submit</button>
                  </div>
              </form>
			        
              </div>
              
            </div>




      </div><!-- PENUTUP ROW-->

        <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">print</i>
                  </div>
                  <h4 class="card-title">PRINTING</h4>
                </div>
                <div class="card-body">
                  <div class="toolbar">
                  <?php echo $this->session->flashdata("msg");?>
                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                  </div>
                  <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                      <thead>
                        <tr>
                          <th class="disabled-sorting text-left">Customer Name</th>
                          <th class="disabled-sorting text-left">Splod</th>
                          <th class="disabled-sorting text-left">Produk</th>
                          <th>Date Proses</th>
                          <th class="disabled-sorting text-left">Jumlah Amplop</th>
                          <th class="disabled-sorting text-left">Jumlah Page</th>
                          <th class="disabled-sorting text-left">Status</th>
                          <th class="disabled-sorting text-left">Alasan</th>
                          <th class="disabled-sorting text-center">Actions</th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr>
						              <th>Customer Name</th>
                          <th>Splod</th>
                          <th>Produk</th>
                          <th>Date Proses</th>
                          <th>Jumlah Amplop</th>
                          <th>Jumlah Page</th>
                          <th>Alasan</th>
                          <th>Status</th>
                          <th class="disabled-sorting text-center">Actions</th>
                        </tr>
                      </tfoot>
                      <tbody>
                      <?php $no = 0; foreach($get_printing as $row) : $no++;?>
                      <?php 
                      if($row->printing_status==='reject'){
                        $colour = 'red';
                        $info = 'Reject';
                      }else{
                        $colour = 'blue';
                        $info = 'Printing';
                      }?>
                        <tr>
                            <td><?php echo $row->customer;?></td>
                         	  <td><?php echo $row->splod;?></td>
                          	<td><?php echo $row->produk;?></td>
                            <td><?php echo $row->date_proccess;?></td>
                            <td><?php echo $row->total_envelop;?></td>
                            <td><?php echo $row->total_pages;?></td>
                            <td><font color="<?php echo $colour?>"><?php echo $info?></font></td>
                            <td><?php echo $row->printing_reject;?></td>
                            <td class="text-center">
                            <a  href="<?php echo base_url();?>procces_printing/edit_procces/<?php echo $row->id_log_summary_dnr_detail;?>"  class="btn btn-link btn-success">Finish</a>
                        </td>
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