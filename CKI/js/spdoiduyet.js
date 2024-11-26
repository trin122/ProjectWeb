document.addEventListener('DOMContentLoaded', function () {
    //load danh sách các sản phẩm
    function loadlist() {
        $.ajax({
            url: '/project/LTWEB/CKI/html/api.php?action=spdoiduyet',
            success: function (res) {
                if (res) {
                    $("#container_content").html(res);
                    changeSta();
                    xoaDon();
                } else {
                    $("#container_content").html("Không có sản phẩm chờ duyệt");
                }
            }
        })
    }

    loadlist();

    function tb() {
        $.ajax({
            url: '/project/LTWEB/CKI/html/api.php?action=quantity_tb',
            success: function (res) {
                if (res) {
                    $("#context_tb").html("Thông báo (" + res + ")");
                }
            }
        })
    }

    tb();

    var dialog_spdoiduyet = document.getElementById('dialog_spdoiduyet');
    var title_dialog_spdoiduyet = document.getElementById('title_dialog_spdoiduyet');
    var dialog = document.getElementById('dialog');

    function changeSta() {
        var btn_choduyet = document.querySelectorAll('.btn_choduyet');

        for (var i = 0; i < btn_choduyet.length; i++) {
            btn_choduyet[i].addEventListener('click', function () {

                btn_accept_spdoiduyet.style.display = 'block';

                document.body.style.overflow = 'hidden';
                document.body.style.paddingRight = '0.9%';

                dialog_spdoiduyet.classList.add('show');

                var idOfPro = this.getAttribute('data-mahd');
                var accOfPro = this.getAttribute('taikhoan');

                var text = "Bạn muốn duyệt đơn hàng có mã hóa đơn "+ idOfPro + " của tài khoản " + accOfPro + "?";

                title_dialog_spdoiduyet.innerHTML = text;

                btn_accept_spdoiduyet.addEventListener('click', function () {
                    $.ajax({
                        url: '/project/LTWEB/CKI/html/api.php?action=changeStatusProduct',
                        method: 'post',
                        data: { idOfPro: idOfPro, accOfPro: accOfPro, pbiet: "duyet" },
                        success: function (res) {
                            if (res == "ok") {
                                dialog_spdoiduyet.classList.remove('show');
                                hiddenDialog();
                                setTimeout(function () {
                                    loadlist();
                                    tb();
                                }, 100);
                            } else {
                                alert(res);
                            }
                        }
                    })
                })
            })
        }
    }

    var btn_exit_spdoiduyet = document.getElementById('btn_exit_spdoiduyet');
    var btn_accept_spdoiduyet = document.getElementById('btn_accept_spdoiduyet');
    var btn_huydon_spdoiduyet = document.getElementById('btn_huydon_spdoiduyet');

    function hiddenDialog() {
        dialog_spdoiduyet.classList.remove('show');
        document.body.style.overflow = 'auto';
        document.body.style.paddingRight = '0';
        btn_accept_spdoiduyet.style.display = 'none';
        btn_huydon_spdoiduyet.style.display = 'none';
    }

    dialog_spdoiduyet.addEventListener('click', function () {
        hiddenDialog();
    })

    btn_exit_spdoiduyet.addEventListener('click', function () {
        hiddenDialog();
    })

    //e là đối tượng sự kiện được tự động truyền vào hàm xử lý sự kiện khi sự kiện xảy ra. 
    //Nó chứa thông tin về sự kiện và các phương thức để tương tác với nó.
    dialog.addEventListener('click', function (e) {
        e.stopPropagation();
    })

    function xoaDon() {
        var btn_huydon = document.querySelectorAll('.btn_huydon');

        for (var i = 0; i < btn_huydon.length; i++) {
            btn_huydon[i].addEventListener('click', function () {

                btn_huydon_spdoiduyet.style.display = 'block';

                document.body.style.overflow = 'hidden';
                document.body.style.paddingRight = '0.9%';

                dialog_spdoiduyet.classList.add('show');

                var idOfPro = this.getAttribute('data-mahd');
                var accOfPro = this.getAttribute('taikhoan');

                var text = "Bạn muốn hủy đơn hàng có mã hóa đơn "+ idOfPro + " của tài khoản " + accOfPro + "?";

                title_dialog_spdoiduyet.innerHTML = text;

                btn_huydon_spdoiduyet.addEventListener('click', function () {
                    $.ajax({
                        url: '/project/LTWEB/CKI/html/api.php?action=changeStatusProduct',
                        method: 'post',
                        data: { idOfPro: idOfPro, accOfPro: accOfPro, pbiet: "huy" },
                        success: function (res) {
                            if (res == "ok") {
                                dialog_spdoiduyet.classList.remove('show');
                                hiddenDialog();
                                setTimeout(function () {
                                    loadlist();
                                    tb();
                                }, 100);
                            } else {
                                alert(res);
                            }
                        }
                    })
                })
            })
        }
    }
})