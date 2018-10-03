<?php
session_start();
//include_once "module/ModuleVideoInfo.php";
include_once "module/ModuleMemberInfo.php";
//include_once "database/mem_info_open.php";
//include_once "database/video_open.php";
//include_once "module/ModuleSearch.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>CanWOW</title>
    <?php include_once "common/web_header.php"; ?>
    <link rel="stylesheet" href="libs/css/design_videopage.css">
</head>
<script>
    window.onload = function () {

        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            theme: "light2",
            title:{
                text: "個人量表"
            },
            axisX:{
                valueFormatString: "DD MMM",
                crosshair: {
                    enabled: true,
                    snapToDataPoint: true
                }
            },
            axisY: {
                title: "觀看次數",
                crosshair: {
                    enabled: true
                }
            },
            toolTip:{
                shared:true
            },
            legend:{
                cursor:"pointer",
                verticalAlign: "bottom",
                horizontalAlign: "left",
                dockInsidePlotArea: true,
                itemclick: toogleDataSeries
            },
            data: [{
                type: "line",
                showInLegend: true,
                name: "個人頁面",
                markerType: "square",
                xValueFormatString: "DD MMM, YYYY",
                color: "#F08080",
                dataPoints: [
                    { x: new Date(2017, 0, 3), y: 650 },
                    { x: new Date(2017, 0, 4), y: 700 },
                    { x: new Date(2017, 0, 5), y: 710 },
                    { x: new Date(2017, 0, 6), y: 658 },
                    { x: new Date(2017, 0, 7), y: 734 },
                    { x: new Date(2017, 0, 8), y: 963 },
                    { x: new Date(2017, 0, 9), y: 847 },
                    { x: new Date(2017, 0, 10), y: 853 },
                    { x: new Date(2017, 0, 11), y: 869 },
                    { x: new Date(2017, 0, 12), y: 943 },
                    { x: new Date(2017, 0, 13), y: 970 },
                    { x: new Date(2017, 0, 14), y: 869 },
                    { x: new Date(2017, 0, 15), y: 890 },
                    { x: new Date(2017, 0, 16), y: 930 }
                ]
            },
                {
                    type: "line",
                    showInLegend: true,
                    name: "影片頻道",
                    lineDashType: "dash",
                    dataPoints: [
                        { x: new Date(2017, 0, 3), y: 510 },
                        { x: new Date(2017, 0, 4), y: 560 },
                        { x: new Date(2017, 0, 5), y: 540 },
                        { x: new Date(2017, 0, 6), y: 558 },
                        { x: new Date(2017, 0, 7), y: 544 },
                        { x: new Date(2017, 0, 8), y: 693 },
                        { x: new Date(2017, 0, 9), y: 657 },
                        { x: new Date(2017, 0, 10), y: 663 },
                        { x: new Date(2017, 0, 11), y: 639 },
                        { x: new Date(2017, 0, 12), y: 673 },
                        { x: new Date(2017, 0, 13), y: 660 },
                        { x: new Date(2017, 0, 14), y: 562 },
                        { x: new Date(2017, 0, 15), y: 643 },
                        { x: new Date(2017, 0, 16), y: 570 }
                    ]
                }]
        });
        chart.render();

        function toogleDataSeries(e){
            if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                e.dataSeries.visible = false;
            } else{
                e.dataSeries.visible = true;
            }
            chart.render();
        }

    }
</script>
<body>
<!--登入頁面-->
<?php include_once "content_verification.php"; ?>
<!--導覽列-->
<?php include_once "common/nav_top.php"; ?>
<!--工具列-->
<?php include_once "common/nav_left.php"; ?>
<!--影片頁面主內容-->
<div id="main-area-member">
    <?php include_once "content_member.php" ?>
</div>
</body>
<!--網站頁尾-->
<?php include_once "common/web_footer.php"; ?>
<?php //include_once "js_For_Video_Play.php"; ?>
</html>