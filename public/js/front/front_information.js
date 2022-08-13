$(function() {
    /**
     * ページネーション：センター表示
     */
    $(".pagination").addClass("justify-content-center");
    $("#links").show();

    /**
     * 一覧ダブルクリックの処理
     */
     $(".click_class").on('click', function(e) {
        console.log("clickの処理.");

        // tdのidを配列に分解
        var id = $(this).attr("id");

        // 文字列をアンダーバーで分割
        id = id.split('_')[1];
        console.log(id);

        // idをパラメーターでControllerに渡す
        location.href = "frontInformationEditInit?post_id=" + id;
    });
});