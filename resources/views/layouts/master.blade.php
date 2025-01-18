<html>
<head>
  <title>@yield('title')</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=PT+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=PT+Sans:ital,wght@0,400;0,700;1,400;1,700&family=Pixelify+Sans:wght@400..700&family=Silkscreen:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.3.45/css/materialdesignicons.css" integrity="sha256-NAxhqDvtY0l4xn+YVa6WjAcmd94NNfttjNsDmNatFVc=" crossorigin="anonymous" />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/wp.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css" integrity="sha256-3sPp8BkKUE7QyPSl6VfBByBroQbKxKG7tsusY2mhbVY=" crossorigin="anonymous" />
  <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">
</head>
<body @section('background') style="background-color:#FFDBE9" @show>
  <!-- Navigation Bar -->
  <nav class="navbar navbar-expand-lg custom-navbar" style="background: rgba(255, 255, 255, 0.7); background: linear-gradient(to bottom, rgba(255, 255, 255, 1), rgba(255, 255, 255, 0));">
    <div class="container-fluid" style="margin: 0 auto; display: flex; justify-content: space-between; align-items: center;">
      <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
        <img src="{{ asset('images/logo.png') }}" class="d-inline-block align-top" alt="Logo">
        <span class="logofont ms-2">Poki Centre</span>
      </a>
      <div class="collapse navbar-collapse">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link {{ Request::is('/') ? 'nav-link active' : '' }}" aria-current="page" href="{{ url('/') }}">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('games') ? 'nav-link active' : '' }}" href="{{ route('games.index') }}">Games</a>
          </li>
          </li>
          @if (auth()->user()->role == 'coach')
            <li class="nav-item">
              <a class="nav-link {{ Request::is('players') ? 'nav-link active' : '' }}" href="{{ route('users.index') }}">Players</a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ Request::is('type/upload') ? 'nav-link active' : '' }}" href="{{ route('types.upload_form') }}">Upload File</a>
            </li>
          @else
            <li class="nav-item">
              <a class="nav-link {{ Request::is('pokemon/visit') ? 'nav-link active' : '' }}" href="{{ route('pokemon.visit') }}">Pokemon</a>
            </li>
          @endif
      </div>
      <div class="navbar-right">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          @if (auth()->user()->role == 'player')
            <li class="nav-item">
              <a class="nav-link {{ Request::is('pokemon/store') ? 'nav-link active' : '' }}" href="{{ route('pokemons.store') }}">Points: {{auth()->user()->player_points}}</a>
            </li>
          @endif
          <li class="nav-item">
            <a class="nav-link {{ Request::is('player/*') ? 'nav-link active' : '' }}" href="{{ route('reviews.index', ['player_id' => Auth::user()->id]) }}">
              @if (auth()->user()->role == 'coach')
                Coach: {{ Auth::user()->name }}
              @else 
                Player: {{ Auth::user()->name }}
              @endif
            </a>
          </li>
          <li>
            <form method="POST" action="{{route('logout')}}">
              {{csrf_field()}}
              <input type="submit" class="logout-button" value="Logout">
            </form>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  @yield('content')

  @if (auth()->user()->role == 'player')
    <div class="fixed-bottom-right fixed-bottom-right d-flex align-items-end justify-content-end">
      <a href="{{ route('pokemon.visit') }}"" style="color: white;">
      @if ($userPokemon = auth()->user()->playerpokemon()->latest()->first())
        <img src="{{ asset($userPokemon->pokemon->image) }}" alt="{{ $userPokemon->pokemon->name }}"></a>
      @endif
    </div>
  @endif

  <!-- End of Navigation Bar -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+vI1lqDYL24Wck8woELD/h60m26r2" crossorigin="anonymous"></script>
</body>
</html>