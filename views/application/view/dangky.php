<div class="breadcrumbs ace-save-state" id="breadcrumbs" style="background-color: #fff;border: none">
                <ul class="breadcrumb">
                    <li>
                        <i class="ace-icon fa fa-home home-icon"></i>
                        <a href="/">Home</a>
                    </li>
                    <li class="active">QUẢN LÝ NHÂN VIÊN </li>
                    <li class="active"><span id="nameItem"> ĐĂNG KÝ TÀI KHOẢN CHO NHÂN VIÊN </span></li>
                </ul><!-- /.breadcrumb -->
            </div>
<style type="text/css">
    /** FORM DANG KY **/
    .form-style-10{
        width:450px;
        padding:30px;
        margin:40px auto;
        background: #EEEEEE;
        border-radius: 10px;
        -webkit-border-radius:10px;
        -moz-border-radius: 10px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.13);
        -moz-box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.13);
        -webkit-box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.13);
    }
    .form-style-10 .inner-wrap{
        padding: 30px;
        background: #F8F8F8;
        border-radius: 6px;
        margin-bottom: 15px;
    }
    .form-style-10 h1{
        background: #2A88AD;
        padding: 20px 30px 15px 30px;
        margin: -30px -30px 30px -30px;
        border-radius: 10px 10px 0 0;
        -webkit-border-radius: 10px 10px 0 0;
        -moz-border-radius: 10px 10px 0 0;
        color: #fff;
        text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.12);
        font: normal 30px 'Bitter', serif;
        -moz-box-shadow: inset 0px 2px 2px 0px rgba(255, 255, 255, 0.17);
        -webkit-box-shadow: inset 0px 2px 2px 0px rgba(255, 255, 255, 0.17);
        box-shadow: inset 0px 2px 2px 0px rgba(255, 255, 255, 0.17);
        border: 1px solid #257C9E;
    }
    .form-style-10 h1 > span{
        display: block;
        margin-top: 2px;
        font: 13px Arial, Helvetica, sans-serif;
    }
    .form-style-10 label{
        display: block;
        font: 15px Arial, Helvetica, sans-serif;
        color: #888;
        margin-bottom: 15px;
    }
    .form-style-10 input[type="text"],
    .form-style-10 input[type="date"],
    .form-style-10 input[type="datetime"],
    .form-style-10 input[type="email"],
    .form-style-10 input[type="number"],
    .form-style-10 input[type="search"],
    .form-style-10 input[type="time"],
    .form-style-10 input[type="url"],
    .form-style-10 input[type="password"],
    .form-style-10 textarea,
    .form-style-10 select {
        display: block;
        box-sizing: border-box;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        width: 100%;
        padding: 8px;
        border-radius: 6px;
        -webkit-border-radius:6px;
        -moz-border-radius:6px;
        border: 2px solid #fff;
        box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.33);
        -moz-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.33);
        -webkit-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.33);
    }

    .form-style-10 .section{
        font: normal 20px 'Bitter', serif;
        color: #2A88AD;
        margin-bottom: 5px;
    }
    .form-style-10 .section span {
        background: #2A88AD;
        padding: 5px 10px 5px 10px;
        position: absolute;
        border-radius: 50%;
        -webkit-border-radius: 50%;
        -moz-border-radius: 50%;
        border: 4px solid #fff;
        font-size: 14px;
        margin-left: -45px;
        color: #fff;
        margin-top: -3px;
    }
    .form-style-10 input[type="button"], 
    .form-style-10 input[type="submit"]{
        background: #2A88AD;
        padding: 8px 20px 8px 20px;
        border-radius: 5px;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        color: #fff;
        text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.12);
        font: normal 30px 'Bitter', serif;
        -moz-box-shadow: inset 0px 2px 2px 0px rgba(255, 255, 255, 0.17);
        -webkit-box-shadow: inset 0px 2px 2px 0px rgba(255, 255, 255, 0.17);
        box-shadow: inset 0px 2px 2px 0px rgba(255, 255, 255, 0.17);
        border: 1px solid #257C9E;
        font-size: 15px;
    }
    .form-style-10 input[type="button"]:hover, 
    .form-style-10 input[type="submit"]:hover{
        background: #2A6881;
        -moz-box-shadow: inset 0px 2px 2px 0px rgba(255, 255, 255, 0.28);
        -webkit-box-shadow: inset 0px 2px 2px 0px rgba(255, 255, 255, 0.28);
        box-shadow: inset 0px 2px 2px 0px rgba(255, 255, 255, 0.28);
    }
    .form-style-10 .privacy-policy{
        float: right;
        width: 250px;
        font: 12px Arial, Helvetica, sans-serif;
        color: #4D4D4D;
        margin-top: 10px;
        text-align: right;
    }.phone,.cmnd{
        font-weight: bold;
        color: red;
        display: none;
    } /* END FORM DANG KY **/
    @media screen and (max-width:460px){
        .form-style-10{
            width: 100%;
        }
    }
</style>
<script type="text/javascript">
    $(document).ready(function(){
        // check so dien thoai la so va do dai lon hon 10
        $("#phone").on('blur',function(){
            var phone = $(this).val();
            
            if(isNaN(phone) || phone.length < 10){
              $('.phone').slideDown();
            }else{
              $('.phone').slideUp();
            }
        });
        // check so cmnd la so va do dai lon hon 9
        $("#cmnd").on('blur',function(){
            var cmnd = $(this).val();
            
            if(isNaN(cmnd) || cmnd.length < 9){
              $('.cmnd').slideDown();
            }else{
                
              $('.cmnd').slideUp();
            }
        });
    });
    
</script>

<div class="form-style-10">
    <h1 style="">ĐĂNG KÝ TÀI KHOẢN</h1>
    <form action="http://localhost:8000/php-socket/views/?c=trangchu&a=senddangky" method="POST">
        <div class="section"><span>1</span>Username &amp;  Họ Tên  &amp; Địa Chỉ </div>
        <div class="inner-wrap">
            <label>Username <input type="text" name="username" class="username" required /></label>
            
            <label>Họ <input type="text" name="ho" required /></label>
            <label>Tên <input type="text" name="ten" required  /></label>
            <label>Địa Chỉ <textarea name="diachi" required ></textarea></label>
        </div>

        <div class="section"><span>2</span>Số CMND &amp; SĐT</div>
        <div class="inner-wrap">
            <label>Số CMND <input type="text"  id="cmnd" name="cmnd" required  /></label>
            <p class="cmnd">CMND phải đúng 9 số và không có chữ</p>
            <label>SĐT <input type="text" name="sdt" id="phone"  required  /></label>
            <p class="phone">SĐT: 09213647856</p>
        </div>

        <div class="section"><span>3</span>Mật Khẩu</div>
        <div class="inner-wrap">
            <label>Mật khẩu <input type="password" minlength="6" name="password" required/></label>
            <label>Nhập lại mật khẩu <input type="password" minlength="6" name="password-again" required /></label>
        </div>
        <div class="section"><span>4</span>Giới tính &amp; Ngày Sinh</div>
        <div class="inner-wrap">
        <label>Giới tính 
            <select name="gioitinh" class="form-control" style="height: 60px;">
                <option value="nam" >Nam</option>
                <option value="nu">Nữ</option>
            </select></label>
            <label>Ngày sinh <input type="date" name="ngaysinh" /></label>
        </div>
        <div class="button-section">
            <input type="hidden" name="token" value="<?php echo $row ?>">
           <input type="submit" name="Sign Up"   value="ĐĂNG KÝ" />
       </div>
   </form>
</div>