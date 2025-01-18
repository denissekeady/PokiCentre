@extends('layouts.master')

@section('title')
  Levels
@endsection

@section('background')
  class="list_bg" style="background: url('{{ asset('images/greninja_bg.jpg') }}') no-repeat center center fixed; background-size: cover;"
@endsection

@section('content')
<body class="list_bg">
    <div class="container mt-5">
        <div class="text-center mb-4">
            <h1 class="display-4">{{ $level->name }}</h1>
            <p class="lead">{{ $level->description }}</p>
        </div>

        <div class="card mb-4" style="background-color: rgba(255, 255, 255, 0.8);">
            <div class="card-body">
                <h3 class="card-title"><strong>Coach</strong></h3>
                <p class="card-text">{{ $coach->name }}</p>
            </div>
        </div>

        <div class="card mb-4" style="background-color: rgba(255, 255, 255, 0.8);">
            <div class="card-body">
                <h3 class="card-title"><strong>Players</strong></h3>
                @if (!$players->isEmpty())
                    <ul class="list-group list-group-flush">
                        @foreach ($players as $player)
                            <li class="list-group-item d-flex justify-content-between align-items-center" style="background-color: rgba(255, 255, 255, 0.7);">
                                <a href="{{ route('reviews.index', $player->id) }}" class="text-decoration-none">
                                    {{ $player->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-muted">There are no players yet.</p>
                @endif
            </div>
        </div>
    </div><br><br>
</body>

@endsection