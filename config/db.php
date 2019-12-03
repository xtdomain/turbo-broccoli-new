<?php
class dataBase{
  const USER = "root";
  const PASS = '';
  const HOST = "localhost";
  const DB = "catalog-site";
  const CH = 'utf8';

  public static function DB_connection() {
    $user = self::USER;
    $pass = self::PASS;
    $host = self::HOST;
    $db = self::DB;
    $charset = self::CH;



$conn = new PDO('mysql:host=localhost;dbname='. $db .';charset='. $charset, $user, $pass);

  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
return $conn;

  }
}
?>
