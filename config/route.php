<?php
class Route {
  public static $save; // хранит текстовый кусок url - запущенного в этот момент (контроллера перед дейсвтвием, если действия является пагинацией)
  public static $templateName; //хранит имя шаблона
  public static $templateList = array("admin", "default"); //хранит имена шаблона
  public static function startRoute($name) //сохраняет имя шаблона (например default, admin)
  {
      Route::$templateName = $name;

  }

  public static function mainRoute()
  { //этот метод запускает стандартный контроллер, который в свою очередь вызывает шаблон, последний подключает роутер
    $firstRoute = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    $base = "default"; //указать стартовый шаблон
    $templateList = array("admin", "default"); //указать список шаблонов
    foreach ($templateList as $key => $value)
    {
      if ($firstRoute[1] == $value) //если на первом месте шаблон из списка
      {
        $controllerName = $value . "Controller";
        $modelName = $value . "Model";
        Route::startController($controllerName, $modelName, "default");
      }
      else //иначе запустить стартовый шаблон
      {
        $controllerName = $base . "Controller";
        $modelName = $base . "Model";
        Route::startController($controllerName, $modelName, "default");
      }
    }
  }

  public static function startController($controllerName, $modelName, $action) //Автоматическое подключение модулей
  {
    require_once CONTROLLERS . $controllerName. ".php";
    require_once MODELS . $modelName. ".php";
    $controller = new $controllerName();
    $controller->infos(self::$save, self::$templateName); //передать имена контроллеров в контроллер (перехват из save - и передача в основной контроллер - критически важный параметр)

    if (method_exists($controllerName, $action))
    {
      $controller->$action();
    }
    else
    {
      Route::CallErrors();
      echo "string";
    }
  }

  public static function addRoute()
  {
    $controllerName = "defaultController";
    $modelName = "defaultModel";
    $action = "default";
    $route = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    if (empty($route[1]) || ($route[1] == 'default' && empty($route[2])) || ($route[1] == 'admin' && empty($route[2]))) //Подключение списка товаров и услуг на стартовой странице и в админке
    {

      Route::startController("goodsController", "goodsModel", "default");
      Route::startController("categoryController", "categoryModel", "default");
      if ($route[1] == 'admin')
      {
        Route::startController("admintableController", "admintableModel", "default"); //таблица редактирования БД только после входа в ЛК
      }
    }
    $i = count($route)-1;
    while($i > 0)
    {
      if ($route[$i] != '')
      {
        if(is_file(CONTROLLERS. ucfirst($route[$i]) . "Controller.php") ) //поиск контроллера в папке
        {
          $controllerName = ucfirst($route[$i]) . "Controller";
          $modelName = ucfirst($route[$i]). "Model";
          if ($route[$i] == 'admintable' && $route[1] != 'admin') //таблица редактирования БД только после входа в ЛК
          {
            Route::CallErrors();
          }
          if(!is_file(CONTROLLERS. ucfirst($route[$i+1]) . "Controller.php")) //если контроллер найден, то за ним должно быть действие
          {
            if(!is_file(CONTROLLERS. ucfirst($route[$i+2]) . "Controller.php")) //если действие есть, значит за ним снова должно быть контроллер
            {
              Route::CallErrors();
            }
            if (!is_numeric($route[$i+1]))
            { //действие - метод
              $action = $route[$i+1];
              Route::startController($controllerName, $modelName, $action);
              if (!method_exists($controllerName, $action))
              {
                Route::CallErrors();
              }
            }
            else if(is_numeric($route[$i+1]))
            { //действие - номер страницы
              $action = 'page';
              self::$save = $route[$i]; //сохранить имя контроллера перед пагинацией
              Route::startController($controllerName, $modelName, $action);
              if (!method_exists($controllerName, $action))
              {
                Route::CallErrors();
              }
            }
          }
          else if (empty($route[$i+1]) && $route[$i] != 'default'  && $route[$i] != 'admin')
          {
            $route[$i+1] = 1; //если контроллер найден, а действие после него отсутствует -> страница номер 1
            $action = 'page';
            self::$save = $route[$i]; //сохраненить имя контроллера перед пагинацией
            Route::startController($controllerName, $modelName, $action);
            if (!method_exists($controllerName, $action))
            {
              Route::CallErrors();
            }
          }
        }
        else if ($i<2)
        {
          $action = $route[$i]; //проверка первого элемента массива (catalog-site.ru/? или catalog-site.ru/admin/?) если метода нет в шаблоне - вызвать ошибку
          if (!method_exists($controllerName, $action))
          {
            Route::CallErrors();
          }
        }
      }
      else if (empty($route[$i]) && $i != 1) //проверка на символ / и отсутствие контроллера/действия после него (пустой запрос) - вместо ошибки можно сделать вывод 1 страницы
      {
        /*array_pop ($route);
        array_push ($route, "1");
        $url = implode("/", $route);
        header("Location:" . implode("/", $route));*/
        Route::CallErrors();
      }
      $i--;
    }
  }
  public static function CallErrors() //метод вызова ошибки
  {
    http_response_code(404);
	include('my_404.php');
	die();
  }
}
?>
