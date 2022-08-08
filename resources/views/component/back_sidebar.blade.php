<a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
<i class="fas fa-bars"></i>
</a>

<!-- sidebar-wrapper  -->
<nav id="sidebar" class="sidebar-wrapper">

    <!-- sidebar-content(中断)  -->
    <div class="sidebar-content">

        <!-- サイドメニュータイトル -->
        <div class="sidebar-brand">
            <a href="#">POST Ver 1.00</a>
            <div id="close-sidebar">
                <i class="fas fa-times"></i>
            </div>
        </div>
        <!-- サイドメニュータイトル -->

        <div class="sidebar-header">

            <div class="user-info">

                <span class="user-name">
                    <i class="bi bi-person-fill me-1"></i>{{ Session::get('create_user_name') }}
                </span>

                <span class="user-role">
                    {{ Session::get('permission_type_name') }}
                </span>

                <span class="user-status">
                    <i class="fa fa-circle"></i>
                    <span>Online</span>
                </span>
                
            </div>

        </div>
        <!-- sidebar-header  -->


        <!-- sidebar-menu  -->
        <div class="sidebar-menu">
            <!-- 親要素ul -->
            <ul>
                <!-- home -->
                <li>
                    <a href="backHomeInit">
                        <i class="fas bi bi-house-fill"></i>
                        <span>Home</span>
                    </a>
                </li>

                <!-- 投稿 -->
                <li class="sidebar-dropdown">
                    <a href="#">
                        <i class="fas fa-thumbtack"></i>           
                        <span>投稿</span>
                    </a>
                    <div class="sidebar-submenu">
                        <ul>
                            <li>
                                <a href="">施工事例</a>
                            </li>
                            <li>
                                <a href="backPostInit">その他</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- 設定 -->
                <li class="sidebar-dropdown">
                    <a href="#">
                        <i class="fas fa-cog"></i>         
                        <span>設定</span>
                    </a>
                    <div class="sidebar-submenu">
                        <ul>
                            <li>
                                <a href="backProfitInit">ユーザ</a>
                            </li>
                        </ul>
                    </div>
                </li>

            </ul>
            <!-- 親要素ul -->
        </div>
        <!-- sidebar-menu  -->

    </div>

    <!-- sidebar-content(下段)  -->
    <div class="sidebar-footer">

        <!-- お知らせ -->
        <a href="#">
            <i class="fa fa-bell"></i>
            <span class="position-absolute top-0 start-90 badge rounded-pill bg-warning text-dark">3</span>
        </a>

        <!-- メッセージ -->
        <a href="#">
            <i class="fa fa-envelope"></i>
            <span class="position-absolute top-0 start-90 badge rounded-pill bg-success">7</span>
        </a>

        <!-- 設定 -->
        <a href="#">
            <i class="fa fa-cog"></i>
            <span class="badge-sonar"></span>
        </a>

        <!-- ログアウト -->
        <a href="logOut">
            <i class="fa fa-power-off"></i>
        </a>

    </div>

</nav>
<!-- sidebar-wrapper  -->