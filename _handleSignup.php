<?php
    $showerror = "false";
    $showalert = false;
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        include '_dbconn.php';
        $user_email = $_POST['signupEmail'];
        $pass = $_POST['signupPassword'];
        $cpass = $_POST['signupcPassword'];
        $name = $_POST['name'];
        
        // Check whether this email is exist or not -------------------------------------------
        $existsql = "SELECT * FROM `users` where user_email = '$user_email'";
        $result = mysqli_query($conn,$existsql);
        $numRow = mysqli_num_rows($result);
        if($numRow > 0)
        {
            $showerror = "Email is already exists.";
            header("location:/unit1/cwh/Forum/index.php?signupsuccess=false&error=$showerror");
        }
        else 
        {
            if($pass != $cpass)
            {
                $showerror = "Password do not match";
                header("location:/unit1/cwh/Forum/index.php?signupsuccess=false&error=$showerror");
            }
            else
            {
                $hash = password_hash($pass, PASSWORD_DEFAULT);
                $sql = "INSERT INTO `users` (`name`, `user_email`, `password`) VALUES ('$name', '$user_email', '$hash')";
                $result = mysqli_query($conn,$sql);
                if($result)
                {
                    $showalert = true;
                    header("location:/unit1/cwh/Forum/index.php?signupsuccess=true");
                    exit();
                }
            }
        }
    }
?>