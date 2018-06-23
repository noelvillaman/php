<?php
			 session_start();
			// require the sign up file for the database connection
			require("sign_up.php");
?>
<!doctype html>
	
<!--- this file is the main page for our project --->
<html>
<head>
	<meta charset="utf-8">
	<title>DBPipe</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
	<script src="jquery.js"></script>
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.js"> </script>
    <link rel="stylesheet" type="text/css" href="bootstrap.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script>
	$().ready(function(){
		$("#sign_up").validate({
			
			rules:{
				signup_name:{
					required:true,
					minlength:6,
					maxlength:20		
				},
				email:{
					required : true,
					email:true
				},
				signup_password:{
					required : true,
					minlength:6
					
				},
				signup_retype:{
					required:true,
					equalTo:"#signup_password"
				}	
			},
			messages:{
				signup_name:{
					required: "Please enter your username"
				},
				signup_password:{
				    required:"Please enter a password"
				},
			signup_retype:{
					required:"Plaese retype your password",
					equalTo:"not equal to your pass"
				
			}
			}
			
		});
		
		$("#sign_in").validate({
			rules:{
				signin_name:{
					required:true
				
				},
				
				signin_password:{
					required:true
				}
			}
		});
		
		$("#quick_connect").validate({
			rules:{
				server:{
					required:true
				},
				database:{
					required:true
				},
				username:{
					required:true
				},
				password:{
					required:true
					
				}
				
			}
		});
		
	});
			
				
			
		</script>
</head>
<body>
<div id="wrapper">
<h1>Welcome to DBPipe</h1>
<div id="lefty">
		
            <h3>Quick Connect</h3>
        
        <form method="post" action="dbpipe_datalayer.php" id ="quick_connect">
            Server and port#:<br>
            <input type="text" name="server" placeholder = "Server:Port">
            <br>
            Database:<br>
            <input type="text" name="database" placeholder ="Database Name">
            <br>
            Username:<br>
            <input type="text" name="username" placeholder = "database username">
            <br>
            Password:<br>
            <input type="password" name="password" placeholder ="database password">
            <br>
            DBType:<br>
            <select name="dbtype">
				  <option disabled selected> -- Select a DB Engine -- </option>
                  <option value="mysql">MySQL</option>
                  <option value="oci">Oracle</option>
                  <option value="oci8">Oracle OCI8</option>
                  <option value="mssql">Microsoft SQL Server</option>
                  <option value="sqlite">Sqlite</option>
                  <option value="pgsql">PostgreSQL</option>
          
            </select>
            <br>
            <br><br>
            <input class="btn btn-lg btn-success" id="connectbutton2" type="submit" name="submit" value="CONNECT">
            
            
			<?php
                if (isset($_POST["submit"])){
                    echo "There are errors";
                }
            ?>
        </form>
        </div>
        <div id="lefty2">
        	<h3>Signup</h3>
            <form action="signup_check.php" method="post" id="sign_up">
            Username: <br>
            	<input  type="text" name="signup_name"><br>
			Email:<br>
				<input type="email" name="email"><br>
            Password: <br>
                <input type="password" name="signup_password" id = "signup_password"><br>
			Retype Password: <br>
                <input type="password" name="signup_retype">
                <br>
				<br><br><input class="btn btn-lg btn-success" id="connectbutton2" type="submit" name="submit" value="REGISTER"><br>
			</form>
				
			<h3> Sign in</h3>
			<form action ="signin_check.php" method = "post" id="sign_in"><br>
			Username:<br>
				<input  type ="text" name = "signin_name"><br>
			Password: <br>
				<input type = "password" name = "signin_password"><br>
				<br><br><input class="btn btn-lg btn-success" id="connectbutton2" type="submit" name="submit_2" value="LOG IN "> <br> 
                
            </form>
			
		
        </div>
        <footer></footer>
</div>


</body>
</html>
