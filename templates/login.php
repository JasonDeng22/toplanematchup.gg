<!DOCTYPE html>

<!-- The template for the login page was taken from this bootstrap login form provider:
* https://freefrontend.com/bootstrap-login-forms/
* https://mdbootstrap.com/docs/standard/extended/login/#!
* https://codepen.io/AlexXxCornejo/pen/mjMNPQ
-->

<html>
    <head>
        <meta charset="UTF-8">  
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Jason Deng">
        <meta name="description" content="Login Page for TopMatchups">  
        <title>User Login</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous"> 
        <link rel="stylesheet" type="text/css" href="./styles/login_signup.css" />
    </head>
    <body class="main-bg">
        <?php
            #include "navbar.php";
        ?>
        <div class="login-container text-c animated flipInX">
            <?php
                if (!empty($error_msg)) {
                    echo "<div class='alert alert-danger'>$error_msg</div>";
                }
            ?>
            <div>
                <h1 class="logo-badge text-whitesmoke"><span class="fa fa-user-circle"></span></h1>
            </div>
                <h3 class="text-whitesmoke">Sign In</h3>
                <p class="text-whitesmoke">Fill out every field.</p>
            <div class="container-content">
                <form  action="?command=login" method ="POST" class="margin-t">
                    <div class="form-group">
                        <input type="email" class="form-control" id="email" placeholder="Email Address" name="email" required>
                        <div class="invalid-feedback">A valid email is required!</div>
                    </div>
                    <br>
                    <div class="form-group">
                        <input type="password" name="password" id="email" class="form-control" placeholder="Password" required>
                        <div class="invalid-feedback">Please fill out your password!</div>
                    </div>
                    <br>
                    <button type="submit" class="form-button button-l margin-b">Sign In</button>
    
            
                </form>
                <a class="text-darkyellow" href="#"><small>Forgot your password?</small></a><br><br>
                <p class="text-whitesmoke text-center"><small>Do not have an account?</small></p>
                <a class="text-darkyellow" href="?command=signup"><small>Sign Up</small></a>
                <p class="margin-t text-whitesmoke"><small> TopMatchups.gg &copy; 2022</small> </p>
            </div>
        </div>

        <?php 
            #include "footer.php";
        ?>
</body>
</html>