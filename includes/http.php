<?php
  $strResult = "n/a";
  $strLastResponse = "";
  
  $objHttp = new COM("AxSms.Http");    
  $objSmsConstants = new COM("AxSms.Constants");    
  $objHttp->LogFile = sys_get_temp_dir()."Http.log"; 
  // Windows default: 'C:\Windows\Temp\Http.log'
  
  //Form submitted
  if (isset($_POST["btnSendMessage"]))
  {
    $objSmsMessage = new COM("AxSms.Message");  
    $objSmsMessage->Clear();
    $obj;
    
    $objSmsMessage->Body = $_POST['txtBody'];
    $objSmsMessage->ToAddress = $_POST['txtToAddress'];
    
    $objHttp->Clear();
    $objHttp->Url = $_POST['txtUrl'];
    
    $obj = $objSmsMessage;
    $objHttp->SendSms($obj, $objSmsConstants->MULTIPART_ACCEPT);
    
    $strResult = $objHttp->LastError . ": " . $objHttp->GetErrorDescription($objHttp->LastError);
    $strLastResponse = $objHttp->LastResponseCode;
  }
  
  function GetSmsDemoAccountInfo()
  {
    // NOTE: during installation of the SMS Component, a unique login and password is created for you.
    // This login and password can be used to send a few SMS messages through the smpp.activexperts-labs.com gateway, for free
    
    $objDemoAccount = new COM("AxSms.DemoAccount");  
    global $objSmsConstants;
    $strInfo = "http://192.168.88.245:8080/ACTIVEXSMS/includes/gsm.php?phoneNr=683598299&message=yourcodeis=5555&autosubmit=yes";
    $strInfo .= "?username=".$objDemoAccount->SystemId;
    $strInfo .= "&password=".$objDemoAccount->Password;
    $strInfo .= "&text=".$objSmsConstants->HTTP_PLACEHOLDER_BODY;
    $strInfo .= "&to=".$objSmsConstants->HTTP_PLACEHOLDER_TOADDRESS;
    
    return $strInfo;
  }
  
//HTML-CSS layout includes, no code there!
// include('css/Header.html'); 
// include('css/Menu.html'); 
?>
    <div class="container">
      <h1>SMS Component PHP HTTP Sample</h1>
      <hr />
      <p>
        The HTTP protocol is used for medium volume SMS messaging. Messages are first 
        routed to the service provider via Internet/VPN. The provider delivers the 
        messages to the recipient&#39;s phone. If you are not subscribed to a provider, use 
        the ActiveXperts gateway to send 10 SMS messages for free.
      </p>
      <form action="http.php" method="post">
        <h2>SMS Component:</h2>
        <h3>Build: <?php echo $objHttp->Build; ?>; Module: <?php echo $objHttp->Module; ?></h3>
        
        <!-- Connection URL -->
        <label for="Url">Connection URL:</label>
        <p>
          <input type="text" id="Url" name="txtUrl" class="FullWidth" value="<?php echo GetSmsDemoAccountInfo(); ?>" />
        </p>
        
        <!-- Empty row -->
        <div class="clearRow"></div>
        
        <!-- ToAddress -->
        <label for="ToAddress">ToAddress:</label>
        <p>
          <input type="text" id="ToAddress" name="txtToAddress" value="[ToAddress]" />
          <a href="http://www.activexperts.com/support/xmstoolkit/?kb=Q4200015" target="_blank">Recipient number format</a>
        </p>
        
        <!-- Body -->
        <label for="Body">Body:</label>
        <p>
          <textarea id="Body" name="txtBody" style="height:55px;">Hello world send from ActiveXperts SMS Component!</textarea>
        </p>
        
        <!-- Send button -->
        <div class="clearLabel"></div>
        <p>
          <input type="submit" name="btnSendMessage" value="Send SMS Message!" />
        </p>
        
        <!-- Empty row -->
        <div class="clearRow"></div>
        
        <!-- Result -->
        <label for="Result"><b>Result:</b></label>
        <p>
          <input type="text" id="Result" name="txtResult" class="FullWidth Bold" value="<?php echo $strResult; ?>" />
        </p>
        
        <!-- Last Response -->
        <label for="Response">Last Response:</label>
        <p>
          <input type="text" id="Response" name="txtLastResponse" class="FullWidth" value="<?php echo $strLastResponse; ?>" />
        </p>
      </form>
      <p>
        This demo uses the ActiveXperts SMS Component, an <a href="http://www.activexperts.com" target="_blank">ActiveXperts Software</a> product.<br />
        <a href="index.php">Back to main page</a> 
      </p>           
    </div><!-- /container -->
<?php 
//HTML-CSS layout include, no code there!
// include('css/Footer.html'); ?>      