<div class="container w3-margin-top">

    <ul class="nav nav-tabs">

        <li class="active"><a data-toggle="tab" onclick="To_Classify_Page('3C 科技')">3C 科技</a></li>
        <li><a data-toggle="tab" onclick="To_Classify_Page('運動')">運動</a></li>
        <li><a data-toggle="tab" onclick="To_Classify_Page('食尚')">食尚</a></li>
        <li><a data-toggle="tab" onclick="To_Classify_Page('美妝/保養')">美妝/保養</a></li>
        <li><a data-toggle="tab" onclick="To_Classify_Page('衣飾')">衣飾</a></li>
    </ul>
    <!--因為程式碼風格問題暫時先用GET表單寄送的方式，之後應要改為用ajax-->
    <div class="tab-content">
        <div id="menu" class="tab-pane fade in active">
        </div>
    </div>
</div>

<script>
    var Classify = '3C 科技';
    var Now_Page = 1;
    var Page_Load = 1;

    function To_Classify_Page(C) {
        Classify = C;
        Now_Page = 1; //回到第一頁(因為變成新的分類)了
        Page_Load = 1; //重新開始跑
        document.getElementById('menu').innerHTML = '<div class="w3-container w3-margin-bottom"><h3>' + Classify + '</h3></div>';
        Get_Recommend_Type();
    }

    function Get_Recommend_Type() {
        if (Page_Load) {
            console.log("第" + Now_Page + "頁");
            $.ajax({
                url: 'Get_Recommend_Type.php',
                dataType: "json",
                async: false,
                type: 'GET',
                data: {Page_Num: Now_Page},
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.responseText);
                },
                success: function (Recommend_Type) {
                    var i;
                    for (i = 0; i < Recommend_Type.length; i++) {
                        if (Recommend_Type[i] != 'ao6xk7') {
                            openPage(Recommend_Type[i]);
                        }else {
                            Page_Load = 0;
                        }
                    }
                }
            });
            Now_Page = Now_Page + 1;
        }
    }

    function openPage(Recommend_Type) {
        var Recommend_Info = [];
        Recommend_Info[0] = Classify;
        Recommend_Info[1] = Recommend_Type;
        console.log(Recommend_Info[0] + ',' + Recommend_Info[1]);
        $.ajax({
            url: 'video_list_content.php',
            dataType: "html",
            async: false,
            type: 'GET',
            data: {Recommend_Info: Recommend_Info},
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.responseText);
            },
            success: function (result) {
                $("#menu").append(result);
            }
        });
    }
</script>