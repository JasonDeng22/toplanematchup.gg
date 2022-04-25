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
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        <script type="text/javascript" src="./scripts/credentialValidate.js"></script>
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
                <form action="?command=login" method="POST" onsubmit="validate();" class="margin-t">
                    <div class="form-group">
                        <input type="email" class="form-control" id="email" placeholder="Email Address" name="email" >
                        <div id="emhelp" style="color: white" class="form-text"></div>
                    </div>
                    <br>
                    <div class="form-group">
                        <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                        <div id="pwhelp" style="color: white" class="form-text"></div>
                    </div>
                    <br>
                    <button id="submit" type="submit" class="form-button button-l margin-b">Sign In</button>
    
            
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
        <!-- <script
        src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"
        ></script> -->
        <script
        src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"
        ></script>
        <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"
        ></script>
        <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ"
        crossorigin="anonymous"
        ></script>
</body>
</html>