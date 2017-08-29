<?php
session_start();
require_once 'HTMLhead.php';
require_once 'General.php';

$authenticator = new Inlogsystem();
$userid = $authenticator->getUserid();

if(isset($userid))
{
    $dbtools = db::getdbinstance();
    //authenticated




    $dbtools->closeDB();
}
else
{
    //not authenticated
    header("Location: index.php");
}

require_once 'HTMLtail.php';

