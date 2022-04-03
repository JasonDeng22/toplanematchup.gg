<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <meta name="author" content="John Yun, Jason Deng" />
    <meta name="description" content="Sprint 2 Website" />
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
        <!-- Aatrox -->
        <div class="card col-md-4">
          <img src="champArt/Aatrox.jpg" alt="A picture of Aatrox." />

          <div class="card-body">
            <a class="links stretched-link" href="champions/aatrox.html"
              >Aatrox</a
            >
            <p class="card-text"></p>
          </div>
        </div>
        <!-- Camille -->
        <div class="card col-md-4">
          <img src="champArt/Camille.jpg" alt="A picture of Camille." />
          <div class="card-body">
            <a class="links stretched-link" href="champions/camille.html"
              >Camille</a
            >
            <p class="card-text"></p>
          </div>
        </div>
        <!-- Darius -->
        <div class="card col-md-4">
          <img src="champArt/darius.jpg" alt="Darius splash art" />
          <div class="card-body">
            <a class="links stretched-link" href="champions/darius.html"
              >Darius</a
            >
            <p class="card-text"></p>
          </div>
        </div>
        <!-- Fiora -->
        <div class="card col-md-4">
          <img src="champArt/Fiora.jpg" alt="fiora splash art" />
          <div class="card-body">
            <a class="links stretched-link" href="champions/Fiora.html"
              >Fiora</a
            >
            <p class="card-text"></p>
          </div>
        </div>
        <!-- Gangplank -->
        <div class="card col-md-4">
          <img src="champArt/Gangplank.jpg" alt="fiora splash art" />
          <div class="card-body">
            <a class="links stretched-link" href="champions/Gangplank.html"
              >Gangplank</a
            >
            <p class="card-text"></p>
          </div>
        </div>
        <!-- Irelia -->
        <div class="card col-md-4">
          <img src="champArt/irelia.jpg" alt="Irelia splash art" />
          <div class="card-body">
            <a class="links stretched-link" href="champions/irelia.html"
              >Irelia</a
            >
            <p class="card-text"></p>
          </div>
        </div>
        <!-- Jax -->
        <div class="card col-md-4">
          <img src="champArt/jax.jpg" alt="Jax splash art" />
          <div class="card-body">
            <a class="links stretched-link" href="champions/jax.html">Jax</a>
            <p class="card-text"></p>
          </div>
        </div>
        <!-- Jayce -->
        <div class="card col-md-4">
          <img src="champArt/Jayce.jpg" alt="Jayce splash art" />
          <div class="card-body">
            <a class="links stretched-link" href="champions/Jayce.html"
              >Jayce</a
            >
            <p class="card-text"></p>
          </div>
        </div>
        <!-- Renekton -->
        <div class="card col-md-4">
          <img src="champArt/renekton.jpg" alt="Jayce splash art" />
          <div class="card-body">
            <a class="links stretched-link" href="champions/Renekton.html"
              >Renekton</a
            >
            <p class="card-text"></p>
          </div>
        </div>
        <!-- riven -->
        <div class="card col-md-4">
          <img src="champArt/riven.jpg" alt="Jayce splash art" />
          <div class="card-body">
            <a class="links stretched-link" href="champions/Riven.html"
              >Riven</a
            >
            <p class="card-text"></p>
          </div>
        </div>

        <!-- Sett -->
        <div class="card col-md-4">
          <img src="champArt/sett.jpg" alt="sett splash art" />
          <div class="card-body">
            <a class="links stretched-link" href="champions/Sett.html">Sett</a>
            <p class="card-text"></p>
          </div>
        </div>
        <!-- Tryndamere -->
        <div class="card col-md-4">
          <img src="champArt/tryndamere.jpg" alt="Tryndamere splash art" />
          <div class="card-body">
            <a class="links stretched-link" href="champions/Tryndamere.html"
              >Tryndamere</a
            >
            <p class="card-text"></p>
          </div>
        </div>
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
