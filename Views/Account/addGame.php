<section id="about">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 mx-auto">
				<h2>My Account</h2>
				<h6><a href="?controller=Account&action=home">HOME</a> | <a href="#">SETTINGS</a> | <a href="?controller=Account&action=logout">LOGOUT</a></h6>
				<p><h4>Create a game</h4></p>
				<?php 
				if (isset($addErrors)) {
					foreach ($addErrors as $addError) { ?>
				<strong style="color: red;"><?php echo $addError; ?></strong>
				<br>
				<?php 
					}
				} ?>
				<form method="POST" action="?controller=Account&action=addGame">
					<div class="form-group">
						<label for="name">Game Name:</label>
						<input type="text" placeholder="Enter a name" class="form-control" name="name" id="name">
						<br>
						<label for="fields">Fields (comma-separated, optional):</label>
						<input type="text" placeholder="Fields could include HP, Weakness, or Level" class="form-control" name="fields" id="fields">
					</div>
					<button type="submit" class="btn btn-default" style="margin-bottom: 10px;">Create</button>
				</form>
			</div>
		</div>
	</div>
</section>