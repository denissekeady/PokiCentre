@extends('layouts.master')

@section('title')
  Pokemon
@endsection

@section('background')
  class="list_bg" style="background: url('{{ $background }}') no-repeat center center fixed; background-size: cover;"
@endsection

@section('content')
<body class="list_bg">
  <div style="display: flex; flex-direction: column; justify-content: center; align-items: center; min-height: 100vh; text-align: center;">
    <div class="speech-bubble">
      @if ($myPokemon->evolution == 'Charmander')
        @if ($pokemonName == 'Charizard')
          <p>Thank you for taking care of me. Now that I'm stronger, you can count on me to always protect you, {{auth()->user()->name}}!</p>
        @elseif ($pokemonName == 'Charmeleon')
          <p>I want to grow stronger! What can I do? I need to train.</p>
        @elseif ($pokemonName == 'Charmander')
          <p>Hello {{auth()->user()->name}}! Thank you for choosing me. I promise I won't let you down!</p>
        @endif
      @elseif ($myPokemon->evolution == 'Squirtle')
        @if ($pokemonName == 'Squirtle')
          <p>Hi {{auth()->user()->name}}! You chose me! Lets play some games!</p>
        @elseif ($pokemonName == 'Wartortle')
          <p>There's no time to mess around, we need to prepare for battle.</p>
        @elseif ($pokemonName == 'Blastoise')
          <p>Thank you for everything, {{auth()->user()->name}}. Through thick and thin, I'll always be by your side to defend you.</p>
        @endif
      @elseif ($myPokemon->evolution == 'Bulbasaur')
        @if ($pokemonName == 'Bulbasaur')
          <p>You chose me? Thank you! I'm always here if you need any help</p>
        @elseif ($pokemonName == 'Ivysaur')
          <p>It's a beautiful place isn't it? We can take a break and admire the view.</p>
        @elseif ($pokemonName == 'Venusaur')
          <p>We made it to such a beautiful place. Thank you for the journey, {{auth()->user()->name}}! We can finally relax.</p>
        @endif
      @endif
    </div>
    <img src="{{ asset($myPokemon->image) }}" alt="{{ $myPokemon->name }}" style="width: 3cm; margin-top: 20px;">
  </div>
</body>
@endsection