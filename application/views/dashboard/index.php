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
    @media (max-width: 1440px) {
        #gender {
            height: 400px;
            width: 400px;
        }
        #status {
            height: 400px;
            width: 400px;
        }
    }
    @media (max-width: 1024px) {
        .dashboard-container .row {
            display: flex;
            justify-content: center;
        }
        #recent-login {
            height: 300px;
            width: 600px;
        }
    }
</style>

<div class="dashboard">
    <div class="dashboard-container">
        <h3><?php echo lang('dashboard'); ?></h3>
        <div class="row">
            <div class="col-md-12" style="text-align: right;">
                <button type="button" id="export-dashboard-pdf" class="btn btn-danger" style="color:#ffffff;"><i class="fas fa-file-export"></i> PDF</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5 col-md-offset-1">
                <div id="gender"></div>
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-5">
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
        var reportPageWidth = $('.dashboard').innerWidth();
        
        // Create a new canvas object that we will populate with all other canvas objects
        var pdfCanvas = $('<canvas />').attr({
            id: "canvaspdf",
            width: reportPageWidth,
            height: reportPageHeight
        });
        
        // Keep track canvas position
        var pdfctx = $(pdfCanvas)[0].getContext('2d');
        var pdfctxX = 150;
        var pdfctxY = 150;
        var buffer = 150;
        
        // For each chart.js chart
        $("canvas").each(function(index) {
            // Get the chart height/width
            var canvasHeight = $(this).innerHeight();
            var canvasWidth = $(this).innerWidth();
            
            // Draw the chart into the new canvas
            pdfctx.drawImage($(this)[0], pdfctxX, pdfctxY, canvasWidth, canvasHeight);
            pdfctxX += canvasWidth + buffer;
            
            // Our report page is in a grid pattern so replicate that in the new canvas
            if (index % 2 === 1) {
                pdfctxX = 150;
                pdfctxY += canvasHeight + buffer;
            }
        });
        
        // Create new pdf and add our new canvas as an image
        var pdf = new jsPDF('portrait', 'pt', [reportPageWidth+100, reportPageHeight+100]);
        pdf.text(50, 50, '<?php echo lang('dashboard'); ?>');
        pdf.addImage($(pdfCanvas)[0], 'PNG', 0, 0);
        
        // Download the pdf
        pdf.save('Dashboard.pdf');
    });

    // window.jsPDF = window.jspdf.jsPDF;
    // var docPDF = new jsPDF();
    // $('#export-dashboard-pdf').on('click', function(event) {
    //     var elementHTML = document.querySelector(".dashboard");
    //     docPDF.html(elementHTML, {
    //         callback: function(docPDF) {
    //             docPDF.save('HTML Linuxhint web page.pdf');
    //         },
    //         x: 15,
    //         y: 15,
    //         width: 200,
    //         windowWidth: $('.dashboard').innerWidth(),
    //     });
    // });

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
        // backgroundColor: '#fff',
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
        // backgroundColor: '#fff',
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
        // backgroundColor: '#fff',
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