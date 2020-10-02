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
        <?php if ($flag === 'UPLOAD SPLOD'){?>
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Approval Splod</h4>
              </div>
              <div class="card-body">
              <form method="post" action="<?php echo base_url();?><?php echo $finish_jobs;?>" class="form-horizontal">
                    <div class="row">
                      <label class="col-sm-2 col-form-label">Produk</label>
                      <div class="col-lg-6 col-md-6 col-sm-6">
                        <select class="selectpicker" data-style="select-with-transition" title="Produk" name="id_log_summary_dnr_detail" id="id_log_summary_dnr_detail">
                        <option value="" disabled diselected>-- Selected --</option>
                        <?php 
                          foreach($approval_jobs_many as $row)
                          { ?>
                          <option value="<?php echo$row->customer.'-'.$row->produk.'-'.$row->cycle?>"><?php echo $row->customer.'-'.$row->produk.'-'.$row->cycle?></option>
                          <?php }?>
                        </select>
                      </div>
                    </div>
                    <div class="row">
                      <label class="col-sm-2 col-form-label">Number Splod</label>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <input id="splod" name="splod" type="text" class="form-control" required>
                          <span class="bmd-help">Enter Splod Number</span>
                        </div>
                      </div>
                    </div>
                    
                    <div class="row">
                      <label class="col-sm-2 col-form-label">SLA </label>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <input id="time" name="time" type="number" class="form-control"  oninput="myFunction()" placeholder = "Date, MM DD YYYY Time">
                          <span class="bmd-help">Enter SLA in Hours</span>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <label class="col-sm-2 col-form-label">Finishing Time</label>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <p id="finish_time"></p>
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
              <h4 class="card-title">Kirim Splod</h4>
              </div>
              <div class="card-body">
            <form method="post" action="<?php echo base_url();?><?php echo $send_splod_printing;?>" class="form-horizontal">
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
        <?php } else { ?>
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Kirim Splod</h4>
              </div>
              <div class="card-body">
              <form method="post" action="<?php echo base_url();?><?php echo $update_splod;?>" class="form-horizontal">
                    <div class="row">
                      <label class="col-sm-4 col-form-label">Old Number Splod</label>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <input id="splod" name="oldsplod" type="text" class="form-control" required>
                          <span class="bmd-help">Enter Old Number</span>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <label class="col-sm-4 col-form-label">New Number Splod</label>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <input id="splod" name="newsplod" type="text" class="form-control" required>
                          <span class="bmd-help">Enter Old Number</span>
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
        <?php }?>
      </div> <!--PENUTUP ROW-->

        <!--  -->


        <div class="row">
        <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary card-header-icon">
                  <div class="card-icon">
                  <img src="<?php echo base_url();?>assets/img/icons/baseline_assignment_white_18dp.png">
                  </div>
                  <h4 class="card-title">Summary From D&R</h4>
                </div>
                <div class="card-body">
                  <div class="toolbar">
                    <?php echo $this->session->flashdata("msg");?>
                  </div>
                  <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                      <thead>
                        <tr>
                          <th class="disabled-sorting text-left">Customer Name</th>
                          <th class="disabled-sorting text-left">Produk</th>
                          <th>Cycle</th>
                          <th class="disabled-sorting text-left">Jumlah Kertas</th>
                          <th class="disabled-sorting text-left">Jumlah Amplop</th>
                          <th class="disabled-sorting text-left">Tanggal Proses</th>
                          <?php if($flag === 'UPLOAD SPLOD'){?>
                          <th class="disabled-sorting text-left">Kirim SPLOD</th>
                          <?php } else { ?>
                          <th class="disabled-sorting text-left">SPLOD</th>
                          <?php }?>
                          <th class="disabled-sorting text-left">Actions</th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr>
                          <th>Customer Name</th>
                          <th>Produk</th>
                          <th>Cycle</th>
                          <th>Jumlah Kertas</th>
                          <th>Jumlah Amplop</th>
                          <th>Tanggal Proses</th>
                          <?php if($flag === 'UPLOAD SPLOD'){?>
                          <th class="disabled-sorting text-left">Kirim SPLOD</th>
                          <?php } else { ?>
                          <th class="disabled-sorting text-left">SPLOD</th>
                          <?php }?>
                          <th class="text-left">Actions</th>
                        </tr>
                      </tfoot>
                      <tbody>
                      <?php $no = 0; foreach($view_get_dnr as $row) : $no++;?>
                      
                        <?php if($row->splod===""){
                        $tipeButton = 'btn btn-link btn-danger';
                        }else{
                        $tipeButton = 'btn btn-link btn-success';
                        }?>
                      
                        <tr>
                            <td><?php echo $row->customer;?></td>
                            <td><?php echo $row->produk;?></td>
                          	<td><?php echo $row->cycle;?></td>
                            <td><?php echo $row->total_pages;?></td>
                            <td><?php echo $row->total_envelop;?></td>
                            <td><?php echo $row->date_proccess;?></td>
                            <?php if($flag === 'UPLOAD SPLOD'){?>
                            <td>
                            <a href="<?php echo base_url();?>upload_log_dnr/send_splod/<?php echo $row->id_log_summary_dnr_detail;?>" class="<?php echo $tipeButton ?>">Kirim</a>
                            </td>
                            <td class="text-left">
                            <a href="<?php echo base_url();?>upload_log_dnr/form_tambah_splod/<?php echo $row->id_log_summary_dnr_detail;?>"><img src="<?php echo base_url();?>assets/img/icons/baseline_edit_black_18dp.png"></a>
                            </td>
                            <?php } else { ?>
                            <td><?php echo $row->splod;?></td>
                            <td class="text-left">
                            <a href="<?php echo base_url();?>upload_log_dnr/form_tambah_splod/<?php echo $row->id_log_summary_dnr_detail;?>"><img src="<?php echo base_url();?>assets/img/icons/baseline_edit_black_18dp.png"></a>
                            </td>
                            <?php }?>
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
		  </div>

<script>
function myFunction() {
  var x = document.getElementById("time").value;
  // var dt = new Date();
  // dt.setHours(dt.getHours() + x);
  // var dd = dt.getDate();
  // var mm = dt.getMonth()+1; //January is 0!
  // var yyyy = dt.getFullYear();
  var now = new Date();
  var next = AddMinutesToDate(now,x);
  document.getElementById("finish_time").innerHTML = "Finish at : " + next;
}

function AddMinutesToDate(date, minutes) {
     return new Date(date.getTime() + minutes*3600000);
}
function DateFormat(date){
  var days = date.getDate();
  var year = date.getFullYear();
  var month = (date.getMonth()+1);
  var hours = date.getHours();
  var minutes = date.getMinutes();
  minutes = minutes < 10 ? '0' + minutes : minutes;
  var strTime = days + '/' + month + '/' + year + '/ '+hours + ':' + minutes;
  return strTime;
}

// console.log(DateFormat(next));
//console.log(DateFormat(now));
</script>