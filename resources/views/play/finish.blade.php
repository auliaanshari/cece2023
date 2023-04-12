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
                            <h5 class="ps-2">Register Game</h5>
                        </div>
                        <div class="col-6 text-sm-right">
                            <button id="pindah" class="btn m-1 btn-creative btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#konfirm_pindah"><i class="bi bi-plus-circle"></i></button>
                        </div>
                        <div class="modal fade" id="konfirm_pindah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title" id="konfirmpindah">Konfirmasi</h6>
                                        <button class="btn btn-close p-1 ms-auto" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="#" id="form_pindah">
                                        <p class="mb-0">Anda akan berpindah ke halaman CRUD Team. Apakah anda setuju?.</p>
                                        <div class="modal-footer">
                                            <button class="btn btn-sm btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                                            <button class="btn btn-sm btn-success" type="submit">Setuju</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>    
                </div>
                <div class="card-body p-3">
                    <form action="#" id="form_regist">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="form-label" for="ronde">Ronde</label>
                            <select class="form-select" id="ronde" name="ronde" aria-label="Ronde" required>
                                <option value="">Pilih Ronde</option>
                                <option value="1">Penyisihan</option>
                                <option value="2">Semi Final</option>
                                <option value="3">Final</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="teamA">Team A</label>
                            <select class="form-select" id="teamA" name="teamA" aria-label="Team A" required>
                                <option value="">Pilih Team</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="teamB">Team B</label>
                            <select class="form-select" id="teamB" name="teamB" aria-label="Team B" required>
                                <option value="">Pilih Team</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="teamC">Team C</label>
                            <select class="form-select" id="teamC" name="teamC" aria-label="Team C">
                                <option value="">Pilih Team</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button id="reset" class="btn btn-creative btn-secondary" type="button">Reset</button>
                            <button id="mulai" class="btn m-1 btn-creative btn-success" type="button" data-bs-toggle="modal" data-bs-target="#konfirm_mulai">Mulai Game</button>
                        </div>
                    </form>
                </div>
                <div class="modal fade" id="konfirm_mulai" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h6 class="modal-title" id="konfirmmulai">Konfirmasi</h6>
                                <button class="btn btn-close p-1 ms-auto" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="#" id="form_mulai">
                                    <p class="mb-0">Permainan akan dimulai dengan team sebagai berikut : . Apakah anda setuju?.</p>
                                    <div class="modal-footer">
                                        <button class="btn btn-sm btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
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
            $(document).on('click', '#pindah', function() {
                    $('#konfirm_pindah').modal('show');
                    $('#form_pindah').attr('action', '{{ url('team/') }}');
            });
            $(document).on('click', '#mulai', function() {
                    $('#konfirm_mulai').modal('show');
                    $('#form_mulai').attr('action', '{{ url('game/sisih') }}');
            });
            $(document).ready(function(){
                $("#reset").click(function(){
                    $("#form_regist").trigger("reset");
                });
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