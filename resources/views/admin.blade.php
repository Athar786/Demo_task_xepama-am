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
                <div class="card-header">User Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif 

                    You are in ADMIN Dashboard!
                    <a href="/add" class="btn btn-primary">Add Data</a>
                    <a href="/home" class="btn btn-primary">Back Home</a>
                    <hr/>
                    <center><strong><h3>User Data</h3></strong></center>
                    <hr/>

                    <table class="table">
                        <tr>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Email</th>

                        </tr>
                       @foreach($userdata as $data)
                        <tr>
                            <td>{{$data->name}}</td>
                            <td>{{$data->role}}</td>
                            <td>{{$data->email}}</td>

                        </tr>
                    @endforeach
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection