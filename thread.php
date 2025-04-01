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
        $id = $_GET['threadid'];
        $sql = "SELECT * FROM `threads` WHERE thread_id = $id";
        $result = mysqli_query($conn,$sql);
        while($row = mysqli_fetch_assoc($result))
        {
          $title = $row['thread_title'];
          $desc = $row['thread_desc'];
            $thread_user_id = $row['thread_user_id'];
          
            $sql2 = "SELECT user_email FROM `users` WHERE sno = '$thread_user_id'";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($result2);
            $user_name = $row2['user_email']; 
        }
    ?>

    <?php
        $showAlert = false;
        $method = $_SERVER['REQUEST_METHOD'];

        if ($method == 'POST') 
        {
            if (isset($_POST['desc']) && isset($_POST['sno'])) 
            {
                $comment = $_POST['desc'];
                $sno = $_POST['sno'];
            
                $comment = str_replace("<", "&lt;", $comment);
                $comment = str_replace(">", "&gt;", $comment);
            
                $comment = mysqli_real_escape_string($conn, $comment);
                $sno = mysqli_real_escape_string($conn, $sno);
            
                if (isset($_GET['threadid'])) {
                    $id = $_GET['threadid'];
                } else {
                    $id = 0; 
                }
            
                $sql1 = "INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`, `comment_time`) 
                         VALUES ('$comment', '$id', '$sno', current_timestamp())";

                $result = mysqli_query($conn, $sql1);
                if ($result) {
                    $showAlert = true;
                } else {
                    echo "Error: " . mysqli_error($conn);
                }
            }
        }
    ?>

    <?php 
      if($showAlert)
      {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your comment have been added successfully.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
      }
    ?>

    <div class="container my-4 content">
        <div class="container my-4">
            <div class="jumbotron"
                style="background-color: #f8f9fa; border: 1px solid #dee2e6; padding: 2rem; rounded-xl">
                <h1 class="display-4">Welcome to
                    <?php echo $title ?>
                    Forum</h1>
                <p class="lead">
                    <?php echo $desc ?>
                </p>
                <hr class="my-4">
                <p>This is a peer-to-peer forum. No Spam / Advertising / Self-promote in the forums is not allowed. Do
                    not post copyright-infringing material. Do not post “offensive” posts, links, or images. Do not
                    cross-post questions. Remain respectful of other members at all times.</p>
                <p><b>Posted by:<?php echo $user_name;?></b></p>
            </div>
        </div>

        
        <?php
            if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
            {
                echo '<div class="container my-4">
            <h1 class="py-2">Post a Comment</h1>
            <form action="' . $_SERVER['REQUEST_URI'] . '" method="POST">
                <div class="mb-3">
                    <label for="desc" class="form-label">Type your Comment</label>
                    <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
                    <input type="hidden" name="sno" value="' .  $_SESSION['sno'] . '">
                </div>
                <button type="submit" class="btn btn-success">Post comment</button>
            </form>
        </div>';
            }
            else
            {
                echo '
                <div class="container my-4">
                    <h1 class="py-2">Post a Comment</h1>
                    <p class="lead"><strong> Before start the Discussion. Please Login </strong> </p>
                </div>
                ';
            }
        ?>

        <div class="container my-4" id="ques">
            <h1 class="py-2">Discussion</h1>

            <?php
            $id = $_GET['threadid'];
            $sql = "SELECT * FROM `comments` WHERE thread_id = $id";
            $result = mysqli_query($conn,$sql);
            $noresult = true;
            while($row = mysqli_fetch_assoc($result))
            {
              $noresult = false;
              $id = $row['comment_id'];
              $content = $row['comment_content'];
              $comment_time = $row['comment_time'];

            $thread_user_id = $row['comment_by'];
              $sql2 = "SELECT user_email FROM `users` where sno='$thread_user_id'";
              $result2 = mysqli_query($conn,$sql2);
              $row2 = mysqli_fetch_assoc($result2);

              echo '<div class="media d-flex my-3">
                  <img src="https://www.shutterstock.com/image-vector/avatar-gender-neutral-silhouette-vector-600nw-2470054311.jpg" class="mr-3" style="width:54px; margin-right-3px;height:54px;">
                  <div class="media-body">
                  <p class="font-weight-bold my-0" style="font-weight:bold; margin-top:0px; margin-bottom:0px;">'.$row2['user_email'].' at '.$comment_time.'</p>
                    '.$content.'                    
                  </div>
              </div>';
            }
            if($noresult)
            {
              echo '<div class="jumbotron jumbotron-fluid bg-light">
                      <div class="container">
                        <p class="display-4 pt-3">No Comments found. Be the first person to comment</p>
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