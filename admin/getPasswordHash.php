<?php

    // get your password hash by running "php ./getPasswordHash.php <your desired password here>"
    // higher cost is more secure but takes longer to log in

    ini_set('register_argc_argv', 0);  

    if (!isset($argc) || is_null($argc))
    { 
        header('Location: ../admin');
        exit();
    } else {
        $passwd = $argv[1];
        $hash = password_hash($passwd, PASSWORD_BCRYPT, ["cost" => 15]);
        if (password_verify($passwd, $hash)) {
            echo "valid password hash is: $hash\n";
        } else {
            echo "something went wrong\n";
        }
    }
?>