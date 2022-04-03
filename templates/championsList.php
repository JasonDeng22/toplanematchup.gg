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
    <link rel="stylesheet" href="./styles/champions.css" />
    <link rel="stylesheet" href="./styles/reset.css" />
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
              type="text"
              class="form-control form-input"
              placeholder="Search any champion"
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
        justify-content: flex-end;
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
            echo '<img src="champArt/'.$value["splashDir"].'" alt="A picture of'.$value["name"].'." />';
            echo '<div class="card-body">';
            echo '<a class="links stretched-link" href="?command='.$value["name"].'">'.$value["name"].'</a>';
            echo '<p class="card-text"></p></div></div>';
          }
        ?>
      </div>
    </div>
    <br><br><br>
    <!-- FOOTER -->
    <?php include "footer.php"; ?>

    <!-- Scripts -->
    <script
      src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
      integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
      integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
