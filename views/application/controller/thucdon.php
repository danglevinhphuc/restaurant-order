<?php if ( ! defined('PATH_SYSTEM')) die ('Bad requested!');
class Thucdon extends controller{
	function __construct(){
		// chong clickjacking
		header('X-Frame-Options: DENY');
	}
	// Tao csurf chong hack upload data
	public static function csurf($ktxuathien){
		$token = array("a","b","c","d","e","f","r","g","s","y","A","B","C","D","E","F","R","S","M","N"
			,"1","2","3","4","5","6","7","8","9","0");
		$kq = "";
		for ($i=0; $i <$ktxuathien ; $i++) { 
			$kq = $kq. $token[rand(0,count($token)-1)];
		}
		return $kq;
	}
	// SHow giao dien quan ly thuc don gom tat ca cac thuc don da thuc them vao vao
	public function quanlythucdon(){
		if(isset($_SESSION["quanly"]) || isset($_SESSION["admin"])){
			include (PATH_SYSTEM."/model/monan.php");
			$monan= new monan();
			$result = $monan->showMonan();
			$this->view("quanlythucdon",$result);
		}else{
			header('Location: http://localhost:8000/php-socket/views/');
		}
		
	}
	// Show giao dien them thuc don
	public function themthucdon(){
		//Tao token
		if(isset($_SESSION["quanly"]) || isset($_SESSION["admin"])){
			$token = $this::csurf(30);
			$_SESSION["token_themthucdon"]= $token ;
			$this->view("themthucdon",$token);
		}else{
			header('Location: http://localhost:8000/php-socket/views/');
		}
	}
	// Nhan thong tin tu form them thong tin
	public function sendthemthucdon(){
		//Tao token
		include (PATH_SYSTEM."/model/monan.php");
		$monan= new monan();
		if(isset($_SESSION["quanly"]) || isset($_SESSION["admin"])){
			$token =  $_POST['token'];
			if($_SESSION["token_themthucdon"] == $token){
				if($_POST['giamonan'] >= 0){
					$tenmon = $_POST['tenmonan'];
					$loaimonan = $_POST['loaimonan'];
					$giamonan = $_POST['giamonan'];
					$mota = $_POST['mota'];
					$hinhmonan = $_FILES["hinhmonan"];
					// Them hinh vao thu muc
					$info_hinh1 = !empty($hinhmonan["tmp_name"]) ? getimagesize($hinhmonan['tmp_name']) : "";
					if($info_hinh1 != "" ){
						if($info_hinh1 === FALSE){

						}else{
							move_uploaded_file($hinhmonan["tmp_name"], "lir/images/".$hinhmonan["name"]);
						}
					}
					$result= $monan->themThucdon(array($tenmon,$giamonan,$loaimonan,$mota,$hinhmonan["name"]));
				}else{
					setcookie("flash-error","Giá món nhỏ hơn 0 không hợp lệ",time()+1);
					header('Location: http://localhost:8000/php-socket/views/?c=thucdon&a=themthucdon');
				}
				
			}else{
				header('Location: http://localhost:8000/php-socket/views/');
			}
			
		}else{
			header('Location: http://localhost:8000/php-socket/views/');
		}
	}
	// ajax check ten mon 
	// ton tai hay khong
	public function checkmon(){
		include (PATH_SYSTEM."/model/monan.php");
		$monan= new monan();
		if(isset($_SESSION["quanly"]) || isset($_SESSION["admin"])){
			$item = $_POST['item'];
			$result = $monan->checkMon($item);
			if($result){
				echo "<span style='color:#4cae4c'>Bạn có thể chọn tên này</span>";
			}else{
				echo "<span style='color:#d9534f'>Tên đã tồn tại hãy chọn tên khác</span>";
			}
		}
	}
	// Ham de xoa mon an theo ID
	public function xoamonan(){
		include (PATH_SYSTEM."/model/monan.php");
		$monan= new monan();
		if(isset($_SESSION["quanly"]) || isset($_SESSION["admin"])){
			$item = $_GET['id'];
			$result = $monan->xoaMonan($item);
		}else{
			header('Location: http://localhost:8000/php-socket/views/');
		}
	}
	//Show giao dien Xoa sua san pham
	//gia tri dau vai idmonan
	public function suamonan(){
		include (PATH_SYSTEM."/model/monan.php");
		$monan= new monan();
		if(isset($_SESSION["quanly"]) || isset($_SESSION["admin"])){
			$item = $_GET['id'];
			$token = $this::csurf(30);
			$_SESSION["token_suathucdon"]= $token ;
			$result = $monan->showMonan($item );
			$kq = array(
				'token' => $token,
				'result' => $result
				);
			$this->view("suamonan",$kq);
		}else{
			header('Location: http://localhost:8000/php-socket/views/');
		}
	}
	// Sua mon an duoc nhan du lieu kieu POST
	// check hinh anh co thay doi hay khong
	public function sendsuathucdon(){
		include (PATH_SYSTEM."/model/monan.php");
		$monan= new monan();
		if(isset($_SESSION["quanly"]) || isset($_SESSION["admin"])){
			$token =  $_POST['token'];
			if($_SESSION["token_suathucdon"] == $token){
				if($_POST['giamonan'] >= 0){
					$idmonan = $_POST['id'];
					$tenmon = $_POST['tenmonan'];
					$loaimonan = $_POST['loaimonan'];
					$giamonan = $_POST['giamonan'];
					$mota = $_POST['mota'];
					// hinh cu duoc lay ve chi can lay ten vi trong csdl da ton tai
					$hinh1_cu = $_POST["hinh_anh_cu"];
					$hinh1 = $_FILES["hinhmonan"];
					$info_hinh1 = !empty($hinh1["tmp_name"]) ? getimagesize($hinh1['tmp_name']) : "";
					// check neu ton tai hinh moi thi them vao k thi lay hinh cu
					if($hinh1['name'] != null){
						if($info_hinh1 != "" ){

							if($info_hinh1 === FALSE){

							}else{
								move_uploaded_file($hinh1["tmp_name"], "lir/images/img/".$hinh1["name"]);
								$hinh = $hinh1["name"];
							}
						}
					}else{
						$hinh = $hinh1_cu;
					}
					$result= $monan->suaThucdon(array($idmonan,$tenmon,$giamonan,$loaimonan,$mota,$hinh));
				}else{
					setcookie("flash-error","Giá món nhỏ hơn 0 không hợp lệ",time()+1);
					header('Location: http://localhost:8000/php-socket/views/?c=thucdon&a=quanlythucdon');
				}
			}else{
				header('Location: http://localhost:8000/php-socket/views/');
			}
		}
	}
}
?>