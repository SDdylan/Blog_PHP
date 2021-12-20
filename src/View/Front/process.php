<?php

session_start();

if ( isset($_POST['email']) && isset($_POST['mdp'])) {

    $sql = "SELECT is_admin, alias FROM USER WHERE email='" . $_POST['email'] . "' AND password='" . $_POST['email'] . "';";
    echo $sql;

}

echo $_POST['email'];