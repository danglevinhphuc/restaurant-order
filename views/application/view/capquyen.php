
<div class="breadcrumbs ace-save-state" id="breadcrumbs" style="background-color: #fff;border: none">
                <ul class="breadcrumb">
                    <li>
                        <i class="ace-icon fa fa-home home-icon"></i>
                        <a href="/">Home</a>
                    </li>
                    <li class="active">QUẢN LÝ NHÂN VIÊN </li>
                    <li class="active"><span id="nameItem"> CẤP QUYỀN </span></li>
                </ul><!-- /.breadcrumb -->
            </div>
<script type="text/javascript">
    $(document).ready(function(){
        $("#tim").click(function(){
            var value = $("#tim_nhanh").val();
            // Gửi ajax search
            $.post('?c=trangchu&a=timAjax',{loai_sp:value},function(data){
                
                
                // chuyen du lieu ve json de xuat
                var chuyenJson = JSON.stringify(JSON.parse(data),null,2); 
                // chuyen ve dang mang de xuat
                var chuyenArr = JSON.parse(chuyenJson);
                

                $("#thaythe").html(" ");
                for (var i = 0; i < chuyenArr.length; i++) {
                    
                    $("#thaythe").append("<option value='"+chuyenArr[i]['username']+"'> " +chuyenArr[i]['ho']+" "+chuyenArr[i]['ten']+ " </option>");
                }
            });
        });
    });
</script>
<?php
    // gan gia tri mang vao bien de xuat du lieu tren bien
    $taikhoan = $row["taikhoan"];
    if($taikhoan != null){
?>
<div class="container">
<div class="row" style="margin-top:50px;">
    <div class="col-md-6 md-xs-2" >
        <form action="?c=trangchu&a=sendcapquyen" method="POST" style="display: inline-block; border-right : 5px solid #428BCA; height: 239px; padding-right: 20px">
            <select class="form-control" name="username" id="thaythe" style="width: 100%">
                <?php for($i = 0 ; $i < count( $taikhoan ) ;$i++ ) { 
                    // voi tai khoan admin thi k dk xuat hien va admin toan quyen
                    ?>
                        <option value="<?php echo $taikhoan[$i]->username ?>"><?php echo $taikhoan[$i]->ho." ".$taikhoan[$i]->ten ?></option>
                    
                <?php }?>
            </select><br>
            <label for>Phục vụ</label> 
            <input type="checkbox" name="phucvu" value="1"><br><br>
            <label for>Quản lý</label> 
            <input type="checkbox" name="quanly" value="1"><br><br>
            <input type="hidden" name="token" value="<?php echo $row['token'] ?>">
            <input type="submit" name="submit" value="CẤP QUYỀN" class="btn btn-primary">
        </form>
        <div style="display: inline-block; float: right; width: 50%" id="form-tim">
            <label style="font-size: 18px;">Tìm nhanh username bằng tên để cấp quyền</label>
            <input type="text" name="" id="tim_nhanh" style="width: 100%;">
            <input type="button" class="btn btn-primary" id="tim" value="Tìm" class="btn btn-primary">
        </div>
    </div>
    <div class="col-md-6 md-xs-10" style="border-left : 5px solid #428BCA" >
        <h3 class="text-news" style="margin-top: -2px; font-size: 35px;font-weight: bold;">Hướng dẫn</h3>
        <p style="font-size: 20px">
            ADMIN trực tiếp cấp quyền cho nhân viên dự trên tên của từng người
            , mỗi người sẽ có vị trí như phục vụ hoặc quản lý. Phục vụ thì không được trực tiếp quản lý số lượng bàn cũng như là tên bàn hoặc xoá bàn . Quản lý thì có thể tạo lại danh sách bàn thay đỗi tên bàn gửi thanh toán cho các bàn qua khu vực quản lý nhận thông tin từ phục vụ.
        </p>
    </div>
</div>
<?php
    }else{
        echo "<h3>Không có tài khoản nào để cấp quyền</h3>";
    }
?>