@extends('adminlte::page')

@section('title', 'Home')

@section('content_header')
    <h1>Dashboard</h1>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
@stop

@section('content')
    <div class="row">
        <div class="col-4">
            <x-adminlte-small-box title="Fichas" text="{{ $countPeople }}" icon="fas fa-address-card text-white"
                url="{{ route('people.index') }}" theme="teal" />
        </div>
        <div class="col-4">
            <x-adminlte-small-box title="Campistas" text="{{ $countCampers }}" icon="fas fa-users  text-white"
                theme="info" />
        </div>
        <div class="col-4">
            <x-adminlte-small-box title="Acampamentos" text="{{ $countCamps }}" icon="fas fa-campground text-white"
                url="{{ route('camp.index') }}" theme="dark" />
        </div>
    </div>
    <div class="card">
        <div class="card-header">Calendário de acampamentos</div>
        <div class="card-body">
            <div class="row">
                <div class="col-5">
                    @if (isset($nextCamp))
                        {
                        @php
                            $dataInicio = new DateTime($nextCamp->date_start);
                            $dataFim = new DateTime($nextCamp->date_end);
                            $today = new DateTime(date('Y-m-d'));
                            $dias = $today->diff($dataInicio);
                        @endphp
                        <x-adminlte-card title="Próximo Acampamento - {{ $dias->days }} dias" theme="lightblue"
                            theme-mode="outline" icon="fas fa-lg fa-calendar-check"
                            header-class="text-uppercase rounded-bottom border-info" collapsible>
                            <div class="row">
                                <label class="text-center"><a
                                        href="{{ route('camp.view', $nextCamp->id) }}">{{ $nextCamp->name }}</a></label>
                                <label>Data de início: {{ $dataInicio->format('d/m/Y') }}</label>
                                <label>Data de Término: {{ $dataFim->format('d/m/Y') }}</label>
                            </div>
                        </x-adminlte-card>
                        }
                    @endif
                </div>
                <div class="col-7">
                    <x-adminlte-card title="Calendário" theme="lightblue" theme-mode="outline" icon="fas fa-lg fa-calendar"
                        header-class="text-uppercase rounded-bottom border-info" collapsible>
                        <div id='calendar'></div>
                    </x-adminlte-card>
                </div>
            </div>

        </div>
    </div>

@stop
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/locale-all.min.js"
        integrity="sha512-L0BJbEKoy0y4//RCPsfL3t/5Q/Ej5GJo8sx1sDr56XdI7UQMkpnXGYZ/CCmPTF+5YEJID78mRgdqRCo1GrdVKw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $(function() {

            // page is now ready, initialize the calendar...

            $('#calendar').fullCalendar({
                locale: 'pt-br',
                editable: false,
                events: [
                    @foreach ($camps as $camp)
                        {
                            title: '{{ $camp->name }}',
                            start: '{{ $camp->date_start }}',
                            end: '{{ $camp->date_end }}',
                            url: '{{ route('camp.view', $camp->id) }}'
                        },
                    @endforeach
                ]
            })

        });
    </script>
@stop
