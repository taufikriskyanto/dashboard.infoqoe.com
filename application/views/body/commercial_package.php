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
                  <?php if($flag === 'index'){?>
                        <a class="btn btn-tumblr" href="<?php echo base_url();?>facillity/add_sales_order_demo">
                        <img src="<?php echo base_url();?>assets/img/icons/baseline_note_add_white_18dp.png"> Tambah Sales Order Demo</a>
                  <?php }?>
                  </div>
                  <?php echo $this->session->flashdata("msg");?>
                  </div>
                  <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                      <thead>
                        <tr>
                          <th class="disabled-sorting text-left">Nomer</th>
                          <th class="disabled-sorting text-left">Tanggal</th>
                          <th class="disabled-sorting text-left">PIC</th>
                          <th class="disabled-sorting text-left">Kertas</th>
                          <th class="disabled-sorting text-left">Halaman</th>
                          <th class="disabled-sorting text-left">Set</th>
                          <th class="disabled-sorting text-left">Pekerjaan</th>
                          <th class="disabled-sorting text-left">Tagihan</th>
                          <!-- <th class="disabled-sorting text-left">SLA</th> -->
                          <?php if($flag === 'index'){?>
                          <th class="disabled-sorting text-center">Aksi</th>
                          <?php }else if ($flag === 'failed'){?>
                          <th class="disabled-sorting text-center">Alasan</th>
                          <th class="disabled-sorting text-center">Aksi</th> 
                          <?php }?>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr>
                          <th class="disabled-sorting text-left">Nomer</th>
                          <th class="disabled-sorting text-left">Tanggal</th>
                          <th class="disabled-sorting text-left">PIC</th>
                          <th class="disabled-sorting text-left">Kertas</th>
                          <th class="disabled-sorting text-left">Halaman</th>
                          <th class="disabled-sorting text-left">Set</th>
                          <th class="disabled-sorting text-left">Pekerjaan</th>
                          <th class="disabled-sorting text-left">Tagihan</th>
                          <!-- <th class="disabled-sorting text-left">SLA</th> -->
                          <?php if($flag === 'index'){?>
                          <th class="disabled-sorting text-center">Aksi</th>
                          <?php }else if ($flag === 'failed'){?>
                          <th class="disabled-sorting text-center">Alasan</th>
                          <th class="disabled-sorting text-center">Aksi</th> 
                          <?php }?>
                        </tr>
                      </tfoot>
                      <tbody>
					            <?php $no = 0; foreach($get_sales_order_demo as $row) : $no++;?>
                        <tr>
                            <td><?php echo $row->number_so;?></td>
                         	  <td><?php echo $row->incoming_date;?></td>
                          	<td><?php echo $row->name;?></td>
                            <td><?php echo $row->paper_size;?></td>
                         	  <td><?php echo $row->page;?></td>
                          	<td><?php echo $row->set_order;?></td>
                            <td><?php echo $row->job_name;?></td>
                            <td><?php echo $row->cost_center;?></td>
                            <!-- <td><?php echo $row->sla;?>   Jam</td> -->
                            <?php if($flag === 'index'){?>
                            <td class="text-right">
                            <a href="<?php echo base_url();?>facillity/edit_surat_order/<?php echo $row->id_surat_order;?>" class="btn btn-link btn-warning btn-just-icon edit"><img src="<?php echo base_url();?>assets/img/icons/baseline_dvr_black_18dp.png"></a>
                            <a href="<?php echo base_url();?>facillity/delete_surat_order/<?php echo $row->id_surat_order;?>" class="btn btn-link btn-danger btn-just-icon remove"><img src="<?php echo base_url();?>assets/img/icons/baseline_close_black_18dp.png"></a>
                            </td>
                            <?php }else if ($flag === 'failed'){?>
                            <td><?php echo $row->reason_reject;?></td>
                            <td class="text-right">
                            <a href="<?php echo base_url();?>facillity/confirm_reject/<?php echo $row->id_surat_order;?>" class="btn btn-link btn-warning btn-just-icon edit"><img src="<?php echo base_url();?>assets/img/icons/baseline_autorenew_black_18dp.png"></a>
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
