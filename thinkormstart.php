<?php
include_once("phpExtLib/thinkormext.php");
include_once("vendor/autoload.php");
use think\Db;
$dbConf = require_once("database.php");
Db::setConfig($dbConf);
echo json_encode(db("abc")->select());