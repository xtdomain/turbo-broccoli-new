<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="vieport" content="width=device-width, initial-scale=1">
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
<div class="logo-form" style="padding-left: 1em;text-align:left; position: fixed; left: 0em; top: 0em; right: 0em; background:#99CCFF; height: 3em; z-index: 2">
<p><a href="/"><img src="img/logo1.png" class="logotip" alt="Logo-Company"></p></a>
</div>
</header>
<?php
if(isset($pageData['account']['form1'])){
include($pageData['account']['form1']);
}
?>
<div class="logo-form" style="padding-left: 1em;text-align:left; position: relative; left: 0em; margin-top: 5em; right: 0em; z-index: 1">
<h1 style="text-align:center">Магазин электроники</h1>
</div>
<div class="button-all">
	<?php
/*
	echo "<div style='position: relative; margin-top: 1em; margin-bottom: 1em;'>";
	if(isset($pageData['goods_table_view']['form1'])){
	include($pageData['goods_table_view']['form1']);
	echo "</div>";
	}
*/
	?>
<form class="button" name="button" action="http://catalog-site.example.ru/category/1/goods/1/" method="post">
<button type="submit" name="button">Показывать все</button>
</form>

</div>












<footer>
	 <div class="footer" style="padding-right: 1em;text-align:right; position: fixed; left: 0em; bottom: 0em; right: 0em; background:#D3D3D3; height: 3em; z-index: 2">
		 <p>Официальный магазин электроники</p>
	 </div>
 </footer>
  </body>
</html>
