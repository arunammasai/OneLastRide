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
							<div class="scope_title"><font size="4">Perform Bill Run</font></div>
							 <div class="contact_page"><!--contact_page div start-->
								
								<div class="contact_page_left"><!--contact_page_right div satrt-->
									<form class="custTable" action="performBillRun1.php" method ="post" name="custDetails">
									 <div class="conatctpage_labeltext"><!--conatctpage_labeltext div start-->
										<div class="contact_name">Effective Date<span>*</span></div>
										<div class="contactpage_textbox"><input type="date" name="EffectiveDate" id="datepicker" tabindex="1" required></div>
									 </div><!--conatctpage_labeltext div end-->
									 
									 <div class="conatctpage_labeltext"><!--conatctpage_labeltext div start-->
										<div class="contact_name">WhereClause<span>*</span></div>
										<div class="contactpage_textbox"><input type="text" name="WhereClause" class="cpagetextbox_text"/></div>
									 </div><!--conatctpage_labeltext div end-->
									 
									 <div class="conatctpage_labeltext"><!--conatctpage_labeltext div start-->
										<div class="conatctpage_submit"><input type="submit" name="ExecuteBillRun" class="sub_button" value="submit"/></div>
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
require('C:\xampp\php\pear\fpdf\fpdf.php'); 
class PDF extends FPDF {
 
function Header() {
	//$this->Image("D:\HeaderLogo.jpg", (4.5/2)-1.5, 9.8, 3, 1, "JPG","www.verizon.com");
    $this->SetFont('Times','',12);
    $this->SetY(0.25);
	$this->Cell(0, .25, "TamilNadu Electricity Board (TNEB) ", 'T', 2, "R");
	$this->SetY(0.25);
    //reset Y
    $this->SetY(1);
}
 
function Footer() {
//This is the footer; it's repeated on each page.
//enter filename: phpjabber logo, x position: (page width/2)-half the picture size,
//y position: rough estimate, width, height, filetype, link: click it!
    $this->Image("D:\logo.jpg", (4.5/2)-1.5, 9.8, 3, 1, "JPG","www.verizon.com");
}
 
}
$currencyConversion = array();
$invoiceSubDate = array();

if (isset($_POST['ExecuteBillRun'])) 
{
	$dbc=mysqli_connect('localhost','root','root','triLads_Billing');
    $EffDate     = $_POST["EffectiveDate"];
	$brstart = microtime(true);
	//$starttime = date("h:i:sa");
	//echo "<script>window.alert($EffDate)</script>";
    $WhereClause = $_POST["WhereClause"];
	$sPay = "select date_add(str_to_date('$EffDate','%m/%d/%Y'),interval 15 day) as PDate from dual ";
    $rPay = mysqli_query($dbc,$sPay);
	$payment_date = mysqli_fetch_assoc($rPay)['PDate'];
	$brinsert = "INSERT INTO billrun VALUES () " ;
	mysqli_query($dbc, $brinsert);
	$brid = mysqli_insert_id($dbc);
	$csvfile = fopen($_SERVER['DOCUMENT_ROOT'].'/trilads1/brs/bill_run_details_'.$brid.'.csv',"w");
	$line = "CustomerName(MeterId),TotalUnitsConsumed,InvoiceAmount,Charge,Tax\n";
	fputcsv($csvfile,explode(',',$line));
	//echo "Payment". $payment_date ."<br>";
    //echo "Executing billrun with effective date " . $EffDate . "  " . "and Where Clause : " . $WhereClause . "<br>";
	
	$monthmap = array("01" => "January","02" => "February","03" => "March","04" => "April","05" => "May","06" => "June",
					  "07" => "July","08" => "August","09" => "September","10" => "October","11" => "November","12" => "December");
	
    $CustsForBillRunSql = "SELECT c.accountId, c.Currency, e.equipmentId, IFNULL(NULL, STR_TO_DATE('01/01/2000', '%m/%d/%Y')) LastBillDate,
	                               a.roundTo,CONCAT(c.AddressLine, ',', c.AddressStreet,',',c.AddressCity,',',c.AddressState,',',c.AddressPinCode)  address 
                             FROM customer c, account a, equipment e
		    				WHERE IFNULL(NULL, STR_TO_DATE('01/01/2000', '%m/%d/%Y')) < STR_TO_DATE('$EffDate', '%m/%d/%Y')
			    			  AND c.accountid = a.accountid
				    		  AND c.accountid = e.accountid " . $WhereClause;
							  
    if ($CustsForBillRunCsr = mysqli_query($dbc, $CustsForBillRunSql))
	{
        //echo "Number of rows fetched" . mysqli_num_rows($CustsForBillRunCsr) . "<br>";
		
		//Fetch the rates and store it as a hash map
		$rates = array();
		$ratesTier = array();
		$invoice = array();
		$RatesSql = "Select TierStartValue, TierEndValue, Currency, RatePerUnit from rates order by 2 asc " ;
		if($RatesCsr = mysqli_query($dbc, $RatesSql)){
			while($lRates = mysqli_fetch_assoc($RatesCsr)){
				$rates[$lRates['Currency']][$lRates['TierEndValue']] = $lRates['RatePerUnit'];
				if(isset($ratesTier[$lRates['Currency']])){
					array_push($ratesTier[$lRates['Currency']],$lRates['TierEndValue']);
                }else {
	                $ratesTier[$lRates['Currency']]= array($lRates['TierEndValue']);
                }
			}
		}else{
			echo "No Rates available <br>";
		}
		
		while($lCustForBillRun = mysqli_fetch_assoc($CustsForBillRunCsr))
        {
			//echo "EquipmentId" . $lCustForBillRun['equipmentId'] . "::::";
			$MeterId = $lCustForBillRun['equipmentId'];
			$RoundTo = $lCustForBillRun['roundTo'];
			//echo "Last Bill Date" . $lCustForBillRun['LastBillDate'] . "::";
			$LastBillDate = $lCustForBillRun['LastBillDate'];
            $NEStageSQL = "SELECT Meter_id, extract(YEAR_MONTH from StartDate) StartDate, extract(year_month from EndDate) EndDate, sum(units_consumed)  units_consumed
			                 FROM ne_stage 
							WHERE Meter_id = $MeterId
							  AND str_to_date('$LastBillDate', '%Y-%m-%d') < StartDate
							  AND STR_TO_DATE('$EffDate', '%m/%d/%Y') > EndDate
							  AND billrunid is null
							GROUP BY extract(YEAR_MONTH from StartDate), extract(year_month from EndDate) 
							ORDER BY Meter_Id, StartDate";

			// Use Units Consumed, fetch Rates, compare currency, store in NE and charge tables, create subtotals and generate invoice.
			$currency = 'INR';
			
			if(isset($ratesTier[$lCustForBillRun['Currency']])){
				$ExchangeRate = 1.0;
			}else{
				if(empty($currencyConversion)){
					  $currencyConversion = CacheCurrencies($dbc,$EffDate);
				}
			    $ExchangeRate = $currencyConversion[$currency][$lCustForBillRun['Currency']];
			}
							
		    $NEStageCsr = mysqli_query($dbc, $NEStageSQL);
			$accountid = $lCustForBillRun['accountId'];
			$EBDate = "";	
			$invoiceSubMeter = array();
			while($NEStageRow = mysqli_fetch_assoc($NEStageCsr))
			{
				/**echo "Meter Id: " . $NEStageRow["Meter_id"];
				echo "Start Month: " . $NEStageRow["StartDate"];
				echo "End Month: " . $NEStageRow["EndDate"];
				echo "Units Consumed: " . $NEStageRow["units_consumed"]; **/
				
				$charge = 0;
				$consumption = $NEStageRow['units_consumed'];
				$PrevTierEndValue = 0;
				$ChargeUnits = 0;
				$CurTierEndValue = 0;
				$BreakFlag = 0;
				
				//print_r($consumption); echo"<br>";
				//echo "Currency::".$currency."<br>";
				//print_r($ratesTier[$currency]);
				foreach ($ratesTier[$currency] as &$value){
					//print_r($value);
					$CurTierEndValue = $value;
					//echo "<br>";
					if($consumption > $value){
						$ChargeUnits = $CurTierEndValue - $PrevTierEndValue;
						$PrevTierEndValue = $CurTierEndValue;
					}
					else
					{
						$ChargeUnits = $consumption - $PrevTierEndValue;
						$BreakFlag = 1;
					}

					$rate = $rates[$currency][$value];
					/**echo "<br>Consumption: $consumption;";
					echo "<br>Tier End : " . $CurTierEndValue; 
					echo "<br>Prev Value :" . $PrevTierEndValue; 
					echo "<br>Cahrge uNits : " . $ChargeUnits;
                    echo "<br>Rates : " . $rate;
                    echo "<br>Excahnge Rate : " . $ExchangeRate;	**/				
					$charge += $ChargeUnits * $rates[$currency][$CurTierEndValue] * $ExchangeRate;
					if ($BreakFlag == 1) 
					{
						break;
					}
				}
				$charge = round($charge, $RoundTo);
				//echo "Charge:B4:". $charge."<br>";

				//echo "Charge::". $charge."<br>";				
				$tax = $charge * (1/10);
				$total = $charge + round($tax, $RoundTo) ;
				
				$SDate = $NEStageRow['StartDate'].'01' ;
				$EDate = $NEStageRow['EndDate'].'30';

				$mm = substr($SDate,4,2);
				$yy = substr($SDate,0,4);
				$EBDate = $monthmap[$mm]." ".$yy;
								
			    $invoiceSubDate[$NEStageRow['Meter_id']][$SDate . '_' . $EDate]['Charge'] = $charge;
 			    $invoiceSubDate[$NEStageRow['Meter_id']][$SDate . '_' . $EDate]['Tax'] = $tax;
			    $invoiceSubDate[$NEStageRow['Meter_id']][$SDate . '_' . $EDate]['Total'] = $total;
				
				if(isset($invoiceSubMeter[$NEStageRow['Meter_id']]['Charge'])){
				   $invoiceSubMeter[$NEStageRow['Meter_id']]['Charge'] += $charge;
				   $invoiceSubMeter[$NEStageRow['Meter_id']]['Tax'] += $tax;
				   $invoiceSubMeter[$NEStageRow['Meter_id']]['Total'] += $total;
				   $invoiceSubMeter[$NEStageRow['Meter_id']]['Q'] += $NEStageRow['units_consumed'];
				}else{
				   $invoiceSubMeter[$NEStageRow['Meter_id']]['Charge'] = $charge;
				   $invoiceSubMeter[$NEStageRow['Meter_id']]['Tax'] = $tax;
				   $invoiceSubMeter[$NEStageRow['Meter_id']]['Total'] = $total;
				   $invoiceSubMeter[$NEStageRow['Meter_id']]['Q'] = $NEStageRow['units_consumed'];
				}
				if(isset($BillRunSub['Charge'])){
				   $BillRunSub['Charge'] += $charge;
				   $BillRunSub['Tax'] += $tax;
				   $BillRunSub['Total'] += $total;
				}else{
				   $BillRunSub['Charge'] = $charge;
				   $BillRunSub['Tax'] = $tax;
				   $BillRunSub['Total'] = $total;
				}

				$MeterId = $NEStageRow['Meter_id'];
				$UnitsConsumed = $NEStageRow['units_consumed'];

				//insert into Charge
				$insertCharge = "INSERT INTO `Charge` (`AccountId`, `EquipmentId`, `Quantity`, `AmountBeforeTax`, `TaxPercentage`, `TaxAmount`,`TotalAmount`,
								`StartDate`,`EndDate`) VALUES  ('$accountid','$MeterId','$UnitsConsumed','$charge',10,
								'$tax','$total',STR_TO_DATE('$SDate', '%Y%m%d'),STR_TO_DATE('$EDate', '%Y%m%d'))" ;
				$r = mysqli_query($dbc,$insertCharge);				
			    //echo $lCustForBillRun["accountId"];
	            //echo $lCustForBillRun["equipmentId"];
    			$InvoiceAmount = $invoiceSubMeter[$MeterId]['Total'];
	    		$insertInvoice = "insert into `invoice` (`InvoiceDate` ,`InvoiceAmount` ,`PaymentDueDate` ,`AccountId`) VALUES 
		    					  (STR_TO_DATE('$EffDate', '%m/%d/%Y'),'$InvoiceAmount',date_add(str_to_date('$EffDate','%m/%d/%Y'),interval 15 day),'   $accountid')";
			    $r = mysqli_query($dbc,$insertInvoice);
				$line ="$MeterId,$UnitsConsumed,$InvoiceAmount,$charge,$tax\n";
				fputcsv($csvfile,explode(',',$line));
				
							
			}
			if(isset($invoiceSubMeter[$MeterId]['Charge'])){
			//class instantiation
			$pdf=new PDF("P","in","Letter");
			 
			$pdf->SetMargins(1.5,1.5,1.5);
			 
			$pdf->AddPage();
			$pdf->SetFont('Times','',12);
			
			$quantity = $invoiceSubMeter[$MeterId]['Q'];
			$charge = $invoiceSubMeter[$MeterId]['Charge'];;
			 $tax = $invoiceSubMeter[$MeterId]['Tax'];;
			 $total = $charge + $tax;
			 
			 //Set sprintf to display amount correctly. 
			 $r = "%.".$RoundTo."f";
			 $charge = sprintf("$r",$charge);
			 $tax = sprintf("$r",$tax);
			 $total = sprintf("$r",$total);

			 $Accountid = "Account Id(SmartMeter Id) "; 
			 //$CustomerName = "SmartMeter Id "; 
			 $Address = "Address ";
			 $address = $lCustForBillRun['address'];
			 
			$Line1="Electricity Charges as on $EffDate ";
			$Line2="Tax applied @ 10% ";
			$Line3="Total Charges  ";

			$pdf->SetFillColor(240, 100, 100);
			$pdf->SetFont('Times','B',12);
			$pdf->Cell(0,.25, "Electricity Bill for the month - ".$EBDate, 1, 2, "C", 1);
			
			$pdf->SetFillColor(240, 100, 100);
			$pdf->SetFont('Times','B',12);
			  

			$pdf->Cell(0,.25, "Customer Details", 1, 2, "C", 1);
			  
			$pdf->SetFont('Times','',12);
			$pdf->Cell(0, 0.20, $Accountid, 1, 0, 'L');
            $pdf->Cell(0, 0.20, $accountid, 1, 1, 'R');
			$pdf->Cell(0, 0.20, $Address, 1, 0, 'L');
            $pdf->Cell(0, 0.20, $address, 1, 1, 'R');
			$pdf->Cell(0, 0.20, "Payment Date", 1, 0, 'L');
            $pdf->Cell(0, 0.20, $payment_date , 1, 1, 'R');
						
			 $pdf->Multicell(0,1,"\n");
			  
			$pdf->SetFillColor(240, 100, 100);
			$pdf->SetFont('Times','B',12);
			  
			
			$pdf->Cell(0, .25, "Charge Details", 1, 0, "L", 1);
			$pdf->Cell(0, .25, "Billed Currency:".$lCustForBillRun['Currency'], 1, 1, "R", 1);
			  
			$pdf->SetFont('Times','',12);
			$pdf->Cell(0, 0.20, "Power Consumed", 1, 0, 'L');
            $pdf->Cell(0, 0.20, $quantity." Units", 1, 1, 'R');
			$pdf->Cell(0, 0.20, $Line1, 1, 0, 'L');
            $pdf->Cell(0, 0.20, $charge, 1, 1, 'R');
			$pdf->Cell(0, 0.20, $Line2, 1, 0, 'L');
            $pdf->Cell(0, 0.20, $tax, 1, 1, 'R');
			$pdf->Cell(0, 0.20, $Line3, 1, 0, 'L');
            $pdf->Cell(0, 0.20, $total, 1, 1, 'R');

			$pdf->Multicell(0,1,"Please visit https://www.tnebnet.org/awp/login to pay the bills online\n");
     		$filename = $_SERVER['DOCUMENT_ROOT'].'/trilads1/pdf/'.$accountid."_".$EBDate."_".$brid.".pdf";
			$pdf->Output($filename,'F');
			}
			
        }
		//BR update
			$nebrupdate = "update ne_stage set billrunid = '$brid' where billrunid is null AND STR_TO_DATE('$EffDate', '%m/%d/%Y') > EndDate";
			$brupd = mysqli_query($dbc,$nebrupdate);
			//mysqli_commit($dbc);
	}
	else
	{
        echo "Error is :".mysqli_connect_error();
        echo "Error is :".mysqli_connect_errno();
	}
	$brend = microtime(true);
	//$endtime = date("h:i:sa");
	$brdiff = $brend - $brstart;
    fclose($csvfile);
    mysqli_close($dbc);
	//$Alert = "Billrun started at ".$starttime."\\n Bill Run Successfully Completed at ".$endtime."\\n"."BillRun Id is ". $brid . "\\n"."Time Elapsed:".$brdiff." seconds";
	$Alert = "BillRun Id is ". $brid . "\\n"."Time Elapsed:".$brdiff." seconds";
	echo "<script type= 'text/javascript'>alert('$Alert');</script>";
}
function CacheCurrencies($dbc,$EffDate)
	{
	  $CurrencySql = "Select FromCurrency, ToCurrency, ExchangeRate from currencies where 
						 ( STR_TO_DATE('$EffDate', '%m/%d/%Y') between StartDate and EndDate ) " ;
   	  $CurrencyCsr = mysqli_query($dbc, $CurrencySql) ;
	  while($lCurrency = mysqli_fetch_assoc($CurrencyCsr)){
			$currencyConversion[$lCurrency['FromCurrency']][$lCurrency['ToCurrency']] = $lCurrency['ExchangeRate'];
	  }
	 // print_r($currencyConversion['INR']);
      return $currencyConversion ;
    }
?>
</body>
</html>

<?php include_once('footer.php'); ?>
