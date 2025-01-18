@extends('layouts.master')

@section('title')
  Rank Form
@endsection

@section('background')
  class="list_bg" style="background: url('{{ asset('images/upload_form_bg.jpg') }}') no-repeat center center fixed; background-size: cover;"
@endsection

@section('content')
<body class="list_bg">
    <div class="container mt-5">
        <h2 class="text-center mb-4">Rank Reviews for Game: {{ $game->title }}</h2>
        
        @if (session('error'))
            <div class="alert alert-danger text-center">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('reviews.rank', $game->id) }}" method="POST">
            @csrf

            <div class="row justify-content-center">
                @foreach ($reviews as $review)
                <div class="col-md-6 mb-4">
                    <div class="card" style="background-color: rgba(255, 255, 255, 0.8);">
                        <div class="card-body">
                            <h5 class="card-title">Review by {{ $review->reviewer->name }}</h5>
                            <p><strong>Title: </strong>{{ $review->title }}</p>
                            <p><strong>Score: </strong>{{ $review->rating }}</p>
                            <p><strong>Content: </strong>{{ $review->text }}</p>
                            @if (is_null($review->rank))
                            <div class="form-group">
                                <label for="rank_{{ $review->id }}" class="form-label">Rank this review:</label>
                                <select class="form-select" name="ranks[{{ $review->id }}]" id="rank_{{ $review->id }}" required>
                                    <option value="" selected disabled>Choose Rank</option>
                                    @for ($i = 1; $i <= $playersToRank; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            @else
                            <p class="text-success"><strong>This review has been ranked:</strong> {{ $review->rank }} place</p>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary mt-4">Submit All Ranks</button>
            </div>
        </form>
    </div>
</body>
@endsection
