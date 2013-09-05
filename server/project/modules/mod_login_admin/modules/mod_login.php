<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Admin</title>
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" type="text/css" href="{SITE_TEMPLATE}{THEME}/lib/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="{SITE_TEMPLATE}{THEME}/stylesheets/theme.css">
    <link rel="stylesheet" href="{SITE_TEMPLATE}{THEME}/lib/font-awesome/css/font-awesome.css">
    <script src="{SITE_TEMPLATE}{THEME}/lib/jquery-1.7.2.min.js" type="text/javascript"></script>
    <style type="text/css">
        #line-chart {
            height:300px;
            width:800px;
            margin: 0px auto;
            margin-top: 1em;
        }
        .brand { font-family: georgia, serif; }
        .brand .first {
            color: #ccc;
            font-style: italic;
        }
        .brand .second {
            color: #fff;
            font-weight: bold;
        }
    </style>
    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="{SITE_TEMPLATE}{THEME}/assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{SITE_TEMPLATE}{THEME}/assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{SITE_TEMPLATE}{THEME}/assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{SITE_TEMPLATE}{THEME}/assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="{SITE_TEMPLATE}{THEME}/assets/ico/apple-touch-icon-57-precomposed.png">
  </head>
 
  <body class="">
    <div class="navbar">
        <div class="navbar-inner">
                <ul class="nav pull-right">
                    
                </ul>
                <a class="brand" href="index.html"><span class="first">DAMKAR</span> <span class="second">Admin</span></a>
        </div>
    </div>
    <div class="row-fluid">
	    <div class="dialog">
	        <div class="block">
	            <p class="block-heading">Sign In</p>
	            <div class="block-body">
	                <form method="post" action="{SITE_INDEX}mod_login/login_attempt">
	                    <label>Username</label>
	                    <input name="user" type="text" class="span12">
	                    <label>Password</label>
	                    <input name="pass" type="password" class="span12">
	                    <button class="btn btn-primary pull-right">Sign In</button>
	                    <label class="remember-me"><input type="checkbox"> Remember me</label>
	                    <div class="clearfix"></div>
	                </form>
	            </div>
	        </div>
	    </div>
	</div>
    <script src="{SITE_TEMPLATE}{THEME}/lib/bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript">
        $("[rel=tooltip]").tooltip();
        $(function() {
            $('.demo-cancel-click').click(function(){return false;});
        });
    </script>
  </body>
</html>