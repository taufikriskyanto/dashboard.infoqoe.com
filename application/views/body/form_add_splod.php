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
                    <h4 class="card-title">Form Customers</h4>
                  </div>
                </div>
                <div class="card-body ">
				        <form method="post" action="<?php echo base_url();?><?php echo $url;?>" class="form-horizontal">
				        <input type="hidden" class="form-control" name="id_log_summary_dnr_detail" value="<?php echo $id_log_summary_dnr_detail;?>">
                <input type="hidden" class="form-control" name="status" value="<?php echo $type;?>">
                    <div class="row">
                      <label class="col-sm-2 col-form-label">No. SPLOD</label>
                      <div class="col-sm-10">
                        <div class="form-group">
                          <input type="text" class="form-control" name="splod" placeholder="No. Splod" value="<?php echo $splod;?>" required>
                          <span class="bmd-help">Enter No. Splod</span>
                        </div>
                      </div>
                    </div>
                    
                    <div class="row">
                      <label class="col-sm-2 col-form-label">SLA</label>
                      <div class="col-sm-10">
                        <div class="form-group">
                          <input id="time" name="time" type="number" class="form-control"  oninput="myFunction()" required>
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
                    
                    <div class="row">
                      <label class="col-sm-2 col-form-label">Customer</label>
                      <div class="col-sm-10">
                        <div class="form-group">
                          <input type="text" class="form-control" name="customer"  value="<?php echo $customer;?>" readonly>
                          <!-- <span class="bmd-help">Enter No. Splod</span> -->
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <label class="col-sm-2 col-form-label">Produk</label>
                      <div class="col-sm-10">
                        <div class="form-group">
                          <input type="text" class="form-control" name="produk"  value="<?php echo $produk;?>" readonly>
                          <!-- <span class="bmd-help">Enter No. Splod</span> -->
                        </div>
                      </div>
                    </div>

					<div class="row">
                      <label class="col-sm-2 col-form-label">Cycle</label>
                      <div class="col-sm-10">
                        <div class="form-group">
                          <input type="text" class="form-control" name="cycle"  value="<?php echo $cycle;?>" readonly>
                          <!-- <span class="bmd-help">Enter No. Splod</span> -->
                        </div>
                      </div>
                    </div>

					<div class="row">
                      <label class="col-sm-2 col-form-label">Jumlah Kertas</label>
                      <div class="col-sm-10">
                        <div class="form-group">
                          <input type="text" class="form-control" name="total_pages"  value="<?php echo $total_pages;?>" readonly>
                          <!-- <span class="bmd-help">Enter No. Splod</span> -->
                        </div>
                      </div>
                    </div>

					<div class="row">
                      <label class="col-sm-2 col-form-label">Jumlah Amplop</label>
                      <div class="col-sm-10">
                        <div class="form-group">
                          <input type="text" class="form-control" name="total_envelop"  value="<?php echo $total_envelop;?>" readonly>
                          <!-- <span class="bmd-help">Enter No. Splod</span> -->
                        </div>
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

