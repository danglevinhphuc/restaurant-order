<?php if ( ! defined('PATH_SYSTEM')) die ('Bad requested!');
class Trangchu extends controller{
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
	public function index(){

		$this->view("index");
	}
	// giao dien chia ban
	public function chiaban(){
		//Tao token
		if(isset($_SESSION["quanly"]) || isset($_SESSION["admin"])){
			$token = $this::csurf(30);
			$_SESSION["token_nhapban"]= $token ;
			$this->view("chiaban",$token);
		}else{
			header('Location: http://localhost:8000/php-socket/views/');
		}
	}
	// gui yeu cau chia danh sach ban tu form
	public function sendchiaban(){
		if(isset($_SESSION["quanly"]) || isset($_SESSION["admin"])){
			include (PATH_SYSTEM."/model/table.php");
			$token = $_POST['token'];
			if($_SESSION["token_nhapban"] == $token ){
				$soluongban = $_POST["so_ban"];
				$tenban = $_POST["ten_ban"];
				$table= new table();
				$kq = $table->chiaban($soluongban,$tenban);
			}else{
				header('Location: http://localhost:8000/php-socket/views/');
			}
		}else{
			header('Location: http://localhost:8000/php-socket/views/');
		}
	}
	// trinh bai tat ca ban 
	public function showBan(){
		if(isset($_SESSION["login"])){
			include (PATH_SYSTEM."/model/table.php");
			include (PATH_SYSTEM."/model/monan.php");
			// du lieu ten ban va ma ban
			$table= new table();
			$kq = $table->showban();
			// du lieu ten thuc an
			$monan  = new monan();
			$showmonan  = $monan->showMonan();
			$result = array(
				'kq' => $kq,
				'monan'=> $showmonan
				);
			$this->view("showban" , $result);
		}else{
			header('Location: http://localhost:8000/php-socket/views/');
		}
	}

	// xoa tat ca ban 
	public function xoahet(){
		if(isset($_SESSION["quanly"]) || isset($_SESSION["admin"])){
			include (PATH_SYSTEM."/model/table.php");
			$table= new table();
		//neu co ma ban thi thi 1 ban con k thi xoa het
			$maban= isset($_GET['maban']) ? $_GET['maban'] : 0;
			$kq = $table->xoahet($maban);
		}else{
			header('Location: http://localhost:8000/php-socket/views/');
		}
	}
	// giao dien sua ten ban
	public function suatenban(){
		if(isset($_SESSION["quanly"]) || isset($_SESSION["admin"])){
			include (PATH_SYSTEM."/model/table.php");
			$table= new table();
		// Tao token chong hack cho sua ban
			$token = $this::csurf(30);
			$_SESSION["token_suaban"]= $token;

			$maban= isset($_GET['maban']) ? $_GET['maban'] : 0;
		// Ta lay id cua ten ban de get du lieu
			$kq = $table->suatenban($maban);
		/* *** Tao mang luu du lieu truyen den view gom 2 phan
		   *** 1: ket qua tra ve cua thong tin ban
		   *** 2: token chong hack		 **/

		$data = array(
			'kq' => $kq,
			'token' => $token
			);
		$this->view("suatenban",$data);
	}else{
		header('Location: http://localhost:8000/php-socket/views/');
	}
}
	// gui yeu cau sua ten ban tu form
public function sendsuatenban(){
	if(isset($_SESSION["quanly"]) || isset($_SESSION["admin"])){
		include (PATH_SYSTEM."/model/table.php");
		$table= new table();
		$token = $_POST['token'];
		if($_SESSION["token_suaban"] == $token ){
			// lay gia tri tu form neu khong ton tai dua ve gia tri mac dinh
			$maban= isset($_POST['maban']) ? $_POST['maban'] : 0;
			$tenban= isset($_POST['tenban']) ? $_POST['tenban'] : "";
			$kq = $table->fixNametable($maban,$tenban);
		}else{
			header('Location: http://localhost:8000/php-socket/views/');
		}
	}else{
		header('Location: http://localhost:8000/php-socket/views/');
	}
}
	// giao dien dang ky
public function dangky(){
	if(isset($_SESSION['admin'])){
		$token = $this::csurf(30);
		// TAO TOKEN CHONG HACK
		$_SESSION["token_dangky"]= $token;
		$this->view("dangky",$token);
	}else{
		header('Location: http://localhost:8000/php-socket/views/');
	}
}
	// gui yeu cau dang ky
public function senddangky(){
	if(isset($_SESSION['admin'])){
		include (PATH_SYSTEM."/model/users.php");
		$users= new nguoidung();

		$token = $_POST['token'];
		//echo preg_match('/^\d+$/',$_POST["sdt"]);
		// kiem tra gia tri dau vao 
		// gom co cmnd la so va lon hon 8
		// sdt la so va lon hon 9
		// password phai trung va nhap lai password
		if($_SESSION["token_dangky"] == $token ){
			if(preg_match('/^\d+$/',$_POST["cmnd"]) != 0 && strlen($_POST["cmnd"]) >8){
				if( preg_match('/^\d+$/',$_POST["sdt"]) != 0  && strlen($_POST["sdt"]) >9){
					if($_POST["password"] === $_POST['password-again']){
						$username = $_POST['username'];
						$ho = $_POST['ho'];
						$ten = $_POST['ten'];
						$diachi = $_POST['diachi'];
						$cmnd = $_POST['cmnd'];
						$sdt = $_POST['sdt'];
						$password= $_POST['password'];
						$ngaysinh = $_POST['ngaysinh'];
						$gioitinh = $_POST['gioitinh'];

				//gui du lieu mang den module de xy ly
						$result = $users->sendDangky(array($username,$ho,$ten,md5($password),$ngaysinh,$gioitinh,$sdt,$cmnd,$diachi));
					}else{
						setcookie("flash-error","Password không chính xác",time()+1);
						header('Location: http://localhost:8000/php-socket/views/?c=trangchu&a=dangky');
					}
				}else{
					setcookie("flash-error","SĐT không hợp lệ hãy kiểm tra lại",time()+1);
					header('Location: http://localhost:8000/php-socket/views/?c=trangchu&a=dangky');
				}
			}else{
				setcookie("flash-error","CMND không hợp lệ hãy kiểm tra lại",time()+1);
				header('Location: http://localhost:8000/php-socket/views/?c=trangchu&a=dangky');
			}
		}else{
			header('Location: http://localhost:8000/php-socket/views/');
		}
	}else{
		header('Location: http://localhost:8000/php-socket/views/');
	}
}
	// giao dien dang nhap
public function dangnhap(){
	if(!isset($_SESSION["login"])){
		include (PATH_SYSTEM."/model/users.php");
		$users= new nguoidung();
		// TAO TOKEN CHONG HACK
		$token = $this::csurf(30);
		$_SESSION["token_dangnhap"]= $token;
		$this->view("dangnhap",$token);
	}else{
		header('Location: http://localhost:8000/php-socket/views/');
	}
}
	// gui yeu cau dang nhap tu form
public function senddangnhap(){
	if(!isset($_SESSION["login"])){
		include (PATH_SYSTEM."/model/users.php");
		$users= new nguoidung();
		$token = $_POST['token'];
		if($_SESSION["token_dangnhap"] == $token ){
			$username= $_POST['username'];
			$password = $_POST['password'];
			$result = $users->sendDangnhap($username,md5($password));
		}else{
			header('Location: http://localhost:8000/php-socket/views/');
		}
	}else{
		header('Location: http://localhost:8000/php-socket/views/');
	}
}
	// TAI KHOAN dang xuat
public function dangxuat(){
		// Xóa session name
	if(isset($_SESSION["login"])){
		unset($_SESSION['login']);
		unset($_SESSION['quanly']);
		unset($_SESSION['phucvu']);
		if(isset($_SESSION["admin"])){
			unset($_SESSION['admin']);
		}
		session_regenerate_id(true); 
		header('Location: http://localhost:8000/php-socket/views/');
	}else{
		header('Location: http://localhost:8000/php-socket/views/');
	}
}
	//Giao dien CAp quyen cho nguoi dung
public function capquyen(){
	if(isset($_SESSION["admin"])){
		include (PATH_SYSTEM."/model/users.php");
		$users= new nguoidung();
		// TAO TOKEN CHONG HACK
		$token = $this::csurf(30);
		$_SESSION["token_capquyen"]= $token;
		// lay du lieu tai khoan
		$taikhoan = $users->capquyen();
		$result = array(
			'taikhoan' => $taikhoan,
			'token' => $token
			);
		$this->view("capquyen",$result);
	}else{
		header('Location: http://localhost:8000/php-socket/views/');
	}
}
	// Gui du lieu cap quyen tu form gom co username va quyen duoc cap
public function sendcapquyen(){
	if(isset($_SESSION["admin"])){
		include (PATH_SYSTEM."/model/phanquyen.php");
		$phanquyen= new phanquyen();
		$token = $_POST['token'];
		if($_SESSION["token_capquyen"] == $token ){
			$username = $_POST['username'];
			$phucvu= isset($_POST['phucvu']) ? $_POST['phucvu'] : 0;
			$quanly= isset($_POST['quanly']) ? $_POST['quanly'] : 0;
			$result = $phanquyen->sendCapquyen(array($username,$phucvu,$quanly));
		}else{
			header('Location: http://localhost:8000/php-socket/views/');
		}
	}else{
		header('Location: http://localhost:8000/php-socket/views/');
	}
}
// Tim kiem theo ajax de cap quyen cho nguoi dung
public function timAjax(){
	if(isset($_SESSION["admin"])){
		include (PATH_SYSTEM."/model/users.php");
		$users= new nguoidung();
		if($_POST["loai_sp"] != "admin"){
			$tim = $_POST["loai_sp"];
		}else{
			$tim = " ";
		}
		
		$result = $users->timAjax($tim);
		// chuyen sang dnag json
		$convert = json_encode($result);
		echo $convert;
	}
}
// SHow thong tin cua tung nhan vien ra giao dien quan ly
public function quanlynhanvien(){
	if(isset($_SESSION["admin"])){
		include (PATH_SYSTEM."/model/users.php");
		$users= new nguoidung();
		$result = $users->quanlynhanvien();
		$this->view("quanlynhanvien",$result);
	}else{
		header('Location: http://localhost:8000/php-socket/views/');
	}
}
// SHow giao dien them luong cho nhan vien 
public function themluong(){
	if(isset($_SESSION["admin"])){
		include (PATH_SYSTEM."/model/users.php");
		$users= new nguoidung();
		// kiem tra thanh url neu co va neu k có 
		if(isset($_GET['id']) ){
			if($_GET['id'] != null){
				$token = $this::csurf(30);
				$_SESSION["token_themluong"]= $token;
				$username = $_GET['id'];
				$kq = $users->capquyen($username);
				// truyen ket qua va token chong hack
				$result =array(
					'result' => $kq,
					'token'=> $token
					);
				$this->view("themluong",$result);	
			}else{
				header('Location: http://localhost:8000/php-socket/views/');
			}
		}else{
			header('Location: http://localhost:8000/php-socket/views/');	
		}
	}else{
		header('Location: http://localhost:8000/php-socket/views/');
	}
}
// Nhan data tu form thong quan post 
public function sendthemluong(){
	if(isset($_SESSION["admin"])){
		include (PATH_SYSTEM."/model/users.php");
		$users= new nguoidung();
		// kiem tra thanh url neu co va neu k có 
		$token = $_POST['token'];
		if($_SESSION["token_themluong"] === $token){
			$luong = $_POST['luong'];
			$username = $_POST['id'];
			// truyen 2 tham so vao de nhap luong qua model
			$result = $users->sendThemluong(array($username,$luong));
		}else{
			header('Location: http://localhost:8000/php-socket/views/');	
		}
	}else{
		header('Location: http://localhost:8000/php-socket/views/');
	}
}
// SHow giao dien sua thong tin cho nhan vien 
public function suathongtinnhanvien(){
	if(isset($_SESSION["admin"])){
		include (PATH_SYSTEM."/model/users.php");
		$users= new nguoidung();
		// kiem tra thanh url neu co va neu k có 
		if(isset($_GET['id']) ){
			if($_GET['id'] != null){
				$token = $this::csurf(30);
				$_SESSION["token_suathongtinnhanvien"]= $token;
				$username = $_GET['id'];
				$kq = $users->capquyen($username);
				// truyen ket qua va token chong hack
				$result =array(
					'result' => $kq,
					'token'=> $token
					);
				$this->view("suathongtinnhanvien",$result);	
			}else{
				header('Location: http://localhost:8000/php-socket/views/');
			}
		}else{
			header('Location: http://localhost:8000/php-socket/views/');	
		}
	}else{
		header('Location: http://localhost:8000/php-socket/views/');
	}
}
// Nhan sua thong tin nhan vien data tu form thong quan post 
public function sendsuathongtinnhanvien(){
	if(isset($_SESSION["admin"])){
		include (PATH_SYSTEM."/model/users.php");
		$users= new nguoidung();
		// kiem tra thanh url neu co va neu k có 
		$token = $_POST['token'];
		if($_SESSION["token_suathongtinnhanvien"] === $token){
			if(preg_match('/^\d+$/',$_POST["cmnd"]) != 0 && strlen($_POST["cmnd"]) >8){
				if( preg_match('/^\d+$/',$_POST["sdt"]) != 0  && strlen($_POST["sdt"]) >9){
					$username = $_POST['id'];
					$ho = $_POST['ho'];
					$ten = $_POST['ten'];
					$diachi = $_POST['diachi'];
					$cmnd = $_POST['cmnd'];
					$sdt = $_POST['sdt'];
					$ngaysinh = $_POST['ngaysinh'];
					$gioitinh = $_POST['gioitinh'];

						//gui du lieu mang den module de xy ly
					$result = $users->sendSuathongtinnhanvien(array($username,$ho,$ten,$ngaysinh,$gioitinh,$sdt,$cmnd,$diachi));
				}else{
					setcookie("flash-error","SĐT không hợp lệ hãy kiểm tra lại",time()+1);
					header('Location: http://localhost:8000/php-socket/views/?c=trangchu&a=quanlynhanvien');
				}
			}else{
				setcookie("flash-error","CMND không hợp lệ hãy kiểm tra lại",time()+1);
				header('Location: http://localhost:8000/php-socket/views/?c=trangchu&a=quanlynhanvien');
			}
		}else{
			header('Location: http://localhost:8000/php-socket/views/');	
		}
	}else{
		header('Location: http://localhost:8000/php-socket/views/');
	}
}
// Xoa nhan vien thong qua username
public function xoanhanvien(){
	if(isset($_SESSION["admin"])){
		include (PATH_SYSTEM."/model/users.php");
		$users= new nguoidung();
		if(isset($_POST['xoa'])){
			$delete = $_POST['xoa'];
			//1 tuc la xoa nhieu phan tu bang ajax 
			// hoac 1 phan tu bang ajax
			$result = $users->xoaNhanvien($delete,1);
		}else{
			if(isset($_GET['id']) ){
				if($_GET['id'] != null){
					$username = $_GET['id'];
					// 0 tuc la xoa theo kieu truyen lenh thuong
					// khong phai ajax xoa
					$result = $users->xoaNhanvien($username,0);
				}else{
					header('Location: http://localhost:8000/php-socket/views/');
				}
			}else{
				header('Location: http://localhost:8000/php-socket/views/');	
			}	
		}
	}else{
		header('Location: http://localhost:8000/php-socket/views/');
	}
}
// Nhan mon hang tu phuc vu , quan ly, admin 
// k co gia tri dau vao 
// thogn qua ajax
public function nhanMon(){
	if(isset($_SESSION["login"])){
		include (PATH_SYSTEM."/model/thanhtoan.php");
		$thanhtoan= new thanhtoan();
		// check dieu kien neu ton tai va khac rong

		if(isset($_POST['monan']) && isset($_POST['tenban'])){
			if($_POST['monan'] != null && $_POST['tenban'] != null){
				$moan = $_POST['monan'];
				$tenban = $_POST['tenban'];
				$date = new DateTime();
				$ngaydat =  $date->format('Y-m-d');
				$kq = $thanhtoan->nhanMon(array($moan,$tenban,$ngaydat));
			}
		}
		
	}
}
// Thanh toan rang buoc chi admin va quan ly thi duoc thanh toan
// thong qua gia tri ban trong ngay
public function thanhtoan(){
	if(isset($_SESSION["login"]) ){
		include (PATH_SYSTEM."/model/thanhtoan.php");
		$thanhtoan= new thanhtoan();
		// check dieu kien neu ton tai va khac rong
		if(isset($_GET['tenban'])){
			if($_GET['tenban'] != null){
				$tenban = $_GET['tenban'];
				$kq = $thanhtoan->thanhToan($tenban);
				$this->view("thanhtoan",$kq);
			}else{
				header('Location: http://localhost:8000/php-socket/views/');
			}
		}else{
			header('Location: http://localhost:8000/php-socket/views/');
		}
	}else{
		header('Location: http://localhost:8000/php-socket/views/');
	}
}

// Xác nhận thanh toan
public function xacnhanthanhtoan(){
	if(isset($_SESSION["login"]) ){
		include (PATH_SYSTEM."/model/thanhtoan.php");
		$thanhtoan= new thanhtoan();
		// check dieu kien neu ton tai va khac rong
		if(isset($_POST['tenban'])){
			if($_POST['tenban'] != null){
				$tenban = $_POST['tenban'];
				$kq = $thanhtoan->xacnhanthanhToan($tenban);
			}
		}else{
			header('Location: http://localhost:8000/php-socket/views/');
		}
	}else{
		header('Location: http://localhost:8000/php-socket/views/');
	}
}
}
?>