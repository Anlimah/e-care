<!DOCTYPE html>
<html lang="en"><head>
	<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>E-insure</title>

	<script src="js/jquery-2.1.1.min.js"></script>
</head>
<body>

	<div style="float:right">
		<!-- REGISTRATION FORM -->
		<form action = "" method= "POST" >
			<div>
				<h4 class="text-thin">Customer Account</h4>
				<div id="success"></div>
				<label >First Name</label>
				<input type="text" name="firstname"  id= "firstname" placeholder="First Name" required>
				<br>
				<label >Last Name</label>
				<input type = "text" name="lastname" id="lastname" placeholder="Last Name" required >
				<br>
				<label >Userame</label>
				<input type = "text" name="username" id="username" placeholder="Username" required>
				<br>
				<label>Telephone</label>
				<input type="text"  name="tel" id="tel" placeholder="Telephone" required>
				<br>
				<label>Email</label>
				<input type="text"  name="email" placeholder="Email" required>
				<br>
				<label>Password</label>
				<input type="password" name="password" placeholder="Password" required>
				<br>
				<label>Retype password</label>
				<input type="password" name="conp" placeholder="Retype password">
				<br>
				<input type="submit" name="register" value="Submit"></input>
			</div>
		</form>
		
		<p>Already have an account ? <a href="index.php" >Sign In</a></p>	

	</div>
	
	<script type="text/javascript">
		$(document).on("submit", "form", function(event)
		{
		  event.preventDefault();        
		    $.ajax({
		        url: "register.php",//$(this).attr("action"),
		        type: $(this).attr("method"),
		       // dataType: "JSON",
		        data: new FormData(this),
		        processData: false,
		        contentType: false,
		        success: function (results)
		        {         
				  $('#success').html(results);

				  
		        },
		        error: function (xhr, desc, err)
		        {
		         }
		    });        
		});
	</script>
</body>
</html>
