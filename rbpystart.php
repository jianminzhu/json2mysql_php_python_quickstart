<?php
include_once("phpExtLib/rbext.php");
rb_init(include "database.php");
$jsonstr = '[{
  "paymentMethod": "CC",
  "priceAmount": "2.64",
  "priceCurrency": "EUR",
  "saleID": "18426319",
  "shopID": "115404",
  "type": "purchase",
  "signature": "ec0e2601184c1ca55376bcd95bcb0135a81c2c25"
}]';

$data = json_decode($jsonstr);
$id= rb_save("tt", $data[0]);