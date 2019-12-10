<?php
class defaultModel extends Model
{
  public $maxNotes = 10;

  public function account()
  {
    $account = ['form1'  => 'account.tpl.php',  'form2' => 'НужноВнести'];
    return $account;
  }

  public function goods_table_view()
  {
    $goods_table = ['form1'  => 'goods_layout.tpl.php',  'form2' => 'НужноВнести'];
    return $goods_table;
  }

  /*public function goods_tables()
  {
    $m = 0;
    $x = new defaultModel();
    $x->goods_table(name, 1, $m);
    $result = $x->goods_table(name, 1, $m);
    return $result;
  }*/
}
