<div class="logo-form" style="padding-left: 1em;text-align:left; position: absolute; left: 0em; top: 0em; right: 0em; background:#FFCCCC; height: 3em; z-index: 2;animation: 1s ease slideInFromLeft">
  <div id="logo">
    <p><a href="<?php echo "/" . Route::$templateName; ?>"><img src="img/logo1.png" class="logotip" alt="Logo-Company"></p></a>
  </div>

<div class="account-form" style="z-index: 2;">
  <div class="account-cabinet">
    <span class="input-group"><i>Личный кабинет</i></span>
  </div>
  <form method="post">
    <div class="for-submit">
      <button formaction="/admin/out" type="submit" name="button" id="button" class="button">Выйти</button>
    </div>
  </form>
  <div class="info"><p><?php if(!empty($pageData['error'])) :?>
    <p><?php echo $pageData['error']; ?></p>
  <?php endif; ?>
</p></div>
</div>
</div>
