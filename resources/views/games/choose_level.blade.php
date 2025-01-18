@extends('layouts.master')

@section('title')
    {{$game->name}} Choose Level
@endsection

@section('background')
  class="list_bg" style="background: url('{{ asset('images/games_show_bg.JPEG') }}') no-repeat center center fixed; background-size: cover;"
@endsection

@section('content')
<body class="list_bg">
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="col-lg-6 enrolments-box rounded shadow" style="padding: 1cm">
            <h1 class="heading text-center">Choose Level</h1>

            @if($levels->isEmpty())
                <p class="text-center">You are not teaching any levels yet.</p>
            @else
                <form action="{{ route('games.rolecall', $game->id) }}" method="GET">
                    @csrf

                    <div class="form-group mb-4">
                        <label for="level" class="fw-bold">Select a Level:</label>
                        <select name="level_id" id="level_id" class="form-control" required>
                            @foreach ($levels as $level)
                                <option value="{{ $level->id }}">{{ $level->name }} ({{ $level->level_code }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn teamsedit-btn">Proceed</button>
                    </div>
                </form>
            @endif
        </div>
    </div>
</body>
@endsection
