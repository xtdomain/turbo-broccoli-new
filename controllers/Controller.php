<?php
class Controller {
  public $model;
  public $view;
  protected $pageData = array();
  public function user_account() {

          if (!empty($_POST['login'] && $_POST['password'])) {
          if(!$this->login()) {
                  $this->pageData['error'] = $this->model->message;
      }
    } else {
                  $this->pageData['error'] = 'Войти';
    }
  }

  public function __construct() {
    $this->view = new View();
    $this->model = new Model();


  }
  public  function infos($save){
  $this->model->actions=$save;

  Model::check($save);
  $this->pageData['save'] = $save; //автоматизация - url теперь будет равен наименованию контроллера

//print_r($this->pageData['save']);



    $saveUrlBefore = $this->model->saveUrlBefore();
    $this->pageData['saveUrlBefore'] = $saveUrlBefore;
    $saveUrlAfter = $this->model->saveUrlAfter();
    $this->pageData['saveUrlAfter'] = $saveUrlAfter;


  }




public function Contr(){

}
public function login() {
  if(!$this->model->checkUser()){
    return false;
  }
}
}
?>
