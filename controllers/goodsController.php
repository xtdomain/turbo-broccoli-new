<?php
class goodsController extends Controller {
  public static $m;
  private $pageTpl = "/views/goods_layout.tpl.php";
  public function __construct()
  {
    $this->model = new goodsModel();
    $this->view = new View();


  }

  public function default()
  {

    $goods_table = $this->model->goods_tables();  // Подключение таблицы товаров из БД
    $this->pageData['goods_table'] = $goods_table;

    $goods_table2 = $this->model->goods_tables2();  // Подключение таблицы товаров из БД
    $this->pageData['goods_table2'] = $goods_table2;


    $pagination = $this->model->Pagination(); // Подключение пагинации (после выбора категории пагинацию не отображать)

    $this->pageData['pagination'] = $pagination;

    $printTable = $this->printArrays($this->model->printTable()); //вывод информации в табличном виде
    $this->pageData['printTable'] = $printTable;

    $printDiv = $this->printArrays($this->model->printDiv()); //вывод информации в блочном виде
    $this->pageData['printDiv'] = $printDiv;
    $sortButton = $this->model->createSortButton('hiddenSortButton');
    $this->pageData['sortButton'] = $sortButton;

    $this->view->render($this->pageTpl, $this->pageData);
  }

  public function page()
  {
    $this->default();
  }

  public function selected_category() //Если выбрана категория то страница будет отображаться немного иначе, пагинация не нужна, один метод заменяется
  {
    $goods_table_selected_category = $this->model->goods_tables_selected_category();  // Замененный метод - Подключение таблицы "отобраных по категории" товаров из БД
    $this->pageData['goods_table_selected_category'] = $goods_table_selected_category;

    $goods_table2 = $this->model->goods_tables2();  // Подключение таблицы товаров из БД
    $this->pageData['goods_table2'] = $goods_table2;

    $printTable = $this->printArrays($this->model->printTable()); //вывод информации в табличном виде
    $this->pageData['printTable'] = $printTable;

    $printDiv = $this->printArrays($this->model->printDiv()); //вывод информации в блочном виде
    $this->pageData['printDiv'] = $printDiv;
    $sortButton = $this->model->createSortButton('hiddenSortButtonSelected'); //Также создаем новую кнопку сортировки - чтобы сортировка внутри избранной категории
    $this->pageData['sortButton'] = $sortButton; // не влияла на сортировку в списках товаров(список товаров отражается еще и на стартовой странице)

    $this->view->render($this->pageTpl, $this->pageData);
  }
}
?>
