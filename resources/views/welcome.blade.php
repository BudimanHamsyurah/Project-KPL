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
                            <th rowspan="2" scope="col" id="lId" width="150px" hidden>{{ __('Id') }}</th>
                            <th rowspan="2" scope="col" id="lLogo" width="150px">{{ __('Logo Kapal') }}</th>
                            <th rowspan="2" scope="col" id="lNama" width="250px">{{ __('Nama Kapal') }}</th>
                            <th rowspan="2" scope="col" id="lJenis" width="200px">{{ __('Jenis Kapal') }}</th>
                            <th colspan="2" scope="col" id="lWaktu" width="400px">{{ __('Perkiraan Waktu Kedatangan') }}</th>
                            <th rowspan="2" scope="col" id="lAsal" width="200px">{{ __('Pelabuhan Asal') }}</th>
                            <th rowspan="2" scope="col" id="lTujuan" width="200px">{{ __('Pelabuhan Tujuan') }}</th>
                            <th rowspan="2" scope="col" id="lStatus" width="150px">{{ __('Status') }}</th>
                            <th rowspan="2" scope="col" id="lButton" width="150px" hidden>{{ __('Button') }}</th>
                        </tr>
                        <tr>
                            <th id="lTanggal" width="200px">{{ __('Tanggal') }}</th>
                            <th id="lJam" width="200px">{{ __('Waktu') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($arrival as $items)
                        <tr>
                            <td scope="col" hidden>{{ !empty($items->id) ? $items->id : '-' }}</td>
                            <td scope="col"><img src="{{ asset($items->Ship->logo_kapal) }}" width="50" height="50"></td>
                            <td scope="col">{{ !empty($items->Ship->nama_kapal) ? $items->Ship->nama_kapal : '-' }}</td>
                            <td scope="col">{{ !empty($items->Ship->jenis_kapal) ? $items->Ship->jenis_kapal : '-' }}</td>
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
                    var tag = document.getElementById("arrival").rows[i].cells.item(8);
                    value = tag.innerText;
                    if (value == 'Estimasi') {
                        tag.setAttribute("class", "text-primary");
                    }else if (value == 'Tertunda') {
                        tag.setAttribute("class", "text-danger");
                    } else if (value == 'Bersandar') {
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
                var change = "Bersandar";
                var nChange = "Menunggu";
                
                var rowCount = document.getElementById('arrival').rows.length;
                for (var i = 2; i < rowCount; i++) {
                    
                    var type = document.getElementById("arrival").rows[i].cells.item(3);
                    var date = document.getElementById("arrival").rows[i].cells.item(4);
                    var time = document.getElementById("arrival").rows[i].cells.item(5);
                    var tag = document.getElementById("arrival").rows[i].cells.item(8);
                    var id = document.getElementById("arrival").rows[i].cells.item(0);
                    idValue = id.innerText;
                    typeValue = type.innerText;
                    statusvalue = tag.innerText;
                    dateValue = date.innerText;
                    timeValue = time.innerText;
                    schedule = dateValue + " " + timeValue;
                    if(statusvalue == "Bersandar"){
                        for (var j = 2; j < rowCount; j++) {
                            var types = document.getElementById("arrival").rows[j].cells.item(3);
                            var dates = document.getElementById("arrival").rows[j].cells.item(4);
                            var times = document.getElementById("arrival").rows[j].cells.item(5);
                            var tags = document.getElementById("arrival").rows[j].cells.item(8);
                            typeValues = types.innerText;
                            statusvalues = tags.innerText;
                            dateValues = dates.innerText;
                            timeValues = times.innerText;
                            schedules = dateValues + " " + timeValues;
                            if(j != i ){
                                if(realTime > schedules && statusvalues == "Estimasi"){
                                    console.log(statusvalues);
                                    tags.innerText = nChange;
                                    tags.setAttribute("class", "text-muted");
                                }
                            }
                        }
                        return 0;
                    }

                    else if(realTime > schedule && statusvalue == "Estimasi" && typeValue == "Kapal Penumpang"){
                       
                        fetch('/autoProcess', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({
                                id: idValue
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            console.log(data.message); // Handle the response from the server
                        })
                        .catch(error => {
                            console.error(error); // Handle errors, if any
                        });
                        for (var j = 2; j < rowCount; j++) {
                            var types = document.getElementById("arrival").rows[j].cells.item(3);
                            var dates = document.getElementById("arrival").rows[j].cells.item(4);
                            var times = document.getElementById("arrival").rows[j].cells.item(5);
                            var tags = document.getElementById("arrival").rows[j].cells.item(8);
                            typeValues = types.innerText;
                            statusvalues = tags.innerText;
                            dateValues = dates.innerText;
                            timeValues = times.innerText;
                            schedules = dateValues + " " + timeValues;
                            if(j != i ){
                                if(realTime > schedules && statusvalues == "Estimasi"){
                                    console.log(statusvalues);
                                    tags.innerText = nChange;
                                    tags.setAttribute("class", "text-muted");
                                }
                            }
                        }
                        return 0;
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
            const jenis = document.getElementById("lJenis");
            const waktu = document.getElementById("lWaktu");
            const asal = document.getElementById("lAsal");
            const tujuan = document.getElementById("lTujuan");
            const tanggal = document.getElementById("lTanggal");
            const jam = document.getElementById("lJam");

            setInterval(function() {
                logo.innerHTML = "Ship Logo"
                nama.innerHTML = "Ship Name"
                jenis.innerHTML = "Type of Ship"
                waktu.innerHTML = "Estimated Time of Arrival"
                asal.innerHTML = "Origin Port"
                tujuan.innerHTML = "Destination Port"
                tanggal.innerHTML = "Date"
                jam.innerHTML = "Time"
            }, 5000);
            setInterval(function() {
                logo.innerHTML = "Logo Kapal"
                nama.innerHTML = "Nama Kapal"
                jenis.innerHTML = "Jenis Kapal"
                waktu.innerHTML = "Perkiraan Waktu Kedatangan"
                asal.innerHTML = "Pelabuhan Asal"
                tujuan.innerHTML = "Pelabuhan Tujuan"
                tanggal.innerHTML = "Tanggal"
                jam.innerHTML = "Waktu"
            }, 10000);
            
        });
    </script>
</div>
@endsection