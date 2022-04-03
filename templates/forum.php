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

    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="./styles/main.css" />
    <link rel="stylesheet" href="./styles/reset.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <script src="https://cdn.jsdelivr.net/npm/less@4"></script>
  </head>

  <body
    style="background-image: url(backgrounds/champ.gif); background-size: cover"
  >
   <?php include "template/navbar.php"; ?>
    <div class="container">
      <h1 class="dftitle"><strong>Discussion Forum</strong></h1>
    </div>
    <div class="container">
      <div
        class="post-comments"
        style="padding-top: 10px; padding-bottom: 10px"
      >
        <form>
          <div class="form-group" style="color: white">
            <label for="comment">Start New Discussion</label>
            <textarea
              name="comment"
              class="form-control"
              rows="3"
              placeholder="New Comment"
            ></textarea>
          </div>
          <br />
          <button type="submit" class="btn btn-warning float-right">
            Post
          </button>
        </form>
      </div>
    </div>
    <div class="container" style="background-color: white">
      <div class="dropdown" style="padding-top: 10px">
        <button
          class="btn btn-secondary dropdown-toggle"
          type="button"
          id="dropdownMenuButton1"
          data-bs-toggle="dropdown"
          aria-expanded="false"
        >
          Sort comments by
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
          <li><a class="dropdown-item" href="#">Newest</a></li>
          <li><a class="dropdown-item" href="#">Most Points</a></li>
        </ul>
      </div>
      <!-- Comment 1 start -->
      <details open class="comment" id="comment-1">
        <summary>
          <div class="comment-heading">
            <div class="comment-voting">
              <button type="button">
                <span aria-hidden="true">&#129045;</span>
                <span class="sr-only">Vote up</span>
              </button>
              <button type="button">
                <span aria-hidden="true">&#129047;</span>
                <span class="sr-only">Vote down</span>
              </button>
            </div>
            <div class="comment-info">
              <a href="#" class="comment-author">user1</a>
              <p class="m-0">22 points &bull; 4 days ago</p>
            </div>
          </div>
        </summary>

        <div class="comment-body">
          <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas
            sed aliquet erat. Aenean at bibendum nisi. Aliquam vel orci sed enim
            efficitur interdum. Vivamus ultrices sem sit amet finibus consequat.
          </p>
          <button type="button">Reply</button>
          <button type="button">Flag</button>
        </div>

        <div class="replies">
          <!-- Comment 2 start -->
          <details open class="comment" id="comment-2">
            <summary>
              <div class="comment-heading">
                <div class="comment-voting">
                  <button type="button">
                    <span aria-hidden="true">&#129045;</span>
                    <span class="sr-only">Vote up</span>
                  </button>
                  <button type="button">
                    <span aria-hidden="true">&#129047;</span>
                    <span class="sr-only">Vote down</span>
                  </button>
                </div>
                <div class="comment-info">
                  <a href="#" class="comment-author">user2</a>
                  <p class="m-0">4 points &bull; 3 days ago</p>
                </div>
              </div>
            </summary>

            <div class="comment-body">
              <p>
                In eu felis ut urna rhoncus faucibus non eu libero. Proin
                convallis scelerisque malesuada.
              </p>
              <button type="button">Reply</button>
              <button type="button">Flag</button>
            </div>
          </details>
          <!-- Comment 2 end -->

          <!-- Comment 3 start -->
          <details open class="comment" id="comment-3">
            <summary>
              <div class="comment-heading">
                <div class="comment-voting">
                  <button type="button">
                    <span aria-hidden="true">&#129045;</span>
                    <span class="sr-only">Vote up</span>
                  </button>
                  <button type="button">
                    <span aria-hidden="true">&#129047;</span>
                    <span class="sr-only">Vote down</span>
                  </button>
                </div>
                <div class="comment-info">
                  <a href="#" class="comment-author">user3</a>
                  <p class="m-0">-19 points &bull; 3 days ago</p>
                </div>
              </div>
            </summary>

            <div class="comment-body">
              <p>
                Fusce placerat, lorem quis ultrices vulputate, risus dui
                tristique eros, eget eleifend neque urna a arcu. Sed non
                tristique nisl, scelerisque hendrerit turpis. Mauris condimentum
                lorem quis mollis efficitur. Proin vehicula, nibh et dapibus
                dictum, elit turpis dignissim dui, id ultrices turpis nulla
                vitae orci.
              </p>
              <button type="button">Reply</button>
              <button type="button">Flag</button>
            </div>

            <div class="replies">
              <!-- Comment 4 start -->
              <details open class="comment" id="comment-4">
                <summary>
                  <div class="comment-heading">
                    <div class="comment-voting">
                      <button type="button">
                        <span aria-hidden="true">&#129045;</span>
                        <span class="sr-only">Vote up</span>
                      </button>
                      <button type="button">
                        <span aria-hidden="true">&#129047;</span>
                        <span class="sr-only">Vote down</span>
                      </button>
                    </div>
                    <div class="comment-info">
                      <a href="#" class="comment-author">user4</a>
                      <p class="m-0">9 points &bull; 2 days ago</p>
                    </div>
                  </div>
                </summary>

                <div class="comment-body">
                  <p>
                    Etiam pretium, elit eget iaculis convallis, neque ante
                    consequat neque, quis venenatis risus metus dapibus libero.
                  </p>
                  <button type="button">Reply</button>
                  <button type="button">Flag</button>
                </div>
              </details>
              <!-- Comment 4 end -->

              <!-- Comment 5 start -->
              <details open class="comment" id="comment-5">
                <summary>
                  <div class="comment-heading">
                    <div class="comment-voting">
                      <button type="button">
                        <span aria-hidden="true">&#129045;</span>
                        <span class="sr-only">Vote up</span>
                      </button>
                      <button type="button">
                        <span aria-hidden="true">&#129047;</span>
                        <span class="sr-only">Vote down</span>
                      </button>
                    </div>
                    <div class="comment-info">
                      <a href="#" class="comment-author">user5</a>
                      <p class="m-0">3 points &bull; 2 days ago</p>
                    </div>
                  </div>
                </summary>

                <div class="comment-body">
                  <p>Proin at placerat erat, ac volutpat tortor.</p>
                  <button type="button">Reply</button>
                  <button type="button">Flag</button>
                </div>
              </details>
              <!-- Comment 5 end -->

              <!-- Comment 6 start -->
              <details open class="comment" id="comment-6">
                <summary>
                  <div class="comment-heading">
                    <div class="comment-voting">
                      <button type="button">
                        <span aria-hidden="true">&#129045;</span>
                        <span class="sr-only">Vote up</span>
                      </button>
                      <button type="button">
                        <span aria-hidden="true">&#129047;</span>
                        <span class="sr-only">Vote down</span>
                      </button>
                    </div>
                    <div class="comment-info">
                      <a href="#" class="comment-author">user6</a>
                      <p class="m-0">0 points &bull; 2 days ago</p>
                    </div>
                  </div>
                </summary>

                <div class="comment-body">
                  <p>
                    Sed eleifend est vitae rutrum tempus. Sed quis nisi eu nunc
                    venenatis hendrerit. Morbi quis ultricies tortor, fermentum
                    varius leo. Aenean elementum purus eget aliquam molestie.
                  </p>
                  <button type="button">Reply</button>
                  <button type="button">Flag</button>
                </div>
              </details>
              <!-- Comment 6 end -->
              <a href="#">Load more replies</a>
            </div>
          </details>
        </div>
      </details>
    </div>
    <?php include "tempalte/footer.php"; ?>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
