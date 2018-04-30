<section id="about">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 mx-auto">
				<h2>My Account</h2>
				<h6><a href="?controller=Account&action=home">HOME</a> | <a href="#">SETTINGS</a> | <a href="?controller=Account&action=logout">LOGOUT</a></h6>
				<p><h4>Add a deck</h4></p>
				<?php 
				if (isset($addErrors)) {
					foreach ($addErrors as $addError) { ?>
				<strong style="color: red;"><?php echo $addError; ?></strong>
				<br>
				<?php 
					}
				} ?>
				<form method="POST" action="?controller=Account&action=addDeck">
					<div class="form-group">
						<label for="name">Deck Name:</label>
						<input type="text" placeholder="Enter a name" class="form-control" name="name" id="name">
						<br>
						<label for="gameid">Add to Game:</label>
						<select class="form-control" name="gameid" id="gameid">
							<option value="0"></option>
							<?php foreach ($userGames as $userGame) { ?>
							<option value="<?php echo $userGame->id; ?>"><?php echo $userGame->name; ?></option>
							<?php } ?>
						</select>
					</div>
					<button type="submit" class="btn btn-default" style="margin-bottom: 10px;">Add</button>
				</form>
			</div>
		</div>
	</div>
</section>