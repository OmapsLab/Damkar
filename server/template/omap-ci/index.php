<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>{TITLE}</title>
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <link rel="stylesheet" type="text/css" href="{SITE_TEMPLATE}{THEME}/lib/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="{SITE_TEMPLATE}{THEME}/stylesheets/theme.css">
    <link rel="stylesheet" href="{SITE_TEMPLATE}{THEME}/lib/font-awesome/css/font-awesome.css">
    <script src="{SITE_TEMPLATE}{THEME}/lib/jquery-1.7.2.min.js" type="text/javascript"></script>
	<script type="text/javascript">
	var base_url = $(location).attr('protocol') + "//" + $(location).attr('host') + "/damkar/";
	</script>
	{HEAD}
    <!-- Demo page code -->
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
    
    <link rel="shortcut icon" href="../assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
  </head>
  
  <body class="">  
    <div class="navbar">
        <div class="navbar-inner">
                <ul class="nav pull-right">
                    <li id="fat-menu" class="dropdown">
                        <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="icon-user"></i> Admin
                            <i class="icon-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a tabindex="-1" href="{SITE_INDEX}mod_login/logout">Logout</a></li>
                        </ul>
                    </li>
                </ul>
                <a class="brand" href="{SITE}"><span class="first">DAMKAR</span> <span class="second">Admin</span></a>
        </div>
    </div>
    <div class="sidebar-nav">
        <form class="search form-inline">
            <input type="text" placeholder="Search...">
        </form>
        
        <a href="{SITE_INDEX}" class="nav-header"><i class="icon-dashboard"></i>Dashboard</a>
        <a href="#accounts-menu" class="nav-header" data-toggle="collapse"><i class="icon-briefcase"></i>Laporan Kebakaran<span class="label label-important">+3</span></a>
        <ul id="accounts-menu" class="nav nav-list collapse">
            <li ><a href="{SITE_INDEX}laporan">All</a></li>
            <li ><a href="{SITE_INDEX}laporan">New</a></li>
        </ul>        
        <a href="#legal-menu" class="nav-header" data-toggle="collapse"><i class="icon-legal"></i>Maps</a>
        <a href="help.html" class="nav-header" ><i class="icon-question-sign"></i>Help</a>
        <a href="faq.html" class="nav-header" ><i class="icon-comment"></i>Faq</a>
    </div>
    <div class="content">
        <div class="header">
            <div class="stats">
			    <p class="stat"><span class="number">53</span>tickets</p>
			    <p class="stat"><span class="number">27</span>tasks</p>
			    <p class="stat"><span class="number">15</span>waiting</p>
			</div>
            <h1 class="page-title">Dashboard</h1>
        </div>
        <ul class="breadcrumb">
            <li><a href="{SITE_INDEX}">Home</a> <span class="divider">/</span></li>
            <li class="active">Dashboard</li>
        </ul>

        <div class="container-fluid">
			{DASBOR}
            <footer>
            <hr>
            <p>&copy; 2012 Damkar</p>
            </footer>  
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