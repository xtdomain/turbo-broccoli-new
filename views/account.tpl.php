<div  style="   text-align:center;     z-index: 2; position: fixed; margin-top: -10px; height: 2em;">
<div class="account-form" style="z-index: 2;">
  <div class="account-cabinet">
    <span class="input-group"><i>Личный кабинет</i></span>
  </div>
  <form method="post">
    <span class="input-group"><i>Введите регистрационные данные</i></span>
    <div class="input-group-user">
      <input type="text" name="login" id="login" class="user" required placeholder="Логин" required>
    </div>
    <div class="input-group-password">
      <input type="password" name="password" id="password" class="pass" required placeholder="Пароль" required>
    </div>
    <div class="input-group-checkbox">
      <input type="checkbox" name="checkbox" id="check-password" class="checkbox-pass">
      <label class="label" for="check-password">Запомнить меня</label>
    </div>
    <div class="for-submit">
      <button type="submit" name="button" id="button" class="button">Войти</button>
    </div>
  </form>
  <div class="no-account">
    Нет аккаунта? <a href="registration.php" class="new">Зарегистрироваться</a>
  </div>
  <div class="no-accounts">
    <a href="#" class="new">Забыли пароль?</a>
  </div>
  <div class="info"><p><?php if(!empty($pageData['error'])) :?>
    <p><?php echo $pageData['error']; ?></p>
  <?php endif; ?>
</p></div>
</div>
</div>
