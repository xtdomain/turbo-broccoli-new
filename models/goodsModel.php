<?php
  class goodsModel extends Model {
public static $id = idG; //здесь указываем поле по которому считаем количество записей БД (нужно для пагинации)
//public static $n; //хранит имя поля группировки - для того чтобы после фильтра показывать только записи конкретной категории (+корректная пагинация)
public static $group = name;
public $s = name;
public $maxNotes = 3; //отработать ошибки - если не показывать все товары - и использовать фильтр - товары могут отсутствовать!

  public function goods_tables($m) { //$m - автоматически подставляет выбраную категорию, $p для автоматизации: в товарах есть пагинация, но после фильтра пагинации не будет
$m;
self::$n = $m;
if (empty($_POST['myForm'])) {
  $p = 1;
} else {$p = 0;}
$result = self::goods_table(name, $p, $m);
return $result;

}

  public function goods_tables2() { //Дополнительный запрос в БД - нужен для 1) красивой нумерации таблиц, всегда по порядку без пропуска цифр, от единицы 2) ограничения вывода информации после фильтра
if (empty($_POST['myForm'])) {
  $p = 1;
} else {$p = 0;}
$result = self::goods_table(name, 0, 0);
return $result;
}
}

 ?>
