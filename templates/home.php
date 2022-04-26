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
    <!-- <link rel="stylesheet" type="text/css" href="./styles/reset.css"/> -->
    <link rel="stylesheet" type ="text/css" href="./styles/main.css"/>
    <link rel="stylesheet" type="text/css" href="./styles/searchbar.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/less@4"></script>
  </head>

  <body
    style="
      background: rgba(10, 10, 10, 0.5) url(backgrounds/champ.gif);
      background-size: cover;
      background-blend-mode: darken;
      background-attachment: fixed;
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
            <div class="wrapper">
                <div class="search-input">
                  <a href="" target="" hidden></a>
                  <form onsubmit="return submits();">
                    <input id="input" type="text" placeholder="Type to search..">
                  </form>
                  <div class="autocom-box">
                    <!-- here list are inserted from javascript -->
                  </div>
                  <div class="icon"><i class="fas fa-search"></i></div>
                </div>
            </div>
        </div>
      </div>
    </div>
    <!-- FOOTER -->
    <?php 
        include "footer.php";
    ?>
    <script type="text/javascript" src="./scripts/suggestions.js"></script>
    <script type="text/javascript" src="./scripts/searchbar.js"></script>
  </body>
</html>
