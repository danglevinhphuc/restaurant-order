<?php if ( ! defined('PATH_SYSTEM')) die ('Bad requested!');
class Thongke extends controller{
	function __construct(){
		// chong clickjacking
		header('X-Frame-Options: DENY');
	}
	// Show giao dien thong ke
	public function index(){
		// chi co the quan ly va admin vao dk
		if(isset($_SESSION["quanly"]) || isset($_SESSION["admin"])){
			include (PATH_SYSTEM."/model/thanhtoan.php");
			$thanhtoan= new thanhtoan();
			// goi den model get data
			// lay ngay va thang nam hien tai
			//$data_hientai = new Date();
			$ngay = date("d");
			$thang= date("m");
			$nam = date("Y");
			$result= $thanhtoan->thongKe($ngay,$thang,$nam);
			$this->view("thongke",$result);
		}else{
			header('Location: http://phucrestaurant.esy.es/');
		}
	}
}
?>