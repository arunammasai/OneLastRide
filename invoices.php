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
		$('#menu #invoice a').addClass('active');
		
		$('body').animate({scrollTop :450}, 2000);
		
		$('#submitBut').click(function()
		{

			if($('#pdfs').val().length==0){
				alert("Select File :");
				return false;
			}
			var url = 'pdf/'+$('#pdfs').val();	
			window.open(url,'_blank');
		});
		
	});
</script>
  
    <div class="rk_maincontent"><!--rk_maincontent div start-->
    	<div class="rk_centercontent"><!--rk_centercontent div start-->
			 <div class="inner_services"><!--inner_services div start-->
				<div class="in_services_desc"><!--in_services_desc div start-->
					<p>
							
						<div class="scope_desc"><!--scope_desc div start-->
							<div class="scope_title"><font size="3">Invoice Viewer</font></div>
							 <div class="contact_page"><!--contact_page div start-->
								
								<div class="contact_page_left"><!--contact_page_right div satrt-->
									
									 <div class="conatctpage_labeltext"><!--conatctpage_labeltext div start-->
										<div class="contact_name">File Name<span>*</span></div>
										<div class="contactpage_textbox">
										<select name="fileName" id="pdfs">
										<option value="">Select File</option>
										<?php											
											//echo "Data :".$_SERVER['DOCUMENT_ROOT'];
											$dir 	=	$_SERVER['DOCUMENT_ROOT'].'/trilads1/pdf/';
											$files 	=	scandir($dir);
											
											if( ! empty($files))
											{												
												foreach($files as $file)
												{
													if(is_dir($file))
														continue;
														
													echo "<option value='$file'>$file</option>";
												}
											}
										?>
										</select>
									 </div><!--conatctpage_labeltext div end-->
									 
									 <div class="conatctpage_labeltext"><!--conatctpage_labeltext div start-->
										<div class="conatctpage_submit"><input type="submit" name="submitBut" id="submitBut" class="sub_button" value="submit"/></div>
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
if (isset($_POST['submitBut'])) {
	$file = $dir.$_POST['fileName'];
	echo "File Name is :".$fileName;	
    $filename = $_POST['fileName'];
    header('Content-type: application/pdf');
    header('Content-Disposition: inline; filename="' . $filename . '"');
    header('Content-Transfer-Encoding: binary');
    header('Accept-Ranges: bytes');
    @readfile($file);

/*  header('Content-type: application/pdf');
  header('Content-Disposition: inline; filename="' . $filename . '"');
  header('Content-Transfer-Encoding: binary');
  header('Accept-Ranges: bytes');
  @readfile($filename);*/

//header("Content-type: application/pdf");
//header("Content-Disposition: inline; filename=$fileName");
//@readfile('test.pdf');
}
?>
	
<?php include_once('footer.php');

//if($_GET['error'] == 1)
	//echo "<script>window.alert('Invalid user')</script>";
?>
