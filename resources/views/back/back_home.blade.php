<!DOCTYPE html>
<html lang="ja">

	<head>
		<title>Home/POST</title>

        <!-- css -->
        @component('component.back_head')
        @endcomponent

		<!-- 自作css -->
	
		
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

                <!-- 上段検索 -->
                <div class="container">

                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-12 mt-2">

                            <!-- タイトル -->
                            <div class="row">
                                <div class="col-12 col-md-12 col-lg-12 mb-2">
                                    <div class="info_title mt-3">
                                        <i class="bi bi-speedometer2 me-2"></i>Dashboard
                                    </div>
                                    <hr class="bar_blue">
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


		<!-- 自作js -->
		
	</body>
	
</html>