<?php
session_start();
require_once 'HTMLhead.php';
require_once 'General.php';

$authenticator = new Inlogsystem();
$userid = $authenticator->getUserid();

if(isset($userid))
{
    //authenticated
    $DBtools = DBtools::getdbinstance();
    $user = $DBtools->getUserFromID($userid);
    echo "<h1>You are logged in</h1>";
    echo "<p>Your username is $user->username</p>";
    echo "<p>Your discriminator is $user->discriminator</p>";
    echo "<p>Your lastlogin was $user->lastlogin</p>";
    $dbtools->closeDB();
}
else
{
    //not authenticated
    header("Location: index.php");
}

require_once 'HTMLtail.php';

