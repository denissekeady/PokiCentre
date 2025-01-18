@extends('layouts.master')

@section('title')
  Game Create
@endsection

@section('background')
  class="list_bg" style="background: url('{{ asset('images/games_show_bg.JPEG') }}') no-repeat center center fixed; background-size: cover;"
@endsection

@section('content')
<body class="list_bg">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 enrolments-box">
                <h1 class="logofont text-center" style="font-size:1cm">Edit {{ $game->title }}</h1>
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST" action="{{ route('games.update', $game->id) }}">
                    {{csrf_field()}}
                    {{ method_field('PUT') }}

                    <div class="form-group mb-3">
                        <label for="coach_id" class="fw-bold">Coach Name:</label>
                        <p>{{ $coach->name }}</p>
                    </div>

                    <div class="form-group mb-3">
                        <label for="type_id" class="fw-bold">Game Type:</label>
                        <p>{{ $type->type_code }}</p>
                        <input type="hidden" name="type_id" value="{{ $type->id }}">
                    </div>

                    <div class="form-group mb-3">
                        <label for="title" class="fw-bold">Title:</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title', $game->title) }}" placeholder="Enter game title" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="reviews_required" class="fw-bold">Reviews Required:</label>
                        <input type="number" name="reviews_required" class="form-control" value="{{ old('reviews_required', $game->reviews_required) }}" placeholder="Enter number of reviews" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="max_score" class="fw-bold">Max Score:</label>
                        <input type="number" name="max_score" class="form-control" value="{{ old('max_score', $game->max_score) }}" placeholder="Enter maximum score" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="due_date" class="fw-bold">Due Date:</label>
                        <input type="date" name="due_date" class="form-control" value="{{ old('due_date', $game->due_date ? $game->due_date->format('Y-m-d') : null) }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="instructions" class="fw-bold">Instructions:</label>
                        <textarea name="instructions" rows="4" class="form-control" placeholder="Enter any instructions">{{ old('instructions', $game->instructions) }}</textarea>
                    </div>

                    <div class="form-group mb-4">
                        <label for="assign_type" class="fw-bold">Assign Type:</label>
                        <select name="assign_type" class="form-select" required>
                            <option value="player" {{ old('assign_type', $game->assign_type) == 'player' ? 'selected' : '' }}>Player</option>
                            <option value="coach" {{ old('assign_type', $game->assign_type) == 'coach' ? 'selected' : '' }}>Coach</option>
                        </select>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn teamsedit-btn">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <br><br><br>
</body>
@endsection