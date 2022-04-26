<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <meta name="author" content="John Yun, Jason Deng" />
    <meta name="description" content="CS4640 Project Website" />
    <meta name="keywords" content="League of Legends, Top Lane, Matchups" />

    <title>TOPMATCHUPS.GG</title>

    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU"
      crossorigin="anonymous"
    />
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./styles/champPage.css" />
    <link rel="stylesheet" href="./styles/reset.css" />
    <script type="text/javascript" src="./scripts/showTableOrGrid.js"></script>
    <script type="text/javascript" src="./scripts/sorting.js"></script>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <script src="https://cdn.jsdelivr.net/npm/less@4"></script>
  </head>

  <body>
      
    <?php include "navbar.php";
          if (!empty($error_msg)) {
              echo "<div class='alert alert-danger'>$error_msg</div>";
          }
    #echo '<div class="p-5 mb-4 rounded-3 jumbo" style="background: rgba(10, 10, 10, 0.6) url("./champArt/'.$splash.'")">';
    ?>
    <div class="p-5 mb-4 rounded-3 jumbo" style=
    "background: rgba(10, 10, 10, 0.6) url('./champArt/<?=$champName?>.jpg');
     background-size: cover;
     margin-bottom: 4vh;
    ">
      <div class="container-fluid py-5">
        <h1 class="fw-bold"><?=$champName?> - <?=$moniker?></h1><br>
        <p class="col-md-7">
          <?=$description?><br><br>
          <b>Win rate: <?=$wr?>%</b><br>
          <b>Pick Rate: <?=$pr?>%</b>
        </p>
      </div>    
    </div><br><br>
    <!--Matchups-->
    <div style="background-color: rgb(7, 7, 32)">
      <div class="container">
        <div class="row justify-content-evenly">
          <p style="font-family: Helvetica; margin-top: 30px">Featured Matchups</p>
          <!--Winning Matchups-->
          <div class="card col-md-6">
            <div class="card-head">
              <h2 style="color: rgb(29, 172, 0)">Strong Against</h2>
              <h3><?=$champName?> is strong against these champions</h3>
            </div>
            <div id="winningMatchupBody" class="card-body">
            <!-- Print out the 6 best matchups in terms of winrate -->
            <!-- TODO: Implement sorting matchups by win rate / gold diff / kill diff -->
            <?php
                foreach ($bestMatchups as $key=>$value){
                    echo '<div class="matchup-card" style="transform: rotate(0)">';
                    echo '<img src="./champArt/'.$value["champ2"].'Icon.png" alt="'.$value["champ2"].' icon" />';
                    echo '<a href="?command=matchupPage&champ1='.$value["champ1"].'&champ2='.$value["champ2"].'" class="name stretched-link">'.$value["champ2"].'<br><br></a>';
                    if ($value["winRate"] >= 51){
                        $color = "color: rgb(29, 172, 0)";
                    }
                    else if ($value["winRate"] <= 49){
                        $color = "color: rgb(163,0 , 0)";
                    }
                    else{
                        $color =  "color: rgb(250,250 ,250)";
                    }
                    echo '<p class="winRate">Win Rate:&nbsp<b style="'.$color.'">'.$value["winRate"].'%</b></p>';
                    if ($value["goldDiff"] > 150){
                        $color = "color: rgb(29, 172, 0)";
                    }
                    else if ($value["goldDiff"] < -150){
                        $color = "color: rgb(163,0 , 0)";
                    }
                    else{
                        $color =  "color: rgb(250,250 ,250)";
                    }
                    echo '<p class="goldDiff">Gold Diff @ 15:<b style="'.$color.'"> '.$value["goldDiff"].'</b></p><br>';
                    echo '</div>';
                }
            ?>
            </div>
          </div>

          <!--Losing Matchups-->
          <div class="card col-md-6">
            <div class="card-head">
              <h2 style="color: rgb(163, 0, 0)">Weak Against</h2>
              <h3><?=$champName?> is weak against these champions</h3>
            </div>
            <div id="losingMatchupBody" class="card-body">
            <!-- Print out the 6 worst matchups in terms of winrate -->
            <!-- TODO: Implement sorting matchups by win rate / gold diff / kill diff -->
            <?php
                foreach ($worstMatchups as $key=>$value){
                    echo '<div class="matchup-card" style="transform: rotate(0)">';
                    echo '<img src="./champArt/'.$value["champ2"].'Icon.png" alt="'.$value["champ2"].' icon" />';
                    echo '<a href="?command=matchupPage&champ1='.$value["champ1"].'&champ2='.$value["champ2"].'" class="name stretched-link">'.$value["champ2"].'<br><br></a>';
                    if ($value["winRate"] >= 51){
                        $color = "color: rgb(29, 172, 0)";
                    }
                    else if ($value["winRate"] <= 49){
                        $color = "color: rgb(163,0 , 0)";
                    }
                    else{
                        $color =  "color: rgb(250,250 ,250)";
                    }
                    echo '<p class="winRate">Win Rate:&nbsp<b style="'.$color.'">'.$value["winRate"].'%</b></p>';
                    if ($value["goldDiff"] > 150){
                        $color = "color: rgb(29, 172, 0)";
                    }
                    else if ($value["goldDiff"] < -150){
                        $color = "color: rgb(163,0 , 0)";
                    }
                    else{
                        $color =  "color: rgb(250,250 ,250)";
                    }
                    echo '<p class="goldDiff">Gold Diff @ 15:<b style="'.$color.'"> '.$value["goldDiff"].'</b></p><br>';
                    echo '</div>';
                }
            ?>
            </div>
          </div>


        </div>
      </div>
    </div><br><br>
    <!--Table -->
    <div style="background-color: rgb(7, 7, 32)">
      <div class="container">
        <div class="row justify-content-evenly">
          <p style="font-family: Helvetica; margin-top: 30px">All Matchups</p>
        </div>
        <div class="justify-content-center">
          <button id="hide" onclick="hideTable();" style="display: flex" type="button" class="btn btn-secondary">Hide Table</button>
          <button id="show" onclick="showTable();" style="display: none" type="button" class="btn btn-secondary">Show Table</button><br><br>
        </div>
        <table id="champtable" class="table table-bordered table-striped table-dark" style=" font-size: 20px; font-weight:bold">
            <thead>
              <tr>
                <th id="tableIndex" style="width: 5%">#</th>
                <th style="width: 5%"></th>
                <th id="championsTable" onclick="alphabeticalSort(true);" style="width: 31.66%">Champions</th>
                <th id="winrateTable" onclick="winRateSort(true);" style="width: 31.66%">Win Rate</th>
                <!-- same id and event handler as pickrate because i dont feel like writing more code -->
                <th id="pickrateTable" onclick="pickRateSort(true,true);"style="width: 31.66%">Gold Difference @ 15</th>
              </tr>
            </thead>
            <tbody style="font-weight: normal; font-size: 20px; text-align: left" id="tbod">
            <?php
            $rowNum = 1;
            foreach ($allMatchups as $key=>$value){
              // print tr row and then appropriate td cells
              echo "<tr>";
              // print row number cell
              echo "<td><span id='chtbnx'>".$rowNum."</span></td>";
              $rowNum++;
              // print champion icon cell
              echo '<td><img style="padding-top: 0px; width: auto; box-shadow: 0px 0px 0px black;" src="
              ./champArt/'.$value["champ2"].'Icon.png" alt="'.$value["champ2"].'" width="30" height="30"></td>';
              // print champ name cell
              echo '<td><a style="color:white:" id="chtbnm" href="?command=matchupPage&champ1='
              .$value["champ1"].'&champ2='.$value["champ2"].'">'.$value["champ2"].'</a></td>';
              // print champ win rate cell 
              echo '<td><span id="chtbwr">'.$value["winRate"].'%</span></td>';
              // print champ gold diff cell (has id of pick rate for easier sorting)
              echo '<td><span id="chtbpr">'.$value["goldDiff"].'</span></td>';
              // close off the row
              echo "</tr>";
            }
            ?>
        </table><br><br>
      </div>
    </div>
    <br /><br /><br /><br />
    <!-- FOOTER -->
    <?php include "footer.php"; ?>

  
  </body>
</html>
