<html>

<head>
    <style>
        .error {
            color:red;
        }
    </style>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>Login Screen</title>
    </head>
<body>
    <?php 
    $name=$nameError=$surname=$surnameError=$email=$emailError=$password=$passwordError=$password2=$passwordError2=$email2=$emailError2 = "";
    
    if ($_SERVER["REQUEST_METHOD"]=="POST"){
        
        
            $choise = $_POST['getin'];
        if ($choise == "register"){
            
            if(empty($_POST["name"])){
                $nameError=" Name is required";
            } else {
                $name = test_input($_POST["name"]);
            }

            if(empty($_POST["surname"])){
                $surnameError=" Surname is required";
            } else {
                $surname = test_input($_POST["surname"]);
            }

            if(empty($_POST["email"])){
                $emailError=" E-mail is required";
            } else {
                $email = test_input($_POST["email"]);
            }

            if(empty($_POST["password"])){
                $passwordError=" Password is required";
            } else {
                $password = test_input($_POST["password"]);
            }
        }
        
        else {
            if(empty($_POST["email2"])){
                $emailError2=" E-mail is required";
            } else {
                $email2 = test_input($_POST["email2"]);
            }

            if(empty($_POST["password2"])){
                $passwordError2=" Password is required";
            } else {
                $password2 = test_input($_POST["password2"]);
            }
        }
        
    }
     
    function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="form-group">
                    <label fosr="name">Name:</label>
                    <input type="text" class="form-control" name="name"><span class="error">*<?php echo $nameError ?></span>
                    </div>
                    
                    <div class="form-group">
                    <label for="surname">Surname:</label>
                    <input type="text" class="form-control" name="surname"><span class="error">*<?php echo $surnameError ?></span>
                    </div>
                    
                    <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" name="email"><span class="error">*<?php echo $emailError ?></span>
                    </div>
                    
                    <div class="form-group">
                    <label for="pswd">Password:</label>
                    <input type="password" class="form-control" placeholder="Şifre belirleyiniz" name="password"><span class="error">*<?php echo $passwordError ?></span>
                    </div>
                    
                    <div class="form-group">
                    <button type="submit" class="form-control" name="getin" value="register">Register!</button>
                    </div>
                
                </form>
            </div>
            <div class="col-md-4">
                <img src="Resim.jpg" class="img-fluid">
            </div>
            <div class="col-md-4">
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" name="email2"><span class="error">*<?php echo $emailError2 ?></span>
                    </div>
                    
                    <div class="form-group">
                    <label for="pswd">Password:</label>
                    <input type="password" class="form-control" name="password2"><span class="error">*<?php echo $passwordError2 ?></span>
                    </div>
                    
                    <div class="form-group">
                    <button class="form-control" placeholder="Login" type="submit" class="form-control" name="getin" value="login">LOGIN</button>
                    </div>
                
                </form>
            </div>
        </div>
    </div>
    
    
    </body>
</html>