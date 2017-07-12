<div class="breadcrumbs ace-save-state" id="breadcrumbs" style="background-color: #fff;border: none">
                <ul class="breadcrumb">
                    <li>
                        <i class="ace-icon fa fa-home home-icon"></i>
                        <a href="/">Home</a>
                    </li>
                    <li class="active"><a href="http://localhost:8000/php-socket/views/?c=trangchu&a=showBan"> QUẢN LÝ BÀN</a></li>
                    <li class="active"> THANH TOÁN </span></li>
                    <li class="active"> <?php echo  $_GET['tenban'] ?> </span></li>
                </ul><!-- /.breadcrumb -->
            </div>
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
if(isset($row)){


?>
<div class="container">
<h2>Hoá đơn tại bàn: <?php echo $_GET['tenban'] ?></h2><span style="float: right;">Ngày vào : <?php echo $row[0]->ngaydat ?></span>
<div  style="width: 100% ; overflow-x: auto;">
  <table class="table table-hover">
    <thead>
      <tr>
        <th>STT</th>
        <th>Món ăn đã gọi</th>
        <th>Số lượng</th>
        <th>Đơn giá</th>
        <th>Thành tiền</th>
        
      </tr>
    </thead>
    <tbody>
      <?php $tong = 0; for ($i=0; $i < count($row); $i++) { 
          
          $tong = $tong + intval($row[$i]->ttien);
          
        ?>
      <tr>
        <td><?php echo $i+1 ?></td>
        <td><?php echo $row[$i]->tenmon?></td>
        <td><?php echo $row[$i]->solan ?></td>
        <td><?php if($row[$i]->giamonan != null){
          $gia_tien =ham_dao_nguoc_chuoi($row[$i]->giamonan);
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
        }?></td>

        <td><?php if($row[$i]->ttien != null){
          $gia_tien =ham_dao_nguoc_chuoi($row[$i]->ttien);
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
        }?></td>
      </tr>
      <?php }?>
    </tbody>
  </table>

  <div class="tonggia" style="color: #6FB3E0;font-size: 30px">
    Tổng số tiền phải trả: <span style="color: #000"> <?php if($tong){
          $gia_tien =ham_dao_nguoc_chuoi($tong);
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

        <form action="http://localhost:8000/php-socket/views/?c=trangchu&a=xacnhanthanhtoan" method="POST"> 
          <input type="hidden" name="tenban" value="<?php echo $_GET['tenban'] ?>">
          <button type="submit" class="btn btn-success">XÁC NHẬN THANH TOÁN</button>
        </form>
        <h1 style="color: red ;font-weight: bold; text-align: center;">CẢM ƠN QUÝ KHÁCH ĐÃ SỬ DỤNG DỊCH VỤ CỦA CHÚNG TÔI</h1>
  </div>
  <?php }else{

?>
  <h1 style="color: red ;font-weight: bold; text-align: center;">CẢM ƠN QUÝ KHÁCH ĐÃ SỬ DỤNG DỊCH VỤ CỦA CHÚNG TÔI</h1>
  <?php }?>