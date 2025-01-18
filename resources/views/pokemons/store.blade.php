@extends('layouts.master')

@section('title')
  Poki Store
@endsection

@section('background')
  class="list_bg" style="background: url('{{ asset('images/pokistore.jpg') }}') no-repeat center center fixed; background-size: cover;"
@endsection

@section('content')
<body class="list_bg">
    <h1 class="logofont text-center" style="font-size:1.5cm">Poki Store</h1>
    @if (count($errors) > 0)
        <div class="alert">
            <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-success">
            {{ session('error') }}
        </div>
    @endif
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="container mt-5">
        @if(!$userPokemon)
            <h2 class="heading text-center">Choose Your Pokémon</h2><br>

            <form method="POST" action="{{ route('pokemon.buy', ['pokemon' => 'selected']) }}">
                @csrf
                <div class="row justify-content-center">
                    @foreach ($basePokemons as $pokemon)
                        <div class="col-md-4 mb-4">
                            <div class="card text-center" style="background-color: rgba(255, 255, 255, 0.8); padding: 20px; border-radius: 8px; height: 250px;">
                                <img src="{{ asset($pokemon->image) }}" class="card-img-top" alt="{{ $pokemon->name }}" style="max-width: 100px; margin: 0 auto;">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $pokemon->name }}</h5>
                                    <p class="card-text">{{ $pokemon->price }} points</p>
                                    <input type="radio" name="pokemon_id" value="{{ $pokemon->id }}" required>
                                    <label>Select</label>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary mt-4">Buy Pokémon</button>
                </div>
            </form>

        @else
            <div class="row justify-content-center">
                @foreach ($availableEvolutions as $pokemon)
                    <div class="col-md-4 mb-4">
                        <div class="card text-center" style="background-color: rgba(255, 255, 255, 0.8); padding: 20px; border-radius: 8px; height: 250px;">
                            <img src="{{ asset($pokemon->image) }}" class="card-img-top" alt="{{ $pokemon->name }}" style="max-width: 100px; margin: 0 auto;">
                            <div class="card-body">
                                <h5 class="card-title">{{ $pokemon->name }}</h5>
                                <p class="card-text">{{ $pokemon->price }} points</p>
                                <form method="POST" action="{{ route('pokemon.buy', ['pokemon' => $pokemon->id]) }}">
                                    @csrf
                                    <input type="hidden" name="pokemon_id" value="{{ $pokemon->id }}">
                                    <button type="submit" class="btn btn-primary">Buy</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</body>
@endsection
