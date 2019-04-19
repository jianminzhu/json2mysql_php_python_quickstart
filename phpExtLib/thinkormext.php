<?php
include_once "../vendor/autoload.php";
use think\Db;
function db($tablename)
{
    return Db::table($tablename);
}



