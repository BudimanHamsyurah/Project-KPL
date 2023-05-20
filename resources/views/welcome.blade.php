@extends('layouts.userArrival')
@section('title', 'Jadwal Kedatangan')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card text-center" style="width: 100%;">
            <div class="card-body">
                <table class="table table-bordered table-striped" id="arrival">
                    <thead>
                        <tr>
                            <th rowspan="2" scope="col" id="lLogo">{{ __('Logo Kapal') }}</th>
                            <th rowspan="2" scope="col" id="lNama">{{ __('Nama Kapal') }}</th>
                            <th colspan="2" scope="col" id="lWaktu">{{ __('Perkiraan Waktu Kedatangan') }}</th>
                            <th rowspan="2" scope="col" id="lAsal">{{ __('Pelabuhan Asal') }}</th>
                            <th rowspan="2" scope="col" id="lTujuan">{{ __('Pelabuhan Tujuan') }}</th>
                            <th rowspan="2" scope="col" id="lStatus">{{ __('Status') }}</th>
                        </tr>
                        <tr>
                            <th id="lTanggal">{{ __('Tanggal') }}</th>
                            <th id="lJam">{{ __('Waktu') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($arrival as $items)
                        <tr>
                            <td scope="col"><img src="{{ asset($items->Ship->logo_kapal) }}" width="50" height="50"></td>
                            <td scope="col">{{ !empty($items->Ship->nama_kapal) ? $items->Ship->nama_kapal : '-' }}</td>
                            <td scope="col">{{ !empty($items->schedule) ? $items->schedule : '-' }}</td>
                            <td scope="col">{{ !empty($items->jam) ? $items->jam : '-' }}</td>
                            <td scope="col">{{ !empty($items->from) ? $items->from : '-' }}</td>
                            <td scope="col">{{ !empty($items->destination) ? $items->destination : '-' }}</td>
                            <th scope="col" id="stat">
                                {{ !empty($items->status) ? $items->status : '-' }}
                            </th>
                            <td style="display:none;">{{ !empty($items->id) ? $items->id : '-' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <script>
        setTimeout(function() {
            window.location.reload();
        }, 30000);
        $(document).ready(function() {
            $(function() {
                var rowCount = document.getElementById('arrival').rows.length;
                for (var i = 2; i < rowCount; i++) {
                    var tag = document.getElementById("arrival").rows[i].cells.item(6);
                    value = tag.innerText;
                    if (value == 'Estimasi') {
                        tag.setAttribute("class", "text-primary");
                        // setInterval(function() {
                        //     tag.innerHTML = "Estimasi";
                        //     tag.setAttribute("class", "text-primary");
                        // }, 1000);
                        // setInterval(function() {
                        //     tag.innerHTML = "Estimation";
                        //     tag.setAttribute("class", "text-primary");
                        // }, 2000);
                    }else if (value == 'Tertunda') {
                        tag.setAttribute("class", "text-danger");
                        // setInterval(function() {
                        //     tag.innerText = "Tertunda";
                        //     tag.setAttribute("class", "text-danger");
                        // }, 1000);
                        // setInterval(function() {
                        //     tag.innerHTML = "Delay";
                        //     tag.setAttribute("class", "text-danger");
                        // }, 2000);
                    } else if (value == 'Bersandar') {
                        tag.setAttribute("class", "text-success");
                        // setInterval(function() {
                        //     tag.innerHTML = "Bersandar";
                        //     tag.setAttribute("class", "text-success");
                        // }, 1000);
                        // setInterval(function() {
                        //     tag.innerHTML = "Arrived";
                        //     tag.setAttribute("class", "text-success");
                        // }, 2000);
                    }
                }
            });

            $(function() {
                var dt = new Date(Date.now());
                let M = dt.getMonth() + 1;
                let D = dt.getDate();
                let h = dt.getHours();
                let m = dt.getMinutes();
                let s = dt.getSeconds();
                M = checkTime(M);
                D = checkTime(D);
                h = checkTime(h);
                m = checkTime(m);
                s = checkTime(s);
                realTime = dt.getFullYear() + '-' + M + '-' + D + ' ' + h + ':' + m + ':' + s;
                var change = "Tertunda";
                
                var rowCount = document.getElementById('arrival').rows.length;
                for (var i = 2; i < rowCount; i++) {
                    var date = document.getElementById("arrival").rows[i].cells.item(2);
                    var time = document.getElementById("arrival").rows[i].cells.item(3);
                    var tag = document.getElementById("arrival").rows[i].cells.item(6);
                    statusvalue = tag.innerText;
                    dateValue = date.innerText;
                    timeValue = time.innerText;
                    schedule = dateValue + " " + timeValue;
                    if(realTime > schedule && statusvalue != "Bersandar"){
                        console.log(tag);
                        tag.innerText = change;
                        tag.setAttribute("class", "text-danger");
                    }
                }
            });

            function checkTime(i) {
                if (i < 10) {
                    i = "0" + i
                }; // add zero in front of numbers < 10
                return i;
            }


            const logo = document.getElementById("lLogo");
            const nama = document.getElementById("lNama");
            const waktu = document.getElementById("lWaktu");
            const asal = document.getElementById("lAsal");
            const tujuan = document.getElementById("lTujuan");
            const tanggal = document.getElementById("lTanggal");
            const jam = document.getElementById("lJam");

            setInterval(function() {
                logo.innerHTML = "Logo Kapal"
                nama.innerHTML = "Nama Kapal"
                waktu.innerHTML = "Perkiraan Waktu Kedatangan"
                asal.innerHTML = "Pelabuhan Asal"
                tujuan.innerHTML = "Pelabuhan Tujuan"
                tanggal.innerHTML = "Tanggal"
                jam.innerHTML = "Waktu"
            }, 1000);
            setInterval(function() {
                logo.innerHTML = "Ship Logo"
                nama.innerHTML = "Ship Name"
                waktu.innerHTML = "Estimated Time of Arrival"
                asal.innerHTML = "Origin Port"
                tujuan.innerHTML = "Destination Port"
                tanggal.innerHTML = "Date"
                jam.innerHTML = "Time"
            }, 2000);
        });
    </script>
</div>
@endsection