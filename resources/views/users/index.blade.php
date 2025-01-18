
@extends('layouts.master')

@section('title')
    Players
@endsection

@section('background')
  class="list_bg" style="background: url('{{ asset('images/players_bg.jpg') }}') no-repeat center center fixed; background-size: cover;"
@endsection

@section('content')
<body class="list_bg">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <p class="logofont text-center" style="font-size:1.5cm">Players</p>
                <div class="table-responsive">
                    <table class="table table-transparent table-striped table-hover";>
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col" style="background-color: rgba(255, 255, 255, 0.8)";>Gamer ID</th>
                                <th scope="col" style="background-color: rgba(255, 255, 255, 0.8)">Name</th>
                                <th scope="col" style="background-color: rgba(255, 255, 255, 0.8)">No. of Reviews</th>
                                <th scope="col" style="background-color: rgba(255, 255, 255, 0.8)">Score</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($playersWithScores as $playerWithScore)
                                <tr>
                                    <td style="background-color: rgba(255, 255, 255, 0.6)"><a href="{{ route('reviews.index', ['player_id' => $playerWithScore['player']->id]) }}">{{ $playerWithScore['player']->gamer_id }}</a></td>
                                    <td>{{ $playerWithScore['player']->name }}</td>
                                    @if ($playerWithScore['player']->enrolments->isEmpty())
                                        <td colspan="2" class="text-muted">This player has no enrolments</td>
                                    @else
                                        <td>{{ $playerWithScore['submittedReviewsCount'] }}</td>
                                        <td>{{ $playerWithScore['averageScore'] }}</td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center">
                    {{ $players->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</body>
@endsection