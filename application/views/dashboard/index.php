<style>
    .clearfix::after {
        content: "";
        display: table;
        clear: both;
    }
    .dashboard {
        margin-left: 30px;
        margin-right: 30px;
    }
    .dashboard-container {
        border: #f1f1f1f1 2px solid;
        border-radius: 20px;
        padding: 20px;
        height: 100%;
        width: 100%;
    }
    .dashboard-container .row {
        display: flex;
        justify-content: center;
    }
    #gender {
        margin-top: 50px;
        height: 600px;
        width: 600px;
    }
    #status {
        margin-top: 50px;
        height: 600px;
        width: 600px;
    }
    #recent-login {
        height: 500px;
        width: 900px;
    }
</style>

<div class="dashboard">
    <div class="dashboard-container">
        <h3><?php echo lang('dashboard'); ?></h3>
        <div class="row">
            <div class="col-md-12 col-sm-12" style="text-align: right;">
                <button type="button" id="export-dashboard-pdf" class="btn btn-danger" style="color:#ffffff;"><i class="fas fa-file-export"></i> PDF</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div id="gender"></div>
            </div>
            <!-- <div class="col-md-2"></div> -->
            <div class="col-md-6">
                <div id="status"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12" style="display: flex; justify-content: center;">
                <div id="recent-login"></div>
            </div>
        </div>
    </div>
</div>

<script>
    $('#export-dashboard-pdf').on('click', function(event) {
        // Get size of report page
        var reportPageHeight = $('.dashboard').innerHeight();
        // Get chart and export to base64 encode
        var canvas = document.getElementById('gender');
        canvas = document.getElementById('status');
        canvas = document.getElementById('recent-login');
        var genderDataURL = ($('canvas')[0]).toDataURL("image/png");
        var statusDataURL = ($('canvas')[1]).toDataURL("image/png");
        var recentLoginDataURL = ($('canvas')[2]).toDataURL("image/png");
        // Create and add image to pdf
        var pdf = new jsPDF('portrait', 'pt', [1024, reportPageHeight]);
        pdf.text(37, 50, '<?php echo lang('dashboard'); ?>');
        pdf.addImage(genderDataURL, 'JPEG', 87, 100, 400, 400);
        pdf.addImage(statusDataURL, 'JPEG', 537, 100, 400, 400);
        pdf.addImage(recentLoginDataURL, 'JPEG', 212, 500, 600, 310);
        // Send pdf to client
        pdf.save('Dashboard.pdf');
    });
    
    var genderDom = document.getElementById('gender');
    var statusDom = document.getElementById('status');
    var recentLoginDom = document.getElementById('recent-login');
    var genderChart = echarts.init(genderDom);
    var statusChart = echarts.init(statusDom);
    var recentLoginChart = echarts.init(recentLoginDom);
    var genderOption;
    var statusOption;
    var recentLoginOption;

    genderOption = {
        backgroundColor: '#fff',
        title: {
            text: '<?php echo lang('user_gender'); ?>',
            left: 'center',
            textStyle: {
                fontStyle: 'normal',
            },
        },
        tooltip: {
            trigger: 'item',
        },
        toolbox: {
           feature: {
               saveAsImage : {show: true}
           }
        },
        legend: {
            orient: 'vertical',
            left: 'left',
        },
        series: [
            {
                type: 'pie',
                radius: '50%',
                data: [
                    { value: '<?php echo $male ?>', name: '<?php echo lang('male'); ?>' },
                    { value: '<?php echo $female ?>', name: '<?php echo lang('female'); ?>' },
                ],
                emphasis: {
                    itemStyle: {
                        shadowBlur: 10,
                        shadowOffsetX: 0,
                        shadowColor: 'rgba(0, 0, 0, 0.5)',
                    }
                },
                color: [
                    '#37A2DA',
                    '#fb7293',
                ],
            }
        ],
    }
    genderOption && genderChart.setOption(genderOption);

    statusOption = {
        backgroundColor: '#fff',
        title: {
            text: '<?php echo lang('user_status'); ?>',
            left: 'center',
            textStyle: {
                fontStyle: 'normal',
            },
        },
        tooltip: {
            trigger: 'item',
        },
        toolbox: {
           feature: {
               saveAsImage : {show: true}
           }
        },
        legend: {
            orient: 'vertical',
            left: 'left',
        },
        series: [
            {
                type: 'pie',
                radius: '50%',
                data: [
                    { value: '<?php echo $available ?>', name: '<?php echo lang('available'); ?>' },
                    { value: '<?php echo $unavailable ?>', name: '<?php echo lang('unavailable'); ?>' },
                ],
                emphasis: {
                    itemStyle: {
                        shadowBlur: 10,
                        shadowOffsetX: 0,
                        shadowColor: 'rgba(0, 0, 0, 0.5)',
                    }
                },
                color: [
                    '#FFDB5C',
                    '#8378EA',
                ],
            },
        ],
    }
    statusOption && statusChart.setOption(statusOption);

    recentLoginOption = {
        backgroundColor: '#fff',
        title: {
            text: '<?php echo lang('user_login'); ?>',
            subtext: 'Today: <?php echo date("l, d/m/Y"); ?>',
            left: 'center',
            textStyle: {
                fontStyle: 'normal',
            },
        },
        tooltip: {
            trigger: 'axis',
            axisPointer: {
                type: 'shadow',
            }
        },
        toolbox: {
           feature: {
               saveAsImage : {show: true}
           }
        },
        grid: {
            left: '3%',
            right: '4%',
            bottom: '3%',
            containLabel: true,
        },
        xAxis: [
            {
                name: '<?php echo lang('days'); ?>',
                nameLocation: 'end',
                nameRotate: 270,
                type: 'category',
                data: ['<?php echo lang('recent'); ?>', '2', '3', '4', '5', '6', '7', '8'],
                axisTick: {
                    alignWithLabel: true,
                }
            }
        ],
        yAxis: [
            {
                name: '<?php echo lang('user_amount'); ?>',
                nameLocation: 'end',
                type: 'value',
                axisLine: {
                    show: true,
                }
            }
        ],
        series: [
            {
                name: '',
                type: 'bar',
                barWidth: '60%',
                data: ['<?php echo $recent; ?>', '<?php echo $mon; ?>', '<?php echo $tue; ?>', '<?php echo $wed; ?>', '<?php echo $thu; ?>', '<?php echo $fri; ?>', '<?php echo $sta; ?>', '<?php echo $sun; ?>',],
                color: '#91cc75',
            },
        ],
    }
    recentLoginOption && recentLoginChart.setOption(recentLoginOption);
</script>