<?php
class adminModel extends Model {
  public function account() {
    $account = ['form1'  => 'account_exit.tpl.php',  'form2' => 'НужноВнести'];
    return $account;
  }
}
