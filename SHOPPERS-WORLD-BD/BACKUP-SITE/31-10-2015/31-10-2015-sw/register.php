<?php
session_start();
if(isset($_SESSION['user'])!="")
{
	header("Location: home.php");
}
include_once 'dbconnect.php';

if(isset($_POST['btn-signup']))
{


	$uname = mysql_real_escape_string($_POST['uname']);
	$email = mysql_real_escape_string($_POST['email']);
	$upass = md5(mysql_real_escape_string($_POST['pass']));
	$fulln = mysql_real_escape_string($_POST['fullname']);
	$cardn = mysql_real_escape_string($_POST['cardname']);
	$address = mysql_real_escape_string($_POST['address']);
	$city = mysql_real_escape_string($_POST['city']);
	$pos = mysql_real_escape_string($_POST['poscode']);
	$country = mysql_real_escape_string($_POST['country']);
	$id = mysql_real_escape_string($_POST['idcard']);
	$mobile = mysql_real_escape_string($_POST['mobile']);
	$dob = mysql_real_escape_string($_POST['dob']);
	$blg = mysql_real_escape_string($_POST['bloodgroup']);
	$gender = mysql_real_escape_string($_POST['gender']);
	$mrs = mysql_real_escape_string($_POST['meritals']);
	$tnc = mysql_real_escape_string($_POST['tnc']);
	$nom_name=mysql_real_escape_string($_POST['nom_name']);
	$nom_mobile=mysql_real_escape_string($_POST['nom_mobile']);
	$rel_nom=mysql_real_escape_string($_POST['rel_nom']);
   //	$agreecard=mysql_real_escape_string($_POST['agreecard']);

	
	
$field = isset($_POST['agreecard']) ? $_POST['agreecard'] : false;
					$dbFlag = $field ? 'Yes' : 'No';







$file=$_FILES['uploadedfile']['tmp_name'];
 
if  ($file!="") {

	  
$upload_path = '../attach/'; 

 $location=$_FILES['uploadedfile']['name'];


if (file_exists("$upload_path" . "$location")) {
$random_digit=rand(0000,9999);
$location=$random_digit.$location;

}

else {

$location = $_FILES['uploadedfile']['name'];


}


$target = $upload_path .$location;



move_uploaded_file($_FILES["uploadedfile"]["tmp_name"],"../attach/" . $location);
}








$ca= "SELECT * FROM swbd_privilege_regi WHERE username='$uname' and email='$email' and mobile='$mobile' ";
		$res=mysql_query($ca);
		$rowss=mysql_num_rows($res);
		if($rowss>0)

				{

$msg = 'You are in a process of Registration..... ';


echo " <script>alert ('$msg') </script>";
}


else{	

$checka = mysql_query("SELECT * FROM swbd_privilege_regi");
$rows=mysql_num_rows($checka);

				$check = mysql_query("SELECT max(SUBSTR(reg_num,5))as reg_num FROM swbd_privilege_regi");
									//$room_count = mysql_num_rows($check);
                                    while ($room = mysql_fetch_array($check)) {
										$reg_num=$room['reg_num'];
									}
								
								
							
								
if($rows=='0'){


$REG_NO='REG-10001';


$sql=mysql_query("INSERT INTO swbd_privilege_regi(reg_num,username,nom_name,nom_mobile,rel_nom,agreecard,email,password,fullname,cardname,address,city,poscode,country,idcard,mobile,dob,bloodgroup,gender,meritals,uploadedfile,tnc) 
	VALUES('$REG_NO','$uname','$nom_name','$nom_mobile','$rel_nom','$dbFlag','$email','$upass','$fulln','$cardn','$address','$city','$pos','$country','$id','$mobile','$dob','$blg','$gender','$mrs','$location','$tnc')");


}


else{

$F='REG-';
$P=$reg_num+1;
$REG_NO= $F.$P;

$sql=mysql_query("INSERT INTO swbd_privilege_regi(reg_num,username,nom_name,nom_mobile,rel_nom,agreecard,email,password,fullname,cardname,address,city,poscode,country,idcard,mobile,dob,bloodgroup,gender,meritals,uploadedfile,tnc) 
VALUES('$REG_NO','$uname','$nom_name','$nom_mobile','$rel_nom','$dbFlag','$email','$upass','$fulln','$cardn','$address','$city','$pos','$country','$id','$mobile','$dob','$blg','$gender','$mrs','$location','$tnc')");



}


echo "<script>alert('You are successfully Registerd for our Privilege Card');</script>";

//print_r($_POST);


}

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login & Registration System</title>
<link rel="stylesheet" href="style.css" type="text/css" />





</head>
<body>
<center>
<div id="login-form">
<form method="post" action="" enctype="multipart/form-data">

<table align="center" width="70%" border="0">
<tr width="50%"><td colspan="2" align="center">
<span style="font-family:Verdana;font-weight:bold;font-size:25px;color:#E67E22;">Privilege Card Registration Form</span>
</td></tr>
<tr>
<td width="50%"><input type="text" name="fullname" placeholder="Full Name*" required /></td>
<td width="50%"><input type="text" name="uname" placeholder="User Name*" required /></td>
</tr>
<tr>
<td width="50%"><input type="email" name="email" placeholder="Your Email*" required /></td>
<td width="50%"><input type="password" name="pass" placeholder="Your Password*" required /></td>
</tr>
<tr>
<td width="50%"><input type="text" name="cardname" placeholder="Name of Privilege Card*" required /></td>
<td width="50%"><textarea name="address" placeholder="Address*" required /></textarea></td>
</tr>
<tr>
<td width="50%"><input type="text" name="city" placeholder="City" required /></td>
<td width="50%"><input type="text" name="poscode" placeholder="Post Code" required /></td>
</tr>
<tr>
<td width="50%"><select name="country">
                        <option>--Select Country--</option>
                        <option>Bangladesh</option>
                        <option>Others</option>
                    </select></td>
<td width="50%"><input type="text" name="idcard" placeholder="National ID Card*" required /></td>
</tr>
<tr>
<td width="50%"><input type="text" name="mobile" placeholder="Mobile No*" required /></td>
<td width="50%"><span style="font-family:Verdana, Geneva, sans-serif;font-size:12px;position:relative;left:2px;color:#fff">Date of Birth*</span><input type="date" name="dob"/></td>
</tr>
<tr>
<td width="50%"><select name="bloodgroup" required >
                        <option>--Select Blood Group--</option>
                        <option>A Positive (A+)</option>
                        <option>B Positive (B+)</option>
                        <option>AB Positive (AB+)</option>
                        <option>O Positive (O+)</option>
                        <option>A Negative (A-)</option>
                        <option>B Negative (B-)</option>
                        <option>AB Negative (AB-)</option>
                        <option>O Negative (O-)</option>
                    </select></td>
<td width="50%"><select name="gender">
                        <option>--Select Gender--</option>
                        <option>Male</option>
                        <option>Female</option>
                    </select>
</td>
</tr>
<tr>
<td width="50%"><span style="font-family:Verdana, Geneva, sans-serif;font-size:12px;position:relative;left:2px;color:#fff">Merital Status</span><select name="meritals">
                        <option>--Select Option--</option>
                        <option>Married</option>
                        <option>Unmarried</option>
						<option>Others</option>
                    </select></td>
<td width="50%"><span style="font-family:Verdana, Geneva, sans-serif;font-size:12px;position:relative;left:2px;color:#fff">Upload Photo & National ID Card of both side </span>
<input style="height:25px;"type="file" name="uploadedfile" required /></td>
</tr>
<tr>

<td colspan="2">
<center><span style="font-family:Verdana;font-size:16px;position:relative; top:-15px; left:2px;color:#fff;"><strong>Nominee details For Insurance Claim</strong></span></center>
<input type="text" name="nom_name" placeholder="Nominee Name"required/></td>

</tr>
<tr>
<td><input type="text" name="nom_mobile" placeholder="Nominee Mobile"required/></td>
<td><input type="text" name="rel_nom" placeholder="Relation With Nominee"required/></td>
</tr>


<tr>
<td colspan="2">
<span style="font-family:Verdana;font-size:14px;position:relative; left:2px;color:#fff;">

<b><a style="font-size:15px;color:#fff;" href="#">( Read Terms & Conditions )</a></b></span><br><br>
<input type="hidden" name="tnc" value="0">
<input style="width:20px;height:20px;" type="checkbox" name="tnc" value="1" required/>&nbsp; 
<span style="font-family:Verdana, Geneva, sans-serif;font-size:14px;position:relative;bottom:3px;color:#fff">I have read and Agree to Shoppers World Privilege Card Membership</span></td>
</tr>

<tr>
<input type="hidden" name="agreecard" value="0">
<td colspan="2"><input style="width:20px;height:20px;" type="checkbox" name="agreecard" value="1"/>
&nbsp; 
<span style="font-family:Verdana, Geneva, sans-serif;font-size:14px;position:relative;bottom:3px; color:#fff">I Agree to buy Shoppers World Privilege Card </span></td>
</tr>

<tr>
<td><button id="signup" type="submit" name="btn-signup">Register</button></td>
</tr>

</table>

</form>
</div>
</center>
</body>
</html>