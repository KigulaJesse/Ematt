<section class="page-search" style = " background-color:forestgreen;">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<!-- Advance Search -->
				<div class="advance-search">
					<form method = "POST" action = "/category">
						@csrf
						<div class="form-row">
							<div class="form-group col-md-10">
								<input type="text" name = 'category' class="form-control my-2 my-lg-0" id="inputCategory4" placeholder="Welcome {{Auth::user()->name}}, what are you looking for in Ematt today?">
							</div>
							<!--<div class="form-group col-md-4">
								<input type="text" class="form-control my-2 my-lg-0" id="inputtext4" placeholder="Brand">
							</div>
							<div class="form-group col-md-3">
								<input type="text" class="form-control my-2 my-lg-0" id="inputLocation4" placeholder="Location">
							</div>-->
							<div class="form-group col-md-2">
								<button type="submit" class="btn btn-primary" style = "">Search Now</button>
							</div>
						</div>

					</form>
				</div>
			</div>
		</div>
	</div>
</section>
