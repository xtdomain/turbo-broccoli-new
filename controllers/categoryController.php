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

    $pagination = $this->model->Pagination('category'); // Подключение пагинации
    $this->pageData['pagination'] = $pagination;

    $printTable = $this->printArrays($this->model->printTable()); //вывод информации в табличном виде
    $this->pageData['printTable'] = $printTable;

    $printDiv = $this->printArrays($this->model->printDiv()); //вывод информации в блочном виде
    $this->pageData['printDiv'] = $printDiv;
    $sortButton = $this->model->createSortButton('hiddenSortButton2');
  $this->pageData['sortButton'] = $sortButton;


    $this->view->render($this->pageTpl, $this->pageData);

  }

  public function page()
  {
    $this->default();
  }
}
?>
