<?php
class Route {
  public static $save; // хранит текстовый кусок url - запущенного в этот момент (контроллера перед дейсвтвием, если действия является пагинацией)
  public static $templateName; //хранит имя шаблона

  public static function startRoute($name) //сохраняет имя шаблона (например default, admin)
  {
      Route::$templateName = $name;
  }

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
      Route::startController("defaultController", "defaultModel", "default");
    }
    else if ($route[1] == 'admin')
    {
      Route::startController("adminController", "adminModel", "default");
    }
  }
  public static function startController($controllerName, $modelName, $action) //Автоматическое подключение модулей
  {
    require_once CONTROLLERS . $controllerName. ".php";
    require_once MODELS . $modelName. ".php";
    $controller = new $controllerName();
    $controller->infos(self::$save, self::$templateName); //передать имена контроллеров в контроллер (перехват из save - и передача в основной контроллер - критически важный параметр)
    $controller->$action();
  }

  public static function addRoute()
  {


    $controllerName = "defaultController";
    $modelName = "defaultModel";
    $action = "default";
    $route = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    if (empty($route[1]) || ($route[1] == 'default' && empty($route[2])) || ($route[1] == 'admin' && empty($route[2]))) //Подключение списка товаров и услуг на стартовой странице и в админке
    {
      Route::startController("admintableController", "admintableModel", "default");

      Route::startController("goodsController", "goodsModel", "default");
      Route::startController("categoryController", "categoryModel", "default");

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
Route::CallErrors();
          }

          Route::startController($controllerName, $modelName, $action); //подключить все остальные модули по порядку
        }
        else if (!is_numeric($route[$i]))
        {
          $action = $route[$i];
        }
        else
        {
          $action = "page";
          self::$save = $route[$i-1]; //сохраненить имя контроллера перед пагинацией

        }
      }
      $i--;
    }
  }

  public static function CallErrors() //метод вызова ошибки
  {
      http_response_code(404);
      include_once('my_404.php');
      die();

  }
}

?>
