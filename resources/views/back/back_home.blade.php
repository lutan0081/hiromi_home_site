<!DOCTYPE html>
<html lang="ja">

	<head>
		<title>Home/POST</title>

        <!-- css -->
        @component('component.back_head')
        @endcomponent

		<!-- 自作css -->
        <link rel="stylesheet" href="{{ asset('css/back/back_home.css') }}">
		
        <style>
            /* 一覧の左右に余白が出来るため、0に設定 */
            .card-body {
                padding: 0rem;
            }
		</style>
        
	</head>

	<body>
		<!-- page-wrapper -->
		<div class="page-wrapper chiller-theme toggled">
        
            <!-- sidebar-wrapper  -->
            @component('component.back_sidebar')
            @endcomponent
            <!-- sidebar-wrapper  -->
            
            <!-- 以下から記載" -->
            <main class="page-content mb-3">

                <!-- Dashboard -->
                <div class="container">

                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-12">

                            <div class="row">

                                <!-- タイトル -->
                                <div class="col-12 col-md-12 col-lg-12 mb-2">
                                    <div class="info_title mt-3">
                                        <span class="font_bold fs_13r"><i class="bi bi-speedometer2 me-2"></i>Dashboard</span>
                                    </div>
                                </div>

                                <!-- ダッシュボード -->
                                <div class="col-12 col-md-12 col-lg-12 mt-2">
                                    <div class="card dashboard_top_box">
                                        <div class="card-body">

                                            <div class="row">
                                                <div class="col-12 col-md-12 col-lg-12">
                                                    <span class="dashboard_welcome_font">POSTへようこそ！<br></span> 
                                                    <span class="dashboard_welcome_sub_font">初めての方に便利なリンク集めました。</span>
                                                </div>

                                                <div class="col-12 col-md-12 col-lg-4 dashboard_step_box">
                                                    <b>初期設定<br></b>
                                                    <a href="" target="_blank"><i class="bi bi-person-fill me-3"></i>ログインユーザを登録する<br></a>
                                                </div>

                                                <div class="col-12 col-md-12 col-lg-4 dashboard_step_box">
                                                    <b>次のステップ<br></b>
                                                    <a href="backReformNewInit" target="_blank"><i class="bi bi-mailbox me-3"></i>施工事例を登録する<br></a>
                                                    <a href="backPostNewInit" target="_blank"><i class="bi bi-gear-fill me-3"></i>その他を登録する<br></a>
                                                </div>

                                                <div class="col-12 col-md-12 col-lg-4 dashboard_step_box">
                                                    <b>その他の操作<br></b>
                                                    <i class="bi bi-chat-dots me-3"></i>お問い合わせ内容を表示<br>
                                                    <i class="bi bi-pc-display-horizontal me-3"></i>サイトを表示<br>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                
                                <!-- 施工事例の投稿 -->
                                <div class="col-12 col-md-12 col-lg-6 mt-4">
                                    <div class="card reform_top_box">
                                        <div class="card-body">
                                            <div class="row">

                                                <div class="col-12 col-md-12 col-lg-6">
                                                    <span class="font_bold"><i class="bi bi-mailbox me-3"></i>施工事例の投稿<br></span> 
                                                </div>

                                                <div class="col-12 col-md-12 col-lg-6">
                                                    <i class="bi bi-chevron-right float-end"></i>
                                                </div>

                                                <div class="col-12 col-md-12 col-lg-12">
                                                    最近の投稿
                                                </div>

                                                <div class="col-12 col-md-12 col-lg-12">
                                                    <div class="overflow-auto" style="height:10.2rem;">
                                                        <div class="table-responsive">
                                                            <table class="table table-hover table-condensed">
                                                                <!-- テーブルヘッド -->

                                                                <!-- テーブルボディ -->
                                                                <tbody>
                                                                    @foreach($post_list as $post)
                                                                        <tr>
                                                                            <td id="" class="click_class" style="display:none"></td>
                                                                            <td id="" class="click_class">{{ Common::format_date_hy($post->entry_date) }}</td>
                                                                            <td id="" class="click_class">{{ $post->post_title }}</td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>

                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- その他の投稿 -->
                                <div class="col-12 col-md-12 col-lg-6 mt-4">
                                    <div class="card post_top_box">
                                        <div class="card-body">
                                            <div class="row">

                                                <div class="col-12 col-md-12 col-lg-6">
                                                    <span class="font_bold"><i class="bi bi-gear-fill me-3"></i>その他の投稿<br></span> 
                                                </div>

                                                <div class="col-12 col-md-12 col-lg-6">
                                                    <i class="bi bi-chevron-right float-end"></i>
                                                </div>

                                                <div class="col-12 col-md-12 col-lg-12">
                                                    最近の投稿
                                                </div>

                                                <div class="col-12 col-md-12 col-lg-12">
                                                    <div class="overflow-auto" style="height:10.2rem;">
                                                        <div class="table-responsive">
                                                            <table class="table">
                                                                <!-- テーブルボディ -->

                                                                <tbody>
                                                                    @foreach($reform_list as $reform)
                                                                        <tr>
                                                                            <td id="" class="click_class" style="display:none"></td>
                                                                            <td id="" class="click_class">{{ Common::format_date_hy($reform->entry_date) }}</td>
                                                                            <td id="" class="click_class">{{ $reform->reform_title }}</td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>

                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- 概要 -->
                                <div class="col-12 col-md-12 col-lg-4 mt-4">
                                    <div class="card summary_top_box">
                                        <div class="card-body">
                                            <div class="row">

                                                <div class="col-12 col-md-12 col-lg-6">
                                                    <span class="font_bold"><i class="bi bi-bell me-3"></i>概要<br></span> 
                                                </div>

                                                <div class="col-12 col-md-12 col-lg-6">
                                                    <i class="bi bi-chevron-right float-end"></i>
                                                </div>

                                                <div class="col-12 col-md-12 col-lg-6">
                                                    投稿件数
                                                </div>

                                                <div class="col-12 col-md-12 col-lg-12 mt-2">
                                                    <i class="bi bi-pin-fill me-2"></i>施工事例の投稿：{{ $reform_count->count_reform_id }}件<br>
                                                    <i class="bi bi-pin-fill me-2"></i>その他の投稿：{{ $post_count->count_post_id }}件<br>
                                                </div>

                                                <div class="col-12 col-md-12 col-lg-6 mt-3">
                                                    サイト累計情報
                                                </div>

                                                <div class="col-12 col-md-12 col-lg-12 mt-2">
                                                    <i class="bi bi-pin-fill me-2"></i>累計PVの件数：{{ $post_count->count_post_id }}pv<br>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- サイト累計情報 -->
                                <div class="col-12 col-md-12 col-lg-8 my-4">
                                    <div class="card cart_top_box">
                                        <div class="card-body">
                                            <div class="row">

                                                <div class="col-12 col-md-12 col-lg-12">
                                                    <span class="font_bold"><i class="bi bi-pc-display-horizontal me-3"></i>サイト累計情報<br></span>
                                                    <canvas id="myChart"></canvas>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>



                            </div>
                            
                        </div>
                    </div>

                </div>

            </main>

		</div>
		<!-- page-wrapper -->
        
        <!-- 自作js -->
        @component('component.back_js')
        @endcomponent


        <!-- グラフjs -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <script>
            const ctx = document.getElementById('myChart');
            const myChart = new Chart(ctx, {
                type: 'bar',
                data: {

                    // 年月データ
                    labels: [
                        @foreach($access_count as $value)
                            '{{ $value->format_entry_date }}',
                        @endforeach
                    ],

                    // 売上数値
                    datasets: [{
                        label: 'PV数',
                        data: [
                            @foreach($access_count as $value)
                                '{{ $value->row_count }}',
                            @endforeach
                        ],

                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(255, 205, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(201, 203, 207, 0.2)'
                        ],
                            
                        borderColor: [
                            'rgb(255, 99, 132)',
                            'rgb(255, 159, 64)',
                            'rgb(255, 205, 86)',
                            'rgb(75, 192, 192)',
                            'rgb(54, 162, 235)',
                            'rgb(153, 102, 255)',
                            'rgb(201, 203, 207)'
                        ],

                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        x: {
                            display: true,
                            title: {
                                display: true,
                                text: '年月日'
                            },
                        },
                        y: {
                            display: true,
                            title: {
                                display: true,
                                text: '件数'
                            },
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
		
	</body>
	
</html>