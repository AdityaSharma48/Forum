<?php 
    session_start();
    session_unset();
    session_destroy();
    header("location: /unit1/cwh/Forum");
?>  