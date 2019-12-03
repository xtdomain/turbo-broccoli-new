<?php
class adminModel extends Model {
  public $maxNotes = 2;
  public $maxCatNotes = 1;
  public $pagesNumber;
  public $math;
 public function account() {
$sql = "SELECT COUNT(*) FROM base";
$stmt = $this->db->prepare($sql);
$stmt->execute();
$res = $stmt->fetchColumn();
return $res;
 }
 ////////////////////////////////////////////////
   public function tables() {
     $tables = ['table-category'  => 'layout2.tpl.php',  'table-admin' => 'layout.tpl.php'];
     return $tables;
   }
 //////////////////////////////////////   $tables = ['layout2.tpl.php'];////////////////////////////////

   public function category_id() {
     $url = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
   $a = ($url[count($url)-1]); //4
      $b = str_replace(' ', '', $a);
      if (empty($b)) {
      $b = 1;
    }


     return $b;
   }

   public function pageg() {
 $url = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
   $a = ($url[count($url)-3]); //2
   //    $a = ($url[count($url)-2]);
     $d = str_replace(' ', '', $a);
     if (empty($d)) {
     $d = 1;
     }
     return $d;
   }
/////////////////////////////////////////////////////////////////////////// Второй - становится товаром, затем категория
public function pageCategory() {
$url = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
//$h = a::b();
//echo $h[0];
  $a = ($url[count($url)-1]); //4
  $g = str_replace(' ', '', $a);
  if (empty($g)) {
  $g = 1;
  }
  return $g;
}
 //////////////////////////////////////////////////////////////////// ЧПУ
  public function pagesAdmin() {
    $admin = '/admin';
    return $admin;
  }
  public function pagesAdminSpecial() {
    $adminSpecial = '/admin';
    return $adminSpecial;
  }
  ///////////////////////////////////////////////////////////////////////
  public function pageOnlyAdmin() {
    $url = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

    $a = ($url[count($url)-3]); //2

    $b = str_replace(' ', '', $a);
    if (empty($b)) {
    $b = 1;
    }
    if (is_numeric ($b)) {

    $math = ($b-1)*$this->maxNotes;
    return $math;
  } /* else {
    http_response_code(404);
    include('my_404.php');
    die();


  } */
  }

 public function category() {


$mathc = $this->page();

 $sql = "SELECT
 idG,
idCat,
 base.idB,
 base.id_category,
 base.id_goods,
 goods.short_description,
goods.full_description,
category.activity,
goods.activityG,
goods.quantity,
goods.disposal
 FROM base
 INNER JOIN category on base.id_category = category.nameCat
 INNER JOIN goods on base.id_goods = goods.name
 ORDER by base.idB
LIMIT $mathc,$this->maxNotes
";
  $result = array();
  $stmt = $this->db->prepare($sql);
  $stmt->execute();
  while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    $result[$row['idB']] = $row;
  }
  return $result;
 }


 public function pageAdm() {////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   $url = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

   $a = ($url[count($url)-1]); //2
print_r($a);
   $b = str_replace(' ', '', $a);
   if (empty($b)) {
   $b = 1;
   }
   if (is_numeric ($b)) {

   $math = ($b-1)*$this->maxNotes;
   return $math;
 } /* else {
   http_response_code(404);
   include('my_404.php');
   die();


 } */
 }


 public function page() {////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   $a = (explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH))[3]);



   $b = str_replace(' ', '', $a);
   if (empty($b)) {
   $b = 1;
   }
   if (is_numeric ($b)) {

   $math = ($b-1)*$this->maxNotes;
   return $math;
 } /* else {
   http_response_code(404);
   include('my_404.php');
   die();


 } */
 }
 /* public function category_public() { ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


 $mathc = $this->page();
 $sql = "SELECT DISTINCT id, name, base.idB,
 base.id_category,
 base.id_goods,

 goods.short_description,
 goods.full_description,
 goods.disposal,
 category.activity
 FROM base
 INNER JOIN category on base.id_category = category.nameCat
 INNER JOIN goods on base.id_goods = goods.name
 GROUP BY id, name

 LIMIT $mathc,$this->maxNotes
 ";
  $result = array();
  $stmt = $this->db->prepare($sql);
  $stmt->execute();
  while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    $result[$row['id']] = $row;
  }
  return $result;
 }

 public function onlyCategory() {
 $mathg = $this->pageCountCategory();
   $sql = "SELECT idCat, nameCat
   FROM category
   GROUP BY idCat
   LIMIT $mathg,$this->maxCatNotes";
   $result = array();
   $stmt = $this->db->prepare($sql);
   $stmt->execute();
   while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
     $resultCategory[$row['idCat']] = $row;
   }
   return $resultCategory;

 }        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// */

 public function pagesNumber() {
$pagesNumber = ceil($this->account()/$this->maxNotes);
   return $pagesNumber;
 }
 public function pagesNumberAdmin() {
 $pagesNumber = ceil($this->account()/$this->maxNotes);
   return $pagesNumber;
 }
///////////////////////////////////////////////////////////////////////////////////////////////////
public function countCategory() {
  $sql = "SELECT COUNT(DISTINCT idCat) AS qty
       FROM category
       ";
  $stmt = $this->db->prepare($sql);
  $stmt->execute();
  $resource = $stmt->fetchColumn();
  return $resource;
}

public function pagesCatNumber() {
$pagesCatNumber = ceil($this->countCategory()/$this->maxCatNotes);
  return $pagesCatNumber;
}

//////Вставка данных в БД/////////


/* INSERT INTO goods(name) VALUES (@new:= ('Зарядное устр'));
INSERT INTO category(nameCat) VALUES (@newC:= ('Разное'));
INSERT INTO `base`(`idB`, `id_category`, `id_goods`) VALUES (NULL, @newC, @new);  */




public static function Update($idB, $nameCat, $nameGood) {

$db = dataBase::DB_connection();
//////////////////////////////////////////////////  id_category  //////
  $sql = "UPDATE `base` SET id_category=:name_bind, id_goods=:nameG_bind WHERE idB=:idB_bind";

  $stmt = $db->prepare($sql);
  $stmt->bindParam(':idB_bind', $idB, PDO::PARAM_STR);

  $stmt->bindParam(':name_bind', $nameCat, PDO::PARAM_STR);
  $stmt->bindParam(':nameG_bind', $nameGood, PDO::PARAM_STR);

  return $stmt->execute();
  }






public static function Update3($idCat, $idGood, $activity, $activityG, $short_description, $full_description, $quantity, $disposal) {

$db = dataBase::DB_connection();
//////////////////////////////////////////////////  id_category  //////

  $sql = "UPDATE `category`, `goods` SET activity=:Act_bind, activityG=:ActG_bind, short_description=:ShDisc_bind, full_description=:FlDisc_bind, quantity=:Quant_bind, disposal=:Disp_bind  WHERE category.idCat=:id_bind AND goods.idG=:idG_bind";
    $stmt = $db->prepare($sql);
  $stmt->bindParam(':idG_bind', $idGood, PDO::PARAM_STR);

  //$stmt->bindParam(':idG_bind', $idGood, PDO::PARAM_STR);

//  $stmt->bindParam(':idB_bind', $idB, PDO::PARAM_STR);
  $stmt->bindParam(':id_bind', $idCat, PDO::PARAM_STR);
  $stmt->bindParam(':Act_bind', $activity, PDO::PARAM_STR);
      $stmt->bindParam(':ActG_bind', $activityG, PDO::PARAM_STR);
  $stmt->bindParam(':ShDisc_bind', $short_description, PDO::PARAM_STR);
  $stmt->bindParam(':FlDisc_bind', $full_description, PDO::PARAM_STR);
  $stmt->bindParam(':Quant_bind', $quantity, PDO::PARAM_STR);
  $stmt->bindParam(':Disp_bind', $disposal, PDO::PARAM_STR);

return $stmt->execute();
}

public static function Add($idB, $idGood, $idCat, $nameCat, $nameGood, $activity, $activityG, $short_description, $full_description, $quantity, $disposal) {

$db = dataBase::DB_connection();

/* INSERT INTO `goods`(`name`) VALUES (@new:=:nameG_bind); //название товара
INSERT INTO `category`(`nameCat`) VALUES (@newC:=:name_bind); //название категории
INSERT INTO `base`(`idB`, `id_category`, `id_goods`) VALUES (@idCat=:id_bind, @newC, @new); */








  $sql = "INSERT INTO `goods`(`idG`, `name`, `activityG`, `short_description`, `full_description`, `quantity`, `disposal`) VALUES (@idG:=:nameidG_bind, @new:=:nameG_bind, @act:=:nameActG_bind, @sd:=:nameShDisc_bind, @fd:=:nameFlDisc_bind, @quant:=:nameQuant_bind, @disp:=:nameDisp_bind);



  INSERT INTO `category`(`idCat`, `nameCat`, `activity`) VALUES (@idCat:=:nameidCat_bind, @newC:=:name_bind, @Act:=:nameAct_bind);
  INSERT INTO `base`(`idB`, `id_category`, `id_goods`) VALUES (@idBase:=:id_bind, @newC, @new);";
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
/////////////////////////////////////////////////////////
public  function GetInfo() {







  $sql = "SELECT * FROM `users`";
  $result = $this->db->query($sql);
  $index = array();
  $i = 0;


  while($row = $result->fetch(PDO::FETCH_ASSOC)){
    $index[$row['id']] = $row;
  }

  return $index;

}







public function ButtonChange() {
  $a = (explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH))[3]);
  $b = str_replace(' ', '', $a);
  if (empty($b)) {
  $b = 1;
  }
  if (is_numeric ($b)) {
  $math = ($b-1)*$this->maxCatNotes;
  return $math;
}else {
        http_response_code(404);
  include('my_404.php');
  die();
  }
}
}
?>
