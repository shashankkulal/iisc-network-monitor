<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">     <title>
                GATE 2015: View Score                   </title>
        <link href="http://gate.iitk.ac.in/scores/gate2015/favicon.ico" type="image/x-icon" rel="icon"><link href="http://gate.iitk.ac.in/scores/gate2015/favicon.ico" type="image/x-icon" rel="shortcut icon"><link rel="stylesheet" type="text/css" href="css/cake.generic.css"></head>

<body>
        <div id="container">
                <div id="content">
                        <img src="img/header.png" alt="image not found" width="890px"><img src="img/footer-shadow.png" alt="image not found" width="890px">
<!-- File: /app/View/Posts/view.ctp -->



<?phpphp
$Qrcode = $_REQUEST["qrcode"];

$connection=mysql_connect("localhost","root","1$=46.10RupeesSQL") or die("Couldn't connect to the server.");
mysql_select_db("gate",$connection) or die("Could not elect a database");
$rows = mysql_query("SELECT *  FROM ScoreCard WHERE QRCode='$Qrcode'");
$result = mysql_fetch_array($rows);
if ($result ==  0) {
  echo "<center><b>Error </b><br><br>Sorry! Record Not Found";
                    }
else {
    
$regstno = $result[0]; 
 $QRCode  = $result[1];   
 $papercode  = $result[2];
 $papername  = $result[3];
 $sec1       = $result[4];
 $sec1name   = $result[5];
 $sec2       = $result[6];
 $sec2name   = $result[7];
 $name       = $result[8];
 $appeared   = $result[9];
 $rawmarks   = $result[10];
 $normarks   = $result[11];
 $score     = $result[12]; 
 $air        = $result[13];
 $category   = $result[14];
 $pwd        = $result[15];
 $gender     = $result[16];
 $finger     = $result[17];
 $photopath  = $result[18];
 $signpath   = $result[19];
 $gencutoff  = $result[20];
 $obccutoff  = $result[21];
 $sccutoff   = $result[22];
 $photo = "photo/".$regstno.".jpg";
 $sign = "sign/".$regstno.".jpg";


if ($normarks == "Not Applicable")
    {

  $marks = $rawmarks;
                                 }
else {

$marks = $normarks;
     }


?>

<!-- File: /app/View/Posts/view.ctp -->

       <div id="sv_gate"> </div>
        <div id="sv_bord1">
                <ul>
                        <li>The scores provided here are for authentication purposes only.</li>
                        <li>If there is any discrepancy between the content shown here and
the content printed on the scorecard, please contact GATE Office, IIT
Kanpur.</li>
                        <li>An electronic or paper copy of this document may not be treated
as a valid document for admission purposes at various
Institutes/Organisations.</li>
                        <li>Possession of the scorecard does not mean qualifying GATE2015. The qualifying marks criterion (shown below) is to be noted.</li>
                </ul>
        </div>
       <br><br>





<center><table width="820px" align="center"><tbody><tr><td width="100" align="center"><center><img src="<?php echo $photo?>" alt="image not found" border-color="#319140" width="110px" border="2px">
<br><i><font size="1">Photograph submitted by the Candidate</font></i>
<br><img src="<?php echo $sign ?>" alt="image not found" class="img_signature" border-style="dashed" width="180px">
<br><i><font size="1">Signature of the Candidate</font></i></center></td>

<td><table width="670px" align="center">
<tbody>
<tr><td width="180px">Name of the Candidate</td><td width="10px">:</td><td><?php echo $name ;?></td></tr>
<tr><td>Gender</td><td>:</td><td><?php echo $gender ; ?></td></tr>
<tr><td>Registration No</td><td>:</td><td><?php echo $regstno ; ?></td></tr>
<tr><td>GATE Paper </td><td>:</td><td> [ <?php echo $papercode ; ?>] <?php echo $papername; ?></td></tr>
<tr><td colspan="3"><font color =blue">
<?php if ($papercode=="GG") { 
echo "Section : ".$sec1name."(".$sec1.")" ;
                         }
if ($papercode=="XL" OR $papercode=="XE")  {
echo "Section : ".$sec1name." ( ".$sec1." )<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$sec2name." ( ".$sec2." )" ;
     }

?>
</font></tr></td>


</tbody></table>
<br>
<table width="670px"><tbody>
<tr><th><center>Marks<br> (0ut of 100)<sup>*</sup></center></th><th><center>AIR<br> in this paper</center></th><th><center>GATE <br>Score</center></th></tr>
<tr>
<td width="150px"><center><?php echo $marks ;?> (out of 100)</center></td>
<td><center><?php echo $air ;?></center></td>
<td><center><?php echo $score ;?></center></td></tr>
<tr><td colspan="3"><center>*Normalized marks for multi-session papers (CE, CS, EE, ME)</td></tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<table width="830px" align="center"><tbody><tr>
<td width="450px">Total Candidates appeared in [ <?php echo $papercode ;?>] <?php echo $papername; ?> : <b><?php echo $appeared; ?></b></td></tr></tbody>
</table>
<br><br>
<table width="800"><tbody>
<tr><th colspan="3"><center>Qualifying Marks (out of 100)</center></th><td rowspan="3"><div id="sv_bord2"><br><p align="justify"><font size="1">A
 candidate is considered qualified if the marks secured is greater than 
or equal to the qualifying mark mentioned for the category for which a 
valid Category Certificate, if applicable, is produced along with the 
original scorecard.</font></p>
</div>
</td></tr>
<tr><td width="100"><center>General</center></td><td width="100"><center>OBC (NCL)</center></td><td width="100"><center>SC/ST/PwD</center></td></tr>
<tr><td><center><?php echo $gencutoff ; ?></center></td><td><center><?php echo $obccutoff;i ?></center></td><td><center><?php echo $sccutoff;?></center></td></tr>
</tbody>
</table>
</center>
<br>
<div id="sv_dfinger"><p align="center"><i><strong><font color="#db6915">Digital Fingerprint:</font></strong><?php echo $finger;?></i></p></div>
<div id="sv_dfinger_2">
<p>The digital fingerprint that appears here should be identical to the one appearing on the Candidate's Scorecard, as it asserts the integrity of the contents.</p>
</div>
<br><br>
<div id="sv_bord1"><strong>Other Information</strong>
<ul>
    <li>Official scorecards can be downloaded by the following candidates:
<ul>
    <li>All the candidates whose marks are greater than or equal to the qualifying marks of OBC (NCL) candidates in their respective papers, and</li>
    <li>All SC/ST/PwD candidates* whose marks are greater than or equal to the qualifying marks of SC/ST/PwD candidates in their respective papers<br><i>* As per GATE 2015 candidate records.</i></li>
</ul>
     </li>
<li>For the papers CE, CS, EC, EE and ME, qualifying marks and score are based on "Normalized Marks".</li></ul></div>
		</div>
	</div>
	<center><img src="img/page_shadow.png" alt="image not found" width="890px"></center>
</body></html>
 ?>

