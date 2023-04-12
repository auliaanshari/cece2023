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
                            <h5 class="ps-2">CRUD Game</h5>
                        </div>
                        <div class="col-6 d-flex justify-content-end">
                            <button id="addGame" class="btn m-1 btn-creative btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#modal_game"><i class="bi bi-plus-circle"></i></button>
                        </div>
                    </div>    
                </div>
                <div class="card-body p-3">
                    <table class="w-100" id="table_game">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Game Ke</th>
                                <th>Ronde</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="modal fade" id="modal_game" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="tambahGameLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h6 class="modal-title" id="tambahGameLabel">Tambah Game</h6>
                                <button class="btn btn-close p-1 ms-auto" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="#" id="form_game">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label class="form-label" for="game_input">Game Ke</label>
                                        <input class="form-control" id="game_input" type="number" placeholder="..." required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="ronde">Ronde</label>
                                        <select class="form-select" id="ronde" name="ronde" aria-label="Kategori" required>
                                            <option value="">Pilih Ronde</option>
                                            <option value="1">Penyisihan</option>
                                            <option value="2">Semi Final</option>
                                            <option value="3">Final</option>
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
                $('#table_game').dataTable({
                    "ajax": "{{ url('/game/data') }}",
                            "columns": [
                                { "data": "id" },
                                { "data": "game_ke" },
                                { "data": "ronde.ronde" },
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
            $(document).on('click', '#addGame', function() {
                    $('#modal_game').modal('show');
                    $('#form_game').attr('action', '{{ url('game/create') }}');
            });
            $('#form_game').submit(function(e) {
                    e.preventDefault();
                    $.ajax({
                        url: $(this).attr('action')+'?_token='+'{{ csrf_token() }}',
                        type: 'post',
                        data: {
                            'game_input': $('#game_input').val(),
                            'ronde_input': $('#ronde').val(),
                        },
                        success :function () {
                            $('#table_game').DataTable().destroy();
                            loadData();
                            $('#modal_game').modal('hide');
                        },
                    });
            });
            $(document).on('click', '#edit', function() {
                    var data = $('#table_game').DataTable().row($(this).parents('tr')).data();
                    $('#modal_game').modal('show');
                    $('#game_input').val(data.game_ke).change();
                    $('#ronde').val(data.ronde_id).change();
                    $('#form_game').attr('action', '{{ url('game/update') }}/'+data.id);
            });
            $('#modal_game').on('hidden.bs.modal', function(e) {
                    $(this).find('#form_game')[0].reset();
            });
            $(document).on('click', '#delete', function() {
                    var id = $(this).data('id');
                    if (confirm("Yakin ingin menghapus data?")){
                        $.ajax({
                            url : "{{ url('game/delete') }}/"+id,
                            success :function () {
                                $('#table_game').DataTable().destroy();
                                loadData();
                            }
                        })
                    }
            });
        } );
    </script>
@endsection