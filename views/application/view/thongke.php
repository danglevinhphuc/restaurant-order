<?php
	$sumOfmonth = $row['tongdoanhthucuathang'];
	$sumOfday= $row["tongdoanhthutungngay"];
?>
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
	if($row != null){
		$gia_tien =ham_dao_nguoc_chuoi($row);
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
		echo " VNĐ";
	}else{
		echo "0 VNĐ";
	}
}
?>
<div class="breadcrumbs ace-save-state" id="breadcrumbs" style="background-color: #fff;border: none">
                <ul class="breadcrumb">
                    <li>
                        <i class="ace-icon fa fa-home home-icon"></i>
                        <a href="/">Home</a>
                    </li>
                    <li class="active"><span id="nameItem"> THỐNG KÊ</span></li>
                    
                </ul><!-- /.breadcrumb -->
            </div>

<style type="text/css">

.chart {
  display: table;
  table-layout: fixed;
  width: 60%;
  max-width: 700px;
  height: 200px;
  margin: 0 auto;
  background-image: linear-gradient(to top, rgba(0, 0, 0, 0.1) 2%, rgba(0, 0, 0, 0) 2%);
  background-size: 100% 50px;
  background-position: left top;
}
.chart li {
  position: relative;
  display: table-cell;
  vertical-align: bottom;
  height: 200px;
}
.chart b{
	margin-left: 13px;
}
.chart span {
  margin: 0 1em;
  display: block;
  background: rgba(209, 236, 250, 0.75);
  animation: draw 1s ease-in-out;
}
.chart span:before {
  position: absolute;
  left: 0;
  right: 0;
  top: 100%;
  padding: 5px 1em 0;
  display: block;
  text-align: center;
  content: attr(title);
  word-wrap: break-word;
}
section{
	font-size: 20px;
	color: #000;
}
@keyframes draw {
  0% {
    height: 0;
  }
}

</style>
<div class="container">
<ul class="chart">
<?php
	$chiaphantram = 0;
	for($i = 0 ;$i <count($sumOfday) ;$i++){ 


		$chiaphantram =  intval(($sumOfday[$i]->tongtientrongngay))*100/$sumOfmonth;
		/*echo $sumOfday[$i]->ngaydat." : ".$sumOfday[$i]->tongtientrongngay." : ".$chiaphantram."%<br>";*/

	
	//echo $sumOfmonth." : "."100%"."<br>";
?>
  <li>
  	<b style="color: #A069C3"><?php echo round($chiaphantram,2).'%' ?></b>
    <span style="height:<?php echo $chiaphantram.'%' ?>" title="<?php echo $sumOfday[$i]->ngaydat?>"></span>
  </li>
<?php }?>
<li>
	<b style="color: #A069C3">100%</b>
    <span style="height: 100%" title="<?php echo date('m-Y') ?>"></span>
  </li>
</ul>    
<h1 id="thongke" style="text-align: center;margin-top: 40px; color: #000 ;font-weight: bold; font-size: 18px">Biểu đồ thống kê doanh thu theo từng ngày trong <?php echo date('m-Y') ?> </h1>

<section>
	<h3>Tổng <?php echo date('m-Y') ?> với doanh thu :  <?php echo giaThitruong($sumOfmonth) ?></h3>
	<?php
	$chiaphantram = 0;
	for($i = 0 ;$i <count($sumOfday) ;$i++){ 


		 echo $sumOfday[$i]->ngaydat." : ";
		 giaThitruong($sumOfday[$i]->tongtientrongngay);
		 echo "<br>";
	
	}
?>
</section>