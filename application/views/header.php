<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <!-- <link rel="icon" type="image/png" href="<?php echo base_url(); ?>assets/images/logo_axi_login.png"> -->
  <link rel="icon" sizes="76x76" href="<?php echo base_url(); ?>assets/images/logo_axi_login.png">
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
  <!-- Keyboard Onpress Key -->
<script>
function getkey(e)
{
if (window.event)
   return window.event.keyCode;
else if (e)
   return e.which;
else
   return null;
}
function goodchars(e, goods, field)
{
var key, keychar;
key = getkey(e);
if (key == null) return true;
 
keychar = String.fromCharCode(key);
keychar = keychar.toLowerCase();
goods = goods.toLowerCase();
 
// check goodkeys
if (goods.indexOf(keychar) != -1)
    return true;
// control keys
if ( key==null || key==0 || key==8 || key==9 || key==27 )
   return true;
    
if (key == 13) {
    var i;
    for (i = 0; i < field.form.elements.length; i++)
        if (field == field.form.elements[i])
            break;
    i = (i + 1) % field.form.elements.length;
    field.form.elements[i].focus();
    return false;
    };
// else return false
return false;
}
</script>
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
  <!-- Function checked radio button -->

</head>

<body class="">
  <!-- Extra details for Live View on GitHub Pages -->
  <!-- Google Tag Manager (noscript) -->
  <noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NKDMSK6" height="0" width="0" style="display:none;visibility:hidden"></iframe>
  </noscript>
  <!-- End Google Tag Manager (noscript) -->
  <div class="wrapper ">
    <div class="sidebar" data-color="rose" data-background-color="black" data-image="<?php echo base_url(); ?>assets/img/astragraphia.png ">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
      <div class="logo">
        <a href="https://www.instagram.com/taufikriskyanto/" class="simple-text logo-mini">
          TR
        </a>
        <a href="https://www.axi.co.id/" class="simple-text logo-normal">
          IT PLT
        </a>
      </div>
      <div class="sidebar-wrapper">
        <div class="user">
          <div class="photo">
            <img src="<?php echo base_url(); ?>assets/img/person.png" />
          </div>
          <div class="user-info">
            <a data-toggle="collapse" href="#collapseExample" class="username">
              <span>
              
              <?php echo substr($this->session->userdata('nama'),0,20);?> 
                <b class="caret"></b>
              </span>
            </a>
            <div class="collapse" id="collapseExample">
              <ul class="nav">
                <li class="nav-item">
                  <a class="nav-link" href="#">
                    <span class="sidebar-mini"> MP </span>
                    <span class="sidebar-normal"> My Profile </span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo base_url();?>home/edit_profile">
                    <span class="sidebar-mini"> EP </span>
                    <span class="sidebar-normal"> Edit Profile </span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo base_url();?>login/logout">
                  <i class="material-icons">exit_to_app</i>
                    <span class="sidebar-normal">Logout</span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <?php if ($this->session->userdata('level')=='Administrator'){ ?>
        <ul class="nav">
          <!-- <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url();?>home">
              <i class="material-icons">dashboard</i>
              <p> Dashboard </p>
            </a>
          </li> -->
          <!-- <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url();?>view_log/list_log">
              <i class="material-icons">local_printshop</i>
              <p>Summary Machine</p>
            </a>
          </li> -->
          <li class="nav-item ">
            <a class="nav-link" data-toggle="collapse" href="#pagesExamples">
              <i class="material-icons">person</i>
              <p> Customer
                <b class="caret"></b>
              </p>
            </a>
                <div class="collapse" id="pagesExamples">
                  <ul class="nav">
                    <li class="nav-item ">
                      <a class="nav-link" href="<?php echo base_url();?>customer/list_customer">
                      <span class="sidebar-mini">C</span>
                        <span class="sidebar-normal">Customer</span>
                      </a>
                      </li>
                    <li class="nav-item ">
                      <a class="nav-link" href="<?php echo base_url();?>customer/list_type_customer">
                        <span class="sidebar-mini">CT</span>
                        <span class="sidebar-normal">Customer Type</span>
                      </a>
                    </li>
                  </ul>
                </div>
                </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url();?>upload_log_dnr">
              <i class="material-icons">data_usage</i>
              <p>Approval Splod</p>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url();?>procces_printing">
              <i class="material-icons">print</i>
              <p>Printing</p>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url();?>facillity/printing_facillity">
              <i class="material-icons">print</i>
              <p>Printing Facility</p>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url();?>procces_inserting">
              <i class="material-icons">local_post_office</i>
              <p>Inserting</p>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url();?>procces_balancing">
              <i class="material-icons">markunread_mailbox</i>
              <p>Balancing</p>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url();?>procces_rtp">
              <i class="material-icons">local_shipping</i>
              <p>Ready To Pickup</p>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url();?>facillity/finishing_facillity">
              <i class="material-icons">import_contacts</i>
              <p>Facillity Finishing</p>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url();?>view_monitoring" target="_blank">
              <i class="material-icons">airplay</i>
              <p>Monitoring Status</p>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url();?>view_monitoring/monitoring_facillity">
              <i class="material-icons">airplay</i>
              <p>Monitoring Facillity</p>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url();?>calender" target="_blank">
              <i class="material-icons">today</i>
              <p>Calender</p>
            </a>
          </li>

        </ul>
        <?php }else if($this->session->userdata('level')=='Relationship Manager'){?>
          <ul class="nav">
          <li class="nav-item ">
            <a class="nav-link" data-toggle="collapse" href="#pagesExamples">
              <i class="material-icons">person</i>
              <p> Customer
                <b class="caret"></b>
              </p>
            </a>
                <div class="collapse" id="pagesExamples">
                  <ul class="nav">
                    <li class="nav-item ">
                      <a class="nav-link" href="<?php echo base_url();?>customer/list_customer">
                      <span class="sidebar-mini">C</span>
                        <span class="sidebar-normal">Customer</span>
                      </a>
                      </li>
                    <li class="nav-item ">
                      <a class="nav-link" href="<?php echo base_url();?>customer/list_type_customer">
                        <span class="sidebar-mini">CT</span>
                        <span class="sidebar-normal">Customer Type</span>
                      </a>
                    </li>
                  </ul>
                </div>
                </li>

          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url();?>upload_log_dnr">
              <i class="material-icons">data_usage</i>
              <p>Approval Splod</p>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url();?>facillity">
              <i class="material-icons">content_paste</i>
              <p>SURAT ORDER SO</p>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url();?>view_monitoring">
              <i class="material-icons">airplay</i>
              <p>Monitoring Status</p>
            </a>
          </li>
        </ul>
            </ul>
            <?php }else if($this->session->userdata('level')=='Project Admin'){?>
              <ul class="nav">
          <li class="nav-item ">
            <a class="nav-link" data-toggle="collapse" href="#pagesExamples">
              <i class="material-icons">person</i>
              <p> Customer
                <b class="caret"></b>
              </p>
            </a>
                <div class="collapse" id="pagesExamples">
                  <ul class="nav">
                    <li class="nav-item ">
                      <a class="nav-link" href="<?php echo base_url();?>customer/list_customer">
                      <span class="sidebar-mini">C</span>
                        <span class="sidebar-normal">Customer</span>
                      </a>
                      </li>
                    <li class="nav-item ">
                      <a class="nav-link" href="<?php echo base_url();?>customer/list_type_customer">
                        <span class="sidebar-mini">CT</span>
                        <span class="sidebar-normal">Customer Type</span>
                      </a>
                    </li>
                  </ul>
                </div>
                </li>

          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url();?>upload_log_dnr">
              <i class="material-icons">data_usage</i>
              <p>Approval Splod</p>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url();?>view_monitoring" target="_blank">
              <i class="material-icons">airplay</i>
              <p>Monitoring Status</p>
            </a>
          </li>
        </ul>
            </ul>
            <?php }else if($this->session->userdata('level')=='Coordinator'){?>
              <ul class="nav">
          <!-- <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url();?>home">
              <i class="material-icons">dashboard</i>
              <p> Dashboard </p>
            </a>
          </li> -->
          <!-- <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url();?>view_log/list_log">
              <i class="material-icons">local_printshop</i>
              <p>Summary Machine</p>
            </a>
          </li> -->
          <li class="nav-item ">
            <a class="nav-link" data-toggle="collapse" href="#pagesExamples">
              <i class="material-icons">person</i>
              <p> Customer
                <b class="caret"></b>
              </p>
            </a>
                <div class="collapse" id="pagesExamples">
                  <ul class="nav">
                    <li class="nav-item ">
                      <a class="nav-link" href="<?php echo base_url();?>customer/list_customer">
                      <span class="sidebar-mini">C</span>
                        <span class="sidebar-normal">Customer</span>
                      </a>
                      </li>
                    <li class="nav-item ">
                      <a class="nav-link" href="<?php echo base_url();?>customer/list_type_customer">
                        <span class="sidebar-mini">CT</span>
                        <span class="sidebar-normal">Customer Type</span>
                      </a>
                    </li>
                  </ul>
                </div>
                </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url();?>upload_log_dnr">
              <i class="material-icons">data_usage</i>
              <p>Approval Splod</p>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url();?>procces_printing">
              <i class="material-icons">print</i>
              <p>Printing</p>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url();?>procces_inserting">
              <i class="material-icons">local_post_office</i>
              <p>Inserting</p>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url();?>procces_balancing">
              <i class="material-icons">markunread_mailbox</i>
              <p>Balancing</p>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url();?>procces_rtp">
              <i class="material-icons">local_shipping</i>
              <p>Ready To Pickup</p>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url();?>view_monitoring" target="_blank">
              <i class="material-icons">airplay</i>
              <p>Monitoring Status</p>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url();?>view_monitoring/test" target="_blank">
              <i class="material-icons">airplay</i>
              <p>Test Monitoring Status</p>
            </a>
          </li>
        </ul>
            <?php }?>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <!-- End Navbar -->