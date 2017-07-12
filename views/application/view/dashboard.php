<div id="navbar" class="navbar navbar-default          ace-save-state">
	<div class="navbar-container ace-save-state" id="navbar-container">
		<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
			<span class="sr-only">Toggle sidebar</span>

			<span class="icon-bar"></span>

			<span class="icon-bar"></span>

			<span class="icon-bar"></span>
		</button>

		<div class="navbar-header pull-left">
			<a href="/" class="navbar-brand">
				<small>
					<i class="fa fa-leaf"></i>
					Ace Admin
				</small>
			</a>
		</div>

		<div class="navbar-buttons navbar-header pull-right" role="navigation">
			<ul class="nav ace-nav">
			<?php if(isset($_SESSION["admin"]) || isset($_SESSION['quanly'])){ ?>
				<li class="grey dropdown-modal">

					<a data-toggle="dropdown" class="dropdown-toggle review-table" href="#">
						<i class="ace-icon fa fa-table"></i>
						
					</a>
				</li>
			<?php } ?>
				<li class="purple dropdown-modal">
				<div id="notifi"></div>
				<?php if(isset($_SESSION["admin"]) || isset($_SESSION['quanly'])){ ?>
					<a data-toggle="dropdown" class="dropdown-toggle" href="#">
						<i class="ace-icon fa fa-bell icon-animated-bell"></i>
						<span class="badge badge-important" id="thongbao"></span>
						
					</a>

					<script type="text/javascript">
						$(document).ready(function(){
							var socket = io.connect("http://localhost:3000/");
							$dodai = 0;
							$notifi = $("#thongbao");
							$notifi_drop= $("#thongbao-drop");
							$notifi_content = $("#notifi-content");
							socket.on('feedback to waiter',function(data){
								// lay do dai ban dau
								$dodai= data.total;
								$notifi.html(data.total);
								$notifi_drop.html(data.total);
								$("#notifi").append("<audio autoplay='true'> <source src='lir/sound/served.mp3' type='audio/mpeg'> </audio>");
								// Tao vong lap xuat du lieu su dung map trong jquery
								$notifi_content.html("");
								data.notifi.map(function(r){
									$notifi_content.append("<li class= 'list-group-item ban_thongbao' style='cursor: pointer;' ><i class='btn btn-xs btn-primary fa fa-user'></i> "  +r + "</li>");
								});
								
							});
							$('#notifi-content').on('click', '.ban_thongbao', function() {
								var value = $(this).text();
								$dodai = $dodai -1;
								$notifi.html($dodai);
								$notifi_drop.html($dodai);
								$(this).css('display','none');
								socket.emit('delete table',value);

							});
							$(".review-table").click(function(){
								var require = 1;
								socket.emit("send require to server get table",require);
							});
						});
						
					</script>
					<?php } ?>
					<script type="text/javascript">
						var socket = io.connect("http://localhost:3000/");
						socket.on('feedback to table light',function(data){
								// hien noi dung va hinh anh thong bao
								$tenban_get = $("#tenban");
								$tenban_notifi = $("#tenban-notifi");
								$tenban_get.append("<li>"+ data.tenban +" </li>");
								$tenban_notifi.html("<i class='ace-icon fa fa-envelope icon-animated-vertical'></i>");
								//Thong bao am thanh
								$("#notifi").append("<audio autoplay='true'> <source src='lir/sound/served.mp3' type='audio/mpeg'> </audio>");
							});
					</script>
					<ul class="dropdown-menu-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close">
						<li class="dropdown-header">
							<i class="ace-icon fa fa-exclamation-triangle"></i>
							<span id="thongbao-drop"></span> Thông báo mới
						</li>

						<li class="dropdown-content">
							<ul class="dropdown-menu dropdown-navbar navbar-pink">
								<div id="notifi-content">

									

								</div>
							</ul>
						</li>

						<li class="dropdown-footer">
							<a href="#">
								See all notifications
								<i class="ace-icon fa fa-arrow-right"></i>
							</a>
						</li>
					</ul>
				</li>

				<li class="green dropdown-modal">
					<a data-toggle="dropdown" class="dropdown-toggle" id="tenban-notifi" href="#">
						
						
							
						
					</a>

					<ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
						<li class="dropdown-header">
							<i class="ace-icon fa fa-envelope-o"></i>
							 Messages
						</li>

						<li class="dropdown-content">
							<ul class="dropdown-menu dropdown-navbar">
								<li id="tenban">
									
								</li>
								

							</ul>
						</li>

					</ul>
				</li>

				
			</ul>
		</div>
	</div><!-- /.navbar-container -->
</div>

<div class="main-container ace-save-state" id="main-container">
	<script type="text/javascript">
		try{ace.settings.loadState('main-container')}catch(e){}
	</script>

	<div id="sidebar" class="sidebar                  responsive                    ace-save-state">
		<script type="text/javascript">
			try{ace.settings.loadState('sidebar')}catch(e){}
		</script>

		<div class="sidebar-shortcuts" id="sidebar-shortcuts">
			<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
				<button class="btn btn-success">
					<a href="http://localhost:8000/php-socket/views/?c=thongke" style="color: #fff;"><i class="ace-icon fa fa-signal"></i></a>
				</button>

				<button class="btn btn-info">
					<i class="ace-icon fa fa-pencil"></i>
				</button>

				<button class="btn btn-warning">
					<i class="ace-icon fa fa-users"></i>
				</button>

				<button class="btn btn-danger">
					<i class="ace-icon fa fa-cogs"></i>
				</button>
			</div>

			<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
				<span class="btn btn-success"></span>

				<span class="btn btn-info"></span>

				<span class="btn btn-warning"></span>

				<span class="btn btn-danger"></span>
			</div>
		</div><!-- /.sidebar-shortcuts -->

		<ul class="nav nav-list">
			<li class="active">
				<a href="http://localhost:8000/php-socket/views/">
					<i class="menu-icon fa fa-tachometer"></i>
					<span class="menu-text"> TRANG CHỦ </span>
				</a>

				<b class="arrow"></b>
			</li>
			
			<li class="">

				<a href="#" class="dropdown-toggle">
					<i class="menu-icon fa fa-desktop"></i>

					<span class="menu-text">
					<?php if(!isset($_SESSION['login'])){ ?>
						ĐĂNG NHẬP
					<?php
						}else{
							echo "ĐĂNG XUẤT";
						}
					?>
					</span>

					<b class="arrow fa fa-angle-down"></b>
				</a>

				<b class="arrow"></b>
				
				<ul class="submenu">
					<?php if(!isset($_SESSION['login'])){ ?>
					<li class="">
						<a href="http://localhost:8000/php-socket/views/?c=trangchu&a=dangnhap">
							<i class="menu-icon fa fa-caret-right"></i>

							ĐĂNG NHẬP
							
						</a>

						<b class="arrow"></b>
					</li>
					<?php }else{ ?>
					<li >
						<a href="http://localhost:8000/php-socket/views/?c=trangchu&a=dangxuat">
							<i class="menu-icon fa fa-caret-right"></i>
							ĐĂNG XUẤT
						</a>

						<b class="arrow"></b>
					</li>

					<?php
						}
					?>

				</ul>
			</li>

			<li class="">
				<a href="#" class="dropdown-toggle">
					<i class="menu-icon fa fa-list"></i>
					<span class="menu-text"> QUẢN LÝ BÀN </span>

					<b class="arrow fa fa-angle-down"></b>
				</a>

				<b class="arrow"></b>

				<ul class="submenu">
					<?php if(isset($_SESSION['quanly']) ||isset($_SESSION['admin'])){ ?>
					<li class="">
						<a href="http://localhost:8000/php-socket/views/?c=trangchu&a=chiaban">
							<i class="menu-icon fa fa-caret-right"></i>
							TẠO BÀN 
						</a>

						<b class="arrow"></b>
					</li>
					<?php } ?>
					<?php if(isset($_SESSION['quanly']) ||isset($_SESSION['admin']) ||isset($_SESSION['phucvu'])){ ?>
					<li class="">
						<a href="http://localhost:8000/php-socket/views/?c=trangchu&a=showBan">
							<i class="menu-icon fa fa-caret-right"></i>
							QUẢN LÝ THÔNG TIN BÀN
						</a>

						<b class="arrow"></b>
					</li>
					<?php  }?>
				</ul>
			</li>

			<li class="">
				<a href="#" class="dropdown-toggle">
					<i class="menu-icon fa fa-pencil-square-o"></i>
					<span class="menu-text"> THỰC ĐƠN </span>

					<b class="arrow fa fa-angle-down"></b>
				</a>

				<b class="arrow"></b>

				<ul class="submenu">
					<li class="">
						<a href="http://localhost:8000/php-socket/views/?c=thucdon&a=quanlythucdon">
							<i class="menu-icon fa fa-caret-right"></i>
							QUẢN LÝ THỰC ĐƠN
						</a>

						<b class="arrow"></b>
					</li>
				</ul>
			</li>

			<li class="">
				<a href="#" class="dropdown-toggle">
					<i class="menu-icon fa fa-tag"></i>
					<span class="menu-text"> QUẢN LÝ NHÂN VIÊN </span>

					<b class="arrow fa fa-angle-down"></b>
				</a>

				<b class="arrow"></b>

				<ul class="submenu">
					<?php if(isset($_SESSION['admin'])){ ?>
					<li >
						<a href="http://localhost:8000/php-socket/views/?c=trangchu&a=quanlynhanvien">
							<i class="menu-icon fa fa-caret-right"></i>
							QUẢN LÝ NHÂN VIÊN
						</a>

						<b class="arrow"></b>
					</li>
					<li >
						<a href="http://localhost:8000/php-socket/views/?c=trangchu&a=dangky">
							<i class="menu-icon fa fa-caret-right"></i>
							ĐĂNG KÝ TÀI KHOẢN CHO NGƯỜI DÙNG
						</a>

						<b class="arrow"></b>
					</li>
					
					
					<li >
						<a href="http://localhost:8000/php-socket/views/?c=trangchu&a=capquyen">
							<i class="menu-icon fa fa-caret-right"></i>
							CẤP QUYỀN CHO NGƯỜI DÙNG 
						</a>

						<b class="arrow"></b>
					</li>

					
					<?php } ?>
				</ul>
			</li>

		</ul><!-- /.nav-list -->

		<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
			<i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
		</div>
	</div>

	<div class="main-content">
		<div class="main-content-inner">
			

			<div class=" flash">
				<?php if(isset($_COOKIE['flash'])){ ?>
				<div class="alert alert-success">
					<?php echo $_COOKIE['flash'] ?>
				</div>
				<?php
				}
			?>
				<?php if(isset($_COOKIE['flash-error'])){ ?>
				<div class="alert alert-danger">
					<?php echo $_COOKIE['flash-error'] ?>
				</div>
				<?php
				}
			?>