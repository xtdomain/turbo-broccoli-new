<?php
/*$route = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
if (empty($route[1])) {
header('Location: http://catalog-site.example.ru/goods/1/category/1/');
}*/

class Route {
  public $save;
  public static function startController($controllerName, $modelName, $action, $g, $save) { //Автоматическое подключение модулей
    require_once CONTROLLERS . $controllerName. ".php";
    require_once MODELS . $modelName. ".php";
    $controller = new $controllerName();
    $g = $controller->infos($save); //передать имена контроллеров в контроллер
//print_r($controllerName);
  $controller->$action();
  }

  public static function addRoute() {

    $controllerName = "defaultController";
    $modelName = "defaultModel";
    $action = "default";
    $route = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
if ($route[1] !== 'admin') {
Route::startController($controllerName, $modelName, $action, $g, $save); //Обязателшьно подключить стандартный модуль - главная страница и основной вид
if (empty($route[1])) {
  $controllerName = "goodsController";
  $modelName = "goodsModel";
  $action = "default";
  Route::startController($controllerName, $modelName, $action, $g, $save);
  $controllerName = "categoryController";
  $modelName = "categoryModel";
  $action = "default";
Route::startController($controllerName, $modelName, $action, $g, $save);
}
}
    $i = count($route)-1;
//print_r($route[$i]);
    while($i > 0) {
      if($route[$i] != '') {
        if(is_file(CONTROLLERS. ucfirst($route[$i]) . "Controller.php") && !is_numeric($route[$i])){   //на четвертом контроллер не нужен, выполняется обработка только чисел для пагинации
          $controllerName = ucfirst($route[$i]) . "Controller";
            $modelName = ucfirst($route[$i]). "Model";
            if (($route[$i] == 'admin') && ($i > 1)) {
              CallError::CallErrors();
            }
        Route::startController($controllerName, $modelName, $action, $g, $save); //подключить все остальные модули по порядку
        } else if (!is_numeric($route[$i])){
          $action = $route[$i];

//$save = $action;

//print_r($action);
} else {
    $action = "page";
$save = $route[$i-1]; //сохраненить имя контроллера перед пагинацией

}
}
      $i--;
    }
  }
  public function errorPage() {

  }
}
class CallError { //класс вызова ошибки
  public static function CallErrors() {
    http_response_code(404);
    include('my_404.php');
    die();
  }
}
?>
