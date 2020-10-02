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
                  <div class="toolbar">
                  <div class="col-md-4 col-sm-5">
                        <a class="btn btn-tumblr" href="<?php echo base_url();?>customer/AddCustomer">
                        <img src="<?php echo base_url();?>assets/img/icons/baseline_person_add_white_18dp.png"> Tambah Data Customer
                        </a>
                  </div>
                  <?php echo $this->session->flashdata("msg");?>
                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                  </div>
                  <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                      <thead>
                        <tr>
                          <!-- <th>Nomer Urut</th> -->
                          <th>Customer Code</th>
                          <th>Customer Name</th>
                          <th>Customer Type</th>
                          <th>Date Creation</th>
                          <th class="disabled-sorting text-right">Actions</th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr>
                          <!-- <th>No</th> -->
                          <th>Customer Code</th>
                          <th>Customer Name</th>
                          <th>Customer Type</th>
                          <th>Date Creation</th>
                          <th class="text-right">Actions</th>
                        </tr>
                      </tfoot>
                      <tbody>
					            <?php $no = 0; foreach($view_get_customer as $row) : $no++;?>
                        <tr>
                          	<td><?php echo $row->customer_code;?></td>
                         	  <td><?php echo $row->customer_name;?></td>
                          	<td><?php echo $row->customer_type_name;?></td>
                          	<td><?php echo $row->date_creation;?></td>
                            <td class="text-right">
                            <a href="<?php echo base_url();?>customer/edit_customer/<?php echo $row->customer_id;?>" class="btn btn-link btn-warning btn-just-icon edit"><i class="material-icons">dvr</i></a>
                            <a href="<?php echo base_url();?>customer/delete_customer/<?php echo $row->customer_id;?>"" class="btn btn-link btn-danger btn-just-icon remove"><i class="material-icons">close</i></a>
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
