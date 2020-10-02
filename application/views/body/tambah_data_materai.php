                        <!-- Classic Modal -->
                        <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title"></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            <i class="material-icons">clear</i>
                            </button>
                        </div>
                    <div class="modal-body">
                    <form class="form-horizontal" method="post" action="<?php echo base_url();?><?php echo $add_materai;?>" enctype='multipart/form-data'> 
                    <p></p>

                    <div class="row">
                        <div class = "col-sm-6"> 
                            <div class="form-group bmd-form-group is-filled">
                                    <label class="label-control">Mesin Materai</label>
                            <select class="selectpicker" data-size="7" data-style="select-with-transition" title="Select One" name="mesin" id="mesin" required>
                            
                            <!--<option value="" disabled diselected>-- Select One --</option>-->
                            <?php 
                            foreach($mesin as $row)
                            { ?>
                            <option value="<?php echo$row->id_mesin?>"><?php echo $row->nama_mesin?></option>
                            <?php }?>
                            </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class = "row">
                        <div class = "col-sm-12"> 
                            <div class="form-group bmd-form-group is-filled">
                                    <label class="label-control">Tanggal Materai</label>
                                    <input type="text" class="form-control datepicker" name="cycle_materai" id="cycle_materai" required>
                                    <span class="material-input"></span>
                                    <span class="material-input"></span>
                            </div>
                        </div>
                    </div>

                    <div class = "row">
                        <div class = "col-sm-12">  
                            <div class="form-group bmd-form-group is-filled">
                                                <label class="label-control">Cycle</label>
                                                <input type="text" class="form-control" name="cycle" id="cycle" required>
                                                <span class="material-input"></span>
                                                <span class="material-input"></span>
                            </div>
                        </div>
                    </div>


                    <div class = "row">
                        <div class = "col-sm-12">  
                            <div class="form-group bmd-form-group is-filled">
                                                <label class="label-control">No. Akhir</label>
                                                <input type="number" class="form-control" name="no_akhir" id="no_akhir" required>
                                                <span class="material-input"></span>
                                                <span class="material-input"></span>
                            </div>
                        </div>
                    </div>

                    <div class = "row">
                        <div class = "col-sm-12">  
                            <div class="form-group bmd-form-group is-filled">
                                                <label class="label-control">Top Up</label>
                                                <input type="text" class="form-control" name="top_up" id="top_up" >
                                                <span class="material-input"></span>
                                                <span class="material-input"></span>
                            </div>
                        </div>
                    </div>

                    <div class = "row">
                        <div class = "col-sm-12">  
                            <div class="form-group bmd-form-group is-filled">
                                                <label class="label-control">Keterangan Tambahan</label>
                                                <input type="text" class="form-control" name="keterangan" id="keterangan" maxlength="150">
                                                <span class="bmd-help">Maximum description of 150 characters</span>
                                                <!--<span class="material-input"></span>-->
                            </div>
                        </div>
                    </div>


                    
                    </div>
                        <div class="modal-footer">
                        <button type="submit" onclick="return confirm('Apakah data yang dimasukan sudah benar  ?');" data-popup="tooltip" data-placement="top" title="Konfirmasi Data" class="btn btn-info btn-link">Kirim File</button>
                        <button type="button" class="btn btn-danger btn-link" data-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                    </div>
                </div>
        </div>
                      <!--  End Modal -->
                      
                      
        <script type="text/javascript">
		
    var top_up = document.getElementById('top_up');
    top_up.addEventListener('keyup', function(e)
    {
        top_up.value = formatRupiah(this.value);
    });
    
    function formatRupiah(angka, prefix)
    {
  var number_string = angka.replace(/[^,\d]/g, "").toString(),
    split = number_string.split(","),
    sisa = split[0].length % 3,
    rupiah = split[0].substr(0, sisa),
    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

  // tambahkan titik jika yang di input sudah menjadi angka ribuan
  if (ribuan) {
    separator = sisa ? "." : "";
    rupiah += separator + ribuan.join(".");
  }

  rupiah = split[1] != undefined ? rupiah + "." + split[1] : rupiah;
  return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
    }
 	</script>