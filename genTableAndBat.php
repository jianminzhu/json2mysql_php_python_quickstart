<?php
include_once "phpExtLib/CommandLine";
include_once("phpExtLib/rbext.php");
function delKey($data, $delKey)
{
    $data = (array )$data;

    foreach ($data as $key => $value) {
        if ($key == $delKey) {
            unset($data[$delKey]);
        }
    }
    return $data;
}

function msg($msg)
{
    echo $msg;
}

try {
    $cmd = new CommandLine();
    $cmd->option('h', function ($val) {
        echo "--jsonFile  要创建表的json 默认使用tables.json \n";
        echo "--dbConfFile  数据库配置文件 默认为database.php \n";
    });
} catch (Exception $e) {
}
$jsonFile = CommandLine::opt("jsonFile", "tables.json");
$jsonStr = file_get_contents($jsonFile);
$data = json_decode($jsonStr);
msg("Using jsonFile: $jsonFile");

$dbConfFile = CommandLine::opt("dbConfFile", "database.php");
$dbConf = include($dbConfFile);
rb_init($dbConf);
msg("Using database config file: $dbConfFile");


if (is_array($data)) {
    foreach ($data as $key => $rowData) {
        rb_genTableByData($rowData);
    }
} else {
    rb_genTableByData($data);
}