<?php
ob_start();
session_start();
include('conn/conn.php');
error_reporting(E_ALL ^ E_NOTICE);

 //GET THE CLIENT IP ADDRESS
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
    $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
    $ip = $_SERVER['REMOTE_ADDR'];
    }
	
	$email = $_POST['email'];
	$password = md5($_POST['password']);
						
	//FUNCTION LOGIN
	
	if(empty($password) || empty($email))
	{
	  	echo "<div class='alert alert-danger fade in'>
	  			<button class='close' data-dismiss='alert'>
	  				<span>×</span>
	  			</button>
	  			<strong>Oops!</strong> Username or passwordword Empty.
	  		</div>";
	
	}else{
		
		$sql = "SELECT * FROM useraccount WHERE email=:mail AND pswd =:Pxs ";

		try {
			$stmt = $conn->prepare($sql);  
			$stmt->bindParam("mail", $email);
			$stmt->bindParam("Pxs", $password);
			$stmt->execute();
			$log = $stmt->fetch(); 	
		
		
		    //CHECK IF STUDENT HAS LOGGED IN
			if($log > 0){   
				// INITIALISE SOME VARIABLES
				$userid = $log['user_ID'];
				$username = $log['username'];
				$level = $log['level'];
				$user_status = $log['user_status'];
				$user_flag = $log['user_flag'];
				$date_from = $log['createdate'];
					
				//INITIALISE SESSION
				$_SESSION['userid'] = $userid;
				$_SESSION['level'] = $level;
				$_SESSION['username'] = $username;                

				if($user_status == "OFFLINE"){

					//TRACK USERLOGS
					$_SESSION['now'] = date('Y-m-d H:i:s');

					$logs = $conn->prepare( "INSERT INTO user_log ( user_ID, ip_add, login_time, logout_time) VALUES( ?, ?, ?, ? )" );
					$logs->execute(array($userid, $ip, $_SESSION['now'], $_SESSION['now']));
						
					if(($level == 'DOCTOR') && ($user_flag == 'ACTIVE')){
						
						$_SESSION['Doc_ID'] = $emailcode;

						//PUT USER STATUS TOM ONLINE
						$upds = $conn->prepare("UPDATE useraccount SET user_status = ? WHERE user_ID = ? ");
						$upds->execute(array('ONLINE', $_SESSION['userid']));
								
						echo "<div class='alert alert-success fade in'>
								<button class='close' data-dismiss='alert'>
									<span>×</span>
								</button><strong></strong> Login Successful.
							</div>";
						?>
							<script>setTimeout(function(){window.location.href='doctor/'},2000);</script>
						<?php

					}elseif(($level == 'PATIENT')&& ($user_flag == 'ACTIVE')){
						
						$_SESSION['custcode'] = $emailcode;

						//PUT USER STATUS TOM ONLINE
						$upds = $conn->prepare("UPDATE useraccount SET user_status = ? WHERE user_ID = ?");
						$upds->execute(array('ONLINE', $_SESSION['userid']));
								
						echo "<div class='alert alert-success fade in'>
								<button class='close' data-dismiss='alert'>
									<span>×</span>
								</button><strong></strong> Login Successful.
							</div>";
						?>
							<script>setTimeout(function(){window.location.href='patient/'},2000);</script>
						<?php

					}else{

						echo "<div class='alert alert-danger fade in'>
								<button class='close' data-dismiss='alert'>
									<span>×</span>
								</button><strong>Oops!</strong> Your Account Has Expired.
							</div>";
					}
				}elseif($user_status == "ONLINE"){

					$t = $_SERVER['REMOTE_ADDR'];

					if ($t === $ip) {

						echo "<div class='alert alert-success fade in'>
								<button class='close' data-dismiss='alert'>
									<span>×</span>
								</button><strong></strong> Login Successful.
							</div>";

						?>
							<script>setTimeout(function(){window.location.href='patient/'},2000);</script>
						<?php
						
					}else{
						echo "<div class='alert alert-danger fade in'>
	        					<button class='close' data-dismiss='alert'>
	        						<span>×</span>
	        					</button><strong>Oops!</strong> Please your account is already used.
	        				</div>";
					}
        			
		   		} 
			}else{

				echo "<div class='alert alert-danger fade in'>
						<button class='close' data-dismiss='alert'>
							<span>×</span>
						</button><strong>Oops!</strong> Invalid Username or password.
					</div>";
			}
			
			$conn = null;

		}catch(PDOException $e) {
			echo "<div class='alert alert-danger fade in'>
					<button class='close' data-dismiss='alert'>
						<span>×</span>
					</button><strong>Oop!</strong> {error:{text:". $e->getMessage()."}}
				</div>";
	}
}

?>