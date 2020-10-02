<!DOCTYPE html>
<html lang="en">
<style type="text/css">
.parent ~ .cchild {
  display: none;
}
.open .parent ~ .cchild {
  display: table-row;
}
.parent {
  cursor: pointer;
}
tbody {
  color: #212121;
}
.open {
  background-color: #e6e6e6;
}

.open .cchild {
  background-color: #999;
  color: white;
}
.parent > *:last-child {
  width: 30px;
}
.parent i {
  transform: rotate(0deg);
  transition: transform .3s cubic-bezier(.4,0,.2,1);
  margin: -.5rem;
  padding: .5rem;
 
}
.open .parent i {
  transform: rotate(180deg)
}
</style>
<head>
  <meta charset="utf-8" />
  <link rel="icon" href="<?php echo base_url(); ?>assets/images/logo_axi_login.png">
  <link rel="icon" type="image/png" href="<?php echo base_url();?>assets/images/logo_axi_login.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Dashboard Monitoring AXI
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="<?php echo base_url(); ?>assets/css/material-dashboard.min.css?v=2.1.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="<?php echo base_url(); ?>assets/demo/demo.css" rel="stylesheet" />
  <!-- Google Tag Manager -->
  <script>
    (function(w, d, s, l, i) {
      w[l] = w[l] || [];
      w[l].push({
        'gtm.start': new Date().getTime(),
        event: 'gtm.js'
      });
      var f = d.getElementsByTagName(s)[0],
        j = d.createElement(s),
        dl = l != 'dataLayer' ? '&l=' + l : '';
      j.async = true;
      j.src =
        'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
      f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', 'GTM-NKDMSK6');
  </script>
  <!-- End Google Tag Manager -->
</head>
<body>


<!-- <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-minimize">
              <button id="minimizeSidebar" class="btn btn-just-icon btn-white btn-fab btn-round">
                <i class="material-icons text_align-center visible-on-sidebar-regular">more_vert</i>
                <i class="material-icons design_bullet-list-67 visible-on-sidebar-mini">view_list</i>
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
        </div>
      </nav> -->
      <!--End Navbar-->
      <div class="content">
        <div class="container-fluid">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header card-header-icon card-header-rose">
                    <div class="card-icon">
                      <i class="material-icons">assignment</i>
                    </div>
                    <h4 class="card-title ">Monitoring</h4>
                  </div>
                  <div class="card-body table-full-width table-hover">
                  <Marquee direction="up" scrollamount="2" height="500px" width="100%" onmouseover="this.stop();" onmouseout="this.start();">
                    <div class="table-responsive">
                      <table class="table">
                        <thead class=" text-primary">
                        <th>Surat Order</th>
                        <th>Pekerjaan</th>
                        <th>Pemberi Order</th>
                        <th>Ukuran</th>
                        <th>Halaman</th>
                        <th>Set</th>
                        <th>Kedatangan</th>
                        <th>Printing</th>
                        <th>Finishing</th>
                        <th>Status</th>	
                        <th>Tanggal SLA</th>	
                        </thead>                        
                        <tbody>              
                      <?php $no = 0; foreach($view_monitoring_facillity as $row) : $no++;?>
                      <?php 
                      if($row->status === 3){
                        $time = $row->at_last;
                      }else{
                        $time = date('Y-m-d H:i:s');
                      }
                      $incoming_date =  $row->incoming_date;
                      $sla =  $row->sla;
                      $awal  = strtotime($incoming_date);
                      $akhir = strtotime($time);
                      $diff  = $akhir - $awal;

                      $jam   = round($diff / (60 * 60),2);
                      $persen = ($jam/$sla)*100;
                      $temp = ((float)number_format($jam, 2) + 0);
                     
                      // echo $persen;
                      if($persen<90){
                      echo "<tr class='table-success'>";  
                      }else if($persen>= 90 && $persen <=100){
                      echo "<tr class='table-warning'>";  
                      }else if($persen>100){
                      echo "<tr class='table-danger'>";
                      }
                     
                    
                      ?>
                        <td><?php echo $row->type_surat_order;?></td>
                        <td><?php echo $row->job_name;?></td>
                        <td><?php echo $row->name;?></td>
                        <td><?php echo $row->paper_size;?></td>
                        <td><?php echo $row->page;?></td>
                        <td><?php echo $row->set_order;?></td>
                        <td><?php echo $row->incoming_date;?></td>
                        <?php
                        if($row->status_printing==='done'){
                          ?>
                        <td align="center"><img src="<?php echo base_url();?>assets\images\check.png" width="14" height="14"><br/><?php echo $row->printing_date;?></td>
                      <?php
                        }else if($row->status_printing==='waiting'){
                        ?>
                        <td align="center"><img src="<?php echo base_url();?>assets\images\cross.png" width="14" height="14"><br/><?php echo $row->printing_date;?></td>
                        <?php
                        }else{
                          ?>
                          <td></td>
                          <?php
                          }?>
                        <?php
                        if($row->status_finishing==='done'){
                          ?>
                        <td align="center"><img src="<?php echo base_url();?>assets\images\check.png" width="14" height="14"><br/><?php echo $row->finishing_date;?></td>
                      <?php
                        }else{
                        ?>
                        <td></td>
                        <?php
                        }?>
                        <?php
                        $diff2  = $akhir - $awal; 
                        $status   = round($diff2 / (60 * 60),2);
                        // echo $jam;
                        $meet_sla = ($status)/$sla;
                        if($meet_sla <= 1){
                        ?>
                        <td>Success</td>
                        <?php
                        }else {
                          
                        ?>
                        <td>Fail</td>
                        <?php
                        }
                        ?>
                        <?php 
                        $tanggal_sla = date_create($incoming_date);
                        $convert = strval($sla).' hours';
                        date_add($tanggal_sla,date_interval_create_from_date_string($convert));
                        $tggl_sla = date_format($tanggal_sla,'Y-m-d H:i:s');?>
                      
                        <td><?php echo $tggl_sla;?></td>
                      </tr>
                      <?php endforeach;?>
                      </tbody>
                  </table>
                 
                  </div>
                  </Marquee>
                </div>
                <!-- end content-->
              </div>
              <!--  end card  -->
            </div>
            <!-- end col-md-12 -->
            </div>
            <!-- end col-md-12 -->
          </div>

</body>

<script>
$(document).ready(function()
{
    refresh();
});

function refresh()
{
    setTimeout(function()
    {
        $('#table_monitoring').load('<?php echo base_url();?>view_monitoring');
        refresh();
    }, 1000);
}

$("a[id^=show_]").click(function(event) {
    $("#extra_" + $(this).attr('id').substr(5)).slideToggle("slow");
    event.preventDefault();
})
</script>