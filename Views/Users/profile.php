<section id="about">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 mx-auto">
				<h2>User Profile: <?php echo htmlspecialchars($user->username); ?></h2>
				<p class="lead">
				
				Registered on <?php echo date("Y-m-d", $user->registrationDate); ?>
				
				<h3>Games</h3>
				<table class="table">
						<thead>
							<tr>
								<th>Name</th>
								<th>Fields</th>
								<th># Cards</th>
							</tr>
						</thead>
					<tbody>
					<?php foreach ($games as $game) { ?>
						<tr>
							<td><?php echo htmlspecialchars($game->name); ?></td>
							<td><?php echo htmlspecialchars($game->fields); ?></td>
							<td><?php echo $game->numCards(); ?></td>
						</tr>
					<?php } ?>
					</tbody>
				</table>
				</p>
		</div>
	</div>
</section>