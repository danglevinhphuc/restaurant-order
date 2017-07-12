<div class="breadcrumbs ace-save-state" id="breadcrumbs" style="background-color: #fff;border: none">
                <ul class="breadcrumb">
                    <li>
                        <i class="ace-icon fa fa-home home-icon"></i>
                        <a href="/">Home</a>
                    </li>
                    <li ><a href="http://localhost:8000/php-socket/views/?c=thucdon&a=quanlythucdon">QUẢN LÝ THỰC ĐƠN</a></li>
                    <li class="active"><span id="nameItem"> THÊM THỰC ĐƠN </span></li>
                </ul><!-- /.breadcrumb -->
            </div>
		<style type="text/css">

			h1 span{
				color: #9c27b0;
				font-weight: initial;
			}
			label{
				font-size: 22px;
				color: #000;
				font-weight: bolder;
			}
			#check-name{
				font-size: 15px;
			}
		</style>
		<script type="text/javascript">
			// ajax thông báo cho người dung tồn tại hoặc k ten món ăn

			$(document).ready(function(){
				var time = null;
				$("#tenmonan").keyup(function(){
					clearTimeout(time);
					timeout = setTimeout(function ()
					{
            // Lấy nội dung search
            var data = {
            	item : $('#tenmonan').val()
            };

            // Gửi ajax search
            $.ajax({
            	type : 'post',
            	dataType : 'text',
            	data : data,
            	url : 'http://localhost:8000/php-socket/views/?c=thucdon&a=checkmon',
            	success : function (result){
            		$('#check-name').html(result);
            	}
            });
        }, 1000);
				});
			});
		</script>
		<div class="container">
		<div class="row">
			<div class="col-md-7">
				<h1 style="font-weight: bold; color: #CCCCCC;">THÊM MÓN VÀO THỰC ĐƠN(<span>vui lòng điền đầy đủ thông tin</span>)</h1>
				<!-- **** FORM nhập yêu cần bài đăng *** -->
				<form action="http://localhost:8000/php-socket/views/?c=thucdon&a=sendthemthucdon" method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<label for="ten_san_pham">Tên món:</label>
						
						<input type="text" class="form-control"  name="tenmonan" id="tenmonan" placeholder="Nhập tên cho món ..." required>
						<label id="check-name"></label>
					</div>
					<div class="form-group">
						<label>Chọn loại sản phẩm:</label>
						
						<select class="form-control" id="chon_loai_sp" name="loaimonan" required>
							<option value="" id="tieu_de_chon_loai" >**** Chọn loại thực đơn ****</option>
							<optgroup label="Thức ăn" id="loai_sp_select" >
								<option value="chien">Chiên</option>
								<option value="xao">Xào</option>
								<option value="nuong">Nướng</option>
								<option value="hap">Hấp</option>
								<option value="luot">Luột</option>
								<option value="rang">Rang</option>
								<option value="chung">Chưng</option>
								<option value="kho">Kho</option>
								<option value="lau">Lẩu</option>
								<option value="canh">Canh</option>
								<option value="conKho">Khô</option>
								<option value="ham">Hầm</option>
							</optgroup>
							<optgroup label="Thức uống" id="loai_sp_gd_select">
								<option value="Nước suối">Nước suối</option>
								<option value="Nước ngọt">Nước ngọt</option>
								<optgroup label="Bia" id="loai_sp_gd_select">
									<option value="Heniken">Heniken</option>
									<option value="Sapporo">Sapporo</option>
									<option value="Sài gòn Special (xanh)">Sài gòn Special (xanh)</option>
									<option value="Sài gòn Export (đỏ)">Sài gòn Export (đỏ)</option>
									<option value="Tiger đỏ">Tiger đỏ</option>
									<option value="Tiger bạc">Tiger bạc</option>
									<option value="Bia Larue">Larue</option>
									<option value="Bia 333">Bia 333</option>
									<option value="Bia Sư tử trắng">Bia Sư tử trắng</option>
								</optgroup>
							</optgroup>
						</select>
					</div>
					<div class="form-group">
						<label for="gia">Giá món:</label>
						
						<input type="number" class="form-control" id="giamonan" name="giamonan" placeholder="Nhập giá món ... " required>
					</div>
					<div class="form-group">
						<label for="mo_ta">Mô tả món:</label>
						
						<textarea id="mota" name="mota"></textarea>
					</div>
					<div class="form-group" id="khung_hinh">
						<label for="hinh_anh">Hình 1:</label><br>
						<input type="file" name="hinhmonan" id="file1" class="hinh_1 btn "  accept="image/*" style="">
						<div class="khung_load">
							<img id='output1' width="300px" height="200px">
						</div>
					</div>
					<div class="form-group submit_form">
						<input type="hidden" name="token" value="<?php echo $row ?>">
						<input type="submit" name="submit" value="THÊM VÀO THỰC ĐƠN" class="btn btn-primary btn-lg ">
					</div>

				</form><!-- ****End FORM nhập yêu cần bài đăng *** -->
			</div>
			<script type="text/javascript">
				/*
  ** Cho hinh xuat hien khi up file hinh anh
  */
  var openFile = function(event,name) {
  	var input = event.target;

  	var reader = new FileReader();
  	reader.onload = function(){
  		var dataURL = reader.result;
  		var output = document.getElementById(name);
  		output.src = dataURL;
  	};
  	reader.readAsDataURL(input.files[0]);
  };
  $("#file1").change(function(e){
  	openFile(event,'output1');
  });

</script>
<script type="text/javascript">
	CKEDITOR.replace( 'mota' );
</script>