<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script> 
<?php

include('parser.php');

  $strResult = " expect a snack!";
  if($phoneNr){
    $strRecipient = '+31'.$phoneNr;
  }else{
    $strRecipient = "+31683598299";
  }
  // $strRecipient = "+31683598299";
  $strPincode = "";

  
  $objGsm = new COM("AxSms.Gsm", NULL, CP_UTF8 ); 
  $objGsm->LogFile = sys_get_temp_dir()."Gsm.log"; 
  //Windows default: 'C:\Windows\Temp\Gsm.log'
  
  //Form submitted
  if (isset( $_POST["btnSendMessage"] ))
  {
    $obj;
   $strMessageReference;
   
    $objSmsMessage   = new COM("AxSms.Message",    NULL, CP_UTF8 );
   
    $objSmsConstants = new COM("AxSms.Constants" , NULL, CP_UTF8 );
    
    $strName = $_POST["ddlDevices"];
    $strPincode = $_POST["txtPincode"];
    $strRecipient = $_POST["txtToAddress"];
    $iDeviceSpeed = $_POST["ddlDeviceSpeed"];
    
    $objGsm->Clear();
    $objGsm->LogFile = $_POST["txtResult"];
    $objGsm->Open($strName, $strPincode, $iDeviceSpeed);
    
    if ($objGsm->LastError != 0)
    {
      $strResult = $objGsm->LastError . ": " . $objGsm->GetErrorDescription($objGsm->LastError);
      $objGsm->Close();
    }
    else
    {
      //Message Settings
      $objSmsMessage->Clear();
      $objSmsMessage->ToAddress = $strRecipient;
      // $objSmsMessage->Body = $_POST["txtMessage"];
        if($message){
          $objSmsMessage->Body = $message;
        }else{
          $objSmsMessage->Body = $_POST['txtMessage'];
        }
       
     
      if (isset( $_POST["cbxUnicode"] ))
      {
        $objSmsMessage->DataCoding = $objSmsConstants->DATACODING_UNICODE;
      }
      
      //Send the message !
      
      $obj = $objSmsMessage;
      
      $objGsm->SendSms($obj, $objSmsConstants->MULTIPART_ACCEPT, 0);
     
      $objSmsMessage = $obj;
      
      $strResult = $objGsm->LastError . ": " . $objGsm->GetErrorDescription($objGsm->LastError);
      
      $objGsm->Close();
    }
  }  
  
?>

    <div class="container">
      <h1>SMS Component PHP GSM Sample for Devrepublic</h1>
      <hr />
      <p>
        This demo requires a GSM modem or GSM phone connected to your computer. A SIM card
        is required in this GSM modem. The product works with almost all available GSM modems.
      </p>
      <form action="gsm.php" method="post" id="webform">
        <h2>SMS Component:</h2>
        <h3>Build: <?php echo $objGsm->Build; ?>; Module: <?php echo $objGsm->Module; ?></h3>
        
        <!-- Device -->
        <label for="Devices">Device:</label>
        <p>
          <select id="Devices" name="ddlDevices">
          <?php
            $strDevice = $objGsm->FindFirstDevice();            
            while ($objGsm->LastError == 0)
            {
              echo '
            <option value="'.$strDevice.'">'.$strDevice.'</option>';
              $strDevice = $objGsm->FindNextDevice();
            }
            
            $strPort = $objGsm->FindFirstPort();
            while ($objGsm->LastError == 0)
            {
              echo '
            <option value="'.$strPort.'">'.$strPort.'</option>';
              $strPort = $objGsm->FindNextPort();
            }
          ?>
          
          </select>
        </p>
        
        <!-- Device Speed -->
        <label for="DeviceSpeed">Device Speed:</label>
        <p>
          <select id="DeviceSpeed" name="ddlDeviceSpeed">
            <option value="0">Default</option>
            <option value="110">110</option>
            <option value="300">300</option>
            <option value="600">600</option>
            <option value="1200">1200</option>
            <option value="2400">2400</option>
            <option value="4800">4800</option>
            <option value="9600">9600</option>
            <option value="14400">14400</option>
            <option value="19200">19200</option>
            <option value="38400">38400</option>
            <option value="56000">56000</option>
            <option value="57600">57600</option>
            <option value="64000">64000</option>
            <option value="115200">115200</option>
            <option value="128000">128000</option>
            <option value="230400">230400</option>
            <option value="256000">256000</option>
            <option value="460800">460800</option>
            <option value="921600">921600</option>
          </select>
          Only applies to direct ports, i.e. COM1, COM2, etc.
        </p>
        
        <!-- Pincode -->
        <label for="Pincode">Pincode:</label>
        <p>
          <input type="password" id="Pincode" name="txtPincode" value="<?php echo $strPincode; ?>" />
          Only use when SIM card requires PIN code
        </p>
        
        <!-- Empty row -->
        <div class="clearRow"></div>
        
        <!-- ToAddress -->
        <label for="ToAddress">ToAddress:</label>
        <p>
          <input type="text" id="ToAddress" name="txtToAddress" value="<?php echo $strRecipient; ?>" />
          <a href="http://www.activexperts.com/support/xmstoolkit/?kb=Q4200015" target="_blank">Recipient number format</a>
        </p>
        
        <!-- Body, Unicode -->
        <label for="Body">Body:</label>
        <p>
          <textarea id="Message" name="txtMessage" style="height:45px;"><?php if (!empty ($_POST['txtMessage'])) echo $_POST['txtMessage']; else echo $message ?></textarea><br />
          
          <input type="checkbox" class="cbFix" id="Unicode" name="cbxUnicode" <?php if (isset($_POST['cbxUnicode'])) echo "checked=\"yes\""; ?> />
          <label for="Unicode">Unicode</label>
        </p>
        
        <!-- Empty row -->
        <div class="clearRow"></div>
        
        <!-- Send button -->
        <span>Form will automatically submit in <b id="timer">5</b> <b>seconds</b>.</span>

        <div class="clearLabel"></div>
        <p>
          <input type="submit" name="btnSendMessage" value="Send SMS Message!" id="heck" />
        </p>
        
        <!-- Result -->
        <label for="Result"><b>Result:</b></label>
        <p>
          <input type="text" id="Result" name="txtResult" class="FullWidth Bold" value="<?php echo $strResult; ?>" />
        </p>
        <? return $_REQUEST['strResult']?>
      </form>
      <p>
        This demo uses the ActiveXperts SMS Component, an <a href="http://www.activexperts.com" target="_blank">ActiveXperts Software</a> product.<br />
        <a href="index.php">Back to main page</a> 
      </p>




 <?php if ($_REQUEST['autosubmit']) { 
  ?>
  <script>
 $(document).ready(function(){
            // 
            document.getElementById('heck').click();
        });
</script>


<?php } ?> 
    </div><!-- /container -->

<!-- <script src="auto_submit.js"></script> -->