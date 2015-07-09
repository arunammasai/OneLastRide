<?php
	include_once('header.php');
	include_once('database.php');
	
	if( empty($_SESSION['id_user']))
		header("Location: index.php");	
?>
<script>
	$(document).ready(function()
	{
		$('#menu li a').removeClass('active');
		$('#menu #login a').addClass('active');
		
		$('body').animate({scrollTop :500}, 2000);
	});
</script>
  
    <div class="rk_maincontent"><!--rk_maincontent div start-->
    	<div class="rk_centercontent"><!--rk_centercontent div start-->
			 <div class="inner_services"><!--inner_services div start-->
				<div class="in_services_desc"><!--in_services_desc div start-->
					<p>
							
						<div class="scope_desc"><!--scope_desc div start-->
							<div class="scope_title"><font size='4'>Search by Smart Meter Id</font></div>
							 <div class="contact_page"><!--contact_page div start-->
								
								<div class="contact_page_left"><!--contact_page_right div satrt-->
									<form class="custTable" action="search.php" method ="post" name="custDetails">
									 <div class="conatctpage_labeltext"><!--conatctpage_labeltext div start-->
										<div class="contact_name">Smart Meter Id<span>*</span></div>
										<div class="contactpage_textbox"><input type="text" name="smartmeterid" class="cpagetextbox_text" required /></div>
									 </div><!--conatctpage_labeltext div end-->									 
									 
									 <div class="conatctpage_labeltext"><!--conatctpage_labeltext div start-->
										<div class="conatctpage_submit"><input type="submit" name="submitBut" class="sub_button" value="Search"/></div>
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


<?php 
if (isset($_POST['submitBut'])) {
	$smartmeterid = $_POST['smartmeterid'];
	$query = "SELECT * FROM customer cust,account acc WHERE cust.AccountId = acc.AccountId and cust.AccountId=".$smartmeterid;
	$result	= mysqli_query($conn, $query);
	
	$user_info = mysqli_fetch_array($result);
	
	if(empty($user_info))
		//header("Location: search.php");
	echo "<script>alert('Meter Id not found');</script>";
	
}
?>
<?php 
if(!empty($user_info)){

?>
<div class="rk_maincontent"><!--rk_maincontent div start-->
    	<div class="rk_centercontent"><!--rk_centercontent div start-->
			 <div class="inner_services"><!--inner_services div start-->	
<br>			 <br><br><br>
				<div class="in_servicestitle"><img src="images/leftarrow_image.png" alt="" align="left" /><span>View Customer Details</span></div>
				<div class="in_services_desc"><!--in_services_desc div start-->
					<p>
							
						<div class="scope_desc"><!--scope_desc div start-->							
							 <div class="contact_page"><!--contact_page div start-->
								
								<div class="contact_page_left"><!--contact_page_right div satrt-->
									
									 <div class="conatctpage_labeltext"><!--conatctpage_labeltext div start-->
										<div class="contact_name">Customer Name<span></span></div>
										<div class="contactpage_textbox"><?php echo $user_info['Name'];?></div>
									 </div><!--conatctpage_labeltext div end-->
									 
									 <div class="conatctpage_labeltext"><!--conatctpage_labeltext div start-->
										<div class="contact_name">Address<span></span></div>
										<div class="contactpage_textbox"><?php echo $user_info['AddressLine'].','.$user_info['AddressStreet'].','.$user_info['AddressCity'].','.$user_info['AddressState'];?></div>
									 </div><!--conatctpage_labeltext div end-->
									 
									 <!--div class="conatctpage_labeltext">
										<div class="contact_name">Address line<span></span></div>
										<div class="contactpage_textbox"><?php echo $user_info['AddressLine'];?></div>
									 </div>
									 
									 <div class="conatctpage_labeltext">
										<div class="contact_name">Street<span></span></div>
										<div class="contactpage_textbox"><?php echo $user_info['AddressStreet'];?></div>
									 </div>
									 
									 <div class="conatctpage_labeltext">
										<div class="contact_name">City <span></span></div>
										<div class="contactpage_textbox"><?php echo $user_info['AddressCity'];?></div>
									 </div>
									 
									  <div class="conatctpage_labeltext">
										<div class="contact_name">State<span></span></div>
										<div class="contactpage_textbox"><?php echo $user_info['AddressState'];?></div>
									 </div-->
									 
									 <div class="conatctpage_labeltext"><!--conatctpage_labeltext div start-->
										<div class="contact_name">Pincode<span></span></div>
										<div class="contactpage_textbox"><?php echo $user_info['AddressPinCode'];?></div>
									 </div><!--conatctpage_labeltext div end-->
									 
									 <div class="conatctpage_labeltext"><!--conatctpage_labeltext div start-->
										<div class="contact_name">Currency<span></span></div>
										<div class="contactpage_textbox"><?php echo $user_info['Currency'];?></div>
									 </div><!--conatctpage_labeltext div end-->
									 
									 <div class="conatctpage_labeltext"><!--conatctpage_labeltext div start-->
										<div class="contact_name">Start Date <span></span></div>
										<div class="contactpage_textbox"><?php echo $user_info['StartDate'];?></div>
									 </div><!--conatctpage_labeltext div end-->
									 
									 <!--div class="conatctpage_labeltext">
										<div class="contact_name">Active Date <span></span></div>
										<div class="contactpage_textbox"><?php echo $user_info['ActiveDate'];?></div>
									 </div>
									 
									 <div class="conatctpage_labeltext">
										<div class="contact_name">End Date <span></span></div>
										<div class="contactpage_textbox"><?php echo $user_info['EndDate'];?></div>
									 </div>
									 
									 <div class="conatctpage_labeltext">
										<div class="contact_name">Last Bill Date <span></span></div>
										<div class="contactpage_textbox"><?php echo $user_info['LastBillDate'];?></div>
									 </div-->
									 
									  <div class="conatctpage_labeltext"><!--conatctpage_labeltext div start-->
										<div class="contact_name">Rounding<span></span></div>
										<div class="contactpage_textbox"><?php echo $user_info['RoundTo'];?></div>
									 </div><!--conatctpage_labeltext div end-->
									 
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
	<?php
	}
	?>
	
	<?php include_once('footer.php');
//if($_GET['error'] == 1)
	//echo "<script>window.alert('Invalid user')</script>";
?>
