<?php
class categoryController extends Controller {
  private $pageTpl = "/views/category_layout.tpl.php";
  public function __construct()
  {
    $this->model = new categoryModel();
    $this->view = new View();
  }

  public function default()
  {
    $goods_table = $this->model->goods_tables();  // Подключение таблицы товаров из БД
    $this->pageData['goods_table'] = $goods_table;

    $pagesNumber = $this->model->pagesNumber(); // Подключение пагинации
    $this->pageData['pagesNumber'] = $pagesNumber;

    $this->view->render($this->pageTpl, $this->pageData);
  }

  public function page()
  {
    $this->default();
  }
}
?>
