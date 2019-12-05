<?php
class tableModel extends Model {
  public static $id = idG; //здесь указываем поле по которому считаем количество записей БД (нужно для пагинации)
public static $group = name;
public $s = name;
public $maxNotes = 1;



  public function goods_tables() {
                                              //создать запрос в базу данных 1. указать группировку(например 'name' из таблицы товаров) 2. указать LIMIT: 0 - показывать все, 1 - постранично
    $result = self::goods_table(name, 1, 0); //3. указать дополнительное ограничение where - товары только этой категории, где 0 - отключить, а любой текст соответствует наименованию категории
return $result;

  }
  public function goods_tables2() {
$g = 'name, nameCat';
    $result = self::goods_table($g, 0, 0);
    return $result;

  }

}


 ?>
