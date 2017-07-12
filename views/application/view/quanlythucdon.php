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

<?php function loadDataItem($tenMon,$row){ ?>
<?php
		// ham lay du lieu vao show ra tu ten vao du lieu dua ra tung csdl
for ($i=0; $i < count($row); $i++) { 
	if($row[$i]->loaiMonAn === $tenMon){
		?>
		<div class="col-sm-6 col-md-4">
			<article   style="padding: 20px;">
				<div class="single_category">
					<p >
						<span class="solid_line" style=""></span>
						<a href="#" class="title_text" style="text-decoration: none;color: #000"><?php echo $row[$i]->tenMonAn ?></a>
					</p>
				</div>
				<img src="lir/images/<?php echo $row[$i]->hinhMonAn ?>" width="100%" height="300px">
				<p class="mota"><?php echo $row[$i]->moTaMonAn ?></p>
				<span class="giatien clearfix " >
					<?php if($row[$i]->giaMonAn != null){
						$gia_tien =ham_dao_nguoc_chuoi($row[$i]->giaMonAn);
						$do_dai = strlen($gia_tien) - 1;
                          // dao nguoc chuoi xog
                          // tao vong lap tu cuoi ve dau
                          // chia du 3 danh dau .
						for($j = $do_dai ; $j>=0 ; $j--){
							echo $gia_tien[$j];
							if($j%3 == 0 && $j != 0){
								echo ",";
							}
						}
						echo " VNĐ</p>";
					}else{
						echo "0 VNĐ";
					}?></span>
					<a href="http://localhost:8000/php-socket/views/?c=thucdon&a=xoamonan&id=<?php echo $row[$i]->idMonAn ?>" class="move btn btn-danger" onClick="javascript:return confirm('Bạn có muốn xoá món: <?php echo $row[$i]->tenMonAn?> không ???' );">Xoá</a>
					<a href="http://localhost:8000/php-socket/views/?c=thucdon&a=suamonan&id=<?php echo $row[$i]->idMonAn ?>" class="move btn btn-primary" >Sửa</a>

				</article>

			</div>
			<?php	}}
			?>
			<?php }	?>


			<?php

	// gan bien khoi dau gia tri mat dinh
			if(isset($row)){
		// thuc an
				$nuong = 0 ;$xao = 0; $hap = 0;$chien = 0;$luot = 0;$chung = 0;$rang = 0;$kho = 0; $lau = 0; $conKho = 0;$ham= 0;
				function countItem($tenmon,$row){
		//tao vong lap dem co du lieu khong
		// co thi check ton tai ten mon 
		// tao bien dem
					$giatri = 0;
					for ($i=0; $i < count($row); $i++) { 
						if($row[$i]->loaiMonAn == $tenmon){
							$giatri ++;
						}
					}
					return $giatri;
				}
	// dem co bao nhieu gia tri  thuc an
				$nuong = countItem('nuong',$row);
				$xao = countItem('xao',$row);
				$hap = countItem('hap',$row);
				$chien = countItem('chien',$row);
				$luot = countItem('luot',$row);
				$chung = countItem('chung',$row);
				$rang = countItem('rang',$row);
				$kho = countItem('kho',$row);
				$lau = countItem('lau',$row);
				$canh = countItem('canh',$row);
				$conKho =countItem('conKho',$row);
				$ham = countItem('ham',$row);
				?>
				<style type="text/css">
					.badge-left{
						float: right;
						margin-top: 3px;
					}
					#nuong,#xao,#chien,#hap,#luot,#chung,#rang,#thucuong,#lau,#canh,#conKho,#ham{
						display: none;
					}
					article{
						border: 1px solid #e1e1e1;
						box-shadow:  5px 1px 20px #993399;
						border-radius: 5px;
					}
					article div{
						float: left;
						display: inline;
						width: 100%;
					}
					.single_category > p{text-align:center; font-size:17px; font-weight:700; margin-top:5px; text-transform:uppercase; position:relative; ;background: #438EB9;}

					.bold_line{bottom:0; display:block; height:10px; left:0; position:absolute; width:100%}
					.bold_line span{ display:block; height:100%; width:100%;background-color: #000;}
					.solid_line{background-color:#fff; bottom:13px; display:block; height:2px; left:0; position:absolute; width:100%; z-index:0}
					.title_text{

						background-color: #f6f6f6;
						display: inline-block;
						padding: 0 10px;
						position: relative;
						top: 0px;
						z-index: 1;
					}
					span.giatien{
						font-size: 16px;
					}
					a.move{
						margin-top: -41px;
						float: right;
					}
					#nameItem{
						color: #666666;
					}
					#themthucdon{
						margin-top: -40px;
					}
					nav.navbar{
						background-color:#438EB9;width: 285px; box-shadow: 2px 2px 10px #993399; border-radius: 5px; margin-top: 15px; margin-left: 13px;
					}
					@media screen and (max-width:460px){
						#themthucdon{
							padding-top: 20px;
							padding-bottom: 20px;
							display: block;
							margin-top: 0;
						}
						nav.navbar{
							width: 95%;
						}
					}
				</style>
				<script type="text/javascript">
// scprit click show va hide cho tung mung dk chon
function showAndhide(value){
	var mang_show=  ["kho", "nuong", "xao","chien","hap","luot","chung","rang","lau","canh","conKho","ham","thucuong"];
	var mang_show_co_dau=["KHO","NƯỚNG","XÀO","CHIÊN","HẤP","LUỘT","CHƯNG","RANG","LẨU","CANH","KHÔ","HẦM","THỨC UỐNG"];
	for(var i = 0; i< mang_show.length ; i++){
		if(value == mang_show[i]){
			$("#"+value).css("display","block");
			$("#nameItem").text(mang_show_co_dau[i]);
		}else{
			$("#"+mang_show[i]).css("display","none");
		}
	}
}

</script>
<div class="breadcrumbs ace-save-state" id="breadcrumbs" style="background-color: #fff;border: none">
				<ul class="breadcrumb">
					<li>
						<i class="ace-icon fa fa-home home-icon"></i>
						<a href="/">Home</a>
					</li>
					<li class="active">QUẢN LÝ THỰC ĐƠN VỀ </li>
					<li class="active"><span id="nameItem"> MÓN KHO </span></li>
				</ul><!-- /.breadcrumb -->
			</div>



<nav class="navbar" style="">
	<div >
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false" style="float: left;margin-left: 10px;">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>

		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav" >
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">THỨC ĂN <span class="badge">9</span> <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li onclick="showAndhide('kho') "><a href="#">Kho <span class="badge badge-left"><?php echo $kho ?></span></a> </li>
						<li onclick="showAndhide('xao')"> <a href="#">Xào <span class="badge badge-left"><?php echo $xao ?></span></a> </li>
						<li onclick="showAndhide('nuong')"> <a href="#">Nướng <span class="badge badge-left"><?php echo  $nuong ?></span></a> </li>
						<li onclick="showAndhide('luot')"><a href="#">Luột <span class="badge badge-left"><?php echo $luot ?></span></a> </li>
						<li onclick="showAndhide('chien')"><a href="#">Chiên <span class="badge badge-left"><?php echo $chien ?></span></a> </li>
						<li onclick="showAndhide('hap')"><a href="#">Hấp <span class="badge badge-left"><?php echo $hap ?></span></a> </li>
						<li onclick="showAndhide('rang')"><a href="#">Rang <span class="badge badge-left"><?php echo $rang ?></span></a> </li>
						<li onclick="showAndhide('chung')"><a href="#">Chưng <span class="badge badge-left"><?php echo $chung ?></span></a> </li>
						<li onclick="showAndhide('lau')"><a href="#">Lẩu <span class="badge badge-left"><?php echo $lau ?></span></a> </li>
						<li onclick="showAndhide('canh')"><a href="#">Canh <span class="badge badge-left"><?php echo $canh ?></span></a> </li>
						<li onclick="showAndhide('conKho')"><a href="#">Khô <span class="badge badge-left"><?php echo $conKho ?></span></a> </li>
						<li onclick="showAndhide('ham')"><a href="#">Hầm <span class="badge badge-left"><?php echo $ham ?></span></a> </li>
					</ul>
				</li>
			</ul>

			<ul class="nav navbar-nav">

				<li class="dropdown" onclick="showAndhide('thucuong') ">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">THỨC UỐNG <span class="badge">2</span></a>
				</li>
			</ul>
		</div><!-- /.navbar-collapse -->
	</div><!-- /.container-fluid -->
</nav>
<a href="http://localhost:8000/php-socket/views/?c=thucdon&a=themthucdon" style="color: #000 ; font-size: 18px; text-decoration: none" id="themthucdon" class="pull-right"><i class="fa fa-cutlery" aria-hidden="true"></i> THÊM THỰC ĐƠN</a>
<section style="margin-top:60px;">
	<div id="kho" class="wow lightSpeedIn">
		<?php loadDataItem("kho",$row) ?>
	</div>
	<div id="nuong"  class="wow bounceInRight">
		<?php loadDataItem("nuong",$row) ?>
	</div>
	<div id="xao" class="wow flipInX">
		<?php loadDataItem("xao",$row) ?>
	</div>
	<div id="luot" class="wow rotateIn">
		<?php loadDataItem("luot",$row) ?>

	</div>
	<div id="hap" class="wow rollIn">
		<?php loadDataItem("hap",$row) ?>
	</div>
	<div id="chien" class="wow zoomIn">
		<?php loadDataItem("chien",$row) ?>

	</div>
	<div id="rang" class="wow slideInUp">
		<?php loadDataItem("rang",$row) ?>

	</div>
	<div id="chung" class="wow flash">

		<?php loadDataItem("chung",$row) ?>
	</div>
	<div id="lau" class="wow jello">
		<?php loadDataItem("lau",$row) ?>

	</div>
	<div id="canh" class="wow jello">
		<?php loadDataItem("canh",$row) ?>

	</div>
	<div id="conKho" class="wow flash">
		<?php loadDataItem("conKho",$row) ?>

	</div>
	<div id="ham" class="wow rollIn">
		<?php loadDataItem("ham",$row) ?>

	</div>
	<div id="thucuong" style="display: none" class="wow bounceIn" >
		<?php for ($i=0; $i < count($row) ; $i++) { 
			if($row[$i]->loaiMonAn != "nuong" && $row[$i]->loaiMonAn != "xao" &&
				$row[$i]->loaiMonAn != "chien" && $row[$i]->loaiMonAn != "hap" &&
				$row[$i]->loaiMonAn != "rang" && $row[$i]->loaiMonAn != "chung" &&
				$row[$i]->loaiMonAn != "luot" && $row[$i]->loaiMonAn != "kho" &&
				$row[$i]->loaiMonAn != "lau" && $row[$i]->loaiMonAn != "canh"
				&& $row[$i]->loaiMonAn != "conKho" && $row[$i]->loaiMonAn != "ham"){		?>
				<div class="col-sm-6 col-md-4">
					<article  style="padding: 20px;">
						<div class="single_category">
							<p >
								<span class="solid_line" style=""></span>
								<a href="#" class="title_text" style="text-decoration: none;color: #000"><?php echo $row[$i]->tenMonAn ?></a>
							</p>
						</div>
						<img src="lir/images/<?php echo $row[$i]->hinhMonAn ?>" width="100%" height="300px">
						<p class="mota"><?php echo $row[$i]->moTaMonAn ?></p>
						<span class="giatien clearfix "><?php if($row[$i]->giaMonAn != null){
							$gia_tien =ham_dao_nguoc_chuoi($row[$i]->giaMonAn);
							$do_dai = strlen($gia_tien) - 1;
                          // dao nguoc chuoi xog
                          // tao vong lap tu cuoi ve dau
                          // chia du 3 danh dau .
							for($j = $do_dai ; $j>=0 ; $j--){
								echo $gia_tien[$j];
								if($j%3 == 0 && $j != 0){
									echo ",";
								}
							}
							echo " VNĐ</p>";
						}else{
							echo "0 VNĐ";
						}?></span>
						<a href="http://localhost:8000/php-socket/views/?c=thucdon&a=xoamonan&id=<?php echo $row[$i]->idMonAn ?>" class="move btn btn-danger" onClick="javascript:return confirm('Bạn có muốn xoá món: <?php echo $row[$i]->tenMonAn?> không ???' );">Xoá</a>
						<a href="http://localhost:8000/php-socket/views/?c=thucdon&a=suamonan&id=<?php echo $row[$i]->idMonAn ?>" class="move btn btn-danger">Sửa</a>

					</article>

				</div>
				<?php }} ?>
			</div>
			<script src="lir/assets/wow/wow.min.js"></script>
			<script>
				new WOW().init();
			</script>
			<?php }else{
				?>
			</section>
			<h1 style="color: red ;font-weight: bold; text-align: center;">CẢM ƠN QUÝ KHÁCH ĐÃ SỬ DỤNG DỊCH VỤ CỦA CHÚNG TÔI</h1>
			<?php }?>