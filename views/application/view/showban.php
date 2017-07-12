<div class="breadcrumbs ace-save-state" id="breadcrumbs" style="background-color: #fff;border: none">
	<ul class="breadcrumb">
		<li>
			<i class="ace-icon fa fa-home home-icon"></i>
			<a href="/">Home</a>
		</li>
		<li class="active">QUẢN LÝ BÀN </li>
		<li class="active"><span id="nameItem"> QUẢN LÝ THÔNG TIN BÀN </span></li>
	</ul><!-- /.breadcrumb -->
</div>
<style type="text/css">
	.menu-order{
		background: #6FB3E0;
		margin-bottom: 15px;
		color: #fff;
		border-radius: 5px;
		box-shadow: 5px 5px 20px #428BCA;
		position: relative;
	}
	.menu-tenmon{
		font-size: 30px;
		font-weight: bold;

	}
	.menu-mota{
		font-size: 20px;
		color: #000;
	}

	.menu-hinh img{
		display: inline-block;
		float: right;
		margin-top: -100px;
		margin-right: 100px;
	}
	.menu-gia{
		font-size: 30px;
	}
	.checkbox {
		width: 20px;
		height: 20px;
		float: right;
	}
</style>
<?php 
// ham dao nguoc chuoi 
// xu ly muc luong co dau phay cach 3 so
function ham_dao_nguoc_chuoi($str1)  
{  
	$n = strlen($str1);  
	if($n == 1)  
	{  
		return $str1;  
	}  
	else  
	{  
		$n--;  
		return ham_dao_nguoc_chuoi(substr($str1,1, $n)) . substr($str1, 0, 1);  
	}  
} 
?>
<?php
function giaThitruong($row){
	if($row->giaMonAn != null){
		$gia_tien =ham_dao_nguoc_chuoi($row->giaMonAn);
		$do_dai = strlen($gia_tien) - 1;
                          // dao nguoc chuoi xog
                          // tao vong lap tu cuoi ve dau
                          // chia du 3 danh dau .
		echo "<p style:'font-size:30px'>";
		for($j = $do_dai ; $j>=0 ; $j--){
			echo $gia_tien[$j];
			if($j%3 == 0 && $j != 0){
				echo ",";
			}
		}
		echo " VNĐ</p>";
	}else{
		echo "0 VNĐ";
	}
}
?>
<?php
// tao vong lap cho mon an voi phan loai la do chien
function taoMonanchomenu($loaiMonAn,$monan,$tenTheoloai){ 
	echo "<h3 style='text-align:center;font-weight:bold;font-size:40px'>".$tenTheoloai."</h3>";
	for($j = 0 ; $j < count($monan) ;$j++){
		if($monan[$j]->loaiMonAn == $loaiMonAn){
			echo "<div class='menu-order'>";
			echo "<span class='menu-tenmon'>".$monan[$j]->tenMonAn."</span>";
			echo "<span class='menu-mota'>".$monan[$j]->moTaMonAn."</span>";
			echo "<span class='menu-gia'>".giaThitruong($monan[$j])."</span>";
			echo "<span class='menu-hinh'><img src='lir/images/".$monan[$j]->hinhMonAn."' width='120px' height='120px'></span><input type='checkbox' class='checkbox' name='selector[]'  value='".$monan[$j]->tenMonAn."'><br>";
			echo "</div>";
		}
	}
}
?>


<?php

	// neu nguoi dung xoa het thi quay ve chia ban
	//	kiem tra neu du lieu ton tai thi xuat k thi thong bao bat nguoi dung tao lai tu dau
if(isset($row)){ 
	// du lieu ban
	// du lieu mon an
	$ban = $row['kq'];
	$monan = $row['monan'];
	?>
	<div class="container">
		<div class="row">
			<?php for($i = 0 ; $i < count($ban) ;$i++){ ?>
			<div class="col-xs-6 col-md-3">
				<p class="thumbnail">
					<span class="name-table"><?php echo $ban[$i]->ten_ban ?></span><br>
					<img src="lir/assets/images/img-web/table.png" width="100px;" height="100px" alt="<?php echo $ban[$i]->ten_ban ?>">
					<?php if(isset($_SESSION['admin']) || isset($_SESSION["quanly"])){ ?>
					<button class="btn btn-success"><a  href="http://localhost:8000/php-socket/views/?c=trangchu&a=suatenban&maban=<?php echo $ban[$i]->ma_ban ?>">EDIT</a></button> <button class="btn btn-danger"><a  href="http://localhost:8000/php-socket/views/?c=trangchu&a=xoahet&maban=<?php echo $ban[$i]->ma_ban ?>" onClick="javascript:return confirm('Bạn có muốn xoá bàn: <?php echo $ban[$i]->ten_ban ?> không ???' );"> DELETE</a></button>
					<?php } ?>
					<a href="http://localhost:8000/php-socket/views/?c=trangchu&a=thanhtoan&tenban=<?php echo $ban[$i]->ten_ban ?>" class="btn btn-primary">Thanh toán</a>
					<button type="button"  class="btn btn-info show_order" data-toggle="modal" data-target="#<?php echo $ban[$i]->ten_ban ?>" nametable="<?php echo $ban[$i]->ten_ban ?>">Gọi món</button>
					<!-- Modal -->
					<div class="modal fade" id="<?php echo $ban[$i]->ten_ban?>" role="dialog">
						<div class="modal-dialog modal-lg">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title">MENU ORDER</h4>
								</div>
								<div class="modal-body" style="background-color: #fff">
									<section class="regular slider" style="width: 100% ">
										<div  >
											<?php taoMonanchomenu("lau",$monan,"Lẩu") ?>
										</div>
										<div  >
											<?php taoMonanchomenu("nuong",$monan,"Nướng") ?>
										</div>
										<div  >
											<?php taoMonanchomenu("chien",$monan,"Chiên") ?>
										</div>
										<div  >
											<?php taoMonanchomenu("rang",$monan,"Rang") ?>
										</div>
										<div  >
											<?php taoMonanchomenu("hap",$monan,"Hấp") ?>
										</div>
										<div  >
											<?php taoMonanchomenu("chung",$monan,"Chưng") ?>
										</div>
										<div  >
											<?php taoMonanchomenu("luot",$monan,"Luột") ?>
										</div>
										<div  >
											<?php taoMonanchomenu("kho",$monan,"Kho") ?>
										</div>
										<div  >
											<?php taoMonanchomenu("canh",$monan,"Canh") ?>
										</div>
										<div  >
											<?php taoMonanchomenu("conKho",$monan,"Khô") ?>
										</div>
										<div  >
											<?php taoMonanchomenu("ham",$monan,"Hầm") ?>
										</div>
										<div>
											<?php
											echo "<h3 style='text-align:center;font-weight:bold;font-size:40px'>Thức Uống</h3>";
											for($j = 0 ; $j < count($monan) ;$j++){
												if($monan[$j]->loaiMonAn != "nuong" && $monan[$j]->loaiMonAn != "xao" &&
													$monan[$j]->loaiMonAn != "chien" && $monan[$j]->loaiMonAn != "hap" &&
													$monan[$j]->loaiMonAn != "rang" && $monan[$j]->loaiMonAn != "chung" &&
													$monan[$j]->loaiMonAn != "luot" && $monan[$j]->loaiMonAn != "kho" &&
													$monan[$j]->loaiMonAn != "lau" && $monan[$j]->loaiMonAn != "canh" && $monan[$j]->loaiMonAn != "conKho" && $monan[$j]->loaiMonAn != "ham"){
													echo "<div class='menu-order'>";
												echo "<span class='menu-tenmon'>".$monan[$j]->tenMonAn."</span>";
												echo "<span class='menu-mota'>".$monan[$j]->moTaMonAn."</span>";
												echo "<span class='menu-gia'>".giaThitruong($monan[$j])."</span>";
												echo "<span class='menu-hinh'><img src='lir/images/".$monan[$j]->hinhMonAn."' width='120px' height='120px'></span><input type='checkbox' class='checkbox' name='selector[]'  value='".$monan[$j]->tenMonAn."'><br>";
												echo "</div>";
											}
										}
										?>
									</div>
								</section>


							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-info order" data-dismiss="modal"   nametable="<?php echo $ban[$i]->ten_ban ?>">Đặt món</button>
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div>
			</p>
		</div>
		<?php } ?>
	</div>
</div>
<?php }else{ 
	?>
	<h1>Không Còn Bàn Hãy Tạo Lại</h1>
	<a href="http://localhost:8000/php-socket/views/?c=trangchu&a=chiaban">Tại đây</a>
	<?php
}
?>

<script type="text/javascript">
	$(document).ready(function(){
		var socket = io.connect("http://localhost:3000/");

		// GOi mon ma cho tat ca check box duoc chon
		$('.order').click(function(){
			var ten_ban = $(this).attr("nametable");
			var mon_an = [];
			$(':checkbox:checked').each(function(i){
				mon_an[i] = $(this).val();

        	  // Dua du lieu den php thong qua ajax 
        	  //csdl gom ten mon va ban
        	  //tu ban minh se thong qua socket gui den ng dung gia tien va ten mon an
        	  // tu ten mon an se thanh toan vs khac hang qa so luong
        	  // khi thanh toan thanh cong se chuyen ve trang thai thanh toan
        	  // het ngay hoặc het tuan se xoa csdl

        	  $.post('http://localhost:8000/php-socket/views/?c=trangchu&a=nhanMon',{monan:mon_an[i],tenban: ten_ban},function(data){
        	  	console.log("goi mon thanh cong");
        	  });

        	});
        	// Check khi phuc vu chon dat mon ma chua chon mon an
        	if(mon_an.length){
        		//gui du lieu den socket ban
        		socket.emit("send to admin",{ten_ban});
        		$('input:checkbox').removeAttr('checked');
        		alert("Gọi Món Thành Công");
        	}else{
        		alert("Chưa gọi món ăn");
        	}
        });
	});
</script>

