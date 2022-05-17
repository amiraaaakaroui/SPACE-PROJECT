<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="sign.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css"  />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
    <title>Document</title>
</head>
<body>
    <div class="container" id="container">
        <div class="form-container sign-up-container">


            <form action="" method="post" >
                <h1>Create Account</h1>
                <div class="social-container">
                    <a href="https://www.facebook.com/" class="social"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                    <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <span>or use your email for registration</span>

                <input type="text" placeholder="Name" name="name"/>
                <input type="email" placeholder="Email" name="email" />
                <input type="password" placeholder="Password" name="password"/>
                <input type="submit" name="submit" value="Sign Up"  />

            </form>
        </div>




        <div class="form-container sign-in-container">



            <form action="" method="post" >
                <h1>Sign in</h1>
                <div class="social-container">
                    <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                    <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <span>or use your account</span>
                <input type="email" placeholder="Email" name="email" />
                <input type="password" placeholder="Password" name="password" />
                <a href="#">Forgot your password?</a>
                <input type="submit" name="submit" value="Sign In"  />
                <button>Sign In</button>
            </form>
        </div>


        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Welcome Back!</h1>
                    <p>To keep connected with us please login with your personal info</p>
                    <button class="ghost" id="signIn">Sign In</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Hello, Friend!</h1>
                    <p>Enter your personal details and start journey with us</p>
                    <button class="ghost" id="signUp">Sign Up</button>
                </div>
            </div>
        </div>
    </div>
    
   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"></script>
    <script>
        const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');

signUpButton.addEventListener('click', () => {
	container.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
	container.classList.remove("right-panel-active");
});
    </script>





<?php
require('config.php');
if (isset($_REQUEST['name'], $_REQUEST['email'], $_REQUEST['password'])){
  // récupérer le nom d'utilisateur 
  $name = stripslashes($_REQUEST['name']);
  $name = mysqli_real_escape_string($conn, $name); 
  // récupérer l'email 
  $email = stripslashes($_REQUEST['email']);
  $email = mysqli_real_escape_string($conn, $email);
  // récupérer le mot de passe 
  $password = stripslashes($_REQUEST['password']);
  $password = mysqli_real_escape_string($conn, $password);
  
  $query = "INSERT into `users` (name, email , type, password)
        VALUES ('$name', '$email', 'user', '".hash('sha256', $password)."')";
  $res = mysqli_query($conn, $query);
    if($res){
       echo "<div class='sucess'>
             <h3>Vous êtes inscrit avec succès.</h3>
             <p>Cliquez ici pour vous <a href='login.php'>connecter</a></p>
       </div>";
    }
}else{

    if (isset($_POST['name'])){
        $name = stripslashes($_REQUEST['name']);
        $name = mysqli_real_escape_string($conn, $name);
        $_SESSION['name'] = $name;
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($conn, $password);
          $query = "SELECT * FROM `users` WHERE name='$name' 
        and password='".hash('sha256', $password)."'";
        
        $result = mysqli_query($conn,$query) or die(mysql_error());
        
        if (mysqli_num_rows($result) == 1) {
          $user = mysqli_fetch_assoc($result);
          // vérifier si l'utilisateur est un administrateur ou un utilisateur
          if ($user['type'] == 'admin') {
            header('location: admin/home.php');      
          }else{
            header('location: index.php');
          }
        }else{
          $message = "Le nom d'utilisateur ou le mot de passe est incorrect.";
        }
      }
      







}
?>

</body>
</html>