document.addEventListener('DOMContentLoaded', function(){
    function totalAmount_giohang() {
        $.ajax({
            url: '/project/LTWEB/CKI/html/api.php?action=totalAmount_giohang',
            success: function (res) {
                $("#giohang").html("Giỏ hàng (" + res.quantity_product + ")");
                $("#tiengiohong").html(Number(res.totalAmount).toLocaleString('vi-VN')+"đ");}
        });
    }

    totalAmount_giohang();
})