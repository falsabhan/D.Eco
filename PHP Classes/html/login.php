<?php
   ob_start();
   session_start();
?>

<html lang = "en">
   
   <head>
      <title>Login</title>
       <style>
           @import url(https://fonts.googleapis.com/css?family=Roboto:300);

           
           img {
               width: 120px;
                height:inherit;
           }
           
           .form-signin-heading {
               color:#EF3B3A;
           }
        .login-page {
          width: 360px;
          padding: 8% 0 0;
          margin: auto;
        }
        .form {
          position: relative;
          z-index: 1;
          background: #FFFFFF;
          max-width: 360px;
          margin: 0 auto 100px;
          padding: 45px;
          text-align: center;
          box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
        }
        .form input {
          font-family: "Roboto", sans-serif;
          outline: 0;
          background: #f2f2f2;
          width: 100%;
          border: 0;
          margin: 0 0 15px;
          padding: 15px;
          box-sizing: border-box;
          font-size: 14px;
        }
        .form button {
          font-family: "Roboto", sans-serif;
          text-transform: uppercase;
          outline: 0;
          background: #4CAF50;
          width: 100%;
          border: 0;
          padding: 15px;
          color: #FFFFFF;
          font-size: 14px;
          -webkit-transition: all 0.3 ease;
          transition: all 0.3 ease;
          cursor: pointer;
        }
        .form button:hover,.form button:active,.form button:focus {
          background: #43A047;
        }
        .form .message {
          margin: 15px 0 0;
          color: #b3b3b3;
          font-size: 12px;
        }
        .form .message a {
          color: #4CAF50;
          text-decoration: none;
        }
        .form .register-form {
          display: none;
        }
        .container {
          position: relative;
          z-index: 1;
          max-width: 300px;
          margin: 0 auto;
        }
        .container:before, .container:after {
          content: "";
          display: block;
          clear: both;
        }
        .container .info {
          margin: 50px auto;
          text-align: center;
        }
        .container .info h1 {
          margin: 0 0 15px;
          padding: 0;
          font-size: 36px;
          font-weight: 300;
          color: #1a1a1a;
        }
        .container .info span {
          color: #4d4d4d;
          font-size: 12px;
        }
        .container .info span a {
          color: #000000;
          text-decoration: none;
        }
        body {
          background: #76b852; /* fallback for old browsers */
          background: -webkit-linear-gradient(right, #76b852, #8DC26F);
          background: -moz-linear-gradient(right, #76b852, #8DC26F);
          background: -o-linear-gradient(right, #76b852, #8DC26F);
          background: linear-gradient(to left, #76b852, #8DC26F);
          font-family: "Roboto", sans-serif;
          -webkit-font-smoothing: antialiased;
          -moz-osx-font-smoothing: grayscale;      
        }
       </style>
      
   </head>
	
   <body>
      <div class = "login-page">
          
          <?php
            include("../protected/config.php");
            $msg = '';
 
            $sql = "SELECT username, password FROM treeMapDB.admin WHERE username = '" . $_POST['username'] . "' and password = '" . $_POST['password'] . "'";
            $result = mysqli_query($db,$sql);
            $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
            
            if (isset($_POST['login']) && !empty($_POST["username"]) 
               && !empty($_POST["password"])) {
                
				
               if ( $_POST['username'] == $row['username'] && 
                  $_POST['password'] == $row['password']) {
                  $_SESSION['valid'] = true;
                  $_SESSION['timeout'] = time();
                  $_SESSION['username'] = $row['username'];
                   header('Location: main.php');
                  
                  echo 'You have entered valid username and password';
               }else {
                   $msg = 'You have entered an invalid username and password';
               }
            }
         ?>
       </div> <!-- /container -->
    <div class = "form">
      
         <form class = "login-form" role = "form" 
            action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); 
            ?>" method = "post">
             <img src="../photos/TeamLogo.png" alt="Team Logo">
             <h2>Admin Login</h2>
            <h4 class = "form-signin-heading"><?php echo $msg; ?></h4>
             <input type = "text" name = "username" placeholder="username" required autofocus <?php if (!empty($_POST['username'])) {echo "value='" . $_POST["username"] . "'";} ?>>
            <input type = "password" name = "password" placeholder="password" required <?php if (!empty($_POST['password'])) {echo "value='" . $_POST["password"] . "'";} ?>>
            <button type = "submit" 
               name = "login">Login </button>
         </form>
      </div> 
    </body>
</html>
