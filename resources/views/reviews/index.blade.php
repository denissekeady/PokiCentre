@extends('layouts.master')

@section('title')
  {{ $player->name }} Profile
@endsection

@section('background')
  class="list_bg" style="background: url('{{ asset('images/review_index_bg.jpg') }}') no-repeat center center fixed; background-size: cover;"
@endsection

@section('content')
<body class="list_bg">
  @if (count($errors) > 0)
    <div class="alert">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
  @endif
  @if ($player->role == 'player')
    <div class="profile-header">
      <h1 class="heading text-center" style="font-size:1cm">{{ $player->name }}'s Profile</h1>
      <p class="lead text-center">Gamer ID: {{ $player->gamer_id }}</p>
    </div><br><br>
    <div class="container md 5 center-horizontal">
      <div class="col-lg-11">
        <h2 class="heading">GAMES</h2>
        <div class="table-responsive">
          <table class="table table-transparent table-striped table-hover">
            <thead>
              <tr>
                <th scope="col">Level Code</th>
                <th scope="col">Level Name</th>
                <th scope="col">Game Title</th>
                <th scope="col">Rating</th>
                <th scope="col">Score</th>
                <th scope="col">Assign</th>
              </tr>
            </thead>
            <tbody>
              @foreach($playerGames as $enrolment)
                @foreach ($enrolment->level->type->games as $playerGame)
                  @if ($enrolment->level->type->id == $playerGame->type_id)
                    <tr>
                      <td>{{ $enrolment->level->level_code }}</td>
                      <td>{{ $enrolment->level->name }}</td>
                      <td>{{ $playerGame->title }}</td>
                      <td>
                      @if ($playerGame->assign_type == 'player')
                        @if ($playerGame->reviews->whereNotNull('rating')->isNotEmpty())
                          {{ $playerGame->reviews->whereNotNull('rating')->avg('rating') }}
                        @else
                          No rating available.
                        @endif
                      @elseif ($playerGame->assign_type == 'coach')
                        @if ($playerGame->reviews->whereNotNull('rank')->isNotEmpty())
                          {{ $playerGame->reviews->whereNotNull('rank')->avg('rank') }}
                        @else
                          No rank available.
                        @endif
                      @endif
                      </td>
                      <td>
                        @if ($playerGame->playerscores->where('player_id', $player->id)->isNotEmpty())
                          {{ $playerGame->playerscores->where('player_id', $player->id)->first()->score }}
                        @else
                          No score yet.
                        @endif
                      </td>
                      <td>
                        @if (auth()->user()->role == 'coach' && $playerGame->playerscores->where('player_id', $player->id)->isEmpty())
                          <form action="{{ route('playerscore.store', ['id' => $player->id]) }}" method="POST">
                            @csrf
                            <label for="score">Assign Score:</label>
                            <input type="input" name="score" id="score" style="width:2cm">
                            <input type="hidden" name="game_id" value="{{ $playerGame->id }}">
                            <button type="submit" class="btn btn-primary btn-sm">Submit Score</button>
                          </form>
                        @else
                          --
                        @endif
                      </td>
                    </tr>
                  @endif
                @endforeach
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="pagination-links">
          {{ $playerGames->links() }}
        </div>
      </div>
    </div><hr>

    <br><br>
    <div class="container md-5 center-horizontal">
      <div class="col-lg-11">
        <h2 class="heading">REVIEWS</h2>
        <div class="reviews-box mt-4" style="background-color: rgba(255, 255, 255, 0.7); padding: 20px; border-radius: 8px;">
          @foreach ($games->groupBy('level.type.name') as $type => $typeGames)
            <h2>{{ $type }}</h2>
            @if ($typeGames->isNotEmpty())
              @foreach ($typeGames as $enrolment)
                <h4>{{ $enrolment->level->name }}</h4>
                @foreach ($enrolment->level->type->games as $game)
                  <div class="review-title-container">
                    <h1 class="review-title">{{ $game->title }}</h1>
                    <hr class="horizontal-line">
                  </div>
                  <p><strong>Submitted Reviews:</strong></p>
                  @php
                    $submittedReviews = $game->reviews->where('reviewer_id', $player->id);
                  @endphp
                  @if($submittedReviews->isEmpty())
                    <p>No submitted reviews.</p><br>
                  @else
                    <ul class="list-group">
                      @foreach ($submittedReviews as $review)
                        <li class="list-group-item">
                          <div class="enrolments-box">
                            <table>
                              <tbody>
                                <tr>
                                  <td colspan="2"><strong>Reviewer - {{ $review->reviewer->name }}</strong></td>
                                </tr>
                                <tr>
                                  <td colspan="2"><strong>Reviewee - {{ $review->reviewee->name }}</strong></td>
                                </tr>
                                <tr>
                                  <th>Title</th>
                                  <td>{{ $review->title }}</td>
                                </tr>
                                <tr>
                                  <th>Rating</th>
                                  <td>{{ $review->rating }} / {{ $game->max_score }}</td>
                                </tr>
                                <tr>
                                  <td colspan="2">{{ $review->text }}</td>
                                </tr>
                              </tbody>
                            </table>
                            @if(is_null($review->rank))
                              <span class="text-muted">Has not been ranked yet</span>
                            @else
                              <span class="text-success">Rank: {{ $review->rank }}</span>
                            @endif
                          </div>
                        </li>
                      @endforeach
                    </ul><br>
                  @endif
                  <p><strong>Received Reviews:</strong></p>
                  @php
                    $receivedReviews = $game->reviews->where('reviewee_id', $player->id);
                  @endphp
                  @if($receivedReviews->isEmpty())
                    <p>No received reviews.</p><br>
                  @else
                    <ul class="list-group">
                      @foreach ($receivedReviews as $review)
                        <li class="list-group-item">
                          <div class="enrolments-box">
                            <table>
                              <tbody>
                                <tr>
                                  <td colspan="2">Reviewer - {{ $review->reviewer->name }}</td>
                                </tr>
                                <tr>
                                  <th>Title</th>
                                  <td>{{ $review->title }}</td>
                                </tr>
                                <tr>
                                  <th>Rating</th>
                                  <td>{{ $review->rating }} / {{ $game->max_score }}</td>
                                </tr>
                                <tr>
                                  <td colspan="2">{{ $review->text }}</td>
                                </tr>
                              </tbody>
                            </table>
                            @if(is_null($review->rank))
                              <span class="text-muted">Has not been ranked yet</span>
                            @else
                              <span class="text-success">Rank: {{ $review->rank }}</span>
                            @endif
                          </div>
                        </li>
                      @endforeach
                    </ul><br>
                  @endif
                @endforeach
              @endforeach
            @else
              <p>There are no games for this type</p>
            @endif
          @endforeach
        </div>
        <div class="pagination-links">
          {{ $games->links() }}
        </div>
      </div>
    </div><hr>
  @endif
  <br><br>
  @if (auth()->user()->role == 'coach')
    <div class="container md 5 center-horizontal">
      <div class="col-lg-11">
        <h2 class="heading">ENROLLED TYPES</h2>
        <div class="reviews-box mt-4" style="background-color: rgba(255, 255, 255, 0.7); padding: 20px; border-radius: 8px;">
          @if($enrolments->isEmpty())
            <p>This player is not enrolled in any types.</p>
          @else
            <ul class="list-group list-group-flush">
              @foreach($enrolments->unique('level.type.id') as $enrolment)
                @if ($enrolment->level->type)
                  <li class="list-group-item">
                    <strong><a href="{{ route('types.show', $enrolment->level->type->type_code) }}" class="subheading" style="color:#02658f">
                      {{ $enrolment->level->type->type_code }} - {{ $enrolment->level->type->name }}
                    </a></strong>
                  </li>
                  @foreach ($enrolment->level->type->levels as $level)
                    @if ($level->enrolments->contains('user_id', $player->id))
                      <li class="list-group-item">
                        <p style="text-indent: 40px; height: 9px"><img src="{{ asset('images/pokeball.png') }}" class="img" alt="Image" style="height:12px; width:12px">
                        <a href="{{ route('levels.show', $level->id) }}" class="text-muted">
                          {{ $level->level_code }} - {{ $level->name }}
                        </a>
                      </li>
                    @endif
                  @endforeach
                @else
                  <li>This enrolment has no associated type.</li>
                @endif
              @endforeach
            </ul>
          @endif


          @if ($player->role == 'player')
            <hr>
            <form action="{{ route('enrolment.store', ['player_id' => $player->id]) }}" method="POST">
              @csrf
              <div class="form-group">
                <label for="level_id" style="font-weight:bold; font-size:0.6cm">Enrol Level:</label>
                <select name="level_id" id="level_id" class="form-control" required>
                  <option value="">-- Select Level --</option>
                  @foreach($levels as $level)
                    <option value="{{ $level->id }}">{{ $level->type->type_code }} - {{ $level->level_code }}</option>
                  @endforeach
                </select>
              </div>
              <button type="submit" class="btn btn-primary">Enroll Player</button>
            </form>
          @endif
        </div>
      </div>
    </div>

  @endif

@endsection