document.addEventListener('DOMContentLoaded', function () {

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

    var giohang_canhan = document.getElementById('giohang_canhan');

    //lấy tất cả thẻ bên trong div
    var elements = giohang_canhan.getElementsByTagName('*');

    giohang_canhan.addEventListener('click', function () {
        for (let element of elements) {
            if (element.classList.contains('giohang')) {
                window.location.href = '/project/LTWEB/CKI/html/nguoidung/giohang.php'
            } else if (element.classList.contains('thongbao')) {
                window.location.href = '/project/LTWEB/CKI/html/spdoiduyet/spdoiduyet.php'
            }
        }
    })

    //phân trang
    $(document).on('click', '.btn_pages_iw', function () {
        loadlistinweek(this.getAttribute('num_page'));
    });

    function loadlistinweek(pageChoose) {
        $.ajax({
            url: '/project/LTWEB/CKI/html/api.php?action=loadlistinweek',
            data: { pageChoose_iw: pageChoose },
            method: 'post',
            success: function (res) {
                $("#books").html(res);
            }
        });
    }
    loadlistinweek(1);

    $(document).on('click', '.btn_pages_sph', function () {
        loadlistSPH(this.getAttribute('num_page'));
    });

    //load danh sách sản phẩm sắp phát hành
    function loadlistSPH(pageChoose) {
        $.ajax({
            url: '/project/LTWEB/CKI/html/api.php?action=loadlistSPH',
            data: { pageChoose_sph: pageChoose },
            method: 'post',
            success: function (res) {
                $("#books_sph").html(res);
                add_book();
            }
        })
    }
    loadlistSPH(1);

    //số lượng member, sản phẩm
    function quant_mem_pro() {
        $.ajax({
            url: '/project/LTWEB/CKI/html/api.php?action=quant_mem_pro',
            success: function (res) {
                if (res) {
                    $("#tvien").html(res.quantity_member);
                    $("#spham").html(res.quantity_product);
                } else {
                    $("#tvien").html("0");
                    $("#spham").html("0");
                }
            }
        })
    }

    quant_mem_pro();

    function add_book() {
        var btn_themgiohang = document.querySelectorAll('.item_book .btn_themgiohang');
        btn_themgiohang.forEach(function (item) {
            item.addEventListener('click', function () {
                var productId = this.getAttribute("data-id-product");
                window.location.href = "/project/LTWEB/CKI/html/nguoidung/giohang.php?id=" + productId;
            });
        });
    }
})
