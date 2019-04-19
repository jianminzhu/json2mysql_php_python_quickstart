<?php
include_once "rb.php";
/**
 * @param $dbConf { 'hostname' => '127.0.0.1',
 * 'database' => 'test',
 * 'username' => 'root',
 * 'password' => 'root',}
 *
 *
 */
function rb_init($dbConf)
{
    $hostname = $dbConf["hostname"];
    $database = $dbConf["database"];
    $username = $dbConf["username"];
    $password = $dbConf["password"];
    R::setup("mysql:host=$hostname;dbname=$database", $username, $password);
}

function rbSqlacodegen($dbConf, $batName = "sqlacodegen_models.bat", $modelFileName = "models.py")
{
    $hostname = $dbConf["hostname"];
    $database = $dbConf["database"];
    $username = $dbConf["username"];
    $password = $dbConf["password"];
    $hostport = $dbConf["hostport"];
    file_put_contents($batName, "set py_home=%userprofile%\AppData\Local\Programs\Python\Python37\
set path=%py_home%;%py_home%\Scripts;%path%
sqlacodegen mysql+mysqldb://$username:$password@$hostname:$hostport/$database >$modelFileName
");
}

/**
 * @param $rowData
 * @param $tableNameKey
 */
function rb_genTableByData($rowData, $tableNameKey = "__tablename__")
{
    $tableName = ((array)$rowData)[$tableNameKey];
    if ($tableName) {
        $rowData = delKey($rowData, $tableNameKey);
        rb_save($tableName, $rowData);
        msg("gen table $tableName success");
    } else {
        echo "tableName not set";
    }
}

function rb_save($tableName, $data)
{
    $p = rbObject($tableName, $data);
    return R::store($p);
}

/**
 * @param $tableName
 * @param $data
 * @return array|\RedBeanPHP\OODBBean
 */
function rbObject($tableName, $data)
{
    $p = R::dispense($tableName);
    foreach ($data as $key => $value) {
        $p[$key] = $value;
    }
    return $p;
}

function object2array($array)
{
    if (is_object($array)) {
        $array = (array)$array;
    }
    if (is_array($array)) {
        foreach ($array as $key => $value) {
            $array[$key] = object2array($value);
        }
    }
    return $array;
}