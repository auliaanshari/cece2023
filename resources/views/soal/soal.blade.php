@extends('layout.app')
@extends('layout.header')
@extends('layout.sidenav')

@section('content')
    <div class="page-content-wrapper py-3">
        <div class="container">        
            <div class="card">
                <div class="card-header p-3">
                    <div class="row">
                        <div class="col-6">
                            <h5 class="ps-2">CRUD Soal</h5>
                        </div>
                        <div class="col-6 d-flex justify-content-end">
                            <button id="addSoal" class="btn m-1 btn-creative btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#modal_soal"><i class="bi bi-plus-circle"></i></button>
                        </div>
                    </div>    
                </div>
                <div class="card-body p-3">
                    <table class="w-100" id="table_soal">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Soal</th>
                                <th>Jawaban</th>
                                <th>Kategori Soal</th>
                                <th>Level Soal</th>
                                <th>Bobot</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="modal fade" id="modal_soal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="tambahSoalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h6 class="modal-title" id="tambahSoalLabel">Tambah Soal</h6>
                                <button class="btn btn-close p-1 ms-auto" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="#" id="form_soal">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label class="form-label" for="soal_input">Soal</label>
                                        <textarea class="form-control" id="soal_input" name="soal_input" cols="3" rows="5" placeholder="Write something..." required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="jawaban_input">Jawaban</label>
                                        <input class="form-control" id="jawaban_input" type="text" placeholder="..." required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="bobot_input">Bobot</label>
                                        <input class="form-control" id="bobot_input" type="number" placeholder="..." required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="kategori">Kategori Soal</label>
                                        <select class="form-select" id="kategori" name="kategori" aria-label="Kategori" required>
                                        <option value="">Pilih Kategori</option>
                                        <option value="1">Agama</option>
                                        <option value="2">BAM</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="level">Level Soal</label>
                                        <select class="form-select" id="level" name="level" aria-label="Level" required>
                                        <option value="">Pilih Level</option>
                                        <option value="1">Mudah</option>
                                        <option value="2">Menengah</option>
                                        <option value="3">Sulit</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="status">Status</label>
                                        <select class="form-select" id="status" name="status" aria-label="Status" required>
                                        <option value="">Pilih Status</option>
                                        <option value="1">Belum Dimainkan</option>
                                        <option value="2">Sudah Dimainkan</option>
                                        </select>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-sm btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                                        <button class="btn btn-sm btn-success" type="submit">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready( function () {
            function loadData() {
                $('#table_soal').dataTable({
                    "ajax": "{{ url('/soal/data') }}",
                            "columns": [
                                { "data": "id" },
                                { "data": "soal" },
                                { "data": "jawaban" },
                                { "data": "kategori_soal.kategori_soal" },
                                { "data": "level_soal.level_soal" },
                                { "data": "bobot" },
                                { "data": "status_soal.status_soal" },
                                {
                                    data: 'id',
                                    sClass: 'text-center',
                                    render: function(data) {
                                        return'<a href="#" data-id="'+data+'" id="edit" class="text-warning" title="edit"><i class="btn m-1 btn-creative btn-warning bi-pencil"></i> </a> &nbsp;'+
                                            '<a href="#" data-id="'+data+'" id="delete" class="text-danger" title="hapus"><i class="btn m-1 btn-creative btn-danger bi-trash"></i> </a>';
                                    },
                                }
                            ],
                    });
            } loadData();
            $(document).on('click', '#addSoal', function() {
                    $('#modal_soal').modal('show');
                    $('#form_soal').attr('action', '{{ url('soal/create') }}');
            });
            $('#form_soal').submit(function(e) {
                    e.preventDefault();
                    $.ajax({
                        url: $(this).attr('action')+'?_token='+'{{ csrf_token() }}',
                        type: 'post',
                        data: {
                            'soal_input': $('#soal_input').val(),
                            'jawaban_input': $('#jawaban_input').val(),
                            'bobot_input': $('#bobot_input').val(),
                            'kategori_input': $('#kategori').val(),
                            'level_input': $('#level').val(),
                            'status_input': $('#status').val(),
                        },
                        success :function () {
                            $('#table_soal').DataTable().destroy();
                            loadData();
                            $('#modal_soal').modal('hide');
                        },
                    });
            });
            $(document).on('click', '#edit', function() {
                    var data = $('#table_soal').DataTable().row($(this).parents('tr')).data();
                    $('#modal_soal').modal('show');
                    $('#soal_input').val(data.soal).change();
                    $('#jawaban_input').val(data.jawaban).change();
                    $('#bobot_input').val(data.bobot).change();
                    $('#kategori').val(data.kategori_id).change();
                    $('#level').val(data.level_id).change();
                    $('#status').val(data.status_id).change();
                    $('#form_soal').attr('action', '{{ url('soal/update') }}/'+data.id);
            });
            $('#modal_soal').on('hidden.bs.modal', function(e) {
                    $(this).find('#form_soal')[0].reset();
            });
            $(document).on('click', '#delete', function() {
                    var id = $(this).data('id');
                    if (confirm("Yakin ingin menghapus data?")){
                        $.ajax({
                            url : "{{ url('soal/delete') }}/"+id,
                            success :function () {
                                $('#table_soal').DataTable().destroy();
                                loadData();
                            }
                        })
                    }
            });
        } );
    </script>
@endsection