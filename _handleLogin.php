<?php
    $login = false;
    $showerror = "true";
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        include '_dbconn.php';
        $email = $_POST['LoginEmail'];
        $pass = $_POST['LoginPassword'];
        $name = $_POST['username'];
        
        $sql = "SELECT * FROM `users` where user_email = '$email'";
        $result = mysqli_query($conn, $sql);

        $num = mysqli_num_rows($result);
        if($num == 1)
        {
            $row = mysqli_fetch_assoc($result);
            if(password_verify($pass, $row['password']) && $name == $row['name'])
            {    
                $login = true;
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['useremail'] = $email;
                $_SESSION['username'] = $name;
                $_SESSION['sno'] = $row['sno'];
                
                header("location: /unit1/cwh/Forum/index.php?loginsuccess=true");
                exit();
            }
            else
            {
                $showerror = "Invalid Credentails";
                header("location: /unit1/cwh/Forum/index.php?loginsuccess=false&error1=$showerror");
            }
        }
        else 
        {
            $showerror = "User credentials is not valid";
            header("location: /unit1/cwh/Forum/index.php?loginsuccess=false&error1=$showerror");
        }
    }
?>