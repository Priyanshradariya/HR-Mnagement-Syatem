<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function 
session_start();
include_once 'config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);  
 
function generate_otp($n)
{
$gen = "1357902468";
$res = "";
for ($i = 1; $i <= $n; $i++)
{
$res .= substr($gen, (rand()%(strlen($gen))), 1);
}
return $res;
}
$num = 4;
$otp =generate_otp($num);

include_once 'config.php';
if(isset($_POST["submit"]))
{
    $email = $_POST['email'];  

    if(empty($email)){
        echo "Something went wrong";
    }
    else{
    $sql = "SELECT * from users where email = '$email'";

   $result =  mysqli_query($conn,$sql);  

    if($result->num_rows>=1)
   { 
        $row = mysqli_fetch_assoc($result);
        $_SESSION["email"] = $row["email"];
        $ans =  mysqli_query($conn,"UPDATE users SET OTP = '$otp' where email = '$email'"); 
       ?>
       <script>
        window.location.href = "OTPForgotpassword.php"
        </script>
       <?php 


    try {
        // Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                       // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'kashishsavaliya96@gmail.com';              // SMTP username
        $mail->Password   = 'bnub kknn yxlt tnsm';                    // SMTP password (Use App Password)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            // Enable implicit TLS encryption
        $mail->Port       = 465;                                    // TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        // Recipients
        $mail->setFrom('kashishsavaliya96@gmail.com', 'Coreway soulation');         // Sender email
        $mail->addAddress($row["email"], $row["name"]); // Add a recipient
        $mail->addReplyTo('info@example.com', 'Information');       // Reply-to address (optional)

        // Content
        $mail->isHTML(true);                                        // Set email format to HTML
        $mail->Subject = 'Coreway soulation'; 
        $mail->Body    = '<meta name="googlebot" content="noindex" />
        <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW"/>    
        <meta content="width=device-width, initial-scale=1.0" name="viewport">       
        </head>    
        <body marginheight=0 marginwidth=0 topmargin=0 leftmargin=0 style="height: 100% !important; margin: 0; padding: 0; width: 100% !important;min-width: 100%;">    
            
        <table name="bmeMainBody" style="background-color: rgb(255, 144, 0);" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#ff9000"><tbody><tr><td width="100%" valign="top" align="center"><table name="bmeMainColumnParentTable" width="100%" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td name="bmeMainColumnParent" style="border: 0px none transparent; border-radius: 0px; border-collapse: separate; border-spacing: 0px;"> <table name="bmeMainColumn" class="" style="max-width: 100%; border-radius: 0px; border-collapse: separate; border-spacing: 0px;" width="100%" cellspacing="0" cellpadding="0" border="0" align="center">    <tbody><tr><td class="blk_container bmeHolder" name="bmePreHeader" style="color: rgb(102, 102, 102); border: 0px none transparent; background-color: rgb(34, 34, 34);" width="100%" valign="top" bgcolor="#222222" align="center"><div id="dv_2" class="blk_wrapper"><table class="blk" name="blk_permission" style="" width="600" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td name="tblCell" style="padding:20px;" valign="top" align="left"><table width="100%" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td name="bmePermissionText" style="text-align: center;" align="center"><span style="font-family: Arial, Helvetica, sans-serif; font-weight: normal; font-size: 11px;line-height: 140%;"></span></td></tr></tbody></table></td></tr></tbody></table></div></td></tr> <tr><td class="bmeHolder" name="bmeMainContentParent" style="border: 0px none transparent; border-radius: 0px; border-collapse: separate; border-spacing: 0px; overflow: hidden;" width="100%" valign="top" align="center"> <table name="bmeMainContent" style="border-radius: 0px; border-collapse: separate; border-spacing: 0px; border: 0px none transparent;" width="100%" cellspacing="0" cellpadding="0" border="0" align="center"> <tbody><tr><td class="blk_container bmeHolder" name="bmeHeader" style="color: rgb(56, 56, 56); border: 0px none transparent; background-color: rgb(34, 34, 34);" width="100%" valign="top" bgcolor="#222222" align="center"><div id="dv_9" class="blk_wrapper"><table class="blk" name="blk_divider" style="" width="600" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td class="tblCellMain" style="padding-top:20px; padding-bottom:20px;padding-left:20px;padding-right:20px;"><table class="tblLine" style="border-top-width: 0px; border-top-style: none; min-width: 1px;" width="100%" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td><span></span></td></tr></tbody></table></td></tr></tbody></table></div><div id="dv_6" class="blk_wrapper"><table class="blk" name="blk_text" width="600" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td><table class="bmeContainerRow" width="100%" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td class="tdPart" valign="top" align="center"><table name="tblText" style="float:left; background-color:transparent;" width="600" cellspacing="0" cellpadding="0" border="0" align="left"><tbody><tr><td name="tblCell" style="padding: 20px; font-family: Arial, Helvetica, sans-serif; font-size: 14px; font-weight: normal; color: rgb(56, 56, 56); text-align: left;" valign="top" align="left"><div style="line-height: 150%; text-align: center;"><span style="font-size: 24px; font-family: Arial, Helvetica, sans-serif; color: #ff9000; line-height: 150%;">Coreway soulation</span></div></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></div><div id="dv_11" class="blk_wrapper"><table class="blk" name="blk_divider" style="" width="600" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td class="tblCellMain" style="padding: 5px 20px;"><table class="tblLine" style="border-top-width: 0px; border-top-style: none; min-width: 1px;" width="100%" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td><span></span></td></tr></tbody></table></td></tr></tbody></table></div><div id="dv_3" class="blk_wrapper"><table class="blk" name="blk_image" width="600" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td><table width="100%" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td class="bmeImage" style="padding: 0px; border-collapse: collapse;" align="center"><img src="https://www.benchmarkemail.com/images/templates_n/new_editor/Templates/Clock/Clock.png" style="max-width: 1200px; display: block; width: 600px;" alt="" width="600" border="0"></td></tr></tbody></table></td></tr></tbody></table></div>
        </td></tr> <tr><td class="blk_container bmeHolder" name="bmeBody" style="color: rgb(56, 56, 56); border: 0px none transparent; background-color: rgb(255, 144, 0);" width="100%" valign="top" bgcolor="#ff9000" align="center"><div id="dv_12" class="blk_wrapper"><table class="blk" name="blk_divider" style="" width="600" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td class="tblCellMain" style="padding-top:20px; padding-bottom:20px;padding-left:20px;padding-right:20px;"><table class="tblLine" style="border-top-width: 0px; border-top-style: none; min-width: 1px;" width="100%" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td><span></span></td></tr></tbody></table></td></tr></tbody></table></div><div id="dv_13" class="blk_wrapper"><table class="blk" name="blk_text" width="600" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td><table class="bmeContainerRow" width="100%" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td class="tdPart" valign="top" align="center"><table name="tblText" style="float:left; background-color:transparent;" width="600" cellspacing="0" cellpadding="0" border="0" align="left"><tbody><tr><td name="tblCell" style="padding: 20px; font-family: Arial, Helvetica, sans-serif; font-size: 14px; font-weight: normal; color: rgb(56, 56, 56); text-align: left;" valign="top" align="left"><div style="line-height: 150%; text-align: center;"><span style="font-size: 24px; font-family: Arial, Helvetica, sans-serif; color: #ffffff; line-height: 150%;"><strong>Your One-Time Password (OTP) is: '. $otp .'</strong></span></div></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></div><div id="dv_14" class="blk_wrapper"><table class="blk" name="blk_text" width="600" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td><table class="bmeContainerRow" width="100%" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td class="tdPart" valign="top" align="center"><table name="tblText" style="float:left; background-color:transparent;" width="600" cellspacing="0" cellpadding="0" border="0" align="left"><tbody><tr><td name="tblCell" style="padding-top: 10px; padding-bottom:10px; padding-left:20px; padding-right:20px; font-family: Arial,Helvetica,sans-serif; font-size: 14px; font-weight: normal; color: #383838; text-align: left;" valign="top" align="left"><div style="line-height: 150%; text-align: center;"><span style="font-size: 16px; font-family: Arial, Helvetica, sans-serif; color: #ffffff; line-height: 150%;">Use this code to complete your verification.If you did not request this code, please ignore this email or contact support.Thank you.</span></div></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></div><div id="dv_15" class="blk_wrapper"><table class="blk" name="blk_divider" style="" width="600" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td class="tblCellMain" style="padding: 15px 20px;"><table class="tblLine" style="border-top-width: 0px; border-top-style: none; min-width: 1px;" width="100%" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td><span></span></td></tr></tbody></table></td></tr></tbody></table></div><div id="dv_16" class="blk_wrapper"><table class="blk" name="blk_boxtext" width="600" cellspacing="0" cellpadding="0" border="0">';

        // Send email
        echo 'Preparing to send email...<br>';
        $mail->send();
        echo 'Message has been sent. Thank you for contacting us.';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    }
else{
    
    echo "<script>alert('Invlid Mail');</script>";
     echo '<script>window.history.back();</script>';
   
    

    }
    }
} 
else{
    header('Location : index.php');
    exit(0);
}

?>

