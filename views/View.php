<?php
class View {
  public static function render($tpl, $pageData)
  {
    include_once ROOT. $tpl;
  }
}
?>
