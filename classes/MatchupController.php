<?php

// Sources used: https://www.w3schools.com/php/php_form_url_email.asp
//               https://www.w3schools.com/php/php_form_validation.asp
//               https://stackoverflow.com/questions/13392842/using-php-regex-to-validate-username
//               https://www.php.net/manual/en/control-structures.goto.php  <- this is not good practice, but my code is structured terribly so whatever
//               https://stackoverflow.com/questions/20627245/redirect-to-the-same-page-after-log-out

class MatchupController {
    private $command;
    private $db;

    public function __construct($command) {
        $this->command = $command;
        $this->db = new Database();
    }
    public function run() {
        switch($this->command) {
            case "logout":
                $this->destroySession();
                $this->home();
                break;
            case "championsList":
                $this->championsList();
                break;
            case "championInfo":
                $this->championInfo();
                break;
            case "signup":
                $this->signup();
                break;
            case "login":
                $this->login();
                break;
            case "home":
            default:
                $this->home();
                break;
        }
    }

    private function home(){

        if (isset($_SESSION["email"]) && isset($_SESSION["name"])){
            $user = [
                "name" => $_SESSION["name"],
                "email" => $_SESSION["email"],
            ];
        }
        include "templates/home.php";
    }

    // Create a new user account. Validate email, name, and password
    private function signup(){
        // check if everything was filled out
        if (isset($_POST["email"]) && !empty($_POST["email"]) && isset($_POST["name"]) && !empty($_POST["name"])
        && isset($_POST["password"]) && !empty($_POST["password"])){

            // check if email already exists
            $data = $this->db->query("SELECT * FROM project_user WHERE email = ? ", "s", $_POST["email"]);
            if ($data === false) {
                $error_msg = "Error checking for user";
            } else if (!empty($data)) { // if something got returned and is not empty
                $error_msg = "Email / username already exists";
                goto end;
            }

            // check if username already exists
            $data = $this->db->query("SELECT * FROM project_user WHERE name = ? ", "s", $_POST["name"]);
            if ($data === false) {
                $error_msg = "Error checking for user";
            } else if (!empty($data)) { // if something got returned and is not empty
                $error_msg = "Email / username already exists";
                goto end;
            }

            // email validation
            $email = $_POST["email"];
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error_msg = "Invalid email format";
                goto end;
            }
            // name validation: starts with letter. Allows numbers, letters, spaces. 1-25 characters
            $name = $_POST["name"];
            $name_regex = "/^[A-Za-z][A-Za-z0-9 ]{1,20}$/";
            if (!preg_match($name_regex,$name)) {
                $error_msg = "Username: Only letters,numbers, white space allowed. Limit 25 characters.";
                goto end;
            }
            
            // password length at least 8, contains letters and numbers
            $password_regex = "/^[A-Za-z0-9 ]{8,100}$/";

            if (strlen($_POST["password"]) < 8){
                $error_msg = "Password should be at least 8 characters.";
                goto end;
            } 
            else if (!preg_match($password_regex,$_POST["password"])) {
                $error_msg = "Password: Only letters,numbers, white space allowed.";
                goto end;
            }

            // Every input should be good, so now add this user into the database start their session
            $insert = $this->db->query("insert into project_user (name, email, password) values (?, ?, ?);", 
            "sss", $name,$email, password_hash($_POST["password"], PASSWORD_DEFAULT));
            # session_start();
            $_SESSION['name'] = $_POST['name'];   
            $_SESSION['email'] = $_POST['email'];
            header("Location: ?command=home");

            if ($insert === false) {
                $error_msg = "Error inserting user";
            }
        }
        end:
        include "templates/signup.php";
    }
    // Display the login page (and handle login logic). Track user session here if login is successful
    private function login() {

        // making sure fields are filled out
        if (isset($_POST["email"]) && !empty($_POST["email"])) {
            $data = $this->db->query("SELECT * FROM project_user WHERE email = ?", "s", $_POST["email"]);
            if ($data === false) {
                $error_msg = "Error checking for user";
            }
    
        // Check inputted password and email. If it's correct, start session and log in
            else if (!empty($data)) {
                if (empty($_POST["password"]) or !isset($_POST["password"])){
                    $error_msg = "Enter in all credentials";
                }
                else{
                    if ($_POST["email"] == $data[0]["email"] && password_verify($_POST["password"], $data[0]["password"])){
                        #session_start();
                        $_SESSION['name'] = $data[0]["name"];  
                        $_SESSION['email'] = $_POST['email'];
                        header("Location: ?command=home");
                    } else {
                        $error_msg = "Wrong credentials";
                    }
                }
            }

            else{
                $error_msg = "Wrong credentials";
            }
        }
        include "templates/login.php";
    }    

    private function championsList() {

        # query to get all the champions for display
        $champions = $this->db->query("SELECT * FROM project_champions");
        if (isset($_SESSION["email"]) && isset($_SESSION["name"])){
            $user = [
                "name" => $_SESSION["name"],
                "email" => $_SESSION["email"],
            ];
        }
        if ($champions === false){
            $error_msg = "Error getting list of champions";
        }

        if (isset($_POST["champSelected"])){
            $user["champSelected"] = $_POST["champSelected"];
            header("Location: ?command=champions");
        }
        include "templates/championsList.php";
    }

    private function championInfo(){
        print_r($_SESSION);
        include "templates/championInfo.php";
    }
    // unset session variables then destroy (doesn't work otherwise...)
    // redirect user to same page instead of default home page using $_SERVER and HTTP_REFERER
    private function destroySession() {   
        unset($_SESSION['email']);
        unset($_SESSION['name']);       
        session_destroy();
        session_start();
        if(isset($_SERVER['HTTP_REFERER'])) {
            header('Location: '.$_SERVER['HTTP_REFERER']);  
        } else {
            header('Location: index.php');  
        }
    }
}

/* I am trying to make it so that when a user successfully logs in, start a session and assign the appropriate
session values. However, it doesn't seem to persist if I only call it in the login function(). I will resort to
calling session_start() every time index.php is started, and then only assign session variables in login. Thus, instead
of checking if a current session has been started, check if the session variable "email" has been set. This way, we
can check if a user is logged in. However, I don't think it's a good idea to start sessions for every user even if they
are logged in, since I only want to track sessions for logged in users in order to track their comments.


Check with Professor at OH:

1) Session handling (see above)
2) Web scraping allowed?
3) Updating win rate and pick rate, database insert issue
4) How to display champion page given one command: ?command=champion. See below for more information
5) JavaScript vs. PHP: I want to be able to add sorting in championsList and also have options to change the
   view of the list of champions (grid vs table). I'm assuming PHP and JavaScript can do both, which one should
   I do / focus on? Which one is better?



For 4), I want to be able to have a single php file called champions.php where I load in the champion
information from the database with SELECT and then display that information in the champion page. 
*/