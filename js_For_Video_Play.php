
<script>

    //--------------網頁(body)加載時會做的動作-----------------
    window.onload = function () {

        var chart = new CanvasJS.Chart("chartContainer", {
            theme: "dark2",
            exportFileName: "Doughnut Chart",
            exportEnabled: true,
            animationEnabled: true,
            title:{
                text: "Monthly Expense"
            },
            legend:{
                cursor: "pointer",
                itemclick: explodePie
            },
            data: [{
                type: "doughnut",
                innerRadius: 90,
                showInLegend: true,
                toolTipContent: "<b>{name}</b>: ${y} (#percent%)",
                indexLabel: "{name} - #percent%",
                dataPoints: [
                    { y: 450, name: "Food" },
                    { y: 120, name: "Insurance" },
                    { y: 300, name: "Travelling" },
                    { y: 800, name: "Housing" },
                    { y: 150, name: "Education" },
                    { y: 150, name: "Shopping"},
                    { y: 250, name: "Others" }
                ]
            }]
        });
        chart.render();

        function explodePie (e) {
            if(typeof (e.dataSeries.dataPoints[e.dataPointIndex].exploded) === "undefined" || !e.dataSeries.dataPoints[e.dataPointIndex].exploded) {
                e.dataSeries.dataPoints[e.dataPointIndex].exploded = true;
            } else {
                e.dataSeries.dataPoints[e.dataPointIndex].exploded = false;
            }
            e.chart.render();
        }
        Chart_showGood();
    }

    //------------------計算觀看演算法--------------------------

    var dur_time = 0;
    var Watch_rate_check = 0;
    var count = 0;
    var video_id = '<?php echo $_GET['v']; ?>';
    var video = document.getElementById(video_id);
    //console.log("耶耶:" + video);
    setInterval(
        function () {
            if (video.paused) {
            }
            if (!video.paused) {
                dur_time++;
            }
            if ((dur_time / video.duration) >= 0.05) {
                Watch_rate_check = 1;
                count++;
            }
            if (Watch_rate_check && count === 1) {
                $.ajax({
                    url: 'addVideo_Watch_Num.php',
                    dataType: "json",
                    async: false,
                    type: 'POST',
                    data: {Video_ID: video.id},
                    error: function () {
                        console.log('Ajax request 發生錯誤d');
                    },
                    success: function (result) {
                        if (result === 1) {
                            console.log('新增觀看次數成功!!');
                        }
                        if (result === 0) {
                            console.log('新增觀看次數失敗!!');
                        }
                    }
                });
            }
            Show();
        }, 1000);

    //顯示影片資訊已播放時間
    function Show() {
        console.log('dur: ' + dur_time + ' all: ' + video.duration + ' rate: ' + (dur_time / video.duration) + ' rate_check: ' + Watch_rate_check + ' video_id: ' + video.id);
    }

    //----------------使用者觀看紀錄--------------------------
    jQuery(window).bind('beforeunload', function (e) {
        if (dur_time > 0) {
            var video_id = '<?php echo $_GET['v']; ?>';
            var Email = '<?php if (isset($_SESSION['member']['Email'])) {
                echo $_SESSION['member']['Email'];
            } else {
                echo "Visitor";
            }?>';
            var query = null;
            <?php
            if(isset($_POST['Query'])){
            ?>
            query = '<?php echo $_POST['Query'];?>';
            <?php
            }
            ?>
            $.ajax({
                url: 'Add_Watch_Record.php',    //新增會員的觀看紀錄以及更新影片的觀看總時數
                dataType: "json",
                async: false,
                type: 'POST',
                data: {Video_ID: video_id, Email: Email, Duration: dur_time, Query: query},
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.responseText);
                },
                success: function (result) {
                    if (result === 1) {
                    }
                    if (result === 0) {
                    }
                }
            });
        }
    });

    //---------------評價功能---------------------
    function feeling(feel_type) {
        var video_id = '<?php echo $_GET['v']; ?>';
        //alert(video_id+feel_type);
        $.ajax({
            url: 'Modify_Video_Feeling.php',
            dataType: "json",
            async: false,
            type: 'POST',
            data: {Video_ID: video_id, Fell_type: feel_type},
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.responseText);
            },
            success: function (result) {
                if (result === 1) {
                    alert('修改評價成功!!');
                }
                if (result === 0) {
                    alert('修改評價失敗!!');
                }
            }
        });
    }

    //---------------結束 評價功能-------------------
    //--------------下拉選單功能---------------------
    function Build_List(id) {
        var x = document.getElementById(id);
        if (x.className.indexOf("w3-show") == -1) {
            x.className += " w3-show";
        } else {
            x.className = x.className.replace(" w3-show", "");
        }
        /*document.getElementById("Build_But").style.visibility='hidden';*/
    }

    //-----------結束下拉選單功能---------------------

    //----------------簡介按鈕------------------------
    function Tabs(evt, IDName) {
        var i, x, tablinks;
        x = document.getElementsByClassName("info-text-box");
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablink");
        for (i = 0; i < x.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" w3-border-black", "");
        }
        document.getElementById(IDName).style.display = "block";
        evt.currentTarget.firstElementChild.className += " w3-border-black";
    }

    //--------------簡介按鈕結束-----------------------

    //----------------新增按鈕------------------------
    function List(IDName) {
        var i;
        var x = document.getElementsByClassName("list");
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
        }
        document.getElementById(IDName).style.display = "block";
    }

    //--------------新增清單按鈕結束-----------------------

    //--------------查看回覆按鈕---------------
    function ReplyButt(butt,Reply_IDName) {
        var x = document.getElementById(Reply_IDName);
        var but = document.getElementById(butt);
        if (x.style.display === "none") {
            x.style.display = "block";
            but.innerText = "隱藏回覆";
        } else {
            x.style.display = "none";
            but.innerText = "查看回覆";
        }
    }

    //-------------查看回覆按鈕結束------------

    //-------------Chart(影片右邊那塊): 商品-------------
    var good_index = 0;
    var max_good_num_per_time = 5;

    function Chart_showGood() {
//        document.getElementById('chartContainer').innerHTML = '<ul id="goodContainer" class="w3-card"></ul>';   //顯示商品圖區;
        document.getElementById('next_or_pre_page_bottom').innerHTML = '<button id="pre_page" class="w3-bar-item w3-button w3-mobile" style="display: none" onclick="pre_goodpage()">上一頁</button>\n' +
            '                    <button id="next_page" class="w3-bar-item w3-button w3-mobile w3-right" onclick="next_goodpage()">下一頁</button>'; //顯示商品按鈕
        if (good_index) {
            document.getElementById("pre_page").style.display = 'block';
        }
        $.ajax({
            url: "Video_Play/goods_page.php",
            dataType: "json",
            type: "POST",
            data: {Video_ID: video_id, Index: good_index, Max_Num: max_good_num_per_time},
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.responseText);
                //console.log(thrownError.value());
            },
            success: function (Good) {
                for (var i = 0; i < Good.length; i++) {
                    if (Good[i]['Good_Count'] === "ao6xk7") {     //判斷是否沒商品了
                        console.log('沒商品了');
                        document.getElementById("next_page").style.display = 'none';
                        break;
                    } else {
                        $("#goodContainer").append('<li class="w3-bar" style="cursor: pointer;" title="' + Good[i]['Good_Name'] + '"\n' +
                            '                            onclick="clickAD(\'' + Good[i]['Ad_ID'] + '\',\'' + Good[i]['url'] + '\')">\n' +
                            '                            <img src="source/image/good_img/' + Good[i]['Good_ID'] + '.jpg" class="w3-bar-item w3-hide-small"\n' +
                            '                                 style="width:30%">\n' +
                            '                            <div id="good_container" class="w3-bar-item ellipsis"\n' +
                            '                                 style="width: 70%;">\n' +
                            '                                <span class="">' + Good[i]['Good_Name'] + '</span><br>\n' +
                            '                                <span><i class="material-icons" style="font-size: 20px">attach_money</i>' + Good[i]['Good_Price'] + '元</span>\n' +
                            '                                <span class="w3-right">' + Good[i]['Clickthrough'] + '人點擊</span>\n' +
                            '                                <br>\n' +
                            '                                <span class="">賣家: ' + Good[i]['First_name'] + '</span>\n' +
                            '                                &nbsp;\n' +
                            '                                <span>已售:' + Good[i]['Good_Buy'] + '</span>\n' +
                            '                                &nbsp;\n' +
                            '                                <span>庫存:' + Good[i]['Good_Count'] + '</span>\n' +
                            '                            </div>\n' +
                            '                        </li>');
                    }
                }
            }
        });
    }

    function clickAD(AD_ID, url) {
        $.ajax({
            url: 'Video_Play/clickAD.php',
            dataType: "json",
            async: false,
            type: 'POST',
            data: {
                AD_ID: AD_ID <?php if (isset($_SESSION['member']['Email'])) {
                    echo ',Member: "' . $_SESSION['member']['Email'] . '"';
                }?>},
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.responseText);
            },
            success: function (result) {
                if (result === 1) {
                    alert('新增廣告點擊成功!!');
                    window.location = url;
                }
                if (result === 0) {
                    alert('新增廣告點擊失敗!!');
                }
            }
        });
    }

    function next_goodpage() {
        good_index = good_index + max_good_num_per_time;
        Chart_showGood();
        document.getElementById("pre_page").style.display = 'block';
        console.log("good_index" + good_index);
        console.log("顯示第" + good_index + "~" + (good_index + (max_good_num_per_time - 1)) + "筆商品");
    }

    function pre_goodpage() {
        good_index = good_index - max_good_num_per_time;
        Chart_showGood();
        document.getElementById("next_page").style.display = 'block';
        if (!good_index) {
            console.log("已經是第一頁咯!!");
            document.getElementById("pre_page").style.display = 'none';
        }
        console.log("good_index" + good_index);
        console.log("顯示第" + good_index + "~" + (good_index + (max_good_num_per_time - 1)) + "筆商品");
    }

    //----------------Chart(影片右邊那塊): 商品OR影片介紹-----------------
    function Chart_showGoodInfo() {
        document.getElementById('chartContainer').innerHTML = '<ul id="goodContainer" class="w3-card"></ul>';   //顯示商品圖區;
    }

    //----------------Chart(影片右邊那塊): 統計圖表-----------------
    function Chart_showStatistics() {
        document.getElementById('chartContainer').innerHTML = '<ul id="goodContainer" class="w3-card"></ul>';   //顯示商品圖區;
    }
</script>