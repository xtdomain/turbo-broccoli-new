<?php
class Route {
  public $save; // хранит текстовый кусок url - запущенного в этот момент (контроллера перед дейсвтвием, если действия является пагинацией)
  public static function mainRoute()
  { //этот метод запускает стандартный контроллер, который в свою очередь вызывает шаблон, последний подключает роутер
    $route = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    if($route[2] == 'out') //временное решение - в контроллере админ невозможно вызвать header методом out
    {
      session_destroy();
      header("Location: /");
    }
    if ($route[1] !== 'admin')
    {
      Route::startController("defaultController", "defaultModel", "default", $g, $save);
    }
    else if ($route[1] == 'admin')
    {
      Route::startController("adminController", "adminModel", "default", $g, $save);
    }
  }
  public static function startController($controllerName, $modelName, $action, $g, $save) //Автоматическое подключение модулей
  {
    require_once CONTROLLERS . $controllerName. ".php";
    require_once MODELS . $modelName. ".php";
    $controller = new $controllerName();
    $controller->infos($save, $g); //передать имена контроллеров в контроллер (перехват из save - и передача в основной контроллер - критически важный параметр)
    $controller->$action();
  }
  public static function addRoute($name)
  {
    $g = $name;
    $controllerName = "defaultController";
    $modelName = "defaultModel";
    $action = "default";
    $route = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    if (empty($route[1]) || ($route[1] == 'default' && empty($route[2])) || ($route[1] == 'admin' && empty($route[2]))) //Подключение списка товаров и услуг на стартовой странице и в админке
    {
      Route::startController("goodsController", "goodsModel", "default", $g, $save);
      Route::startController("categoryController", "categoryModel", "default", $g, $save);
    }
    $i = count($route)-1;
    while($i > 0)
    {
      if ($route[$i] != '')
      {
        if(is_file(CONTROLLERS. ucfirst($route[$i]) . "Controller.php") && !is_numeric($route[$i])) //поиск контроллера в папке
        {
          $controllerName = ucfirst($route[$i]) . "Controller";
          $modelName = ucfirst($route[$i]). "Model";
          if (($route[$i] == 'admin') && ($i > 1)) //вызвать ошибку если пытаться admin вызвать не в начале url
          {
            CallError::CallErrors();
          }
          Route::startController($controllerName, $modelName, $action, $g, $save); //подключить все остальные модули по порядку
        }
        else if (!is_numeric($route[$i]))
        {
          $action = $route[$i];
        }
        else
        {
          $action = "page";
          $save = $route[$i-1]; //сохраненить имя контроллера перед пагинацией
        }
      }
      $i--;
    }
  }

  public function errorPage()
  {
  }
}
class CallError { //класс вызова ошибки
  public static function CallErrors()
  {
    http_response_code(404);
    include_once('my_404.php');
    die();
  }
}
?>
