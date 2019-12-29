<?php
class tableModel extends Model {
  public static $id = idG; //здесь указываем поле по которому считаем количество записей БД (нужно для пагинации)
  public $maxNotes = 1;
public static $result;
public static $result2;

  public function goods_tables()
  {
                                              //создать запрос в базу данных 1. указать группировку(например 'name' из таблицы товаров) 2. указать LIMIT: 0 - показывать все, 1 - постранично
    $result = self::goods_table(name, 1, 0); //3. указать дополнительное ограничение where - товары только этой категории, где 0 - отключить, а любой текст соответствует наименованию категории
self::$result = $result;
    return $result;
  }

  public function goods_tables2()
  {
    $g = 'name, nameCat';
    $result = self::goods_table($g, 0, 0);
    self::$result2 = $result;
    return $result;
  }
  public function printTable()
  {
    $massiv = [];
    $massiv[$key] =
    "
    <table  border='1' width='100%' cellpadding='5'>
      <thead>
        <tr>
          <th>Номер</th>
          <th>Название товара</th>
          <th>Категория товара</th>
          <th>Краткое описание</th>
          <th>Полное описание</th>
          <th>Возможность заказа</th>
          <th>Заказать</th>
        </tr>
      </thead>
  		<tbody>
      ";
      foreach(static::$result as $key => $value)
      {
        $massiv[$key] = "
        <tr>
          <td>$value[num]</td>
          <td>$value[name]</td>
          <td>
            <ul>";
            foreach(static::$result2 as $key => $value2) if ($value['name'] == $value2['name'])
            {
              $massiv[$key] .= "
              <li>
                <form name='myForm' method='post' action='{$this->onlyTemplate()}/goods/1'>
                  <input type='submit' name='myForm' value='$value2[nameCat]'>
                </form>
              </li>";
            }
            $massiv[$key] .= "
            </ul>
          </td>
          <td>$value[short_description]</td>
          <td>$value[full_description]</td>
          <td>$value[disposal]</td>";
          if ($value['disposal'] > 0)
          {
            $massiv[$key] .= "
            <td><button type='submit'>Заказать</button></td>";
          }
          $massiv[$key] .=  "
        </tr>";
      }
      $massiv[$key] .= "
      </tbody>
      </table>
      ";
    return $massiv;
  }
/*$pageData[saveUrlBefore]/goods/1/$pageData[saveUrlAfter] - старый метод некорректный, тк pagedata вызывается только в видах, и не нужно сохранять весь путь при фильтрации данных*/
/*{$this->onlyTemplate()}/goods/1 - новый метод*/
  public function printDiv()
  {

      foreach(static::$result as $key => $value)
      {
        $massiv[$key] = "
        <div class='DivVisual'>
          <h1 align='center'>Номер: $value[num]</h1>
          <hr>
          <p>Название товара: <b class='category_name_color'>$value[name]</b></p>
          <p>Название категории: </p>
          ";
            foreach(static::$result2 as $key => $value2) if ($value['name'] == $value2['name'])
            {
              $massiv[$key] .= "

                <form name='myForm' method='post' action='{$this->onlyTemplate()}/goods/1'>
                  <input type='submit' name='myForm' value='$value2[nameCat]'>
                </form>
              ";
            }
            $massiv[$key] .= "
          <p>Краткое описание: <b class='category_name_color'>$value[short_description]</b></p>
          <p>Полное описание: <b class='category_name_color'>$value[full_description]</b></p>
          <p>Возможность заказа: <b class='category_name_color'>$value[disposal]</b></p>
          ";
          if ($value['disposal'] > 0)
          {
            $massiv[$key] .= "
            <p><button type='submit'>Заказать</button></p>";
          }
          $massiv[$key] .=  "
        </div>
        ";
      }
    return $massiv;
  }
}
?>
