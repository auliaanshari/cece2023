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
                            <h5 class="ps-2">ID Game : <span id="game_id" data-id="{{ $game }}">{{ $game }}</span></h5>
                        </div>
                        <div class="col-6 text-sm-right d-flex justify-content-end">
                            <button id="score" class="btn m-1 btn-creative btn-info" type="button" data-bs-toggle="modal" data-bs-target="#modal_score">Score</button>
                            <button id="finish" class="btn m-1 btn-creative btn-warning" type="button" data-bs-toggle="modal" data-bs-target="#konfirm_finish">Finish</button>
                        </div>
                        <div class="modal fade" id="modal_score" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title" id="modalscore">Score</h6>
                                        <button class="btn btn-close p-1 ms-auto" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body ">
                                        <form action="#" id="form_score">
                                            <table id="table_score" class="table table-striped text-center">
                                                <thead>
                                                    <tr class="table-primary fs-4">
                                                        <th></th>
                                                        <th>{{$scores[1]->nama_team}}</th>s
                                                        <th>{{$scores[2]->nama_team}}</th>
                                                        <th>{{$scores[3]->nama_team}}</th>
                                                        <th>{{$scores[0]->nama_team}}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <th>Point</th>
                                                        <td  class="{{ $scores[1]->nilai != 0 ? 'bg-danger text-light rounded' : '' }} fs-3">{{$scores[1]->nilai}}</td>
                                                        <td  class="{{ $scores[2]->nilai != 0 ? 'bg-warning text-light rounded' : '' }} fs-3">{{$scores[2]->nilai}}</td>
                                                        <td  class="{{ $scores[3]->nilai != 0 ? 'bg-success text-light rounded' : '' }} fs-3">{{$scores[3]->nilai}}</td>
                                                        <td  class="{{ $scores[0]->nilai != 0 ? 'bg-secondary text-light rounded' : '' }} fs-3">{{$scores[0]->nilai}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Total Bonus</th>
                                                        <td class="{{ $scores[1]->bonus != 0 ? 'bg-danger text-light rounded' : '' }} fs-3"><div id="bonus{{$tim1}}" data-nbonus="{{$scores[1]->bonus}}">{{ $scores[1]->bonus }}</div></td>
                                                        <td class="{{ $scores[2]->bonus != 0 ? 'bg-warning text-light rounded' : '' }} fs-3"><div id="bonus{{$tim2}}" data-nbonus="{{$scores[2]->bonus}}">{{ $scores[2]->bonus }}</div></td>
                                                        <td class="{{ $scores[3]->bonus != 0 ? 'bg-success text-light rounded' : '' }} fs-3"><div id="bonus{{$tim3}}" data-nbonus="{{$scores[3]->bonus}}">{{ $scores[3]->bonus }}</div></td>
                                                        <td class="{{ $scores[0]->bonus != 0 ? 'bg-secondary text-light rounded' : '' }} fs-3"><div id="bonus{{$tim4}}" data-nbonus="{{$scores[0]->bonus}}">{{ $scores[0]->bonus }}</div></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Tambah Bonus</th>
                                                        <td>
                                                            <button type="button" onclick="modal_konfirm({{ $tim1 }},'{{$scores[1]->nama_team}}',300)" id="plusbonus" class="btn btn-sm text-light btn-success" data-bs-toggle="modal" data-bs-target="#bonus_konfirm">+3</button>
                                                            <button type="button" onclick="modal_konfirm({{ $tim1 }},'{{$scores[1]->nama_team}}',400)" id="plusbonus" class="btn btn-sm text-light btn-warning" data-bs-toggle="modal" data-bs-target="#bonus_konfirm">+4</button>
                                                            <button type="button" onclick="modal_konfirm({{ $tim1 }},'{{$scores[1]->nama_team}}',500)" id="plusbonus" class="btn btn-sm text-light btn-danger" data-bs-toggle="modal" data-bs-target="#bonus_konfirm">+5</button>
                                                        </td>
                                                        <td>
                                                            <button type="button" onclick="modal_konfirm({{ $tim2 }},'{{$scores[2]->nama_team}}',300)" id="plusbonus" class="btn btn-sm text-light btn-success" data-bs-toggle="modal" data-bs-target="#bonus_konfirm">+3</button>
                                                            <button type="button" onclick="modal_konfirm({{ $tim2 }},'{{$scores[2]->nama_team}}',400)" id="plusbonus" class="btn btn-sm text-light btn-warning" data-bs-toggle="modal" data-bs-target="#bonus_konfirm">+4</button>
                                                            <button type="button" onclick="modal_konfirm({{ $tim2 }},'{{$scores[2]->nama_team}}',500)" id="plusbonus" class="btn btn-sm text-light btn-danger" data-bs-toggle="modal" data-bs-target="#bonus_konfirm">+5</button>
                                                        </td>
                                                        <td>
                                                            <button type="button" onclick="modal_konfirm({{ $tim3 }},'{{$scores[3]->nama_team}}',300)" id="plusbonus" class="btn btn-sm text-light btn-success" data-bs-toggle="modal" data-bs-target="#bonus_konfirm">+3</button>
                                                            <button type="button" onclick="modal_konfirm({{ $tim3 }},'{{$scores[3]->nama_team}}',400)" id="plusbonus" class="btn btn-sm text-light btn-warning" data-bs-toggle="modal" data-bs-target="#bonus_konfirm">+4</button>
                                                            <button type="button" onclick="modal_konfirm({{ $tim3 }},'{{$scores[3]->nama_team}}',500)" id="plusbonus" class="btn btn-sm text-light btn-danger" data-bs-toggle="modal" data-bs-target="#bonus_konfirm">+5</button>
                                                        </td>
                                                        <td>
                                                            <button type="button" onclick="modal_konfirm({{ $tim4 }},'{{$scores[0]->nama_team}}',300)" id="plusbonus" class="btn btn-sm text-light btn-success" data-bs-toggle="modal" data-bs-target="#bonus_konfirm">+3</button>
                                                            <button type="button" onclick="modal_konfirm({{ $tim4 }},'{{$scores[0]->nama_team}}',400)" id="plusbonus" class="btn btn-sm text-light btn-warning" data-bs-toggle="modal" data-bs-target="#bonus_konfirm">+4</button>
                                                            <button type="button" onclick="modal_konfirm({{ $tim4 }},'{{$scores[0]->nama_team}}',500)" id="plusbonus" class="btn btn-sm text-light btn-danger" data-bs-toggle="modal" data-bs-target="#bonus_konfirm">+5</button>
                                                        </td>
                                                    </tr>
                                                    <tr class="table-dark fs-1 text-light">
                                                        <th>Total</th>
                                                        <td>{{$scores[1]->total}}</td>
                                                        <td>{{$scores[2]->total}}</td>
                                                        <td>{{$scores[3]->total}}</td>
                                                        <td>{{$scores[0]->total}}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <div class="modal-footer">
                                                <button class="btn btn-sm btn-secondary" type="button" data-bs-dismiss="modal">Keluar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="bonus_konfirm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title" id="konfirmbonus">Konfirmasi</h6>
                                        <button class="btn btn-close p-1 ms-auto" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="#" id="form_bonus">
                                            <p class="mb-0">Bonus akan ditambahkan dengan rincian sebagai berikut : </p><br>
                                            <div> Team : <span id="teamBon"></span></div>
                                            <div> Jumlah Bonus : <span id="jmlBon"></span></div>
                                            <p>Apakah anda ingin melanjutkan?.</p>
                                            <div class="modal-footer">
                                                <button class="btn btn-sm btn-secondary" type="button" data-bs-toggle="modal" data-bs-target="#modal_score">Cancel</button>
                                                <button class="btn btn-sm btn-success" type="submit">Setuju</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="modal fade" id="konfirm_finish" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title" id="konfirmfinish">Konfirmasi</h6>
                                        <button class="btn btn-close p-1 ms-auto" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="#" id="form_finish">
                                            <h5 class="mb-0">Permainan akan diselesaikan dengan rincian sebagai berikut : </h5>
                                            <div class="row px-5">
                                                <div> Babak : <span>{{ $ronde->ronde}}</span></div>
                                                <div> Game ID : <span>{{ $game }}</span></div>
                                                <div> {{$scores[3]->nama_team}} : <span>{{$scores[3]->total}}</span></div>
                                                <div> {{$scores[2]->nama_team}} : <span>{{$scores[2]->total}}</span></div>
                                                <div> {{$scores[1]->nama_team}} : <span>{{$scores[1]->total}}</span></div>
                                                <div> {{$scores[0]->nama_team}} : <span>{{$scores[0]->total}}</span></div><br>
                                            </div>
                                            
                                            <div class="modal-footer">
                                                <b>Apakah anda ingin melanjutkan?</b>
                                                <button class="btn btn-sm btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                                                <button id="setujufinish" class="btn btn-sm btn-danger" type="button">Setuju</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="pilih_team" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        {{--<h6 class="modal-title fs-2" id="pilihteam">Pilih Team</h6>--}}
                                        <button class="btn btn-close p-1 ms-auto d-flex justify-content-end" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body mb-2">
                                        <form action="#" id="form_pilih">
                                            <p class="mb-0 fs-3">Pilih team yang akan menjawab : </p>
                                            <div class="row d-flex justify-content-center">
                                                <button id="{{ $tim1 }}" onclick="pilihTeam({{ $tim1 }})" class="btn col-2 mx-2 py-2 fs-1 btn-creative btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#modal_soal">A</button>
                                                <button id="{{ $tim2 }}" onclick="pilihTeam({{ $tim2 }})" class="btn col-2 mx-2 py-2 fs-1 btn-creative text-light btn-warning" type="button" data-bs-toggle="modal" data-bs-target="#modal_soal">B</button>
                                                <button id="{{ $tim3 }}" onclick="pilihTeam({{ $tim3 }})" class="btn col-2 mx-2 py-2 fs-1 btn-creative btn-success" type="button" data-bs-toggle="modal" data-bs-target="#modal_soal">C</button>
                                                <button id="{{ $tim4 }}" onclick="pilihTeam({{ $tim4 }})" class="btn col-2 mx-2 py-2 fs-1 btn-creative btn-secondary" type="button" data-bs-toggle="modal" data-bs-target="#modal_soal">P</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="modal_soal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title" id="modalsoal">ID Soal : <span id="idsoal"></span></h6>
                                        <button class="btn btn-close p-1 ms-auto" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="#" id="form_soal">
                                            <h4 class="mb-0"><span id="soalnya"></span></h4>
                                            <div class="d-flex justify-content-center">
                                                <button class="btn btn-lg bg-warning my-3 text-light" id="countdown" style="font-size: 30px;">10s</button>
                                            </div>
                                            <h5 class="mb-0" >Jawaban : <span class="d-none" id="jawaban"></span></h5>
                                        </div>
                                        <div class="modal-footer d-flex justify-content-between">
                                            <div>
                                                <button id="star" onclick="startTimer()" class="btn m-1 btn-creative btn-warning text-light">Mulai Hitung</button>
                                                <button id="stop" class="btn d-none m-1 btn-creative btn-danger text-light">Stop</button>
                                            </div>
                                            <div>
                                                <button id="lihat" class="btn m-1 btn-creative btn-secondary" type="button"><span id="showAnswer">Lihat Jawaban</span><span class="d-none" id="hideAnswer">Sembunyikan</span></button>
                                                <button id="benar" class="btn m-1 btn-creative btn-success" type="button" data-bs-toggle="modal" data-bs-target="#modal_benar">Benar</button>
                                                <button id="salah" class="btn m-1 btn-creative btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#modal_salah">Salah</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="modal_benar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header d-flex justify-content-center">
                                        <h1>Benar</h1>
                                    </div>
                                    <div class="modal-body">
                                        <form action="#" id="form_benar">
                                            <div class="d-flex justify-content-center">
                                                <img class="mb-2" src="{{ asset('img/true.gif') }}" alt="">
                                                <!-- <lottie-player src="https://assets4.lottiefiles.com/temp/lf20_hT22rr.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px;"  loop  autoplay></lottie-player> -->
                                            </div>
                                            <div class="d-flex justify-content-center">
                                                <button class="btn btn-success" type="submit">OK!</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="modal_salah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header d-flex justify-content-center">
                                        <h1 id="judulmod">Salah</h1>
                                    </div>
                                    <div class="modal-body">
                                        <form action="#" id="form_salah">
                                            <div class="d-flex justify-content-center">
                                                <img class="mb-2" src="{{ asset('img/false.gif') }}" alt="">
                                                <!-- <lottie-player src="https://assets2.lottiefiles.com/packages/lf20_geewpiaj.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px;" loop autoplay></lottie-player> -->
                                            </div>
                                            <div class="d-flex justify-content-center">
                                                <button id="kembali" class="btn btn-sm btn-warning" type="button" data-bs-toggle="modal" data-bs-target="#pilih_team">Kembali</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>    
                </div>
                <div class="card-body p-3">
                    <div class="row d-flex justify-content-center">
                        @php
                            $no = 1;
                        @endphp
                        @foreach($soal as $so)
                            <div class="col-2 py-2 m-1 rounded 
                            @if ($so->team_id==$tim1)
                                bg-danger
                            @elseif ($so->team_id==$tim2)
                                bg-warning
                            @elseif($so->team_id==$tim3)
                                bg-success
                            @elseif($so->team_id==$tim4)
                                bg-secondary
                            @else
                                bg-primary
                            @endif" 
                            @if ($so->team_id!=NULL)
                                disabled
                            @else
                                onclick="pilihSoal({{ $so->id }})" data-bs-toggle="modal" data-bs-target="#pilih_team"
                            @endif
                                >
                                <h1 id="{{$so->id}}" class="text-light text-center py-3 my-2">{{ $no++ }}</h1>
                            </div>
                        @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    
@endsection

@section('js')
    <script>
        function pilihSoal($id){
            soalid = $id;
            console.log(soalid);
            $(document).ready( function (){
                $.ajax({
                    url: '{{ url('soal/pilihsoal') }}/'+soalid,
                    dataType: "json",
                    success: function(data) {
                        var soal = jQuery.parseJSON(JSON.stringify(data));
                        $.each(soal, function(k, v) {
                            $('#idsoal').html(v.id);
                            $('#soalnya').html(v.soal);
                            $('#jawaban').html(v.jawaban);
                        })
                    }
                });
            })
        };

        function pilihTeam($id){
            teamid = $id;
            console.log("team : "+teamid);
            console.log("soal : "+soalid);
            gameid = $('#game_id').data("id");
            console.log(gameid);
        };

        function modal_konfirm($id,$nama,$bonus){
            teamid = $id;
            namateam = $nama;
            gameid = $('#game_id').data("id");
            data = $('#bonus'+teamid).data('nbonus');
            bonus = $bonus;
            total_bonus = data + bonus;
            console.log(data);
            console.log(bonus);
            console.log(total_bonus);

        };

        var countdownIntervalId;
        function startTimer() {

            $("#stop").toggleClass("d-none");
            $("#star").toggleClass("d-none");
            var countDownSeconds = 11;

            countdownIntervalId = setInterval(function() {
                countDownSeconds--;
                let countdowns = document.getElementById("countdown");
                countdowns.innerHTML = countDownSeconds + "s";
                if (countDownSeconds < 1) {
                    clearInterval(countdownIntervalId);
                    $('#modal_soal').modal('hide');
                    $('#modal_salah').modal('show');
                    countdowns.innerHTML = "10s";
                }
            }, 1000);

        }

        
        $(document).ready( function () {

            $("#stop").click(function(){
                clearInterval(countdownIntervalId);
                $("#stop").toggleClass("d-none");
                $("#star").toggleClass("d-none");
            });
            
            $("#lihat").click(function(){
                $("#jawaban").toggleClass("d-none");
                $("#showAnswer").toggleClass("d-none");
                $("#hideAnswer").toggleClass("d-none");
                clearInterval(countdownIntervalId);
            });
    
            $("#salah").click(function(){
                clearInterval(countdownIntervalId);
            });
            
            $(document).on('click', '#benar', function() {
                clearInterval(countdownIntervalId);    
                $('#modal_benar').modal('show');
                $('#form_benar').attr('action', '{{ url('play/benar') }}');
            });
            $('#form_benar').submit(function(e) {
                    e.preventDefault();
                    $.ajax({
                        url: $(this).attr('action')+'?_token='+'{{ csrf_token() }}',
                        type: 'post',
                        data: {
                            'game_input': gameid,
                            'team_input': teamid,
                            'soal_input': soalid,
                        },
                        success :function () {
                            window.location.href='{{ url('play/main') }}/'+gameid;
                        },
                    });
            });

            $(document).on('click', '#plusbonus', function() {
                    $('#bonus_konfirm').modal('show');
                    $('#teamBon').text(namateam);
                    $('#jmlBon').text(bonus);
                    $('#form_bonus').attr('action', '{{ url('play/bonus') }}/'+teamid);
            });

            $('#form_bonus').submit(function(e) {
                    e.preventDefault();
                    $.ajax({
                        url: $(this).attr('action')+'?_token='+'{{ csrf_token() }}',
                        type: 'post',
                        data: {
                            'game_input': gameid,
                            'team_input': teamid,
                            'bonus_input': total_bonus,
                        },
                        success :function () {
                            alert('Bonus telah ditambahkan.');
                            window.location.href='{{ url('play/main') }}/'+gameid;
                        },
                    });
            });

            

            $(document).on('click', '#finish', function() {
                    $('#konfirm_finish').modal('show');
            });

            $(document).on('click', '#setujufinish', function() {
                window.location.href='{{ url('play') }}/';
            });

            // $(document).on('click', '#delete', function() {
            //         var id = $(this).data('id');
            //         if (confirm("Yakin ingin menghapus data?")){
            //             $.ajax({
            //                 url : "{{ url('team/delete') }}/"+id,
            //                 success :function () {
            //                     $('#table_team').DataTable().destroy();
            //                     loadData();
            //                 }
            //             })
            //         }
            // });

        } );
    </script>
@endsection