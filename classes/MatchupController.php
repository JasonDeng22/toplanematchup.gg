<?php

// Sources used: https://www.w3schools.com/php/php_form_url_email.asp
//               https://www.w3schools.com/php/php_form_validation.asp
//               https://stackoverflow.com/questions/13392842/using-php-regex-to-validate-username
//               https://www.php.net/manual/en/control-structures.goto.php  <- this is not good practice, but my code is structured terribly so whatever
//               https://stackoverflow.com/questions/20627245/redirect-to-the-same-page-after-log-out
//               https://stackoverflow.com/questions/8130990/how-to-redirect-to-the-same-page-in-php
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
            case "pageNotFound":
                $this->pageNotFound();
                break;
            case "championsList":
                $this->championsList();
                break;
            case "getChamps":
                $this->getChamps();
                break;
            case "championInfo":
                $this->championInfo();
                break;
            case "matchupPage":
                $this->matchupPage();
                break;
            case "forum":
                $this->forum();
                break;
            case "deleteComment":
                $this->deleteComment();
                break;
            case "likeComment":
                $this->likeComment();
                break;
            case "dislikeComment":
                $this->dislikeComment();
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
        $_SESSION['url'] = $_SERVER['REQUEST_URI'];
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

            if ($insert === false) {
                $error_msg = "Error inserting user";
            }

            # session_start();
            $_SESSION['name'] = $_POST['name'];   
            $_SESSION['email'] = $_POST['email'];
            if (isset($_SESSION["url"])){
                $url = $_SESSION['url'];
            }
            else{
                $url = "index.php";
            }
            header("Location:".$url);
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
                        if (isset($_SESSION["url"])){
                            $url = $_SESSION['url'];
                        }
                        else{
                            $url = "index.php";
                        }
                        header("Location:".$url);
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
        $_SESSION['url'] = $_SERVER['REQUEST_URI'];
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

    // we will call this function for AJAX query
    public function getChamps(){
        // $sorttype = $_GET["sorttype"];
        $champion = $this->db->query("SELECT * FROM project_champions");
        if ($champion === false){
            $error_msg = "Error getting champion";
        }
        if (empty($champion)){
            header("Location:?command=pageNotFound");
        }
        header("Content-type: application/json");
        echo json_encode($champion, JSON_PRETTY_PRINT);
    }

    private function championInfo(){
        $_SESSION['url'] = $_SERVER['REQUEST_URI'];
        # prepare all HTML elements given a specific champ name
        if (isset($_SESSION["email"]) && isset($_SESSION["name"])){
            $user = [
                "name" => $_SESSION["name"],
                "email" => $_SESSION["email"],
            ];}
        
        $champName = $_GET["champName"];

        # query to get all the champions for display
        $champion = $this->db->query("SELECT * FROM project_champions WHERE name=?","s",$champName);
        if ($champion === false){
            $error_msg = "Error getting champion";
        }

        # if this champion wasn't found, send it to 404
        if (empty($champion)){
            header("Location:?command=pageNotFound");
        }

        # query to get the 6 best matchups and 6 worst matchups given a champ1

        $bestMatchups = $this->db->query("SELECT * FROM project_matchups WHERE champ1 = ? ORDER BY winRate DESC LIMIT 8;","s",$champName);
        $worstMatchups = $this->db->query("SELECT * FROM project_matchups WHERE champ1 = ? ORDER BY winRate ASC LIMIT 8;","s",$champName);

        $description = $champion[0]["description"];
        $moniker = $champion[0]["moniker"];
        $wr = $champion[0]["winRate"];
        $pr = $champion[0]["pickRate"];
        include "templates/championInfo.php";
    }

    // TODO: display the comment system for matchup between two champs along with tips / stats / etc.
    private function matchupPage(){
        $champ1 = $_GET["champ1"];
        $champ2 = $_GET["champ2"];
        include "templates/matchupPage.php";
    }

    private function pageNotFound(){
        // $x = $this->db->query("SELECT moniker FROM project_champions");
        // echo "<pre>";
        // print_r($x);
        // echo "</pre>";
        // foreach ($x as $value){
        //     echo $value["moniker"]. " <br>";
        // }
        include "templates/pageNotFound.php";
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

    private function forum()
    {
        $_SESSION['url'] = $_SERVER['REQUEST_URI'];
        $allComments = $this->getAllComments();
        if (isset($_POST["comment"]) && !empty($_POST["comment"]) && !isset($_SESSION["email"]) && !isset($_SESSION["name"])) {
            header("Location: ?command=login");
        }
        $numComm = $this->getNumComments();
        if (isset($_SESSION["email"]) && isset($_SESSION["name"])) {
            $user = [
                "name" => $_SESSION["name"],
                "email" => $_SESSION["email"],
            ];
            $id = $this->db->query("select id from project_user where name=? and email=?;", "ss", $user["name"], $user["email"]);
            $_SESSION["id"] = $id;
        }

        if (isset($_POST["comment"]) && !empty($_POST["comment"]) && isset($_SESSION["email"]) && isset($_SESSION["name"])) {
            $comment = $_POST["comment"];
            $id = $this->db->query("select id from project_user where name=? and email=?;", "ss", $_SESSION["name"], $_SESSION["email"]);
            $_SESSION["id"] = $id;
            $insert = $this->db->query("insert into project_comments (userID, comment, createdOn) values (?, ?, NOW());", "is", $id[0]["id"], $comment);

            $numComm = $this->getNumComments();
            $allComments = $this->getAllComments();

            if (!isset($insert)) {
                echo "There was an issue with inserting the comment";
            }
        }

        include "templates/forum.php";
    }

    private function getNumComments()
    {
        $numComm = $this->db->query("select COUNT(id) from project_comments");
        return $numComm;
    }

    private function getAllComments()
    {
        $allComments = $this->db->query("SELECT userid, name, comment, createdOn, likes, dislikes FROM project_user INNER JOIN project_comments on project_comments.userID=project_user.id ORDER BY createdOn DESC LIMIT 10;");
        //SELECT * FROM project_user INNER JOIN project_comments on project_comments.userID=project_user.id ORDER BY createdOn DESC;
        $allCommentsJSON = $this->db->query("SELECT json_object('userID', userID, 'comment', comment, 'createdOn', createdOn)
                                             FROM project_comments;");
        if (!isset($allComments[0])) {
            $allComments = [];
        }

        return $allComments;

        include("templates/forum.php");
    }

    private function deleteComment()
    {
        $comment_to_delete = $_POST["comment_to_delete"];
        $date_to_delete = $_POST["date_to_delete"];
        $data = $this->db->query("SELECT * from project_comments where comment=? and createdOn=?;", "ss", $comment_to_delete, $date_to_delete);
        echo $_SESSION["id"][0]["id"];
        echo $data[0]["userID"];

        if ($_SESSION["id"][0]["id"] !== $data[0]["userID"]) {
            header("Location: ?command=forum");
        } else if ($_SESSION["id"][0]["id"] == $data[0]["userID"]) {
            $query = $this->db->query("DELETE FROM  project_comments WHERE comment=? AND createdOn=?", "ss", $comment_to_delete, $date_to_delete);
            header("Location: ?command=forum");
        }

        include("templates/forum.php");
    }

    private function likeComment()
    {
        if (empty($_SESSION)) {
            header("Location: ?command=login");
        }
        $comment_to_like = $_POST["comment_to_like"];
        $date_to_like = $_POST["date_to_like"];
        $userid = $_SESSION["id"][0]["id"];
        $query = $this->db->query("SELECT id FROM project_comments WHERE comment=? AND createdOn=?;", "ss", $comment_to_like, $date_to_like);
        $commentid = $query[0]["id"];

        $check = $this->db->query("SELECT like_comment, dislike_comment FROM project_likes_dislikes WHERE userid=? AND commentid=?", "ii", $userid, $commentid);
        if (empty($check)) {
            $likes = $this->db->query("SELECT likes FROM project_comments WHERE id=?;", "i", $commentid);
            $current_likes = $likes[0]["likes"];
            $insert = $this->db->query("INSERT INTO project_likes_dislikes (userid, commentid, like_comment, dislike_comment) VALUES (?, ?, ?, ?);", "iiii", $userid, $commentid, 1, 0);
            $updated_likes = $current_likes + 1;
            $update = $this->db->query("UPDATE project_comments SET likes=? WHERE id=?;", "ii", $updated_likes, $commentid);
            header("Location: ?command=forum");
        } else if ($check[0]["like_comment"] == 1 && $check[0]["dislike_comment"] == 0) {
            $likes = $this->db->query("SELECT likes FROM project_comments WHERE id=?;", "i", $commentid);
            $current_likes = $likes[0]["likes"];
            $remove = $this->db->query("DELETE FROM project_likes_dislikes WHERE userid=? and commentid=?;", "ii", $userid, $commentid);
            $updated_likes = $current_likes - 1;
            $update = $this->db->query("UPDATE project_comments SET likes=? WHERE id=?;", "ii", $updated_likes, $commentid);
            header("Location: ?command=forum");
        } else if ($check[0]["like_comment"] == 0 && $check[0]["dislike_comment"] == 1) {
            $dislikes = $this->db->query("SELECT dislikes FROM project_comments WHERE id=?;", "i", $commentid);
            $current_dislikes = $dislikes[0]["dislikes"];
            $remove = $this->db->query("DELETE FROM project_likes_dislikes WHERE userid=? and commentid=?;", "ii", $userid, $commentid);
            $updated_dislikes = $current_dislikes + 1;
            $update = $this->db->query("UPDATE project_comments SET dislikes=? WHERE id=?;", "ii", $updated_dislikes, $commentid);
            $likes = $this->db->query("SELECT likes FROM project_comments WHERE id=?;", "i", $commentid);
            $current_likes = $likes[0]["likes"];
            $insert = $this->db->query("INSERT INTO project_likes_dislikes (userid, commentid, like_comment, dislike_comment) VALUES (?, ?, ?, ?);", "iiii", $userid, $commentid, 1, 0);
            $updated_likes = $current_likes + 1;
            $update = $this->db->query("UPDATE project_comments SET likes=? WHERE id=?;", "ii", $updated_likes, $commentid);
            header("Location: ?command=forum");
        } else {
            exit("SOMETHING WENT WRONG WITH LIKE");
        }
    }

    private function dislikeComment()
    {
        if (empty($_SESSION)) {
            header("Location: ?command=login");
        }
        $comment_to_dislike = $_POST["comment_to_dislike"];
        $date_to_dislike = $_POST["date_to_dislike"];
        $userid = $_SESSION["id"][0]["id"];
        $query = $this->db->query("SELECT id FROM project_comments WHERE comment=? AND createdOn=?;", "ss", $comment_to_dislike, $date_to_dislike);
        $commentid = $query[0]["id"];

        $check = $this->db->query("SELECT like_comment, dislike_comment FROM project_likes_dislikes WHERE userid=? AND commentid=?", "ii", $userid, $commentid);
        if (empty($check)) {
            $dislikes = $this->db->query("SELECT dislikes FROM project_comments WHERE id=?;", "i", $commentid);
            $current_dislikes= $dislikes[0]["dislikes"];
            $insert = $this->db->query("INSERT INTO project_likes_dislikes (userid, commentid, like_comment, dislike_comment) VALUES (?, ?, ?, ?);", "iiii", $userid, $commentid, 0, 1);
            $updated_dislikes = $current_dislikes - 1;
            $update = $this->db->query("UPDATE project_comments SET dislikes=? WHERE id=?;", "ii", $updated_dislikes, $commentid);
            header("Location: ?command=forum");
        } else if  ($check[0]["like_comment"] == 0 && $check[0]["dislike_comment"] == 1) {
            $dislikes = $this->db->query("SELECT dislikes FROM project_comments WHERE id=?;", "i", $commentid);
            $current_dislikes = $dislikes[0]["dislikes"];
            $remove = $this->db->query("DELETE FROM project_likes_dislikes WHERE userid=? and commentid=?;", "ii", $userid, $commentid);
            $updated_dislikes = $current_dislikes + 1;
            $update = $this->db->query("UPDATE project_comments SET dislikes=? WHERE id=?;", "ii", $updated_dislikes, $commentid);
            header("Location: ?command=forum");
        } else if ($check[0]["like_comment"] == 1 && $check[0]["dislike_comment"] == 0) {
            $likes = $this->db->query("SELECT likes FROM project_comments WHERE id=?;", "i", $commentid);
            $current_likes = $likes[0]["likes"];
            $remove = $this->db->query("DELETE FROM project_likes_dislikes WHERE userid=? and commentid=?;", "ii", $userid, $commentid);
            $updated_likes = $current_likes - 1;
            $update = $this->db->query("UPDATE project_comments SET likes=? WHERE id=?;", "ii", $updated_likes, $commentid);
            $dislikes = $this->db->query("SELECT dislikes FROM project_comments WHERE id=?;", "i", $commentid);
            $current_dislikes= $dislikes[0]["dislikes"];
            $insert = $this->db->query("INSERT INTO project_likes_dislikes (userid, commentid, like_comment, dislike_comment) VALUES (?, ?, ?, ?);", "iiii", $userid, $commentid, 0, 1);
            $updated_dislikes = $current_dislikes - 1;
            $update = $this->db->query("UPDATE project_comments SET dislikes=? WHERE id=?;", "ii", $updated_dislikes, $commentid);
            header("Location: ?command=forum");
        } else {
            print_r($check);
            exit("SOMETHING WENT WRONG WITH DISLIKE");
        }
    }
}
