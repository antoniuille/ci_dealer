
<?php
if(isset($_POST['submits'])) {
$strFromNumber = "+14352363768";
$strToNumber = '+1' . $leads_details->mobile;
$strMsg = "Your vehicle has been successfully repaired and is currently being cleaned and certified for delivery. Please wait for a call from our representative to schedule a pick up time. -Automated Message, No-Reply"; 
$aryResponse = array();
 

    // include the Twilio PHP library - download from 
    // http://www.twilio.com/docs/libraries/
    require_once ("inc/Services/Twilio.php");
 
    // set our AccountSid and AuthToken - from www.twilio.com/user/account
    $AccountSid = "ACfdf45827345157a2dc313cd55f011c50";
    $AuthToken = "39cc484a9a62a327cbc90a2fa968ca7f";
 
    // ini a new Twilio Rest Client
    $objConnection = new Services_Twilio($AccountSid, $AuthToken);


    // Send a new outgoinging SMS by POSTing to the SMS resource */
    $bSuccess = $objConnection->account->sms_messages->create(
        
        $strFromNumber,     // number we are sending From 
        $strToNumber,           // number we are sending To
        $strMsg         // the sms body
    );

        
    $aryResponse["SentMsg"] = $strMsg;
    $aryResponse["Success"] = true;
    
    
    echo json_encode($aryResponse);
 


}
?>
