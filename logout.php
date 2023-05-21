<?php

    session_start();

    // remove user session
    unset( $_SESSION['users'] );

    // redirect the user back to index.php
    header("Location: index.php");
    exit;