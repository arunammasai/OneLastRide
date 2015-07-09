<?php
	include_once('header.php');
	include_once('database.php');
	
	if( ! empty($_SESSION['id_user']))
		header("Location: view.php");
?>

<script>
	$(document).ready(function()
	{
		$('#menu li a').removeClass('active');
		$('#menu #signup a').addClass('active');
		$('body').animate({scrollTop :450}, 2000);
		$( "#datepicker" ).datepicker();
	});
</script>
  
    <div class="rk_maincontent"><!--rk_maincontent div start-->
    	<div class="rk_centercontent"><!--rk_centercontent div start-->
			 <div class="inner_services"><!--inner_services div start-->
				<!--div class="in_servicestitle"><img src="images/leftarrow_image.png" alt="" align="left" /><span>Register</span></div-->
				<div class="in_services_desc"><!--in_services_desc div start-->
					<p>
							
						<div class="scope_desc"><!--scope_desc div start-->
							<div class="scope_title"><font size="3">Register</font></br></div>
							 <div class="contact_page"><!--contact_page div start-->
								
								<div class="contact_page_left"><!--contact_page_right div satrt-->
									<form class="custTable" action="signup.php" method ="post" name="custDetails">
									 <div class="conatctpage_labeltext">
										<div class="contact_name">User Name<span>*</span></div>
										<div class="contactpage_textbox"><input type="text" name="customername" class="cpagetextbox_text" required /></div>
									 </div>
									 
									 <div class="conatctpage_labeltext">
										<div class="contact_name">Password<span>*</span></div>
										<div class="contactpage_textbox"><input type="password" name="password" class="cpagetextbox_text" required /></div>
									 </div>
									 
									 <!--div class="conatctpage_labeltext">
										<div class="contact_name">Address line<span>*</span></div>
										<div class="contactpage_textbox"><input type="text" name="addressline" class="cpagetextbox_text" required /></div>
									 </div>
									 
									 <div class="conatctpage_labeltext">
										<div class="contact_name">Street<span>*</span></div>
										<div class="contactpage_textbox"><input type="text" name="addressstreet" class="cpagetextbox_text" required /></div>
									 </div>
									 
									 <div class="conatctpage_labeltext">
										<div class="contact_name">City <span>*</span></div>
										<div class="contactpage_textbox"><input type="text" name="addresscity" class="cpagetextbox_text" required /></div>
									 </div>
									 
									  <div class="conatctpage_labeltext">
										<div class="contact_name">State<span>*</span></div>
										<div class="contactpage_textbox"><input type="text" name="addressstate" class="cpagetextbox_text" required /></div>
									 </div>
									 
									 <div class="conatctpage_labeltext">
										<div class="contact_name">Country <span>*</span></div>
										<div class="contactpage_textbox"><input type="text" name="country" class="cpagetextbox_text" required /></div>
									 </div>
									 
									 <div class="conatctpage_labeltext">
										<div class="contact_name">Pincode<span>*</span></div>
										<div class="contactpage_textbox"><input type="number" name="addresspincode" class="cpagetextbox_text" required /></div>
									 </div>
									 
									 <div class="conatctpage_labeltext">
										<div class="contact_name">Currency<span>*</span></div>
										<div class="contactpage_textbox"><input type="text" name="currency" class="cpagetextbox_text" required /></div>
									 </div>
									 
									 <div class="conatctpage_labeltext">
										<div class="contact_name">Start Date <span>*</span></div>
										<div class="contactpage_textbox"><input type="text" id="datepicker" name="startdate" class="cpagetextbox_text" required /></div>
									 </div>
									 
									  <div class="conatctpage_labeltext">
										<div class="contact_name">Rounding<span>*</span></div>
										<div class="contactpage_textbox"><input type="number" name="rounding" class="cpagetextbox_text" required /></div>
									 </div-->
									 
									 <div class="conatctpage_labeltext">
										<div class="conatctpage_submit"><input type="submit" name="submitBut" class="sub_button" value="submit"/></div>
									  </div>
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
	
<?php include_once('footer.php'); ?>

<?php
if (isset($_POST['submitBut'])) {
	
//echo "Customer Name :.$customername.$addressline.$addressstreet.$addresscity.$addressstate.$addresspincode.$currency.
//$startdate.$activationdate.$enddate.$lastbilldate.$status.$accountid.$accountbalance";

$customername = $_POST["customername"];
$password = $_POST["password"];
/**$addressline = $_POST["addressline"];
$addressstreet = $_POST["addressstreet"];
$addresscity = $_POST["addresscity"];
$addressstate = $_POST["addressstate"];
$addresspincode = $_POST["addresspincode"];
$currency = $_POST["currency"];
$startdate = $_POST["startdate"];
$rounding = $_POST["rounding"]; 

$sql = "INSERT INTO customer (Name,password,AddressLine,AddressStreet,AddressCity,AddressState,AddressPinCode,Currency,StartDate) VALUES
('$customername','$password','$addressline','$addressstreet','$addresscity','$addressstate','$addresspincode',
'$currency',STR_TO_DATE('$startdate', '%m/%d/%Y'))";**/
$sql = "INSERT INTO customer (Name,password) VALUES ('$customername','$password')";
if(mysqli_query($conn, $sql) === TRUE)
{
	$last_id = mysqli_insert_id($conn);
	$query	=	"INSERT INTO account (AccountId) VALUES ('$last_id')";
	
	if(mysqli_query($conn, $query) === TRUE)	
		 echo "<script>window.alert('User Added successfully.')</script>";	
	else
		 echo "<script>window.alert('User Not Added successfully.')</script>";
} 
else
{
    echo "Error: " . $sql . "<br>" . $conn->error;
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
