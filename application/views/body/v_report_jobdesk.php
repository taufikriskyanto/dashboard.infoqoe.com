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
                          <input id="splod" name="cycle_from" type="text" class="form-control datepicker" value = "<?php echo $cycle_from;?>" required>
                          <span class="bmd-help">Start Range Date</span>						  
                        </div>
                      </div>

                    <label class="col-sm-2 col-form-label">End Cycle Date</label>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <input id="splod" name="cycle_end" type="text" class="form-control datepicker" value="<?php echo $cycle_end;?>" required>
                          <span class="bmd-help">Finish Range Date</span>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <label class="col-sm-2 col-form-label">Product</label>
                      <div class="col-lg-5 col-md-6 col-sm-3">
                        <select class="selectpicker" data-size="7" data-style="select-with-transition" title="Product" name="product" id="product" required>
                        
                        <option value="" disabled diselected>-- Selected --</option>
                        <?php 
                          foreach($produk as $row)
                          { ?>
                          <option <?php if ($row->produk == $product){echo 'selected="selected"';}?> value="<?php echo$row->produk?>"><?php echo $row->produk?></option>
                          <?php }?>
                        </select>
                      </div>
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
                          <th class="disabled-sorting text-left">Product</th>
                          <th class="disabled-sorting text-left">Cycle</th>
                          <th class="disabled-sorting text-left">Pages</th>
                          <th class="disabled-sorting text-left">Envelop</th>
                          <th class="disabled-sorting text-left">Approval</th>
                          <th class="disabled-sorting text-left">Printing</th>
                          <th class="disabled-sorting text-left">Inserting</th>
                          <th class="disabled-sorting text-left">Balancing</th>
                          <th class="disabled-sorting text-left">Pick Up</th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr>
                          <th class="disabled-sorting text-left">Product</th>
                          <th class="disabled-sorting text-left">Cycle</th>
                          <th class="disabled-sorting text-left">Pages</th>
                          <th class="disabled-sorting text-left">Envelope</th>
                          <th class="disabled-sorting text-left">Approval</th>
                          <th class="disabled-sorting text-left">Printing</th>
                          <th class="disabled-sorting text-left">Inserting</th>
                          <th class="disabled-sorting text-left">Balancing</th>
                          <th class="disabled-sorting text-left">Pick Up</th>
                        </tr>
                      </tfoot>
                      <tbody>
					    <?php $no = 0; foreach($view_monitoring as $row) : $no++;?>
                        <tr>
                          <td><?php echo $row->produk;?></td>
                          <td><?php echo $row->cycle;?></td>
                          <td><?php echo $row->total_pages;?></td>
                          <td><?php echo $row->total_envelop;?></td>
                          <td><?php echo $row->date_approval_splod;?></td>
                          <td><?php echo $row->finish_printing;?></td>
                          <td><?php echo $row->finish_inserting;?></td>
                          <td><?php echo $row->finish_balancing;?></td>
                          <td><?php echo $row->finish_rtp;?></td>
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