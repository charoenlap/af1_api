<section class="py-5">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-4">
				<div class="card">
					<h5 class="card-header">Login</h5>
					<div class="card-body">
						<form action="<?php echo $action; ?>" method="POST">
							<div class="row">
								<div class="col-12">
									<input type="text" name="emp_key" class="form-control mb-3" placeholder="Emp ID">
									<input type="password" name="password" class="form-control mb-3" placeholder="Password">
									<button  class="btn btn-primary w-100">Login</button>
								</div>
							</div>
							<?php if($result){?>
								<div class="row">
									<div class="col-12">
										<p><?php echo $result;?></p>
									</div>
								</div>
							<?php } ?>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>