<div id="logo">
<div class="account-form" style="z-index: 2">
<form method="post">
<span class="input-group"><i>Введите регистрационные данные</i></span>
<div class="input-group-user">
<input type="text" name="login" id="login" class="user" placeholder="Username" required>
</div>
<div class="input-group-password">
<input type="password" name="password" id="password" class="pass" placeholder="Password" required>
</div>
<div class="input-group-checkbox">
<input type="checkbox" name="checkbox" id="check-password" class="checkbox-pass">
<label class="label" for="check-password">Remember me</label>
</div>
<div class="for-submit">
<button type="submit" name="button" id="button" class="button">Login</button>
</div>
</form>
<div class="no-account">
Don't have an account? <a href="registration.php" class="new">Sign Up</a>
</div>
<div class="no-accounts">
<a href="#" class="new">Forgot your password?</a>
</div>
<div class="info"><p><?php if(!empty($pageData['error'])):?>
<p><?php echo $pageData['error']; ?></p>
<?php endif;?>
</p></div>
</div>
