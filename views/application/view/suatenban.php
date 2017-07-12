<div class="breadcrumbs ace-save-state" id="breadcrumbs" style="background-color: #fff;border: none">
                <ul class="breadcrumb">
                    <li>
                        <i class="ace-icon fa fa-home home-icon"></i>
                        <a href="/">Home</a>
                    </li>
                    <li class="active"><a href="http://localhost:8000/php-socket/views/?c=trangchu&a=showBan"> QUẢN LÝ BÀN</a></li>
                    <li class="active"> SỬA TÊN BÀN </span></li>
                    <li class="active"> <?php echo $row['kq']->ten_ban ?> </span></li>
                </ul><!-- /.breadcrumb -->
            </div>
	<form action="http://localhost:8000/php-socket/views/?c=trangchu&a=sendsuatenban" method="POST">
		<label>Tên bàn:</label>
		<input type="text" class="form-control" name="tenban" value="<?php echo $row['kq']->ten_ban ?>">
		<input type="hidden" name="maban" value="<?php echo $_GET["maban"] ?>"><br>
		<input type="hidden" name="token" value="<?php echo $row['token'] ?>">
		<input type="submit" class="btn btn-primary"  value="EDIT">
	</form>
