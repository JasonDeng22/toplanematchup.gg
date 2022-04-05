<?php

spl_autoload_register(function($classname) {
    include "classes/$classname.php";
});

/* User should have: 
   1) name
   2) email
   3) password
*/
function createNewUserTable(){
    $db = new Database();
    $db->query("DROP TABLE IF EXISTS project_user;");
    $db->query("CREATE TABLE project_user (
                    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                    email TEXT NOT NULL,
                    name TEXT NOT NULL,
                    password TEXT NOT NULL
            );");
}

/* Champions should have:
   1) Name
   2) Description
   3) Game Moniker
   4) Win Rate
   5) Pick Rate
*/
function createNewChampionsTable(){
    $db = new Database();
    $db->query("DROP TABLE IF EXISTS project_champions;");
    $db->query("CREATE TABLE project_champions (
                    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                    name TEXT NOT NULL,
                    description TEXT NOT NULL,
                    moniker TEXT NOT NULL,
                    winRate DECIMAL(4,2),
                    pickRate DECIMAL(4,2)
                );");
}


# insert all the champions into the project_champions database
function insertChampions(){

    $lorem = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut 
    labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi 
    ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum
    dolore eu fugiat nulla pariatur.";

    $champions = ['Aatrox',
                'Camille',
                'Darius',
                'Fiora',
                'Gangplank',
                'Irelia',
                'Jax',
                'Jayce',
                'Renekton',
                'Riven',
                'Sett',
                'Tryndamere'
                ];

    $monikers = ['The Darkin Blade',
                'The Steel Shadow',
                'The Hand of Noxus',
                'The Grand Duelist',
                'The Saltwater Scourge',
                'The Blade Dancer',
                'Grandmaster at Arms',
                'The Defender of Tomorrow',
                'The Butcher of the Sands',
                'The Exile',
                'The Boss',
                'The Barbarian King'
                ];

    # not sure if we should store this inside this file or just use an external text file. For now,
    # all champion descriptions are lorem, except aatrox because I already wrote aatrox

    $descriptions = ["Aatrox is an AD bruiser that deals AoE 
    damage with his abilities and drain tanks off of built in omnivamp. Champions that Aatrox 
    beat are usually immobile melee or ranged champions, who are unable to avoid his E-Q combo.
    Champions that beat Aatrox are ones that can easily dodge this E-Q combo, which severly 
    reduces Aatrox's healing and damage."];

    $db = new Database();
    # add all the champions in
    for ($i=0; $i < count($champions); $i++){
        $db->query("INSERT INTO project_champions (name,description,moniker) 
                values (?, ?, ?);", "sss",$champions[$i] ,$lorem, $monikers[$i]);
    }

    # do this in the for loop eventually
    $db->query("UPDATE project_champions SET description=? WHERE name='Aatrox'","s",$descriptions[0]);
}


/* ------------------------ Web Scraping For Win Rates, Pick Rates, and Counters ------------------- */
/* Source: https://www.freecodecamp.org/news/web-scraping-with-php-crawl-web-pages/ */

function get_and_insert_Name_WR_PR(){
    $db = new Database();
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
    # We need to remove the last 3 characters from each scraped value, since it has some extra characters
    $i = 0;
    foreach ($extractedChampNames as $key=>$value){
        $name = substr($value,0,-2);
        #echo $name;
        $wr = substr($extractedChampWR_PR[$i++],0,-4);
        $pr = substr($extractedChampWR_PR[$i++],0,-4);
        #echo $wr.$pr ;
        #echo gettype($name).gettype($wr).gettype($pr); #all inputs are strings
        $db->query("UPDATE project_champions SET winRate=?, pickRate=? WHERE name=?","dds",$wr,$pr,$name);
    }
}

function get_and_insert_Counters(){
    $db = new Database();
    $champs = $db->query("SELECT name FROM project_champions");
    # create a table that holds all matchup information. It is structured as champ1 vs champ2,
    # so if win rate = 45%, it means champ1 has a 45% win rate versus champ 2. 

    /* the values are:
        1) id (primary key)
        2) champ1 
        3) champ2
        4) win rate
        5) gold difference
    */
    $db->query("DROP TABLE IF EXISTS project_matchups");
    $db->query("CREATE TABLE project_matchups (
        id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        champ1 TEXT NOT NULL,
        champ2 TEXT NOT NULL,
        winRate DECIMAL(4,2),
        goldDiff SMALLINT,
        killDiff DECIMAL(3,2)
    );");

    foreach ($champs as $key=>$value){ // value["name"] for champ name, $key is 0-1
        #echo $value["name"]. " <br>";

        # scraping from https://u.gg/lol/champions/<name>/matchups?rank=diamond_plus
        require 'vendor/autoload.php'; 
        $httpClient = new \GuzzleHttp\Client();
        $response = $httpClient->get("https://u.gg/lol/champions/".$value["name"]."/matchups?rank=diamond_plus");
        $htmlString = (string) $response->getBody();
        # add this line to suppress any warnings
        libxml_use_internal_errors(true);
        $doc = new DOMDocument();
        $doc->loadHTML($htmlString);
        $xpath = new DOMXPath($doc);

        # get champ2 names (champ1 will be value["name"]) in the odd rows (u.gg is weird)
        $champ2s_Odd = $xpath->evaluate('//div[@class="rt-table"]//div[@class="rt-tbody"]//div[@class="rt-tr-group"]//div[@class="rt-tr -odd"]//div[@class="rt-td champion"]//a//div[@class="champion-name"]/strong');
        $extractedChamp2s_Odd= [];
        foreach ($champ2s_Odd as $champ2_Odd){
            $extractedChamp2s_Odd[] = $champ2_Odd->textContent.PHP_EOL;
            # echo $champ2_Odd->textContent.PHP_EOL;
        }

        # get champ2 names for even rows
        $champ2s_Even = $xpath->evaluate('//div[@class="rt-tbody"]//div[@class="rt-tr -even"]//div[@class="rt-td champion"]//a//div[@class="champion-name"]/strong');
        $extractedChamp2s_Even= [];
        foreach ($champ2s_Even as $champ2_Even){
            $extractedChamp2s_Even[] = $champ2_Even->textContent.PHP_EOL;
        }

        # get the gold diff and win rate versus champ 2 for odd rows
        $winRatesOdd = $xpath->evaluate('//div[@class="rt-tbody"]//div[@class="rt-tr -odd"]//div[@class="rt-td winrate"]//div/b');
        $extractedwinRatesOdd= [];
        foreach ($winRatesOdd as $winRateOdd){
            $extractedwinRatesOdd[] = $winRateOdd->textContent.PHP_EOL;
            #echo $winRateOdd->textContent.PHP_EOL;
        }

        $goldDiffsOdd = $xpath->evaluate('//div[@class="rt-tbody"]//div[@class="rt-tr -odd"]/div[@class="rt-td"]');
        $extractedgoldDiffsOdd= [];
        foreach ($goldDiffsOdd as $goldDiffOdd){
            $extractedgoldDiffsOdd[] = $goldDiffOdd->textContent.PHP_EOL;
            #echo $goldDiffOdd->textContent.PHP_EOL;
        }

        # get the win rate and gold diff versus champ 2 for even rows
        $winRatesEven = $xpath->evaluate('//div[@class="rt-tbody"]//div[@class="rt-tr -even"]//div[@class="rt-td winrate"]//div/b');
        $extractedwinRatesEven= [];
        foreach ($winRatesEven as $winRateEven){
            $extractedwinRatesEven[] = $winRateEven->textContent.PHP_EOL;
            #echo $winRateEven->textContent.PHP_EOL;
        }

        $goldDiffsEven = $xpath->evaluate('//div[@class="rt-tbody"]//div[@class="rt-tr -even"]/div[@class="rt-td"]');
        $extractedgoldDiffsEven= [];
        foreach ($goldDiffsEven as $goldDiffEven){
            $extractedgoldDiffsEven[] = $goldDiffEven->textContent.PHP_EOL;
            #echo $goldDiffEven->textContent.PHP_EOL;
        }
        

        #echo substr($extractedChamp2s_Odd[0],0,-2);  // name
        #echo substr($extractedwinRatesOdd[0],0,-3);  // win rate
        #echo substr($extractedgoldDiffsOdd[1],0,-2); // gold diff
        #echo substr($extractedgoldDiffsOdd[3],0,-2); // kill diff

        $wr_index = 0;
        $gd_index = 1;
        $kd_index = 3;
        # add everything to our database as appropriate. start with odd indexes
        $c1 = $value["name"];

        # odd champ 2's, winrates, gold diffs, and kill diffs
        foreach($extractedChamp2s_Odd as $key=>$value){
            $c2 = substr($value,0,-2);

            // if ($c2 === "Cho'Gath"){
            //     $c2 = str_replace("'", "", $c2);
            // }
            $wr = substr($extractedwinRatesOdd[$wr_index++],0,-3);
            $gd = substr($extractedgoldDiffsOdd[$gd_index],0,-2); 
            $kd = substr($extractedgoldDiffsOdd[$kd_index],0,-2);
            $gd_index = $gd_index + 7;
            $kd_index = $kd_index + 7;
            $db->query("INSERT INTO project_matchups (champ1,champ2,winRate,goldDiff,killDiff)
                        VALUES(?,?,?,?,?);","ssddd",$c1,$c2,$wr,$gd,$kd);
        }

        $wr_index = 0;
        $gd_index = 1;
        $kd_index = 3;

        # even champ 2's, winrates, gold diffs, and kill diffs
        foreach($extractedChamp2s_Even as $key=>$value){
            $c2 = substr($value,0,-2);
            $wr = substr($extractedwinRatesEven[$wr_index++],0,-3);
            $gd = substr($extractedgoldDiffsEven[$gd_index],0,-2); 
            $kd = substr($extractedgoldDiffsEven[$kd_index],0,-2);
            $gd_index = $gd_index + 7;
            $kd_index = $kd_index + 7;
            $db->query("INSERT INTO project_matchups (champ1,champ2,winRate,goldDiff,killDiff)
                        VALUES(?,?,?,?,?);","ssddd",$c1,$c2,$wr,$gd,$kd);
        }
    }
}

# comment these functions out depending on what you need to do

#createNewUserTable();

createNewChampionsTable();

insertChampions();

get_and_insert_Name_WR_PR();

get_and_insert_Counters();

echo "Setup was successful";