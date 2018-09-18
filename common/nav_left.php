<!--使用 w3.css 排版-->
<div id="mySidebar">
    <nav class="w3-sidebar w3-white w3-animate-left" style="width: 250px"><br>
        <div class="w3-container w3-row">
            <div class="w3-col s4"></div>
            <div class="w3-col s8 w3-bar">
                <span>Welcome, <strong>Shrek</strong></span><br>
            </div>
        </div>
        <hr>
        <div class="w3-bar-block">
            <a href="../index.php" class="w3-bar-item w3-button w3-padding w3-blue"><span
                        class="glyphicon glyphicon-home"></span>&nbsp;&nbsp;首頁</a>
            <a href="#" class="w3-bar-item w3-button w3-padding"><span class="glyphicon glyphicon-fire"></span>&nbsp;&nbsp;熱門影片</a>
            <a href="#" class="w3-bar-item w3-button w3-padding"><span class="glyphicon glyphicon-pushpin"></span>&nbsp;&nbsp;訂閱影片</a>
            <a href="#" class="w3-bar-item w3-button w3-padding"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;個人頁面</a>
            <a href="#" class="w3-bar-item w3-button w3-padding"><span class="glyphicon glyphicon-time"></span>&nbsp;&nbsp;觀看紀錄</a>
            <a href="" class="w3-bar-item w3-button w3-padding"><span class="glyphicon glyphicon-film"></span>&nbsp;&nbsp;播放清單</span>
            </a>
            <a href="#" class="w3-bar-item w3-button w3-padding"><span class="glyphicon glyphicon-cog"></span>&nbsp;&nbsp;設定</a>
        </div>
    </nav>
</div>
<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer"
     title="close side menu" id="myOverlay"></div>