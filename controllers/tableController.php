<?php
class tableController extends Controller {
  private $pageTpl = "/views/table_layout.tpl.php";
  public function __construct()
  {
    $this->model = new tableModel();
    $this->view = new View();
  }

  public function default()
  {
    $this->user_account();
    $goods_table = $this->model->goods_tables();  // Подключение таблицы товаров из БД
    $this->pageData['goods_table'] = $goods_table;

    $goods_table2 = $this->model->goods_tables2();  // Подключение таблицы товаров из БД
    $this->pageData['goods_table2'] = $goods_table2;

    //$pagination = $this->model->Pagination('table'); // Пагинация в категориях не нужна - не удалил только для показа наглядной работы метода пагинации
    //$this->pageData['pagination'] = $pagination;

    $printTable = $this->printArrays($this->model->printTable()); //вывод информации в табличном виде
    $this->pageData['printTable'] = $printTable;

    $printDiv = $this->printArrays($this->model->printDiv()); //вывод информации в блочном виде
    $this->pageData['printDiv'] = $printDiv;

    $this->view->render($this->pageTpl, $this->pageData);
  }

  public function page()
  {
    $this->default();
  }
}
?>
