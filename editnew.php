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
							<div class="scope_title"><font size='4'>Search Account</font></div>
							 <div class="contact_page"><!--contact_page div start-->
								
								<div class="contact_page_left"><!--contact_page_right div satrt-->
									<form class="custTable" action="editnew.php" method ="post" name="custDetails">
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
			 <div class="inner_services"><!--inner_services div start--><br>			 <br><br><br>
				<div class="scope_title"><font size='4'>Edit Customer Details</font></div>
				<div class="in_services_desc"><!--in_services_desc div start-->
					<p>
							
						<div class="scope_desc"><!--scope_desc div start-->
							<div class="scope_title"></div>
							 <div class="contact_page"><!--contact_page div start-->
								
								<div class="contact_page_left"><!--contact_page_right div satrt-->
									<form class="custTable" action="editnew.php" method ="post" name="custDetails">
									
									<div class="conatctpage_labeltext"><!--conatctpage_labeltext div start-->
										<div class="contact_name">Smart Meter Id<span></span></div>
										<div class="contactpage_textbox"><input type="text" name="smartmeterid" value="<?php echo $user_info['AccountId'];?>" class="cpagetextbox_text" required readonly/></div>
									 </div>
									 <div class="conatctpage_labeltext"><!--conatctpage_labeltext div start-->
										<div class="contact_name">Customer Name<span>*</span></div>
										<div class="contactpage_textbox"><input type="text" name="customername" value="<?php echo $user_info['Name'];?>" class="cpagetextbox_text" required /></div>
									 </div><!--conatctpage_labeltext div end-->
									 
									 <div class="conatctpage_labeltext"><!--conatctpage_labeltext div start-->
										<div class="contact_name">Address line<span></span></div>
										<div class="contactpage_textbox"><input type="text" name="addressline" value="<?php echo $user_info['AddressLine'];?>" class="cpagetextbox_text" required /></div>
									 </div><!--conatctpage_labeltext div end-->
									 
									 <div class="conatctpage_labeltext"><!--conatctpage_labeltext div start-->
										<div class="contact_name">Street<span></span></div>
										<div class="contactpage_textbox"><input type="text" name="addressstreet" value="<?php echo $user_info['AddressStreet'];?>" class="cpagetextbox_text" required /></div>
									 </div><!--conatctpage_labeltext div end-->
									 
									 <div class="conatctpage_labeltext"><!--conatctpage_labeltext div start-->
										<div class="contact_name">City <span></span></div>
										<div class="contactpage_textbox"><input type="text" name="addresscity" value="<?php echo $user_info['AddressCity'];?>" class="cpagetextbox_text" required /></div>
									 </div><!--conatctpage_labeltext div end-->
									 
									  <div class="conatctpage_labeltext"><!--conatctpage_labeltext div start-->
										<div class="contact_name">State<span></span></div>
										<div class="contactpage_textbox"><input type="text" name="addressstate" value="<?php echo $user_info['AddressState'];?>" class="cpagetextbox_text" required /></div>
									 </div><!--conatctpage_labeltext div end-->
									 
									 <div class="conatctpage_labeltext"><!--conatctpage_labeltext div start-->
										<div class="contact_name">Pincode<span></span></div>
										<div class="contactpage_textbox"><input type="number" name="addresspincode" value="<?php echo $user_info['AddressPinCode'];?>" class="cpagetextbox_text" required /></div>
									 </div><!--conatctpage_labeltext div end-->
									 
									 <div class="conatctpage_labeltext"><!--conatctpage_labeltext div start-->
										<div class="contact_name">Currency<span></span></div>
										<div class="contactpage_textbox"><input type="text" name="currency" value="<?php echo $user_info['Currency'];?>" class="cpagetextbox_text" required /></div>
									 </div><!--conatctpage_labeltext div end-->
									 
									 <div class="conatctpage_labeltext"><!--conatctpage_labeltext div start-->
										<div class="contact_name">Start Date <span></span></div>
										<div class="contactpage_textbox"><input type="text" id="datepicker" value="<?php echo $user_info['StartDate'];?>" name="startdate" class="cpagetextbox_text" required /></div>
									 </div><!--conatctpage_labeltext div end-->
									 
									  <div class="conatctpage_labeltext"><!--conatctpage_labeltext div start-->
										<div class="contact_name">Rounding<span></span></div>
										<div class="contactpage_textbox"><input type="number" name="rounding" value="<?php echo $user_info['RoundTo'];?>" class="cpagetextbox_text" required /></div>
									 </div><!--conatctpage_labeltext div end-->
									 
									 <div class="conatctpage_labeltext"><!--conatctpage_labeltext div start-->
										<div class="conatctpage_submit"><input type="submit" name="Update" class="sub_button" value="submit"/></div>
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
	}
	?>
<?php include_once('footer.php');
 if (isset($_POST['Update'])) {
	
//echo "Customer Name :.$customername.$addressline.$addressstreet.$addresscity.$addressstate.$addresspincode.$currency.
//$startdate.$activationdate.$enddate.$lastbilldate.$status.$accountid.$accountbalance";

$customername 	= $_POST["customername"];
$addressline	= $_POST["addressline"];
$addressstreet 	= $_POST["addressstreet"];
$addresscity 	= $_POST["addresscity"];
$addressstate 	= $_POST["addressstate"];
$addresspincode = $_POST["addresspincode"];
$currency 		= $_POST["currency"];
$startdate 		= $_POST["startdate"];
$rounding 		= $_POST["rounding"];
$smartmeterid  = $_POST['smartmeterid'];
//print_r($_POST);
if(empty($customername) || $customername == ""){
	echo "<script>window.alert('Customer Name cannot be null.');</script>";	
 }else{
$sql = "UPDATE customer SET 
Name ='$customername',AddressLine='$addressline',AddressStreet='$addressstreet',AddressCity='$addresscity',AddressState='$addressstate',AddressPinCode='$addresspincode',
Currency='$currency',StartDate=STR_TO_DATE('$startdate', '%m/%d/%Y') WHERE AccountId='$smartmeterid'";


$updateAccount ="update account set RoundTo=$rounding WHERE AccountId='$smartmeterid'";
if(mysqli_query($conn, $sql) === TRUE)
{	
	if(mysqli_query($conn, $updateAccount) === TRUE){
	echo "<script>window.alert('Customer Updated ...');</script>";	
	}
} 
else
{
    echo "Error: " . $sql . "<br>" . $conn->error;
}
 }
/*$r = mysqli_query($dbc,$sql);
if(mysqli_affected_rows($dbc) ==1){
 echo "<script>window.alert('Customer Added ...')</script>";
}
else
{	
 echo "Error is :".mysqli_connect_error();
 echo "Error is :".mysqli_connect_errno();
}*/
mysqli_close($conn);
}
?>
