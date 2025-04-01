<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>iDiscuss</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
    #ques {
        min-height: 433px;
    }
    </style>
</head>

<body>
    <?php include '_dbconn.php'?>
    <?php include '_header.php'?>
    <?php
        $id = $_GET['catid'];
        $sql = "SELECT * FROM `category` WHERE category_id = $id";
        $result = mysqli_query($conn,$sql);
        while($row = mysqli_fetch_assoc($result))
        {
          $catname = $row['category_name'];
          $catdesc = $row['category_description'];
        }
    ?>

    <?php
            $showAlert = false;
            $method = $_SERVER['REQUEST_METHOD'];
            if($method=='POST')
            {
               $th_title = $_POST['title'];
               $th_desc = $_POST['desc'];

               $th_title = str_replace("<", "&lt;", $th_title);
               $th_desc = str_replace("<", "&lt;", $th_desc);

            $sno = $_POST['sno'];
               
                $sql = "INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ( '$th_title', '$th_desc', '$id', '$sno', current_timestamp())";
                $result1 = mysqli_query($conn, $sql);
               $showAlert = true;
            }
        ?>
    <?php 

      if($showAlert)
      {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your thread have been inserted successfully.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
      }
    ?>

    
    <div class="container my-4 content">
        <div class="container my-4">
            <div class="jumbotron"
                style="background-color: #f8f9fa; border: 1px solid #dee2e6; padding: 2rem; rounded-xl">
                <h1 class="display-4">Welcome to <?php echo $catname ?> Forum</h1>
                <p class="lead"><?php echo $catdesc ?></p>
                <hr class="my-4">
                <p>This is a peer-to-peer forum. No Spam / Advertising / Self-promote in the forums is not allowed. Do
                    not post copyright-infringing material. Do not post “offensive” posts, links, or images. Do not
                    cross-post questions. Remain respectful of other members at all times.</p>
                <a class="btn btn-success btn-lg" href="#" role="button">Learn more</a>
            </div>
        </div>
        <?php
            if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
            {
                echo '<div class="container my-4">
                    <h1 class="py-2">Start Discussion</h1>
                    <form action="' . $_SERVER['REQUEST_URI'] . '" method="POST">
                        <div class="mb-3">
                            <label for="title" class="form-label">Problem Title</label>
                            <input type="text" class="form-control" id="title" name="title">
                            <div id="emailHelp" class="form-text">Keep your title as crisp and as short as possible</div>
                        </div>
                            
                        <input type="hidden" name="sno" value="'.$_SESSION["sno"].'">

                        <div class="mb-3">
                            <label for="desc" class="form-label">Elebroate your concern</label>
                            <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </form> 
                </div>';
            }
            else
            {
                echo '
                <div class="container my-4">
                    <h1 class="py-2">Start Discussion</h1>
                    <p class="lead"><strong> Before start the Discussion. Please Login </strong> </p>
                </div>
                ';
            }
        ?>  

        <div class="container my-4" id="ques">
            <h1 class="py-2">Browse Questions</h1>

            <?php
                  $id = $_GET['catid'];
                  $sql = "SELECT * FROM `threads` WHERE thread_cat_id = $id";

                  $result = mysqli_query($conn,$sql);
                  $noresult = true;
                  while($row = mysqli_fetch_assoc($result))
                  {
                    $noresult = false;
                    $title = $row['thread_title'];
                    $desc = $row['thread_desc'];
                    $id = $row['thread_id'];
                    $thread_time = $row['timestamp'];
                    $thread_user_id = $row['thread_user_id'];

                    $sql2 = "SELECT user_email FROM `users` where sno='$thread_user_id'";
                    $result2 = mysqli_query($conn,$sql2);
                    $row2 = mysqli_fetch_assoc($result2);
    

                echo '<div class="media my-3" style="display: flex; align-items: center; justify-content: space-between; padding: 0 20px;">
                          <div style="display: flex; align-items: center;">
                              <img src="https://www.shutterstock.com/image-vector/avatar-gender-neutral-silhouette-vector-600nw-2470054311.jpg"
                                   width="54px" class="mr-3" alt="User Avatar">
                              <div class="media-body">
                                  <h5 class="mt-0">
                                      <a class="text-dark" href="thread.php?threadid=' . $id . '">' . $title . '</a>
                                  </h5>
                                  <div>' . $desc . '</div>
                              </div>
                          </div>
                          <div class="font-weight-bold my-0">
                              <strong>Asked by ' . $row2['user_email'] . ' </strong> at ' . $thread_time . '
                          </div>
                    </div>';

                  }
                  if($noresult)
                  {
                    echo '<div class="jumbotron jumbotron-fluid bg-light">
                            <div class="container">
                              <p class="display-4 pt-3">No Result found.</p>
                              <p class="lead pb-4">Be the first person to ask a question...</p>
                            </div>
                          </div>';
                  }
            ?> 
        </div>
    </div>
    <div class="footer">
        <?php include '_footer.php'?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>
</html>