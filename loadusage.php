<?php
	include_once('header.php');
	include_once('database.php');
	
	if(empty($_SESSION['id_user']))
		header("Location: login.php");	
?>

<script>
	$(document).ready(function()
	{
		$('#menu li a').removeClass('active');
		$('#menu #performbillrun a').addClass('active');
		
		$('body').animate({scrollTop :450}, 2000);
	});	
	
  $(function() {
    $( "#datepicker" ).datepicker();
  });
	
</script>   
   <div class="rk_maincontent"><!--rk_maincontent div start-->
    	<div class="rk_centercontent"><!--rk_centercontent div start-->
			 <div class="inner_services"><!--inner_services div start--><br><br><br><br>
				<div class="in_services_desc"><!--in_services_desc div start-->
					<p>
							
						<div class="scope_desc"><!--scope_desc div start-->
							<div class="scope_title">Load Usage Data</div>
							 <div class="contact_page"><!--contact_page div start-->
								
								<div class="contact_page_left"><!--contact_page_right div satrt-->
									<form class="custTable" action="loadusage.php" method ="post" name="custDetails">
									 
									 <div class="conatctpage_labeltext"><!--conatctpage_labeltext div start-->
										<div class="contact_name">Enter File Name<span>*</span></div>
										<div class="contactpage_textbox"><input type="text" name="FileName" class="cpagetextbox_text"/></div>
									 </div><!--conatctpage_labeltext div end-->
									 
									 <div class="conatctpage_labeltext"><!--conatctpage_labeltext div start-->
										<div class="conatctpage_submit"><input type="submit" name="StartUsageLoad" class="sub_button" value="submit"/></div>
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
//  Include PHPExcel_IOFactory
include 'C:\xampp\htdocs\trilads1\phpexcel\Classes\PHPExcel\IOFactory.php';

if (isset($_POST['StartUsageLoad'])) 
{
$inputFileName = $_POST['FileName'];
//  Read your Excel workbook
try {
    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
    $objPHPExcel = $objReader->load($inputFileName);
} catch(Exception $e) {
    die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
}

//  Get worksheet dimensions
$sheet = $objPHPExcel->getSheet(0); 
$highestRow = $sheet->getHighestRow(); 
$highestColumn = $sheet->getHighestColumn();
$dbc=mysqli_connect('localhost','root','root','triLads_Billing');
//  Loop through each row of the worksheet in turn
// Starting from 2 to ignore the header
$error = 0 ;
$starttime = date("h:i:sa");
$brstart = microtime(true);

$line = "";
for ($row = 2; $row <= $highestRow; $row++){ 
    //  Read a row of data into an array
    $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                                    NULL,
                                    TRUE,
                                    FALSE);
	$smartMeterId = $rowData[0][0];
	$startTime = excel_date($rowData[0][1]);
	$meterStart = $rowData[0][2];
	$endTime = excel_date($rowData[0][3]);
	$meterEnd = $rowData[0][4];
	$units = $meterEnd - $meterStart ;
    /**if($units < 0){
		//usages cant be negative. Ignore those rows.
	   continue;	
	}else {**/
	   $line = $line . "('$smartMeterId',STR_TO_DATE('$startTime', '%Y-%m-%d %H:%i:%s'),STR_TO_DATE('$endTime', '%Y-%m-%d %H:%i:%s'),'$meterStart','$meterEnd','$units'),";
    //}
}
$line = rtrim($line,",");

$sql = "INSERT INTO ne_stage (Meter_id,startDate,endDate,meter_start,meter_end,units_consumed) VALUES". $line ;

	  //$sql = "INSERT INTO ne_stage (Meter_id) VALUES ('$smartMeterId')";
    $r = mysqli_query($dbc,$sql);
	
    /**if(mysqli_affected_rows($dbc) ==1){
       //echo "<script>window.alert('Usage Data Loaded.')</script>";
    }else{	
       echo "Error is :".mysqli_connect_error();
       echo "Error is :".mysqli_connect_errno();
       $error = 1;
    }  **/ 
$brend = microtime(true);
$endtime = date("h:i:sa");
$brdiff = $brend - $brstart ;
$Alert = "Usage Load started at ".$starttime."\\n Usage load Completed at ".$endtime.".\\n"."Time Elapsed:".$brdiff." seconds";
echo "<script type= 'text/javascript'>alert('$Alert');</script>";
/**if($error == 1){
	echo "<script>window.alert('Usage Data Load Failed.');</script>" ;
	header("Location: index.php");
}else{
	echo "<script>window.alert('Usage Feed Loaded Successfully .');</script>";	
	//header("Location: index.php");
	echo "<script>window.open('index.php');</script>";	
}**/
mysqli_close($dbc);	
}
function excel_date($xl_date)
{
return $displayDate = PHPExcel_Style_NumberFormat::toFormattedString($xl_date, 'YYYY-MM-DD hh:mm:ss');
}
?>
