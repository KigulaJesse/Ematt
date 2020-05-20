@extends('layouts.app')

@section('content')
<!--================================
=            Page Title            =
=================================-->
<section class="page-title" style ="background-color:forestgreen;   ">
	  <!-- Container Start -->
	  <div class="container">
		    <div class="row">
			      <div class="col-md-8 offset-md-2 text-center">
				        <!-- Title text -->
                <h3>{{Auth::user()->name}}'s products</h3>
			      </div>
		    </div>
	  </div>
	  <!-- Container End -->
</section>

<section class="dashboard section">
    <div class="container">
        <!-- Row Start -->
        <div class="row">
            <div class="col-md-10 offset-md-1 col-lg-4 offset-lg-0">
                @include('layouts.product.sidebar')
            </div>
        
            <div class="col-md-10 offset-md-1 col-lg-8 offset-lg-0">
                
                <!-- Recently Favorited -->
                <div class="widget dashboard-container my-adslist" @if(count($products)==0) style = "position:relative; top:50px; " @endif>
                    @if(count($products)>0)
                        <table class="table table-responsive product-dashboard-table">
                              <thead>
                                  <tr>
                                      <th>Image</th>
                                      <th>Product Title</th>
                                      <th class="text-center">Category</th>
                                      <th class="text-center">Action</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  @foreach($products as $product)
                                      <tr>
                                          <td class="product-thumb">
                                              <img width="80px" height="auto" src="images/products/{{$product->id}}/1.jpg" alt="image description">
                                          </td>
                                          <td class="product-details">
                                              <h3 class="title">{{$product->product_name}}</h3>
                                              <span class="status active"><strong>Price:</strong>{{number_format($product->price)}}</span>
                                              <span class="status"><strong>Quantity:</strong>{{$product->quantity}}</span>
                                              @if($product->brand)
                                                  <span class="location"><strong>Brand:</strong>{{$product->brand}}</span>
                                              @endif
                                              @if($product->color)
                                                  <span class="add-id"><strong>Color:</strong>{{$product->color}}</span>
                                              @else
                                                  <span><strong>Posted on: </strong><time>{{$product->created_at}}</time> </span>
                                              @endif
                                          </td>
                                          <td class="product-category">
                                              <span class="categories">{{$product->category->last()->category_name}}</span>
                                          </td>
                                          <td class="action" data-title="Action">
                                              <div class="">
                                                  <ul class="list-inline justify-content-center">
                                                      <li class="list-inline-item">
                                                          <a data-toggle="tooltip" data-placement="top" title="view" class="view" href="/products/{{$product->id}}">
                                                              <i class="fa fa-eye"></i>
                                                          </a>
                                                      </li>
                                                      <li class="list-inline-item">
                                                          <a class="edit" data-toggle="tooltip" data-placement="top" title="Edit" href="/products/{{$product->id}}/edit">
                                                              <i class="fa fa-pencil"></i>
                                                          </a>
                                                      </li>
                                                      <li class="list-inline-item">
                                                          <a class="delete" data-toggle="tooltip" data-placement="top" title="Delete" href ="/products/{{$product->id}}/delete">
                                                              <i class="fa fa-trash"></i>
                                                          </a>
                                                      </li>
                                                  </ul>
                                              </div>
                                          </td>
                                      </tr>
                                  @endforeach
                              </tbody>
                        </table>
                    @else
                        <h1 style = "position:relative; left: 90px;"> Deleted all products</h1>
                    @endif
                </div>

                <!-- pagination 
                <div class="pagination justify-content-center">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Previous</span>
                                </a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item active"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <!-- pagination -->

            </div>
        </div>
        <!-- Row End -->
    </div>
    <!-- Container End -->
</section>

@endsection