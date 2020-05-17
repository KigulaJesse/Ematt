@extends('layouts.admin.app')
    
@section('adcontent')
        
    @include('layouts.admin.sidebar')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">Edit {{$usery->name}} page</h4>
                </div>
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <a href="/home" target="_blank"
                        class="btn btn-danger pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">View Website</a>
                    <ol class="breadcrumb">
                        <li><a href="#">Dashboard</a></li>
                        <li class="active">{{$usery->name}} Page</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <!-- <div class="col-md-4 col-xs-12">
                     <div class="white-box">
                         <div class="user-bg"> <img width="100%" alt="user" src="../plugins/images/large/img1.jpg">
                             <div class="overlay-box">
                                 <div class="user-content">
                                     <a href="javascript:void(0)"><img src="../plugins/images/users/genu.jpg"
                                             class="thumb-lg img-circle" alt="img"></a>
                                     <h4 class="text-white">User Name</h4>
                                     <h5 class="text-white">info@myadmin.com</h5>
                                 </div>
                             </div>
                         </div>
                         <div class="user-btm-box">
                             <div class="col-md-4 col-sm-4 text-center">
                                 <p class="text-purple"><i class="ti-facebook"></i></p>
                                 <h1>258</h1>
                             </div>
                             <div class="col-md-4 col-sm-4 text-center">
                                 <p class="text-blue"><i class="ti-twitter"></i></p>
                                 <h1>125</h1>
                             </div>
                             <div class="col-md-4 col-sm-4 text-center">
                                 <p class="text-danger"><i class="ti-dribbble"></i></p>
                                 <h1>556</h1>
                             </div>
                         </div>
                     </div>
                 </div>-->
                 <div class="col-md-8 col-xs-12">
                     <div class="white-box">
                        <form class="form-horizontal form-material" method = "post" action = "/admini/{{$usery->id}}">
                             @csrf
                             @method('put')
                             <div class="form-group">
                                 <label class="col-md-12">Full Name</label>
                                 <div class="col-md-12">
                                    <input type="text" name = "name" value = "{{$usery->name}}"
                                         class="form-control form-control-line"> </div>
                             </div>
                             <div class="form-group">
                                 <label for="example-email" class="col-md-12">Email</label>
                                 <div class="col-md-12">
                                    <input  type="email" value = "{{$usery->email}}"
                                            class="form-control form-control-line" name="email"
                                            id="example-email"> </div>
                                 </div>
                             <div class="form-group">
                                 <label class="col-md-12">Contact</label>
                                 <div class="col-md-12">
                                     <input type="text" name = "contact" value = {{$usery->name}}
                                         class="form-control form-control-line"> </div>
                             </div>
                             
                             <div class="form-group">
                                 <label class="col-sm-12">Select District</label>
                                 <div class="col-sm-12">
                                     <select class="form-control form-control-line">
                                     </select>
                                 </div>
                             </div>
                             <div class="form-group">
                                 <div class="col-sm-12">
                                    <button type = "submit" class="btn btn-success">Update Profile</button>
                                    <a href="/admini/{{$usery->id}}/deleteUser" class="btn btn-danger" style = "position: relative; left: 50px">Delete Profile</a>
                                 </div>
                             </div>
                         </form>
                     </div>
                 </div>
             </div>
             <!-- /.row -->
             @if(count($usery->products)>0)
                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title">Products Table</h3>
                            <p class="text-muted">Add class <code>.table</code></p>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Product_name</th>
                                            <th>price</th>
                                            <th>quantity</th>
                                            <th>Option</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($usery->products as $product)
                                            <tr>
                                                <td>{{$product->id}}</td>
                                                <td>{{$product->product_name}}</td>
                                                <td style="position:relative; left:-15px;">{{number_format($product->price)}}</td>
                                                <td style="position:relative; left:17px;">{{$product->quantity}}</td>
                                                <td><a class="delete" data-toggle="tooltip" data-placement="top" title="Delete from products" href="/admini/{{$product->id}}/delete" style="position:relative; left:15px;">
                                                    <i class="fa fa-trash"></i>
                                                </a></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            @endif
         </div>
         <!-- /.container-fluid -->
         <footer class="footer text-center"> 2020 &copy; Ematt Admin :) </footer>
     </div>
     <!-- /#page-wrapper -->
 </div>
@endsection