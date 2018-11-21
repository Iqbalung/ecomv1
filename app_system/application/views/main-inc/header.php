<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $this->config->item('app_name').' - '.$this->config->item('client_name') ?></title>
   <!--  <link rel="shortcut icon" href="<?php echo $this->config->item('client_logo') ?>" type="image/x-icon" />
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?php echo $this->config->item('url_bootstrap') ?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('url_bootstrap') ?>css/bootstrap-treeview.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('url_bootstrap') ?>dist/css/skins/skin-dumas.css">

    <link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('url_css') ?>jquery.orgchart.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('url_plugins') ?>datepicker/datepicker3.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('url_bootstrap') ?>js/themes/default/style.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('url_plugins') ?>datatables/css/dataTables.bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('url_plugins') ?>datatables/extensions/Responsive/css/dataTables.responsive.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('url_plugins') ?>select2/select2.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('url_bootstrap') ?>dist/css/AdminLTE.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('url_app') ?>css/simple-sidebar.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('url_app') ?>css/app.css">

     -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">

    <!--favicon icon-->
    <link rel="icon" type="image/png" href="assets/img/favicon.html">

    <title>Warung Pedia</title>

    <!--web fonts-->
    <link href="http://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700,800" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">

    <!--bootstrap styles-->
    <link href="<?php echo $this->config->item('url_plugins'); ?>/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!--icon font-->
    <link href="<?php echo $this->config->item('url_plugins'); ?>/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo $this->config->item('url_plugins'); ?>/dashlab-icon/dashlab-icon.css" rel="stylesheet">
    <link href="<?php echo $this->config->item('url_plugins'); ?>/simple-line-icons/css/simple-line-icons.css" rel="stylesheet">

     <link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('url_plugins') ?>select2/select2.min.css">

        <link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('url_plugins') ?>datepicker/datepicker3.css">
     
    <link href="<?php echo $this->config->item('url_plugins'); ?>/themify-icons/css/themify-icons.css" rel="stylesheet">
    <link href="<?php echo $this->config->item('url_plugins'); ?>/weather-icons/css/weather-icons.min.css" rel="stylesheet">

    <!--custom scrollbar-->
    <link href="<?php echo $this->config->item('url_plugins'); ?>/m-custom-scrollbar/jquery.mCustomScrollbar.css" rel="stylesheet">

    <!--jquery dropdown-->
    <link href="<?php echo $this->config->item('url_plugins'); ?>/jquery-dropdown-master/jquery.dropdown.css" rel="stylesheet">

    <!--jquery ui-->
    <link href="<?php echo $this->config->item('url_plugins'); ?>/jquery-ui/jquery-ui.min.css" rel="stylesheet">

    <!--iCheck-->
    <link href="<?php echo $this->config->item('url_plugins'); ?>/icheck/skins/all.css" rel="stylesheet">

    <!--vector maps -->
    <link href="<?php echo $this->config->item('url_plugins'); ?>/vector-map/jquery-jvectormap-1.1.1.css" rel="stylesheet" >

    <!--c3chart-->
    <link href="<?php echo $this->config->item('url_plugins'); ?>/c3chart/c3.min.css" rel="stylesheet">

    <!--custom styles-->
    <link href="<?php echo $this->config->item('url_app') ?>css/main.min.css" rel="stylesheet">
    <link href="<?php echo $this->config->item('url_app') ?>css/app.css" rel="stylesheet">

    <!-- plugins -->


    <script src="<?php echo $this->config->item('url_plugins').'jQuery/jquery-3.1.0.min.js' ?>"></script>

    <link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('url_plugins') ?>datatables/dataTables.min.css">

    <script src="<?php echo $this->config->item('url_plugins') ?>datatables/datatables.js"></script>
    <script src="<?php echo $this->config->item('url_plugins') ?>popper.min.js"></script>
    <script src="<?php echo $this->config->item('url_plugins') ?>bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo $this->config->item('url_bootstrap').'js/bootstrap-treeview.js' ?>"></script>


    <script src="<?php echo $this->config->item('url_plugins') ?>select2/select2.js"></script>

    <script src="<?php echo $this->config->item('url_bootstrap').'js/jstree.min.js' ?>"></script>
    <script src="<?php echo $this->config->item('url_bootstrap').'js/jstreegrid.js' ?>"></script>
    <script src="<?php echo $this->config->item('url_plugins') ?>input-mask/inputmask/inputmask.js"></script>
    <script src="<?php echo $this->config->item('url_plugins') ?>input-mask/inputmask/inputmask.extensions.js"></script>
    <script src="<?php echo $this->config->item('url_plugins') ?>input-mask/inputmask/inputmask.numeric.extensions.js"></script>
    <script src="<?php echo $this->config->item('url_plugins') ?>input-mask/inputmask/inputmask.date.extensions.js"></script>
    <script src="<?php echo $this->config->item('url_plugins') ?>input-mask/inputmask/inputmask.phone.extensions.js"></script>
    <script src="<?php echo $this->config->item('url_plugins') ?>input-mask/inputmask/jquery.inputmask.js"></script>
    <script src="<?php echo $this->config->item('url_plugins') ?>input-mask/inputmask/phone-codes/phone.js"></script>
    <script src="<?php echo $this->config->item('url_plugins') ?>input-mask/inputmask/phone-codes/phone-be.js"></script>
    <script src="<?php echo $this->config->item('url_plugins') ?>input-mask/inputmask/phone-codes/phone-ru.js"></script>
    <script src="<?php echo $this->config->item('url_app') ?>js/startup.js"></script>
    
    <script src="<?php echo $this->config->item('url_plugins') ?>sweetalert/sweetalert.min.js"></script>

     <link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('url_plugins') ?>select2/select2.min.css">

 
    <!--[if lt IE 9]>
    <script src="assets/vendor/modernizr.js"></script>
    <![endif]-->

    <!--basic scripts initialization-->
    <script src="<?php echo $this->config->item('url_app'); ?>assets/js/scripts.min.js"></script>

    <style type="text/css">
      .loader {
        position: fixed;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background: url('<?php echo $this->config->item('url_images') ?>page-loader.gif') 50% 50% no-repeat;
      }
      .progress-bar.animate {
         width: 100%;
      }
      @keyframes progress {
    from { background-position:  0px; }
    to   { background-position: 40px; }
}
 
.progress-bar-animated {
    animation: progress 1s linear infinite;
}
    </style>
    <script type="text/javascript">
      app.data = <?php echo json_encode(isset($data_app)?$data_app:'{}' ); ?>;

      app.startup(app.data);

      $(document).ready(function() {
        app.body_unmask();

         $('.rp-input').inputmask("numeric", {
            radixPoint: ".",
            groupSeparator: ",",
            digits: 2,
            autoGroup: true,
            prefix: 'Rp.', //No Space, this will truncate the first character
            rightAlign: false,
            oncleared: function () { self.Value(''); }
        });

        $('.select2').select2();

        $('.input-date').datepicker({
          format: 'dd/mm/yyyy',
          language: "id",
          autoclose: true
        });

        $('.currency').inputmask("numeric", {
            radixPoint: ".",
            groupSeparator: ",",
            digits: 2,
            autoGroup: true,
            prefix: '',
            rightAlign: false,
        });

        $('.number').inputmask("numeric", {
            radixPoint: "",
            groupSeparator: "",
            digits: 2,
            autoGroup: true,
            prefix: '',
            rightAlign: false,
        });

        $('#form-ubah-password').validate({
          rules: {
            password2: {
              equalTo: '#passwordbaru'
            }
          }
        });

        $('#btn-ubah-password').on('click', function() {
          app.clear_form($('#form-ubah-password'));
          $('#form-ubah-password').validate().resetForm();

          $('#modal-ubah-password').modal({
            keyboard: false,
            backdrop: 'static'
          });
        });

        $('#modal-ubah-password #button-ubah').on('click', function() {
          if ($('#form-ubah-password').valid()) {
            var form = $('#form-ubah-password').serializeArray(),
                params = app.convert_form(form);

            app.body_mask();
            $.ajax({
                url: app.data.base_url + '/index.php/login/upd_password',
                method: 'POST',
                data: params,
              })
              .done(function(data) {
                app.body_unmask();
                var obj = jQuery.parseJSON(data);

                $('#modal-ubah-password').modal('hide');

                $('#modal-notifikasi .modal-body').html(obj.msg);
                $('#modal-notifikasi').modal({
                  keyboard: false,
                  backdrop: 'static'
                });
              });
          }
        });

        $('.iCheck-green').iCheck({
            checkboxClass: 'icheckbox_minimal-green',
            radioClass: 'iradio_minimal-green',
            increaseArea: '20%' // optional
        });

       
        
      });
    </script>
  </head>
  
  <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->

<body class="fixed-nav">
    <div class="loader"></div>
    <!--sidebar-n-header-->
    <nav class="navbar navbar-expand-lg fixed-top navbar-light" id="mainNav">

        <!--brand name-->
        <a class="navbar-brand" href="#" data-jq-dropdown="#jq-dropdown-1">
            <img class="pr-3 float-left" src="assets/img/logo-icon.png" srcset="assets/img/logo-icon@2x.png 2x"  alt=""/>
            <div class="float-left">
                <div><span style="font-size: 10px;">PT. Anya Living International<span> <i class="fa fa-caret-down pl-2"></i></div>
                <span class="page-direction f12 weight300">
                    <span><?php if($data_app['user']->user_usergroup==1){echo "Administrator / CEO";} ?>
                        <?php if($data_app['user']->user_usergroup==2){echo "Admin";} ?>
                        <?php if($data_app['user']->user_usergroup==3){echo "Warehouse";} ?>

                    </span>
                    <i class="fa fa-angle-right"></i>
                    <span><b><?php print_r($data_app['user']->user_username) ?></b> </span>
                </span>
            </div>
        </a>
        <!--/brand name-->


        <!--responsive nav toggle-->

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!--/responsive nav toggle-->
        
        <div class="collapse navbar-collapse" id="navbarResponsive" >
            <!--left side nav-->
            <ul class="navbar-nav left-side-nav" id="accordion">
                <li class="nav-item-search" data-toggle="tooltip" data-placement="right" title="Search">
                    <div class="nav-link nav-link-collapse collapsed" data-toggle="collapse">
                        <i class="vl_search"></i>
                        <span class="nav-link-text">
                            <input type="text" class="search-form" placeholder="Search Report"/>
                        </span>
                    </div>
                </li>
                <?php if($data_app['user']->user_usergroup<2){  ?>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
                    <a class="nav-link " href='<?php echo site_url() ?>/dashboard' >
                        <i class=" icon-chart"></i>
                        <span class="nav-link-text">Dashboard </span>
                    </a>
              
                </li>
            <?php } ?>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="UI Elements">
                    <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" data-target="#transaksi">
                        <i class=" icon-grid"></i>
                        <span class="nav-link-text">Transaction</span>
                    </a>
                    <ul class="sidenav-second-level collapse" id="transaksi" data-parent="#accordion">
                        <!-- <li> <a href="<?php echo site_url() ?>/transaction/app">All Transaction</a></li> -->
                       <!--  <li> <a href="<?php echo site_url() ?>/transaction/direct">Add Direct Transaction</a></li> -->
                        <li> <a href="<?php echo site_url() ?>/transaction/forstok">Transaction</a></li>
                    </ul>
                </li>
        
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
                    <a class="nav-link " href= "laporan.html" >
                        <i class="icon-layers"></i>
                        <span class="nav-link-text">Report </span>
                    </a>
                </li>

        <?php if($data_app['user']->user_usergroup<2){  ?>
        <li style="font-size:14px;padding-left:17px;font-weight:bold;padding-top:10px;padding-bottom:5px;" > Product </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="UI Elements">
            <a class="nav-link " href= "<?php echo site_url() ?>/master/product" >
                <i class="icon-layers"></i>
                <span class="nav-link-text">Product</span>
            </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="UI Elements">
            <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" data-target="#ui_inventori">
                <i class=" icon-grid"></i>
                <span class="nav-link-text">Inventori</span>
            </a>
            <ul class="sidenav-second-level collapse" id="ui_inventori" data-parent="#accordion">
                <li> <a href="<?php echo base_url() ?>admin.php/inventory/stockcard">Stock Card</a></li>
                <li> <a href="<?php echo base_url() ?>admin.php/inventory/stockin">Stok In</a></li>
                <li> <a href="transfer_stok.html">Transfer Stok</a></li>
                <li> <a href="<?php echo base_url() ?>admin.php/inventory/app/stockopname">Stock Opname</a></li>
                <li> <a href="<?php echo base_url() ?>admin.php/inventory/app">Purchase</a></li>
            </ul>
        </li>
        <li style="font-size:14px;padding-left:17px;font-weight:bold;padding-top:10px;padding-bottom:5px;" > Bisnis </li>
        
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Widgets">
                    <a class="nav-link " href="<?php echo base_url() ?>admin.php/master/Warehouse" >
                        <i class=" icon-briefcase"></i>
                        <span class="nav-link-text">Warehouse</span>
                    </a>
                </li>

               <!--  <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Calendar">
                    <a class="nav-link" href="karyawan.html">
                        <i class="icon-user"></i>
                        <span class="nav-link-text">Employee </span>
                    </a>
                </li>

                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Icons">
                    <a class="nav-link " href="pelanggan.html" >
                        <i class="icon-people"></i>
                        <span class="nav-link-text">Customer</span>
                    </a>
                </li> -->

               <!--  <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Forms">
                    <a class="nav-link " href="perangkat.html" >
                        <i class=" icon-screen-tablet"></i>
                        <span class="nav-link-text">Perangkat</span>
                    </a>
                </li>

                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Data Tables">
                    <a class="nav-link " href="promo.html" >
                        <i class="fa fa-scissors"></i>
                        <span class="nav-link-text">Promo</span>
                    </a>
                </li> -->
        
        <li style="font-size:14px;padding-left:17px;font-weight:bold;padding-top:10px;padding-bottom:5px;" > Master </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="UI Elements">
            <a class="nav-link " href="<?php echo site_url() ?>/master/courier" >
                <i class=" icon-handbag"></i>
                <span class="nav-link-text"> Courier</span>
            </a>
            <a class="nav-link " href="<?php echo site_url() ?>/master/suplier" >
                <i class=" icon-handbag"></i>
                <span class="nav-link-text"> Suplier</span>
            </a>
            <a class="nav-link " href="<?php echo site_url() ?>/master/mediasale" >
                <i class=" icon-handbag"></i>
                <span class="nav-link-text"> Media Sale</span>
            </a>
            <a class="nav-link " href="<?php echo site_url() ?>/master/category" >
                <i class=" icon-handbag"></i>
                <span class="nav-link-text"> Category</span>
            </a>
            <a class="nav-link " href="<?php echo site_url() ?>/master/product" >
                <i class=" icon-handbag"></i>
                <span class="nav-link-text"> Product</span>
            </a>
            <a class="nav-link " href="<?php echo site_url() ?>/master/region" >
                <i class=" icon-handbag"></i>
                <span class="nav-link-text"> Region</span>
            </a>
            <a class="nav-link " href="<?php echo site_url() ?>/master/user" >
                <i class=" icon-handbag"></i>
                <span class="nav-link-text"> User</span>
            </a>
        </li>               
        <?php }  ?>
        <li style="font-size:14px;padding-left:17px;font-weight:bold;padding-top:10px;padding-bottom:5px;" > PENGATURAN </li>

                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
                    <a class="nav-link " href="profile.html" >
                        <i class="fa fa-user-circle"></i>
                        <span class="nav-link-text">Profile Bisnis</span>
                    </a>
                 
                </li>

               <!--  <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Exra Pages">
                    <a class="nav-link " href="billing.html" >
                        <i class="fa fa-usd"></i>
                        <span class="nav-link-text">Billing</span>
                    </a>
                  
                </li> -->
                
            </ul>
            <!--/left side nav-->

            <!--nav push link-->
            <ul class="navbar-nav sidenav-toggler">
                <li class="nav-item">
                    <a class="nav-link text-center" id="left-nav-toggler">
                        <i class="fa fa-angle-left"></i>
                    </a>
                </li>
            </ul>
            <!--/nav push link-->

           

            <!--header rightside links-->
            <ul class="navbar-nav header-links ml-auto hide-arrow">
        
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle mr-lg-3" id="alertsDropdown" href="#" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                        <i class="vl_bell"></i>
                        <span class="d-lg-none">Notifikasi
                            <span class="badge badge-pill badge-warning">5 New</span>
                        </span>
                        <div class="notification-alarm">
                            <span class="wave wave-warning"></span>
                            <span class="dot bg-warning"></span>
                        </div>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right header-right-dropdown-width pb-0" aria-labelledby="alertsDropdown">
                        <h6 class="dropdown-header weight500">Notifikasi</h6>

                        <div class="dropdown-divider mb-0"></div>
                        <a class="dropdown-item border-bottom" href="#">
                            <span class="text-primary">
                            <span class="weight500">
                                <i class="vl_bell weight600 pr-2"></i>Stok Alert</span>
                            </span>
                            <span class="small float-right text-muted">03:14 AM</span>

                            <div class="dropdown-message f12">
                                Stok Produk <b>Lucas TV Stand</b> <span style='color:red;' >sisa 2</span> 
                        </a>

                       

                       <a class="dropdown-item border-bottom" href="#">
                            
                            <div class="dropdown-message f12">
                                Stok Produk <b>Sofa Bed Mozza</b> <span style='color:red;' >sisa 1</span></div>
                        </a>

                         <a class="dropdown-item border-bottom" href="#">
                            
                            <div class="dropdown-message f12">
                                Stok Produk <b>Laptop Lenovo</b> <span style='color:red;' >sisa 4</span></div>
                        </a>




                        <a class="dropdown-item small" href="#">Lihat semua notifikasi</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle mr-lg-3" id="userNav" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                       My Account
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userNav">
                        <a class="dropdown-item" href="#">Hi, <?php print_r($data_app['user']->user_username) ?></a>
                        <a class="dropdown-item" href="#">My Profile</a>
                        <a class="dropdown-item" href="#">Account Settings</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?php echo base_url() ?>index.php/login/logout">Sign Out</a>
                    </div>
                </li>
            </ul>
            <!--/header rightside links-->

        </div>
    </nav>
    <!--sidebar-n-header-->

    <!--main content wrapper-->
    <div class="content-wrapper">

        

     