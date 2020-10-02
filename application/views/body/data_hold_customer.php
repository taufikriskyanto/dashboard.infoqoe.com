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
            <div class="card-header">
              <h4 class="card-title">Search Data Hold</h4>
              </div>
              <div class="card-body">
              <form method="post" action="<?php echo base_url();?><?php echo $search;?>" class="form-horizontal">
                    <div class="row">
                    <label class="col-sm-2 col-form-label">Cycle</label>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <input id="cycle" name="cycle" type="text" class="form-control datepicker" >
                          <span class="bmd-help">Enter Cycle of Data Hold</span>
                        </div>
                      </div>
                    </div>

                    
                    <div class="row">
                      <label class="col-sm-2 col-form-label">Customers</label>
                      <div class="col-lg5 col-md-6 col-sm-3">
                          <select class="selectpicker" data-size="7" data-style="select-with-transition" title="Customer" name="customer_id" id="customer_id">
                        
                        <option value="" disabled diselected>-- Selected --</option>
                        <?php 
                          foreach($customer as $row)
                          { ?>
                          <option <?php if ($row->customer_id == $customer_id){echo 'selected="selected"';}?> value="<?php echo$row->customer_code?>"><?php echo $row->customer_name?></option>
                          <?php }?>
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
			
<!-- 			
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
              
            </div> -->




      </div><!-- PENUTUP ROW-->

        <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">attach_email</i>
                  </div>
                  <h4 class="card-title">Data Hold Customer</h4>
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
                          <th class="disabled-sorting text-left">No</th>
                          <th class="disabled-sorting text-left">Customers</th>
                          <th class="disabled-sorting text-left">Info Product</th>
                          <th class="disabled-sorting text-left">Name File</th>
                          <th class="disabled-sorting text-left">Cycle</th>
                          <th class="disabled-sorting text-left">Date Recevie</th>
                          <th class="disabled-sorting text-center">Actions</th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr>
						  <th>No</th>
                          <th>Customers</th>
                          <th>Info Product</th>
                          <th>Name File</th>
                          <th>Cycle</th>
                          <th>Date Recevie</th>
                          <th class="disabled-sorting text-center">Actions</th>
                        </tr>
                      </tfoot>
                      <tbody>
                      <?php $no = 0; foreach($get_file as $row) : $no++;?>
                        <tr>
                            <td><?php echo $no;?></td>
                         	  <td><?php echo $row->customer;?></td>
                          	<td><?php echo $row->info_files;?></td>
                            <td><?php echo $row->name_file;?></td>
                            <td><?php echo $row->cycle_file;?></td>
                            <td><?php echo $row->createdby;?></td>
                            <td class="text-center">
                            <a href="<?php echo base_url();?><?php echo $row->path_file;?>/<?php echo $row->name_file;?>"><img src="<?php echo base_url();?>assets/img/icons/baseline_vertical_align_bottom_black_18dp.png"></a>
                            <!-- <a href="" id="mybutton" data-id="<?php echo $row->id_file;?>" data-toggle="modal" data-target="#myModal10"><img src="<?php echo base_url();?>assets/img/icons/baseline_delete_black_18dp.png"></a> -->
                            <a href="<?php echo site_url('upload_files/delete_file/'.$row->id_file); ?>" onclick="return confirm('Apakah Anda Ingin Menghapus Data <?=$row->name_file;?> ?');" data-popup="tooltip" data-placement="top" title="Hapus Data"><img src="<?php echo base_url();?>assets/img/icons/baseline_delete_black_18dp.png"></a>
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