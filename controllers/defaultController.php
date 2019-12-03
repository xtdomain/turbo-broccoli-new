<?php
class defaultController extends Controller {
private $pageTpl = '/views/main.tpl.php';
public function __construct() {
$this->model = new defaultModel();
$this->view = new View();
$this->pageData['title'] = "Главная";
}

public function default() {
$this->user_account();
  $account = $this->model->account();
  $this->pageData['account'] = $account; //Подключение вида и модели регистрации




  //$a = new goodsModel();
  //$a->default();
  //goodsModel::default();
  $this->view->render($this->pageTpl, $this->pageData);

//  $this->new();
}


public function new() {
  require_once("models/goodsModel.php");
  require_once("controllers/goodsController.php");
  $a = new goodsController();
  $a->default();


}





}
 ?>
