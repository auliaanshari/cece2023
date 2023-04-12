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
                            <h5 class="ps-2">CRUD Team</h5>
                        </div>
                        <div class="col-6 d-flex justify-content-end">
                            <button id="addTeam" class="btn m-1 btn-creative btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#modal_team"><i class="bi bi-plus-circle"></i></button>
                        </div>
                    </div>    
                </div>
                <div class="card-body p-3">
                    <table class="w-100" id="table_team">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama Team</th>
                                <th>Asal Masjid</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="modal fade" id="modal_team" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="tambahTeam" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h6 class="modal-title" id="tambahTeam">Tambah Team</h6>
                                <button class="btn btn-close p-1 ms-auto" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="#" id="form_team">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label class="form-label" for="team_input">Nama Team</label>
                                        <input class="form-control" id="team_input" type="text" placeholder="..." required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="asal_input">Asal Masjid</label>
                                        <input class="form-control" id="asal_input" type="text" placeholder="..." required>
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
                $('#table_team').dataTable({
                    "ajax": "{{ url('/team/data') }}",
                            "columns": [
                                { "data": "id" },
                                { "data": "nama_team" },
                                { "data": "asal_masjid" },
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
            $(document).on('click', '#addTeam', function() {
                    $('#modal_team').modal('show');
                    $('#form_team').attr('action', '{{ url('team/create') }}');
            });
            $('#form_team').submit(function(e) {
                    e.preventDefault();
                    $.ajax({
                        url: $(this).attr('action')+'?_token='+'{{ csrf_token() }}',
                        type: 'post',
                        data: {
                            'team_input': $('#team_input').val(),
                            'asal_input': $('#asal_input').val(),
                        },
                        success :function () {
                            $('#table_team').DataTable().destroy();
                            loadData();
                            $('#modal_team').modal('hide');
                        },
                    });
            });
            $(document).on('click', '#edit', function() {
                    var data = $('#table_team').DataTable().row($(this).parents('tr')).data();
                    $('#modal_team').modal('show');
                    $('#team_input').val(data.nama_team).change();
                    $('#asal_input').val(data.asal_masjid).change();
                    $('#form_team').attr('action', '{{ url('team/update') }}/'+data.id);
            });
            $('#modal_team').on('hidden.bs.modal', function(e) {
                    $(this).find('#form_team')[0].reset();
            });
            $(document).on('click', '#delete', function() {
                    var id = $(this).data('id');
                    if (confirm("Yakin ingin menghapus data?")){
                        $.ajax({
                            url : "{{ url('team/delete') }}/"+id,
                            success :function () {
                                $('#table_team').DataTable().destroy();
                                loadData();
                            }
                        })
                    }
            });
        } );
    </script>
@endsection