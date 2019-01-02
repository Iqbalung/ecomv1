<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
  <head>
    <title>Login | <?php echo $this->config->item('app_name').' - '.$this->config->item('client_name') ?></title>
    <link rel="shortcut icon" href="<?php echo $this->config->item('client_logo') ?>" type="image/x-icon" />
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?php echo $this->config->item('url_bootstrap') ?>css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('url_bootstrap') ?>dist/css/AdminLTE.min.css">
    <script src="<?php echo $this->config->item('url_plugins').'jQuery/jQuery-2.1.4.min.js' ?>"></script>
   
    <script type="text/javascript" src="<?php echo $this->config->item('url_media') ?>js/login.js"></script>
    <script type="text/javascript">
    app = {};
    app.site_url = '<?php echo site_url() ?>';
    app.base_url = '<?php echo base_url() ?>';
    </script>
    
  </head>
  <body>
    <br><br><br>
    <div id="lupa_sandi">
      <div class="ct_lupa">
        <ol>
          <?php if($this->config->item('use_email')){ ?>
          <li><br />
            <input type="text" placeholder="email" class="email_reset">
            <input type="button" value="Reset" class="button_reset" style="padding: 3px; margin: 3px; margin-bottom: 10px;"><br >
            <span class="msg_reset"></span>
            <br />
          </li>
          <?php } ?>
        </ol>
      </div>
    </div>

    <div class="">
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-5 bg-form" style="width: 300px;">
            <div class="col-xs-12 text-center" style="margin-bottom: 20px;">
            </div>
            <div class="text-center" style="color: #AEB6B9; text-transform: uppercase; font-weight: bold; font-size: 20px; line-height: 100%; margin-bottom: 10px;">Sudah Punya Akun ? </div>
            
            <form role="form" id="login" style="width: 80%;margin-left: 10%;">
              <div id="pesan"></div>
              <div class="form-group">
                <input type="text" class="form-control" id="username" name="uname" placeholder="Username" required="" style="height: 50px;">
                <input type="password" class="form-control" id="password" name="pwd" placeholder="Password" required="" style="height: 50px;">
              </div>
              <div class="form-group" style="background: none;">
                <input type="checkbox" class="check-login" id="ingat_saya" name="ingat_saya"> Remember Me
              </div>
              <div class="form-group">
                <button type="button" class="btn btn-success btn-flat form-control" id="masuk">Login</button>
              </div>
              <!--  <div class="form-group" style="background: none;">
                <span style="cursor: pointer;" id="lupa">Lupa Kata Sandi?</span>
              </div> -->
            </form>
          </div>
          <div class="col-md-7" style="">
            <div class="row">
              
              
              <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
              <div class="col-xs-12 col-sm-10 pull-right">
                <div class="text-center" style="color: #AEB6B9; text-transform: uppercase; font-weight: bold; font-size: 20px; line-height: 100%; margin-bottom: 10px;">Belum Punya Akun ? </div>
                <form id="register">
                <div class="form-group">
                  <label style="color: #AEB6B9;" for="username">Nama</label>
                  <input  style="height: 50px;" type="text"class="form-control"  name="rusername" value="">
                </div>
                
                
                <div class="form-group">
                  <label style="color: #AEB6B9;" for="username">Email</label>
                  <input  style="height: 50px;" type="text"class="form-control"  name="email" value="">
                </div>
                <div class="form-group">
                  <label style="color: #AEB6B9;" for="password">Password : </label>
                  <input  style="height: 50px;" type="password"class="form-control"  name="rpassword" value="" >
                  <label style="color: #AEB6B9;" for="password">Re-Type Password : </label>
                  <input  style="height: 50px;" type="password"class="form-control"  name="repassword" value="" >
                </div>
                
                
                <div class="form-group">
                  <label style="color: #AEB6B9;" for="username">Handphone</label>
                  <input  style="height: 50px;" type="text"class="form-control"  name="no_hp" value="">
                </div>
                <div class="form-group">
                  <label style="color: #AEB6B9;" for="username">Koepos</label>
                  <input  style="height: 50px;" type="text"class="form-control"  name="kodepos" value="">
                </div>
                
                <select style="height:50px;" class="form-control" name="propinsi_tujuan" id="propinsi_tujuan" value="">
                  <option value="" selected="" disabled="">Pilih Provinsi</option>
                  <?php //$this->load->view('rajaongkir/getProvince'); ?>
                </select>
                <br>
                <select style="height: 50px;" class="form-control" name="destination" id="destination" value="">
                  <option value="" selected="" disabled="">Pilih Kota</option>
                </select><br>
                <div class="form-group">
                  <label style="color: #AEB6B9;" for="username">Alamat</label>
                  <input  style="height: 50px;" type="text"class="form-control"  name="alamat" value=">">
                </div>
                </form>
                <div class="form-group">
                  <div class="col-md-2"></div>
                  <div class="col-md-7">
                    <button type="submit" id="daftar" class="btn btn-success">Register</button>
                    <?=  anchor(base_url(),'Cancel',['class'=>'btn ']) ?>
                    
                  </div>
                  <div class="col-md-3">
                    <?=  anchor('Login','Login',['class'=>'btn  btn-default']) ?>
                  </div>
                </div>
                <div class="panel-body">
                  <br>
                  
                </div>
                <div class="panel-body">
                  
                  <br>
                  
                </div>
                
                
              </div>
            </div>
          </div>
          
        </div>
        
      </div>
    </div>
  </div>
</div>
<?php $this->load->view('main-inc/jquery_validation') ?>
</body>
</html>