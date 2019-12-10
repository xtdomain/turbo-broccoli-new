<?php
class Model {
  public static $id = 0; // на всякий случай - если в конкретной модели забыть указать $id (имя поля БД - нужно для пагинации)
  public static $n = 0;
  public static $actions; //получить из роутера наименование текущего контроллера
  public static $controller;
  //public $maxNotes = 1;
  public $message = '1234';

  public static function saveUrlBefore()
  {
    $url = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)); //сохранить url до контроллера, в видах/шаблонах $pageData['save'] - это url контроллера
    foreach ($url as $key => $value) {
      if (($value == Model::$actions))
      {
        $param = $key;
        $param2 = $key+1;
        unset($urlT[$param]); //удалить имя контроллера и действия после него
        unset($urlT[$param2]);
      }
      if ($param != 0) //удалить все, что за контроллером
      {
        unset($url[$key]);
      }
    }
    $url2 = implode("/", $url); //получаем ссылку (все что до контроллера)
    return $url2;
  }

  public function onlyTemplate() //Не сохраняет путь, но сохраняет шаблон (например admin - чтобы все виды загружались так admin/Контроллер/Действие)
  {
    $urlT = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    foreach ($urlT as $key => $value) {
      $name = Model::$controller;
      if ($value == $name)
      {
        $a = "/$name";
      }
      unset($urlT[$key]);
    }
    array_unshift($urlT, $a);
    $urlT2 = implode("/",$urlT);
    return $urlT2;
  }

  public function saveUrlAfter()
  {
    $urlT = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    foreach ($urlT as $key => $value2) {
      if ($value2 == Model::$actions)
      {
        $param = $key;
        $param2 = $key+1;
        unset($urlT[$param]);
        unset($urlT[$param2]);
      }
      if ($param == 0)
      {
        unset($urlT[$key]);
      }
    }
    $urlT2 = implode("/",$urlT);
    return $urlT2;
  }

  public function checkUser()
  {
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
    if (!empty($res))
    {
      $_SESSION['user'] = $_POST['login'];
      header('Location: /admin');
      $this->message = "Привет, ". $login;
      echo $message;
    }
    else
    {
      $this->message = $error;
      echo $message;
      return false;
    }
  }

  public function __construct()
  {
    $this->db = dataBase::DB_connection();
  }

  public function count($id, $n)
  { //Посчитать количество записей в БД для пагинации
    if ($n != '0')
    {
      $where = "AND nameCat = '$n'";
    }
    else
    {
      $where = '';
    }
    $sql = "SELECT COUNT(DISTINCT $id) AS qty
    FROM base
    INNER JOIN category on base.id_category = category.nameCat
    INNER JOIN goods on base.id_goods = goods.name
    WHERE goods.activityG='1' AND category.activity='1' $where
    ";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    $res = $stmt->fetchColumn();
    return $res;
  }

  public function pagesNumber()
  {
    $pagesNumber = ceil($this->count($id = static::$id, $n = static::$n)/$this->maxNotes); //!!!обязательно позднее статическое связывание - чтобы взять параметр конкретной модели а не этой
    return $pagesNumber;
  }

  public function pageCalculate()
  {                                                             //ОТ КАКОЙ ЦИФРЫ ПОКАЗЫВАТЬ ЗНАЧЕНИЯ БАЗЫ ДАННЫХ - ТОВАРЫ (LIMIT)
    $url = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    foreach ($url as $key => $value) {
      if ($value == Model::$actions)
      {
        if (is_numeric($url[$key+1]))
        {
          $result = $url[$key+1];
          /*if(!empty($result))
          {
            print_r($url[$key+1]);
          }*/
        }
        else
        {
          $result = 1;
        }
      }
    }
    $math = ($result-1)*$this->maxNotes;
    return $math;
  }
  public function goods_table($s, $t, $n)
  {
    if ($t == 1)
    {
      $LIMIT = LIMIT;
      $mathc = $this->pageCalculate(). ",";
      $maxNotes = $this->maxNotes;
    }
    else
    {
      $LIMIT = '';
      $mathc = '';
      $maxNotes = '';
    }
    if ($n != '0')
    {
      $where = "AND nameCat = '$n'";
    }
    else
    {
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
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $result[$row['idB']] = $row;
    }
    return $result;
  }
}
?>
