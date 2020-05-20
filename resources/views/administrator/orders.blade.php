@extends('layouts.admin.app')
    
@section('adcontent')
        
    @include('layouts.admin.sidebar')

                
        <!-- ============================================================== -->
        <!-- Page Content -->
        <!-- ============================================================== -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Orders page</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <a href="/home" target="_blank"
                            class="btn btn-danger pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">View Website</a>
                        <ol class="breadcrumb">
                            <li><a href="#">Dashboard</a></li>
                            <li class="active">Orders Page</li>
                        </ol>
                    </div>
                </div>
        
                <!-- /.row -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title">Order Table </h3>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th><strong>User</strong></th>
                                            <th><strong>Product</strong></th>
                                            <th><strong>Price</strong></th>
                                            <th><strong>Contact</strong></th>
                                            <th><strong>Option</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($orders as $order)
                                            <tr>
                                                <td>{{App\Cart::find($order->pivot->cart_id)->user->name}}</td>
                                                <td>{{$order->product_name}}</td>
                                                <td>{{number_format($order->price * $order->pivot->quantity)}}</td>
                                                <td>{{App\Cart::find($order->pivot->cart_id)->user->contact}}</td> 
                                                <td>
                                                    <a href = "/admini/{{$order->pivot->product_id}}/{{$order->pivot->cart_id}}/updatecart" class="edit" style="position:relative; left:10px;" data-toggle="tooltip" data-placement="top" title="Confirm delivery">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                    <a class="delete" href="/admini/{{$order->pivot->product_id}}/{{$order->pivot->cart_id}}/delete" data-toggle="tooltip" data-placement="top" title="Delete from orders" href="#" style="position:relative; left:20px;"  >
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
                <!-- /.row -->
            
            @if($orderedss)
                <!-- /.row -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title">Ordered Table </h3>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th><strong>User</strong></th>
                                            <th><strong>Product</strong></th>
                                            <th><strong>Price</strong></th>
                                            <th><strong>Contact</strong></th>
                                            <th><strong>Option</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($orderedss as $ordered)
                                            <tr>
                                                <td>{{App\Cart::find($ordered->pivot->cart_id)->user->name}}</td>
                                                <td>{{$ordered->product_name}}</td>
                                                <td>{{number_format($ordered->price * $ordered->pivot->quantity)}}</td>
                                                <td>{{App\Cart::find($ordered->pivot->cart_id)->user->contact}}</td> 
                                                <td>
                                                    <a class="delete" href="/admini/{{$ordered->pivot->product_id}}/{{$ordered->pivot->cart_id}}/delete" data-toggle="tooltip" data-placement="top" title="Delete from orders" href="#" style="position:relative; left:20px;"  >
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
                <!-- /.row -->
            @endif
                
</div>
<!-- /.container-fluid -->
<footer class="footer text-center"> 2020 &copy; Ematt Admin :) </footer>
</div>
<!-- /#page-wrapper -->
</div>


@endsection