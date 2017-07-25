<?php
include('conn/conn.php');
error_reporting(E_ALL ^ E_NOTICE);

	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$username = $_POST['username'];
	$tel = $_POST['tel'];
	$email = $_POST['email'];
	$password = md5($_POST['password']);

if(!empty($_POST)){

	if(empty($firstname) || empty($lastname) || empty($email) || empty($username) || empty($tel) || empty($password) ){
		echo "<div class='alert alert-danger fade in'>
				<button class='close' data-dismiss='alert'>
					<span>×</span>
				</button><strong>Oops!</strong> Please one field is left empty.
			</div>";
	}else{
		$gpd = $conn->prepare("SELECT * FROM useraccount WHERE email = ? OR username = ?");
		$gpd->execute(array($email, $username));
		$rgpd = $gpd->fetch();

		if($rgpd > 0){
			echo "<div class='alert alert-danger fade in'>
					<button class='close' data-dismiss='alert'>
						<span>×</span>
					</button><strong>Oops!</strong> Customer account Already exist.
				</div>";
		}else{
			//FIXED VARIABLES
			$date = date('Y-m-d H:i:s');
			$flag = 'ACTIVE';
			$level = 'PATIENT';
			$ustat = 'OFFLINE';
			    
			$ac = $conn->prepare( "INSERT INTO patient (firstname, lastname, tel, pat_flag) 
									VALUES(?, ?, ?, ? )" );
			$su = $conn->prepare( "INSERT INTO useraccount (username, email, pswd, level, user_flag, user_status, createdate) 
									VALUES(?, ?, ?, ?, ?, ?, ? )" );
			
			try {

				if($ac->execute(array($firstname, $lastname, $tel, $flag))){

					$su->execute(array($username, $email, $password, $level, $flag, $ustat, $date));

					echo "<div class='alert alert-success fade in'>
							<button class='close' data-dismiss='alert'>
								<span>×</span>
							</button><strong></strong> Your Account Has been created.
						</div>";
					
					$conn = null;
					?>
						<script>setTimeout(function(){window.location.href='index.php'},2000);</script>
					<?php

				}else{

					echo "<div class='alert alert-danger fade in'>
							<button class='close' data-dismiss='alert'>
								<span>×</span
							button><strong>Oop!</strong> Error Occured while creating account.
						</div>";
				}

			}catch(PDOException $e) {

				echo "<div class='alert alert-danger fade in'>
						<button class='close' data-dismiss='alert'>
							<span>×</span>
						</button><strong>Oop!</strong> {error:{text:". $e->getMessage()."}}
					</div>";
			}
		}
	}

}else{

	echo "<div class='alert alert-danger fade in'>
			<button class='close' data-dismiss='alert'>
				<span>×</span>
			</button><strong>Oops!</strong> Invalid data entry.
		</div>";
}


?>

