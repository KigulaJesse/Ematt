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
                <h3>{{Auth::user()->name}} profile</h3>
			</div>
		</div>
	</div>
	<!-- Container End -->
</section>

<section class="user-profile section">
	<div class="container">
		<div class="row">
			<div class="col-md-10 offset-md-1 col-lg-3 offset-lg-0">
				<div class="sidebar">
					<!-- User Widget -->
					<div class="widget user">
						<!-- User Image -->
						<div class="image d-flex justify-content-center">
							<img src="images/user/user-thumb.jpg" alt="" class="">
						</div>
						<!-- User Name -->
						<h5 class="text-center">{{ Auth::user()->name }}</h5>
					</div>
					<!-- Dashboard Links -->
					<div class="widget dashboard-links">
						<ul>
							<li><a class="my-1 d-inline-block" href="">Savings Dashboard</a></li>
							<li><a class="my-1 d-inline-block" href="">Saved Offer <span>(5)</span></a></li>
							<li><a class="my-1 d-inline-block" href="">Favourite Stores <span>(3)</span></a></li>
							<li><a class="my-1 d-inline-block" href="">Recommended</a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-md-10 offset-md-1 col-lg-9 offset-lg-0">
				<!-- Edit Profile Welcome Text -->
				<div class="widget welcome-message">
					<h2>Edit profile</h2>
					<p>Hey {{ Auth::user()->name }}, we'd like to get to know you better.</p>
				</div>
				<!-- Edit Personal Info -->
				<div class="row">	
					<!--------------CHANGE PERSONAL INFO-------------->
					<div class="col-lg-6 col-md-6">
						<div class="widget personal-info">
							<h3 class="widget-header user">Edit Personal Information</h3>
							<form action="#">
								<!-- First Name -->
								<div class="form-group">
									<label for="first-name">First Name</label>
									<input type="text" class="form-control" name="name" id="first-name">
								</div>
								<!-- Last Name -->
								<div class="form-group">
									<label for="last-name">Last Name</label>
									<input type="text" class="form-control" name="lastName" id="last-name">
								</div>
								<!-- File chooser -->
								<div class="form-group choose-file d-inline-flex">
									<i class="fa fa-user text-center px-3"></i>
									<input type="file" class="form-control-file mt-2 pt-1" id="input-file">
								 </div>
								<!-- Comunity Name 
								<div class="form-group">
									<label for="comunity-name">Comunity Name</label>
									<input type="text" class="form-control" name="communityName" id="comunity-name">
								</div>
								<! Checkbox 
								<div class="form-check">
								  <label class="form-check-label" for="hide-profile">
									<input class="form-check-input mt-1" type="checkbox" value="" id="hide-profile">
									Hide Profile from Public/Comunity
								  </label>
								</div>-->
								<!-- Zip Code 
								<div class="form-group">
									<label for="zip-code">Zip Code</label>
									<input type="text" class="form-control" id="zip-code">
								</div>-->
								<!-- Submit button -->
								<button class="btn btn-transparent">Save My Changes</button>
							</form>
						</div>
					</div>
					<!------------------------------------------------>
				</div>

				<div class = 'row'>
					<!--------------CHANGE PASSWORD ------------------>
					<div class="col-lg-6 col-md-6">
						<div class="widget change-password">
							<h3 class="widget-header user">Edit Password</h3>
							<form method = "POST" action="{{ route('password.update') }}">
								@csrf
								<!-- Current Password -->
								<div class="form-group">
									<label for="current-password">Current Password</label>
									<input type="password" name="password" class="form-control" id="current-password">
								</div>
								<!-- New Password -->
								<div class="form-group">
									<label for="new-password">New Password</label>
									<input type="password" class="form-control" id="new-password">
								</div>
								<!-- Confirm New Password -->
								<div class="form-group">
									<label for="confirm-password">Confirm New Password</label>
									<input type="password" class="form-control" id="confirm-password">
								</div>
								<!-- Submit Button -->
								<button class="btn btn-transparent">Change Password</button>
							</form>
						</div>
					</div>
					<!------------------------------------------------>
				</div>
				
				<div class="row">
					<!------------------CHANGE EMAIL------------------>
					<div class="col-lg-6 col-md-6">
						<!-- Change Email Address -->
						<div class="widget change-email mb-0">
							<h3 class="widget-header user">Edit Email Address</h3>
							<form action="#">
								<!-- Current Password -->
								<div class="form-group">
									<label for="current-email">Current Email</label>
									<input type="email" class="form-control" id="current-email">
								</div>
								<!-- New email -->
								<div class="form-group">
									<label for="new-email">New email</label>
									<input type="email" class="form-control" id="new-email">
								</div>
								<!-- Submit Button -->
								<button class="btn btn-transparent">Change email</button>
							</form>
						</div>
					</div>
					<!------------------------------------------------>

				</div>
			</div>
		</div>
	</div>
</section>
@endsection