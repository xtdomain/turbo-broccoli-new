<?php
  class categoryModel extends Model {
public static $id = idCat; //здесь указываем поле по которому считаем количество записей БД (нужно для пагинации)
public static $group = nameCat;
public $maxNotes = 1;

  public function goods_tables() {
    $result = self::goods_table(nameCat, 1, 0);
return $result;

  }
}


 ?>
