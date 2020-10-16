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

                    @can('create',App\adduser::class)
                        <a href="/add" class="btn btn-primary">Add Data</a>
                    @endcan

                <a href="/admin" class="btn btn-primary">Admin List</a>

                <a href="/category" class="btn btn-primary">Add Category</a>
                <br>
                <hr/>

               
                <div class="input-group">
                    <input type="text" class="form-control" name="search" id = "search"
                        placeholder="Search users"> <span class="input-group-btn">
                       
                    </span>    
                </div>
             
                <br>
                <br>
                <table border="2" class="table table-hover" id="table_id">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Number</th>
                        <th>Hobbies</th>
                        <th>Gender</th>
                        <th>Address</th>
                        <th>State</th>
                        <th>city</th>
                        <th>Images</th>
                        
                        <th colspan = "2">Action</th>
                    </tr>
                    @if(!empty($users) && $users->count())
                        @foreach($users as $key => $data)
                    <tr>    
                        <td>{{$data->id}}</td>  
                        @can('view',$data)               
                            <td><a href="{{route('add.show',$data->id)}}">{{$data->name}}</a></td>@endcan
                        @cannot('view',$data)
                            <td> {{$data->name}}</td>
                        @endcannot
                        <td>{{$data->number}}</td>
                        <td>{{$data->gender}}</td>
                        <td>{{$data->gender}}</td>
                        <td>{{$data->address}}</td>
                        <td>{{$data->state}}</td>
                        <td>{{$data->city}}</td>
                        <td><?php $img = json_decode($data->filename);
                              if($img) {
                                 foreach($img as $pics) { ?>      
                        <img src="{{ asset('/image/'.$pics)}}" style="height:25px; width:25px" /><?php  }}  ?>
                        </td>
                        
                        <td>
                        <form action="{{ route('add.destroy', $data->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" onclick="return confirm('Are you sure you want to Delete?')" type="submit">Delete</button>
                        </form></td>
                        
                        
                        <td><a href = "/edit/{{ $data->id }}" class="btn btn-success">Edit</a></td>
                    </tr>
                    
                    @endforeach
                    @else
                    <tr>
                        <td colspan="10">There are no data.</td>
                    </tr>
                    @endif
                 </table>


                    
        <h1 class="display-4 text-center" style="font-size: 3.0rem">{{ __('lang.welcome', ['Name' => 'Athar'])}}</h1>
        <h3 class="display-4 text-center" style="font-size: 2.0rem">{{ __('lang.title') }}</h3>
        <h4 class="display-4 text-center" style="font-size: 1.5rem">{{ __("Let's learn Laravel Localization")}}</h4>
        <br><br>
        <h4 class="display-4 text-center" style="font-size: 2.5rem">{{ __("Pluralization Rules")}}</h4>
        <h5 class="display-4 text-center" style="font-size: 1.5rem"><b>Two options: </b><?php echo trans_choice('lang.languages', 2)?></h6>
        <h5 class="display-4 text-center" style="font-size: 1.5rem"><b>Ranges: </b><?php echo trans_choice('lang.languagesRange', 5)?></h6>
        <h5 class="display-4 text-center" style="font-size: 1.5rem"><b>Count Placeholder: </b><?php echo trans_choice('lang.count', 5)?></h6>
                
                    </div>                
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    fetch_data();
    
    function fetch_data(query = '')
    {
        $.ajax({
            url:"{{ route('home.search') }}",
            method:'GET',
            data:{query:query},
            dataType:'json',
            success:function(data)
            {
                $('tbody').html(data.table_data);
                
            }
        })
    }
    $(document).on('keyup','#search',function(){
        var query = $(this).val();
        fetch_data(query);
    });

});
</script>


@endsection
