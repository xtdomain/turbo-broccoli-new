<?php
$content->addRoute();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $pageData['title'];?></title>
	<meta name="vieport" content="width=device-width, initial-scale=1">
	<link href="/style/style.css" rel="stylesheet">

</head>
<body style="background-color:#FFF8F0">
	<header style="position: fixed; top: 0em; right: 0em; background:#99CCFF; height: 3em; width: 100%; z-index: 2; animation: 1s ease slideInFromLeft; ">
	</header>
	<div class="flexContainer">
		<div class="logoCompany">
			<div class="" style="position: fixed; z-index: 2; margin-top: -10px; ">
				<p><a href="<?php echo "/" . Route::$templateName; ?>"><img src="img/logo1.png" class="logotip" alt="Logo-Company"></p></a>
			</div>
		</div>
		<div class="content" style="">
			<div class="logo-name"  style=" position: relative; left: 0em; margin-top: 5em; right: 0em; ">
				<h1 style="text-align:center">Магазин электроники</h1>
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
	<div class="content">
		<div class="buttonShowAll" >
			<div class="pagination">
			<form name="button" action="/category/1/goods/1/admintable/1" method="post">
				<input name='button' type='submit' name="button" value='Показывать все' class='paginationPhp' style='color: #8B0000; background: #DEB887; width:120px;'/>
			</form>
		</div>

		</div>

	</div>
	<footer>
		<p style='float: left'>© Copyright Фалежинский Дмитрий Андреевич 2020 </p><p>Официальный магазин электроники</p>
	</footer>
</body>
</html>
