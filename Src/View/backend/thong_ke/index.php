<style>
    .chart-container {
        width: 100% !important;
        height: 500px;
    }
    .__title {
        margin-top: 50px;
    }
</style>
<h1 class="text-center __title"><b>THỐNG KÊ</b></h1>
<?php
$now = $data['turnover']['now'];
$different = [
    'tong_tien' => ($now[0]['tong_tien'] - $now[1]['tong_tien']) / $now[1]['tong_tien'] * 100,
    'so_luong_dat' => $now[0]['so_luong_dat'] - $now[1]['so_luong_dat'],
];
?>
<h1 style="text-transform: uppercase;"><b><?= $now[0]['thang'] ?></b></h1>
<h3>Doanh thu: <?= number_format($now[0]['tong_tien'])?>đ <sup style="color:<?= $different['tong_tien'] >= 0 ? '#0fd924' : '#e30909' ?>">(<?= $different['tong_tien'] >= 0 ? '+' : '' ?><?= number_format($different['tong_tien'], 1) ?>%)</sup></h3>
<h3>Số lượng đặt: <?= $now[0]['so_luong_dat'] ?> khách <sup style="color:<?= $different['so_luong_dat'] >= 0 ? '#0fd924' : '#e30909' ?>">(<?= $different['so_luong_dat'] >= 0 ? '+' : '' ?><?= $different['so_luong_dat'] ?> khách)</sup></h3>
<h1 class="__title"><b>BIỂU ĐỒ</b></h1>
<div class="row">
    <div class="col-lg-6">
        <h3 class="text-center">Doanh thu theo tháng</h3>
        <div>
            <canvas id="monthChart" class="chart-container"></canvas>
        </div>
    </div>
    <div class="col-lg-6">
        <h3 class="text-center">Tour được đặt nhiều nhất</h3>
        <div>
            <canvas id="topBookedTour" class="chart-container"></canvas>
        </div>
    </div>
    <div class="col-lg-6">

    </div>
</div>

<script>
    //Thang
    const data = <?= json_encode($data) ?>;
    const backgroundColors = [
        'rgba(255, 99, 132, 0.2)',
        'rgba(255, 159, 64, 0.2)',
        'rgba(255, 205, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(201, 203, 207, 0.2)'
    ];

    const chartData = {
        turnover: {
            now: {
                keys: data.turnover.now['ngay'],
                values: data.turnover.now['tong_tien'],
            },
            months: {
                keys: data.turnover.months.map((value, index) => {
                    return value['thang']
                }).reverse(),
                values: data.turnover.months.map((value, index) => {
                    return value['tong_tien']
                }).reverse(),
            },
        },
        top: {
            bookedTour: {
                keys: data.top.bookedTour.map((value, index) => {
                    return value['ten_tour']
                }),
                values: data.top.bookedTour.map((value, index) => {
                    return value['so_lan_dat']
                }),
            }
        }
    };

    const monthChartEl = document.getElementById('monthChart').getContext('2d');
    const monthChart = new Chart(monthChartEl, {
        type: 'bar',
        data: {
            labels: chartData.turnover.months.keys,
            datasets: [{
                label: 'Tiền thu',
                data: chartData.turnover.months.values,
                borderWidth: 1,
                backgroundColor: chartData.turnover.months.keys.map(() => backgroundColors[Math.floor(Math.random() * backgroundColors.length)]),
            }],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    //Top tour
    const topBookedTourEl = document.getElementById('topBookedTour').getContext('2d');
    const topBookedTour = new Chart(topBookedTourEl, {
        type: 'bar',
        data: {
            labels: chartData.top.bookedTour.keys,
            datasets: [{
                label: 'Số khách đặt',
                data: chartData.top.bookedTour.values,
                borderWidth: 1,
                backgroundColor: chartData.turnover.months.keys.map(() => backgroundColors[Math.floor(Math.random() * backgroundColors.length)]),
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>