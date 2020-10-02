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

                    </div>
                    <div class="card-footer ml-auto mr-auto">
                    <button type="submit" class="btn btn-info">Submit</button>
                  </div>
              </form>
              </div>
			</div>
			




      </div>
      <!-- PENUTUP ROW-->

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
                          <th class="disabled-sorting text-left">Nama Mesin</th>
                          <th class="disabled-sorting text-left">Tanggal Materai</th>
                          <th class="disabled-sorting text-left">Cycle</th>
                          <th class="disabled-sorting text-left">Jumlah Polis</th>
                          <th class="disabled-sorting text-left">Terpakai</th>
                          <th class="disabled-sorting text-center">No Awal</th>
                          <th class="disabled-sorting text-center">No Akhir</th>
                          <th class="disabled-sorting text-center">Sisa Saldo</th>
                          <th class="disabled-sorting text-center">Top up</th>
                          <th class="disabled-sorting text-center">Saldo & Top up</th>
                          <th class="disabled-sorting text-center">Keterangan</th>
                          <th class="disabled-sorting text-center">Actions</th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr>
						  <th>No</th>
                          <th>Nama Mesin</th>
                          <th>Tanggal Materai</th>
                          <th>Cycle</th>
                          <th>Jumlah Polis</th>
                          <th>Terpakai</th>
                          <th>No Awal</th>
                          <th>No Akhir</th>
                          <th>Sisa Saldo</th>
                          <th>Top up</th>
                          <th>Saldo & Top up</th>
                          <th>Keterangan</th>
                          <th class="disabled-sorting text-center">Actions</th>
                        </tr>
                      </tfoot>
                      <tbody>
                        <?php
                        $sisa_saldo_sebelum = 0;
                       
                               
                        ?>
                       <?php $no = 0; foreach($get_data_materai as $row) : $no++;?>
                        <tr>
                            <?php
                                $jumlah = $row->no_akhir - $row->no_awal;
                                
                            ?>
                            <td><?php echo $no;?></td>
                         	  <td><?php echo $row->nama_mesin;?></td>
                          	<td><?php echo $row->tanggal_materai;?></td>
                            <td><?php echo $row->cycle;?></td>
                            <td><?php echo $jumlah;?></td>
                            <td><?php echo number_format($row->jumlah_terpakai, 0, ".", ".");?></td>
                            <td><?php echo $row->no_awal;?></td>
                            <td><?php echo $row->no_akhir;?></td>
                            <td><?php echo number_format($row->saldo, 0, ".", ".");?></td>
                            <td><?php echo number_format($row->top_up, 0, ".", ".");?></td>
                            <td><?php echo number_format($row->saldo_top_up, 0, ".", ".");?></td>
                            <td><?php echo $row->keterangan;?></td>
                            <td class="text-center">
                            <!--<a href="<?php echo base_url();?><?php echo $row->path_file;?>/<?php echo $row->name_file;?>"><img src="<?php echo base_url();?>assets/img/icons/baseline_vertical_align_bottom_black_18dp.png"></a>-->
                            <a href="<?php echo site_url('materai/delete_materai/'.$row->id_materai); ?>" onclick="return confirm('Apakah Anda Ingin Menghapus Data <?=$row->tanggal_materai;?> ?');" data-popup="tooltip" data-placement="top" title="Hapus Data"><img src="<?php echo base_url();?>assets/img/icons/baseline_delete_black_18dp.png"></a>
                        </td>
                        </tr>
                        <?php
                                $jumlah = $row->no_akhir - $row->no_awal;
                                $saldo = $sisa_saldo_sebelum + $row->top_up;
                        ?>
                        <?php endforeach;?>
                      </tbody>
                    </table>
                  </div>
                </div>
                <!-- end content-->

                    <div class="row">
                            <div class="col-md-2">
                            <button class="btn btn-primary btn-round" data-toggle="modal" data-target="#myModal">
                                    Add Mesin
                            </button>
                            </div>
                            <div class="col-md-2">
                            <button class="btn btn-primary btn-round" data-toggle="modal" data-target="#myModal2">
                                    Add Materai
                            </button>
                            </div>
                    </div>
              </div>
              <!--  end card  -->
            </div>
            <!-- end col-md-12 -->
            </div>
            <!-- end col-md-12 -->
          </div>

<?php include('tambah_data_materai.php');?>
<?php include('tambah_data_mesin.php');?>