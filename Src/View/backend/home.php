<style>
    .dashboard_container {
        margin: 0;
        overflow: hidden;
        height: 101vh;
    }

    .dashboard_selector {
        position: absolute;
        left: 50%;
        top: 50%;
        width: 140px;
        height: 140px;
        margin-top: -70px;
        margin-left: -70px;
    }

    .dashboard_selector,
    .dashboard_selector button {
        font-family: 'Oswald', sans-serif;
        font-weight: 300;
    }

    .dashboard_selector button {
        position: relative;
        width: 100%;
        height: 100%;
        padding: 10px;
        background: #428bca;
        border-radius: 50%;
        border: 0;
        color: white;
        font-size: 20px;
        cursor: pointer;
        box-shadow: 0 3px 3px rgba(0, 0, 0, 0.1);
        transition: all .1s;
    }

    .dashboard_selector button:hover {
        background: #3071a9;
    }

    .dashboard_selector button:focus {
        outline: none;
    }

    .dashboard_selector ul {
        position: absolute;
        list-style: none;
        padding: 0;
        margin: 0;
        top: -20px;
        right: -20px;
        bottom: -20px;
        left: -20px;
    }

    .dashboard_selector li {
        position: absolute;
        width: 0;
        height: 100%;
        margin: 0 50%;
        -webkit-transform: rotate(-360deg);
        transition: all 0.8s ease-in-out;
    }

    .dashboard_selector li input {
        display: none;
    }

    .dashboard_selector li input+label {
        position: absolute;
        left: 50%;
        bottom: 100%;
        width: 0;
        height: 0;
        line-height: 1px;
        margin-left: 0;
        background: #fff;
        border-radius: 50%;
        text-align: center;
        font-size: 1px;
        overflow: hidden;
        cursor: pointer;
        box-shadow: none;
        transition: all 0.8s ease-in-out, color 0.1s, background 0.1s;
    }

    .dashboard_selector li input+label:hover {
        background: #f0f0f0;
    }

    .dashboard_selector li input:checked+label {
        background: #5cb85c;
        color: white;
    }

    .dashboard_selector li input:checked+label:hover {
        background: #449d44;
    }

    .dashboard_selector.open li input+label {
        color: white;
        font-weight: bold;
        width: 100px;
        height: 100px;
        line-height: 100px;
        margin-left: -40px;
        box-shadow: 0 3px 3px rgba(0, 0, 0, 0.1);
        font-size: 14px;
    }
</style>
<div class="dashboard_container">
    <h1 align="center" style="margin-top: 50px"><b>TRANG CHỦ</b></h1>
    <div class='dashboard_selector'>
        <ul>
            <li>
                <input id='c1' type='checkbox'>
                <label style="background-color: #5cb85c;" for='c1' onclick="location.href='/taikhoanadmin/index'">Tài khoản</label>
            </li>
            <li>
                <input id='c2' type='checkbox'>
                <label style="background-color: #3071a9;" for='c2' onclick="location.href='/tinh/index'">Tỉnh</label>
            </li>
            <li>
                <input id='c3' type='checkbox'>
                <label style="background-color: #db1890;" for='c3' onclick="location.href='/blog/index'">Blog</label>
            </li>
            <li>
                <input id='c4' type='checkbox'>
                <label style="background-color: #5709b0;" for='c4' onclick="location.href='/trogiup/index'">Trợ giúp (<?= $counter['help'] ?>)</label>
            </li>
            <li>
                <input id='c5' type='checkbox'>
                <label style="background-color: #bd7904;" for='c5' onclick="location.href='/tour/index'">Tour</label>
            </li>
            <li>
                <input id='c6' type='checkbox'>
                <label style="background-color: #a8ba00;" for='c6' onclick="location.href='/dattour/index'">Đặt tour (<?= $counter['bookedTour'] ?>)</label>
            </li>
            <li>
                <input id='c7' type='checkbox'>
                <label style="background-color: #20c204;" for='c7' onclick="location.href='/slide/index'">Slide</label>
            </li>
            <li>
                <input id='c8' type='checkbox'>
                <label style="background-color: #ff0000;" for='c8' onclick="location.href='/trangchu/logout'">Đăng xuất</label>
            </li>
        </ul>
        <button>QUẢN LÝ</button>
    </div>
</div>
<script>
    var nbOptions = 8;
    var angleStart = -360;

    // jquery rotate animation
    function rotate(li, d) {
        $({
            d: angleStart
        }).animate({
            d: d
        }, {
            step: function(now) {
                $(li)
                    .css({
                        transform: 'rotate(' + now + 'deg)'
                    })
                    .find('label')
                    .css({
                        transform: 'rotate(' + (-now) + 'deg)'
                    });
            },
            duration: 0
        });
    }

    // show / hide the options
    function toggleOptions(s) {
        $(s).toggleClass('open');
        var li = $(s).find('li');
        var deg = $(s).hasClass('half') ? 180 / (li.length - 1) : 360 / li.length;
        for (var i = 0; i < li.length; i++) {
            var d = $(s).hasClass('half') ? (i * deg) - 90 : i * deg;
            $(s).hasClass('open') ? rotate(li[i], d) : rotate(li[i], angleStart);
        }
    }

    $('.dashboard_selector button').click(function(e) {
        toggleOptions($(this).parent());
    });

    setTimeout(function() {
        toggleOptions('.dashboard_selector');
    }, 100); //@ sourceURL=pen.js
</script>
<script type="text/javascript">
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-36251023-1']);
    _gaq.push(['_setDomainName', 'jqueryscript.net']);
    _gaq.push(['_trackPageview']);

    (function() {
        var ga = document.createElement('script');
        ga.type = 'text/javascript';
        ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(ga, s);
    })();
</script>