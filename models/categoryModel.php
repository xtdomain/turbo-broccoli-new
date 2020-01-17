<?php
class categoryModel extends Model {
  public static $id = idCat; //здесь указываем поле по которому считаем количество записей БД (нужно для пагинации)
  public $maxNotes = 1;
  public static $result;
  public function goods_tables()
  {
    $result = self::goods_table(nameCat, 1, 0, 'num', 'hiddenSortButton2');
    self::$result = $result;
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
          <th>Название категории</th>
        </tr>
      </thead>
      <tbody>
      ";
      foreach(static::$result as $key => $value)
      {
        $massiv[$key] = "
          <tr>
          <td>{$value['num']}</td>
          <td>{$value['nameCat']}</td>
          </tr>";
        }
        $massiv[$key] .= "
        </tbody>
      </table>
      ";
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
          <p>Название категории: <b class='category_name_color'>$value[nameCat]</b><hr></p></div><hr class='group_linie'></div>
        ";
    }
    return $massiv;
  }
}
?>
