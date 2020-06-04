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
										<input type="text" name = 'search' class="form-control my-2 my-lg-0" id="inputCategory4" @if(isset(Auth::user()->name))placeholder="Welcome {{Auth::user()->name}}, what are you looking for in Ematt today?"@else placeholder="Welcome what are you looking for in Ematt today?" @endif  >
									</div>
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
