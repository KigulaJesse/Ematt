@extends('layouts.admin.app')
    
@section('adcontent')
<style>
    body {font-family: Arial, Helvetica, sans-serif;}
    * {box-sizing: border-box;}
    
    /* The popup form - hidden by default */
    .form-popup {
      display: none;
      position: absolute;
      top: 50%; 
            left: 50%; 
            margin-top: -150px; 
            margin-left: -150px; 
        
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
                        <h4 class="page-title">sub_categories </h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <a href="/home" target="_blank"
                            class="btn btn-danger pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">View Website</a>
                        <ol class="breadcrumb">
                            <li><a href="#">Dashboard</a></li>
                            <li class="active">{{$category->category_name}}</li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                <!-- /.row -->
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="white-box">
                                <h3 class="box-title">{{$category->category_name}}<button type = "submit" class="btn btn-success w-10 h-10" style="float:right;" onclick="openpopForm()">Add sub_category</button><a href="/admini/categories" class="btn btn-danger w-25 h-25" style = "float:right;position:relative; right:10px; ">back</a></h3>
                                <div class="form-popup" id="mypopForm">
                                    <form action="/admini/category/{{$category->id}}" method = "post" class="form-container">
                                        @csrf
                                        <h1>Sub_category</h1>
                                        <input type="text"  placeholder="sub_category name" name="category_name" required>
                                        <button type="submit" class="btn">Add sub_category</button>
                                        <button type="button" class="btn cancel" onclick="closepopForm()">Close</button>
                                    </form>
                                </div>
                                <div class="table-responsive">
                                    @if($sub_categories)
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th><strong>id</strong></th>
                                                <th><strong>sub_category_name</strong></th>
                                                <th><strong>Number of sub_categories</strong></th>
                                                <th><strong>Option</strong></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                @foreach($sub_categories as $sub_category)
                                                    <tr>
                                                        <td>{{$sub_category->id}}</td>
                                                        <td><div >{{$sub_category->category_name}}</div></td>
                                                        <td><div style="position:relative; left:17px;">0</div></td>
                                                        
                                                        <td>
                                                            <a class="edit" style="position:relative; left:10px;" data-toggle="tooltip" data-placement="top" title="Edit" onclick="openForm()">
                                                                <i class="fa fa-pencil"></i>
                                                            </a>
                                                            <div class="form-popup" id="myForm">
                                                                <form action="/admini_category/{{$sub_category->id}}/update" method = "post" class="form-container">
                                                                    @csrf
                                                                    @method('put')
                                                                    <h1>Edit {{$sub_category->category_name}}</h1>
                                                                    <input type="text" value="{{$sub_category->category_name}}" name="category_name" required>
                                                                    <button type="submit" class="btn">Edit sub_category</button>
                                                                    <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
                                                                </form>
                                                            </div>
                                        
                                                            <a class="delete" data-toggle="tooltip" data-placement="top" title="Delete from cart" href="/admini/{{$sub_category->id}}/deleteSub_category/{{$category->id}}" style="position:relative; left:20px;"  >
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                        </tbody>
                                    </table>
                                    @else
                                        <h1>No added sub_categories yet</h1>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                @error('category_name')
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