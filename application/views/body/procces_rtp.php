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
              <h4 class="card-title">Finish Ready To Pickup</h4>
              </div>
              <div class="card-body">
              <form method="post" action="<?php echo base_url();?><?php echo $finish_jobs;?>" class="form-horizontal">
                    
                    <div class="row">
                      <label class="col-sm-2 col-form-label">Number Splod</label>
                      <div class="col-sm-10">
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
              <h4 class="card-title">Finish Hold Polis</h4>
              </div>
              <div class="card-body">
              <form method="post" action="<?php echo base_url();?><?php echo $finish_polis_jobs;?>" class="form-horizontal">
                  
                    <!-- <div class="row">
                      <label class="col-sm-2 col-form-label">Customer</label>
                      <div class="col-sm-3">
                      <select class="selectpicker" data-size="7" data-style="select-with-transition" title="Customer" name="customer_code" id="customer_code" required>
                        
                        <option value="" disabled diselected>-- Selected --</option>
                        <?php 
                          foreach($customer as $row)
                          { ?>
                          <option value="<?php echo$row->customer_code?>"><?php echo $row->customer_name?></option>
                          <?php }?>
                        </select>
                      </div>
                    </div>

                  <div class="row">
                    <label class="col-sm-2 col-form-label">Cycle</label>
                      <div class="col-sm-10">
                        <div class="form-group">
                          <input id="cycle" name="cycle" type="text" class="form-control datepicker" required>
                          <span class="bmd-help">Cycle Date</span>
                        </div>
                      </div>
                  </div> -->

                  <!-- <div class="row">
                      <label class="col-sm-2 col-form-label">Number Splod</label>
                      <div class="col-sm-10">
                        <div class="form-group">
                          <input id="splod" name="splod" type="text" class="form-control" required>
                          <span class="bmd-help">Enter Splod Number</span>
                        </div>
                      </div>
                    </div> -->
                    <div class="row">
                      <label class="col-sm-2 col-form-label">Jenis Hold</label>
                      <div class="col-sm-10">
                      <select class="selectpicker" data-size="7" data-style="select-with-transition" title="SELECTED" name="hold" id="hold" required>
                        <option value="" disabled diselected>-- Selected --</option>
                        <option value="REGULER">REGULER</option>
                        <option value="DAILY">DAILY</option>
                        <option value="QC">QC</option>
                        <option value="URGENT">URGENT</option>
                        </select>
                      </div>
                    </div>

                    <div class="row">
                      <label class="col-sm-2 col-form-label">Number Polis</label>
                      <div class="col-sm-10">
                        <div class="form-group">
                          <input id="polis" name="polis" type="text" class="form-control" required>
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

        </div>

        <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary card-header-icon">
                  <div class="card-icon">
                  <img src="<?php echo base_url();?>assets/img/icons/baseline_local_shipping_white_18x2dp.png">
                  </div>
                  <h4 class="card-title">Ready To Pickup</h4>
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
                          <th class="disabled-sorting text-center">Customer Name</th>
                          <th class="disabled-sorting text-center">Splod</th>
                          <th class="disabled-sorting text-center">Produk</th>
                          <th class="disabled-sorting text-center">Date Proses</th>
						              <th class="disabled-sorting text-center">Jumlah Amplop</th>
                          <th class="disabled-sorting text-center">Jumlah Page</th>
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
                          <th class="disabled-sorting text-center">Actions</th>
                        </tr>
                      </tfoot>
                      <tbody>
                      <?php $no = 0; foreach($get_rtp as $row) : $no++;?>
                        <tr>
                            <td><?php echo $row->customer;?></td>
                         	  <td><?php echo $row->splod;?></td>
                          	<td><?php echo $row->produk;?></td>
                            <td><?php echo $row->date_proccess;?></td>
                            <td><?php echo $row->total_envelop;?></td>
                            <td><?php echo $row->total_pages;?></td>
                            <td class="text-center">
                            <a class="btn btn-link btn-success edit"  href="<?php echo base_url();?>procces_rtp/edit_procces/<?php echo $row->id_log_summary_dnr_detail;?>">Finish</a>
                            <!-- <a href="#" class="btn btn-link btn-danger remove">Cancel</a> -->
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

<script>

function show1(){
  document.getElementById('div1').style.display ='none';
}
function show2(){
  document.getElementById('div1').style.display = 'block';
}
</script>