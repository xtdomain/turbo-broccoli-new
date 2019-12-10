<?php
class Controller {
  public $model;
  public $view;
  public static $pageData2;
  public static $pageData = array();
  public static function sab($h) { //не нужно
    self::$pageData = static::$pageData;
    return $h;
  }
  public function user_account() { //Аккаунт пользователя
    if (!empty($_POST['login'] && $_POST['password']))
    {
      if(!$this->login())
      {
        $this->pageData['error'] = $this->model->message;
      }
    }
    else
    {
      $this->pageData['error'] = 'Войти';
    }
  }
  public function __construct()
  {
    $this->model = new Model();
    $this->view = new View();
  }

  public function infos($save, $g)
  {
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
    return $h;
  }

  public function login()
  {
    if (!$this->model->checkUser())
    {
      return false;
    }
  }
}
?>
