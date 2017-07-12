<?php
	
	class Bootstrap{
		public function Init(){
			define("PATH_SYSTEM",__DIR__.'/application');
			require_once (PATH_SYSTEM.'/config/database.php');
			include_once(PATH_SYSTEM."/core/db.php");
			include_once(PATH_SYSTEM."/core/model.php");
			include_once PATH_SYSTEM ."/core/common.php";
			Load_File();
		}
	}
?>