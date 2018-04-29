<section id="about">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 mx-auto">
				<h2>Login</h2>
				<p class="lead">Login to access account management</p>
				
				<strong style="color: red">
				<?php if (isset($error)) echo $error; ?>
				</strong>
				
				<form method="POST" action="?controller=Account&action=login">
					<div class="form-group">
						<input type="username" placeholder="Username" class="form-control" name="username">
						<input type="password" placeholder="Password" class="form-control" name="password">
					</div>
					<button type="submit" class="btn btn-default" style="margin-bottom: 10px;">Login</button>
				</form>
			</div>
		</div>
	</div>
</section>