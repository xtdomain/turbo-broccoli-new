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
    if (!empty($_POST['myForm']))
    {
      self::$m = "$_POST[myForm]"; // категория, которая выбрана в tableController
    }
    else
    {
      self::$m = 0;
    }
    $goods_table = $this->model->goods_tables(self::$m);  // Подключение таблицы товаров из БД
    $this->pageData['goods_table'] = $goods_table;

    $goods_table2 = $this->model->goods_tables2();  // Подключение таблицы товаров из БД
    $this->pageData['goods_table2'] = $goods_table2;




    if (empty($_POST['myForm']))
    {
    $pagination = $this->model->Pagination('goods'); // Подключение пагинации (после выбора категории пагинацию не отображать)
    $this->pageData['pagination'] = $pagination;
}

    $this->view->render($this->pageTpl, $this->pageData);
  }

  public function page(){
    $this->default();
  }
}
?>
