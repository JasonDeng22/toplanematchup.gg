<!-- This is the navbar. Do an "include" in the body to make the navbar appear-->

<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="width: 100%;height:4rem ;">
      <div class="container-xl">
        <a class="navbar-brand" href="#">TOPMATCHUPS.GG</a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="?command=home">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="#"
                >Matchup Of The Day</a
              >
            </li>
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="?command=championsList"
                >Champions</a
              >
            </li>
            <li class="nav-item dropdown">
              <a
                class="nav-link dropdown-toggle"
                href="#"
                id="navbarDropdown"
                role="button"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
              >
                Other
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="?command=profile">View your Profile</a>
                <a class="dropdown-item" href="?command=forum">Discussion Forum</a>
                <a class="dropdown-item" href="#">FAQ</a>
                <a class="dropdown-item" href="#">About Us</a>
                <a class="dropdown-item" href="#">Contact Us</a>
              </div>
            </li>
          </ul>
          
          <div class="text-end">

            <?php 
            // if logged in, show logout button. Otherwise, show login and signup buttons
            if (isset($_SESSION["email"])){
              echo '<a href="?command=profile" class="btn btn-outline-light me-1">'.$_SESSION["name"].'</a>';
              echo '<a href="?command=logout" class="btn btn-danger">Logout</a>';
            }
            else{
              echo '<a href="?command=login" class="btn btn-outline-light me-2">Login</a>';
              echo '<a href="?command=signup" class="btn btn-warning">Signup</a>';
            }
            ?>
          </div>
        </div>
      </div>
</nav>