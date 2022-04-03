<!DOCTYPE html>
<!--
Sources used: https://bbbootstrap.com/snippets/bootstrap-5-search-bar-microphone-icon-inside-12725910, 
              https://bootsnipp.com/snippets/ZkexO, 
              https://css-tricks.com/styling-comment-threads/
              https://stackoverflow.com/questions/50662906/my-css-file-not-working-in-my-php-file
-->
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
    <link rel="stylesheet" type ="text/css" href="./styles/main.css"/>
    <link rel="stylesheet" type="text/css" href="./styles/reset.css"/>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <script src="https://cdn.jsdelivr.net/npm/less@4"></script>
  </head>

  <body
    style="
      background: rgba(10, 10, 10, 0.5) url(backgrounds/champ.gif);
      background-size: cover;
      background-blend-mode: darken;
    "
  >
    <?php 
        include "templates/navbar.php";
    ?>
    <div class="container-xl">
      <div class="row">
        <div>
          <h1 class="text-light" id="title">TOPMATCHUPS.GG</h1>
        </div>
        <div>
          <h2 class="text-light" id="subtitle">
            Become a pro top laner today!
          </h2>
        </div>
        <div class="container" style="padding-bottom: 25vh">
          <div
            class="row height d-flex justify-content-center align-items-center"
          >
            <div class="col-md-6">
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
      </div>
    </div>
    <!-- FOOTER -->
    <?php 
        include "footer.php";
    ?>
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
      src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
      integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
