<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Login | <?php echo $this->config->item('app_name').' - '.$this->config->item('client_name') ?></title>
<link rel="shortcut icon" href="<?php echo $this->config->item('client_logo') ?>" type="image/x-icon" />
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<link rel="stylesheet" href="<?php echo $this->config->item('url_bootstrap') ?>css/bootstrap.min.css">

<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('url_bootstrap') ?>dist/css/AdminLTE.min.css">

<script src="<?php echo $this->config->item('url_plugins').'jQuery/jQuery-2.1.4.min.js' ?>"></script>
<link rel="stylesheet" href="<?php echo $this->config->item('url_media') ?>css/login.css">
<script type="text/javascript" src="<?php echo $this->config->item('url_media') ?>js/login.js"></script>
<script type="text/javascript">
	app = {};
	app.site_url = '<?php echo site_url() ?>';
	app.base_url = '<?php echo base_url() ?>';
</script>
        
</head>
<body>
	<div id="lupa_sandi">
		<div class="ct_lupa">
		<div id="close"> x </div>
		<b>Jika anda lupa kata sandi : </b>
		<ol>
		<li>Harap hubungi bagian TU atau administrator</li>
		<li>Sebutkan username anda</li>
		<li>Bagian TU / Administrator akan mengatur ulang kata sandi anda</li>
		<?php if($this->config->item('use_email')){ ?>
		<li>Atau mereset password dengan mengisi email dibawah<br />
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
	        <div class="col-md-5 bg-form pull-right" style="">
	          <div class="col-xs-12 text-center" style="margin-bottom: 20px;">
	           </div>
	          	<div class="text-center" style="color: #AEB6B9; text-transform: uppercase; font-weight: bold; font-size: 20px; line-height: 100%; margin-bottom: 10px;"><?php echo config_item('app_longname') ?> Member Version</div>
	          	
	          <form role="form" id="login">
				<div id="pesan"></div>
	            <div class="form-group">
	                <input type="text" class="form-control" id="username" name="uname" placeholder="Nama User" required="" style="height: 50px;">
	                <input type="password" class="form-control" id="password" name="pwd" placeholder="Kata Sandi" required="" style="height: 50px;">
	            </div>	            
	        	<div class="form-group" style="background: none;">
	              <input type="checkbox" class="check-login" id="ingat_saya" name="ingat_saya"> Ingat Saya
	            </div>
	        	<div class="form-group">
	              <button type="button" class="btn btn-success btn-flat form-control" id="masuk2">Masuk</button>
	            </div>
	            <div class="form-group" style="background: none;">
	              <span style="cursor: pointer;" id="lupa">Lupa Kata Sandi?</span>
	            </div>
	          </form>
	        </div>
	      </div>
	    </div>
	  </div>
  <?php $this->load->view('main-inc/jquery_validation') ?>
</body>
</html>