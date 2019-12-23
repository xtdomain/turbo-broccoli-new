<?php
class View {
  public static function render($tpl, $pageData)
  {
    $content = new Route();
    include_once ROOT. $tpl;
  }
}
?>
