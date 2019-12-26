<?php
$content->startRoute('admin')
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $pageData['title']; ?></title>
	<meta name="vieport" content="width=device-width, initial-scale=1">
	<link href="/style/style_admin.css" rel="stylesheet">

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
