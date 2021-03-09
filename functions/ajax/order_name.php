<?php
	$criteria  = $_POST["criteria"];
    session_start();
    if (!isset($_SESSION['criteria'])) {
        $_SESSION['criteria'] = $criteria;
    } else {
        if ($_SESSION['criteria'] == "") {
            $_SESSION['criteria'] = $criteria;
        } else {
            $_SESSION['criteria'] = "";
        }
    }