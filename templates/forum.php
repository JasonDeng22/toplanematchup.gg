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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous" />
  <link rel="stylesheet" type="text/css" href="./styles/main.css" />
  <link rel="stylesheet" type="text/css" href="./styles/reset.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/less@4"></script>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous" />
  <link rel="stylesheet" href="./styles/main.css" />
  <link rel="stylesheet" href="./styles/reset.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/less@4"></script>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <style type="text/css">
  </style>
</head>

<body style="background-color: rgb(30, 30, 30);">
  <?php include "navbar.php";
  ?>
  <div class="container" style="margin-top: 50px; background-color: white; padding-top: 50px">
    <div class="row">
      <div class="col-md-12">
        <h1><b>Discussion Forum</b></h1>
        <form action="?command=forum" method="post">
          <div class="mb-3">
            <input type="text" class="form-control" id="comment" name="comment" placeholder="New Comment" required oninvalid="this.setCustomValidity('Please type a comment before submitting')" />
          </div>
          <div class="text-center">
            <button type="submit" class="btn btn-primary" style="float: right;">Add Comment</button>
          </div>
        </form>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <h2><b><?php echo $numComm[0]["COUNT(id)"]; ?> Comments</b></h2>
        <div>
          <?php foreach ($allComments as $c) : ?>
            <div class="border border-secondary" style="padding-top: 20px; padding-bottom: 20px; padding-left: 20px; padding-right: 20px;">
              <?php echo "<b>" . $c['name'] . "</b> " . $c['createdOn']; ?><br>
              <div>
                <?php echo $c['comment']; ?>
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
                <?php if (!empty($_SESSION)) {
                  if ($c['userid'] == $_SESSION["id"][0]["id"]) { ?>
                    <form style="display: inline-block; float: right" action="?command=deleteComment" method="post">
                      <input type="submit" value="x" name="btnAction" class="btn btn-danger" />
                      <input type="hidden" name="comment_to_delete" value="<?php echo $c['comment'] ?>" />
                      <input type="hidden" name="date_to_delete" value="<?php echo $c['createdOn'] ?>" />
                    </form>
                <?php }
                }; ?>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
  <?php include "footer.php";
  ?>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

</body>

</html>
