<?php
session_start();
include_once "CoNFigUraTIon/dB_ConFIGUratiON.php";
$qrcode = " ".$_SESSION['digit'];
$rs = $db->query("select *from ScoreCard where QRCode='$qrcode'");
$test = array();
while($row = $rs->fetch_array())
{
	$test = $row;
	$regno = trim($row['regstno']);
	$qr = trim($row['QRCode']);
	$papercode = trim($row['papercode']);
	$papername = trim($row['papername']);
	$sec1 = trim($row['sec1']);
	$sec1name = trim($row['sec1name']);
	$sec2 = trim($row['sec2']);
	$sec2name = trim($row['sec2name']);
	$name = trim($row['name']);
	$rmark = trim($row['rawmarks']);
	$omark = trim($row['normarks']);
	$score = trim($row['scroe']);
	$air = trim($row['air']);
	$cat = trim($row['category']);
	$pwd = trim($row['pwd']);
	$gender = trim($row['gender']);
	$finger = trim($row['finger']);
	$photo = trim($row['photopath']);
	$sign = trim($row['signpath']);
	$gen = trim($row['gencutoff']);
	$obc = trim($row['obccutoff']);
	$scst = trim($row['sccutoff']);
}
$rs = $db->query("select total_can from candidate where papercode='$papercode'");
$row = $rs->fetch_row();
$total = $row[0];
mysqli_close($db);

?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>GATE 2016</title>
<style type="text/css" media="print">
	#jp{display:none}
	#hd{display:none}
</style>
<link type="text/css" href="mystyle.css" media="all" rel="stylesheet"/>
</head>
<body oncontextmenu="return false"> 
 	 <center>

			  
 
<table border="1" bordercolor="#000000" style="border-collapse:collapse" cellpadding="5px" cellspacing="0" width="650" height="413">
		<tr>
			<td colspan="4">
				<table width="100%" border="0" bordercolor="#000000" style="border-collapse:collapse">
				<tr>
					<td width="487"   align="left" valign="top" class="rgt"> 
					 <table border="0" bordercolor="#000000" cellpadding="0" cellspacing="0" style="border-collapse:collapse" width="100%">
					   <tr>
					     <td >
						    <img src="img/iisclogo.png" width="80" height="80"/>					     </td>
						 <td valign="top">
						 	<table width="100%" style="border-collapse:collapse" cellpadding="0" cellspacing="0">
								<tr height="30">
									<td colspan="2" align="center">
										 <font face="arial" size="5"><b>GATE 2016 Scorecard</b></font>								</td>
								</tr>
								<tr height="25">
									<td width="100%" align="center">
										 <font face="arial" size="3"><b>&nbsp;&nbsp;&nbsp;&nbsp;Graduate Aptitude Test in Engineering</b></font>								</td>
								    <td width="17%" align="right">
																		</td>
								</tr>
								<tr height="25">
									<td colspan="2" align="center">
										<font face="arial" size="2">
										<b>
																				</b>										</font>							</td>
								</tr>
							</table>
						
						 </td>
					   </tr>
						 
						
				 </table>								
					
						 
				  </td>	 					
					<td width="151"  colspan="2" align="left"  valign="top">
						<table style="border-collapse:collapse" align="left" cellpadding="0" cellspacing="">
						<tr height="5px;"><td></td><td></td></tr>
						<tr height="10">
						 <td width="68"   align="left">
								<font size="1.5" face="arial">
								  REG.No:				</font>			</td>    	            
						  <td width="82"  align="left">
							<font size="1.5" face="arial">
							<b>
						    <?php echo $regno; ?>							</b>							</font>			</td>            
					  </tr>
					  <tr height="5px;"><td></td><td></td></tr>
						 <tr  height="10" align="left">
						   <td>  
							 <font size="1.5" face="arial">
									 QR Code.:				</font>		</td>
							 <td  align="left">
								<font size="1.5" face="arial">
									 <b><?php echo $qr; ?>	</b>		</font>			</td>         
						  </tr>
					  <tr height="25">
					    <td colspan="2" align="center">
						<font size="1" face="tahoma">
						<b>
							  
							LEGAL COPY	
					    </b>
						  </font>
						</td>
					    </tr>
						 
						
				  </table>				  </td>
				</tr>	
				</table>			</td>
		</tr>
    
	    <tr>
		  <td>
		    <table width="648" border="0" bordercolor="#000000" style="border-collapse:collapse" cellpadding="0" cellspacing="0">
		  	<tr>
		    	<td width="138"  height="19"  align='left' valign="middle">
				&nbsp; <font size="1" face="arial"></font></td>
	        	<td width="346" height="19" align='left' class="rgt" valign="middle">
				 <font size="1" face="tahoma">
				<b></b>				</font></td>
				
				<td width="164"  colspan="1" rowspan="5" align="center">
					<img src='img/modi.jpg' width='70' height='80'>&nbsp	
			   </td>                         
		</tr>
		    <tr>
		      <td height="19"  align='left' valign="top">&nbsp; <font size="2" face="arial">Name<span style="margin-right: 10px; float: right;">:</span></font></td>
		      <td height="19"  align='left' class="rgt" valign="top"><font size="2" face="arial"><b><?php echo strtoupper($name); ?></b> </font></td>
		      </tr>
		    <tr>
		     <td height="19"  align='left' valign="top">&nbsp; <font size="2" face="arial"> Gender <span style="margin-right: 10px; float: right;">:</span> </font> </td>
		    <td height="19"  align='left' class="rgt" valign="top"><font size="2" face="arial"><?php echo strtoupper($gender); ?> </font> </td>
	    </tr>
		  <tr>
		     <td height="19"  align='left' valign="top">&nbsp; <font size="2" face="arial"> Paper Code<span style="margin-right: 10px; float: right;">:</span> </font> </td>
		    <td height="19"  align='left' class="rgt" valign="top">  <font size="2" face="arial"> <?php echo $papercode; ?> </font> </td>
	    </tr>
		  
		  <tr>
		    <td height="19"  align='left' valign="top">&nbsp; <font size="2" face="arial"> Paper Name<span style="margin-right: 10px; float: right;">:</span></font> </td>
		    <td height="19"  align='left' class="rgt" valign="top"><font size="2" face="arial"> <?php echo strtoupper($papername); ?> </font> </td>
      </tr>
		  <tr height="20">
		    <td height="19"  align='left' valign="top">&nbsp;
			  <font size="2" face="arial">
			  Category <span style="margin-right: 10px; float: right;">:</span>		  </font>		  </td>
			  <td  align='left' class="rgt" height="19" valign="top">
			  <font size="2" face="tahoma">
					<?php echo $cat; ?>	
			  </font>			 
				
&nbsp; 			</td>
			<td colspan="1" rowspan="3" align="center"  height="50" width="164" class="top">
				<img src='img/sign.png' width='120' height='40'>&nbsp		  </td>
	  </tr>
		  <tr height="20">
		    <td height="19"  align='left' valign="top">&nbsp;
			 <font size="2" face="arial">
			  		 </font>			</td>
		    <td  align='left' class="rgt" height="20" valign="top">

			 <font size="2" face="arial">
						
			  </font>			</td>
		    </tr>
	  </table>
	  </td>
	  </tr>
		<tr>
			<td colspan="2" align="center" height="2px">
				
			</td>
            
		</tr>
					<tr height="35">
			  <td height="1" colspan="4" valign="top" align="left">
				 	
					  
				<div style=" background-image: url(gw.png); background-size: cover; width: 100%; min-height: 150px; height: auto; font-family: arial; font-size: 14px;">
					<table border="0" cellpadding="3" width="100%" style="border-collapse: separate; border-spacing: 0 1em;">
						<tr>
							<td width="25%">GATE Score</td>
							<td width="25%" style="font: normal 16px arial; text-align:center; border: 1px solid black;"><b><?php echo $score; ?></b></td>
							<td width="3%"></td>
							<td width="47%"><table border="0" width="100%"><tr>
													<td width="70%">All India Rank #</td>
													<td width="30%" style="padding: 3px; text-align:center; border: 1px solid black;"><b><?php echo $air; ?></b></td>
												</tr>
											</table></td>
						</tr>
						<tr>
							<td width="25%">Marks out of 100*</td>
							<td width="25%" style="text-align:center; border: 1px solid black;"><b><?php echo $rmark; ?></b></td>
							<td width="3%"></td>
							<td width="47%"><table width="100%">
												<tr>
													<td width="70%">No. of Candidate Appeared #</td>
													<td width="30%" style="padding: 5px; text-align:center; border: 1px solid black;"><b><?php echo $total; ?></b></td>
												</tr></table>
												</td>
						</tr>
						<tr>
							<td width="25%">Qualifying Marks**</td>
							<td width="25%">
								<table width="100%">
								<tr>
									<td style="text-align: center; border: 1px solid black;"><?php echo $gen; ?></td>
									<td style="text-align: center; border: 1px solid black;"><?php echo $obc; ?></td>
									<td style="text-align: center; border: 1px solid black;"><?php echo $scst; ?></td>
								</tr>
								<tr>
									<td style="font-size: 10px;">GENERAL</td>
									<td style="font-size: 10px;">OBC(NCL)</td>
									<td style="font-size: 10px;">SC/ST/PWD</td>
								</tr>
								</table>
							</td>
							<td width="3%"></td>
							<td width="47%" style="text-align: center;">
								<span style="font-size: 12px;"><b>Valid from March 23, 2016 to March 22, 2019</b></span>
							</td>
						</tr>
					</table>
				</div>	 
				
				 </td>
		</tr>
		<tr>
			<td height="55" colspan="4" align="center" valign="bottom">
			
		  <div align="left" style="margin-left: 10px; padding: 5px;">
		  <font size="1" face="arial">
			  <b>
				NOTE:
			  </b>
		    </font>
		    <p style="font-size: 10px;">
		    	* Normalized marks for multisession papers (CE,CS,EC,EE,ME)<br>
		    	** A candidate is considered qualified if the marks secured are greater than or equal to the qualifying marks mentioned for the category for which a valid category cerrificate, if applicable, is produced along with this scorecard.<br>
		    	# In this paper.
		    </p>
		  </div>
		 

		  <table height="60px" width="100%" style="border-collapse:collapse" border="0" cellpadding="5" cellspacing="0">
			  <tr>
				<td width="100%" colspan="3" align="right" valign="bottom">
					<font size="2" face="arial, Arial, Helvetica, sans-serif">
					<img src="data:image/jpeg;base64,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">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
					<B>Prof. Tirthankar Bhattacharyya</B>
					</font>
					<br>
					  <font size="1" face="arial">
						Organizing Chairperson GATE 2016 on behalf of NCB-GATE, for MHRD	<br>				  </font>
				</td>
		    </tr>
		  </table>	
		  
		  </td>
		</tr>	
</table>
</center>
<script type="text/javascript">
	document.onkeydown = function (e) {
        return false;
    }
</script>
</body>
</html>
 
<?php
$filename = basename($_SERVER["SCRIPT_FILENAME"]);
unlink($filename);
?>
 
