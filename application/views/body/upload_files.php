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
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12">
                <div class="card card-plain">
                  <div class="card-header card-header-icon card-header-rose">
                    <div class="card-icon">
                      <i class="material-icons">assignment</i>
                    </div>
                    <h4 class="card-title mt-0"> Data Hold & Release</h4>
                    <p class="card-category"> List Data Hold & Release </p>
                  </div>
                  <div class="card-body">
                  <?php echo $this->session->flashdata("msg");?>
                    <div class="table-responsive">
                      <table class="table">
                        <thead class="">
                          <th>No</th>
                          <th>Name File</th>
                          <th>Info File</th>
                          <th>Cycle</th>
                          <th>Time Upload</th>
                          <th>Type Data</th>
                          <th>Actions</th>
                        </thead>
                        <tbody>
                        <?php $no = 0; foreach($get_file as $row) : $no++;?>
                          <tr>
                          <td><?php echo $no;?></td>
                         	  <td><?php echo $row->name_file;?></td>
                          	<td><?php echo $row->info_files;?></td>
                            <td><?php echo $row->cycle_file;?></td>
                            <td><?php echo $row->createdby;?></td>
                            <td><?php echo $row->type_data;?></td>
                            <td> 
                            <a href="<?php echo site_url('upload_files/download_file_pd/'.$row->id_file);?>"><img src="<?php echo base_url();?>assets/img/icons/baseline_vertical_align_bottom_black_18dp.png"></a>
                            <!-- <a href="" id="mybutton" data-id="<?php echo $row->id_file;?>" data-toggle="modal" data-target="#myModal10"><img src="<?php echo base_url();?>assets/img/icons/baseline_delete_black_18dp.png"></a> -->
                            <a href="<?php echo site_url('upload_files/delete_file/'.$row->id_file);?>" onclick="return confirm('Apakah Anda Ingin Menghapus Data <?=$row->name_file;?> ?');" data-popup="tooltip" data-placement="top" title="Hapus Data"><img src="<?php echo base_url();?>assets/img/icons/baseline_delete_black_18dp.png"></a>
                          </td>
                          </tr>
                          <?php endforeach;?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>


            <div class="row">
              <div class="col-md-12">
              <button class="btn btn-primary btn-round" data-toggle="modal" data-target="#myModal">
                       Kirim File
              </button>
              </div>
            </div>

          </div>
        </div>
      </div>
            <!-- end col-md-12 -->


                        <!-- Classic Modal -->
         <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title"></h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            <i class="material-icons">clear</i>
            </button>
            </div>
             <div class="modal-body">
             <form class="form-horizontal" method="post" action="<?php echo base_url();?><?php echo $save_data;?>" enctype='multipart/form-data'> 
            <p></p>

            <div class = "row">
            <div class = "col-sm-12">  
            <div class="form-group bmd-form-group is-filled">
                                <label class="label-control">Info File</label>
                                <input type="text" class="form-control" name="info_file" id="info_file" required>
                                <span class="material-input"></span>
                                <span class="material-input"></span>
            </div>
            </div>
            </div>

            <div class = "row">
            <div class = "col-sm-12"> 
            <div class="form-group bmd-form-group is-filled">
                                <label class="label-control">Cycle</label>
                                <input type="text" class="form-control datepicker" name="cycle_file" id="cycle_file" required>
                                <span class="material-input"></span>
                                <span class="material-input"></span>
            </div>
            </div>
            </div>

            <div class = "row">
            <div class = "col-sm-12"> 
            <div class="form-group bmd-form-group is-filled">
                <label class="label-control">Type Data</label>
                        <div class="form-check">
                          <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="type_data" id="type_data" value="Release" checked> Release
                            <span class="circle">
                              <span class="check"></span>
                            </span>
                          </label>
                        </div>
                        <div class="form-check">
                          <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="type_data" id="type_data" value="Hold"> Hold
                            <span class="circle">
                              <span class="check"></span>
                            </span>
                          </label>
                        </div>
            </div>
            </div>
            </div>


            <div class = "row">
            <div class = "col-sm-12"> 
            <input type="file" id="myfile" name="myfile" multiple>
            </div>
            </div>

            </div>
            <div class="modal-footer">
            <button type="submit" class="btn btn-info btn-link">Kirim File</button>
            <button type="button" class="btn btn-danger btn-link" data-dismiss="modal">Cancel</button>
             </div>
              </form>
            </div>
            </div>
        </div>
                      <!--  End Modal -->

        <div class="modal fade modal-mini modal-primary" id="myModal10" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-small">
            <div class="modal-content">
              
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></button>
              </div>
              <div class="modal-body">
              <p>Are you sure you want delete to do this?</p>
              </div>
              <div class="modal-footer justify-content-center">
              <!-- <input type="text" name="id_file" id="id_file" /> -->
              <button type="button" class="btn btn-link" data-dismiss="modal">No</button>
              <button type="button" id ="confirmbutton" class="btn btn-success btn-link">Yes
            <div class="ripple-container"></div>
            </button>
          </form>
          </div>
          </div>
        </div>
        </div>          
        

<script>
$('mybutton').click(function(){
    var ID = $(this).data('id');
    document.getElementById("id_file").innerHTML = ID; //set the data attribute on the modal button
});

$('#confirm-button').click(function(){
    var ID = $(this).data('id');
    $.ajax({
        url: "<?php echo base_url(); ?>upload_files/delete_file/" + ID
    });
});
</script>