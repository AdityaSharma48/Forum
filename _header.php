<?php
  session_start();
  include '_dbconn.php';
    echo '
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <!-- Brand Name -->
        <a class="navbar-brand" href="/unit1/cwh/Forum/">iDiscuss</a>
        
        <!-- Toggler Button for Mobile View -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" 
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Links -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/unit1/cwh/Forum/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/unit1/cwh/Forum/Partials/about.php">About</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Top Categories
                    </a>
                    <ul class="dropdown-menu">';

                $sql = "SELECT `category_name`, `category_id` FROM `category` LIMIT 3";
                $result = mysqli_query($conn,$sql);
                $Result = false;
                while($row = mysqli_fetch_assoc($result))
                {
                    echo '<li><a class="dropdown-item" href="/UNIT1/cwh/Forum/Partials/Threads_list.php?catid='.$row['category_id'].'">' . $row['category_name'] . '</a></li>';
                }   
                        
                echo'  </ul>
                </li>';

                echo '
                <li class="nav-item">
                    <a href="/unit1/cwh/Forum/Partials/contact.php" class="nav-link">Contact</a>
                </li>
            </ul>

            <!-- Search Form -->
            <form class="d-flex align-items-center me-3" role="search" action="/unit1/cwh/Forum/Partials/search.php" method="GET">';


            if((isset($_SESSION['loggedin'])) && $_SESSION['loggedin'] == true)
            {
                echo '
                <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-success" type="submit">Search</button>
                </form>
              <p class="text-light my-0 mx-2">Welcome <strong>'.$_SESSION['username'].'</strong> </p>
                ';
                echo '
                <div class="d-flex">
                    <a href="http://localhost/unit1/cwh/Forum/Partials/logout.php" class="btn btn-outline-danger me-2">Login Out</a>
                </div>';
            }
            else
            {
                echo '
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-success" type="submit">Search</button>
                </form>
                <!-- Login & Signup Buttons -->
                <div class="d-flex">
                    <button class="btn btn-outline-primary me-2" data-bs-toggle="modal" data-bs-target="#login_modal">Login</button>
                    <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#signup_modal">Signup</button>
                </div>';
            }
        
        echo '
            </div>
            </div>
            </nav>';

?>


<?php
include 'login_modal.php';
include 'signup_modal.php';
    if(isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == "true")
    {
      echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
              <strong>Success!</strong> You are signup successfully.
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
    }
    else if(isset($_GET['error']))
    {
      $error = htmlspecialchars($_GET['error']); 
      echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
            <strong>Failed!</strong> '.$error.'
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
    }

    // Loged in -------------------------------------------------------------------------------------- -------------------------------
    if(isset($_GET['loginsuccess']) && $_GET['loginsuccess'] == "true")
    {
      echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
              <strong>Success!</strong> You are successfully logged in.
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
    }
    else 
    {
      if(isset($_GET['error1']))
      {
        $error = htmlspecialchars($_GET['error1']);
        echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
              <strong>Failed!</strong> '.$error.'
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
      }
    }
?>