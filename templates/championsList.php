<!DOCTYPE html>
<!-- https://codeburst.io/how-to-position-html-elements-side-by-side-with-css-e1fae72ddcc -->
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
    <link rel="stylesheet" href="./styles/champions.css" />
    <link rel="stylesheet" href="./styles/reset.css" />
    <script type="text/javascript" src="./scripts/searchbar.js"></script>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <script src="https://cdn.jsdelivr.net/npm/less@4"></script>
  </head>

  <body>
    <?php include "navbar.php"; ?>
    <!--Title and Search Bar-->
    <div class="container" style="padding-bottom: 5vh">
      <div class="row height d-flex justify-content-center align-items-center">
        <h1 class="dftitle"><strong>Top Lane Champions</strong></h1>
        <div class="col-md-4">
          <div class="form">
            <i class="fa fa-search"></i>
            <input
              id = "searchbar"
              type="text"
              class="form-control form-input"
              placeholder="Search any champion"
              onkeyup="champListSearch();"
            />
            <span class="left-pan"><i class="fa fa-microphone"></i></span>
          </div>
        </div>
      </div>
    </div>
    <!--Sort by-->
    <div
      class="container"
      style="
        background-color: rgb(30, 30, 30);
        display: flex;
        justify-content: space-between;
      "
    >
    <div class="dropdown" style="padding-top: 10px; padding-bottom: 10px">
        <button
          class="btn btn-secondary dropdown-toggle"
          type="button"
          id="dropdownMenuButton1"
          data-bs-toggle="dropdown"
          aria-expanded="false"
        >
          View champions by
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
          <li><a class="dropdown-item" href="#">Grid View (default)</a></li>
          <li><a class="dropdown-item" href="#">Table View</a></li>
        </ul>
      </div>

      <div class="dropdown" style="padding-top: 10px; padding-bottom: 10px">
        <button
          class="btn btn-secondary dropdown-toggle"
          type="button"
          id="dropdownMenuButton1"
          data-bs-toggle="dropdown"
          aria-expanded="false"
        >
          Sort champions by
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
          <li><a class="dropdown-item" href="#">Alphabetical (Default)</a></li>
          <li><a class="dropdown-item" href="#">Highest Winrate</a></li>
          <li><a class="dropdown-item" href="#">Highest Pickrate</a></li>
        </ul>
      </div>
    </div>
    <!--Champions-->
    <div class="container">
      <div class="row">

        <?php
          foreach ($champions as $key=>$value){
            echo '<div class="card col-md-4">';
            echo '<img src="champArt/'.$value["name"].'.jpg" alt="A picture of'.$value["name"].'." />';
            echo '<div class="card-body">';
            echo '<a class="links stretched-link" href="?command=championInfo&champName='.$value["name"].'"></a>';
            echo '<p id="name" class="cardtext">'.$value["name"].'</p>
                  <p id="winRate" class="cardtext">Win Rate: '.$value["winRate"].'%</p>
                  <p id="pickRate" class="cardtext">Pick Rate: '.$value["pickRate"].'%</p>
                  </div></div>';
          }
        ?>
      </div>
    </div>
    <br><br><br>
    <!-- FOOTER -->
    <?php include "footer.php"; ?>

  
  </body>
</html>
