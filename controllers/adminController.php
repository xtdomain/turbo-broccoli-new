<?php

require_once("defaultController.php");
require_once("models/defaultModel.php");
class adminController extends Controller {
  private $pageTpl = "/views/admin.tpl.php";
  public function __construct() {
    $this->model = new adminModel();
    $this->view = new View();
    $this->pageData['title'] = "Администрирование";

      if(!$_SESSION['user']) {
        header("Location: /");
    }

          $this->pageData['error'] = "Привет, ". $_SESSION['user'];

}





public function default() {
  
$this->view->render($this->pageTpl, $this->pageData);
}



public function out() {
 session_destroy();
 header("Location: /");
}
}
?>
