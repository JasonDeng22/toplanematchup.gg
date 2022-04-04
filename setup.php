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
# $db->query("DROP TABLE IF EXISTS project_user;");
// $db->query("CREATE TABLE project_user (
//                 id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
//                 email TEXT NOT NULL,
//                 name TEXT NOT NULL,
//                 password TEXT NOT NULL
//         );");


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
$db->query("DROP TABLE IF EXISTS project_champions;");
$db->query("CREATE TABLE project_champions (
                id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                name TEXT NOT NULL,
                splashDir TEXT NOT NULL,
                iconDir TEXT NOT NULL,
                description TEXT NOT NULL,
                moniker TEXT NOT NULL,
                winRate DECIMAL(4,2),
                pickRate DECIMAL(4,2)
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



/* ------------------------ Web Scraping For Win Rates, Pick Rates, and Counters ------------------- */
/* Source: https://www.freecodecamp.org/news/web-scraping-with-php-crawl-web-pages/ */

# scraping https://na.op.gg/champions (defaults to top champions)
require 'vendor/autoload.php'; 
$httpClient = new \GuzzleHttp\Client();
$response = $httpClient->get('https://na.op.gg/champions');
$htmlString = (string) $response->getBody();
# add this line to suppress any warnings
libxml_use_internal_errors(true);
$doc = new DOMDocument();
$doc->loadHTML($htmlString);
$xpath = new DOMXPath($doc);

# GET CHAMPION NAMES
$champNames = $xpath->evaluate('//table[@class="positionRank css-7jqjyk e991xk4"]//tbody//tr//td[@class="css-gd6nza e991xk9"]//a//span/strong');
$extractedChampNames = [];
foreach ($champNames as $champName){
    $extractedChampNames[] = $champName->textContent.PHP_EOL;
}
#print_r($extractedChampNames);

# GET CHAMPION WIN RATES and PICK RATES
$champWR_PR = $xpath->evaluate('//tbody//tr/td[@class="css-18lbye0 e1dfp5w11"]');
$extractedChampWR_PR = [];
foreach ($champWR_PR as $WR_PR){
    $extractedChampWR_PR[] = $WR_PR->textContent.PHP_EOL;
}
#print_r($extractedChampWR_PR);

# We have the Win Rates and Pick Rates associated with each champ. Update the database
$i = 0;
foreach ($extractedChampNames as $key=>$value){
    $name = $value;
    echo $name;
    $wr = $extractedChampWR_PR[$i++];
    $pr = $extractedChampWR_PR[$i++];
    echo $wr . $pr;
    echo gettype($name).gettype($wr).gettype($pr); #all inputs are strings
    #$db->query("UPDATE project_champions SET winRate='$wr',pickRate='$pr' WHERE name='$name'");
    $db->query("UPDATE project_champions SET winRate=?, pickRate=? WHERE name=?","dds",$wr,$pr,$name);
}
