<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>iDiscuss</title>
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
            crossorigin="anonymous">
    </head>

    <body>
      <?php include 'Partials/_dbconn.php'?>
        <?php include 'Partials/_header.php'?>
        <!-- Slider Start here -->
        <div id="carouselExampleIndicators" class="carousel slide">
            <div class="carousel-indicators">
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="https://img.freepik.com/free-vector/laptop-with-program-code-isometric-icon-software-development-programming-applications-dark-neon_39422-971.jpg" class="d-block w-100" style="height:600px; object-fit:fill; width:100vw">
              </div>
              <div class="carousel-item">
                <img src="https://media.istockphoto.com/id/1055083194/photo/close-up-programmer-man-hand-typing-on-keyboard-laptop-for-register-data-system-or-access.jpg?s=2048x2048&w=is&k=20&c=6xSstuVX_kxtlJMqjYfW4LixLCPgWvBPkGlIzG8ENfs=" class="d-block w-100" style="height:600px; object-fit:fill; width:100vw">
              </div>
              <div class="carousel-item">
                <img src="https://media.istockphoto.com/id/1312488680/photo/hacker-working-at-night.jpg?s=2048x2048&w=is&k=20&c=XyBYhlxdpFN57gQRs3X1r4PcqTdyosn-J-B8ND3CBbo=" style="height:600px; object-fit:cover;  width:100vw">
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
        </div>

        <!-- Categories Container start here -->
        <div class="container">
            <h1 class="text-center my-3">iDiscuss - Category</h1>
            <div class="row my-3">
                <!-- Fetch all the categories  -->
                <?php 
                    $sql = "SELECT * FROM `category`";
                    $result = mysqli_query($conn,$sql);
                    // Use a loop to iterate Categories
                    while ($row = mysqli_fetch_assoc($result)) 
                    {
                        $cat = $row['category_name'];
                        $des = $row['category_description'];
                        $id = $row['category_id'];
                        echo '<div class="col-md-4 my-3">
                                <div class="card h-100" style="width: 18rem;">
                                    <img src="img/card-'.$id.'.jpg" 
                                         class="card-img-top" style="height:200px;">
                                    <div class="card-body">
                                        <h5 class="card-title"><a href="Partials/Threads_list.php?catid='.$id.'">'.$cat.'</a></h5>
                                        <p class="card-text">'.substr($des,0,90).'...</p>
                                        <a href="Partials/Threads_list.php?catid='.$id.'" class="btn btn-primary">View Threads</a>
                                    </div>
                                </div>
                            </div>';

                    }
                ?>
            </div>
        </div>
        <?php include 'Partials/_footer.php'?>
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
    </body>
</html>