<script type="text/javascript">
    $(document).ready(function(){
      $("#deleteMulti").click(function(){
        // hoi truoc khi xoa
        $xacnhanxoa = confirm('Bạn có muốn xoá không');
        const select  = [];
        $(':checkbox:checked').each(function(i){
          select[i] = $(this).val();
        });
        if($xacnhanxoa){
            if(select.length > 0){
           $.ajax({
                    type:"POST",
                    data: {xoa:select},
                    url:"?c=trangchu&a=xoanhanvien",
                // check tooken 
                success: function(data) {
                    alert("Xoá Thành Công");
                },

            });
            window.location.reload();
        }else{
          alert("Bạn chưa chọn nhân viên để xoá");
        }
        }
        
      });
    });
</script>
<div class="breadcrumbs ace-save-state" id="breadcrumbs" style="background-color: #fff;border: none">
                <ul class="breadcrumb">
                    <li>
                        <i class="ace-icon fa fa-home home-icon"></i>
                        <a href="/">Home</a>
                    </li>
                    <li class="active">QUẢN LÝ NHÂN VIÊN </li>
                    <li class="active"><span id="nameItem"> DANH SÁCH NHÂN VIÊN </span></li>
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
?>
<div class="container">
<h1 style="font-size: 25px;margin-left: 10px;float: left;font-weight: bold;">Danh Sách Nhân Viên</h1>
<span style="float: right; font-size: 20px;margin-top: 20px;"><a href="http://localhost:8000/php-socket/views/?c=trangchu&a=dangky" style="text-decoration: none"><i class="fa fa-user" aria-hidden="true"></i> Thêm nhân viên</a></span>
<div  style="width: 100% ; overflow-x: auto;">
  <table class="table table-hover">
    <thead>
      <tr>
        <th></th>
        <th>STT</th>
        <th>Họ và tên</th>
        <th>Ngày sinh</th>
        <th>Giới tính</th>
        <th>SĐT</th>
        <th>CMND</th>
        <th>Địa chỉ</th>
        <th>Mức lương</th>
        <th>Thao tác</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        if(isset($row)){
      for ($i=0; $i < count($row); $i++) { ?>
      <tr>
        <td><input type="checkbox" name="select[]" value="<?php echo $row[$i]->username ?>"></td>
        <td><?php echo $i+1 ?></td>
        <td><?php echo $row[$i]->ho." ".$row[$i]->ten ?></td>
        <td><?php echo $row[$i]->ngaysinh?></td>
        <td><?php if($row[$i]->gioitinh == "nam"){
          echo "Nam";
        }else{
          echo "Nữ";
        }?></td>
        <td><?php echo $row[$i]->sdt ?></td>
        <td><?php echo $row[$i]->scmnd ?></td>
        <td><?php echo $row[$i]->diachi ?></td>
        <td><?php if($row[$i]->luong != null){
          $gia_tien =ham_dao_nguoc_chuoi($row[$i]->luong);
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
        <td>
          <a href="http://localhost:8000/php-socket/views/?c=trangchu&a=themluong&id=<?php echo $row[$i]->username ?>" class="btn-primary"><i class="fa fa-plus" aria-hidden="true"></i></a>
          <a href="http://localhost:8000/php-socket/views/?c=trangchu&a=suathongtinnhanvien&id=<?php echo $row[$i]->username ?>" class="btn-success"><i class="fa fa-pencil" aria-hidden="true"></i></a>
          <a href="http://localhost:8000/php-socket/views/?c=trangchu&a=xoanhanvien&id=<?php echo $row[$i]->username ?>" class="btn-danger" onClick="javascript:return confirm('Bạn có muốn xoá : <?php echo $row[$i]->ho." ".$row[$i]->ten ?> không ???' );"><i class="fa fa-trash" aria-hidden="true"></i></i></a>
        </td>
      </tr>
      <?php }} ?>
    </tbody>
  </table>
  <button class="btn btn-danger" id="deleteMulti" >DELETE</button>
</div>