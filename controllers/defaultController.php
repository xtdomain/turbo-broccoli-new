<?php
class defaultController extends Controller {
  private $pageTpl = '/views/main.tpl.php';
  public function __construct() {
    $this->model = new defaultModel();
    $this->view = new View();
    $this->pageData['title'] = "Главная";
  }

  public function default()
  {
    $this->user_account();
    $account = $this->model->account();
    $this->pageData['account'] = $account; //Подключение вида и модели регистрации
    $this->view->render($this->pageTpl, $this->pageData);
  }

  public function page()
  {
  //
  }
}
 ?>
