@extends('layouts.userDeparture')
@section('title', 'Jadwal Keberangkatan')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/fontawesome.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" />
<div class="container">
    <div class="row justify-content-center">
        <div class="card text-center" style="width: 100%;">
            <div class="card-body">
                <table class="table table-bordered table-striped" id="departure">
                    <thead>
                    <tr>
                            <th rowspan="2" scope="col" id="lLogo">{{ __('Logo Kapal') }}</th>
                            <th rowspan="2" scope="col" id="lNama">{{ __('Nama Kapal') }}</th>
                            <th colspan="2" scope="col" id="lWaktu">{{ __('Perkiraan Waktu Keberangkatan') }}</th>
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
                        @foreach ($departure as $items)
                        <tr>
                            <td scope="col"><img src="{{ asset($items->Ship->logo_kapal) }}" width="50" height="50"></td>
                            <td scope="col">{{ !empty($items->Ship->nama_kapal) ? $items->Ship->nama_kapal : '-' }}</td>
                            <td scope="col">{{ !empty($items->schedule) ? $items->schedule : '-' }}</td>
                            <td scope="col">{{ !empty($items->jam) ? $items->jam : '-' }}</td>
                            <td scope="col">{{ !empty($items->from) ? $items->from : '-' }}</td>
                            <td scope="col">{{ !empty($items->destination) ? $items->destination : '-' }}</td>
                            <td scope="col">
                                <b>{{ !empty($items->status) ? $items->status : '-' }}</b>
                            </td>
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
                var rowCount = document.getElementById('departure').rows.length;
                for (var i = 2; i < rowCount; i++) {
                    var tag = document.getElementById("departure").rows[i].cells.item(6);
                    value = tag.innerText;
                    console.log(value);
                    if (value == 'Estimasi') {
                        tag.setAttribute("class", "text-primary");
                    } else if (value === 'Tertunda') {
                        tag.setAttribute("class", "text-danger");
                    } else if (value === 'Berangkat') {
                        tag.setAttribute("class", "text-success");
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
                
                var rowCount = document.getElementById('departure').rows.length;
                for (var i = 2; i < rowCount; i++) {
                    var date = document.getElementById("departure").rows[i].cells.item(2);
                    var time = document.getElementById("departure").rows[i].cells.item(3);
                    var tag = document.getElementById("departure").rows[i].cells.item(6);
                    statusvalue = tag.innerText;
                    dateValue = date.innerText;
                    timeValue = time.innerText;
                    schedule = dateValue + " " + timeValue;
                    if(realTime > schedule  && statusvalue != "Berangkat"){
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

            const logo1 = document.getElementById("lLogo");
            const nama1 = document.getElementById("lNama");
            const waktu1 = document.getElementById("lWaktu");
            const asal1 = document.getElementById("lAsal");
            const tujuan1 = document.getElementById("lTujuan");
            const tanggal1 = document.getElementById("lTanggal");
            const jam1 = document.getElementById("lJam");

            setInterval(function() {
                logo1.innerHTML = "Logo Kapal"
                nama1.innerHTML = "Nama Kapal"
                waktu1.innerHTML = "Perkiraan Waktu Keberangkatan"
                asal1.innerHTML = "Pelabuhan Asal"
                tujuan1.innerHTML = "Pelabuhan Tujuan"
                tanggal1.innerHTML = "Tanggal"
                jam1.innerHTML = "Waktu"
            }, 1000);
            setInterval(function() {
                logo1.innerHTML = "Ship Logo"
                nama1.innerHTML = "Ship Name"
                waktu1.innerHTML = "Estimated Time of Departure"
                asal1.innerHTML = "Origin Port"
                tujuan1.innerHTML = "Destination Port"
                tanggal1.innerHTML = "Date"
                jam1.innerHTML = "Time"
            }, 2000);
        });
    </script>
</div>
@endsection