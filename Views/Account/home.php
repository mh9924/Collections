<section id="about">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 mx-auto">
				<h2>My Account</h2>
				<h6><a href="#">SETTINGS</a> | <a href="?controller=Account&action=logout">LOGOUT</a></h6>
				<br>
				<p class="lead">My Games</p>
				
				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th>Game Name</th>
								<th># Cards</th>
							</tr>
						</thead>
						<tbody>
						<?php foreach ($currentUser->games() as $game){ ?>
							<tr>
								<td><?php echo $game->name; ?></td>
								<td><?php echo $game->numCards(); ?></td>
							</tr>
						<?php } ?>
							<tr>
								<td><a href="?controller=Account&action=addGame">+ Add Game...</a></td>
							</tr>
					</table>
				</div>
				
				<p class="lead">My Cards</p>
				
				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th>Name</th>
								<th>Rarity</th>
								<th>Added On</th>
								<th>Rating</th>
							</tr>
						</thead>
						<tbody>
						<?php foreach ($currentUser->cards() as $card){ ?>
							<tr>
								<td><?php echo $card->name; ?></td>
								<td><?php echo $card->rarity; ?></td>
								<td><?php echo $card->addDate; ?></td>
								<td><?php echo $card->rating; ?></td>
							</tr>
						<?php } ?>
							<tr>
								<td><a href="?controller=Account&action=addGame">+ Add Card...</a></td>
							</tr>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>