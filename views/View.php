<?php
class View {
  public static $pageData = array();
  public static $tpl = array();

  public static function render($tpl, $pageData)
  {
    array_push(View::$pageData, $pageData);
    array_push(View::$tpl, $tpl);
    $content = new Route();
    include_once ROOT. static::$tpl['0'];
  }
  public static function render2()
  {
    $i = count(static::$pageData)-1;
    while($i > 0)
    {
        $pageData['save'] = Model::$actions;
      $pageData = static::$pageData[$i];
      include_once ROOT. static::$tpl[$i];
      $i--;
    }
  }
}
?>
