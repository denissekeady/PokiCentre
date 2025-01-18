@extends('layouts.master')

@section('title')
  Home
@endsection

@section('background')
  style="background-color: #d9d0e3"
@endsection

@section('content')
  @if (session('success'))
    <div class="alert alert-success">
      {{ session('success') }}
    </div>
  @endif
  @if (count($errors) > 0)
    <div class="alert">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  <div class= "welcomestrip-container" style="background: linear-gradient(to bottom, rgba(255,255,255,0) 30%, #d9d0e3 100%), linear-gradient(to top, rgba(255,255,255,0) 70%, #d9d0e3 100%), url('images/home.JPEG'); background-repeat: no-repeat; background-size: contain;">
    <br><br><br><br><br><br><br><br>
    <p class="welcomehead">Welcome to the <span class="pokicentre"> Poki Centre</span></p>
    <h1 style="text-align: center">Welcome {{ $role == 'player' ? 'Player' : 'Coach' }} {{auth()->user()->name}}</h1>
    @if (auth()->user()->role == 'player')
      <p class="lead" style="text-align: center">Review your games with your recent teammates!</p>
    @elseif (auth()->user()->role == 'coach')
      <p class="lead" style="text-align: center">Mark students and assign games!</p>
    @endif
    <br><br><br><br>
    <br>
    <br><br>
    <br><br>
    <br>
  

  </div>
  <div class="container my-5">
    <div class="row position-relative">
      @if (auth()->user()->role == 'player')
        <div class="col-md-8">
      @else
        <div class="col-md-10">
      @endif
          <div class="enrolments-box p-4">
            @if($role == 'player')
              <p class="heading fw-bold">YOUR ENROLMENTS</p>
            @else
            <p class="heading fw-bold">YOUR TYPES</p>
            @endif
            @if($enrolments->isEmpty())
              <p>You are not enrolled in or teaching any courses yet.</p>
            @else
              <ul class="list-group list-group-flush">
                @foreach($enrolments->unique('level.type.id') as $enrolment)
                  @if ($enrolment->level->type)
                    <li class="list-group-item">
                      <strong><a href="{{ route('types.show', $enrolment->level->type->type_code) }}" class="subheading" style="color:#02658f">
                        {{ $enrolment->level->type->type_code }} - {{ $enrolment->level->type->name }}
                      </a></strong>
                      @foreach ($enrolment->level->type->levels as $level)
                        @if ($level->enrolments->contains('user_id', auth()->user()->id))
                          <li class="list-group-item">
                            <p style="text-indent: 40px; height: 9px"><img src="{{ asset('images/pokeball.png') }}" class="img" alt="Image" style="height:18px; width:18px">
                            <a href="{{ route('levels.show', $level->id) }}" class="text-muted">
                              {{ $level->level_code }} - {{ $level->name }}
                            </a>
                          </li>
                        @endif
                      @endforeach
                    </li>
                  @else
                    <li>This enrolment has no associated type.</li>
                  @endif
                @endforeach
              </ul>
            @endif
            <br><br>
          </div>
        </div>
        @if (auth()->user()->role == 'player')
          <div class="col-lg-4">
            <img src="{{ asset('images/snorlax.png') }}" class="snorlax" alt="Image">
          </div>
        @else
          <div class="col-lg-2">
            <img src="{{ asset('images/espeon.png') }}" class="espeon" alt="Image">
          </div>
        @endif
      </div>
  </div>

  <br><br><br><br><br>

      
@endsection