/**
 * 初回ローディングのアニメーション
 */
$(window).on('load',function(){
    $("#splash").delay(1500).fadeOut('slow',function(){//ローディングエリア（splashエリア）を1.5秒でフェードアウトする記述
        $('body').addClass('appear');//フェードアウト後bodyにappearクラス付与
        var h = $(window).height();//ブラウザの高さを取得
        $(".splashbg").css({
            "border-width":h,//ボーダーの太さにブラウザの高さを代入
            "animation-name":"backBoxAnime"//animation-nameを定義
        }); 
    });
    $("#splash-logo").delay(1200).fadeOut('slow');//ロゴを1.2秒でフェードアウトする記述
});

/**
 * 文字をスライド表示：英語
 */
function slideAnime(){
    // 左に動くアニメーションここから
    $('.leftAnime').each(function(){ 
        var elemPos = $(this).offset().top-50;
        var scroll = $(window).scrollTop();
        var windowHeight = $(window).height();
        if (scroll >= elemPos - windowHeight){
            //左から右へ表示するクラスを付与
            //テキスト要素を挟む親要素（左側）とテキスト要素を元位置でアニメーションをおこなう
            $(this).addClass("slideAnimeLeftRight"); //要素を左枠外にへ移動しCSSアニメーションで左から元の位置に移動
            $(this).children(".leftAnimeInner").addClass("slideAnimeRightLeft");  //子要素は親要素のアニメーションに影響されないように逆の指定をし元の位置をキープするアニメーションをおこなう
        }else{
            //左から右へ表示するクラスを取り除く
            $(this).removeClass("slideAnimeLeftRight");
            $(this).children(".leftAnimeInner").removeClass("slideAnimeRightLeft");
            
        }
    });
}

// 文字をスライド表示:画面をスクロールをしたら動かしたい場合の記述
$(window).scroll(function (){
    slideAnime();/* アニメーション用の関数を呼ぶ*/
});// ここまで画面をスクロールをしたら動かしたい場合の記述

// 文字をスライド表示:2.5秒後に表示
$(window).on('load', function(){
    setInterval(function(){
        slideAnime();
    },2500);
});

/**
 * 文字をスライド表示：日本語
 */
 function slideAnime_jp(){
    // 左に動くアニメーションここから
    $('.leftAnime_jp').each(function(){ 
        var elemPos = $(this).offset().top-50;
        var scroll = $(window).scrollTop();
        var windowHeight = $(window).height();
        if (scroll >= elemPos - windowHeight){
            //左から右へ表示するクラスを付与
            //テキスト要素を挟む親要素（左側）とテキスト要素を元位置でアニメーションをおこなう
            $(this).addClass("slideAnimeLeftRight_jp"); //要素を左枠外にへ移動しCSSアニメーションで左から元の位置に移動
            $(this).children(".leftAnimeInner").addClass("slideAnimeRightLeft_jp");  //子要素は親要素のアニメーションに影響されないように逆の指定をし元の位置をキープするアニメーションをおこなう
        }else{
            //左から右へ表示するクラスを取り除く
            $(this).removeClass("slideAnimeLeftRight_jp");
            $(this).children(".leftAnimeInner").removeClass("slideAnimeRightLeft_jp");
        }
    });
}

// 文字をスライド表示:画面をスクロールをしたら動かしたい場合の記述
$(window).scroll(function (){
    slideAnime_jp();/* アニメーション用の関数を呼ぶ*/
});// ここまで画面をスクロールをしたら動かしたい場合の記述

// 文字をスライド表示:2.5秒後に表示
$(window).on('load', function(){
    setInterval(function(){
        slideAnime_jp();
    },2900);
});


