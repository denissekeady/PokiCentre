@extends('layouts.master')

@section('title')
    {{$game->name}} Rollcall
@endsection

@section('background')
  class="list_bg" style="background: url('{{ asset('images/games_show_bg.JPEG') }}') no-repeat center center fixed; background-size: cover;"
@endsection

@section('content')
<body class="list_bg">
    <div class="container my-5">
        <h1 class="heading" style="font-size:1.3cm; text-align: center;">Rollcall for Game: {{ $game->title }}</h1>
        <h2 class="lead text-center" style="font-size:1cm;">Level: {{ $level->name }}</h2>

        <form action="{{ route('games.generate_teams', $game->id) }}" method="POST">
            @csrf
            <input type="hidden" name="level_id" value="{{ $level->id }}">
            <div class="form-group enrolments-box rounded shadow-sm mb-4">
                <label class="fw-bold" style="font-size: 1.1rem;">Select Players for this Game:</label>
                <ul class="list-group">
                    @foreach ($players as $player)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input me-2" name="players[]" value="{{ $player->id }}">
                                {{ $player->name }} ({{ $player->gamer_id }})
                            </label>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="form-group enrolments-box rounded shadow-sm mb-4">
                <label class="fw-bold" style="font-size: 1.1rem;">Add Other Players from the Same Type:</label>
                <ul class="list-group">
                    @foreach ($otherPlayers as $player)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input me-2" name="additional_players[]" value="{{ $player->id }}">
                                {{ $player->name }} ({{ $player->gamer_id }})
                            </label>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Generate Teams Button -->
            <div class="text-center">
                <button type="submit" class="btn teamsedit-btn" style="font-size: 1.2rem;">Generate Teams</button>
            </div>
        </form>
    </div>
    <br><br><br>
</body>

@endsection
