<?php


    // remove user session
    unset( $_SESSION['users'] );

    // redirect the user back to /
    header("Location: /");
    exit;