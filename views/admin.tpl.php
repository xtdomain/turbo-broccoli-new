<?php
$content->startRoute('admin');
$content->addRoute();
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
	<header style="position: fixed; top: 0em; right: 0em; background:#FFCCCC; height: 3em; width: 100%; z-index: 2; animation: 1s ease slideInFromLeft; ">
	</header>
	<div class="flexContainer">
		<div class="logoCompany">
			<div class="" style="position: fixed; z-index: 2; margin-top: -10px; ">
				<p><a href="<?php echo "/" . Route::$templateName; ?>"><img src="img/logo1.png" class="logotip" alt="Logo-Company"></p></a>
			</div>
		</div>
		<div class="content" style="">
			<div class="logo-name" style="padding-left: 1em; position: relative; left: 0em; margin-top: 5em; right: 0em; ">
				<h1 style="text-align:center">Администрирование</h1>
			</div>
			<div class="content"  >
				<?php
				self::render2();
				?>
			</div>
		</div>
		<div class="accountExit" >
			<?php
			if (isset($pageData['account']['form1']))
			{
				include($pageData['account']['form1']);
			}
			?>
		</div>
	</div>
	<footer>
		<div class="footer" style="padding-right: 1em;text-align:right; position: fixed; left: 0em; bottom: 0em; right: 0em; background:#D3D3D3; height: 3em">
			<p>Официальный магазин электроники</p>
		</div>
	</footer>
</body>
</html>
