    <html>  
       <body>  
         
          Welcome <?php echo $_POST["username"]; ?> </br>  
          Your blood group is: <?php echo $_POST["bloodgroup"]; ?> </br></br> 
          cf-turnstile-response (Token) is: <?php echo $_POST["cf-turnstile-response"]; ?>  </br></br>

          siteverify result is: <?php
          $data = [];
          $data['secret'] = 'YOUR_SECRET_KEY';
          $data['response'] = $_POST["cf-turnstile-response"];
          // 送信データをURLエンコード
          $data = http_build_query($data, "", "&");
          $curl = curl_init();
          curl_setopt_array($curl, [
            CURLOPT_URL => "https://challenges.cloudflare.com/turnstile/v0/siteverify",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $data]);
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            if ($err) {
               echo "cURL Error #:" . $err;
            } else {
               echo $response;
            }?>
      
       </body>  
    </html> 