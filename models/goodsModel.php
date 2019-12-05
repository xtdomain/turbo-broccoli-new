<?php
class goodsModel extends Model {
public static $id = idG; //здесь указываем поле по которому считаем количество записей БД (нужно для пагинации)
//public static $n; //хранит имя поля группировки - для того чтобы после фильтра показывать только записи конкретной категории (+корректная пагинация)
public static $group = name;
public $s = name;
public $maxNotes = 3; //отработать ошибки - если не показывать все товары - и использовать фильтр - товары могут отсутствовать!


  /*public function page(){
    $url = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    foreach ($url as $key => $value) {
      if ($value == 'goods') {
        if (is_numeric($url[$key+1])) {
          $result = $url[$key+1];
          print_r($url[$key+1]);
      }
    }
    }
    return $result;
  } */



  public function goods_tables($m) { //$m - автоматически подставляет выбраную категорию, $p для автоматизации: в товарах есть пагинация, но после фильтра пагинации не будет
$m;
self::$n = $m;
if (empty($_POST['myForm'])) {
  $p = 1;
} else {$p = 0;}


$result = self::goods_table(name, $p, $m);
return $result;

}

/*$b = 'goodsModel';
  $x = new $b;*/

public function goods_tables2() { //Дополнительный запрос в БД - нужен для 1) красивой нумерации таблиц, всегда по порядку без пропуска цифр, от единицы 2) ограничения вывода информации после фильтра
if (empty($_POST['myForm'])) {
  $p = 1;
} else {$p = 0;}

 //Для исправления ошибки
$result = self::goods_table(name, 0, 0); //
return $result;

}









}


/*SELECT @n:=@n+1 num,  idG,  name, idB, idCat, nameCat, id_category, id_goods, short_description, full_description, disposal, activity, activityG
    FROM base
    INNER JOIN category on base.id_category = category.nameCat
    INNER JOIN goods on base.id_goods = goods.name
   ,(SELECT @n:=0 ) X
    WHERE category.activity='1' AND goods.activityG='1'
    ORDER BY num
*/
 ?>
