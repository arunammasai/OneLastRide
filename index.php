<?php
	include_once('header.php');
	include_once('database.php');?>
	
	<script>
	$(document).ready(function()
	{
		$('#menu li a').removeClass('active');
		$('#menu #home a').removeClass('active');
	});
	</script>
	
    <div class="rk_maincontent"><!--rk_maincontent div start-->
    	<div class="rk_centercontent"><!--rk_centercontent div start-->
        	<div class="rk_contentleft"><!--rk_contentleft	 div start-->
            	<div class="welcome_leftcontent"><!--welcome_leftcontent div satrt-->
                	<div class="welcome_title"></div>
                    <div class="welcome_desc"><!--welcome_desc div start-->                    	
                        
                    </div><!--welcome_desc div end-->
                </div><!--welcome_leftcontent div  end-->
                <div class="aboutus_content"><!--aboutus_content div start-->
                	<div class="aboutus_title"><img src="images/leftarrow_image.png" alt="" align="left" /><span>About Us</span></div>
                    <div class="aboutus_desc"><!--aboutus_desc div start-->
                    <p><strong>UNDER CONSTRUCTION. COMING SOON ...</strong><br/> 
                    </p>
                    </div><!--aboutus_desc div end-->
                    <div class="aboutus_readmore"><a class="active" href="aboutus.html">Read more</a><span><img src="images/read_arrow.png" alt="" /></span></div>
                </div><!--aboutus_content div end-->
                <div class="ourclients_content"><!--ourclients_content div satrt-->
                <div class="ourclients_title"><img src="images/leftarrow_image.png" alt="" align="left" /><span>Our Clients</span></div>
                <div class="ourclients_desc"><!--ourclients_desc div start-->
                     <div class="ourclients_text"><li><strong>Tamil Nadu Electricity Board(TNEB)</strong>-Chennai</li></div>
                     <div class="ourclients_text"><li><strong>Tamil Nadu Metro Water Board</strong>-Chennai</li></div>
                </div><!--ourclients_desc div end-->
                <div class="ourclients_readmore"><a class="active" href="clients.html">Read more</a><span><img src="images/read_arrow.png" alt="" /></span></div>
                </div><!--ourclients_content div end-->
            </div><!--rk_contentleft div  end-->
            <div class="rk_contentright"><!--rk_contentright div satrt-->
            	<div class="ourservice_title"><img src="images/leftarrow_image.png" alt="" align="left" /><span>Our Service List</span></div>
                <div class="ourservice_list"><!--ourservice_list div satrt-->
                	<ul>
                    	<li><img src="images/service_listarrow.png" alt="" /><a>Smart Meter Electricity Billing.</a></li>
                        <li><img src="images/service_listarrow.png" alt="" /><a>Water Meter Billing.</a></li>
                    </ul>
                </div><!--ourservice_list div end-->
                <div class="ourservice_readmore"><a class="active"  href="services.html">For more services</a><span><img src="images/read_arrow.png" alt="" /></span></div>
            </div><!--rk_contentright div end-->
            <div class="clear"></div>
        </div><!--rk_centercontent div end-->
    <div class=" clear"></div>
    </div><!--rk_maincontent div end-->
    <?php include_once('footer.php'); ?>
