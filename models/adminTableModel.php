<?php
class adminTableModel extends Model {
  public static $id = idB; //здесь указываем поле по которому считаем количество записей БД (нужно для пагинации)
//public static $whereName; //хранит имя поля группировки - для того чтобы после фильтра показывать только записи конкретной категории (+корректная пагинация)
  public $maxNotes = 2; //отработать ошибки - если не показывать все товары - и использовать фильтр - товары могут отсутствовать!
public static $result;
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
    $result = self::goods_table(0, 1, 0);
    self::$result = $result;
    return $result;
  }

  public function printTable() {
    $massiv = [];
    $massiv[$key] = "
    <table border='1' width='100%' cellpadding='5'>
        <thead >
          <tr>
            <th class='tables'>Номер</th>
            <th class='tables2'>Название категории</th>
            <th class='tables2'>Название товара</th>
              <th class='tables'>Активность категории</th>
            <th class='tables'>Активность товара</th>
            <th class='tables'>Краткое описание тов</th>
            <th class='tables'>Полное описание тов</th>
              <th class='tables'>Кол-во на складе</th>
              <th class='tables'>Возможность заказа</th>
            <th class='tables'>Изменить</th>
          </tr>
        </thead>
        <tbody>
";

    foreach(static::$result as $key => $value)
    {
      $massiv[$key] .=
      "<form action='' method='post'>
        <tr>
          <td><input name='id' type='text' value='$value[idB]' class='tables'; /></td>
          <td><input name='category' type='text' value='$value[id_category]'class='tables2'; /></td>
          <td><input name='goods' type='text' value='$value[id_goods]' class='tables2'; /></td>
          <td><input name='activity' type='text' value='$value[activity]' class='tables'; /></td>
          <td><input name='activityG' type='text' value='$value[activityG]' class='tables'; /></td>
          <td><textarea name='short_description' type='text'; />'$value[short_description]'</textarea></td>
          <td><textarea name='full_description' type='text'; />'$value[full_description]'</textarea></td>
          <td><input name='quantity' type='text' value='$value[quantity]' class='tables';/></td>
          <td><input name='disposal' type='text' value='$value[disposal]'class='tables';/></td>
          <td><input name='update' type='submit' value='Изменить' /></td>
        </tr>
      </form>";
    }
    if(($value == end(static::$result)) && ($this->pagesNumber() == Model::$countPage))
    {/////////////////////////////////
      $one = $value[idB] +1;
      $massiv[$key] .=
      "<form action='' method='post'>
        <tr>
          <td><input name='id' type='text' value='$one' style='width: 4em'; /></td>
          <td><input name='category2' type='text' value=''; /></td>
          <td><input name='goods2' type='text' value=''; /></td>
          <td><input name='activity2' type='text' value='' style='width: 8em'; /></td>
          <td><input name='activityG2' type='text' value='' style='width: 8em'; /></td>
          <td><textarea name='short_description2' type='text'; /></textarea></td>
          <td><textarea name='full_description2' type='text'; /></textarea></td>
          <td><input name='quantity2' type='text' value='' style='width: 10em'; /></td>
          <td><input name='disposal2' type='text' value='' style='width: 8em'; /></td>
          <td><input name='add' type='submit' value='Добавить' style='background: #CCCCFF;' /></td>
        </tr>
      </form>";
    }
    $massiv[$key] .=
    "</tbody>
     </table>";

    return $massiv;
  }













  public function printDiv() {
    $massiv = [];
    foreach(static::$result as $key => $value)
    {
      $massiv[$key] =
      "<form action='' method='post'>
        <div class='DivVisual'>
          <h1 align='center'>Номер: <input name='id' class='numberSize' type='text' value='$value[idB]' class='tables'; /></h1>
          <hr>
          <p>Название категории: <input name='category' type='text' value='$value[id_category]'class='tables2'; /></p>
          <p>Название товара: <input name='goods' type='text' value='$value[id_goods]' class='tables2'; /></p>
          <p>Активность категории: <input name='activity' type='text' value='$value[activity]' class='tables'; /></p>
          <p>Активность товара: <input name='activityG' type='text' value='$value[activityG]' class='tables'; /></p>
          <p>Краткое описание тов: <textarea name='short_description' type='text' class='text'; />'$value[short_description]'</textarea></p>
          <p>Полное описание тов: <textarea name='full_description' type='text' class='text'; />'$value[full_description]'</textarea></p>
          <p>Кол-во на складе: <input name='quantity' type='text' value='$value[quantity]' class='tables';/></p>
          <p>Возможность заказа: <input name='disposal' type='text' value='$value[disposal]'class='tables';/></p>
          <hr>
          <p class='buttonHolder'><input name='update' type='submit' value='Изменить' /></p>
        </div>
      </form>";
    }
    if(($value == end(static::$result)) && ($this->pagesNumber() == Model::$countPage))
    {/////////////////////////////////
      $one = $value[idB] +1;
      $massiv[$key] .=
      "<form action='' method='post'>
        <div class='DivVisual'>
          <h1 align='center'>Номер: <input name='id' class='numberSize' type='text' value='$one'; /></h1>
          <hr>
          <p>Название категории: <input name='category2' type='text' value=''; /></p>
          <p>Название товара: <input name='goods2' type='text' value=''; /></p>
          <p>Активность категории: <input name='activity2' type='text' value='' style='width: 8em'; /></p>
          <p>Активность товара: <input name='activityG2' type='text' value='' style='width: 8em'; /></p>
          <p>Краткое описание тов: <textarea name='short_description2' type='text' class='text'; /></textarea></p>
          <p>Полное описание тов: <textarea name='full_description2' type='text' class='text'; /></textarea></p>
          <p>Кол-во на складе: <input name='quantity2' type='text' value='' style='width: 10em'; /></p>
          <p>Возможность заказа: <input name='disposal2' type='text' value='' style='width: 8em'; /></p>
          <hr>
          <p class='buttonHolder'><input name='add' type='submit' value='Добавить' style='background: #CCCCFF;' /></p>
        </div>
      </form>";
    }

    return $massiv;
  }



}
?>
