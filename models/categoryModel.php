<?php
class categoryModel extends Model {
  public static $id = idCat; //здесь указываем поле по которому считаем количество записей БД (нужно для пагинации)
public static $group = nameCat;
public $maxNotes = 1;


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

  //public function count($id = idCat) { //Для всех функций, в том числе пагинаци необходим подсчет элементов в БД
//    }


  public function goods_tables() {
    $result = self::goods_table(nameCat, 1, 0);
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
