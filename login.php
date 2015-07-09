<?php
	include_once('header.php');
	include_once('database.php');
	
	if( ! empty($_SESSION['id_user']))
		header("Location: search.php");	
?>
<script>
	$(document).ready(function()
	{
		$('#menu li a').removeClass('active');
		$('#menu #login a').addClass('active');
		
		$('body').animate({scrollTop :450}, 2000);
	});
</script>
  
    <div class="rk_maincontent"><!--rk_maincontent div start-->
    	<div class="rk_centercontent"><!--rk_centercontent div start-->
			 <div class="inner_services"><!--inner_services div start-->
				<div class="in_services_desc"><!--in_services_desc div start-->
					<p>
							
						<div class="scope_desc"><!--scope_desc div start-->
							<div class="scope_title"><font size="4">Login</font></div>
							 <div class="contact_page"><!--contact_page div start-->
								
								<div class="contact_page_left"><!--contact_page_right div satrt-->
									<form class="custTable" action="logincheck.php" method ="post" name="custDetails">
									 <div class="conatctpage_labeltext"><!--conatctpage_labeltext div start-->
										<div class="contact_name">User Name<span>*</span></div>
										<div class="contactpage_textbox"><input type="text" name="customername" class="cpagetextbox_text" required /></div>
									 </div><!--conatctpage_labeltext div end-->
									 
									 <div class="conatctpage_labeltext"><!--conatctpage_labeltext div start-->
										<div class="contact_name">Password<span>*</span></div>
										<div class="contactpage_textbox"><input type="password" name="password" class="cpagetextbox_text" required /></div>
									 </div><!--conatctpage_labeltext div end-->
									 
									 <div class="conatctpage_labeltext"><!--conatctpage_labeltext div start-->
										<div class="conatctpage_submit"><input type="submit" name="submitBut" class="sub_button" value="submit"/></div>
									  </div><!--conatctpage_labeltext div end-->
									 </form>
								</div><!--contact_page_right div end-->
							 </div><!--contact_page div end-->
										 
						 </div><!--scope_desc div end-->
					</p>
				</div><!--in_services_desc div end-->
		   
				</div><!--inner_services div end-->
           
            <div class="clear"></div>
        </div><!--rk_centercontent div end-->
    <div class=" clear"></div>
    </div><!--rk_maincontent div end-->
	
<?php include_once('footer.php');

//if($_GET['error'] == 1)
	//echo "<script>window.alert('Invalid user')</script>";
?>
