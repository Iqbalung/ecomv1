<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from thevectorlab.net/dashlab-v1.1/ by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 22 Mar 2018 06:09:14 GMT -->
<head>
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
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!--icon font-->
    <link href="assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/vendor/dashlab-icon/dashlab-icon.css" rel="stylesheet">
    <link href="assets/vendor/simple-line-icons/css/simple-line-icons.css" rel="stylesheet">
    <link href="assets/vendor/themify-icons/css/themify-icons.css" rel="stylesheet">
    <link href="assets/vendor/weather-icons/css/weather-icons.min.css" rel="stylesheet">

    <!--custom scrollbar-->
    <link href="assets/vendor/m-custom-scrollbar/jquery.mCustomScrollbar.css" rel="stylesheet">

    <!--jquery dropdown-->
    <link href="assets/vendor/jquery-dropdown-master/jquery.dropdown.css" rel="stylesheet">

    <!--jquery ui-->
    <link href="assets/vendor/jquery-ui/jquery-ui.min.css" rel="stylesheet">

    <!--iCheck-->
    <link href="assets/vendor/icheck/skins/all.css" rel="stylesheet">

    <!--vector maps -->
    <link href="assets/vendor/vector-map/jquery-jvectormap-1.1.1.css" rel="stylesheet" >

    <!--c3chart-->
    <link href="assets/vendor/c3chart/c3.min.css" rel="stylesheet">

    <!--custom styles-->
    <link href="assets/css/main.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="assets/vendor/html5shiv.js"></script>
    <script src="assets/vendor/respond.min.js"></script>
    <![endif]-->
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-115474794-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-115474794-1');
    </script>

</head>

<body class="fixed-nav">

    <!--sidebar-n-header-->
    <div w3-include-html="sidebar-n-header.html"></div>
    <!--sidebar-n-header-->

    <!--main content wrapper-->
    <div class="content-wrapper">

        <!--creative states-->
        <div class="creative-state-area">
            <div class="row">
                <div class="col-lg-4 col-12">
                    <h4 class="creative-state-title">Dashboard</h4>
                </div>
                <div class="col-lg-8  col-12 text-lg-right">
                    <div class="row short-states mb-lg-0 mb-4">
					
						
						
                        <div class="col-5">
                            
							 <div class="form-group row">
                                    
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="input-group date dpMonths" data-date-viewmode="months" data-date-format="mm/yyyy" data-date="12-08-2017">
                                            <input type="text" class="form-control" placeholder="03-07-2018" aria-label="Right Icon" aria-describedby="dp-mdo">
                                            <div class="input-group-append">
                                                <button id="dp-mdo" class="btn btn-primary" type="button"><i class="fa fa-calendar f14"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								
                        </div>
						
						<div class="col-5">
                            
							 <div class="form-group row">
                                    
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="input-group date dpMonths" data-date-viewmode="months" data-date-format="mm/yyyy" data-date="12-08-2017">
                                            <input type="text" class="form-control" placeholder="03-07-2018" aria-label="Right Icon" aria-describedby="dp-mdo">
                                            <div class="input-group-append">
                                                <button id="dp-mdo" class="btn btn-primary" type="button"><i class="fa fa-calendar f14"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								
                        </div>
						
						<div class="col-2">
                            
							 <button  data-toggle="modal" data-target="#filter"  type="button" class="btn btn-primary">FILTER</button>
								
                        </div>
						
						
						
						
						<div class="modal fade" id="filter" tabindex="-1" role="dialog" aria-labelledby="filter2" aria-hidden="true">
                            <div class="modal-dialog modal-sm" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="filter2">Pilih Rentang Waktu</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                    
									<button style='width:100%;margin-bottom:5px;text-align:left;' type="button" class="btn btn-outline-primary btn-sm">Hari ini</button>
									
									<button style='width:100%;margin-bottom:5px;text-align:left;' type="button" class="btn btn-outline-primary btn-sm">Kemarin</button>
									
									<button style='width:100%;margin-bottom:5px;text-align:left;' type="button" class="btn btn-outline-primary btn-sm">7 Hari Terakhir</button>
									
									<button style='width:100%;margin-bottom:5px;text-align:left;' type="button" class="btn btn-outline-primary btn-sm">30 Hari Terakhir</button>
									
									<button style='width:100%;margin-bottom:5px;text-align:left;' type="button" class="btn btn-outline-primary btn-sm">Minggu ini</button>
									
									<button style='width:100%;margin-bottom:5px;text-align:left;' type="button" class="btn btn-outline-primary btn-sm">Minggu Lalu</button>
									
									<button style='width:100%;margin-bottom:5px;text-align:left;' type="button" class="btn btn-outline-primary btn-sm">Bulan ini</button>
									
									<button style='width:100%;margin-bottom:5px;text-align:left;' type="button" class="btn btn-outline-primary btn-sm">Bulan lalu</button>
									
									<button style='width:100%;margin-bottom:5px;text-align:left;' type="button" class="btn btn-outline-primary btn-sm">Rentang waktu</button>
									</div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                        <button type="button" class="btn btn-primary">Cari</button>
                                    </div>
                                </div>
                            </div>
                        </div>

						
                       
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="creative-state-icon bg-danger text-center pull-left">
                        <i class="vl_clip-board"></i>
                    </div>
                    <div class="creative-state-info text-center pull-left" style='text-align:center;' >
					
						
							<div style='margin-left:-40px;padding-top:20px;padding-left:50px;'>
							
								<div class="text-danger weight700" style='position:relative;float:left;width:10%;' > 
									<i style='font-size:30px;' class="fa fa-long-arrow-down"></i> 
								</div>
								
								<div class="text-danger weight700" style='padding-top:4px;position:relative;float:left;width:90%;' > 
									<span style='top:-20px;font-size:12px;' >5% dari periode sebelumnya</span>
								</div>
							</div> 
						
					   <h3 class="mt-4">1571</h3>
                        <p class="mb-0">Transaksi Diterima</p>
                       

                       <br/>
                       
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="creative-state-icon bg-warning text-center pull-left">
                        <i class="vl_cart-full"></i>
                    </div>
                    <div class="creative-state-info text-center pull-left">
						
						<div style='margin-left:-40px;padding-top:20px;padding-left:50px;'>
							
								<div class="text-success weight700" style='position:relative;float:left;width:10%;' > 
									<i style='font-size:30px;' class="fa fa-long-arrow-up" ></i> 
								</div>
								
								<div class="text-success weight700" style='padding-top:4px;position:relative;float:left;width:90%;text-align:center;' > 
									<span style='top:-20px;font-size:12px;' >5% (+Rp36.172.300 ) <br/>dari periode sebelumnya</span>
								</div>
							</div> 
							
                        <h3 class="mt-4">Rp 216.987.500</h3>
                        <p class="mb-0">Total Penjualan</p>
                       <br/>
                        
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="creative-state-icon bg-purple text-center pull-left">
                        <i class="vl_dollar-on-hand"></i>
                    </div>
					
                    <div class="creative-state-info text-center pull-left">
					
						<div style='margin-left:-40px;padding-top:20px;padding-left:50px;'>
							
								<div class="text-success weight700" style='position:relative;float:left;width:10%;' > 
									<i style='font-size:30px;' class="fa fa-long-arrow-up" ></i> 
								</div>
								
								<div class="text-success weight700" style='padding-top:4px;position:relative;float:left;width:90%;text-align:center;' > 
									<span style='top:-20px;font-size:12px;' >5% (+Rp12.210.100 ) <br/>dari periode sebelumnya</span>
								</div>
						</div> 
						
                        <h3 class="mt-4">Rp 98.997.800</h3>
                        <p class="mb-0">total profit</p>
                        <br/>
                        
                    </div>
					
                </div>
            </div>
        </div>
        <!--/creative states-->

        <div class="container-fluid">

            <!--sales report & active user-->
            <div class="row">
                <div class="col-xl-8 col-md-7">
                    <div class="card card-shadow mb-4">
                        <div class="card-header border-0">
                            <div class="custom-title-wrap bar-primary">
                                <div class="custom-title">GRAFIK PENJUALAN</div>
                                <div class=" widget-action-link">
                                    <div class="dropdown">
                                        <a href="#" class="btn btn-transparent text-secondary dropdown-hover p-0" data-toggle="dropdown">
                                            <i class=" vl_ellipsis-fill-h"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right vl-dropdown">
                                            <a class="dropdown-item" href="#"> Edit</a>
                                            <a class="dropdown-item" href="#"> Delete</a>
                                            <a class="dropdown-item" href="#"> Settings</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row text-center mb-4">
                                <div class="col-4">
                                    <h4 class="mb-0">Rp 16.192.500 <i class="fa fa-long-arrow-up text-success f14"></i></h4>
                                    <small class="text-muted text-uppercase">Penjualan Hari ini</small>
                                </div>
                                <div class="col-4">
                                    <h4 class="mb-0">Rp 56.428.200 <i class="fa fa-long-arrow-down text-danger f14"></i></h4>
                                    <small class="text-muted text-uppercase">Penjualan Minggu ini</small>
                                </div>
                                <div class="col-4">
                                    <h4 class="mb-0">Rp 216.987.500 <i class="fa fa-long-arrow-up text-success f14"></i></h4>
                                    <small class="text-muted text-uppercase">Penjualan Bulan ini</small>
                                </div>
                            </div>
                            <div>
                                <canvas id="sales_report_chart" height="320"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-5">
                    <div class="card text-light mb-4 basic-gradient bubble-shadow">
                        <div class="widget-action-link">
                            <div class="dropdown">
                                <a href="#" class="btn btn-transparent text-white dropdown-hover p-0" data-toggle="dropdown">
                                    <i class=" vl_ellipsis-fill-h"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right vl-dropdown">
                                    <a class="dropdown-item" href="#"> Detail</a>
                                    <a class="dropdown-item" href="#"> Cetak</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="widget-active-user">
                                <h5 class="mt-3 b-b1 mb-4">TRANSAKSI PERHARI</h5>
                                <h1 class="mb-4">176</h1>
                                <h5 class="mt-3 b-b1 mb-5">TRANSAKSI HARI INI</h5>
                                <div id="active_users" class="text-center"></div>
                                <h5 class="mt-5 mb-0">Transaksi Tertinggi</h5>
                                <ul class="list-unstyled active-page-link">
                                    <li><small>BukaLapak</small> <span>96</span></li>
                                    <li><small>JD.id</small> <span>80</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/sales report & active user-->

            <!--member performance & support ticket-->
            <div class="row">
                <div class="col-xl-6">
                    <div class="card card-shadow mb-4 ">
                        <div class="card-header border-0">
                            <div class="custom-title-wrap bar-danger">
                                <div class="custom-title">
                                    PENJUALAN PRODUK TERTINGGI
                                   
                                   

                                </div>
                            </div>
                        </div>
                        
						<div class="card-body text-center" style='height:380px;'>
                            <canvas id="area_chart" height="150"></canvas>
                        </div>
						
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card card-shadow mb-4 ">
                        <div class="card-header border-0">
                            <div class="custom-title-wrap bar-warning">
                                <div class="custom-title">PENJUALAN KATEGORI TERTINGGI</div>
                                
                            </div>
                        </div>
						
						<div class="card-body text-center" style='height:380px;'>
                             <canvas id="area_chart2" height="150"></canvas>
                        </div>
						
					</div>
                </div>
            </div>
            <!--/member performance & support ticket-->

			 <!--member performance & support ticket-->
            <div class="row">
                <div class="col-xl-6">
                    <div class="card card-shadow mb-4 ">
                        <div class="card-header border-0">
                            <div class="custom-title-wrap bar-danger">
                                <div class="custom-title">
                                    PENGINGAT STOK
                                   
                                   

                                </div>
                            </div>
                        </div>
                        
						<div class="card-body text-center" style='height:100px;'>
							TIDAK ADA PRODUK YANG AKAN HABIS
                        </div>
						
                    </div>
                </div>
            </div>
            <!--/member performance & support ticket-->

			
        </div>

        <!--footer-->
        <footer class="sticky-footer">
            <div class="container">
                <div class="text-center">
                    <small>Copyright &copy; Sistem Pos Integrated 2018</small>
                </div>
            </div>
        </footer>
        <!--/footer-->
    </div>
    <!--/main content wrapper-->

    <!--basic scripts-->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/jquery-ui/jquery-ui.min.js"></script>
    <script src="assets/vendor/popper.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>

    <script src="assets/vendor/jquery-dropdown-master/jquery.dropdown.js"></script>

    <script src="assets/vendor/m-custom-scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>

    <!--sparkline-->
    <script src="assets/vendor/sparkline/jquery.sparkline.js"></script>
    <!--sparkline initialization-->
    <script src="assets/vendor/js-init/sparkline/init-sparkline.js"></script>

    <!--c3chart-->
    <script src="assets/vendor/c3chart/d3.min.js"></script>
    <script src="assets/vendor/c3chart/c3.min.js"></script>
    <!--c3chart initialization-->
    <script src="assets/vendor/js-init/c3chart/init-c3chart.js"></script>

    <!--chartjs-->
    <script src="assets/vendor/chartjs/Chart.bundle.min.js"></script>
    <!--chartjs initialization-->
    <script src="assets/vendor/js-init/chartjs/init-creative-state-chart.js"></script>
    <script src="assets/vendor/js-init/chartjs/init-area-chart.js"></script>
    <script src="assets/vendor/js-init/chartjs/init-line-chart.js"></script>
    <script src="assets/vendor/js-init/chartjs/init-doughnut-chart.js"></script>
    <script src="assets/vendor/js-init/chartjs/init-doughnut-chart2.js"></script>
    <script src="assets/vendor/js-init/chartjs/init-sales-report-chart.js"></script>
    <script src="assets/vendor/js-init/chartjs/init-bubble-chart.js"></script>

    <!--flot chart-->
    <script src="assets/vendor/flot/jquery.flot.min.js"></script>
    <script src="assets/vendor/flot/jquery.flot.pie.min.js"></script>
    <script src="assets/vendor/flot/jquery.flot.tooltip.min.js"></script>
    <!--flot chart initialization-->
    <script src="assets/vendor/js-init/flot/init-flot-widget.js"></script>

    <!--vectormap-->
    <script src="assets/vendor/vector-map/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="assets/vendor/vector-map/jquery-jvectormap-world-mill-en.js"></script>
    <!--vectormap initialization-->
    <script src="assets/vendor/js-init/vmap/init-vmap-world.js"></script>

    <!--[if lt IE 9]>
    <script src="assets/vendor/modernizr.js"></script>
    <![endif]-->

    <!--basic scripts initialization-->
    <script src="assets/js/scripts.min.js"></script>
    
    <script type="text/javascript">
        function includeHTML() {
          var z, i, elmnt, file, xhttp;
          /*loop through a collection of all HTML elements:*/
          z = document.getElementsByTagName("*");
          for (i = 0; i < z.length; i++) {
            elmnt = z[i];
            /*search for elements with a certain atrribute:*/
            file = elmnt.getAttribute("w3-include-html");
            if (file) {
              /*make an HTTP request using the attribute value as the file name:*/
              xhttp = new XMLHttpRequest();
              xhttp.onreadystatechange = function() {
                if (this.readyState == 4) {
                  if (this.status == 200) {elmnt.innerHTML = this.responseText;}
                  if (this.status == 404) {elmnt.innerHTML = "Page not found.";}
                  /*remove the attribute, and call this function once more:*/
                  elmnt.removeAttribute("w3-include-html");
                  includeHTML();
                }
              } 
              xhttp.open("GET", file, true);
              xhttp.send();
              /*exit the function:*/
              return;
            }
          }
        }

        includeHTML();
    </script>

</body>

<!-- Mirrored from thevectorlab.net/dashlab-v1.1/ by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 22 Mar 2018 06:10:23 GMT -->
</html>

