<?php
class Model {
  public static $countPage = 1;
  public static $pagesNumber = 1;
  public static $id = 0; // на всякий случай - если в конкретной модели забыть указать $id (имя поля БД - нужно для пагинации)

  public static $actions; //получить из роутера наименование текущего контроллера
  public static $controller;//получить из роутера наименование текущего шаблона
  public static $controller2;//получить из роутера наименование текущего шаблона
  public static $getModelName = array();
  //public $maxNotes = 1;
  public $message = 'Войти';
  public $error = 'Неверный логин и/или пароль';

  public static function printArray($massiv) { //вывести массив в строку
    if (!empty($massiv)) {
      $implodeMassiv = implode(" ", $massiv);
      return $implodeMassiv;
    }
  }

  static public function getModelName()
  {
  $getClass = get_called_class();
  array_push(static::$getModelName, $getClass); //добавить в массив все контроллеры
  foreach (static::$getModelName as $key => $value) {
    $str = substr($value,0,-5);
    print_r($value);
    return $str;
  }

}


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
    //print_r($url2);
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

array_unshift($urlT, "");

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

  public function count($id, $limit = "WHERE goods.activityG='1' AND category.activity='1'") //стандартно записи лимитированы по активности
  { //Посчитать количество записей в БД для пагинации

      $where = '';

    $sql = "SELECT COUNT(DISTINCT $id) AS qty
    FROM base
    INNER JOIN category on base.id_category = category.nameCat
    INNER JOIN goods on base.id_goods = goods.name
 $limit $where
    ";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    $res = $stmt->fetchColumn();
    return $res;
  }

  public function pagesNumber() //количество страниц
  {
    $route = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    if ($this->maxNotes > 0)
    {

      if ($route[1] != 'admin') { //если в стандартной части - НЕ считать записи среди неактивных товаров и категорий
        $pagesNumber = ceil($this->count($id = static::$id)/$this->maxNotes); //!!!обязательно позднее статическое связывание - чтобы взять параметр конкретной модели а не этой
      }
      else
      { //если в админской части - считать записи среди неактивных товаров и категорий
        $pagesNumber = ceil($this->count($id = static::$id, "WHERE goods.activityG='1' OR category.activity='0' OR goods.activityG='0' AND category.activity='1'")/$this->maxNotes);
      }
    }
    else
    {
      Route::CallErrors(); //деление на 0
    }
    return $pagesNumber;
  }

  public function Pagination()
  {
  $getClass = get_called_class();
    $str = substr($getClass,0,-5);
    $name =   $str;


  static::$controller2=$name;
    $massiv = [];
    for ($i=1; $i<=$this->pagesNumber(); $i++) //опираясь на функцию вычисления количества страниц - эта функция содержит уже готовые ссылки
    {
      if($this->pagesNumber() > 1)
      {
        $color = 'black';
        $background = '#D3D3D3';
        $activate = 'auto';
        if ($i == static::$countPage)
        {
          $color = '#8B0000'; $background = '#DEB887'; $activate = 'none';
        } //$i(здесь предполагается символ /){$this->saveUrlAfter()} - символ / проставляется в методе ранее если требуется
        $massiv[$i] = "<div class='paginationPhp' style='pointer-events:$activate;'><a href='{$this->saveUrlBefore()}/$name/$i{$this->saveUrlAfter()}' class='a_paginationPhp' style='color: $color; background: $background; '>$i</a></div>";
      }
    }
    $implodeMassiv = implode(" ", $massiv); //готовая к выводу строка пагинации
    //print_r((parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)));
    return $implodeMassiv;
  }

  public function pageCalculate($mode = 'math') //ОТ КАКОЙ ЦИФРЫ ПОКАЗЫВАТЬ ЗНАЧЕНИЯ БАЗЫ ДАННЫХ - ТОВАРЫ (LIMIT)
  {
    $url = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    foreach ($url as $key => $value)
    {
      if ($value == Model::$actions)
      {
        if (is_numeric($url[$key+1]))
        {
          $result = $url[$key+1]; //номер страницы текущего контроллера
          if ($result == 0 || $result>$this->pagesNumber())
          {
            Route::CallErrors(); //страница с номером 0 или превышение количества страниц
          }
          self::$countPage = $result;

        }
        else
        {
          $result = 1;
        }
      }
    }
    $math = ($result-1)*$this->maxNotes; //(номер страницы - 1) * кол-во записей
    if ($mode = 'math') {
    return $math;
  } else if ($mode = 'page') {

    return self::$countPage;
  }
  }

  public function goods_table($groupName, $addLimit, $where = "WHERE category.activity='1' AND goods.activityG='1'", $order = 'num',  $ASC = 'ASC', $Function = 'SELECT', $JOIN = "INNER JOIN category on base.id_category = category.nameCat INNER JOIN goods on base.id_goods = goods.name", $column = "idG, name, idB, idCat, nameCat, id_category, id_goods, short_description, full_description, quantity, disposal, activity, activityG", $table = 'base') //группировка по имени или без (=str или =0), с лимитом или без (=1 или = 0), дополнительное ограничение (=str или =0)
  {

    //print_r($groupName);
    if ($groupName !== 0) {
      $group = 'GROUP BY';
      $group2 = $groupName;
    }  else {
        $group = '';$group2 = '';
        //print_r($groupName);

    }
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

    $route = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)); //если в админской части - показывать даже неактивные товары и категории
      if ($route[1] == 'admin') {
        if ($where === 'ALL')
        {
          $whereName = "";
        }
        else if ($where != '0') {
          $whereName = "WHERE nameCat = '$where'";
        } else {
          $whereName = "";
        }
  } else { //если в стандартной части - скрывать неактивные товары и категории

    if ($where === 'ALL')
    {
      $whereName = "WHERE category.activity='0' OR goods.activityG='1' OR goods.activityG='0' OR category.activity='1'";
    }

    else if ($where != '0')
    {
      $whereName = "WHERE category.activity='1' AND goods.activityG='1' AND nameCat = '$where'";
    }
    else
    {
      $whereName = "WHERE category.activity='1' AND goods.activityG='1'";
    }


}

    if ($ASC != 'ASC' && $ASC != 'DESC')
    {
      $buttonName = $ASC;
      $ASC = $this->sortButton($buttonName);
    }

    $sql = "{$Function} @n:=@n+1 as `num`, $column from
    ({$Function} @n:=0, $column
    FROM $table
    $JOIN
    $whereName

    $group $group2) AS T
    ORDER BY $order $ASC
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

  public function goods_simple_table($table, $columnId = '', $column2 = '') //построение простого запроса
  {
    $sql = "SELECT $columnId, $column2
    FROM $table
    ";
    $result = array();
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
    {
      $result[$row[$columnId]] = $row;
    }
    return $result;
  }


  public function sortButton($buttonName)
  {
    if ($_SESSION[$buttonName] == 'ASC' || $_SESSION[$buttonName] == 'DESC')  //проверка на случай ошибок
    {
      $ASC = $_SESSION[$buttonName];
    }
    else
    {
      $_SESSION[$buttonName] = '';
    }
    if (isset($_POST[$buttonName]))
    {
      if ($_POST[$buttonName] == 'DESC')
      {
        $_SESSION[$buttonName] = 'ASC';
      }
      else if ($_POST[$buttonName] == 'ASC')
      {
        $_SESSION[$buttonName] = 'DESC';
      }
      $url = (parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
      header("Location: $url");
    }
    return $ASC;
  }
  public function createSortButton($buttonName)
  {
    if (!empty($_SESSION[$buttonName]))
    {
      $a = $_SESSION[$buttonName];
      $s = '&#9650';
      if ($a == 'DESC')
      {
      $s = '&#9660';
      }
    }
    else
    {
      $a = "ASC";
      $s = '&#9650';
      if ($a == 'DESC')
      {
      $s = '&#9660';
      }
    }
    if ($this->count($id = static::$id)>1) //Новое условие - кнопка сортировки появится при наличии хотя бы 2-х записей
    {
      $url = (parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
      $form = "
        <div class='pagination'>
          <form name='sortButton' action='$url' method='post'>
            <input type='hidden' name='$buttonName' value=$a />
            <input name='sortButton' type='submit'  value='Сортировать $s' class='paginationPhp' style='color: #8B0000; background: #DEB887; width:120px;'/>
          </form>
        </div>";
      return $form;
    }
  }
}
?>
