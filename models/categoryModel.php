<?php
class categoryModel extends Model {
public static $group = nameCat;
public $maxNotes = 2;

public function account() {
  $account = ['form1'  => 'account.tpl.php',  'form2' => 'НужноВнести'];
  return $account;
}
public function goods_table_view() {
  $goods_table = ['form1'  => 'category_layout.tpl.php',  'form2' => 'НужноВнести'];
  return $goods_table;
}
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

  public function count() {
    $sql = "SELECT COUNT(DISTINCT category.idCat) AS qty
         FROM base
     INNER JOIN category on base.id_category = category.nameCat
     INNER JOIN goods on base.id_goods = goods.name
     WHERE category.activity='1'
    ";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    $res = $stmt->fetchColumn();

    return $res;
  }

  public function goods_tables() {

    $x = new categoryModel();
    $x->goods_table(nameCat, 1, 0);
    $result = $x->goods_table(nameCat, 1, 0);
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
