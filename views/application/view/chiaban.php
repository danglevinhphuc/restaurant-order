<div class="breadcrumbs ace-save-state" id="breadcrumbs" style="background-color: #fff;border: none">
                <ul class="breadcrumb">
                    <li>
                        <i class="ace-icon fa fa-home home-icon"></i>
                        <a href="/">Home</a>
                    </li>
                    <li class="active">QUẢN LÝ BÀN</li>
                    <li class="active"><span id="nameItem"> TẠO BÀN </span></li>
                </ul><!-- /.breadcrumb -->
            </div>
<div class="container">
<form action="http://localhost:8000/php-socket/views/?c=trangchu&a=sendchiaban" method="POST" >
  <div class="form-group">
    <label for="so_ban">Nhập số lượng bàn:</label>
    <input type="number" class="form-control" name="so_ban" >
  </div>
  <div class="form-group">
    <label for="ten_ban">Đặt tên cho bàn</label>
    <input type="text" class="form-control" name="ten_ban" required>
  </div>
  <input type="hidden" name="token" value="<?php echo $row ?>">
  <button type="submit" class="btn btn-primary">Xác nhận thông tin để tạo bàn</button>
</form>

