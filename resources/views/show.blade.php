@extends('layouts.app')

@section('content')
<html lang="en">
<head>
  <title>Laravel Multiple File Upload Example</title>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>

<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">User Data show</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif 

                    <a href="/home" class="btn btn-primary">Back Home</a>
                    <hr/>

                    <table border="2" class="table table-hover" id="table_id">
                    @foreach($users as $data)
                        <tr>
                            <th>ID</th>
                            <td>{{$data->id}}</td>
                        </tr>
                        <tr>
                            <th>Name</th>
                            <td>{{$data->name}}</td>
                        </tr>
                        <tr>
                            <th>Mobile No.</th>
                            <td>{{$data->number}}</td>
                        </tr>
                        <tr>
                            <th>Gender</th>
                            <td>{{$data->gender}}</td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td>{{$data->address}}</td>
                        </tr>
                        <tr>
                            <th>State</th>
                            <td>{{$data->state}}</td>
                        </tr>

                        <tr>
                            <th>City</th>
                            <td>{{$data->city}}</td>
                        </tr>
                        @endforeach

                    </table>
        
                    </div>
            </div>
        </div>
    </div>
</div>




@endsection
