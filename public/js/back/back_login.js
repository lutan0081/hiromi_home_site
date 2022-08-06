// ログインの処理
 $(function() {
    $("#btn_login").on('click', function(e) {

        console.log('btn_loginの処理');

        e.preventDefault();
        
        // メールアドレス
        let create_user_mail = $("#create_user_mail").val();

        // パスワード
        let create_user_password = $("#create_user_password").val();

        // 送信用データ設定
        let sendData = {
            "create_user_mail": create_user_mail,
            "create_user_password": create_user_password,
        };

        console.log(sendData);
        
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        });

        $.ajax({
            
            type: 'post',
            url: 'backLoginEntry',
            dataType: 'json',
            data: sendData,
        
        // 接続が出来た場合の処理
        }).done(function(data) {

            // trueの場合ログイン
            console.log(data.status);

            // status = trueの場合、一般画面に遷移
            if(data.status == true){

                location.href = 'backHomeInit';
                return false;

            }else{

                // falseの処理
                $('.msg').addClass('error_text');
                $('.msg').text('E-mailまたはPasswordが正しくありません。').show();
                $('.box_container').addClass('error_box_container');

            }
            
        // ajax接続が出来なかった場合の処理
        }).fail(function(jqXHR, textStatus, errorThrown) {
            
            console.log(jqXHR);
            console.log(textStatus);
            console.log(errorThrown);
        });
        
    });
});