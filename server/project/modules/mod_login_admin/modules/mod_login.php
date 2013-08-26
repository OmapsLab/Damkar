<title>{TITLE}</title>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
<style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
      }

      .form-signin {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }

</style>
<div class="container">
	<form class="form-signin" method="post" action="{SITE_INDEX}mod_login/login_attempt">
		<h2 class="form-signin-heading">Minag-Resto Admin</h2>
		<?php @$n = $_GET['n'];?>
		<?php if ($n == "err_null") {?>
		<div class="alert alert-error">
		    <button type="button" class="close" data-dismiss="alert">&times;</button>
		    <strong>Error!!!</strong> Field Masih Kosong
		</div>
		<?php } else if ($n == "err_user") {?>
		<div class="alert alert-error">
		    <button type="button" class="close" data-dismiss="alert">&times;</button>
		    <strong>Error!!!</strong> User tidak terdeteksi..!!
		</div>
		<?php } else if ($n == "err_pass") {?>
		<div class="alert alert-error">
		    <button type="button" class="close" data-dismiss="alert">&times;</button>
		    <strong>Error!!!</strong> Password Salah..!!
		</div>
		<?php }?>
		<input name="user" type="text" class="input-block-level" placeholder="Email address">
		<input name="pass" type="password" class="input-block-level" placeholder="Password">
		<button class="btn btn-large btn-primary" type="submit">Masuk</button>
	</form>
</div>
<?=$head?>