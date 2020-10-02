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
  <!-- Extra details for Live View on GitHub Pages -->
  <!-- Canonical SEO -->
  <!-- <link rel="canonical" href="https://www.creative-tim.com/product/material-dashboard-pro" /> -->
  <!--  Social tags      -->
  <!-- <meta name="keywords" content="creative tim, html dashboard, html css dashboard, web dashboard, bootstrap 4 dashboard, bootstrap 4, css3 dashboard, bootstrap 4 admin, material dashboard bootstrap 4 dashboard, frontend, responsive bootstrap 4 dashboard, material design, material dashboard bootstrap 4 dashboard">
  <meta name="description" content="Material Dashboard PRO is a Premium Material Bootstrap 4 Admin with a fresh, new design inspired by Google's Material Design."> -->
  <!-- Schema.org markup for Google+ -->
  <!-- <meta itemprop="name" content="Material Dashboard PRO by Creative Tim">
  <meta itemprop="description" content="Material Dashboard PRO is a Premium Material Bootstrap 4 Admin with a fresh, new design inspired by Google's Material Design.">
  <meta itemprop="image" content="https://s3.amazonaws.com/creativetim_bucket/products/51/original/opt_mdp_thumbnail.jpg"> -->
  <!-- Twitter Card data -->
  <!-- <meta name="twitter:card" content="product">
  <meta name="twitter:site" content="@creativetim">
  <meta name="twitter:title" content="Material Dashboard PRO by Creative Tim">
  <meta name="twitter:description" content="Material Dashboard PRO is a Premium Material Bootstrap 4 Admin with a fresh, new design inspired by Google's Material Design.">
  <meta name="twitter:creator" content="@creativetim">
  <meta name="twitter:image" content="https://s3.amazonaws.com/creativetim_bucket/products/51/original/opt_mdp_thumbnail.jpg"> -->
  <!-- Open Graph data -->
  <!-- <meta property="fb:app_id" content="655968634437471">
  <meta property="og:title" content="Material Dashboard PRO by Creative Tim" />
  <meta property="og:type" content="article" />
  <meta property="og:url" content="http://demos.creative-tim.com/material-dashboard-pro/examples/dashboard.html" />
  <meta property="og:image" content="https://s3.amazonaws.com/creativetim_bucket/products/51/original/opt_mdp_thumbnail.jpg" />
  <meta property="og:description" content="Material Dashboard PRO is a Premium Material Bootstrap 4 Admin with a fresh, new design inspired by Google's Material Design." />
  <meta property="og:site_name" content="Creative Tim" /> -->
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="<?php echo base_url(); ?>assets/css/material-dashboard.min.css?v=2.1.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="<?php echo base_url(); ?>assets/demo/demo.css" rel="stylesheet" />
  <!-- Google Tag Manager -->
  <script>
    // (function(w, d, s, l, i) {
    //   w[l] = w[l] || [];
    //   w[l].push({
    //     'gtm.start': new Date().getTime(),
    //     event: 'gtm.js'
    //   });
    //   var f = d.getElementsByTagName(s)[0],
    //     j = d.createElement(s),
    //     dl = l != 'dataLayer' ? '&l=' + l : '';
    //   j.async = true;
    //   j.src =
    //     'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
    //   f.parentNode.insertBefore(j, f);
    // })(window, document, 'script', 'dataLayer', 'GTM-NKDMSK6');
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
                  <div  class="card-body table-full-width table-hover">
                  <Marquee direction="up" scrollamount="2" height="500px" width="100%" onmouseover="this.stop();" onmouseout="this.start();">
                    <div class="table-responsive" id="lot_info">
                      <table class="table">
                        <thead class=" text-primary">
                        <th>Job Customer</th>
                        <th>Proccess Data</th>
                        <th>Approval Splod</th>
                        <th>Printing</th>
                        <th>Inserting</th>
                        <th>Balancing</th>	
                        <th>Ready To Pickup</th>
                        <?php if($level === 'Customers'){
                        echo"";
                        }else{
                        echo"<th>Meet SLA</th>";
                        }?>
                        <th>Tanggal SLA</th>	
                        </thead>
                        <!-- </table>
                        <Marquee direction="up" scrollamount="2" height="450px" width="100%" onmouseover="this.stop();" onmouseout="this.start();">
                        <table class="table"> -->
                        
                        <tbody>
                       
                      <?php $no = 0; foreach($view_monitoring as $row) : $no++;?>
                      <?php 
                      if($row->rtp_status === 'done'){
                        $time = $row->at_last;
                      }else{
                        $time = date('Y-m-d H:i:s');
                      }
                      $splod =  $row->date_approval_splod;
                      $sla =  $row->sla;
                      $awal  = strtotime($splod);
                      $akhir = strtotime($time);
                      $diff  = $akhir - $awal;

                      $jam   = round($diff / (60 * 60),2);
                      $persen = 0;
                      if ($jam > 0 || $sla > 0){
                      $persen = ($jam/$sla)*100;    
                      }else{
                      $persen = 0 * 100;          
                      }
                      
                      $temp = ((float)number_format($jam, 2) + 0);
                     
                      // echo $persen;
                      if ($level === 'Customers'){
                        echo "<tr clas>";
                      }else{
                        if($persen<90){
                          echo "<tr class='table-success'>";  
                          }else if($persen>= 90 && $persen <=100){
                          echo "<tr class='table-warning'>";  
                          }else if($persen>100){
                          echo "<tr class='table-danger'>";
                          }
                      }
                      ?>    
                        <td><?php echo $row->customer.'-'.$row->produk.'-'.$row->cycle.'-'.$row->splod;?></td>
                        <td><?php echo $row->date_proccess;?></td>
                        <?php
                        if(!empty($row->splod)){
                          ?>
                        <td><img src="<?php echo base_url();?>assets\images\check.png" width="14" height="14"><br/><?php echo $row->date_approval_splod;?></td>
                      <?php
                        }else{
                        ?>
                        <td></td>
                        <?php
                        }?>
                        <?php
                        if($row->printing_status==='done'){
                          ?>
                        <td><img src="<?php echo base_url();?>assets\images\check.png" width="14" height="14"><br/><?php echo $row->finish_printing;?></td>
                      <?php
                        }else{
                        ?>
                        <td></td>
                        <?php
                        }?>
                        <?php
                        if($row->inserting_status==='done'){
                          ?>
                        <td><img src="<?php echo base_url();?>assets\images\check.png" width="14" height="14"><br/><?php echo $row->finish_inserting;?></td>
                      <?php
                        }else{
                        ?>
                        <td></td>
                        <?php
                        }?>
                        <?php
                        if($row->balancing_status==='done'){
                          ?>
                        <td><img src="<?php echo base_url();?>assets\images\check.png" width="14" height="14"><br/><?php echo $row->finish_balancing;?></td>
                      <?php
                        }else{
                        ?>
                        <td></td>
                        <?php
                        }?>
                        <?php
                        if($row->rtp_status==='done'){
                          ?>
                        <td><img src="<?php echo base_url();?>assets\images\check.png" width="14" height="14"><br/><?php echo $row->finish_rtp;?></td>
                      <?php
                        }else{
                        ?>
                        <td></td>
                        <?php
                        }?>
                        <?php
                        if($row->rtp_status){
                          $last_fase = $row->at_last;
                        }else{
                          $last_fase = date('Y-m-d H:i:s');
                        }                      
                        $splod =  $row->date_approval_splod;
                        
                        $awal  = strtotime($splod);
                        $akhir = strtotime($last_fase);
                        $diff  = $akhir - $awal;

                        $jam   = round($diff / (60 * 60),2);
                        // echo $jam;
                        $meet_sla = ($jam)/$sla;
                        if($level==='Customers'){

                        }else{
                          if($meet_sla <= 1){
                            echo "<td>Succcess</td>";
                          }else{
                            echo "<td>Fail</td>";
                          }
                        } ?>
                        <?php 
                        $tanggal_sla = date_create($splod);
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
                  <!-- <div class="table-responsive" id="table_monitoring">
                      <table class="table">
                        <thead class=" text-primary">
                        <th style="padding-right:10px">Job Customer</th>
                        <th>Proccess Data</th>
                        <th>Approval Splod</th>
                        <th>Printing</th>
                        <th>Inserting</th>
                        <th>Balancing</th>	
                        <th>Ready To Pickup</th>
                        <th>Meet SLA</th>
                        <th>Tanggal SLA</th>	
                        </thead>
                      </table>
                  </div> -->
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
        $('#lot_info').load('<?php echo base_url();?>view_monitoring');
        refresh();
    }, 1000);
}

$("a[id^=show_]").click(function(event) {
    $("#extra_" + $(this).attr('id').substr(5)).slideToggle("slow");
    event.preventDefault();
})
</script>