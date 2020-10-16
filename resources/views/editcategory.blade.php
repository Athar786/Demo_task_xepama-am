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
                <div class="card-header">Category Add List</div>

                <div class="card-body">
                    @if($message = Session::get('success'))
                        <div class="alert alert-success alert-block">
                        <strong>{{ $message }}</strong></div>
                    @endif
                <h2>Category Add Form</h2>

                <form action="{{route('subcategory.store')}}" method="post">
                {{csrf_field()}}
                
                    <div class="form-group">
                        <label for="name">Category:</label>
                        <select name="category" class="form-control" style="width:350px">
                        <option disabled selected value="">--- Select State ---</option>
                      
                       
                        </select>
                        
                    </div>

                    <div class="form-group">
                        <label for="name">Sub-category:</label>
                        <input type="text" class="form-control" id="subcategory" placeholder="Enter Sub-category" name="subcategory" />
                        <span class="text-danger">{{ $errors->first('subcategory') }}</span>
                    </div>


                    <button type="submit" class="btn btn-success">Add</button>
                </form>
                <br/>
                <hr/>

@endsection