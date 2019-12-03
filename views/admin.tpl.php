<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $pageData['title']; ?></title>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular.min.js"></script>
	<meta name="vieport" content="width=device-width, initial-scale=1">
	<style>
	@keyframes slideInFromLeft {
	  0% {
	    background:#99CCFF;
			border-color: #99CCFF;
	  }
	  100% {
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
	<div class="logo-form" style="padding-left: 1em;text-align:left; position: absolute; left: 0em; top: 0em; right: 0em; background:#FFCCCC; height: 3em; animation: 1s ease slideInFromLeft">
	 <div id="logo">
		 <p><img src="img/logo1.png" class="logotip" alt="Logo-Company"></p>
	 </div>
	</div>
</header>
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

<div style="position:relative">
	<?php
if(isset($pageData['tables']['table-category'])){
include($pageData['tables']['table-category']);
}



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
