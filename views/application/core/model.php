<?php
class Model{
	private $db;
	private $classname;
	function __construct(){
		$this->db= new Database();
		$this->classname = get_class($this);
	}
	// hàm mặc định quay lại trang
	/*public function getDataslider(){
		// lay ten table trong mysql
		$talbe = strtolower($this->classname);
		$sql = "SELECT *  FROM `$talbe`";
		$this->db->setQuery($sql);
		$query = $this->db->loadAllRows();
		return $query;
	}
	// ham lay gia tri menu tu table theloa
	public function getMenu(){
		$sql  = "SELECT DISTINCT tl.*,GROUP_CONCAT( DISTINCT lt.id,':',lt.Ten,':',lt.TenKhongDau) AS
		LoaiTin,tt.id as idTin,tt.TieuDe as TieuDeTin, tt.Hinh as HinhTin,tt.TomTat as TomTatTin,
		tt.TieuDeKhongDau as TieuDeKhongDau  FROM theloai tl INNER JOIN loaitin lt ON lt.idTheLoai = tl.id INNER JOIN tintuc tt ON tt.idLoaiTin = lt.id GROUP BY tl.id";
		$this->db->setQuery($sql);
		$query = $this->db->loadAllRows();
		return $query;	
	}*/
	public function chiaban($soluong,$tenban){
		$table = strtolower($this->classname);
		$sql_check = "SELECT count(ma_ban)  FROM `$table`";
		
		$this->db->setQuery($sql_check);
		$count_check = $this->db->loadRecord();
		
		if($count_check){
			echo "Ban Da Ton Tai<br>";
			echo "<a href='http://localhost:8000/php-socket/views/?c=trangchu&a=showBan'>Xem Quản Lý Bàn</a> <br>";
			echo " <a href='http://localhost:8000/php-socket/views/?c=trangchu&a=xoahet'>Tạo Bàn Lại</a>";
		}else{
			// Tao ban khi so luong ban la rong
			for($i = 1 ; $i <= $soluong ; $i++){
				$nameTable = $tenban.$i;
				$sql = "INSERT into `$table` (ma_ban,ten_ban) VALUES (?,?)";
				$this->db->setQuery($sql);
				$query = $this->db->execute(array($i,$nameTable));
			}
			setcookie("flash","Tạo bàn thành công",time()+1);
			header('Location: http://localhost:8000/php-socket/views/?c=trangchu&a=showBan');
		}
		
	}
	// SHow het tat ca ban
	public function showban(){
		$table = strtolower($this->classname);
		$sql = "SELECT *  FROM `$table`";
		$this->db->setQuery($sql);
		$query = $this->db->loadAllRows();
		return $query;
	}
	// Xoa het tat ca ban 
	public function xoahet($maban = null){
		$table = strtolower($this->classname);
		// lay ra so tong danh sach co bao nhieu phan tu de xoa
		$sql_check = "SELECT count(ma_ban)  FROM `$table`";
		
		$this->db->setQuery($sql_check);
		$count_check = $this->db->loadRecord();
		// neu chon xoa het la co ton tai ban va k co id ma ban
		if($count_check && $maban == 0){
			// dung de lay tat ca id ma ban de xoa tat ca 
			$sql_row = "SELECT *  FROM `$table`";
			$this->db->setQuery($sql_row);
			$row = $this->db->loadAllRows();

			// Tao vong lap de lay ma ban va xoa lan luot
			for($i = 0 ; $i < count($row); $i++){
				
				$sql = 'DELETE FROM `table` WHERE ma_ban='.$row[$i]->ma_ban.'';
				
				$this->db->setQuery($sql);
				$query = $this->db->execute();
			}
			setcookie("flash","Xoá tất cả bàn thành công<br>Tạo lại từ đầu",time()+1);
			header('Location: http://localhost:8000/php-socket/views/?c=trangchu&a=chiaban');

		}// neu chon xoa het la co ton tai ban va  co id ma ban
		elseif($count_check && $maban != 0){
			$sql = "DELETE FROM `table` WHERE ma_ban=$maban";
			$this->db->setQuery($sql);
			$query = $this->db->execute();
			setcookie("flash","Xoá bàn thành công",time()+1);
			header('Location: http://localhost:8000/php-socket/views/?c=trangchu&a=showBan');
			
		}else{
			header('Location: http://localhost:8000/php-socket/views/?c=trangchu&a=chiaban');
		}
	}
	// Lay gia tri de  Sua ten ban 
	public function suatenban($ma_ban = null){
		// LAy ten bang
		$table = strtolower($this->classname);
		if($ma_ban){
			$sql = "SELECT * FROM `$table` WHERE ma_ban = $ma_ban";
			$this->db->setQuery($sql);
			$query = $this->db->loadRow();
			return $query;
		}else{
			header('Location: http://localhost:8000/php-socket/views/');
		}
	}
	// Sua ten ban theo gia tri dau vao 
	public function fixNametable($maban = 0, $tenban =null){
		// LAy ten bang
		$table = strtolower($this->classname);
		if($maban && $tenban){
			$sql = "UPDATE `$table` SET ten_ban='$tenban' WHERE ma_ban=$maban";
			$this->db->setQuery($sql);
			$query = $this->db->execute();
			setcookie("flash","Sửa tên bàn thành công",time()+1);
			header('Location: http://localhost:8000/php-socket/views/?c=trangchu&a=showBan');
		}else{
			header('Location: http://localhost:8000/php-socket/views/');
		}
	}
	//Dang ky nguoi dung thong qua mang gia tri truyen den
	public function sendDangky($thongtin = array()){
		// Lay ten bang trong csdl
		$table = strtolower($this->classname);
		$check = " ";
		// dung cau lenh select get du lieu username vua dk neu co thi dang ky thanh cong
		$sql_check = "SELECT username FROM `$table` where username = '".$thongtin[0]."' ";
		$this->db->setQuery($sql_check);
		$check =$this->db->loadRecord();
		if($check == null){
			$sql = "INSERT INTO `$table` (username,ho,ten,password,ngaysinh,gioitinh,sdt,scmnd,diachi) VALUES(?,?,?,?,?,?,?,?,?)";
			$this->db->setQuery($sql);
			$result = $this->db->execute($thongtin);
			setcookie("flash","Đăng ký thành công",time()+1);
			header('Location: http://localhost:8000/php-socket/views/');
		}else{
			setcookie("flash-error","Tài khoản tồn tại",time()+1);
			header('Location: http://localhost:8000/php-socket/views/?c=trangchu&a=dangky');
		}
	}
	// DANg nhap nguoi dung thong qua 2 gia tri truyen vao username va password
	public function sendDangnhap($username,$password){
		// Lay ten bang trong csdl
		$table = strtolower($this->classname);
		$check = " " ;
		$sql_check = "SELECT username FROM `$table` where username = ? and password = ? ";
		$this->db->setQuery($sql_check);
		$check =$this->db->loadRecord(array($username,$password));
		
		if($check != null){
			$_SESSION['login'] = 1;
			$sql_quyen = "SELECT phucvu,quanly FROM phanquyen where username = '".$username."'";
			
			$this->db->setQuery($sql_quyen);
			$row =$this->db->loadRow();
			if($row->phucvu == -1 && $row->quanly == -1){
				$_SESSION['admin'] = 1;
			}else{
				// check truong hop neu co quan ly thi gan qan ly 
				// co phuc vu thi gan vao session phuc vu
				if($row->quanly){
					$_SESSION['quanly'] = $row->quanly;
				}
				if($row->phucvu){
					$_SESSION['phucvu'] = $row->phucvu;
				}
				
			}
			// CHong hijacking
			session_regenerate_id(true);

			setcookie("flash","Đăng nhập thành công",time()+1);
			header('Location: http://localhost:8000/php-socket/views/');
		}else{
			setcookie("flash-error","Tài khoản không tồn tại",time()+1);
			header('Location: http://localhost:8000/php-socket/views/?c=trangchu&a=dangnhap');
		}
	}
	// Dua du lieu nguoi dung den show ra tren giao dien cap quyen
	public function capquyen($username = null){

		$table = strtolower($this->classname);
		// lay tat ca user
		if($username ){
			$sql = "SELECT username,ho,ten,ngaysinh,gioitinh,sdt,scmnd,diachi FROM `$table` where username = '$username' and username != 'admin' ";
			$this->db->setQuery($sql);
			$query = $this->db->loadRow();
		}else{	
			$sql = "SELECT username,ho,ten FROM `$table` where username != 'admin'";
			$this->db->setQuery($sql);
			$query = $this->db->loadAllRows();	
		}
		return $query;
	}
	// cap quyen cho nguoi dung 
	// neu da duoc cap quyen roi thi cap lai
	//thong qua mang truyen vao
	public function sendCapquyen($thongtin = array()){
		// Get ten bang trong mysql
		$table = strtolower($this->classname);
		$check = " ";
		// kiem tra nguoi dung co duoc cap quyen chua
		$sql_check = "SELECT username FROM `$table` where username = '$thongtin[0]' and username != 'admin' ";
		$this->db->setQuery($sql_check);
		$check =$this->db->loadRecord();

		if($check == null){
			$sql_insert = "INSERT INTO `$table` (username,phucvu,quanly) VALUES(?,?,?)";
			$this->db->setQuery($sql_insert);
			$result = $this->db->execute($thongtin);
			setcookie("flash","Cấp quyền thành công",time()+1);
			header('Location: http://localhost:8000/php-socket/views/?c=trangchu&a=capquyen');
		}else{
			$sql_update = "UPDATE `$table` SET phucvu=$thongtin[1], quanly=$thongtin[2] WHERE username='$thongtin[0]'";
			$this->db->setQuery($sql_update);
			$query = $this->db->execute();
			setcookie("flash","Cấp quyền lại  thành công",time()+1);
			header('Location: http://localhost:8000/php-socket/views/?c=trangchu&a=capquyen');
		}
	}
	// Tim kiem 1 nguoi dung thong qua ten cua ho 
	// voi 1 gia tri truyen vao
	public function timAjax($tim){
		// Get ten bang trong mysql
		$table = strtolower($this->classname);
		$sql_check = "SELECT username,ho,ten FROM `$table` where (ten like '%".$tim."%' and username != 'admin') OR (ho like '%".$tim."%' and username != 'admin')   ";
		$this->db->setQuery($sql_check);
		$query = $this->db->loadAllRows();
		return $query;
	}
	// Lay tat ca thong tin nguoi dung , khong co bien dau vao
	public function quanlynhanvien(){
		// Get ten bang trong mysql
		$table = strtolower($this->classname);
		// lay tat ca user
		$sql = "SELECT username,ho,ten,ngaysinh,gioitinh,sdt,scmnd,diachi,luong FROM `$table` where username != 'admin'";
		$this->db->setQuery($sql);
		$query = $this->db->loadAllRows();
		return $query;
	}
	// Them luong cho nhan vien voi dau vao la mang
	public function sendThemluong($thongtin =array()){
		// Get ten bang trong mysql
		$table = strtolower($this->classname);
		$sql = "UPDATE `$table` SET luong='$thongtin[1]' WHERE username='$thongtin[0]'";
		$this->db->setQuery($sql);
		$query = $this->db->execute();
		setcookie("flash","Thêm lương thành công",time()+1);
		header('Location: http://localhost:8000/php-socket/views/?c=trangchu&a=quanlynhanvien');
	}
	// Sua thong tin cho nhan vien vs gia tri dau vao la mang
	public function sendSuathongtinnhanvien($thongtin = array()){
		// Lay ten bang trong csdl
		$table = strtolower($this->classname);
		$sql = "UPDATE `$table` SET ho='$thongtin[1]',ten='$thongtin[2]',ngaysinh='$thongtin[3]',gioitinh='$thongtin[4]',sdt='$thongtin[5]',scmnd='$thongtin[6]',diachi='$thongtin[7]' WHERE username='$thongtin[0]'";
		$this->db->setQuery($sql);
		$query = $this->db->execute();
		// Flash quay ve xuat cho nguoi dung thay thong bao
		setcookie("flash","Sửa thông tin nhân viên thành công",time()+1);
		header('Location: http://localhost:8000/php-socket/views/?c=trangchu&a=quanlynhanvien');
	}
	// Xoa nhan vien thong qua gia tri dau vao username
	public function xoaNhanvien($username =array(),$ajax = 0){
		// Lay ten bang trong csdl
		$table = strtolower($this->classname);
		// Kiem tra neu chi xoa 1 phan tu 
		// khong phai dung ajax thi xoa theo $username vs gia tri
		// truyen vao tuong duong nhu bien khong phai mang
		if(count($username) == 1 && $ajax ==0){

		// xoa phan quyen trk
			$sql_phanquyen = "DELETE FROM `phanquyen` where username = '$username' and username != 'admin'";

			$this->db->setQuery($sql_phanquyen);
			$query_phanquyen= $this->db->execute();
			if($query_phanquyen){
			// xoa user sau
				$sql = "DELETE FROM `$table` where username = '$username' and username != 'admin'";
				$this->db->setQuery($sql);
				$query = $this->db->execute();	
			}
		// Flash quay ve xuat cho nguoi dung thay thong bao
			setcookie("flash","Xoá nhân viên thành công",time()+1);
			header('Location: http://localhost:8000/php-socket/views/?c=trangchu&a=quanlynhanvien');
		}else{
			// con lai gia tri truyen vao la mang
			// tuc la xoa nhieu phan tu theo dang ajax
			foreach ($username as $key => $value) {
				$sql_phanquyen = "DELETE FROM `phanquyen` where username = '$username[$key]' and username != 'admin'";

				$this->db->setQuery($sql_phanquyen);
				$query_phanquyen= $this->db->execute();
				if($query_phanquyen){
				// xoa user sau
					$sql = "DELETE FROM `$table` where username = '$username[$key]' and username != 'admin'";
					$this->db->setQuery($sql);
					$query = $this->db->execute();	
				}
			}
		}
	}
	// Get du lieu mon an khong co gia tri dau vao
	public function showMonan($item = null){
		// Lay ten bang trong csdl
		if($item == null){
			$table = strtolower($this->classname);
			$sql = "SELECT * from `$table`";
			$this->db->setQuery($sql);
			$query = $this->db->loadAllRows();	
		}else{
			$table = strtolower($this->classname);
			$sql = "SELECT * from `$table` where idMonAn = '$item'";
			$this->db->setQuery($sql);
			$query = $this->db->loadAllRows();	
		}
		
		return $query;
	}
	// Nhan mon an tu phuc vu 
	// Them gia tien vao moi mon
	// Voi gia tri dau vao la mang
	public function nhanMon($thongtin = array()){
		// Lay ten bang trong csdl
		$table = strtolower($this->classname);
		$sql_giatien = "SELECT giaMonAn from monan where tenMonAn = '$thongtin[0]'";

		$this->db->setQuery($sql_giatien);
		// Lay gia tien 
		// Gan trang thai dang an thi 1
		// khi thanh toan thi ve 0
		$giatien =$this->db->loadRecord();
		$trangthai = 1;
		$sql_goimon = "INSERT INTO `$table` (tenmon,giamonan,tenban,trangthai,ngaydat) VALUES(?,?,?,?,?)";
		$this->db->setQuery($sql_goimon);
		$result = $this->db->execute(array($thongtin[0],$giatien,$thongtin[1],$trangthai,$thongtin[2]));
	}
	//Thanh toan cho tu phuc vu hoac admin
	// gia tri dau vao la 1 bien so
	// xuat ra la tong tien va danh sach cac mon da goi
	public function thanhToan($tenban){
		// Lay ten bang trong csdl
		// cat 2 dau rong thanh chuoi thuong
		$fix_tenban= trim($tenban);
		$table = strtolower($this->classname);
		/*$sql_giatien = "SELECT giamonan,tenmon,ngaydat from thanhtoan where tenban = '$fix_tenban' and trangthai != 0";*/
		
		$sql_giatien = "SELECT `$table`.`giamonan` ,`$table`.`tenmon`, `$table`.ngaydat , COUNT(`$table`.`tenmon`) as solan,SUM(`$table`.`giamonan`) as ttien FROM `$table` where tenban = '$fix_tenban' and trangthai != 0 GROUP BY `$table`.`tenmon`";

		$this->db->setQuery($sql_giatien);
		$giatien =$this->db->loadAllRows();
		return $giatien;
	}
	// Xac nhan Thanh toan cho tu quan ly  hoac admin 
	// gia tri dau vao la 1 bien so
	// xuat ra la tong tien va danh sach cac mon da goi
	public function xacnhanthanhToan($tenban){
		// Lay ten bang trong csdl
		// cat 2 dau rong thanh chuoi thuong
		$fix_tenban= trim($tenban);
		$table = strtolower($this->classname);
		$sql = "UPDATE `$table` SET trangthai= 0 WHERE tenban = '$tenban'";
		$this->db->setQuery($sql);
		$query = $this->db->execute();
		// Flash quay ve xuat cho nguoi dung thay thong bao
		setcookie("flash","Thanh toán  thành công",time()+1);
		header('Location: http://localhost:8000/php-socket/views/?c=trangchu&a=showBan');
	}
	// Them thuc an vao csdl 
	// gia tri dau vao la mamg
	// chi co quan ly va admin thuc hien thao tac nay
	public function themThucdon($thongtin = array()){
		// Lay ten bang trong csdl

		$table = strtolower($this->classname);
		$sql_check_name_exit = "SELECT tenMonAn From `$table` where tenMonAn = '$thongtin[0]'";
		$this->db->setQuery($sql_check_name_exit);
		// kiem tra neu ton tai thi k cho nhap va thong bao
		$query_check =$this->db->loadRecord();
		if($query_check == null){
			$sql = "INSERT INTO `$table` (tenMonAn,giaMonAn,loaiMonAn,moTaMonAn,hinhMonAn) VALUES(?,?,?,?,?)";
			$this->db->setQuery($sql);
			$result = $this->db->execute(array($thongtin[0],$thongtin[1],$thongtin[2],$thongtin[3],$thongtin[4]));
			setcookie("flash","Thanh toán  thành công",time()+1);
			header('Location: http://localhost:8000/php-socket/views/?c=thucdon&a=quanlythucdon');
		}else{
			setcookie("flash-error","Sản phẩm đã tồn tại thêm không thành công",time()+1);
			header('Location: http://localhost:8000/php-socket/views/?c=thucdon&a=themthucdon');
		}
		
	}
	// check ten mon an 
	// thong qa gui ajax truc tiep tu form
	// bien dau vao 
	// thong bao qa gia tri tra ve
	public function checkMon($item){
		$table = strtolower($this->classname);
		$sql_check_name_exit = "SELECT tenMonAn From `$table` where tenMonAn = '$item'";
		$this->db->setQuery($sql_check_name_exit);
		// kiem tra neu ton tai thi k cho nhap va thong bao
		$query_check =$this->db->loadRecord();
		if($query_check == null){
			return 1;
		}else{
			return 0;
		}
	}
	// Xoa mon an theo idmonan
	// bien la gia tri dau vao
	public function xoaMonan($item){
		// Lay ten bang trong csdl
		$table = strtolower($this->classname);
		
		$sql = "DELETE FROM `$table` where idmonan = '$item' ";
		
		$this->db->setQuery($sql);
		$query= $this->db->execute();
		// Flash quay ve xuat cho nguoi dung thay thong bao
		setcookie("flash","Xoá món ăn thành công",time()+1);
		header('Location: http://localhost:8000/php-socket/views/?c=thucdon&a=quanlythucdon');
	}
	// Sua mon an trong thuc don csdl
	// gia tri truyen vao la mot mang
	public function suaThucdon($thongtin = array()){
		// Lay ten bang trong csdl
		$table = strtolower($this->classname);
		$sql = "UPDATE `$table` SET tenMonAn='$thongtin[1]',giaMonAn=$thongtin[2],loaiMonAn='$thongtin[3]',moTaMonAn='$thongtin[4]',hinhMonAn='$thongtin[5]' WHERE idMonAn = '$thongtin[0]'";
		
		$this->db->setQuery($sql);
		$query = $this->db->execute();
		// Flash quay ve xuat cho nguoi dung thay thong bao
		setcookie("flash","Sửa món ăn  thành công",time()+1);
		header('Location: http://localhost:8000/php-socket/views/?c=thucdon&a=quanlythucdon');
	}
	// THong ke san pham ban trong 1 ngay
	// hoac nhieu ngay chia ra tong the
	// gia tri tuyen vao la 3 bien so
	public function thongKe($ngay,$thang,$nam){
		// Lay ten bang trong csdl
		$table = strtolower($this->classname);
		//lay tat ca ngay trong thang nay 
		//$ngayBatdauthang= "01"."-".$thang."-".$nam;
		$ngayBatdauthang = $nam."-".$thang."-"."01";
		//$ngayCuoithang= "31"."-".$thang."-".$nam;
		$ngayCuoithang= $nam."-".$thang."-"."31";
		$sql_tongtien_trongthai = "SELECT sum(giamonan) from `$table` where ngaydat > '$ngayBatdauthang' and ngaydat < '$ngayCuoithang' and trangthai != 1"	;
		$this->db->setQuery($sql_tongtien_trongthai);
		//tong so tien trong thang nay hoac doanh thu trong thang nay
		$query_doanhthu =$this->db->loadRecord();

		$sql_tungngay = "SELECT ngaydat , SUM(giamonan) as tongtientrongngay from `$table` where trangthai != 1 and ngaydat > '$ngayBatdauthang' and ngaydat < '$ngayCuoithang' GROUP by ngaydat";
		
		$this->db->setQuery($sql_tungngay);
		// gia tien cho tung ngay trong thang nay
		$giatien =$this->db->loadAllRows();
		
		// xuat du lieu den trang 
		// gan 2 gia tri vao 2 bien trong mag
		$result = array(
			"tongdoanhthucuathang" =>$query_doanhthu,
			"tongdoanhthutungngay" => $giatien
			);
		return $result;
	}

}