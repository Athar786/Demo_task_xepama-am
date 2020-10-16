@extends('layouts.app')

@section('content')
<html lang="en">
<head>
  <title>Multiple Images Upload Example</title>
  
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
 
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js" ></script> 

    <script>
        $(document).ready(function() {           
            $('#addform').validate({
                
                rules: {
                    name: {
                        required: true
                    },
                    number: {
                        required: true
                    },
                    address: {
                        required: true
                    },
                },
                messages:{
                    name:{
                        required:"please Enter valid Name",
                    },
                    number:{
                        required:"please Enter valid Number",
                    },
                    address:{
                        required:"please Enter address",
                    }                                 
                }
            });
        });
    
    </script>


</head>
<body>  
<style>
    .error {
        color:red
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-15">
            <div class="card">
                <div class="card-header">{{ __('Form') }}</div>

                <a href="/home" class="btn btn-primary">Back Home</a>

            
                <div class="card-body">
                <div class="container">
                <h2>Simple Form</h2>
             
                <hr/>

                @if($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                <strong>{{ $message }}</strong></div>
                @endif

               
                <form id="addform" action="{{route('add.store')}}" method="post" accept-charset="utf-8">
                {{csrf_field()}}
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" />
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    </div>

                    <div class="form-group">
                        <label for="number">Number:</label>
                        <input type="number" class="form-control" id="number" placeholder="Enter Mobile NO" name="number" />
                        <span class="text-danger">{{ $errors->first('number') }}</span>
                    </div>


                    <div class="form-group">
                        <label for="hobbies">Hobbies:</label>
                        <label><input type="checkbox" name="hobbies[]" value="music" > Music</label>
                        <label><input type="checkbox" name="hobbies[]" value="dance"> Dance</label>
                        <label><input type="checkbox" name="hobbies[]" value="travelling"> Travelling</label>
                    </div>

                    <div class = "form-group">
                        <label for = "gender">Gender</label>
                        <label><input type="radio" name="gender" value="male"> Male</label>
                        <label><input type="radio" name="gender" value="female">Female</label>
                    </div>

                   
                    <div class="form-group">
                        <label for="name">State:</label>
                        <select name="state" class="form-control"  >
                        <option disabled selected value="">--- Select State ---</option>
                        @foreach($states as $key => $value)
                            <option value="{{$key}}">{{ $value }}</option>
                          
                        @endforeach
                        
                        </select>
                        
                    </div>

                    <div class="form-group">
                        <label for="name">City:</label>
                        <select name="city" class="form-control" id="city">       
                        </select>
                        
                    </div>


                    <div class = "form-group">
                        <label for = "address">Address</label>
                        <textarea name="address" class="form-control" ></textarea>
                        <span class="text-danger">{{ $errors->first('address') }}</span>
                    </div>

                    <div class="form-group">
                    
                    <div class="input-group control-group increment " >
                        <label for="img">Image</label>
                        <input type="file" name="filename[]" class="form-control" multiple/>
                    </div>
                    </div>
                 

                    <br/>
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
                
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
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

</body>
</html>
@endsection