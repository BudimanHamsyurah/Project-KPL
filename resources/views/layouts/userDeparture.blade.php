<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Pelindo | @yield('title')</title>
    <link rel="icon" href="/storage/images/logo_head.png" type="image/icon type">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/fontawesome.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" />
    <script src = "https://cdnjs.cloudflare.com/ajax/libs/jquery/1.10.1/jquery.min.js"> </script>  
    <script src = "https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.0.0/moment.min.js"> </script>   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <style>
        #clock {
            position: relative;
        }

        #clock:after {
            content: ' ';
            position: absolute;
            width: 400px;
            border-radius: 100%;
            left: 50%;
            margin-left: -200px;
            bottom: 2px;
            z-index: -1;
        }

        #clock .display {
            text-align: center;
            padding: 40px 20px 20px;
            border-radius: 6px;
            position: relative;
        }

        #clock.light {
            color: #272e38;
        }

        #clock.light:after {
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }

        #clock.light .digits div span {
            background-color: #272e38;
            border-color: #272e38;
        }

        #clock.light .digits div.dots:before {
            background-color: #272e38;
        }

        #clock.light .digits div.dots:after {
            background-color: #272e38;
        }


        #clock.dark {
            background-color: #0E73B9;
            color: #ffffff;
        }

        #clock.dark:after {
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }

        #clock.dark .digits div span {
            background-color: #ffffff;
            border-color: #ffffff;
        }

        #clock.dark .digits div.dots:before {
            background-color: #ffffff;
        }

        #clock.dark .digits div.dots:after {
            background-color: #ffffff;
        }

        #clock .digits div {
            text-align: left;
            position: relative;
            width: 28px;
            height: 50px;
            display: inline-block;
            margin: 0 4px;
        }

        #clock .digits div span {
            opacity: 0;
            position: absolute;
            -webkit-transition: 0.25s;
            -moz-transition: 0.25s;
            transition: 0.25s;
        }

        #clock .digits div span:before {
            content: ' ';
            position: absolute;
            width: 0;
            height: 0;
            border: 5px solid transparent;
        }

        #clock .digits div span:after {
            content: ' ';
            position: absolute;
            width: 0;
            height: 0;
            border: 5px solid transparent;
        }

        #clock .digits .d1 {
            height: 4.9px;
            width: 8px;
            top: 0;
            left: 6px;
        }

        #clock .digits .d1:before {
            border-width: 0 5px 5px 0;
            border-right-color: inherit;
            left: -5px;
        }

        #clock .digits .d1:after {
            border-width: 0 0 5px 5px;
            border-left-color: inherit;
            right: -5px;
        }

        #clock .digits .d2 {
            height: 4.9px;
            width: 8px;
            top: 13px;
            left: 6px;
        }

        #clock .digits .d2:before {
            border-width: 3px 4px 2px;
            border-right-color: inherit;
            left: -8px;
        }

        #clock .digits .d2:after {
            border-width: 3px 4px 2px;
            border-left-color: inherit;
            right: -8px;
        }

        #clock .digits .d3 {
            height: 4.9px;
            width: 8px;
            top: 26px;
            left: 6px;
        }

        #clock .digits .d3:before {
            border-width: 5px 5px 0 0;
            border-right-color: inherit;
            left: -5px;
        }

        #clock .digits .d3:after {
            border-width: 5px 0 0 5px;
            border-left-color: inherit;
            right: -5px;
        }

        #clock .digits .d4 {
            height: 3px;
            width: 4.9px;
            top: 7px;
            left: 0;
        }

        #clock .digits .d4:before {
            border-width: 0 5px 5px 0;
            border-bottom-color: inherit;
            top: -5px;
        }

        #clock .digits .d4:after {
            border-width: 0 0 5px 5px;
            border-left-color: inherit;
            bottom: -5px;
        }

        #clock .digits .d5 {
            height: 3px;
            width: 4.9px;
            top: 7px;
            right: 8px;
        }

        #clock .digits .d5:before {
            border-width: 0 0 5px 5px;
            border-bottom-color: inherit;
            top: -5px;
        }

        #clock .digits .d5:after {
            border-width: 5px 0 0 5px;
            border-top-color: inherit;
            bottom: -5px;
        }

        #clock .digits .d6 {
            height: 3px;
            width: 4.9px;
            top: 21px;
            left: 0;
        }

        #clock .digits .d6:before {
            border-width: 0 5px 5px 0;
            border-bottom-color: inherit;
            top: -5px;
        }

        #clock .digits .d6:after {
            border-width: 0 0 5px 5px;
            border-left-color: inherit;
            bottom: -5px;
        }

        #clock .digits .d7 {
            height: 3px;
            width: 4.9px;
            top: 21px;
            right: 8px;
        }

        #clock .digits .d7:before {
            border-width: 0 0 5px 5px;
            border-bottom-color: inherit;
            top: -5px;
        }

        #clock .digits .d7:after {
            border-width: 5px 0 0 5px;
            border-top-color: inherit;
            bottom: -5px;
        }

        #clock .digits div.one .d5 {
            opacity: 1;
        }

        #clock .digits div.one .d7 {
            opacity: 1;
        }

        #clock .digits div.two .d1 {
            opacity: 1;
        }

        #clock .digits div.two .d5 {
            opacity: 1;
        }

        #clock .digits div.two .d2 {
            opacity: 1;
        }

        #clock .digits div.two .d6 {
            opacity: 1;
        }

        #clock .digits div.two .d3 {
            opacity: 1;
        }

        #clock .digits div.three .d1,
        #clock .digits div.three .d5,
        #clock .digits div.three .d2,
        #clock .digits div.three .d7,
        #clock .digits div.three .d3 {
            opacity: 1;
        }

        #clock .digits div.four .d5,
        #clock .digits div.four .d2,
        #clock .digits div.four .d4,
        #clock .digits div.four .d7 {
            opacity: 1;
        }

        #clock .digits div.five .d1,
        #clock .digits div.five .d2,
        #clock .digits div.five .d4,
        #clock .digits div.five .d3,
        #clock .digits div.five .d7 {
            opacity: 1;
        }

        #clock .digits div.six .d1,
        #clock .digits div.six .d2,
        #clock .digits div.six .d4,
        #clock .digits div.six .d3,
        #clock .digits div.six .d6,
        #clock .digits div.six .d7 {
            opacity: 1;
        }



        #clock .digits div.seven .d1,
        #clock .digits div.seven .d5,
        #clock .digits div.seven .d7 {
            opacity: 1;
        }

        #clock .digits div.eight .d1,
        #clock .digits div.eight .d2,
        #clock .digits div.eight .d3,
        #clock .digits div.eight .d4,
        #clock .digits div.eight .d5,
        #clock .digits div.eight .d6,
        #clock .digits div.eight .d7 {
            opacity: 1;
        }

        #clock .digits div.nine .d1,
        #clock .digits div.nine .d2,
        #clock .digits div.nine .d3,
        #clock .digits div.nine .d4,
        #clock .digits div.nine .d5,
        #clock .digits div.nine .d7 {
            opacity: 1;
        }

        #clock .digits div.zero .d1,
        #clock .digits div.zero .d3 {
            opacity: 1;
        }

        #clock .digits div.zero .d4 {
            opacity: 1;
        }

        #clock .digits div.zero .d5 {
            opacity: 1;
        }

        #clock .digits div.zero .d6 {
            opacity: 1;
        }

        #clock .digits div.zero .d7 {
            opacity: 1;
        }

        #clock .digits div.dots {
            width: 5px;
        }

        #clock .digits div.dots:before {
            width: 5px;
            height: 5px;
            content: ' ';
            position: absolute;
            left: 0;
            top: 8px;
        }

        #clock .digits div.dots:after {
            width: 5px;
            height: 5px;
            content: ' ';
            position: absolute;
            left: 0;
            top: 14px;
        }

        #clock .digits div.dots:after {
            top: 20px;
        }

        #clock .weekdays {
            font-size: 12px;
            position: absolute;
            width: 100%;
            top: 10px;
            left: -22px;
            text-align: center;
        }

        #clock .weekdays span {
            opacity: 0.2;
            padding: 0 10px;
        }

        #clock .weekdays span.active {
            opacity: 1;
        }

        #clock .ampm {
            position: absolute;
            bottom: 43px;
            right: 10px;
            font-size: 12px;
        }
    </style>
    <!-- Scripts -->
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md shadow-sm text-white" style="background-color: #ADD8E6;">
            <div class="container">
                <a class="navbar-brand" href="{{ route('usrArrival') }}">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/6/69/Logo_Baru_Pelindo_%282021%29.png" height="50" width="250">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>
                    <span class="navbar-text text-center text-dark font-weight-bold">
                        <h2 id="head"><b>Informasi Jadwal Keberangkatan Kapal</h2></b>
                        <h2 id="txt"></h2>
                    </span>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <div id="clock" class="light">
                            <div class="display">
                                <div class="weekdays"> </div>
                                <div class="ampm"> </div>
                                <div class="alarm"> </div>
                                <div class="digits"> </div>
                            </div>
                        </div>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script>
        $(document).ready(function() {
            $(function() {
                var clock = $('#clock'),
                    alarm = clock.find('.alarm'),
                    ampm = clock.find('.ampm');
                var digit_to_name = 'zero one two three four five six seven eight nine'.split(' ');
                var digits = {};
                var positions = [
                    'h1', 'h2', ':', 'm1', 'm2', ':', 's1', 's2'
                ];
                var digit_holder = clock.find('.digits');
                $.each(positions, function() {
                    if (this == ':') {
                        digit_holder.append('<div class="dots">');
                    } else {
                        var pos = $('<div>');
                        for (var i = 1; i < 8; i++) {
                            pos.append('<span class="d' + i + '">');
                        }
                        digits[this] = pos;
                        digit_holder.append(pos);
                    }
                });
                var weekday_names = 'MON TUE WED THU FRI SAT SUN'.split(' '),
                    weekday_holder = clock.find('.weekdays');
                $.each(weekday_names, function() {
                    weekday_holder.append('<span>' + this + '</span>');
                });
                var weekdays = clock.find('.weekdays span');
                (function update_time() {
                    var now = moment().format("hhmmssdA");
                    digits.h1.attr('class', digit_to_name[now[0]]);
                    digits.h2.attr('class', digit_to_name[now[1]]);
                    digits.m1.attr('class', digit_to_name[now[2]]);
                    digits.m2.attr('class', digit_to_name[now[3]]);
                    digits.s1.attr('class', digit_to_name[now[4]]);
                    digits.s2.attr('class', digit_to_name[now[5]]);
                    var dow = now[6];
                    dow--;
                    if (dow < 0) {
                        dow = 6;
                    }
                    weekdays.removeClass('active').eq(dow).addClass('active');
                    ampm.text(now[7] + now[8]);
                    setTimeout(update_time, 1000);
                })();
                $('a.button').click(function() {
                    clock.toggleClass('light dark');
                });
            });
            
            const title1 = document.getElementById("head");
            setInterval(function() {
                title1.innerHTML = "Ship Departure Schedule Information"
            }, 5000);
            setInterval(function() {
                title1.innerHTML = "Informasi Jadwal Keberangkatan Kapal"
            }, 10000);
            

            function startTime() {
                const today = new Date();
                const month = today.getMonth();
                const year = today.getFullYear();
                const date = today.getDate();
                const day = today.getDay();

                const monthList = [
                    "Januari",
                    "Februari",
                    "Maret",
                    "April",
                    "Mei",
                    "Juni",
                    "Juli",
                    "Agustus",
                    "September",
                    "Oktober",
                    "November",
                    "Desember"
                ];

                const dayList = [
                    "Minggu",
                    "Senin",
                    "Selasa",
                    "Rabu",
                    "Kamis",
                    "Jumat",
                    "Sabtu",

                ];
                document.getElementById('txt').innerHTML = dayList[day] + ", " + date + " " + monthList[month] + " " + year;
                setTimeout(startTime, 1000);
            }

            function checkTime(i) {
                if (i < 10) {
                    i = "0" + i
                }; // add zero in front of numbers < 10
                return i;
            }
            window.onload = startTime();
        });
    </script>

</body>
<footer class="text-center text-lg-start" style="background-color: #ADD8E6;">
    <div class="container p-4">
        <div class="row">
            <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
                <h5 class="text-uppercase">PT Pelabuhan Indonesia (Persero)</h5>

                <p>
                    Alamat:
                    Jl. Yos Sudarso No. 30 Balikpapan
                </p>
            </div>
            <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
                <h5 class="text-uppercase">Contact</h5>

                <p>
                    <i class="fa fa-phone fa-rotate-90"></i> (0542) 422246, 426061, 731224
                    </br><i class="fa fa-envelope"></i> balikpapan@pelindo.co.id
                </p>
            </div>
        </div>
    </div>
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        © 2023 Copyright
    </div>
</footer>

</html>