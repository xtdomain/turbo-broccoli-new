<?php $content->startRoute('admin') ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $pageData['title']; ?></title>
	<meta name="vieport" content="width=device-width, initial-scale=1">
	<style>
	@keyframes slideInFromLeft
	{
		0%
		{
			background:#99CCFF;
			border-color: #99CCFF;
		}
	  100%
		{
	    background:#FFCCCC;
			border-color: #FFCCCC;
	  }
	}
	.account-form {
		width: 250px; border: 4px double #FFCCCC; padding: 1em 1em 2em; text-align:center; position: absolute; right: 1em; top: -5em; background:#FFCCCC; transition-duration: 1s; transition-delay: 2s; animation: 1s ease slideInFromLeft;
	}
	.account-form {
	}
	.account-form:hover {
		border: 4px double #8B0000; border-radius: 0em 0em 0em 2em ;padding: 1em 1em 2em; text-align:center; position: absolute; right: 1em; top: 0em; background:#DEB887; transition: .3s;
	}
	.for-submit {
		padding-top: 1em;
		padding-bottom: 0em;
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
	<h1 style="text-align:center">Администрирование</h1>
</div>
<div style="position: relative; margin-left: 2em; margin-right: 2em; margin-bottom: 1em">
	<?php

	$content->addRoute();
	?>
</div>
<div style="position:relative">
	<?php
//if(isset($pageData['tables']['table-admin'])){
//include($pageData['tables']['table-admin']);
//}
	?>
</div>
<footer>
	<div class="footer" style="padding-right: 1em;text-align:right; position: fixed; left: 0em; bottom: 0em; right: 0em; background:#D3D3D3; height: 3em">
		<p>Официальный магазин электроники</p>
	</div>
</footer>
</body>
</html>
