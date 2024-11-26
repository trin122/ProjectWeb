<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HTFAT</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" href="/project/LTWEB/CKI/css/login_reg.css">
    <link rel="icon" href="/project/LTWEB/CKI/img/logo/logo.jpg" type="image/jpg">
    <!-- js -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="/project/LTWEB/CKI/js/login_reg.js"></script>
</head>

<body>
    <div class="form_login_reg">
        <div id="context">
            <img src="/project/LTWEB/CKI/img/logo/anhnen_login_reg.jpg" alt="">
            <h4>HTFAT</h4>
            <h6>Thế giới truyện tranh</h6>
        </div>
        <div id="form_login">
            <form id="login" autocomplete="off">
                <h5>ĐĂNG NHẬP</h5>
                <p id="tbao_login"></p>
                <div style="margin-top: 0">
                    <input type="text" id="input_login_taikhoan">
                    <label for="input_login_taikhoan">Tài khoản</label>
                </div>
                <div>
                    <input type="password" id="input_login_password" autocomplete="new-password">
                    <label for="input_login_password">Mật khẩu</label>
                    <span class="hidden_show_pass_login">
                        <button id="btn_showhidden_login" type="button">
                            <i class="fa-solid fa-eye"></i>
                        </button>
                        <button class="btn_showhidden_login" type="button">
                            <i class="fa-solid fa-eye-slash"></i>
                        </button>
                    </span>
                </div>
                <button type="submit">Đăng nhập</button>
                <div>
                    <span>Bạn chưa có tài khoản?</span><a id="btn_reg">Đăng ký</a>
                </div>
            </form>
        </div>
        <div id="form_reg">
            <form id="reg" autocomplete="off">
                <h5>ĐĂNG KÝ</h5>
                <p id="tbao_reg"></p>
                <div style="margin-top: 0">
                    <input type="text" id="input_regi_ho">
                    <label for="input_regi_ho">Họ</label>
                </div>
                <div>
                    <input type="text" id="input_regi_ten">
                    <label for="input_regi_ten">Tên</label>
                </div>
                <div>
                    <input type="text" id="input_regi_taikhoan">
                    <label for="input_regi_taikhoan">Tài khoản</label>
                </div>
                <div>
                    <input type="password" id="input_regi_password" autocomplete="new-password">
                    <label for="input_regi_password">Mật khẩu</label>
                    <span class="hidden_show_pass_login">
                        <button id="btn_showhidden_reg" type="button">
                            <i class="fa-solid fa-eye"></i>
                        </button>
                        <button class="btn_showhidden_reg" type="button">
                            <i class="fa-solid fa-eye-slash"></i>
                        </button>
                    </span>
                </div>
                <div>
                    <input type="password" id="input_regi_password_again" autocomplete="new-password">
                    <label for="input_regi_password_again">Nhập lại mật khẩu</label>
                    <span class="hidden_show_pass_login">
                        <button id="btn_showhidden_again_reg" type="button">
                            <i class="fa-solid fa-eye"></i>
                        </button>
                        <button class="btn_showhidden_again_reg" type="button">
                            <i class="fa-solid fa-eye-slash"></i>
                        </button>
                    </span>
                </div>
                <button type="submit">Đăng ký</button>
                <div>
                    <span>Bạn đã có tài khoản?</span><a id="btn_login">Đăng nhập</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>