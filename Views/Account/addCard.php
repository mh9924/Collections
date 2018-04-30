<section id="about">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 mx-auto">
				<h2>My Account</h2>
				<h6><a href="#">SETTINGS</a> | <a href="?controller=Account&action=logout">LOGOUT</a></h6>
				<p class="lead">Add a card</p>
				<?php 
				if (isset($addErrors)) {
					foreach ($addErrors as $addError) { ?>
				<strong style="color: red;"><?php echo $addError; ?></strong>
				<br>
				<?php 
					}
				} ?>
				<form method="POST" action="?controller=Account&action=addCard">
					<div class="form-group">
						<label for="name">Card Name:</label>
						<input type="text" placeholder="Enter a name" class="form-control" name="name" id="name">
						<br>
						<label for="rarity">Rarity:</label>
						<select class="form-control" name="rarity" id="rarity">
							<option value="0"></option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
						</select>
						<br>
						<label for="rating">Rating:</label>
						<select class="form-control" name="rating" id="rating">
							<option value="0"></option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
							<option value="9">9</option>
							<option value="10">10</option>
						</select>
						<br>
						<label for="rating">Add to Game:</label>
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