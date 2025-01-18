@extends('layouts.master')

@section('title')
  Teams Create
@endsection

@section('background')
  class="list_bg" style="background: url('{{ asset('images/games_show_bg.JPEG') }}') no-repeat center center fixed; background-size: cover;"
@endsection

@section('content')
<body class="list_bg">
    <div class="container mt-5">
        <div class="row justify-content-center align-items-center mt-3">
            <div class="col-lg-8 enrolments-box rounded shadow">
                <h1 class="heading">Edit Teams for {{ $game->title }}</h1>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="team mb-5">
                    <h2 class="mb-3">{{ $team->name }}</h2>
                    <h4>Current Players:</h4>
                        <table style="width: 100%; border-collapse: collapse; background-color: transparent;">
                            <tbody>
                                @foreach ($team->players as $player)
                                    <tr>
                                        <td style="text-align: left; vertical-align: middle; padding: 10px; border: none;">
                                            {{ $player->name }} ({{ $player->gamer_id }})
                                        </td>
                                        <td style="text-align: right; vertical-align: middle; padding: 10px; border: none;">
                                            <form action="{{ route('teams.remove_player', ['team_id' => $team->id, 'player_id' => $player->id]) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <h4>Add New Player:</h4>
                    <form action="{{ route('teams.add_player', ['team_id' => $team->id]) }}" method="POST" class="d-flex align-items-center mb-4" style="width:22cm">
                        @csrf
                        <select name="player_id" class="form-select me-2" required>
                            <option disabled selected>Select a player</option>
                            @foreach ($availablePlayers as $player)
                                <option value="{{ $player->id }}">{{ $player->name }} ({{ $player->gamer_id }})</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn teamsedit-btn" style="width:4cm; height:1cm; font-size:medium; text-center">Add Player</button>
                    </form>
                    <a href="{{ route('games.show', $game->id) }}" class="btn btn-secondary mb-3">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>
            </div>
        </div>
    </div><br><br><br>
</body>

@endsection
