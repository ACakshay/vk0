<? include ("inc/header.php"); ?>
<script type="text/javascript">
$(document).ready(function() {
	var txtNewPassword 		= $('#txtNewPassword'); //id of first password field
	var txtRetypePassword		= $('#txtRetypePassword'); //id of second password field
	var passwordsInfo 	= $('#pass-info'); //id of indicator element
	
	passwordStrengthCheck(txtNewPassword,txtRetypePassword,passwordsInfo); //call password check function
	
});

function passwordStrengthCheck(txtNewPassword, txtRetypePassword, passwordsInfo)
{
	//Must contain 5 characters or more
	var WeakPass = /(?=.{5,}).*/; 
	//Must contain lower case letters and at least one digit.
	var MediumPass = /^(?=\S*?[a-z])(?=\S*?[0-9])\S{5,}$/; 
	//Must contain at least one upper case letter, one lower case letter and one digit.
	var StrongPass = /^(?=\S*?[A-Z])(?=\S*?[a-z])(?=\S*?[0-9])\S{5,}$/; 
	//Must contain at least one upper case letter, one lower case letter and one digit.
	var VryStrongPass = /^(?=\S*?[A-Z])(?=\S*?[a-z])(?=\S*?[0-9])(?=\S*?[^\w\*])\S{5,}$/; 
	
	$(txtNewPassword).on('keyup', function(e) {
		if(VryStrongPass.test(txtNewPassword.val()))
		{
			passwordsInfo.removeClass().addClass('vrystrongpass').html("Very Strong! (Awesome, please don't forget your pass now!)");
		}	
		else if(StrongPass.test(txtNewPassword.val()))
		{
			passwordsInfo.removeClass().addClass('strongpass').html("Strong! (Enter special chars to make even stronger");
		}	
		else if(MediumPass.test(txtNewPassword.val()))
		{
			passwordsInfo.removeClass().addClass('goodpass').html("Good! (Enter uppercase letter to make strong)");
		}
		else if(WeakPass.test(txtNewPassword.val()))
    	{
			passwordsInfo.removeClass().addClass('stillweakpass').html("Still Weak! (Enter digits to make good password)");
    	}
		else
		{
			passwordsInfo.removeClass().addClass('weakpass').html("Very Weak! (Must be 5 or more chars)");
		}
	});
	
	$(txtRetypePassword).on('keyup', function(e) {
		
		if(txtNewPassword.val() !== txtRetypePassword.val())
		{
			passwordsInfo.removeClass().addClass('weakpass').html("Passwords do not match!");	
		}else{
			passwordsInfo.removeClass().addClass('goodpass').html("Passwords match!");	
		}
			
	});
}
</script>
<?
$message="";
if(isset($_POST["btnChPassword"]))
{
	$sql="select * from tblLoginMaster where LoginId='".$admin_loginid."' and Password='".$_POST['txtOldPassword']."'";
	$result =  mysql_query($sql) or die("Error in query : ".$sql."<br>".mysql_error().":".mysql_errno());
	if(mysql_num_rows($result)>0)
   	{
   		if($_POST['txtNewPassword']==$_POST['txtRetypePassword'])
		{
			$sql2="update tblLoginMaster set Password='".$_POST['txtNewPassword']."' where rec_id='".$admin_recid."' and Password='".$_POST['txtOldPassword']."'";
			$result2 =  mysql_query($sql2) or die("Error in query : ".$sql2."<br>".mysql_error().":".mysql_errno());
			$message="<font color='green'>Password Changed!!</font>";
		}
		else
		{
			$message="New Passwords do not match!!";
		}
   	}
	else
	{
		$message="Invalid Old Password!!";
	}
}
?>
<table width="100%" cellpadding="0" cellspacing="0" align="center" border="0" height="100%" bgcolor="#FFFFFF">
	<tr><td class="pgHead">Change Password</td></tr>
    <tr>
    	<td align="center" valign="top" class="header_shadow">
        	<table width="97%" cellpadding="0" cellspacing="0" align="center" border="0">
                <tr><td class="message" align="center" height="20px"><?=$message?></td></tr>
                <tr>
                    <td align="center" valign="top" class="login_box">
                        <table width="100%" cellpadding="0" cellspacing="0" align="center" border="0">
                            <tr>
                                <td valign="top" class="login_head_bg">
                                	<div class="blue_bg" style="float:left;">Change Password</div>
                                </td>
                            </tr>
                            <tr>
                            	<td align="center" valign="top" style="padding:10px;">
                                	<form id="frmChPassword" name="frmChPassword" method="post" onSubmit="return validatePassword()"> 
                                        <table width="700px" cellpadding="0" cellspacing="0" align="center" border="0" class="myTableR">
                                            <tr bgcolor="#EFEFEF">
                                                <td class="loginTxt">Name</td>
                                                <td align="left" class="trow"><?=$admin_username?></td>
                                            </tr>
                                            <tr>
                                                <td class="loginTxt" width="300px">Old Password<span class="red">*</span></td>
                                                <td align="left" width="400px">
                                                    <input type="password" id="txtOldPassword" name="txtOldPassword" style="width:180px;"/>
                                                    <span id="currentPassword"  class="required"></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="loginTxt">New Password<span class="red">*</span></td>
                                                <td align="left">
                                                    <input type="password" id="txtNewPassword" name="txtNewPassword" style="width:180px;"/>
                                                    <span id="newPassword"  class="required"></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="loginTxt">Retype New Password<span class="red">*</span></td>
                                                <td align="left"><input type="password" id="txtRetypePassword" name="txtRetypePassword" style="width:180px;"/><span id="confirmPassword"  class="required"></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td align="left">
                                                    <input type="submit" id="btnChPassword" name="btnChPassword" value="Change Password" class="button"/>
                                                </td>
                                            </tr>
                                        </table>
                                    </form>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<? include ("inc/footer.php"); ?>