<?php

    session_start();
    include "connection.php";

    if (isset($_SESSION['u'])) {
        
        $pId = $_POST['pId'];
        $fb  = $_POST['fb'];

        if (empty($fb)) {
            echo('Please enter your feedback');
        }

        Database::search("INSERT INTO `feedback`(`feedback`, `user_email`, `product_id`) VALUES('". $fb ."', '". $_SESSION['u']['email'] ."', '". $pId ."') ");

        echo("Success");
        
    } else {
        echo('Please sign in.');
    }

?>