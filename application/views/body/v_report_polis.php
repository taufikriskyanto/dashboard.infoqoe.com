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
                  <img src="<?php echo base_url();?>assets/img/icons/baseline_portrait_white_18dp.png">
                  </div>
                  <h4 class="card-title">Customer</h4>
                </div>
                <div class="card-body">
                <form method="post" action="<?php echo base_url();?><?php echo $flag;?>" class="form-horizontal">
                    <div class="row">
                    <label class="col-sm-2 col-form-label">Start Cycle Date</label>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <input id="cycle_from" name="cycle_from" type="text" class="form-control datepicker" value = "<?php echo $cycle_from;?>" >
                          <span class="bmd-help">Start Range Date</span>						  
                        </div>
                      </div>
                    <!-- </div>
                    <div class="row"> -->
                    <label class="col-sm-2 col-form-label">End Cycle Date</label>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <input id="cycle_end" name="cycle_end" type="text" class="form-control datepicker" value="<?php echo $cycle_end;?>" >
                          <span class="bmd-help">Finish Range Date</span>
                        </div>
                      </div>
                    </div>

                  <!--<div class="row">-->
                  <!--  <label class="col-sm-2 col-form-label">Start Issued Date</label>-->
                  <!--    <div class="col-sm-4">-->
                  <!--      <div class="form-group">-->
                  <!--        <input id="splod" name="issued_from" type="text" class="form-control datepicker" value="<?php echo $issued_from;?>" >-->
                  <!--        <span class="bmd-help">Start Range Date</span>-->
                  <!--      </div>-->
                  <!--    </div>-->
                    <!-- </div>
                   <div class="row"> -->
                  <!--  <label class="col-sm-2 col-form-label">End Issued Date</label>-->
                  <!--    <div class="col-sm-4">-->
                  <!--      <div class="form-group">-->
                  <!--        <input id="splod" name="issued_end" type="text" class="form-control datepicker" value="<?php echo $issued_end;?>" >-->
                  <!--        <span class="bmd-help">Finish Range Date</span>-->
                  <!--      </div>-->
                  <!--    </div>-->
                  <!--  </div>-->

                  <div class="row">
                    <label class="col-sm-2 col-form-label">Agency Code</label>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <input id="agency_code" name="agency_code" type="text" class="form-control" value="<?php echo $agency_code;?>">
                          <span class="bmd-help">Input Agency Code</span>
                        </div>
                      </div>
                    <!-- </div>
                    <div class="row"> -->
                    <label class="col-sm-2 col-form-label">Product</label>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <input id="product" name="product" type="text" class="form-control" value="<?php echo $product;?>" >
                          <span class="bmd-help">Input Product</span>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                    <label class="col-sm-2 col-form-label">Delivery Options</label>
                    <div class="col-sm-4">
                      <select class="selectpicker" data-size="7" data-style="select-with-transition" title="SELECTED" name="delivery_option" id="delivery_option">
                        <option value="" disabled diselected>-- Selected --</option>
                        <option <?php if ($delivery_option == ''){echo 'selected="selected"';}?> value="">ALL</option>
                        <option <?php if ($delivery_option == 'S'){echo 'selected="selected"';}?> value="S">S</option>
                        <option <?php if ($delivery_option == 'C'){echo 'selected="selected"';}?> value="C">C</option>
                        <!-- <option value="">All</option>
                        <option value="S">S</option>
                        <option value="C">C</option> -->
                        </select>
                      </div>
                    <!-- </div>

                    <div class="row"> -->
                    <label class="col-sm-2 col-form-label">E-policy Flag</label>
                    <div class="col-sm-4">
                      <select class="selectpicker" data-size="7" data-style="select-with-transition" title="SELECTED" name="policy" id="policy">
                        <option value="" disabled diselected>-- Selected --</option>
                        <option <?php if ($policy == ''){echo 'selected="selected"';}?> value="">ALL</option>
                        <option <?php if ($policy == 'Y'){echo 'selected="selected"';}?> value="Y">Y</option>
                        <option <?php if ($policy == 'N'){echo 'selected="selected"';}?> value="N">N</option>
                        <!-- <option value="">All</option>
                        <option value="Y">Y</option>
                        <option value="N">N</option> -->
                        </select>
                      </div>
                    </div>
                    
                    <div class="row">
                     <label class="col-sm-2 col-form-label">Manifest Type</label>
                    <div class="col-sm-4">
                      <select class="selectpicker" data-size="7" data-style="select-with-transition" title="SELECTED" name="manifes" id="manifes">
                        <option value="" disabled diselected>-- Selected --</option>
                        <option <?php if ($manifes == ''){echo 'selected="selected"';}?> value="">ALL</option>
                        <option <?php if ($manifes == 'H'){echo 'selected="selected"';}?> value="H">H</option>
                        <option <?php if ($manifes == 'C'){echo 'selected="selected"';}?> value="C">C</option>
                        <option <?php if ($manifes == 'D'){echo 'selected="selected"';}?> value="D">D</option>
                        <option <?php if ($manifes == 'R'){echo 'selected="selected"';}?> value="R">R</option>
                    
                        </select>
                      </div>
                      
                    <label class="col-sm-2 col-form-label">Vendor</label>
                    <div class="col-sm-4">
                      <select class="selectpicker" data-size="7" data-style="select-with-transition" title="SELECTED" name="vendor" id="vendor">
                        <option value="" disabled diselected>-- Selected --</option>
                        <option <?php if ($vendor == ''){echo 'selected="selected"';}?> value="">ALL</option>
                        <option <?php if ($vendor == 'JKT'){echo 'selected="selected"';}?> value="JKT">JKT</option>
                        <option <?php if ($vendor == 'SBY'){echo 'selected="selected"';}?> value="SBY">SBY</option>
                        <!-- <option value="">All</option>
                        <option value="Y">Y</option>
                        <option value="N">N</option> -->
                        </select>
                      </div>
                    </div>
                    
                    <div class="row">
                    <label class="col-sm-2 col-form-label">Kartu HS</label>
                    <div class="col-sm-4">
                      <select class="selectpicker" data-size="7" data-style="select-with-transition" title="SELECTED" name="kartu_hs" id="kartu_hs">
                        <option value="" disabled diselected>-- Selected --</option>
                        <option <?php if ($kartu_hs == ''){echo 'selected="selected"';}?> value="">ALL</option>
                        <option <?php if ($kartu_hs == 'ADM'){echo 'selected="selected"';}?> value="ADM">ADM</option>
                        <option <?php if ($kartu_hs == 'SOS'){echo 'selected="selected"';}?> value="SOS">SOS</option>
                        <option <?php if ($kartu_hs == 'PMN'){echo 'selected="selected"';}?> value="PMN">PMN</option>
                        <option <?php if ($kartu_hs == 'GAH'){echo 'selected="selected"';}?> value="GAH">GAH</option>
                        <!-- <option value="">All</option>
                        <option value="S">S</option>
                        <option value="C">C</option> -->
                        </select>
                      </div>
                    <!-- </div>

                    <div class="row"> -->
                    <label class="col-sm-2 col-form-label">Kartu GAH</label>
                    <div class="col-sm-4">
                      <select class="selectpicker" data-size="7" data-style="select-with-transition" title="SELECTED" name="kartu_gah" id="kartu_gah">
                        <option value="" disabled diselected>-- Selected --</option>
                        <option <?php if ($kartu_gah == ''){echo 'selected="selected"';}?> value="">ALL</option>
                        <option <?php if ($kartu_gah == 'Y'){echo 'selected="selected"';}?> value="Y">Y</option>
                        <option <?php if ($kartu_gah == 'N'){echo 'selected="selected"';}?> value="N">N</option>
                        <!-- <option value="">All</option>
                        <option value="Y">Y</option>
                        <option value="N">N</option> -->
                        </select>
                      </div>
                    </div>
                    
                    
                    <div class="row">
                    <label class="col-sm-2 col-form-label">Channel</label>
                    <div class="col-sm-4">
                      <select class="selectpicker" data-size="7" data-style="select-with-transition" title="SELECTED" name="channels" id="channels">
                        <option value="" disabled diselected>-- Selected --</option>
                        <option <?php if ($channels == ''){echo 'selected="selected"';}?> value="">ALL</option>
                        <option <?php if ($channels == 'AG'){echo 'selected="selected"';}?> value="AG">AG</option>
                        <option <?php if ($channels == 'BA'){echo 'selected="selected"';}?> value="BA">BA</option>
                        <option <?php if ($channels == 'BC'){echo 'selected="selected"';}?> value="BC">BC</option>
                        <option <?php if ($channels == 'IC'){echo 'selected="selected"';}?> value="IC">IC</option>
                        <option <?php if ($channels == 'ST'){echo 'selected="selected"';}?> value="ST">ST</option>
                        <option <?php if ($channels == 'UB'){echo 'selected="selected"';}?> value="UB">UB</option>
                        <!-- <option value="">All</option>
                        
                        
                        <option value="S">S</option>
                        <option value="C">C</option> -->
                        </select>
                      </div>
                    <!-- </div>

                    <div class="row"> -->
                    <!--<label class="col-sm-2 col-form-label">Kartu GAH</label>-->
                    <!--<div class="col-sm-4">-->
                    <!--  <select class="selectpicker" data-size="7" data-style="select-with-transition" title="SELECTED" name="kartu_gah" id="kartu_gah">-->
                    <!--    <option value="" disabled diselected>-- Selected --</option>-->
                    <!--    <option <?php if ($kartu_gah == ''){echo 'selected="selected"';}?> value="">ALL</option>-->
                    <!--    <option <?php if ($kartu_gah == 'Y'){echo 'selected="selected"';}?> value="Y">Y</option>-->
                    <!--    <option <?php if ($kartu_gah == 'N'){echo 'selected="selected"';}?> value="N">N</option>-->
                        <!-- <option value="">All</option>
                    <!--    <option value="Y">Y</option>-->
                    <!--    <option value="N">N</option> -->
                    <!--    </select>-->
                    <!--  </div>-->
                    </div>
                    
                    <div class="row">
                    <div class="card-footer ml-auto mr-auto">
                    <button type="submit" name = "submitform" value="formNoExcel" class="btn btn-info">Search</button>
                    <button type="submit" name = "submitform" value="formExcel"   class="btn btn-info">Download</button>
                  </div>         
                  </div>
                  </form>     
                  
                  <div class="toolbar">
                  <div class="col-md-4 col-sm-5">
                  </div>
                  <?php echo $this->session->flashdata("msg");?>
                  </div>
                  <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                      <thead>
                        <tr>
                          <th class="disabled-sorting text-left">Customer</th>
                          <th class="disabled-sorting text-left">Produk</th>
                          <th class="disabled-sorting text-left">Polis</th>
                          <th class="disabled-sorting text-left">Cycle</th>
                          <th class="disabled-sorting text-left">Tanggal Proses</th>
                          <th class="disabled-sorting text-left">Agency</th>
                          <th class="disabled-sorting text-left">Delivery Option</th>
                          <th class="disabled-sorting text-left">Manifest</th>
                          <th class="disabled-sorting text-left">Remarks</th>
                          <th class="disabled-sorting text-left">Date</th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr>
                          <th class="disabled-sorting text-left">Customer</th>
                          <th class="disabled-sorting text-left">Produk</th>
                          <th class="disabled-sorting text-left">Polis</th>
                          <th class="disabled-sorting text-left">Cycle</th>
                          <th class="disabled-sorting text-left">Tanggal Proses</th>
                          <th class="disabled-sorting text-left">Agency</th>
                          <th class="disabled-sorting text-left">Delivery Option</th>
                          <th class="disabled-sorting text-left">Manifest</th>
                          <th class="disabled-sorting text-left">Remarks</th>
                          <th class="disabled-sorting text-left">Date</th>
                        </tr>
                      </tfoot>
                      <tbody>
					    <?php $no = 0; foreach($view_monitoring as $row) : $no++;?>
                        <tr>
                          <td><?php echo $row->customer;?></td>
                          <td><?php echo $row->produk;?></td>
                          <td><?php echo $row->no_polis;?></td>
                          <td><?php echo $row->cycle;?></td>
                          <td><?php echo $row->proses_date;?></td>
                          <td><?php echo $row->kode_agency;?></td>
                          <td><?php echo $row->delivery_option;?></td>
                          <td><?php echo $row->manifest;?></td>
                          <td><?php echo $row->remarks;?></td>
                          <td><?php echo $row->tgl_proses;?></td>
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
var paper_size        = '<?php echo $paper_size; ?>';
function OpenTextField(that) {
    if (that.value == "Custom") {
        document.getElementById("size_other").style.display = "block";
    } else {
        document.getElementById("size_other").style.display = "none";
    }
}
function show1(){
  document.getElementById('div1').style.display ='none';
}
function show2(){
  document.getElementById('div1').style.display = 'block';
}
</script>