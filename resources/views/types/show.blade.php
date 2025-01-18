@extends('layouts.master')

@section('title')
    {{$type->name}} Show
@endsection

@section('background')
  class="list_bg" style="background: url('{{ asset('images/fairy_bg.jpg') }}') no-repeat center center fixed; background-size: cover;"
@endsection


@section('content')
<body class="list_bg">
    <div class="container my-5">
        <div class="row position-relative">
            <div class="col-lg-12">
                <h1 class="heading" style="font-size:1cm">{{ $type->type_code }} - {{ $type->name }}</h1>
                <p class="lead ">{{ $type->description }}</p>
            </div>
        </div>
    <br>
        <div class="row position-relative">
            <div class="col-lg-10">
                <div class="enrolments-box p-4">
                    <p class="fw-bold heading" style="font-size:0.7cm; color: #7c8eb0">COACHES</p>
                    <ul class="list-group list-group-flush">
                        @foreach($coaches as $coach)
                            <li class="list-group-item"><p style="text-indent: 30px; height: 9px"><img src="{{ asset('images/pokeball.png') }}" class="img" alt="Image" style="height:18px; width:18px">
                            {{ $coach->name }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-lg-2">
                <img src="{{ asset('images/wigglytuff.png') }}" class="wigglytuff" alt="Image">
            </div>
        </div>
        <br><br><br>
        <div class="row position-relative">
            <div class="col-lg-2">
                <img src="{{ asset('images/sylveon.png') }}" class="sylveon" alt="Image">
            </div>
            <div class="col-lg-10 text-end">
                <div class="enrolments-box p-4">
                    <p class="fw-bold heading" style="font-size:0.7cm; color: #7c8eb0">LEVELS</p>
                    <ul class="list-group list-group-flush">
                        @foreach ($levels as $level)
                            <li class="list-group-item">
                                <p style="text-indent: 40px; height: 9px">
                                <a href="{{ route('levels.show', $level->id) }}" class="text-muted">
                                    {{ $level->level_code }}: {{ $level->name }}
                                </a>
                                <img src="{{ asset('images/pokeball.png') }}" class="img" alt="Image" style="height:18px; width:18px">
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <br><br><br>
        <div class="row position-relative">
            <div class="col-lg-10">
                <div class="enrolments-box p-4">
                    <p class="fw-bold heading" style="font-size:0.7cm; color: #7c8eb0">GAMES</p>
                    @if ($type->games->isEmpty())
                        <p>There are no games yet.</p>
                    @else
                        <ul class="list-group list-group-flush">
                            @foreach($type->games as $game)
                                <li class="list-group-item">
                                    <p style="text-indent: 30px; height: 9px"><img src="{{ asset('images/pokeball.png') }}" class="img" alt="Image" style="height:18px; width:18px">
                                    <a href="{{ route('games.show', $game->id) }}" class="text-muted">
                                        {{ $game->title }} (Due: {{ $game->due_date->format('d/m/Y') }})
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                    @auth
                        @if (auth()->user()->role == 'coach')
                            <br>
                            <a href="{{ route('games.create', ['type_id' => $type->id]) }}" class="btn typeshow-btn">Add New Game</a>
                        @endif
                    @endauth
                </div>
            </div>
            <div class="col-lg-2">
                <img src="{{ asset('images/clefairy.png') }}" class="clefairy" alt="Image">
            </div>
        </div>
    </div>
    <br><br><br>
</body>
@endsection