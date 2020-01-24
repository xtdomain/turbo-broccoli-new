<?php
class adminTableModel extends Model {
  public static $id = idB; //здесь указываем поле по которому считаем количество записей БД (нужно для пагинации)
//public static $whereName; //хранит имя поля группировки - для того чтобы после фильтра показывать только записи конкретной категории (+корректная пагинация)
  public $maxNotes = 20; //отработать ошибки - если не показывать все товары - и использовать фильтр - товары могут отсутствовать!
public static $result;

public function  pagesNumber() //количество страниц (в этой таблице страниц больше - лимит убирается, тк нужно показывать даже неактивные категории и товары)
{
  if ($this->maxNotes > 0) {
  $pagesNumber = ceil($this->count($id = static::$id, $limit = "")/$this->maxNotes); //!!!обязательно позднее статическое связывание - чтобы взять параметр конкретной модели а не этой
}
else
{
Route::CallErrors(); //деление на 0
}
  return $pagesNumber;
}

  public function goods_tables($m) //$m - автоматически подставляет выбраную категорию, $p для автоматизации: в товарах есть пагинация, но после фильтра пагинации не будет
  {

    if (empty($_POST['myForm']))
    {
      $p = 1;
    }
    else
    {
      $p = 0;
    }
    $result = self::goods_table(0, 1, ALL, 'idB'); // ВАЖНО!!! если goods_table(0, 1, 2); то ($this->pagesNumber() == Model::$countPage) удалить
    self::$result = $result;
    return $result;
  }

  public function printTable()
  {
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
          <td><input name='id' type='text' value='$value[idB]' class='tables'; /><input name='id2' type='hidden' value='$value[idB]' ; /></td>
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
          <td><input name='id' type='text' value='$one' class='tables'; /></td>
          <td><input name='category2' type='text' value='' class='tables2'; /></td>
          <td><input name='goods2' type='text' value='' class='tables2'; /></td>
          <td><input name='activity2' type='text' value='' class='tables'; /></td>
          <td><input name='activityG2' type='text' value='' class='tables'; /></td>
          <td><textarea name='short_description2' type='text'; /></textarea></td>
          <td><textarea name='full_description2' type='text'; /></textarea></td>
          <td><input name='quantity2' type='text' value='' class='tables'; /></td>
          <td><input name='disposal2' type='text' value='' class='tables'; /></td>
          <td><input name='add' type='submit' value='Добавить' style='background: #CCCCFF;' /></td>
        </tr>
      </form>";
    }
    $massiv[$key] .=
    "</tbody>
     </table>";

    return $massiv;
  }

  public function printDiv()
  {
      $simple_goods_table = $this->goods_simple_table(goods, idG, 'name, short_description, full_description, disposal, quantity, activityG');
      $simple_category_table = $this->goods_simple_table(category, idCat, 'nameCat, activity');
    $massiv = [];
    $List = function($nameField, $column, $selected)
    {
$deleteButton = "<form action='' method='post'><input name='deleteLine' type='submit' value='Удалить' style='background: #CCCCFF; height:20px; vertical-align:middle;' /></form>";

      $options = "";
      if ($column == 'activity' || $column == 'activityG') {
        if ($selected == 1) {
            $options .= "<option selected value = '$selected'>$selected</option>";
            $options .= "<option value = '0'>0</option>";
        } else {
          $options .= "<option selected value = '$selected'>$selected</option>";
          $options .= "<option value = '1'>1</option>";
        }
    } else {
      foreach($nameField as $key2 => $value2)
      {
        if ($value2[$column] != $selected)
        {
          $options .= "<option value = '{$value2[$column]}'>{$value2[$column]}</option>";
        } else {
          $options .= "<option selected value = '$selected'>$selected</option>";
        }
      }
    }
      return $options;
    };

    foreach(static::$result as $key => $value)
    {
      $massiv[$key] =
      "
      <form action='' method='post'>
      <hr class='group_linie'>
        <div class='DivVisual'>
          <h1 align='center'>Номер: <input name='id' class='numberSize' type='text' value='$value[idB]' class='tables'; /><input name='id2' type='hidden' value='$value[idB]' ; /></h1>
          <hr>
          <div style='position: relative; vertical-align: middle;'><p>Название категории: <select name='category'>{$List($simple_category_table, nameCat, $value['id_category'])}</select><span style='margin:10px;'><img src='/images/TRASH.png' style='height:22px;  margin-top: 2px; margin-right: 2px; margin-left: -2px; position: absolute;'><input name='deleteCategory' title='Удалить из списка' type='submit' value=' ' style='background: #CCCCFF; height:22px; vertical-align:middle; opacity:0.5;' /></span></div></p>
          <div style='position: relative; vertical-align: middle;'><p>Название товара: <select name='goods'>{$List($simple_goods_table, name, $value['id_goods'])}</select><span style='margin:10px;'><img src='/images/TRASH.png' style='height:22px;  margin-top: 2px; margin-right: 2px; margin-left: -2px; position: absolute;'><input name='deleteGood' title='Удалить из списка' type='submit' value=' ' style='background: #CCCCFF; height:22px; vertical-align:middle; opacity:0.5;' /></span></div></p>
<p align='center' style='color:gold;'><label>Сохранить параметры</label><input class='checkbox' type='checkbox' name='checkbox' checked='checked' value='1'/><span></span></p>
          <p>Активность категории: <select name='activity'>{$List($simple_category_table, activity, $value['activity'])}</select></p>
          <p>Активность товара: <select name='activityG'>{$List($simple_goods_table, activityG, $value['activityG'])}</select></p>
          <p>Краткое описание тов: <textarea name='short_description' type='text' class='text'; />$value[short_description]</textarea></p>
          <p>Полное описание тов: <textarea name='full_description' type='text' class='text'; />$value[full_description]</textarea></p>
          <p>Кол-во на складе: <input name='quantity' type='text' value='$value[quantity]' class='tables';/></p>
          <p>Возможность заказа: <input name='disposal' type='text' value='$value[disposal]'class='tables';/></p>
          <hr>
          <div style='position: relative; vertical-align: middle;'><p class='buttonHolder'><input name='update' type='submit' value='Изменить' /><span style='margin:10px;'><img src='/images/TRASH.png' style='height:22px;  margin-top: 2px; margin-right: 2px; margin-left: -2px; position: absolute;'><input name='delete' title='Удалить' type='submit' value=' ' style='background: #CCCCFF; height:22px; vertical-align:middle; opacity:0.5;' /></span></div></p>
        </div>
        <hr class='group_linie'>
      </form>";
    }
    //print_r($this->pagesNumber());
    if((($value == end(static::$result)) && ($this->pagesNumber() == Model::$countPage)) || empty(static::$result)) // ВАЖНО!!! ($this->pagesNumber() == Model::$countPage) убрать если нет пагинации
    {/////////////////////////////////
      $one = $value['idB'] +1;

      $massiv[$key] .=
      "<form action='' method='post'>
      <hr class='group_linie'>
        <div class='DivVisual'>
          <h1 align='center'>Номер: <input name='id' class='numberSize' type='text' value='$one' class='tables'; /></h1>
          <hr>
          <p>Название категории: <input name='category2' type='text' value='' class='tables2'; /></p>
          <p>Название товара: <input name='goods2' type='text' value='' class='tables2'; /></p>
          <p align='center' style='color:gold;'><label>Сохранить параметры</label><input class='checkbox' type='checkbox' name='checkbox' checked='checked' value='1'/><span></span></p>
          <p>Активность категории:   <select class='tables' name='activity2'>{$List($simple_category_table, activity, 1)}</select></p>
          <p>Активность товара:   <select class='tables' name='activityG2'>{$List($simple_goods_table, activityG, 1)}</select></p>
          <p>Краткое описание тов: <textarea name='short_description2' type='text' class='text'; /></textarea></p>
          <p>Полное описание тов: <textarea name='full_description2' type='text' class='text'; /></textarea></p>
          <p>Кол-во на складе: <input name='quantity2' type='text' value='' class='tables'; /></p>
          <p>Возможность заказа: <input name='disposal2' type='text' value='' class='tables'; /></p>
          <hr>
          <p class='buttonHolder'><input name='add' type='submit' value='Добавить' style='background: #CCCCFF; height:20px; vertical-align:middle;' /></p>
        </div>
        <hr class='group_linie'>
      </form>";
    }

    return $massiv;
  }

  public function Update() ///обновление данных о товаре и группе
  {

    if(isset($_POST['update']) || isset($_POST['delete']) || isset($_POST['deleteGood']) || isset($_POST['deleteCategory']))
    {
      $url = (parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
      header("Location: $url");

      $db = dataBase::DB_connection();

        $idB = $_POST['id'];
$idB_hidden = $_POST['id2'];

      //$idGood = self::goods_table(0, 0, 'ALL')[$_POST['id']]['idG'];
      //$idCat = self::goods_table(0, 0, 'ALL')[$_POST['id']]['idCat'];
      $nameCat = $_POST['category'];
      $nameGood = $_POST['goods'];
      $activity = $_POST['activity'];
      $activityG = $_POST['activityG'];
      $short_description = $_POST['short_description'];
      $full_description = $_POST['full_description'];
      $quantity = $_POST['quantity'];
      $disposal = $_POST['disposal'];

      if(isset($_POST['delete']))
      {

$sql = "DELETE FROM `base` WHERE base.idB=:idB_bind;";
$stmt = $db->prepare($sql);
  $stmt->bindParam(':idB_bind', $idB, PDO::PARAM_STR);

} else if (isset($_POST['deleteGood'])) {








  $sql = "DELETE goods FROM goods WHERE name=:nameG_bind;";
  $stmt = $db->prepare($sql);
      $stmt->bindParam(':nameG_bind', $nameGood, PDO::PARAM_STR);

} else if (isset($_POST['deleteCategory'])) {

  $sql = "DELETE category FROM category WHERE nameCat=:name_bind;";
  $stmt = $db->prepare($sql);
      $stmt->bindParam(':name_bind', $nameCat, PDO::PARAM_STR);
} else {



  if ($_POST['checkbox'] == 1)//добавить новый товар в новую категорию, но сохранить их параметры.
  {

    if ( $_POST['id'] == self::goods_table(0, 1, ALL, 'idB')[$_POST['id']]['idB'] && $idB_hidden !== $idB) //проверка на изменение номера строки на уже существующий в таблице
    {
Route::CallErrors();
    }


    $Parameter = "UPDATE `category`, `goods`, `base` SET base.idB=:idB_bind, id_category=:name_bind, id_goods=:nameG_bind, `activity`=`activity`, `activityG`=`activityG`, `short_description`=`short_description`, `full_description`=`full_description`, `quantity`=`quantity`, `disposal`=`disposal`  WHERE category.nameCat=:name_bind AND goods.name=:nameG_bind AND base.idB=:idB_hidden_bind;";
    $sql = $Parameter;
    $stmt = $db->prepare($sql);
$stmt->bindParam(':idB_bind', $idB, PDO::PARAM_STR);
$stmt->bindParam(':idB_hidden_bind', $idB_hidden, PDO::PARAM_STR);
    $stmt->bindParam(':name_bind', $nameCat, PDO::PARAM_STR);
    $stmt->bindParam(':nameG_bind', $nameGood, PDO::PARAM_STR);

}

  else //добавить новый товар в новую категорию и изменить их параметры.
  {
    if ( $_POST['id'] == self::goods_table(0, 1, ALL, 'idB')[$_POST['id']]['idB'] && $idB_hidden !== $idB) //проверка на изменение номера строки на уже существующий в таблице
    {
  Route::CallErrors();
    }

    $Parameter = "UPDATE `category`, `goods`, `base` SET base.idB=:idB_bind, id_category=:name_bind, id_goods=:nameG_bind, activity=:Act_bind, activityG=:ActG_bind, short_description=:ShDisc_bind, full_description=:FlDisc_bind, quantity=:Quant_bind, disposal=:Disp_bind  WHERE category.nameCat=:name_bind AND goods.name=:nameG_bind AND base.idB=:idB_hidden_bind";
    $sql = $Parameter;
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':idG_bind', $idGood, PDO::PARAM_STR);
    //$stmt->bindParam(':idG_bind', $idGood, PDO::PARAM_STR);
    $stmt->bindParam(':idB_bind', $idB, PDO::PARAM_STR);
    $stmt->bindParam(':idB_hidden_bind', $idB_hidden, PDO::PARAM_STR);
    $stmt->bindParam(':name_bind', $nameCat, PDO::PARAM_STR);
    $stmt->bindParam(':nameG_bind', $nameGood, PDO::PARAM_STR);
  //  $stmt->bindParam(':idB_bind', $idB, PDO::PARAM_STR);
    $stmt->bindParam(':id_bind', $idCat, PDO::PARAM_STR);
    $stmt->bindParam(':Act_bind', $activity, PDO::PARAM_STR);
    $stmt->bindParam(':ActG_bind', $activityG, PDO::PARAM_STR);
    $stmt->bindParam(':ShDisc_bind', $short_description, PDO::PARAM_STR);
    $stmt->bindParam(':FlDisc_bind', $full_description, PDO::PARAM_STR);
    $stmt->bindParam(':Quant_bind', $quantity, PDO::PARAM_STR);
    $stmt->bindParam(':Disp_bind', $disposal, PDO::PARAM_STR);


}
} return $stmt->execute();


}


    else
    {
    }
  }

  public static function Add()
  {
    if(isset($_POST['add']))
    {
      $url = (parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
      header("Location: $url");
      $idB = $_POST['id'];
      $nameCat = $_POST['category2'];
      $nameGood = $_POST['goods2'];
      $activity = $_POST['activity2'];
      $activityG = $_POST['activityG2'];
      $short_description = $_POST['short_description2'];
      $full_description = $_POST['full_description2'];
      $quantity = $_POST['quantity2'];
      $disposal = $_POST['disposal2'];
      if ($_POST['checkbox'] == 1)//добавить новый товар в новую категорию, но сохранить их параметры.
      {
        $goodsParameter = "`idG`=`idG`, `name`=`name`, `activityG`=`activityG`, `short_description`=`short_description`, `full_description`=`full_description`, `quantity`=`quantity`, `disposal`=`disposal`;";
        $categoryParameter = "`idCat`=`idCat`,`nameCat` = `nameCat`, `activity`=`activity`;";
      }
      else //добавить новый товар в новую категорию и изменить их параметры.
      {
        $goodsParameter = "`idG`=`idG`, `name`=`name`, `activityG`:=:nameActG_bind, `short_description`:=:nameShDisc_bind, `full_description`:=:nameFlDisc_bind, `quantity`:=:nameQuant_bind, `disposal`:=:nameDisp_bind;";
        $categoryParameter = "`idCat`=`idCat`,`nameCat` = `nameCat`, `activity`=:nameAct_bind;";
      }
      //print_r($one);
      $db = dataBase::DB_connection();

      $sql = "INSERT INTO `goods`(`idG`, `name`, `activityG`, `short_description`, `full_description`, `quantity`, `disposal`)
      VALUES (@idG:=:nameidG_bind, @new:=:nameG_bind, @act:=:nameActG_bind, @sd:=:nameShDisc_bind, @fd:=:nameFlDisc_bind, @quant:=:nameQuant_bind, @disp:=:nameDisp_bind)
      ON DUPLICATE KEY UPDATE $goodsParameter
      INSERT INTO `category`(`idCat`, `nameCat`, `activity`)
      VALUES (@idCat:=:nameidCat_bind, @newC:=:name_bind, @actC:=:nameAct_bind)
      ON DUPLICATE KEY UPDATE $categoryParameter
      INSERT INTO `base`(`idB`, `id_category`, `id_goods`) VALUES (@idBase:=:id_bind, @newC:=:name_bind, @new:=:nameG_bind);";
      $stmt = $db->prepare($sql);
      $stmt->bindParam(':id_bind', $idB, PDO::PARAM_STR);
      $stmt->bindParam(':nameidG_bind', $idGood, PDO::PARAM_STR);
      $stmt->bindParam(':nameidCat_bind', $idCat, PDO::PARAM_STR);
      $stmt->bindParam(':name_bind', $nameCat, PDO::PARAM_STR);
      $stmt->bindParam(':nameG_bind', $nameGood, PDO::PARAM_STR);
      $stmt->bindParam(':nameAct_bind', $activity, PDO::PARAM_STR);
      $stmt->bindParam(':nameActG_bind', $activityG, PDO::PARAM_STR);
      $stmt->bindParam(':nameShDisc_bind', $short_description, PDO::PARAM_STR);
      $stmt->bindParam(':nameFlDisc_bind', $full_description, PDO::PARAM_STR);
      $stmt->bindParam(':nameQuant_bind', $quantity, PDO::PARAM_STR);
      $stmt->bindParam(':nameDisp_bind', $disposal, PDO::PARAM_STR);
      return $stmt->execute();
    }
    else
    {
    }
  }
}
?>
