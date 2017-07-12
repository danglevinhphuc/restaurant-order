<?php
if(!defined('PATH_SYSTEM')) die ('Bad requested!');
class Controller{
	public function view($viewname=null,$data= null){
		// Header page

		/** 

			**$row dùng để gán trên thẻ head về các thông tin trong title hoặc meta 
			**$row load thong tin cho các sp 
		**/
		
		require PATH_SYSTEM. "/view/header.php";
		if($data){
			$row = $data;
		}
		require PATH_SYSTEM. "/view/dashboard.php";
				// page
		if($viewname){

			require PATH_SYSTEM. "/view/". $viewname .".php";

		}
		require PATH_SYSTEM. "/view/footer.php";
		
	}
}
?>