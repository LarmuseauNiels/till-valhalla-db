<?php
/**
 * User: niels
 * Date: 04/09/2017
 * Time: 20:54
 */

$action = isset($_GET["action"]) ? $_GET["action"] : "";
switch ($action) {
    case "test":
        $myObj->stat = "action oke";
        break;
    default:
        $myObj->stat = "action not recognized";
        break;
}
$myJSON = json_encode($myObj);
echo $myJSON;
