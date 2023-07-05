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
    /* @media (max-width: 1440px) {
        #gender {
            height: 400px;
            width: 400px;
        }
        #status {
            height: 400px;
            width: 400px;
        }
        #recent-login {
            height: 350px;
            width: 650px;
        }
    }
    @media (max-width: 1024px) {
        #recent-login {
            height: 350px;
            width: 650px;
        }
    }
    @media (max-width: 768px) {
        #recent-login {
            height: 300px;
            width: 600px;
        }
    } */
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
    // $('#export-dashboard-pdf').on('click', function(event) {
    //     // Get size of report page
    //     var reportPageHeight = $('.dashboard').innerHeight();
    //     var reportPageWidth = $('.dashboard').innerWidth();
    //     // Create a new canvas object that we will populate with all other canvas objects
    //     var pdfCanvas = $('<canvas />').attr({
    //         id: "canvaspdf",
    //         width: reportPageWidth,
    //         height: reportPageHeight,
    //     });
    //     // Keep track canvas position
    //     // var width = 0;
    //     // var height = 0;
    //     // if ((screen.width === 1440) || (screen.width === 1024)) {
    //     //     width = 100;
    //     //     height = 100;
    //     // } else {
    //     //     width = 50;
    //     //     height = 100;
    //     // }
    //     var pageWidth = 0
    //     var pdfctx = $(pdfCanvas)[0].getContext('2d');
    //     var pdfctxX = 50;
    //     var pdfctxY = 100;
    //     var buffer = 100;
    //     // For each chart.js chart
    //     $("canvas").each(function(index) {
    //         // Get the chart height/width
    //         var canvasHeight = $(this).innerHeight();
    //         var canvasWidth = $(this).innerWidth();
    //         console.log($(this).innerHeight());
    //         // Draw the chart into the new canvas
    //         pdfctx.drawImage($(this)[0], pdfctxX, pdfctxY, canvasWidth, canvasHeight);
    //         pdfctxX += canvasWidth + buffer;
    //         // Our report page is in a grid pattern so replicate that in the new canvas
    //         if (screen.width <= 768) {
    //             pdfctxX = 50;
    //             pdfctxY += canvasHeight + buffer;
    //             if (canvasWidth > pageWidth) {
    //                 pageWidth = canvasWidth;
    //             }
    //         } else if (index % 2 === 1) {
    //             pdfctxX = 50;
    //             pdfctxY += canvasHeight + buffer;
    //             if (canvasWidth > pageWidth) {
    //                 pageWidth = canvasWidth*2;
    //             }
    //         }
    //     });
    //     // Create new pdf and add our new canvas as an image
    //     // pageWidth += 100;
    //     console.log(pageWidth);
    //     var pdf = new jsPDF('portrait', 'pt', [pageWidth, reportPageHeight]);
    //     pdf.text(25, 25, '<?php echo lang('dashboard'); ?>');
    //     pdf.addImage($(pdfCanvas)[0], 'PNG', 0, 0);
        
    //     // Download the pdf
    //     pdf.save('Dashboard.pdf');
    // });
    $('#export-dashboard-pdf').on('click', function(event) {
        // Get size of report page
        var reportPageHeight = $('.dashboard').innerHeight();
        var reportPageWidth = $('.dashboard').innerWidth();
        // Create a new canvas object that we will populate with all other canvas objects
        var pdfCanvas = $('<canvas />').attr({
            id: "canvaspdf",
            width: reportPageWidth,
            height: reportPageHeight,
        });
        var pageWidth = 0
        $("canvas").each(function(index) {
            // Get the chart height/width
            var canvasHeight = $(this).innerHeight();
            var canvasWidth = $(this).innerWidth();
            // Get page width of pdf
            if (screen.width <= 768) {
                if (canvasWidth > pageWidth) {
                    pageWidth = canvasWidth;
                }
            } else if (index % 2 === 1) {
                if (canvasWidth > pageWidth) {
                    pageWidth = canvasWidth*2;
                }
            }
        });
        var canvas = document.getElementById('gender');
        canvas = document.getElementById('status');
        canvas = document.getElementById('recent-login');
        var genderDataURL = ($('canvas')[0]).toDataURL("image/png");
        var statusDataURL = ($('canvas')[1]).toDataURL("image/png");
        var recentLoginDataURL = ($('canvas')[2]).toDataURL("image/png");
        console.log($('canvas').innerHeight());
        var pdf = new jsPDF('portrait', 'pt', [1024, reportPageHeight]);
        pdf.text(25, 25, '<?php echo lang('dashboard'); ?>');
        pdf.addImage(genderDataURL, 'JPEG', 87, 100, 400, 400);
        pdf.addImage(statusDataURL, 'JPEG', 537, 100, 400, 400);
        pdf.addImage(recentLoginDataURL, 'JPEG', 212, 500, 600, 310);
        // if (screen.width <= 768) {
        //     pdf.addImage(genderDataURL, 'JPEG', 50, 50, 150, 150);
        //     pdf.addImage(statusDataURL, 'JPEG', 50, 250, 150, 150);
        //     pdf.addImage(recentLoginDataURL, 'JPEG', 50, 450, 200, 150);
        // } else {
        //     pdf.addImage(genderDataURL, 'JPEG', 50, 50, 150, 150);
        //     pdf.addImage(statusDataURL, 'JPEG', 250, 50, 150, 150);
        //     pdf.addImage(recentLoginDataURL, 'JPEG', 50, 250, 200, 100);
        // }
        
        pdf.save('download.pdf');
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