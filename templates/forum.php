<!DOCTYPE html>
<!--
Sources used: https://bbbootstrap.com/snippets/bootstrap-5-search-bar-microphone-icon-inside-12725910,
 https://bbbootstrap.com/snippets/bootstrap-like-comment-share-section-comment-box-63008805, 
 https://css-tricks.com/styling-comment-threads/
-->
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <meta name="author" content="John Yun, Jason Deng" />
  <meta name="description" content="Sprint 2 Website" />
  <meta name="keywords" content="League of Legends, Top Lane, Matchups" />

  <title>TOPMATCHUPS.GG</title>

  <link rel="stylesheet" href="./styles/main.css" />
  <link rel="stylesheet" href="./styles/reset.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/less@4"></script>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <style type="text/css">
  </style>

  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

  <script>
    var set = 'y';

    function createCookie(name, value, days) {
      var expires;

      if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toGMTString();
      } else {
        expires = "";
      }

      document.cookie = escape(name) + "=" +
        escape(value) + expires + "; path=/";
    }

    changeSet = () => {
      set = 'x';
      createCookie("addComment", set, (1 / (24 / 60 / 60 / 1000)));
    }

    let reset = function () {
      createCookie("addComment", 'y', (1 / (24 / 60 / 60 / 1000)));
    };

    $(document).ready(function() {
      $(".reply-button").each(function() {
        $(this).click(function() {

          console.log($(this).get(0).outerHTML);
          console.log($(this).parent().parent().children().children()[0].textContent);

          var name = $(this).parent().parent().children().children()[0].textContent;
          document.getElementById("comment").value = "@" + name + " ";
          document.getElementById("comment").focus();
        })
      })
    });
  </script>


  <!-- <script type="text/javascript" src="./scripts/comments.js"></script> -->
</head>

<body onload="reset();" class="d-flex flex-column min-vh-100" style="background-color: rgb(30, 30, 30);">
  <!--  -->
  <?php include "navbar.php";
  ?>
  <div class="container" style="margin-top: 50px; background-color: white; padding-top: 50px">
    <div class="row">
      <div class="col-md-12">
        <h1><b>Discussion Forum</b></h1>
        <form onsubmit="changeSet();" id="commentForm" action="?command=forum&addComment=x" method="post">
          <div class="mb-3">
            <input type="text" class="form-control" id="comment" name="comment" placeholder="New Comment" />
          </div>
          <div class="text-center">
            <button type="submit" onsubmit="changeSet();" class="btn btn-primary" style="float: right;">Add Comment</button>
          </div>
        </form>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12" style="padding-bottom: 10px;">
        <h2><b><?php echo $numComm[0]["COUNT(id)"]; ?> Comments</b></h2>
        <div>
          <?php $i = 0 ?>
          <?php foreach ($allComments as $c) : ?>
            <div class="border border-secondary" style="padding-top: 20px; padding-bottom: 20px; padding-left: 20px; padding-right: 20px;">
              <?php echo "<p class='comment' id='poster" . $i++ . "'><b>" . $c['name'] . "</b> " . $c['createdOn'] . "</p>"; ?>
              <?php if (isset($_SESSION["email"])) {
                if ($c['userid'] == $_SESSION["id"][0]["id"]) { ?>
                  <form style="float: right" action="?command=deleteComment" method="post">
                    <input type="submit" value="x" name="btnAction" class="btn btn-danger" />
                    <input type="hidden" name="comment_to_delete" value="<?php echo $c['comment'] ?>" />
                    <input type="hidden" name="date_to_delete" value="<?php echo $c['createdOn'] ?>" />
                  </form>
              <?php }
              }; ?>
              <div>
                <?php echo $c['comment']; ?> <br><br>
                <form style="display: inline-block;" action="?command=likeComment" method="post">
                  <input type="submit" value="&#8593;" name="btnAction" class="btn btn-primary" />
                  <input type="hidden" name="comment_to_like" value="<?php echo $c['comment'] ?>" />
                  <input type="hidden" name="date_to_like" value="<?php echo $c['createdOn'] ?>" />
                </form>
                <?php echo $c["likes"] ?>
                <form style="display: inline-block;" action="?command=dislikeComment" method="post">
                  <input type="submit" value="&#8595;" name="btnAction" class="btn btn-danger" />
                  <input type="hidden" name="comment_to_dislike" value="<?php echo $c['comment'] ?>" />
                  <input type="hidden" name="date_to_dislike" value="<?php echo $c['createdOn'] ?>" />
                </form>
                <?php echo $c["dislikes"] ?>
                <input type="button" value="Reply" name="btnAction" class="btn btn-secondary reply-button" />

              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
  <!-- <button id="showData">Show User Data</button>
  <div id="table-container"></div> -->
  <?php include "footer.php";
  ?>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

</body>

</html>