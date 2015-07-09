<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>TNEB - TAMILNADU ELECTRICITY BOARD</title>
<link href="css/rk_style.css" rel="stylesheet" type="text/css" />
</head>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

  
<body>
<?php session_start();?>
<div class="header_main"><!--header_main div satrt-->
    	<div class="rk_header"><!--rk_header div satrt-->
        	<div class="rk_headtop"><!--rk_headtop div satrt-->
        		
            </div><!--rk_headtop div end-->
            <div class="clear"></div>
            <div class="rk_headbottom"><!--rk_headbottom div start-->
            	<div class="main_menu"><!--main_menu div satrt-->
                	<ul id="menu">                                                                             
                    	<li id="home"><a class="active" href="index.php">HOME PAGE</a></li>
						  
						<?php if( ! empty($_SESSION['id_user'])) {?>
                        <li id="edit"><a href="editnew.php">EDIT </a></li>
						<li id="signup"><a href="registerCustomer.php">ADD CUSTOMER </a></li>	
                        <li id="view"><a href="search.php">SEARCH</a></li>
						<li id="gallery"><a href="gallery.php">GALLERY</a></li>
						<li id="invoice"><a href="invoices.php">INVOICE</a></li>
						<li id="loadusagedata"><a href="loadusage.php">LOAD USAGE DATA</a></li>
						<li id="performbillrun"><a href="performBillRun1.php">PERFORM BILL RUN</a></li>
						<!--li id="view"><a href="invoices.php">INVOICES</a></li-->
						<li><a href="logout.php">LOGOUT </a></li>						
						<?php }else{?>
						<li id="gallery"><a href="gallery.php">GALLERY</a></li>
						<li id="signup"><a href="signup.php">SIGN UP </a></li>	
						<li id="login"><a  class="active" href="login.php">LOGIN </a></li>
						<?php }?>
                    </ul>
                </div><!--main_menu div end-->
            </div><!--rk_headbottom div end-->
        </div><!--rk_header div end-->
        <div class="clear"></div>
    </div><!--header_main div end-->
