<?php
class adminController extends Controller{
  private $pageTpl = "/views/admin.tpl.php";
  public function __construct()
  {
    $this->model = new adminModel();
    $this->view = new View();
    $this->pageData['title'] = "Администрирование";
    if(!$_SESSION['user'])
    {
      header("Location: /");
    }
    $this->pageData['error'] = "Привет, ". $_SESSION['user'];
  }

  public function default()
  {
    $account = $this->model->account();
    $this->pageData['account'] = $account; //Подключение вида и модели регистрации
    View::render($this->pageTpl, $this->pageData);
  }

  public function page()
  {
    $this->default();
  }

  public static function out()
  {
    session_destroy();
    header("Location: /");
  }
}
?>
