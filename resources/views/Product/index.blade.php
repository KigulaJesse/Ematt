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
          
          <div class="sidebar">
            <!-- User Widget -->
            <div class="widget user-dashboard-profile">
              <!-- User Image -->
              <div class="profile-thumb">
                <img src="images/user/user-thumb.jpg" alt="" class="rounded-circle">
              </div>
              <!-- User Name -->
              @auth
                <h5 class="text-center">{{ Auth::user()->name }}</h5>
              @else
              {{ route('/') }}
             @endauth
              <p>Joined February 06, 2017</p>
              <a href="/update" class="btn btn-main-sm">Edit Profile</a>
            </div>
            <!-- Dashboard Links -->
            <div class="widget user-dashboard-menu">
              <ul>
                <li class="active"><a href="dashboard-my-ads.html"><i class="fa fa-user"></i> My Ads</a></li>
                <li><a href="dashboard-favourite-ads.html"><i class="fa fa-bookmark-o"></i> Favourite Ads <span>5</span></a></li>
                <li><a href="dashboard-archived-ads.html"><i class="fa fa-file-archive-o"></i>Archived Ads <span>12</span></a></li>
                <li><a href="dashboard-pending-ads.html"><i class="fa fa-bolt"></i> Pending Approval<span>23</span></a></li>
                <li><a href="{{route('logout')}}" href="{{ route('logout') }}"onclick="event.preventDefault();
                  document.getElementById('logout-form-product-index').submit();"><i class="fa fa-cog"></i>{{ __('Logout') }}</a></li>
                <form id="logout-form-product-index" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
<!--<li><a href="" data-toggle="modal" data-target="#deleteaccount"><i class="fa fa-power-off"></i>Delete
                    Account</a></li>-->
              </ul>
            </div>
            
            <!-- delete-account modal -->
                                      <!-- delete account popup modal start-->
                  <!-- Modal -->
                  <div class="modal fade" id="deleteaccount" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content">
                        <div class="modal-header border-bottom-0">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body text-center">
                          <img src="images/account/Account1.png" class="img-fluid mb-2" alt="">
                          <h6 class="py-2">Are you sure you want to delete your account?</h6>
                          <p>Do you really want to delete these records? This process cannot be undone.</p>
                          <textarea name="message" id="" cols="40" rows="4" class="w-100 rounded"></textarea>
                        </div>
                        <div class="modal-footer border-top-0 mb-3 mx-5 justify-content-lg-between justify-content-center">
                          <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                          <button type="button" class="btn btn-danger">Delete</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- delete account popup modal end-->
            <!-- delete-account modal -->
  
          </div>
        </div>
        
        <div class="col-md-10 offset-md-1 col-lg-8 offset-lg-0">
          <!-- Recently Favorited -->
          <div class="widget dashboard-container my-adslist">
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
                    <img width="80px" height="auto" src="images/products/{{$product->id}}/1.jpg" alt="image description"></td>
                  <td class="product-details">
                    <h3 class="title">{{$product->product_name}}</h3>
                    <span class="status active"><strong>Price:</strong>{{$product->price}}</span>
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
                  <td class="product-category"><span class="categories">{{$product->category->category_name}}</span></td>
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