<?php
class Model {
  public static $id = 0; // на всякий случай - если в конкретной модели забыть указать $id (имя поля БД - нужно для пагинации)
  public static $whereName = 0;
  public static $actions; //получить из роутера наименование текущего контроллера
  public static $controller;
  //public $maxNotes = 1;
  public $message = 'Войти';
  public $error = 'Неверный логин и/или пароль';

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
    //$this->message = '$error';
    $login = $_POST['login'];
    $password = $_POST['password'];
    //$error = 'Неверный логин и/или пароль';
    //$check = 'Данные введены верно';
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

    } else {
      return false;
    }
  }

  public function __construct()
  {
    $this->db = dataBase::DB_connection();
  }

  public function count($id, $whereName)
  { //Посчитать количество записей в БД для пагинации
    if ($whereName != '0')
    {
      $where = "AND nameCat = '$whereName'";
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
    $pagesNumber = ceil($this->count($id = static::$id, $whereName = static::$whereName)/$this->maxNotes); //!!!обязательно позднее статическое связывание - чтобы взять параметр конкретной модели а не этой
    return $pagesNumber;
  }

  public function Pagination($name){
    $massiv = [];
    for ($i=1; $i<=$this->pagesNumber(); $i++) { //опираясь на функцию вычисления количества страниц - эта функция содержит уже готовые ссылки
      if($this->pagesNumber() > 1) {
        $massiv[$i] = "<a href='{$this->saveUrlBefore()}/$name/$i/{$this->saveUrlAfter()}'>$i</a>";
      }
    }
    $implodeMassiv = implode(" ", $massiv); //готовая к выводу строка пагинации
    return $implodeMassiv;
  }

  public function pageCalculate() //ОТ КАКОЙ ЦИФРЫ ПОКАЗЫВАТЬ ЗНАЧЕНИЯ БАЗЫ ДАННЫХ - ТОВАРЫ (LIMIT)
  {
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
  public function goods_table($groupName, $addLimit, $whereName) //группировка по имени или без (=str или =0), с лимитом или без (=1 или = 0), дополнительное ограничение (=str или =0)
  {
    if ($addLimit == 1)
    {
      $LIMIT = LIMIT;
      $mathc = $this->pageCalculate(). ","; //если включен лимит - добавляем лимит при запросе в БД, от текущей позиции
      $maxNotes = $this->maxNotes; //количество выводимых на экран запичей при пагинации
    }
    else
    {
      $LIMIT = '';
      $mathc = '';
      $maxNotes = '';
    }
    if ($whereName != '0')
    {
      $where = "AND nameCat = '$whereName'";
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
    GROUP BY $groupName) AS T
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
