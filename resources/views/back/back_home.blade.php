<!DOCTYPE html>
<html lang="ja">

	<head>
		<title>管理画面/LUTAN</title>

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

        <!-- css -->
        @component('component.back_head')
        @endcomponent

        <!-- 内容 -->
        <div class="container">
            <div class="row">

                <div class="col-12 col-md-12 col-lg-12">
                    ああああああああああああ
                </div>

            </div>
        </div>

        <!-- js -->
        @component('component.back_js')
        @endcomponent

        <!-- 独自js -->
        <script src="{{ asset('js/front/back_home.js') }}"></script>
    </body>
	
</html>