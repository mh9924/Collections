<section id="about">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 mx-auto">
				<h2>Register</h2>
				<p class="lead">Create a new account</p>
				
				<?php 
				if (isset($registerErrors)) {
					foreach($registerErrors as $registerError) { ?>
				<strong style="color: red">
				<?php echo $registerError; ?>
				</strong>
				<?php
					}
				}
				?>
				
				<form method="POST" action="?controller=Account&action=register">
					<div class="form-group">
						<input type="username" placeholder="Enter a username" class="form-control" name="username">
						<input type="password" placeholder="Enter a password" class="form-control" name="password">
						<input type="password" placeholder="Enter password again" class="form-control" name="password2">
					</div>
					<button type="submit" class="btn btn-default" style="margin-bottom: 10px;">Register</button>
				</form>
			</div>
		</div>
	</div>
</section>