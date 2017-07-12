	<?php
		$data =$row["result"];
		// ham lay gia tri truyen vao combobox 
		function valueCombobox($loaimonan,$tenloai,$row){
			if($row->loaiMonAn == $loaimonan){
				echo "<option value='$loaimonan' selected>".$tenloai."</option>";
			}else{
				echo "<option value='$loaimonan'>".$tenloai."</option>";
			}
		}
	?>
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
		<div class="breadcrumbs ace-save-state" id="breadcrumbs" style="background-color: #fff;border: none">
                <ul class="breadcrumb">
                    <li>
                        <i class="ace-icon fa fa-home home-icon"></i>
                        <a href="/">Home</a>
                    </li>
                    <li ><a href="http://localhost:8000/php-socket/views/?c=thucdon&a=quanlythucdon">QUẢN LÝ THỰC ĐƠN</a></li>
                    <li class="active"><span id="nameItem"> SỬA THỰC ĐƠN </span></li>
                    <li class="active"><?php echo $data[0]->tenMonAn ?></li>
                </ul><!-- /.breadcrumb -->
            </div>
            <div class="container">
		<div class="row">
			<div class="col-md-7">
				<h1 style="font-weight: bold; color: #CCCCCC;">SỬA MÓN ĂN VÀO THỰC ĐƠN(<span>vui lòng điền đầy đủ thông tin</span>)</h1>
				<!-- **** FORM nhập yêu cần bài đăng *** -->
				<form action="http://localhost:8000/php-socket/views/?c=thucdon&a=sendsuathucdon" method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<label for="ten_san_pham">Tên món:</label>
						
						<input type="text" class="form-control"  name="tenmonan" id="tenmonan" placeholder="Nhập tên cho món ..." value="<?php echo $data[0]->tenMonAn ?>" required>
						<label id="check-name"></label>
					</div>
					<div class="form-group">
						<label>Chọn loại sản phẩm:</label>
						
						<select class="form-control" id="chon_loai_sp" name="loaimonan" required>
							<option value="" id="tieu_de_chon_loai" >**** Chọn loại thực đơn ****</option>
							<optgroup label="Thức ăn" id="loai_sp_select" >
								<?php valueCombobox("chien","Chiên",$data[0]) ?>
								<?php valueCombobox("xao","Xào",$data[0]) ?>
								<?php valueCombobox("nuong","Nướng",$data[0]) ?>
								<?php valueCombobox("hap","Hấp",$data[0]) ?>
								<?php valueCombobox("luot","Luột",$data[0]) ?>
								<?php valueCombobox("rang","Rang",$data[0]) ?>
								<?php valueCombobox("chung","Chưng",$data[0]) ?>
								<?php valueCombobox("kho","Kho",$data[0]) ?>
								<?php valueCombobox("lau","Lẩu",$data[0]) ?>
								<?php valueCombobox("canh","Canh",$data[0]) ?>
								<?php valueCombobox("conKho","Khô",$data[0]) ?>
								<?php valueCombobox("ham","Hầm",$data[0]) ?>
							</optgroup>
							<optgroup label="Thức uống" id="loai_sp_gd_select">
								
								<?php valueCombobox("Nước suối","Nước suối",$data[0]) ?>
								
								<?php valueCombobox("Nước ngọt","Nước ngọt",$data[0]) ?>
								<optgroup label="Bia" id="loai_sp_gd_select">
									
									<?php valueCombobox("Heniken","Heniken",$data[0]) ?>
									
									<?php valueCombobox("Sapporo","Sapporo",$data[0]) ?>

									<?php valueCombobox("Sài gòn Special (xanh)","Sài gòn Special (xanh)",$data[0]) ?>
									
									<?php valueCombobox("Sài gòn Export (đỏ)","Sài gòn Export (đỏ)",$data[0]) ?>
									
									<?php valueCombobox("Tiger đỏ","Tiger đỏ",$data[0]) ?>
									
									<?php valueCombobox("Tiger bạc","Tiger bạc",$data[0]) ?>
									
									<?php valueCombobox("Larue","Larue",$data[0]) ?>
									
									<?php valueCombobox("Bia 333","Bia 333",$data[0]) ?>
									
									<?php valueCombobox("Bia Sư tử trắng","Bia Sư tử trắng",$data[0]) ?>
								</optgroup>
							</optgroup>
						</select>
					</div>
					<div class="form-group">
						<label for="gia">Giá món:</label>
						
						<input type="number" class="form-control" id="giamonan" name="giamonan" placeholder="Nhập giá món ... " value="<?php echo $data[0]->giaMonAn ?>" required>
					</div>
					<div class="form-group">
						<label for="mo_ta">Mô tả món:</label>
						
						<textarea id="mota" name="mota"><?php echo $data[0]->moTaMonAn ?></textarea>
					</div>
					<div class="form-group" id="khung_hinh">
						<label for="hinh_anh">Hình 1:</label><br>
						<input type="file" name="hinhmonan" id="file1" class="hinh_1 btn "  accept="image/*" style="">
						<input type="hidden" name="hinh_anh_cu" value="<?php echo $data[0]->hinhMonAn?>">
						<div class="khung_load">
							<img id='output1' width="300px" src="lir/images/<?php echo $data[0]->hinhMonAn ?>" height="200px">
						</div>
					</div>
					<div class="form-group submit_form">
						<input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
						<input type="hidden" name="token" value="<?php echo $row['token'] ?>">
						<input type="submit" name="submit" value="SỬA MÓN NÀY" class="btn btn-primary btn-lg ">
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