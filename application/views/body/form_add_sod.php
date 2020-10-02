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
                    <h4 class="card-title">Form Surat Order</h4>
                  </div>
                </div>
                <div class="card-body ">
                
				  <!-- <form method="post" action="<?php echo base_url();?><?php echo $url;?>" class="form-horizontal">
				  <input type="hidden" class="form-control" name="id_log_summary_dnr_detail" value="<?php echo $id_log_summary_dnr_detail;?>"> -->
          <form method="post" class="form-horizontal" action="<?php echo base_url();?><?php echo $url;?>">
				  <input type="hidden" class="form-control" name="id_surat_order" value="<?php echo $id_surat_order;?>">
                    <div class="row">
                      <label class="col-sm-2 col-form-label label-checkbox" for="chkCustomer">SURAT ORDER SO -</label>
                      <div class="col-sm-10 checkbox-radios">
                      <div class="form-check form-check-inline">
                          <label class="form-check-label">
                            <input class="form-check-input" type="radio"  name="type_so" onclick="show1();" <?php if ($type_so == "Internal"){print "checked";}?>  value="Internal"> Internal
                            <span class="circle">
                              <span class="check"></span>
                            </span>
                          </label>
                        </div>
                        <div class="form-check form-check-inline">
                          <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="type_so" onclick="show2();" <?php if ($type_so === "Customer"){print "checked";}?> value="Customer" > Customer
                            <span class="circle">
                              <span class="check"></span>
                            </span>
                          </label>
                        </div>
                        <div class="form-check form-check-inline">
                          <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="type_so" onclick="show1();" <?php if ($type_so === "Demo"){print "checked";}?> value="Demo"> Demo
                            <span class="circle">
                              <span class="check"></span>
                            </span>
                          </label>
                        </div>
                        <div class="form-check form-check-inline">
                          <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="type_so" onclick="show1();" <?php if ($type_so === "Reprint"){print "checked";}?> value="Reprint" > Reprint
                            <span class="circle">
                              <span class="check"></span>
                            </span>
                          </label>
                        </div>
                        <!-- <div class="form-check form-check-inline">
                          <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="type_so" onclick="show1();" <?php if ($type_so === "External"){print "checked";}?> value="External" > External/Splod
                            <span class="circle">
                              <span class="check"></span>
                            </span>
                          </label>
                        </div> -->
                      </div>
                    </div>
                    <div class="row">
                      <label class="col-sm-2 col-form-label"></label>
                      <div class="col-sm-10" id="div1" style="display:none;">
                          <div class="form-group">
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
                    <!-- <div class="row" id="div1" style="display:none;">
                      <label class="col-sm-2 col-form-label">Customers</label>
                      <div class="col-lg-5 col-md-6 col-sm-3">
                        <select class="selectpicker" data-size="7" data-style="select-with-transition" title="Customer" name="customer_id" id="customer_id">
                        
                        <option value="" disabled diselected>-- Selected --</option>
                        <?php 
                          foreach($customer as $row)
                          { ?>
                          <option <?php if ($row->customer_id == $customer_id){echo 'selected="selected"';}?> value="<?php echo$row->customer_id?>"><?php echo $row->customer_name?></option>
                          <?php }?>
                        </select>
                      </div>
                    </div> -->
                    <div class="row">
                      <div class="col-md-6">
                        <h4 class="title">Data Pemberi Order</h4>
                      </div>
                    </div>
                    <div class="row">
                      <label class="col-sm-2 col-form-label label-checkbox">Pekerjaan</label>
                      <div class="col-sm-10 checkbox-radios">
                      <div class="form-check form-check-inline">
                          <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="job_type" <?php if ($job_type === "1"){print "checked";}?> value="1"> Printing & Finishing
                            <span class="circle">
                              <span class="check"></span>
                            </span>
                          </label>
                        </div>
                        <div class="form-check form-check-inline">
                          <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="job_type" <?php if ($job_type === "2"){print "checked";}?> value="2" > Finishing
                            <span class="circle">
                              <span class="check"></span>
                            </span>
                          </label>
                        </div>
                      </div>
                    </div>
                  <div class="row">
                      <label class="col-sm-2 col-form-label">Number SO / Splod</label>
                      <div class="col-sm-10">
                        <div class="form-group">
                          <input type="text" class="form-control" name="number_so" value="<?php echo $number_so;?>" required>
                          <span class="bmd-help">Enter Number SO</span>
                        </div>
                      </div>
                  </div>
                  <div class="row">
                      <label class="col-sm-2 col-form-label">Bagian / Dept / Div</label>
                      <div class="col-sm-10">
                        <div class="form-group">
                          <input type="text" class="form-control" name="job_dept" value="<?php echo $job_dept;?>" required>
                          <span class="bmd-help">Enter Name Dept</span>
                        </div>
                      </div>
                  </div>
                  <div class="row">
                      <label class="col-sm-2 col-form-label">Cost Center / Tangguhan Biaya</label>
                      <div class="col-sm-10">
                          <div class="form-group">
                          <input type="text" class="form-control" id="cost_center" name="cost_center"  value="<?php echo $cost_center;?>" required>
                          </div>
                      </div>
                  </div>
                    <div class="row">
                      <label class="col-sm-2 col-form-label">Nama Pekerjaan</label>
                      <div class="col-sm-10">
                        <div class="form-group">
                          <input type="text" class="form-control" name="job_name" id="job_name"  value="<?php echo $job_name;?>" required>
                           <span class="bmd-help">Enter Job Name</span>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <label class="col-sm-2 col-form-label">Ukuran Jadi Produk</label>
                      <div class="col-sm-3">
                        <select class="selectpicker" onchange="OpenTextField(this);" data-size="7" data-style="select-with-transition" title="Size" name="size" id="size" required>
                        <option value="" disabled diselected>-- Selected --</option>
                        
                          <option <?php if ($paper_size == 'A5'){echo 'selected="selected"';}?> value="A5">A5</option>
                          <option <?php if ($paper_size == 'A4'){echo 'selected="selected"';}?> value="A4">A4</option>
                          <option <?php if ($paper_size == 'A3'){echo 'selected="selected"';}?> value="A3">A3</option>
                          <option <?php if ($paper_size == 'SR A3'){echo 'selected="selected"';}?> value="SR A3">SR A3</option>
                          <option value="Custom">Custom</option>
                        </select>
                      </div>
                    </div>

                    <div class="row">
                      <label class="col-sm-2 col-form-label"></label>
                      <div class="col-sm-10" id="size_other" style="display:none;">
                          <div class="form-group">
                          <input type="text" class="form-control" id="other_size" name="other_size">
                          </div>
                      </div>
                  </div>

                    <div class="row">
                      <label class="col-sm-2 col-form-label">Jumlah Halaman / Lembar</label>
                      <div class="col-sm-10">
                        <div class="form-group">
                        <input type="text" class="form-control" name="page" id="page"  value="<?php echo $page;?>" onkeypress="return goodchars(event,'1234567890',this)" required>
                        <span class="bmd-help">Enter Page</span>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <label class="col-sm-2 col-form-label">Jumlah Set / Pcs</label>
                      <div class="col-sm-10">
                        <div class="form-group">
                        <input type="text" class="form-control" name="set" id="set"  value="<?php echo $set;?>" onkeypress="return goodchars(event,'1234567890',this)" required>
                        <span class="bmd-help">Enter Set</span>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <label class="col-sm-2 col-form-label">Target SLA</label>
                      <div class="col-sm-3">
                        <div class="form-group">
                        <input type="text" class="form-control" name="sla" id="sla"  value="<?php echo $sla;?>" onkeypress="return goodchars(event,'1234567890',this)" required>
                        <span class="bmd-help">Enter SLA (hours)</span>
                        </div>
                      </div>
                    </div>

                  </div>
                    <div class="card-footer ml-auto mr-auto">
                    <button type="submit" class="btn btn-info">Submit</button>
					          <a href="<?php echo base_url();?>facillity"  class="btn btn-info">Cancel</a>
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

<!--If option value other and then open input text-->
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