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
    <link rel="stylesheet" href="./styles/champPage.css" />
    <link rel="stylesheet" href="./styles/reset.css" />
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
    </div>
    <!--Matchups-->
    <div style="background-color: rgb(7, 7, 32)">
      <div class="container">
        <div class="row justify-content-evenly">
          <p style="font-family: Helvetica; margin-top: 30px">Matchups</p>
          <!--Winning Matchups-->
          <div class="card col-md-6">
            <div class="card-head">
              <h2 style="color: rgb(29, 172, 0)">Strong Against</h2>
              <h3><?=$champName?> is strong against these champions</h3>
            </div>
            <div class="card-body">
              <div class="matchup-card" style="transform: rotate(0)">
                <img src="../champArt/jayceicon.png" alt="Jayce icon" />
                <a href="aatrox-vs-jayce.html" class="name stretched-link"
                  >Jayce</a
                >
                <p class="winRate">Win Rate: 52.33%</p>
              </div>
              <div class="matchup-card" style="transform: rotate(0)">
                <img src="../champArt/renektonIcon.png" alt="Renekton icon" />
                <a href="aatrox-vs-jayce.html" class="name stretched-link"
                  >Renekton</a
                >
                <p class="winRate">Win Rate: 54.09%</p>
              </div>
              <div class="matchup-card" style="transform: rotate(0)">
                <img src="../champArt/SettIcon.png" alt="Sett icon" />
                <a href="aatrox-vs-jayce.html" class="name stretched-link"
                  >Sett</a
                >
                <p class="winRate">Win Rate: 51.74%</p>
              </div>
            </div>
          </div>

          <!--Losing Matchups-->
          <div class="card col-md-6">
            <div class="card-head">
              <h2 style="color: rgb(163, 0, 0)">Weak Against</h2>
              <h3><?=$champName?> is weak against these champions</h3>
            </div>
            <div class="card-body">
              <div class="matchup-card" style="transform: rotate(0)">
                <img src="../champArt/rivenicon.png" alt="Riven icon" />
                <a href="aatrox-vs-jayce.html" class="name stretched-link"
                  >Riven</a
                >
                <p class="winRate">Win Rate: 45.73%</p>
              </div>
              <div class="matchup-card" style="transform: rotate(0)">
                <img src="../champArt/jaxicon.png" alt="Jax icon" />
                <a href="aatrox-vs-jayce.html" class="name stretched-link"
                  >Jax</a
                >
                <p class="winRate">Win Rate: 47.88%</p>
              </div>
              <div class="matchup-card" style="transform: rotate(0)">
                <img src="../champArt/fioraicon.png" alt="Fiora icon" />
                <a href="aatrox-vs-jayce.html" class="name stretched-link"
                  >Fiora</a
                >
                <p class="winRate">Win Rate: 48.48%</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <br /><br /><br /><br />
    <!-- FOOTER -->
    <?php include "footer.php"; ?>

  
  </body>
</html>
