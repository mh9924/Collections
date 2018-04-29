<section id="about">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 mx-auto">
				<h2>My Account</h2>
				<h6><a href="#">SETTINGS</a> | <a href="?controller=Account&action=logout">LOGOUT</a></h6>
				<p class="lead">Browse your games</p>
				
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
			</div>
		</div>
	</div>
</section>