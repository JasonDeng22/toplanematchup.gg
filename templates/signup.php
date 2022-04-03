<!DOCTYPE html>

<!-- The template for the signup page was taken from this bootstrap login form provider:
* https://freefrontend.com/bootstrap-login-forms/
* https://codepen.io/AlexXxCornejo/pen/mjMNPQ
-->

<html>
    <head>
        <meta charset="UTF-8">  
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Jason Deng">
        <meta name="description" content="Login Page for TopMatchups">  
        <title>User Signup</title>
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
                    <h3 class="text-whitesmoke">Register an account</h3>
                    <p class="text-whitesmoke">Fill out every field.</p>
                <div class="container-content">
                    <form action="?command=signup" method ="POST" class="margin-t">
                        <div class="form-group">
                            <input type="email" class="form-control" id="email" placeholder="Email Address" name="email" >
                            <div class="invalid-feedback">A valid email is required!</div>
                        </div>
                        <br>
                        <div class="form-group">
                            <input type="text" class="form-control" id="username" placeholder="Username" name="name" >
                            <div class="invalid-feedback">A valid username is required!</div>
                        </div>
                        <br>
                        <div class="form-group">
                            <input type="password" name="password" id="email" class="form-control" placeholder="Password" >
                            <div class="invalid-feedback">Please fill out your password!</div>
                        </div>
                        <br>
                        <button type="submit" class="form-button button-l margin-b">Sign Up</button>
                    </form>
                    <p class="text-whitesmoke text-center"><small>Already have an account?</small></p>
                    <a class="text-darkyellow" href="?command=login"><small>Sign In</small></a>
                    <p class="margin-t text-whitesmoke"><small> TopMatchups.gg &copy; 2022</small> </p>
                </div>
            </div>
            <br><br><br>

        <?php 
            #include "footer.php";
        ?>
</body>
</html>