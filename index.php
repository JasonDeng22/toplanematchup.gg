<?php
// Register the autoloader
// load in any classes we have inside the classes folder

/** SOURCES USED:
 *  https://www.php.net/manual/en/function.strpos.php
 *  https://www.php.net/manual/en/function.in-array.php
 *  https://cs4640.cs.virginia.edu/lectures/pdf/14-PHP-Files.pdf
 *  https://cs4640.cs.virginia.edu/lectures/pdf/15-PHP-Sessions-OOP.pdf
 *  https://cs4640.cs.virginia.edu/lectures/pdf/16-PHP-Sessions-Databases.pdf
 *  https://www.w3schools.com/php/php_sessions.asp
 *  https://www.php.net/manual/en/function.substr.php
 */
spl_autoload_register(function($classname) {
    include "classes/$classname.php";
});

// Parse the query string for command
// if the user has passed in a command for us in the URL, use that
$command = "home"; // otherwise, we default to home
if (isset($_GET["command"]))
    $command = $_GET["command"];

session_start();

//Instantiate the controller and run
$matchup = new MatchupController($command);
$matchup->run();