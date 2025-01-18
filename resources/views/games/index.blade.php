@extends('layouts.master')

@section('title')
  {{ $user->name }} Games
@endsection

@section('background')
  class="list_bg" style="background: url('images/games_index_bg.jpg') no-repeat center center fixed;"
@endsection

@section('content')
<body class="list_bg">
  <div class="container my-5" style="max-width: 1400px; z-index: 2;">
    <div class="row">
      <div class="col-lg-12">
        @if (auth()->user()->role == 'player')
          <h2 class="logofont" style="font-size:1cm">{{ $user->name }}'s Enrolled Games</h2>
        @elseif (auth()->user()->role == 'coach')
          <h2 class="logofont" style="font-size:1cm">{{ $user->name }}'s Coached Games</h2>
        @endif
      </div>
      <div class="row mt-4">
        <div class="col-md-12">
          @foreach ($typesWithGames as $type)
            <div class="card border-0 border-bottom" style="background: linear-gradient(to right, rgba(255, 255, 255, 1) 10%, rgba(255, 255, 255, 0) 100%);">
              <div class="card-body">
                <h3 class="card-title heading" style="font-size:0.7cm">{{ $type->type_code }} - {{ $type->name }}</h3>
                
                @foreach ($type->levels as $level)
                  <strong style="font-size:0.5cm">{{ $level->level_code }} - {{ $level->name }}</strong>
                  
                  @if ($level->type->games->isEmpty())
                    <p>No games available for this level.</p>
                  @else
                    <ul class="list-unstyled">
                      @foreach ($level->type->games as $game)
                        <li>
                          <p style="text-indent: 30px; height: 9px"><img src="{{ asset('images/pokeball.png') }}" class="img" alt="Image" style="height:18px; width:18px">
                          <a href="{{ route('games.show', $game->id) }}">{{ $game->title }}</a>
                        </li>
                      @endforeach
                    </ul>
                  @endif
                @endforeach
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</body>
@endsection