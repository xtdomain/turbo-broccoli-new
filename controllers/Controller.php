<?php
class Controller {
  public $model;
  public $view;
  public static $getControllerName = array();
  public static $getControllersName = array();
  public static $pageData = array();

  static public function getControllerName($numer = 0) //метод автоматически вычисляет имя шаблона
  {
    $getClass = get_called_class();
    array_push(static::$getControllerName, $getClass); //добавить в массив все контроллеры
    $str = substr(static::$getControllerName[$numer],0,-10); //выброть первый элемент (предполагается, что на первом месте всегда шаблон) и удалить слово Controller
    $content = new Route();
    $content->startRoute($str);
  }



  public function user_account() { //Аккаунт пользователя
    $this->pageData['error'] = $this->model->message;
    $this->model->checkUser();

    if (!empty($_POST['login'] && $_POST['password']))
    {
      $this->pageData['error'] = $this->model->error;
    }
  }
  public function __construct()
  {
    $this->model = new Model();
    $this->view = new View();

  //print_r(static::$pageData);
  }
  public function printArrays($massiv) {
//print_r($this->pageData);
$printArray = $this->model->printArray($massiv);
return $printArray;

}
  public function infos($save, $g)
  {

self::getControllerName(); // метод вычисляет имя шаблона

    //print_r($save);
    //static::sab($h = static::$pageData); //не нужно
    //$pageData2 = $h;
    Model::$actions = $save;
    Model::$controller = $g;

    $this->pageData['save'] = $save; //автоматизация - url теперь будет равен наименованию контроллера
    $saveUrlBefore = $this->model->saveUrlBefore();
    $this->pageData['saveUrlBefore'] = $saveUrlBefore;
    $saveUrlAfter = $this->model->saveUrlAfter();
    $this->pageData['saveUrlAfter'] = $saveUrlAfter;
    $onlyTemplate = $this->model->onlyTemplate();
    $this->pageData['onlyTemplate'] = $onlyTemplate;

  }


}
?>
