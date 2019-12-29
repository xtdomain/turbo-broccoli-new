<?php
$content->startRoute('default');
$content->addRoute();

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="vieport" content="width=device-width, initial-scale=1">
	<link href="/style/style.css" rel="stylesheet">
	<title><?php echo $pageData['title'];?></title>

</head>
<body style="background-color:#FFF8F0">
	<header>
  <?php
	if (isset($pageData['account']['form1']))
	{
		include_once($pageData['account']['form1']);
	}
	?>
	</header>
	<div class="logo-name" >
		<h1 style="">Магазин электроники</h1>
	</div>
	<div class="content" >
		<?php

   self::render2();

		?>
	</div>
	<div class="buttonShowAll" >
		<form name="button" action="/category/1/goods/1" method="post">
			<button type="submit" name="button" >Показывать все</button>
		</form>
	</div>
	<footer>
			<p>Официальный магазин электроники</p>
	</footer>
</body>
</html>
