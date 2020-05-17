@extends('layouts.admin.app')
    
@section('adcontent')
<style>
    body {font-family: Arial, Helvetica, sans-serif;}
    * {box-sizing: border-box;}
    
    /* The popup form - hidden by default */
    .form-popup {
      display: none;
      position: absolute;
      top: 20px;
      left: 300px;
      
      border: 3px solid #f1f1f1;
      z-index: 9;
    }
    
    /* Add styles to the form container */
    .form-container {
      max-width: 300px;
      padding: 10px;
      background-color: white;
    }
    
    /* Full-width input fields */
    .form-container input[type=text], .form-container input[type=password] {
      width: 100%;
      padding: 15px;
      margin: 5px 0 22px 0;
      border: none;
      background: #f1f1f1;
    }
    
    /* When the inputs get focus, do something */
    .form-container input[type=text]:focus, .form-container input[type=password]:focus {
      background-color: #ddd;
      outline: none;
    }
    
    /* Set a style for the submit/login button */
    .form-container .btn {
      background-color: #4CAF50;
      color: white;
      padding: 16px 20px;
      border: none;
      cursor: pointer;
      width: 100%;
      margin-bottom:10px;
      opacity: 0.8;
    }
    
    /* Add a red background color to the cancel button */
    .form-container .cancel {
      background-color: red;
    }
    
    /* Add some hover effects to buttons */
    .form-container .btn:hover, .open-button:hover {
      opacity: 1;
    }
</style>
   
        
    @include('layouts.admin.sidebar')
     <!-- ============================================================== -->
        <!-- Page Content -->
        <!-- ============================================================== -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Edit Site page</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <a href="/home" target="_blank"
                            class="btn btn-danger pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">View Website</a>
                        <ol class="breadcrumb">
                            <li><a href="#">Dashboard</a></li>
                            <li class="active">Edit Page</li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                <!-- /.row -->
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="white-box">
                                <h3 class="box-title">Districts Table <button type = "submit" class="btn btn-success" style="position:relative; left:700px;" onclick="openpopForm()">Add District</button></h3>
                                <div class="form-popup" id="mypopForm">
                                    <form action="/admini/district" method = "post" class="form-container">
                                        @csrf
                                        <h1>Add district</h1>
                                        <input type="text"  placeholder="District name" name="district_name" required>
                                        <input type="text" placeholder="10,000" name="fee" required>
                                        <button type="submit" class="btn">Add District</button>
                                        <button type="button" class="btn cancel" onclick="closepopForm()">Close</button>
                                    </form>
                                </div>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th><strong>District_name</strong></th>
                                                <th><strong>Number of Users</strong></th>
                                                <th><strong>Transport Fare</strong></th>
                                                <th><strong>Option</strong></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($districts as $district)
                                                <tr>
                                                    <td>{{$district->district_name}}</td>
                                                    <td><div style="position:relative; left:40px">@if(count($district->users)>0) {{count($district->users)}} @else 0 @endif</div></td>
                                                    <td><div style="position:relative; left:17px;">{{number_format($district->delivery_fee)}}</div></td>
                                                    
                                                    <td>
                                                        <a class="edit" style="position:relative; left:10px;" data-toggle="tooltip" data-placement="top" title="Edit" onclick="openForm()">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>
                                                        <div class="form-popup" id="myForm">
                                                            <form action="/admini/{{$district->id}}/update" method = "post" class="form-container">
                                                                @csrf
                                                                @method('put')
                                                                <h1>Edit {{$district->district_name}}</h1>
                                                                <input type="text" value="{{$district->district_name}}" name="district_name" required>
                                                                <input type="text" value="{{$district->delivery_fee}}" name="fee" required>
                                                                <button type="submit" class="btn">Edit District</button>
                                                                <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
                                                            </form>
                                                        </div>
                                    
                                                        <a class="delete" data-toggle="tooltip" data-placement="top" title="Delete from cart" href="/admini/{{$district->id}}/deleteDistrict" style="position:relative; left:20px;"  >
                                                            <i class="fa fa-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                @error('district_name')
                    <span class="invalid-feedback" style="color:red;" role="alert">
                       *{{$message }}
                    </span>
                @enderror
                @error('fee')
                    <span class="invalid-feedback" style="color:red;" role="alert">
                       *{{ $message }}
                    </span>
                @enderror
                <script>
                    function openForm() {
                    document.getElementById("myForm").style.display = "block";
                    }

                    function closeForm() {
                    document.getElementById("myForm").style.display = "none";
                    }
                    function openpopForm() {
                    document.getElementById("mypopForm").style.display = "block";
                    }

                    function closepopForm() {
                    document.getElementById("mypopForm").style.display = "none";
                    }
                </script>
                    <!-- /.row -->
                       
                    </div>
            <!-- /.container-fluid -->
            <footer class="footer text-center"> 2020 &copy; Ematt Admin :) </footer>
        </div>
        <!-- /#page-wrapper -->
    </div>


@endsection