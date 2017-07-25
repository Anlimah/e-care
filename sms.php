<?php
      // $to = urlencode('0246108878');
	   //$from = urlencode('FGBMFI');  // the sender id
       //$msg = urlencode('JACKS7 NIEE'); 
	   // create curl resource
        $ch = curl_init(); 

        // set url
        curl_setopt($ch, CURLOPT_URL, "http://www.mytxtbox.com/smsghapi.ashx/sendmsg?api_id=123456&user=ipmc&password=ipmcgh&to=".$to."&text=".$msg."&from=".$from."" ); 	

        //return the transfer as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

        // $output contains the output string
        $output = curl_exec($ch); 

        // close curl resource to free up system resources
        curl_close($ch);
		
		?>