@extends('layouts.master')

@section('title')
    {{$game->name}} Show
@endsection

@section('background')
  @if ($game->assign_type == 'player')
    class="list_bg" style="background: url('{{ asset('images/eevee.jpeg') }}') no-repeat center center fixed; background-size: cover;"
  @else
    class="list_bg" style="background: url('{{ asset('images/nighteevee.jpg') }}') no-repeat center center fixed; background-size: cover;"
  @endif
@endsection

@section('content')
<body class="list_bg">
  @if (session('success'))
      <div class="alert alert-success">
          {{ session('success') }}
      </div>
  @endif
  <div class="container my-5">
    <div class="row">
      <div class="col-lg-7">
        <div class="enrolments-box" style="background: linear-gradient(to right, rgba(255, 255, 255, 0.8) 80%, rgba(255, 255, 255, 0) 100%); min-height: 80vh;" >
          <div class="card-body">
            <h1 class="heading" style="font-size:1cm">{{ $game->title }}</h1>
            <p class="lead">{{ $type->type_code }} || Due: {{ $game->due_date }}</p>
            <hr>
            <div style="font-size: 0.5cm">
                  <strong>Reviews Required: </strong>{{$game->reviews_required}}<br>
                  <strong>Max Score: </strong>{{$game->max_score}}<br>
                  <strong>Assign Type: </strong>{{$game->assign_type}}<br>
                  <strong>Instructions: </strong>{{$game->instructions}}<br>
            </div>
            <div class="bottom-section">
              <p>Created by {{$coach->name}}</p>
              <hr>
              @auth
                @if (auth()->user()->role == 'coach')
                  <div class="d-flex mt-4">
                    @if ($review->isEmpty())
                      <p><a href="{{ route('games.edit', $game->id) }}" class="btn btn-primary me-2">Edit</a></p>
                    @endif
                    <form method="POST" action="{{ route('games.destroy', $game->id) }}">
                      {{csrf_field()}}
                      {{ method_field('DELETE') }}
                      <input type="submit" class="btn btn-danger" value="Delete">
                    </form>
                  </div>
                @else
                  @if ($game->assign_type == 'player')
                    @if((count($receivedReviews) == $game->reviews_required))
                      @if (!$allRanked)
                        <a href="{{ route('reviews.rank_form', $game->id) }}">
                          <button type="button">Rank Reviews</button>
                        </a>
                      @else
                        <p>Thank you! You have ranked all the reviews you received.</p>
                      @endif
                    @elseif (count($receivedReviews) < $game->reviews_required)
                      <p>Reviews Recieved: {{ count($receivedReviews) }}/{{ $game->reviews_required }}</p>
                    @endif
                    <p>Reviews Submitted: {{ count($submittedReviews) }}/{{ $game->reviews_required }}</p>
                  @else
                    @if (count($receivedReviews) == count($enrolledPlayers))
                      @if (!$allRanked)
                        <a href="{{ route('reviews.rank_form', $game->id) }}">
                          <button type="button">Rank Reviews</button>
                        </a>
                      @else
                        <p>Thank you! You have ranked all the reviews you received.</p>
                      @endif
                    @elseif (count($receivedReviews) < count($enrolledPlayers))
                      <p>Reviews Recieved: {{ count($receivedReviews) }}/{{ count($enrolledPlayers) }}</p>
                    @endif
                    <p>Reviews Submitted: {{ count($submittedReviews) }}/{{ count($enrolledPlayers) }}</p>
                  @endif
                @endif
              @endauth
            </div>
          </div>
        </div>
      </div>
    </div>
    <br<br><br>
    <div class="row justify-content-center g-4">
      <div class="col-12">
    
        @if (auth()->user()->role == 'player')
          @if (count($errors) > 0)
            <div class="alert alert-danger">
              <ul class="mb-0">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif
          @if (session('error'))
            <div class="alert alert-danger">
              {{ session('error') }}
            </div>
        @endif

          @if ($game->assign_type == 'player')
            @if (count($submittedReviews) < $game->reviews_required)
              <div class="gameshow-box">
                <div class="card-body">
                  <h3 class="heading">SUBMIT A REVIEW</h3>
                  <hr>
                  <form method="POST" action="{{ route('reviews.store', $game->id) }}">
                    @csrf
                    <div class="form-group mb-3">
                      <label for="title" class="form-label">Title</label>
                      <input type="text" class="form-control" name="title" value="{{ old('title') }}" required>
                    </div>
                    <div class="form-group mb-3">
                      <label for="rating" class="form-label">Rating</label>
                      <input type="text" class="form-control" name="rating" value="{{ old('rating') }}" required min="1" max="{{ $game->max_score }}">
                      <small class="form-text text-muted">/ {{ $game->max_score }}</small>
                    </div>
                    <div class="form-group mb-3">
                      <label for="reviewee_id" class="form-label">Select a Player to Review:</label>
                      <select name="reviewee_id" class="form-select" required>
                        @foreach($enrolledPlayers as $player)
                          @if(!$submittedReviews->pluck('reviewee_id')->contains($player->id))
                            <option value="{{ $player->id }}">{{ $player->name }}</option>
                          @endif
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group mb-3">
                      <label for="text" class="form-label">Review Text (min. 5 words)</label>
                      <textarea name="text" class="form-control" rows="3" required>{{ old('text') }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit Review</button>
                  </form>
                </div>
              </div>
            @else
              <p style="font-size:0.5cm"><strong>Congratulations! You have completed the game's reviews.</strong></p>
            @endif
          @elseif ($game->assign_type == 'coach')
            @if (count($submittedReviews) < count($enrolledPlayers))
              <div class="gameshow-box">
                <div class="card-body">
                  <h3 class="heading">SUBMIT A REVIEW</h3>
                  <form method="POST" action="{{ route('reviews.store', $game->id) }}">
                    @csrf
                    <div class="form-group mb-3">
                      <label for="title" class="form-label">Title</label>
                      <input type="text" class="form-control" name="title" value="{{ old('title') }}" required>
                    </div>
                    <div class="form-group mb-3">
                      <label for="rating" class="form-label">Rating</label>
                      <input type="text" class="form-control" name="rating" value="{{ old('rating') }}" required min="1" max="{{ $game->max_score }}">
                      <small class="form-text text-muted">/ {{ $game->max_score }}</small>
                    </div>
                    <div class="form-group mb-3">
                      <label for="reviewee_id" class="form-label">Select a Player to Review:</label>
                      <select name="reviewee_id" class="form-select" required>
                        @foreach($enrolledPlayers as $player)
                          @if(!$submittedReviews->pluck('reviewee_id')->contains($player->id))
                            <option value="{{ $player->id }}">{{ $player->name }}</option>
                          @endif
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group mb-3">
                      <label for="text" class="form-label">Review Text (min. 5 words)</label>
                      <textarea name="text" class="form-control" rows="3" required>{{ old('text') }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit Review</button>
                  </form>
                </div>
              </div>
            @else
              <p style="font-size:0.5cm"><strong>Congratulations! You have completed the game's reviews.</strong></p>
            @endif
          @endif
          <br><br><br>

          <p class="heading">SUBMITTED REVIEWS:</p>
            <ul class="list-group mb-4">
              @if ($submittedReviews->isNotEmpty())
                @foreach($submittedReviews as $review)
                  <div class="enrolments-box">
                    <li class="list-group-item">
                      <table>
                        <tbody>
                          <tr>
                            <td colspan="2" style="font-size:0.5cm"><strong>Reviewed {{ $review->reviewee->name }}</td>
                          </tr>
                          <tr>
                            <th>Title</th>
                            <td>{{ $review->title }}</td>
                          </tr>
                          <tr>
                            <th>Rating:</th>
                            <td>{{ $review->rating }} / {{ $game->max_score }}</td>
                          </tr>
                          <tr>
                            <td colspan="2"><strong>Review:</strong> {{ $review->text }}</td>
                          </tr>
                        </tbody>
                      </table>
                      @if(is_null($review->rank))
                        <span class="text-muted">Has not been ranked yet</span>
                      @else
                        <span class="text-success">Rank: {{ $review->rank }}</span>
                      @endif
                    </li>
                  </div><br>
                @endforeach
              @else
                <p>You have not submitted any reviews yet.</p><br>
              @endif

          </ul>

          <p class="heading">RECIEVED REVIEWS:</p>
          <ul class="list-group">
            @if ($receivedReviews->isNotEmpty())
              @foreach($receivedReviews as $review)
                <div class="enrolments-box">
                  <li class="list-group-item">
                    <table>
                      <tbody>
                        <tr>
                          <td colspan="2" style="font-size:0.5cm"><strong>Reviewer - {{ $review->reviewer->name }}</strong></td>
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
                  </li>
                </div><br>
              @endforeach
            @else
              <p>No reviews received yet.</p><br>
            @endif
          </ul>

        @elseif (auth()->user()->role == 'coach')
          @if ($game->assign_type == 'player')
            <div class="enrolments-box">
              <h1 class="heading">LEVELS</h1>
              @foreach ($playersByLevel as $level)
                <p class="subheading" style="font-size:0.6cm">{{ $level->level_code }} - {{ $level->name }}</p>
                <ul class="list-group mb-4">
                  @foreach ($level->enrolments()->whereHas('player')->get() as $enrolment)
                    @if ($enrolment->player && $enrolment->player->role != 'coach')
                      <li class="list-group-item">
                        <a href="{{ route('reviews.index', ['game_id' => $game->id, 'player_id' => $enrolment->player->id]) }}">
                          <strong>{{ $enrolment->player->name }} ({{ $enrolment->player->gamer_id }})</strong>
                        </a>
                        <ul class="list-group">
                          @foreach ($playersWithReviews as $playerData)
                            @if ($enrolment->player->id == $playerData['player']->id)
                              <li class="list-group-item">
                                <img src="{{ asset('images/pokeball.png') }}" class="img" alt="Image" style="height:12px; width:12px"><strong> Submitted Reviews:</strong> {{ $playerData['submittedReviewsCount'] }}/{{ $game->reviews_required }}<br>
                                <img src="{{ asset('images/pokeball.png') }}" class="img" alt="Image" style="height:12px; width:12px"><strong> Received Reviews:</strong> {{ $playerData['receivedReviewsCount'] }}/{{ $game->reviews_required }}<br>
                                <img src="{{ asset('images/pokeball.png') }}" class="img" alt="Image" style="height:12px; width:12px"><strong> Rating:</strong> {{ $playerData['score'] }}
                              </li>
                            @endif
                          @endforeach
                        </ul>
                      </li>
                    @elseif ($enrolment->player->role == 'coach')
                      <li class="list-group-item">Coach: {{ $enrolment->player->name }}</li>
                    @endif
                  @endforeach
                </ul>
              @endforeach
            </div>
            <div>
              {{ $playersByLevel->links() }}
            </div>
          @elseif ($game->assign_type == 'coach')
            <div class="enrolments-box">
              <h1 class="heading">LEVELS</h1>
              @if($levelsWithTeams->isNotEmpty())
                @foreach ($levelsWithTeams as $levelData)
                  <h4 class="card-title">{{ $levelData['level']->level_code }} - {{ $levelData['level']->name }}</h4>

                  @if ($levelData['teams']->isEmpty())
                      <p>No teams available for this level.</p>
                  @else
                      <ul class="list-group list-group-flush">
                        @foreach ($levelData['teams'] as $team)
                          <li class="list-group-item">
                            <div class="d-flex justify-content-between align-items-center">
                              <strong>{{ $team->name }}</strong> 
                              <hr class="flex-grow-1 mx-3 my-0">
                              <a href="{{ route('teams.edit_form', ['id' => $team->id]) }}">Edit</a>
                            </div>

                            <ul class="list-group list-group-flush">
                              @foreach ($team->players as $player)
                                <li class="list-group-item">
                                  <a href="{{ route('reviews.index', ['game_id' => $game->id, 'player_id' => $player->id]) }}">
                                    {{ $player->name }} ({{ $player->gamer_id }})
                                  </a>
                                  <ul class="list-group">
                                      @foreach ($playersWithReviews as $playerData)
                                          @if ($player->id == $playerData['player']->id)
                                              <li class="list-group-item">
                                                  <img src="{{ asset('images/pokeball.png') }}" class="img" alt="Image" style="height:12px; width:12px"><strong> Submitted Reviews:</strong> {{ $playerData['submittedReviewsCount'] }}/{{ $team->players->count() }}<br>
                                                  <img src="{{ asset('images/pokeball.png') }}" class="img" alt="Image" style="height:12px; width:12px"><strong> Received Reviews:</strong> {{ $playerData['receivedReviewsCount'] }}/{{ $team->players->count() }}<br>
                                                  <img src="{{ asset('images/pokeball.png') }}" class="img" alt="Image" style="height:12px; width:12px"><strong> Rating:</strong> {{ $playerData['score'] }}
                                              </li>
                                          @endif
                                      @endforeach
                                  </ul>
                                </li>
                              @endforeach
                            </ul>
                          </li>
                        @endforeach
                      </ul>
                  @endif
                @endforeach
              @endif
            </div>
            <div class="d-flex justify-content-center mt-4">
                {{ $levelsWithTeams->links('pagination::bootstrap-4') }}
            </div>
          @endif
        @endif
      </div>
    </div>
  </div>

@endsection