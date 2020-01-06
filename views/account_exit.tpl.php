<div  style="   text-align:center;     z-index: 2; position: fixed; margin-top: -10px;">
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
