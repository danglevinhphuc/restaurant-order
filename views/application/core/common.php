<?php
if(!defined("PATH_SYSTEM")) die ('Bad requested!');
function Load_File(){
	$config = include PATH_SYSTEM."/config/init.php";

	$controller = empty($_GET['c']) ? $config["default_controller"] : $_GET['c'];

	$action = empty($_GET["a"]) ? $config["default_action"] : $_GET["a"];

		 // Kiểm tra file controller có tồn tại hay không
	if (!file_exists(PATH_SYSTEM  . '/controller/' . $controller . '.php')){
		die (page_404());
	}
	// Include controller chính để các controller con nó kế thừa
	include_once PATH_SYSTEM . '/core/controller.php';

	require_once PATH_SYSTEM . '/controller/' . $controller . '.php';

    // Kiểm tra class controller có tồn tại hay không
	if (!class_exists($controller)){
		die (page_404());
	}
 // Khởi tạo controller
	$controllerObject = new $controller();

    // Kiểm tra action có tồn tại hay không
	if ( !method_exists($controllerObject, $action)){
		die (page_404());
	}
      // Chạy ứng dụng
	$controllerObject->$action();
}
function page_404(){
	echo '<html><body>
  <div class="container content-top">
   <h2 class="text-news">Không tìm thấy trang</h2>
   <div class="userPrompt">
      <img src="https://lc-www-live-s.legocdn.com/r/www/-/media/portal%20v2010/errors/404%20mainstage%20image.jpg?l.r2=1953967734" alt="" />
</body></html>';
}
?>