<?php
session_start();
class goodsModel extends Model {

  public static $id = idG; //здесь указываем поле по которому считаем количество записей БД (нужно для пагинации)

  public $maxNotes = 1; //отработать ошибки - если не показывать все товары - и использовать фильтр - товары могут отсутствовать!
  public static $result;
  public static $result2;

  public function goods_tables_selected_category() //отдельный метод для сессии - после выбора категории отображаются только товары категории,
  { //однако на главной странице сессия не нужна, поэтому там вызывается следующий метод (см. ниже)
    if (isset($_POST['myForm']))
    {
      $_SESSION['myForm'] = $_POST['myForm'];
      $url = (parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
      header("Location: $url");
    }
    $m = $_SESSION['myForm'];
    $p = 0;
    $result = self::goods_table(name, $p, $m, 'num', 'hiddenSortButtonSelected');
    self::$result = $result;
    return $result;
  }

  public function goods_tables() //$m - автоматически подставляет выбраную категорию, $p для автоматизации: в товарах есть пагинация, но после фильтра пагинации не будет
  {
    $p = 1;
    $m = 0;
    $result = self::goods_table(name, $p, $m, 'num', 'hiddenSortButton'); // 1) группировка по name (наименование товара); 2) еслы выбрана категория - отключить пагинацию;
    self::$result = $result; // 3) ограничение where - где категория равна $_POST['myForm'] 4) использовать кнопку сортировки и дать ей имя 'hiddenSortButton';
    return $result;
  }

  public function goods_tables2() //Дополнительный запрос в БД - нужен для 1) красивой нумерации таблиц, всегда по порядку без пропуска цифр, от единицы 2) ограничения вывода информации после фильтра
  {

    $result = self::goods_table(name, 0, 0, 'num', 'hiddenSortButton');
    self::$result2 = $result;
    return $result;
  }
  public function printTable()
  {
    $massiv = [];
    $massiv[$key] = "
    <table  border='1' width='100%' cellpadding='5'>
      <thead>
        <tr>
          <th>Номер</th>
          <th>Название товара</th>
        </tr>
      </thead>
      <tbody>
      ";

      foreach(static::$result as $key => $value)
      {
        $massiv[$key] .= "
        <tr>
          <td>{$value[num]}</td>
        ";
        foreach(static::$result2 as $key => $value2) if ($value['name'] == $value2['name'])
        {
        /*  print_r(static::$result2);
          echo "<br>";
          echo "<br>";
          print_r(static::$result);
          exit;*/
          $massiv[$key] .= "
          <td><a href='{$this->onlyTemplate()}/table/{$value2[num]}'>{$value[name]}</a></td>
          ";
        }
      }
      $massiv[$key] .= "
        </tr>
      </tbody>
    </table>";
    return $massiv;
  }

  public function printDiv()
  {
$massiv = [];
    foreach(static::$result as $key => $value)
      {

        $massiv[$key] = "
        <div>
        <hr class='group_linie'>
          <div class='DivVisual'>
          <h1 align='center'>Номер: $value[num]</h1>
          <hr>
          ";
          foreach(static::$result2 as $key => $value2) if ($value['name'] == $value2['name']) {
            $massiv[$key] .= "
            <p>Название товара: <b><a href='{$this->onlyTemplate()}/table/$value2[num]' class='goods_name_color'>$value[name]</a></b><hr></p></div><hr class='group_linie'></div>";
          }
    }
    return $massiv;
  }

}
?>
