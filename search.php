<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>iDiscuss</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<style>
    #main_container
    {
        min-height:82vh;
    }
</style>
<body>
    <?php include '_dbconn.php'?>
    <?php include '_header.php'?>

    <div class="container my-3" id="main_container">
        <h1>Search for Result "<em><?php echo $_GET['search']?><em>"</h1>

        <?php 
            $query = $_GET['search'];
            $sql1 = "SELECT * FROM `threads` WHERE MATCH(`thread_title`, `thread_desc`) AGAINST ('$query')";
            $result = mysqli_query($conn,$sql1);
            $check = 0;
            while($row = mysqli_fetch_assoc($result))
            {
                $check = 1;
                $title = $row['thread_title'];
                $desc = $row['thread_desc']; 
                $thread_id = $row['thread_id'];
                $url = "thread.php?threadid="."$thread_id";
                echo '
                    <div class="result">
                        <h3><a href="'.$url.'" class="text-center text-black">'.$title.'</a></h3>
                        <p>'.$desc.'</p>
                    </div>
                ';          
            }

            if($check == 0)
            {
                echo '
                    <div class="jumbotron jumbotron-fluid">
                        <div class="container">
                            <p class="display-4">No Results Found</p>
                            <p class="lead"> Suggestions: 
                                <ul>
                                    <li>Make sure that all words are spelled correctly.</li>
                                    <li>Try different keywords.</li>
                                    <li>Try more general keywords. </li>
                                </ul>
                            </p>
                        </div>
                    </div>       
                ';
            }
        ?>
    </div>
    <?php include '_footer.php'?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>
</html>