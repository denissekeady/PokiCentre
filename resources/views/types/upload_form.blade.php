@extends('layouts.master')

@section('title')
  Upload Form
@endsection

@section('background')
  class="list_bg" style="background: url('{{ asset('images/upload_form_bg.jpg') }}') no-repeat center center fixed; background-size: cover;"
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
  <div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="col-lg-6 enrolments-box rounded shadow" style="padding: 3rem;">
      <h1 class="heading text-center mb-4">Upload Form</h1>
      <p class="text-center">Upload and create a type</p>
      <hr><br>
      <form action="{{ route('types.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group row justify-content-center">
          <label for="type_file" class="col-sm-4 col-form-label text-right">Upload Type File:</label>
          <div class="col-sm-8">
            <input type="file" class="form-control" name="type_file" required>
          </div>
        </div>
        <div class="form-group row justify-content-center mt-4">
          <div class="col-sm-8 text-center">
            <button type="submit" class="btn upload-btn">Upload</button>
          </div>
        </div>
      </form>
    </div>
  </div>

</body>
@endsection