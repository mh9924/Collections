<section id="about">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 mx-auto">
				<h2>My Account</h2>
				<h6><a href="#">SETTINGS</a> | <a href="?controller=Account&action=logout">LOGOUT</a></h6>
				<br>
				<h4>My Games</h4>
				
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
				
				<h4>My Cards</h4>
				
				<p class="lead">After making a game, you can add cards to it.</p>
				
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
								<td><?php echo date("Y-m-d", $card->addDate); ?></td>
								<td><?php echo $card->rating; ?></td>
							</tr>
						<?php } ?>
							<tr>
								<td><a href="?controller=Account&action=addCard">+ Add Card...</a></td>
							</tr>
					</table>
				</div>
				
				
				<h4>My Decks</h4>
				
				<p class="lead">Decks are a great way to create groups of cards that can be played with together. A single card may be in one or more decks.</p>
				
				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th>Name</th>
								<th># Cards</th>
							</tr>
						</thead>
						<tbody>
						<?php foreach ($currentUser->decks() as $deck){ ?>
							<tr>
								<td><?php echo $deck->name; ?></td>
								<td><?php echo $deck->numCards; ?></td>
							</tr>
						<?php } ?>
							<tr>
								<td><a href="?controller=Account&action=addCard">+ Add Deck...</a></td>
							</tr>
					</table>
				</div>
				
			</div>
		</div>
	</div>
</section>