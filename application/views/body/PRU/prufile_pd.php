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
                    <i class="material-icons">file_download</i>
                  </div>
                  <h4 class="card-title">Download File PD</h4>
                </div>
                <div class="card-body">
                    <form method="post" action="<?php echo base_url();?><?php echo $search;?>" class="form-horizontal">
                    <div class="row">
                    <label class="col-sm-3 col-form-label">Cycle Date</label>
                      <div class="col-sm-2">
                        <div class="form-group">
                          <input id="splod" name="cycle" type="text" class="form-control datepicker" value = "<?php echo $cycle;?>" required>
                          <span class="bmd-help">Start Range Date</span>						  
                        </div>
                      </div>

                      <label class="col-sm-2 col-form-label">Vendor</label>
                      <div class="col-lg-5 col-md-6 col-sm-3">
                      <select class="selectpicker" data-size="7" data-style="select-with-transition" title="SELECTED" name="vendor" id="vendor">
                        <option value="" disabled diselected>-- Selected --</option>
                        <option <?php if ($vendor == ''){echo 'selected="selected"';}?> value="">ALL</option>
                        <option <?php if ($vendor == 'JKT'){echo 'selected="selected"';}?> value="JKT">JKT</option>
                        <option <?php if ($vendor == 'SBY'){echo 'selected="selected"';}?> value="SBY">SBY</option>
                        </select>
                      </div>
                    </div>



                    <div class="row">
                    <div class="card-footer ml-auto mr-auto">
                    <button type="submit" name = "submitform" value="formNoExcel" class="btn btn-info">Search</button>
                    <!--<button type="submit" name = "submitform" value="formExcel"   class="btn btn-info">Download</button>-->
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
                          <th class="disabled-sorting text-left">Nama File</th>
                          <th class="disabled-sorting text-left">Cycle</th>
                          <th class="disabled-sorting text-left">Date Process</th>
                          <th class="disabled-sorting text-left">Vendor</th>
                          <th class="disabled-sorting text-left">Action</th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr>                          
                        <th class="disabled-sorting text-left">Nama File</th>
                        <th class="disabled-sorting text-left">Cycle</th>
                        <th class="disabled-sorting text-left">Date Process</th>
                        <th class="disabled-sorting text-left">Vendor</th>
                        <th class="disabled-sorting text-left">Action</th>
                        </tr>
                      </tfoot>
                      <tbody>
					    <?php $no = 0; foreach($get_file as $row) : $no++;?>
                        <tr>
                          <td><?php echo $row->nama_file;?></td>
                          <td><?php echo $row->cycle_file;?></td>
                          <td><?php echo $row->date_process;?></td>
                          <td><?php echo $row->vendor;?></td>
                          <td>
                              <a href="<?php echo base_url();?><?php echo $row->path;?><?php echo $row->nama_file;?>"><img src="<?php echo base_url();?>assets/img/icons/baseline_vertical_align_bottom_black_18dp.png"></a>
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