<header id="header">
    <div>
        <a href="/project/LTWEB/CKI/html/trangchu.php"><img src="/project/LTWEB/CKI/img/logo/logo.jpg"
                alt="Ảnh logo"></a>
    </div>
    <div>
        <form action="/project/LTWEB/CKI/html/result_find.php" method="GET">
            <input type="text" id="header_search" name="header_search" placeholder="Nhập từ khóa tìm kiếm...">
            <button type="submit"><i class="fa fa-search"></i></button>
        </form>
    </div>
    <div>
        <li>
            <div>
                <i class="fa-solid fa-circle-user"></i>
            </div>
            <div>
                <?php
                if (!isset($_SESSION['taikhoan'])) {
                    ?>
                    <div id="taikhoan_xinchao"><span>Tài khoản</span></div>
                    <ul>
                        <li><a href="/project/LTWEB/CKI/html/login_reg/login_reg.php">Đăng nhập</a></li>
                    </ul>
                    <?php
                } else {
                    ?>
                    <div id="taikhoan_xinchao"><span>Xin chào</span></div>
                    <div id="tennguoidung"><?php echo $_SESSION['ten']; ?></div>
                    <?php if ($_SESSION['loai'] == 0) { ?>
                        <ul>
                            <!-- <li><a href="/project/LTWEB/CKI/html/nguoidung/giohang.php">Giỏ hàng</a></li> -->
                            <li><a href="/project/LTWEB/CKI/html/qltk/QLTK.php">Quản lý tài khoản</a></li>
                            <li><a href="/project/LTWEB/CKI/html/qlsp/QLSP.php">Quản lý sản phẩm</a></li>
                            <li><a href="/project/LTWEB/CKI/html/doanhthu/doanhthu.php">Quản lý doanh thu</a></li>
                            <li><a href="/project/LTWEB/CKI/html/nguoidung/doimatkhau.php">Đổi mật khẩu</a></li>
                            <li><a href="/project/LTWEB/CKI/html/api.php?action=logout">Đăng xuất</a></li>
                        </ul>
                    <?php } else { ?>
                        <ul>
                            <li><a href="/project/LTWEB/CKI/html/nguoidung/nguoidung.php">Thông tin tài khoản</a></li>
                            <li><a href="/project/LTWEB/CKI/html/nguoidung/doimatkhau.php">Đổi mật khẩu</a></li>
                            <li><a href="/project/LTWEB/CKI/html/api.php?action=logout">Đăng xuất</a></li>
                        </ul><?php
                    }
                    ?>
                    <?php
                }
                ?>
            </div>
        </li>
        <li id="giohang_canhan">
            <?php
            if (!isset($_SESSION['taikhoan'])) {
                ?>
                <div>
                    <i class="fa fa-cart-shopping"></i>
                </div>
                <div>
                    <div class="giohang"><span>Giỏ hàng (0)</span></div>
                    <div class="tiengiohong">0đ</div>
                <?php } else { ?>
                    <?php if ($_SESSION['loai'] == 1) { ?>
                        <div>
                            <i class="fa fa-cart-shopping"></i>
                        </div>
                        <div>
                            <div class="giohang">
                                <span id="giohang"></span>
                            </div>
                            <div class="tiengiohong">
                                <span id="tiengiohong"></span>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div>
                            <i style="font-size: 1.5pc" class="fa-solid fa-bell"></i>
                        </div>
                        <div>
                            <div class="thongbao"><span id="context_tb">Thông báo (0)</span></div>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
        </li>
    </div>
</header>
<nav>
    <li><a href="/project/LTWEB/CKI/html/danhmuc/danhmuc.php">DANH MỤC</a></li>
    <li><a href="/project/LTWEB/CKI/html/vechungtoi.php">VỀ CHÚNG TÔI</a></li>
    <li><a href="https://chat.zalo.me/?phone=0375204558">LIÊN HỆ</a></li>
</nav>

<!-- button kéo lên đầu trang -->
<div id="dialog_button">
    <a href="#header"><button type="button"><i class="fa-solid fa-angles-up"></i></button></a>
    <a href="#footer"><button type="button"><i class="fa-solid fa-angles-down"></i></button></a>
</div>