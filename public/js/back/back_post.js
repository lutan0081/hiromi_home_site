 $(function() {
    // ページネーション：センター表示
    $(".pagination").addClass("justify-content-center");
    $("#links").show();

    /**
     * ダブルクリックの処理
     */
    $(".click_class").on('dblclick', function(e) {
        console.log("ダブルクリックの処理.");

        // ローディング画面
        $("#overlay").fadeIn(300);

        // tdのidを配列に分解
        var id = $(this).attr("id");

        // 文字列をアンダーバーで分割
        id = id.split('_')[1];
        console.log(id);

        setTimeout(function(){
            $("#overlay").fadeOut(300);
        },500);

        // idをパラメーターでControllerに渡す
        location.href = "backRealEstateEditInit?real_estate_id=" + id;
    });
});