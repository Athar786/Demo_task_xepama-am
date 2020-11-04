@extends('layouts.app')

@section('content')
<html lang="en">
<head>
  <title>Multiple Images Upload Example</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
                

                <div class="card-body">
                <div class="container">
                <h2>Simple Form</h2>
                <form action = "/edit/{{ $users->id}}" method="POST">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                    
                    <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" value = "{{ $users->name}}" class="form-control" id="name" name="name">
                    </div>

                    <div class="form-group">
                    <label for="number">Number:</label>
                    <input type="number" value = "{{ $users->number}}" class="form-control" id="number" name="number">
                    </div>


                    
                    <div class="form-group">
                        <label for="State">State:</label>
                        <select name="state" class="form-control" id="state" >
                        @if(count($states)>0)
                        @foreach($states as $items =>$value)
                       
                        @if($items == $users->state)
                            <option selected value="{{ $items }}">{{$value}}</option>
                        @else
                        <option value="{{ $items }}">{{ $value }}</option>
                        @endif 
                        @endforeach
                        @endif 
                            
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="City">City:</label>
                        <select name="city" class="form-control" id="city" name="city">
                        @if(count($cities)>0)
                        @foreach($cities as $items =>$value)
                        @if($items == $users->city)
                            <option selected value="{{ $items }}">{{ $value }}</option>
                        @else
                        <option value="{{ $items }}">{{ $value }}</option>
                        @endif
                        @endforeach
                        @endif
                        </select>
                        
                    </div>

                    <div class = "form-group">
                        <label for = "address">Address</label>
                        <textarea value = "{{ $users->address }}" name="address" id="address" ></textarea>
                    </div>


                    <div class="input-group control-group increment" >
                        <label for="img">Image</label>
                        <input type="file" name="filename[]" class="form-control" value = "{{ $users->filename}}">
                    <div class="input-group-btn">
                        <button class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
                    </div>
                    </div>
                    <div class="clone hide">
                        <div class="control-group input-group" style="margin-top:10px">
                            <input type="file" name="filename[]" class="form-control">
                            <div class="input-group-btn">
                                <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i>Remove</button>
                            </div>
                        </div>
                    </div>



                    <button type="submit" class="btn btn-success">Update</button>
                </form>
                </div>

                <!-- <script type="text/javascript">
                $(document).ready(function(){
                    $(".btn-success").click(function(){
                        var html = $(".clone").html();
                        $(".increment").after(html);
                    });
                    $("body").on("click",".btn-danger",function(){
                        $(this).parents(".control-group").remove();
                    });
                });
                </script> -->


<script type="text/javascript">
 $(document).ready(function() {
     $('select[name="state"]').on('change',function(){
        var stateID = $(this).val();
        if(stateID){
            $.ajax({
                url:'/add/ajax/'+stateID,
                type: "GET",
                dataType: "json",
                success:function(data) {
                    $('select[name="city"]').empty();
                    $.each(data,function(key,value){
                        $('select[name="city"]').append('<option value="'+ key +'">'+ value +'</option>');

                    });
                }
            });
        } else {
            $('select[name="city"]').empty();
        }
     });

 });

</script>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
