<div class="breadcrumbs ace-save-state" id="breadcrumbs" style="background-color: #fff;border: none">
                <ul class="breadcrumb">
                    <li>
                        <i class="ace-icon fa fa-home home-icon"></i>
                        <a href="/">Home</a>
                    </li>
                    <li class="active"><a href="http://localhost:8000/php-socket/views/?c=trangchu&a=quanlynhanvien"> QUẢN LÝ NHÂN VIÊN</a></li>
                    <li class="active"><span id="nameItem"> THÊM LƯƠNG </span></li>
                    <li class="active"><?php echo $row['result']->ho." ".$row['result']->ten ?></li>
                </ul><!-- /.breadcrumb -->
            </div>
            <div class="container">
<h1>Nhân viên : <span style="font-weight: bold;"><?php echo $row['result']->ho." ".$row['result']->ten ?></span></h1>

<form action="http://localhost:8000/php-socket/views/?c=trangchu&a=sendthemluong" method="POST">
	<div class="form-group">
    <label for="luong">Lương hiện tại :</label>
    <input type="number" class="form-control" id="luong" name="luong" value="" required><br>
    <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
    <input type="hidden" name="token" value="<?php echo $row['token'] ?>">
    <button type="submit" class="btn btn-primary">CẬP NHẬT</button>
    <a class="btn btn-danger" href="http://localhost:8000/php-socket/views/?c=trangchu&a=quanlynhanvien">TRỞ VỀ</a>
  </div>
</form>