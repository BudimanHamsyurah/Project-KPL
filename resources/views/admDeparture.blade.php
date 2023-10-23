@extends('layouts.app')
@section('title', 'Jadwal Keberangkatan')
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
                        <h3>Mengelola Data Keberangkatan</h3>
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
                <table class="table table-bordered table-striped" id="departure">
                    <thead>
                        <tr>
                            <th scope="col">{{ __('Logo Kapal') }}</th>
                            <th scope="col">{{ __('Nama Kapal') }}</th>
                            <th scope="col">{{ __('Jenis Kapal') }}</th>
                            <th scope="col">{{ __('Jadwal Kedatangan') }}</th>
                            <th scope="col">{{ __('Pelabuhan Asal') }}</th>
                            <th scope="col">{{ __('Pelabuhan Tujuan') }}</th>
                            <th scope="col">{{ __('Waktu Kedatangan') }}</th>
                            <th scope="col">{{ __('Status') }}</th>
                            <th scope="col">{{ __('Perubahan') }}</th>
                            <th scope="col">{{ __('Proses') }}</th>
                            <th scope="col">{{ __('Selesai') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($departure as $items)
                        <tr>
                            <td scope="col"><img src="{{ asset($items->Ship->logo_kapal) }}" width="50" height="50"></td>
                            <td scope="col">{{ !empty($items->Ship->nama_kapal) ? $items->Ship->nama_kapal : '-' }}</td>
                            <td scope="col">{{ !empty($items->Ship->jenis_kapal) ? $items->Ship->jenis_kapal : '-' }}</td>
                            <td scope="col">{{ !empty($items->schedule) ? $items->schedule : '-' }}</td>
                            <td scope="col">{{ !empty($items->from) ? $items->from : '-' }}</td>
                            <td scope="col">{{ !empty($items->destination) ? $items->destination : '-' }}</td>
                            <td scope="col">{{ !empty($items->jam) ? $items->jam : '-' }}</td>
                            <td scope="col"><b>{{ !empty($items->status) ? $items->status : '-' }}</b></td>
                            <td scope="col">
                                <a href="#" class="btn btn-primary btn-flat btn-xs edit" data-id="{{ !empty($items->id) ? $items->id : '-' }}"><i class="fa fa-pen"></i></a>
                                <a href="#" class="btn btn-danger btn-flat btn-xs delete" data-id="{{ !empty($items->id) ? $items->id : '-' }}"><i class="fa fa-trash"></i></a>
                            </td>
                            <td scope="col">
                                <a href="#" id='processing' class="btn btn-success btn-flat btn-xs process" data-id="{{ !empty($items->id) ? $items->id : '-' }}"><i class="fa fa-check"></i></a>
                            </td>
                            <td scope="col">
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
                    <form action="addShip" method="POST" enctype="multipart/form">
                        @csrf
                        <div class="form-group">
                            <label for="nama_kapal" class="form-label">Nama Kapal :</label>
                            <input type="text" name="nama_kapal" id="nama_kapal" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="jenis_kapal" class="form-label">Jenis Kapal :</label>
                            <select class="form-select" name="jenis_kapal" id="jenis_kapal" aria-label="Default select example">
                                <option value="Kapal Barang">Kapal Barang</option>
                                <option value="Kapal Penumpang">Kapal Penumpang</option>
                            </select>
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

    <div class="modal fade bd-example-modal-lg" id="add_jadwal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white">Tambah Jadwal Keberangkatan</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="addDeparture" method="POST" enctype="multipart/form">
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
                            <label for="schedule" class="form-label">Jadwal Keberangkatan :</label>
                            <input type="date" name="schedule" id="schedule" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="jam" class="form-label">Waktu Keberangkatan :</label>
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

    <div class="modal fade bd-example-modal-lg" id="edit_jadwal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white">Tambah Jadwal Keberangkatan</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="editDeparture" method="POST" enctype="multipart/form" id="editForm">
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
                            <label for="jam" class="form-label">Waktu Kedatangan :</label>
                            <select class="form-select" name="status" id="status" aria-label="Default select example">
                                <option value="Estimasi">Estimasi</option>
                                <option value="Tertunda">Tertunda</option>
                                <option value="Berangkat">Berangkat</option>
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

    <div class="modal fade bd-example-modal-lg" id="process_jadwal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white">Proses Kapal</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="processDeparture" method="POST" enctype="multipart/form" id="processForm">
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
                    <form action="finishDeparture" method="POST" enctype="multipart/form" id="finishForm">
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
                    <form action="deleteDeparture" method="POST" enctype="multipart/form" id="deleteForm">
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
            var table = $('#departure').DataTable({
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
                console.log(data);
                var id = $(this).attr("data-id");
                console.log(id);

                $('#schedule').val(data[3]);
                $('#jam').val(data[6]);

                $('#editForm').attr('action', '/editDeparture/' + id);
                $('#edit_jadwal').modal('show')
            });

            table.on('click', '.process', function() {
                $tr = $(this).closest('tr');
                if ($($tr).hasClass('child')) {
                    $tr = $tr.prev('.parent');
                }
                var id = $(this).attr("data-id");

                $('#processForm').attr('action', '/processDeparture/' + id);
                $('#process_jadwal').modal('show')
            });

            table.on('click', '.delete', function() {
                $tr = $(this).closest('tr');
                if ($($tr).hasClass('child')) {
                    $tr = $tr.prev('.parent');
                }
                var id = $(this).attr("data-id");

                $('#deleteForm').attr('action', '/deleteDeparture/' + id);
                $('#delete_jadwal').modal('show')
            });

            table.on('click', '.finish', function() {
                $tr = $(this).closest('tr');
                if ($($tr).hasClass('child')) {
                    $tr = $tr.prev('.parent');
                }
                var id = $(this).attr("data-id");

                $('#finishForm').attr('action', '/finishDeparture/' + id);
                $('#finish_jadwal').modal('show')
            });

            $(function() {
                var rowCount = document.getElementById('departure').rows.length;
                for (var i = 1; i < rowCount; i++) {
                    var tag = document.getElementById("departure").rows[i].cells.item(7);
                    value = tag.innerText;
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
                var rowCount = document.getElementById('departure').rows.length;
                for (var i = 1; i < rowCount; i++) {
                    var tag = document.getElementById("departure").rows[i].cells.item(7);
                    var pButton = document.getElementById("departure").rows[i].cells.item(9);
                    var fButton = document.getElementById("departure").rows[i].cells.item(10);
                    value = tag.innerText;
                    if (value != 'Berangkat') {
                        fButton.innerHTML = "-";
                    }
                    else if (value == 'Berangkat'){
                        pButton.innerHTML = "-";
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
                document.getElementById('txt').innerHTML =  h + ":" + m + ":" + s;
                setTimeout(startTime, 1000);
            }

            function checkTime(i) {
                if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
                return i;
            }

            window.onload = startTime();
        });
    </script>
</div>
@endsection