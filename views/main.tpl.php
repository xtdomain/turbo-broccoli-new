<?php $content->startRoute('default') ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="vieport" content="width=device-width, initial-scale=1">
	<link href="/style/style.css" rel="stylesheet">
	<title><?php echo $pageData['title'];?></title>
	<style>
	.account-form {
		width: 250px; border: 4px double #99CCFF; padding: 1em 1em 2em; text-align:center; position: fixed; right: 1em; top: -13.5em; background:#99CCFF; transition-duration: 1s; transition-delay: 2s;
	}
	.account-form:hover {
		border: 4px double #8B0000; border-radius: 0em 0em 0em 2em ;padding: 1em 1em 2em; text-align:center; position: fixed; right: 1em; top: 0em; background:#DEB887; transition: .3s;
	}
	.input-group-user{
		padding: 0.5em;
	}
	.input-group{
		margin-top: -4em;
	}
	.input-group-checkbox {
		padding-top: 0.1em;
	}
	.for-submit {
		padding-top: 0.5em;
		padding-bottom: 1.5em;
	}
	.no-accounts {
		padding-top: 0.3em;
	}
	.info {
		padding-top: 0.0em;
		margin-bottom: -2.4em;
	}
</style>
</head>
<body>
	<header>
  <?php
	if (isset($pageData['account']['form1']))
	{
		include_once($pageData['account']['form1']);
	}
	?>
	</header>
	<div class="logo-form" style="padding-left: 1em;text-align:left; position: relative; left: 0em; margin-top: 5em; right: 0em; ">
		<h1 style="text-align:center">Магазин электроники</h1>
	</div>
	<div style="position: relative; margin-left: 2em; margin-right: 2em; margin-bottom: 1em">
		<?php
		$content->addRoute();
		?>
	</div>
	<div style="position: relative; margin-left: 1em; margin-bottom: 5em">
		<form class="button" name="button" action="/category/1/goods/1" method="post">
			<button type="submit" name="button">Показывать все</button>
		</form>
	</div>
	<footer>
		<div class="footer" style="padding-right: 1em;text-align:right; position: fixed; left: 0em; bottom: 0em; right: 0em; background:#D3D3D3; height: 3em; ">
			<p>Официальный магазин электроники</p>
		</div>
	</footer>
</body>
</html>
