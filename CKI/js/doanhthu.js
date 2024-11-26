document.addEventListener('DOMContentLoaded', function () {
    function listRevenu() {
        $.ajax({
            url: '/project/LTWEB/CKI/html/api.php?  action=listRevenu',
            success: function (res) {
                $("#content_revenu").html(res);
            }
        })
    }

    listRevenu();

    var input_search = document.getElementById('input_search');
    var date_from = document.getElementById('date_from');
    var date_to = document.getElementById('date_to');

    //tìm kiếm từ khóa
    $('#input_search, #date_from, #date_to').on('input', function () {
        if (!input_search.value && !date_from.value && !date_to.value) {
            listRevenu();
        }

        $.ajax({
            url: '/project/LTWEB/CKI/html/api.php?action=listRevenu',
            data: { date_to: date_to.value, date_from: date_from.value, input_search: input_search.value },
            method: 'post',
            success: function (res) {
                $("#content_revenu").html(res);
            }
        });
    });

    //phân trang
    $(document).on('click', '.btn_pages', function () {
        pag(this.getAttribute('num_page'));
    });

    function pag(pageChoose) {
        $.ajax({
            url: '/project/LTWEB/CKI/html/api.php?  action=listRevenu',
            data: { pageChoose: pageChoose },
            method: 'post',
            success: function (res) {
                $("#content_revenu").html(res);
            }
        });
    }

    //mặc định sẽ là trang 1
    pag(1);

    //sơ đồ
    function getInforFromDT() {
        $.ajax({
            url: '/project/LTWEB/CKI/html/api.php?action=getInforFromDT',
            success: function (res) {
                console.log(res)
                if (res.time) {
                    timeOfDay = [];
                    for (var i = 0; i < res.time.length; i++) {
                        timeOfDay.push(res.time[i]);
                    }
                } else {
                    timeOfDay = Array(23).fill(0);
                }

                if (res.date) {
                    dayOfMonth = [];
                    for (var i = 0; i < res.date.length; i++) {
                        dayOfMonth.push(res.date[i]);
                    }
                } else {
                    dayOfMonth = Array(31).fill(0);
                }
                console.log(res.date[1])
                if (res.month) {
                    monthOfYear = [];
                    for (var i = 0; i < res.month.length; i++) {
                        monthOfYear.push(res.month[i]);
                    }
                } else {
                    monthOfYear = Array(12).fill(0);
                }

                if (res.quantity_product) {
                    quantity_product = [];
                    for (var i = 0; i < res.quantity_product.length; i++) {
                        quantity_product.push(res.quantity_product[i]);
                    }
                } else {
                    quantity_product = Array(10).fill(0);
                }

                chartTime(timeOfDay);
                chartDate(dayOfMonth);
                chartMonth(monthOfYear);
                barChart(quantity_product);
            }
        })
    }

    getInforFromDT();

    // sơ đồ giờ
    function chartTime(res) {
        if (res) {
            var now = new Date().getDate() + "/" + (new Date().getMonth() + 1) + "/" + new Date().getFullYear();

            var text = "Biểu đồ doanh thu giờ trong ngày (" + now + ")";

            var ctx = document.getElementById('myChart_time');

            //mảng chứa giờ
            var xAxes = [];

            //mảng chứa tổng tiền của giờ
            var yAxes = new Array(23).fill(0);

            //giờ theo ngày
            for (var i = 0; i <= 23; i++) {
                var formatI = i < 10 ? `0${i}h` : `${i}h`;
                xAxes.push(formatI);
            }

            for (var i = 0; i < res.length; i++) {
                for (var j = 0; j < xAxes.length; j++) {
                    if (xAxes[j] == `${res[i].hour}h`) {
                        yAxes[j] = res[i].thanhtien;
                    }
                }
            }
            var label = "Tổng tiền";
            var maxTicksLimit = 12;

            chart(ctx, xAxes, yAxes, label, maxTicksLimit, text);
        }
    }

    chartTime();

    // sơ đồ ngày
    function chartDate(res) {
        if (res) {
            var now = (new Date().getMonth() + 1) + "/" + new Date().getFullYear();

            var text = "Biểu đồ doanh thu ngày trong tháng (" + now + ")";

            var ctx = document.getElementById('myChart_date');

            var yAxes = [];
            var xAxes = [];

            for (var i = 0; i < res.length; i++) {
                yAxes.push(res[i].tien_ngay);

                if (res[i].day == 1) {
                    xAxes.push(`${res[i].day}st`);
                } else if (res[i].day == 2) {
                    xAxes.push(`${res[i].day}nd`);
                } else if (res[i].day == 3) {
                    xAxes.push(`${res[i].day}rd`);
                } else {
                    xAxes.push(`${res[i].day}th`);
                }
            }

            var label = "Tổng tiền";
            var maxTicksLimit = 15;

            chart(ctx, xAxes, yAxes, label, maxTicksLimit, text);
        }
    }

    chartDate();

    function chartMonth(res) {
        if (res) {
            var text = "Biểu đồ doanh thu tháng trong năm (" + new Date().getFullYear() + ")";

            var ctx = document.getElementById('myChart_month');

            var yAxes = new Array(12).fill(0);
            var xAxes = ["Jan", "Feb", "March", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

            for (var i = 0; i < res.length; i++) {
                for (var j = 0; j < xAxes.length; j++) {
                    if (res[i].month == `0${j}`) {
                        yAxes[j] = res[i].tien_thang;
                    }
                }
            }

            var label = "Tổng tiền";
            var maxTicksLimit = 6;

            chart(ctx, xAxes, yAxes, label, maxTicksLimit, text);
        }
    }
    chartMonth();

    //chart bar
    function barChart(res) {
        if (res) {
            var ctx = document.getElementById('barChart');

            var xValues = [];
            var yValues = [];
            var taptruyen = [];

            for (var i = 0; i < res.length; i++) {
                xValues.push(res[i].ten);
                taptruyen.push(res[i].taptruyen);
                yValues.push(res[i].soluongdaban);
            }

            new Chart(ctx, {
                type: "bar",
                data: {
                    labels: xValues,
                    datasets: [{
                        label: "Số lượng bán được",
                        backgroundColor: "#5d8650",
                        data: yValues
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    tooltips: {
                        callbacks: {
                            title: function (pos) {
                                return xValues[pos[0].index] + " " + taptruyen[pos[0].index];
                            },
                            label: function (context) {
                                return "Tổng lượt bán: " + context.yLabel.toLocaleString('vi-VN')
                            },
                        }
                    },
                    legend: { display: false },
                    title: {
                        display: true,
                        text: "Thống kê 10 sản phẩm lượt bán cao nhất"
                    },
                    scales: {
                        xAxes: [{
                            gridLines: { //kiểm soát hiển thị của các đường lưới và đường viền của trục.
                                display: false, //không hiển thị các đường lưới ngang trên trục x.
                            },
                            ticks: {
                                callback: function (value) {
                                    return value.length > 5 ? value.substring(0, 5) + '...' : value;
                                }
                            }
                        }],
                        yAxes: [{
                            gridLines: {
                                color: "rgb(234, 236, 244)", // màu sắc của các đường lưới trên trục y.
                                zeroLineColor: "rgb(234, 236, 244)", //màu sắc của đường lưới tại điểm giá trị bằng 0 trên trục y.
                                borderDash: [2], //kiểu đường kẻ của các đường lưới trên trục y.
                            }
                        }],
                    }
                }
            });
        }
    }

    barChart();

    function chart(ctx, labels, data, label, maxTicksLimit, text) {
        // Tạo biểu đồ
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: label,
                    tension: 0.3,
                    backgroundColor: "#5d86501e", //màu nền
                    borderColor: "#5d8650", //màu line
                    pointBackgroundColor: "#5d8650", //màu điểm chấm tròn
                    pointBorderColor: "#5d8650", //màu đường viền chấm tròn
                    pointHoverBackgroundColor: "#5d8650", //màu khi hover vào chấm tròn
                    pointHoverBorderColor: "#5d8650", // màu đường viền khi hover vào chấm tròn
                    pointHitRadius: 10, //bán kính của khu vực nhạy cảm (hitbox) xung quanh các điểm dữ liệu.
                    pointBorderWidth: 2, //độ dày của đường viền xung quanh các điểm dữ liệu.
                    data: data,
                }]
            },
            options: {
                title: {
                    display: true,
                    text: text,
                },
                tooltips: {
                    callbacks: {
                        label: function (context) {
                            return "Tổng tiền: " + context.yLabel.toLocaleString('vi-VN', {
                                style: 'currency',
                                currency: 'VND'
                            });
                            // đối số cấu hình cho toLocaleString()
                            //style: 'currency': Chỉ định rằng bạn muốn định dạng số dưới dạng tiền tệ.
                            //currency: 'VND': Xác định loại tiền tệ là đồng Việt Nam (VND).
                        },
                    }
                },
                maintainAspectRatio: false, //sử dụng để kiểm soát cách tỷ lệ khung hình của biểu đồ được duy trì khi kích thước của nó thay đổi
                legend: { display: false },
                layout: {
                    padding: {
                        left: 10,
                        right: 25,
                        top: 0,
                        bottom: 15
                    }
                },
                scales: {
                    xAxes: [{
                        gridLines: { //kiểm soát hiển thị của các đường lưới và đường viền của trục.
                            display: false, //không hiển thị các đường lưới ngang trên trục x.
                        },
                        ticks: {
                            maxTicksLimit: maxTicksLimit //số lượng tối đa các điểm đánh dấu (ticks) trên trục x.
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            maxTicksLimit: 8,//số lượng tối đa các điểm đánh dấu (ticks) trên trục .
                            padding: 10 //khoảng cách (padding) giữa điểm đánh dấu và các giá trị ghi trên trục.
                        },
                        gridLines: {
                            color: "rgb(234, 236, 244)", // màu sắc của các đường lưới trên trục y.
                            zeroLineColor: "rgb(234, 236, 244)", //màu sắc của đường lưới tại điểm giá trị bằng 0 trên trục y.
                            borderDash: [2], //kiểu đường kẻ của các đường lưới trên trục y.
                        }
                    }],
                    plugins: {
                        title: {
                            display: true,
                            text: "title", // tiêu đề biểu đồ
                            // font: {
                            //     size: 16 // kích thước chữ tiêu đề
                            // },
                            // padding: {
                            //     bottom: 20 // khoảng cách từ tiêu đề đến biểu đồ
                            // }
                        }
                    }
                },
            }
        });
    }
})