<section id="about">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 mx-auto">
				<h2>Games</h2>
				<p class="lead">
				
				
				Browse games
				
				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th>Name</th>
								<th>Fields</th>
								<th># Cards</th>
								<th>By</th>
							</tr>
						</thead>
						<tbody>
						<?php foreach ($games as $game){ ?>
							<tr>
								<td><?php echo htmlspecialchars($game->name); ?></td>
								<td><?php echo htmlspecialchars($game->fields); ?></td>
								<td><?php echo $game->numCards(); ?></td>
								<td><a href="?controller=Users&action=viewProfile&userID=<?php echo $game->userID; ?>"><?php echo htmlspecialchars($game->username); ?></a></td>
							</tr>
						<?php } ?>
					</table>
				</div>
				</p>
			</div>
		</div>
	</div>
</section>