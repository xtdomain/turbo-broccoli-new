<?php
class Model {
    public static $actions;
  //public $maxNotes = 1;
  public $message = '1234';


public static function check($save) {
  self::$actions = $save;

  //print_r($save); (результат goods и category)
}

public static function saveUrlBefore() {
$url = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)); //сохранить url до контроллера, $pageData['save'] - это url контроллера
foreach($url as $key => $value){
if (($value == Model::$actions)) {
 $param = $key;
 $param2 = $key+1;
 unset($urlT[$param]);
 unset($urlT[$param2]);
}
if ($param != 0) {
 unset($url[$key]);
}
}
$url2 = implode("/",$url);

return $url2;

}


public function saveUrlAfter() {
  $urlT = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));



  foreach($urlT as $key => $value2){
  if ($value2 == Model::$actions) {
    $param = $key;
    $param2 = $key+1;

    unset($urlT[$param]);
    unset($urlT[$param2]);

  }

  if ($param == 0) {

   unset($urlT[$key]);

}
  }

  $urlT2 = implode("/",$urlT);


return $urlT2;
}










  public function checkUser() {

    $this->message = '$error';
    $login = $_POST['login'];
    $password = $_POST['password'];
    $error = 'Неверный логин и/или пароль';
    $check = 'Данные введены верно';

    $sql = "SELECT * FROM users WHERE login = :login AND password = :password";

    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(":login", $login, PDO::PARAM_STR);
    $stmt->bindValue(":password", $password, PDO::PARAM_STR);
    $stmt->execute();

    $res = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!empty($res)){
        $_SESSION['user'] = $_POST['login'];
      header('Location: /admin');
      $this->message = "Привет, ". $login;
      echo $message;
    } else {
  $this->message = $error;
      echo $message;
      return false;

    }
  }
  public function __construct() {

//print_r(Model::$actions);
    $this->db = dataBase::DB_connection();
  }
  public function pagesNumber() {
  $pagesNumber = ceil($this->count()/$this->maxNotes);
  return $pagesNumber;
 }

  public function pageCalculate() {                                                             //ОТ КАКОЙ ЦИФРЫ ПОКАЗЫВАТЬ ЗНАЧЕНИЯ БАЗЫ ДАННЫХ - ТОВАРЫ (LIMIT)
    $url = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

    foreach ($url as $key => $value) {

      if ($value == Model::$actions) {

        if (is_numeric($url[$key+1])) {
          $result = $url[$key+1];
            if(!empty($result)) {
          //print_r($url[$key+1]);
        }
      } else {$result = 1;
      }
    }
    }
      $math = ($result-1)*$this->maxNotes;

    return $math;
  }
  public function goods_table($s, $t, $n) {

  if ($t == 1) {
    $LIMIT = LIMIT;
    $mathc = $this->pageCalculate(). ",";
    $maxNotes = $this->maxNotes;
  } else {
    $LIMIT = '';
    $mathc = '';
    $maxNotes = '';
  }
  if ($n != '0') {
$where = "AND nameCat = '$n'";
} else {
  $where = '';
}


    $sql = "SELECT DISTINCT @n:=@n+1 as `num`, idG, name, idB, idCat, nameCat, id_category, id_goods, short_description, full_description, disposal, activity, activityG from

    (select DISTINCT @n:=0, idG, name, base.idB, idCat, nameCat, base.id_category, base.id_goods, goods.short_description, goods.full_description, goods.disposal, category.activity, goods.activityG
    FROM base

    INNER JOIN category on base.id_category = category.nameCat
    INNER JOIN goods on base.id_goods = goods.name
    WHERE category.activity='1' AND goods.activityG='1' $where
    GROUP BY $s) AS T

    ORDER BY num

    $LIMIT $mathc $maxNotes
    ";
     $result = array();
     $stmt = $this->db->prepare($sql);
     $stmt->execute();
     while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
       $result[$row['idB']] = $row;
     }
     return $result;

  }
}
?>
