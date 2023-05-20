@extends('layouts.app')
@section('title', 'Jadwal Kedatangan')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/fontawesome.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" />
<div class="container">
    <div class="row justify-content-center">

        <div class="card text-center" style="width: 100%;">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-auto float-left">
                        <h3 id="txt"></h3>
                    </div>
                    <div class="col">
                        <h3>Mengelola Data Kedatangan</h3>
                    </div>
                    <div class="col-md-auto float-right">
                        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#add_jadwal">
                            <i class="fa fa-plus-circle"></i>
                            {{ __('Tambah Jadwal') }}
                        </button>
                    </div>
                    <div class="col-md-auto float-right">
                        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#add_kapal">
                            <i class="fa fa-plus-circle"></i>
                            {{ __('Tambah Kapal') }}
                        </button>
                    </div>

                </div>
            </div>

            <div class="card-body">
                @include('flash-message')
                <table class="table table-bordered table-striped text-center" id="arrival">
                    <thead>
                        <tr>
                            <th scope="col">{{ __('No') }}</th>
                            <th scope="col">{{ __('Logo Kapal') }}</th>
                            <th scope="col">{{ __('Nama Kapal') }}</th>
                            <th scope="col">{{ __('Jadwal Kedatangan') }}</th>
                            <th scope="col">{{ __('Pelabuhan Asal') }}</th>
                            <th scope="col">{{ __('Pelabuhan Tujuan') }}</th>
                            <th scope="col">{{ __('Waktu Kedatangan') }}</th>
                            <th scope="col">{{ __('Status') }}</th>
                            <th scope="col">{{ __('Perubahan') }}</th>
                            <th scope="col">{{ __('Proses') }}</th>
                            <th scope="col" hidden>{{ __('Selesai') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($arrival as $items)
                        <tr>
                            <td scope="col">{{ !empty($loop->iteration) ? $loop->iteration : '-' }}</td>
                            <td scope="col"><img src="{{ asset($items->Ship->logo_kapal) }}" width="50" height="50"></td>
                            <td scope="col">{{ !empty($items->Ship->nama_kapal) ? $items->Ship->nama_kapal : '-' }}</td>
                            <td scope="col">{{ !empty($items->schedule) ? $items->schedule : '-' }}</td>
                            <td scope="col">{{ !empty($items->from) ? $items->from : '-' }}</td>
                            <td scope="col">{{ !empty($items->destination) ? $items->destination : '-' }}</td>
                            <td scope="col">{{ !empty($items->jam) ? $items->jam : '-' }}</td>
                            <th scope="col">
                                {{ !empty($items->status) ? $items->status : '-' }}
                            </th>
                            <td scope="col">
                                <a href="#" class="btn btn-primary btn-flat btn-xs edit" data-id="{{ !empty($items->id) ? $items->id : '-' }}"><i class="fa fa-pen"></i></a>
                                <a href="#" class="btn btn-danger btn-flat btn-xs delete" data-id="{{ !empty($items->id) ? $items->id : '-' }}"><i class="fa fa-trash"></i></a>
                            </td>
                            <td scope="col">
                                <a href="#" id='processing' class="btn btn-success btn-flat btn-xs process" data-id="{{ !empty($items->id) ? $items->id : '-' }}"><i class="fa fa-check"></i></a>
                            </td>
                            <td scope="col" hidden>
                                <a href="#" class="btn btn-dark btn-flat btn-xs finish" data-id="{{ !empty($items->id) ? $items->id : '-' }}"><i class="bi bi-check2-all"></i></a>
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

    <div class="modal fade bd-example-modal-lg" id="add_kapal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white">Tambah Kapal</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="addShip" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="nama_kapal" class="form-label">Nama Kapal :</label>
                            <input type="text" name="nama_kapal" id="nama_kapal" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="logo_kapal" class="form-label">Logo Kapal :</label>
                            <input type="file" name="logo_kapal" id="logo_kapal" class="form-control">
                        </div>
                </div>
                <div class="modal-footer">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Simpan Data</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="edit_jadwal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white">Edit Jadwal Kedatangan</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="editArrival" method="POST" enctype="multipart/form" id="editForm">
                        @method('put')
                        @csrf
                        <div class="form-group">
                            <label for="schedule" class="form-label">Jadwal Kedatangan :</label>
                            <input type="date" name="schedule" id="schedule" class="form-control" value="{{ !empty($items->schedule) ? $items->schedule : '-' }}">
                        </div>
                        <div class="form-group">
                            <label for="jam" class="form-label">Waktu Kedatangan :</label>
                            <input type="time" name="jam" id="jam" class="form-control" value="{{ !empty($items->jam) ? $items->jam : '-' }}">
                        </div>
                        <div class="form-group">
                            <label for="status" class="form-label">Status :</label>
                            <select class="form-select" name="status" id="status" aria-label="Default select example">
                                <option value="Estimasi">Estimasi</option>
                                <option value="Tertunda">Tertunda</option>
                                <option value="Bersandar">Bersandar</option>
                            </select>
                        </div>
                </div>
                <div class="modal-footer">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Simpan Data</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="add_jadwal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white">Tambah Jadwal Kedatangan</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="addArrival" method="POST" enctype="multipart/form">
                        @csrf
                        <div class="form-group">
                            <label for="nama_kapal" class="form-label">Nama Kapal :</label>
                            <select class="form-select" name="nama_kapal" id="nama_kapal" aria-label="Default select example">
                                @foreach ($ships as $item)
                                <option value="{{ !empty($item->id) ? $item->id : '-' }}">{{ !empty($item->nama_kapal) ? $item->nama_kapal : '-' }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="schedule" class="form-label">Jadwal Kedatangan :</label>
                            <input type="date" name="schedule" id="schedule" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="jam" class="form-label">Waktu Kedatangan :</label>
                            <input type="time" name="jam" id="jam" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="from" class="form-label">Pelabuhan Asal :</label>
                            <input type="text" name="from" id="from" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="destination" class="form-label">Pelabuhan Tujuan :</label>
                            <input type="text" name="destination" id="destination" class="form-control">
                        </div>
                </div>
                <div class="modal-footer">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Simpan Data</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="process_jadwal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white">Proses Kapal</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="processArrival" method="POST" enctype="multipart/form" id="processForm">
                        @method('put')
                        @csrf
                        Apakah Anda Ingin Memproses Kapal Ini?
                </div>
                <div class="modal-footer">
                    <div class="form-group">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Iya</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="finish_jadwal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white">Proses Kapal</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="finishArrival" method="POST" enctype="multipart/form" id="finishForm">
                        @method('put')
                        @csrf
                        Apakah Anda Ingin Menyelesaikan Pemrosesan Kapal Ini?
                </div>
                <div class="modal-footer">
                    <div class="form-group">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Iya</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="delete_jadwal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white">Hapus Data</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="deleteArrival" method="POST" enctype="multipart/form" id="deleteForm">
                        @method('delete')
                        @csrf
                        Apakah Anda Ingin Menghapus Data?
                </div>
                <div class="modal-footer">
                    <div class="form-group">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Iya</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            var table = $('#arrival').DataTable({
                pageLength: 5,
                lengthMenu: [
                    [5, 10, 100],
                    [5, 10, 100]
                ],
            });

            table.on('click', '.edit', function() {
                $tr = $(this).closest('tr');
                if ($($tr).hasClass('child')) {
                    $tr = $tr.prev('.parent');
                }

                var data = table.row($tr).data();
                console.log(data[7]);
                var id = $(this).attr("data-id");
                console.log(id);

                $('#schedule').val(data[3]);
                $('#jam').val(data[6]);
                $('#status').val(data[7]);

                $('#editForm').attr('action', '/editArrival/' + id);
                $('#edit_jadwal').modal('show')
            });

            table.on('click', '.process', function() {
                $tr = $(this).closest('tr');
                if ($($tr).hasClass('child')) {
                    $tr = $tr.prev('.parent');
                }
                var id = $(this).attr("data-id");

                $('#processForm').attr('action', '/processArrival/' + id);
                $('#process_jadwal').modal('show')
            });

            table.on('click', '.delete', function() {
                $tr = $(this).closest('tr');
                if ($($tr).hasClass('child')) {
                    $tr = $tr.prev('.parent');
                }
                var id = $(this).attr("data-id");

                $('#deleteForm').attr('action', '/deleteArrival/' + id);
                $('#delete_jadwal').modal('show')
            });

            table.on('click', '.finish', function() {
                $tr = $(this).closest('tr');
                if ($($tr).hasClass('child')) {
                    $tr = $tr.prev('.parent');
                }
                var id = $(this).attr("data-id");

                $('#finishForm').attr('action', '/finishArrival/' + id);
                $('#finish_jadwal').modal('show')
            });
            


            $(function() {
                var rowCount = document.getElementById('arrival').rows.length;
                for (var i = 1; i < rowCount; i++) {
                    var tag = document.getElementById("arrival").rows[i].cells.item(7);
                    value = tag.innerText;
                    if (value == 'Estimasi') {
                        tag.setAttribute("class", "text-primary");
                    } else if (value === 'Tertunda') {
                        tag.setAttribute("class", "text-danger");
                    } else if (value === 'Bersandar') {
                        tag.setAttribute("class", "text-success");
                    }
                }
            });

            $(function() {
                var rowCount = document.getElementById('arrival').rows.length;
                for (var i = 1; i < rowCount; i++) {
                    var tag = document.getElementById("arrival").rows[i].cells.item(7);
                    value = tag.innerText;
                    if (value == 'Bersandar') {
                        for (var j = 0; j < rowCount; j++) {
                            var hide = document.getElementById("arrival").rows[j].cells[9];
                            var show = document.getElementById("arrival").rows[j].cells[10];
                            hide.hidden = true;
                            if (j == 0) {
                                show.hidden = false;
                            } else if (j == i) {
                                show.hidden = false;
                            } else {
                                show.hidden = false;
                                show.innerHTML = "-";
                            }
                        }

                        show.hidden = false;
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

                var rowCount = document.getElementById('arrival').rows.length;
                for (var i = 1; i < rowCount; i++) {
                    var date = document.getElementById("arrival").rows[i].cells.item(3);
                    var time = document.getElementById("arrival").rows[i].cells.item(6);
                    var tag = document.getElementById("arrival").rows[i];
                    var tags = document.getElementById("arrival").rows[i].cells.item(7);
                    dateValue = date.innerText;
                    timeValue = time.innerText;
                    value = tags.innerText;
                    schedule = dateValue + " " + timeValue;
                    if (realTime > schedule && value == 'Estimasi') {
                        tag.setAttribute("class", "bg-info");
                    }
                }
            });

            function startTime() {
                const today = new Date();
                let h = today.getHours();
                let m = today.getMinutes();
                let s = today.getSeconds();
                h = checkTime(h);
                m = checkTime(m);
                s = checkTime(s);
                document.getElementById('txt').innerHTML = h + ":" + m + ":" + s;
                setTimeout(startTime, 1000);
            }

            function checkTime(i) {
                if (i < 10) {
                    i = "0" + i
                };
                return i;
            }

            window.onload = startTime();
        });
    </script>
</div>
@endsection