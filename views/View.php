<?php
class View {
public static $pageData = array();
public static $tpl = array();
  public static function render($tpl, $pageData)
  {






array_push(View::$pageData, $pageData);
array_push(View::$tpl, $tpl);














    $content = new Route();
    $content2 = new View2;

    include_once ROOT. static::$tpl['0'];






}

public static function render2()
{

  $i = count(static::$pageData)-1;
  while($i > 0)
  {
    $pageData = static::$pageData[$i];
      include_once ROOT. static::$tpl[$i];

    $i--;
  }






}
}
class View2 {
  public static $tpl;
  public static $pageData = array();
  public static function render2()
  {

$pageData = static::$pageData;

    include_once ROOT. static::$tpl;
  }
}
?>
