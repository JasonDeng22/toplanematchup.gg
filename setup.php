<?php

spl_autoload_register(function($classname) {
    include "classes/$classname.php";
});


$db = new Database();

/* User should have: 
    1) name
    2) email
    3) password
    4)
*/
#$db->query("DROP TABLE IF EXISTS project_user;");
$db->query("CREATE TABLE project_user (
                id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                email TEXT NOT NULL,
                name TEXT NOT NULL,
                password TEXT NOT NULL
        );");


/* Champions should have:
    1) Name
    2) Splash Art Img Src / Directory
    3) Icon Art Img Src / Directory
    4) Description
    5) Game Moniker
    ----- to be implemented (either use web scraping or figure out Riot Games API...)
    6) Win Rate
    7) Pick Rate
 
*/
#$db->query("DROP TABLE IF EXISTS project_champions;");
$db->query("CREATE TABLE project_champions (
                id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                name TEXT NOT NULL,
                splashDir TEXT NOT NULL,
                iconDir TEXT NOT NULL,
                description TEXT NOT NULL,
                moniker TEXT NOT NULL
            );");

# insert all the champions into the project_champions database

$lorem = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut 
labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi 
ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum
 dolore eu fugiat nulla pariatur.";

# Aatrox
$insert = $db->query("INSERT INTO project_champions (name, splashDIr, iconDir,description,moniker) 
            values (?, ?, ?, ?, ?);", 
             "sssss", "Aatrox","Aatrox.jpg","AatroxIcon.png","Aatrox is an AD bruiser that deals AoE 
             damage with his abilities and drain tanks off of built in omnivamp. Champions that Aatrox 
             beat are usually immobile melee or ranged champions, who are unable to avoid his E-Q combo.
              Champions that beat Aatrox are ones that can easily dodge this E-Q combo, which severly 
              reduces Aatrox's healing and damage.","The Darkin Blade");

# Camille
$insert = $db->query("INSERT INTO project_champions (name, splashDIr, iconDir,description,moniker) 
            values (?, ?, ?, ?, ?);", 
             "sssss", "Camille","Camille.jpg","CamilleIcon.png",$lorem,"The Steel Shadow");
# Darius
$insert = $db->query("INSERT INTO project_champions (name, splashDIr, iconDir,description,moniker) 
            values (?, ?, ?, ?, ?);", 
             "sssss", "Darius","Darius.jpg","DariusIcon.png",$lorem,"The Hand of Noxus");
# Fiora
$insert = $db->query("INSERT INTO project_champions (name, splashDIr, iconDir,description,moniker) 
            values (?, ?, ?, ?, ?);", 
             "sssss", "Fiora","Fiora.jpg","FioraIcon.png",$lorem,"The Grand Duelist");
# Gangplank
$insert = $db->query("INSERT INTO project_champions (name, splashDIr, iconDir,description,moniker) 
            values (?, ?, ?, ?, ?);", 
             "sssss", "Gangplank","Gangplank.jpg","GangplankIcon.png",$lorem,"The Saltwater Scourge");
# Irelia
$insert = $db->query("INSERT INTO project_champions (name, splashDIr, iconDir,description,moniker) 
            values (?, ?, ?, ?, ?);", 
             "sssss", "Irelia","Irelia.jpg","IreliaIcon.png",$lorem,"The Blade Dancer");
# Jax
$insert = $db->query("INSERT INTO project_champions (name, splashDIr, iconDir,description,moniker) 
            values (?, ?, ?, ?, ?);", 
             "sssss", "Jax","Jax.jpg","JaxIcon.png",$lorem,"Grandmaster at Arms");
# Jayce
$insert = $db->query("INSERT INTO project_champions (name, splashDIr, iconDir,description,moniker) 
            values (?, ?, ?, ?, ?);", 
             "sssss", "Jayce","Jayce.jpg","JayceIcon.png",$lorem,"The Defender of Tomorrow");
# Renekton
$insert = $db->query("INSERT INTO project_champions (name, splashDIr, iconDir,description,moniker) 
            values (?, ?, ?, ?, ?);", 
             "sssss", "Renekton","Renekton.jpg","RenektonIcon.png",$lorem,"The Butcher of the Sands");
# Riven
$insert = $db->query("INSERT INTO project_champions (name, splashDIr, iconDir,description,moniker) 
            values (?, ?, ?, ?, ?);", 
             "sssss", "Riven","Riven.jpg","RivenIcon.png",$lorem,"The Exile");
# Sett
$insert = $db->query("INSERT INTO project_champions (name, splashDIr, iconDir,description,moniker) 
            values (?, ?, ?, ?, ?);", 
             "sssss", "Sett","Sett.jpg","SettIcon.png",$lorem,"The Boss");
# Tryndamere
$insert = $db->query("INSERT INTO project_champions (name, splashDIr, iconDir,description,moniker) 
            values (?, ?, ?, ?, ?);", 
             "sssss", "Tryndamere","Tryndamere.jpg","TryndamereIcon.png",$lorem,"The Barbarian King");
