<?php
class goodsModel extends Model {
  public static $id = idG; //здесь указываем поле по которому считаем количество записей БД (нужно для пагинации)
//public static $whereName; //хранит имя поля группировки - для того чтобы после фильтра показывать только записи конкретной категории (+корректная пагинация)
  public $maxNotes = 1; //отработать ошибки - если не показывать все товары - и использовать фильтр - товары могут отсутствовать!
public static $result;
public static $result2;
  public function goods_tables($m) //$m - автоматически подставляет выбраную категорию, $p для автоматизации: в товарах есть пагинация, но после фильтра пагинации не будет
  {
    self::$whereName = $m;
    if (empty($_POST['myForm']))
    {
      $p = 1;
    }
    else
    {
      $p = 0;
    }
    $result = self::goods_table(name, $p, $m);
    self::$result = $result;
    return $result;
  }

  public function goods_tables2() //Дополнительный запрос в БД - нужен для 1) красивой нумерации таблиц, всегда по порядку без пропуска цифр, от единицы 2) ограничения вывода информации после фильтра
  {
    if (empty($_POST['myForm']))
    {
      $p = 1;
    }
    else
    {
      $p = 0;
    }
    $result = self::goods_table(name, 0, 0);
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
          foreach(static::$result2 as $key => $value2) if ($value['name'] == $value2['name']) {
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
    foreach(static::$result as $key => $value)
      {
        $massiv[$key] = "
          <div class='DivVisual'>
          <h1 align='center'>Номер: $value[num]</h1>
          <hr>
          ";
          foreach(static::$result2 as $key => $value2) if ($value['name'] == $value2['name']) {
            $massiv[$key] .= "
            <p>Название товара: <b><a href='{$this->onlyTemplate()}/table/$value2[num]' class='goods_name_color'>$value[name]</a></b></p><hr></div>";
          }

    }
    return $massiv;
  }
}
?>
