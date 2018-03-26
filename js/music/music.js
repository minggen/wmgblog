
if("undefined" == typeof BadApplePlayerCharset){var BadApplePlayerCharset=false;}

if(typeof(jQuery) == 'undefined'){
    console.error('[BadApplePlayerBoot] \u5a0c\u2103\u6e41\u7039\u590e\ue5caJQuery\u951b\ufffd');
}

var BadApplePlayerIsLoaded = (typeof(localStorage.getItem('xlch_player_isload')) !="undefined" ? ((localStorage.getItem('xlch_player_isload')=='True' && parseInt(localStorage.getItem('xlch_player_runningtime'))+10 > Math.round(new Date().getTime()/1000)) ? true : false) : false);

var BadApplePlayerIsLoad = (typeof(BadApplePlayerIsLoad) !="undefined" ? BadApplePlayerIsLoad : !BadApplePlayerIsLoaded);
(function (IsLoad,$){
    if(!IsLoad){
        console.info('[BadApplePlayerBoot] \u9359\u6828\u79f7\u9354\u72ba\u6d47\u93be\ue15f\u6581\u9363\ufffd.\u9358\u71b7\u6d1c\u951b\ufffd'+(BadApplePlayerIsLoaded ? '\u934f\u6735\u7cac\u6924\u7538\u6f70\u5bb8\u63d2\u59de\u675e\ufffd' : '\u93b5\u5b2a\u59e9\u7ec2\u4f79\ue11b'));
        return false;
    }

    BadApplePlayerIsLoaded=true;
    localStorage.setItem('xlch_player_isload','True');
    setInterval(function (){
        localStorage.setItem('xlch_player_runningtime',Math.round(new Date().getTime()/1000));
    },5000);
    window.onbeforeunload = function() {
        localStorage.setItem('xlch_player_isload','False');
    };

    var BadApplePlayerCode=
        '<div id="BadApplePlayer" class="show">'
        +'	<div class="player">'
        +'		<div class="blur-img">'
        +'			<img class="blur" style="top: 0px; display: inline;">'
        +'		</div>'
        +'		<div class="infos">'
        +'			<div class="songstyle">'
        +'				<i class="fa fa-music"></i>'
        +'				<span class="song"></span>'
        +'			</div>'
        +'			<div class="timestyle">'
        +'				<span class="time">00:00 / 00:00</span>'
        +'				<i class="fa fa-clock-o"></i></div>'
        +'			<div class="artiststyle">'
        +'				<i class="fa fa-user"></i>'
        +'				<span class="artist"></span>'
        +'				<span class="moshi">'
        +'					\u95c5\u5fd4\u6e80\u93be\ue15f\u6581 <i class="fa fa-random current"></i></span>'
        +'			</div>'
        +'			<div class="artiststyle">'
        +'				<i class="fa fa-folder"></i>'
        +'				<span class="artist1"></span>'
        +'				<span class="geci"></span>'
        +'			</div>'
        +'		</div>'
        +'		<div class="control">'
        +'			<i class="playtype fa fa-retweet current" title="\u9352\u56e8\u5d32\u59af\u2033\u7d21"></i>'
        +'			<i class="prev fa fa-backward" title="\u6d93\u5a41\u7af4\u68e3\ufffd"></i>'
        +'			<div class="status">'
        +'				<b>'
        +'					<i class="play fa fa-play" title="\u93be\ue15f\u6581"></i>'
        +'					<i class="pause fa fa-pause" title="\u93c6\u509a\u4ee0"></i>'
        +'				</b>'
        +'			</div>'
        +'			<i class="next fa fa-forward" title="\u6d93\u5b29\u7af4\u68e3\ufffd"></i>'
        +'			<i class="search fa fa-search" title="\u93bc\u6ec5\u50a8\u59dd\u5c7e\u6d38"></i>'
        +'		</div>'
        +'		<div class="bottom">'
        +'			<div class="playprogress">'
        +'				<div class="progressbg">'
        +'					<div class="progressbg1"></div>'
        +'					<div class="progressbg2"></div>'
        +'					<div class="ts"></div>'
        +'				</div>'
        +'			</div>'
        +'			<ul class="bottomright">'
        +'				<li class="ratecontrol">'
        +'					<div class="rate fa fa-play" title="\u93be\ue15f\u6581\u9359\u6a40\u20ac\ufffd"></div>'
        +'					<div class="rateprogress">'
        +'						<div class="progressbg">'
        +'							<div class="progressbg1"></div>'
        +'							<div class="ts"></div>'
        +'						</div>'
        +'					</div>'
        +'				</li>'
        +'				<li class="volumecontrol">'
        +'					<div class="volume fa fa-volume-up" title="\u95ca\u62bd\u567a\u93ba\u0443\u57d7"></div>'
        +'					<div class="volumeprogress">'
        +'						<div class="progressbg">'
        +'							<div class="progressbg1"></div>'
        +'							<div class="ts"></div>'
        +'						</div>'
        +'					</div>'
        +'				</li>'
        +'				<li class="switch-ksclrc" style="display: list-item;"><i title="\u59dd\u5c83\u761d\u5bee\u20ac\u934f\ufffd" class="fa fa-toggle-on"></i></li>'
        +'				<li class="switch-playlist"><i class="fa fa-bars" title="\u93be\ue15f\u6581\u9352\u6944\u3003"></i></li>'
        +'			</ul>'
        +'			<div style="clear:both"></div>'
        +'		</div>'
        +'		<div class="cover"></div>'
        +'	</div>'
        +'	<div class="playlist">'
        +'		<div class="playlist-bd">'
        +'			<div class="album-list">'
        +'				<div class="musicheader"></div>'
        +'				<div class="list"></div>'
        +'			</div>'
        +'			<div class="song-list">'
        +'				<div class="musicheader">'
        +'					<i class="fa fa-angle-right"></i>'
        +'					<span></span>'
        +'				</div>'
        +'				<div class="list">'
        +'					<ul></ul>'
        +'				</div>'
        +'			</div>'
        +'		</div>'
        +'	</div>'
        +'	<div class="switch-player">'
        +'		<i class="fa fa-angle-right" style="margin-top: 20px;"></i>'
        +'	</div>'
        +'	<div class="searchbox"><input type="text" placeholder="\u6748\u64b3\u53c6\u59dd\u5c7e\u589c+\u59dd\u5c7e\u6d38\u935a\u5d85\u82df\u9365\u70b6\u6e85..." /><i title="\u5a13\u546f\u2516\u93bc\u6ec5\u50a8\u93be\ue15f\u6581\u9352\u6944\u3003" class="delsearchlist fa fa-trash"></i><div class="searchlistbox"><ul></ul></div></div>'
        +'</div>'
        +'<div id="BadAppleTips"></div>'
        +'<div id="BadAppleLrc"></div>'
        +'<div id="BadAppleKsc"></div>'
        +'<div class="xlch_pjax_loading_frame">'
        +'	<div class="double-bounce1"></div>'
        +'	<div class="double-bounce2"></div>'
        +'</div>'
        +'<div class="xlch_pjax_loading"></div>';


    var BadApplePlayerAdCode='';

    BadApplePlayerIsSSL=("https:" == document.location.protocol) ? true : false;

    BadApplePlayerDomain_Img=(BadApplePlayerIsSSL ? 'https://img.https.badapple.top/' : 'http://img.badapple.top/');
    BadApplePlayerDomain_Static=(BadApplePlayerIsSSL ? 'https://static.https.badapple.top/' : 'http://static.badapple.top/');
    BadApplePlayerDomain_API=(BadApplePlayerIsSSL ? 'https://api.https.badapple.top/' : 'http://api.badapple.top/');
    BadApplePlayerDomain_WWW='http://www.badapple.top/';

    BadApplePlayerCharset=BadApplePlayerCharset ? BadApplePlayerCharset : document.charset;
    if(BadApplePlayerCharset != 'UTF-8'){
        BadApplePlayerCharset='UTF-8';
        $.ajax({url: BadApplePlayerDomain_Static+'BadApplePlayer/Player.js',dataType:'script',scriptCharset:'utf-8'});
        console.info('[BadApplePlayerBoot] Try to fix the charset.');
        return;
    }

    $("<link>").attr({href: BadApplePlayerDomain_Static+"BadApplePlayer/css/player.css",rel: "stylesheet",type: "text/css"}).appendTo("head");


    $(document).ready(function(){
        //\u9354\u72b2\u53c6DIV
        $('body').append('<div id="XlchPlayer" style="display:none;"></div>');
        //\u9354\u72b2\u53c6\u6d60\uff47\u721c
        $('#XlchPlayer').append(BadApplePlayerCode);
        BadApplePlayerCode=null;

        //\u9354\u72ba\u6d47\u93be\ue15f\u6581\u9363\u3129\u53a4\u7f03\ue1ba\u20ac\u4f79\u74d5\u9357\ufffd
        $.ajax({
            url: BadApplePlayerDomain_API+"/WebConfig2.php?Key="+XlchKey,
            dataType:"script",
            scriptCharset:'utf-8',
            cache: false,
            async: true,
            success: BadApplePlayer_loadPlayerJs,
            error: function(error) {
                console.error('[BadApplePlayerBoot] Load Fail: WebConfig2.php',error);
            }
        });
    });

    function BadApplePlayer_loadPlayerJs(){
        if(typeof($('body').mCustomScrollbar)=='undefined'){
            console.warn('[BadApplePlayerBoot] \u93c8\ue045\ue5c5\u5a34\u5b2a\u57cc scrollbar.js\u9286\u509a\u5f72\u9473\u754c\u6b91\u9358\u71b7\u6d1c\u951b\ufffd');
            console.warn('[BadApplePlayerBoot] 1.\u93be\ue15f\u6581\u9363\u3124\u552c\u942e\u4f7a\u6b91\u6d93\u5b2e\u6f70\u9359\u5825\u5678\u93c2\u677f\u59de\u675e\u6212\u7c21\u6d93\u20ac\u95ac\u5cbcQuery,\u7035\u8270\u56a7\u7f01\u52ea\u6b22\u5a09\u3125\u553d\u9428\u51e7query\u9351\u82a5\u669f\u741a\ue0a3\u7afb\u7ecc\ufffd');
            console.warn('[BadApplePlayerBoot] \u7459\uff45\u5585\u9354\u70b4\u7876\u951b\ufffd');
            console.warn('[BadApplePlayerBoot] 1.\u704f\u6fca\u762f\u93cc\u30e7\u6e45\u7f03\u6226\u3009\u5a67\u612a\u552c\u942e\u4f8a\u7d1d\u93bc\u6ec5\u50a8"jquery"\u951b\u5c7e\u7161\u942a\u5b2b\u69f8\u935a\ufe3d\u6e41\u6fb6\u6c2b\u91dcjquery\u741a\ue0a2\u59de\u675e\u65a4\u7d1d\u6fe1\u509b\u7049\u93c8\u591b\u7d1d\u7487\u5cf0\u57b9\u95c4\u3088\ue1dajquery\u9286\ufffd');
            console.warn('[BadApplePlayerBoot] 2.\u9354\u72b2\u53c6\u7f01\u6c2b\u9644\u8930\u2544\u6ae3\u7ed4\u6b13\u66b1\u7f07\u308f\u7d1d\u7035\u7ed8\u58d8\u93b6\u20ac\u93c8\ue21a\u5e9c\u9354\u253f\u20ac\ufffd');
            $.ajax({
                url: BadApplePlayerDomain_Static+"BadApplePlayer/js/scrollbar.js",
                dataType:"script",
                cache: true,
                async: false,
                scriptCharset:'utf-8',
                error: function(error) {
                    console.error('[BadApplePlayerBoot] Load Fail: scrollbar.js');
                },
                success: function(data) {
                    console.warn('[BadApplePlayerBoot] \u5bb8\u8e6d\u8d1f\u93ae\u3129\u5678\u93c2\u677f\u59de\u675e\ufffd scrollbar.js');
                }
            });
        }
        if(navigator.userAgent.match(/(iPhone|iPod|Android|ios)/i) && !onphone){
            $('#XlchPlayer').html('');
        }else{
            //\u9354\u72ba\u6d47\u95c4\u52eb\u59deJS
            BadApplePlayer_LoadJs();

            //\u9354\u72ba\u6d47\u93be\ue15f\u6581\u9363\u2197S
            $.ajax({
                url: BadApplePlayerDomain_Static+"BadApplePlayer/js/player.js",
                dataType:"script",
                cache: true,
                async: true,
                scriptCharset:'utf-8',
                success: function(data) {
                    if(typeof($('body').mCustomScrollbar)=='undefined'){
                        console.warn('[BadApplePlayerBoot] \u93be\ue15f\u6581\u9363\u3127\u6571\u6d5c\u5ea4\ue1f0\u9359\u6826\u7b09\u9352\u626e\u7c8d\u6d60\ufffd scrollbar.js \u7035\u8270\u56a7\u5b95\u2542\u7c1d');
                        setTimeout(function (){
                            BadAppleTips.show('\u93be\ue15f\u6581\u9363\u3125\u5f72\u9473\u85c9\u51e1\u7f01\u5fd3\u7a7f\u5a67\u51bf\u7d1d\u7487\u950b\u5bdcF12\u9352\u56e8\u5d32\u9352\u7651S\u93ba\u0443\u57d7\u9359\ufffd(Console)\u93cc\u30e7\u6e45\u9286\ufffd');
                        },5000);
                    }
                    if(typeof(cnzz_protocol) != "undefined"){
                        //\u9422\u3124\u7c21\u6748\uff49\u6d6eCNZZ
                        console.warn('[BadApplePlayerBoot] \u7eef\u8364\u7cba\u59ab\u20ac\u5a34\u5b2a\u57cc\u93ae\u3125\u7568\u7441\u546c\u7c21\u9368\u51a8\u6e87\u7f01\u71bb\ue178\u93bb\u638d\u6b22CNZZ\u951b\u5c83\ue1da\u93bb\u638d\u6b22\u9422\u53d8\u7c2c\u7f02\u6827\u5553\u93b6\u20ac\u93c8\ue219\u6c49\u935b\u6a3c\u6b91\u9424\u5fd3\u62f7\u951b\u5c7e\u7147\u6d5c\u6d99\u510f\u9350\u5178\u7b05\u6d7c\u6c33\ue1e4\u95b2\u5d86\u67ca\u9354\u72ba\u6d47JQuery\u951b\u5c7d\u76a2\u6d7c\u6c2c\ue1f1\u9477\u5b58\u7147\u6d5c\u6d97\u7df7\u74a7\u6826\u7c2cJQuery\u9428\u522fs\u7eeb\u8bf2\u7c31\u6fb6\u8fa8\u6665\u951b\u5c7d\u82df\u7035\u8270\u56a7\u93be\ue15f\u6581\u9363\u3125\u7a7f\u5a67\u51bf\u7d1d\u5be4\u9e3f\ue185\u93ae\u3124\u5a07\u9422\u3127\u6ae8\u6434\ufe3e\u7cba\u7481\u2103\u57a8\u704f\u55da\ue1da\u7f01\u71bb\ue178\u6d60\uff47\u721c\u7ec9\u8bf2\u59e9\u9352\u7248\u6331\u93c0\u60e7\u6ad2\u6d60\uff47\u721c\u9428\u52ea\u7b05\u95c8\ue76e\u7d1d\u6d60\u30e5\u53a4\u9350\u832c\u734a\u951b\ufffd');
                        console.warn('[BadApplePlayerBoot] \u9366\u3128\u7e56\u95b2\u5c80\ue756\u93c5\ue1bb\u7af4\u6d93\u5b36\u7d30\u6769\u6b11\u5e3a\u93b0\u5fd3\u6c28\u93c4\ue219\u91dc\u6434\u71ba\u58bf\u951b\u5c7d\u5691\u9427\u60e7\u52feui\u6d93\u5d86\u6d3f\u93c2\u5e2e\u7d1d\u9354\u72b2\u7b8d\u935b\u5a42\u20ac\u6393\u69f8\u93b8\u8679\u041d\u93cb\u4f8a\u7d1d\u93c8\u5d85\u59df\u9363\u3128\u7e55\u7f01\u5fd3\u7236boom\u951b\u5c7d\u7d11\u9359\u621c\u6c49\u935b\u6a39\u7b09\u6d93\u64b2\u7b1f\u9286\ufffd');
                    }
                    $('#XlchPlayer').show();
                },
                error: function(error) {
                    console.error('[BadApplePlayerBoot] Load Fail: player.js',error);
                }
            });
        }
    }

    var $isAD=false;
    var isClose=false;
    var date=new Date();
    var today=(date.getMonth()+1)+'-'+date.getDate();

    function BadApplePlayer_LoadJs(){
        BadApplePlayer_LoadDrag();
        BadApplePlayer_LoadBaiduTongji();
        BadApplePlayer_AD(false);
        BadApplePlayer_Check();
    }
    function BadApplePlayer_Check(){
        setTimeout(function (){
            if($isAD && localStorage.getItem('xlch_player_addate') != today && isClose != true && (
                    !$('#BadApplePlayer_Ad').is(':visible') ||
                    $('#BadApplePlayer_Ad').css('opacity') != '1' ||
                    $('#BadApplePlayer_Ad').height() != 300 ||
                    $('#BadApplePlayer_Ad').width() != 300 ||
                    $('#BadApplePlayer_Ad').css('bottom') != '0px' ||
                    $('#BadApplePlayer_Ad').css('right') != '0px' ||
                    $('#BadApplePlayer_Ad').css('visibility') == 'collapse' ||
                    $('#BadApplePlayer_Ad').css('visibility') == 'hidden'
                )){
                BadApplePlayer_AdUrl='http://www.badapple.top/';
                BadApplePlayer_AdImg='http://img.badapple.top/Xlch/AD/prpr.png';

                $('#BadApplePlayer_Ad').remove();
                BadApplePlayer_AD(true);

                $('#BadApplePlayer_Ad').css('opacity','1');
                $('#BadApplePlayer_Ad').height(300);
                $('#BadApplePlayer_Ad').width(300);
                $('#BadApplePlayer_Ad').css('bottom','0px');
                $('#BadApplePlayer_Ad').css('right','0px');
                $('#BadApplePlayer_Ad').css('visibility','initial');
            }
        },5000);
    }
    function BadApplePlayer_AD(e){
        $isAD=BadApplePlayer_IsAd;
        if((BadApplePlayer_IsAd && !navigator.userAgent.match(/(iPhone|iPod|Android|ios)/i)) || e){ //\u93b5\u5b2b\u6e80\u6d93\u5d85\u774d\u7ec0\ufffd
            if(localStorage.getItem('xlch_player_addate') != today){ //\u705e\u66e0\u305a\u9a9e\u57ae\u61a1
                var Tmp_BadApplePlayerAdCode=BadApplePlayerAdCode.replace('{AdURL}',BadApplePlayer_AdUrl).replace('{AdImg}',BadApplePlayer_AdImg);
                $('#XlchPlayer').append(Tmp_BadApplePlayerAdCode);
            }
            $('#BadApplePlayer_Ad_Close').click(function(){
                isClose=true;
                localStorage.setItem('xlch_player_addate',today);
                $('#BadApplePlayer_Ad').hide();
            });
        }else{
            isClose=true;
        }
    }
    function BadApplePlayer_LoadBaiduTongji(){
        var _hmt = _hmt || [];
        (function() {
            var hm = document.createElement("script");
            hm.src = "https://hm.baidu.com/hm.js?e7832a384d37994887357af186b47e63";
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(hm, s);
        })();
    }
    function BadApplePlayer_LoadDrag(){
        jQuery.fn.extend({
            DragClose: function() {
                if (this.length) for (var a in $(this).data("options"))"dragObj" == a && $(this).data("options").dragObj.dostop()
            },
            Drag: function() {
                var a = {
                    dragObj: $(this),
                    parentObj: $(document),
                    callback: null,
                    isPhone: !1,
                    lockX: !1,
                    lockY: !1,
                    maxWidth: 0,
                    maxHeight: 0
                };
                arguments.length && (a = $.extend({}, a, arguments[0]));
                a.dragObj.data("options", a);
                var c = $(this)[0],
                    b = a.dragObj,
                    e = 0,
                    d = 0,
                    g = a.callback;
                "static" == $(this).css("position") && $(this).css("position", "relative");
                var m = 0,
                    n = 0;
                a.isPhone ? (b.__start = function(f) {
                    m = Math.max(a.parentObj.width(), a.maxWidth);
                    n = Math.max(a.parentObj.height(), a.maxHeight);
                    f = event.targetTouches[0];
                    e = f.clientX - c.offsetLeft;
                    d = f.clientY - c.offsetTop;
                    b.on("touchmove", b.__move);
                    b.on("touchend", b.__end);
                    return !1
                }, b.__move = function(f) {
                    touch = event.targetTouches[0];
                    f = touch.clientX - e;
                    var h = touch.clientX - d,
                        k = c.offsetWidth,
                        l = c.offsetHeight;
                    0 > f ? f = 0 : f + k > m && (f = m - k);
                    0 > h ? h = 0 : h + l > n && (h = n - l);
                    a.lockX || (c.style.top = h + "px");
                    a.lockY || (c.style.left = f + "px");
                    g && g(b[0], f, h, k, l);
                    return !1
                }, b.__end = function(a) {
                    b.off("touchmove");
                    b.off("touchend");
                    _flag = !1;
                    d = e = 0;
                    g && g(b[0]);
                    return !1
                }, b.dostart = function() {
                    b.on("touchstart", b.__start)
                }, b.dostop = function() {
                    b.off("touchstart");
                    b.off("touchmove");
                    b.off("touchend")
                }) : (b.__start = function(f) {
                    m = Math.max(a.parentObj.width(), a.maxWidth);
                    n = Math.max(a.parentObj.height(), a.maxHeight);
                    e = f.clientX - c.offsetLeft;
                    d = f.clientY - c.offsetTop;
                    $(document).on("mousemove", b.__move);
                    $(document).on("mouseup", b.__end);
                    b[0].setCapture ? b[0].setCapture() : window.captureEvents && window.captureEvents(Event.MOUSEMOVE | Event.MOUSEUP);
                    f.stopPropagation();
                    f.preventDefault()
                }, b.__move = function(f) {
                    var h = f.clientX - e,
                        k = f.clientY - d,
                        l = c.offsetWidth,
                        p = c.offsetHeight;
                    0 > h ? h = 0 : h + l > m && (h = m - l);
                    0 > k ? k = 0 : k + p > n && (k = n - p);
                    a.lockX || (c.style.top = k + "px");
                    a.lockY || (c.style.left = h + "px");
                    g && g(b[0], h, k, l, p);
                    f.stopPropagation();
                    f.preventDefault()
                }, b.__end = function(a) {
                    b[0].releaseCapture ? b[0].releaseCapture() : window.releaseEvents && window.releaseEvents(Event.MOUSEMOVE | Event.MOUSEUP);
                    $(document).off("mousemove");
                    $(document).off("mouseup");
                    d = e = 0;
                    g && g(b[0]);
                    a.stopPropagation();
                    a.preventDefault()
                }, b.dostart = function() {
                    b.on("mousedown", b.__start)
                }, b.dostop = function() {
                    b.off("mousedown");
                    $(document).off("mousemove");
                    $(document).off("mouseup")
                });
                b.dostart()
            }
        });
    }
})(BadApplePlayerIsLoad,jQuery);