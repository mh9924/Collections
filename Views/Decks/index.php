<section id="about">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 mx-auto">
				<h2>Decks</h2>
				<p class="lead">
				
				
				Browse decks
				
				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th>Name</th>
								<th># Cards</th>
								<th>By</th>
							</tr>
						</thead>
						<tbody>
						<?php foreach ($decks as $deck){ ?>
							<tr>
								<td><?php echo htmlspecialchars($deck->name); ?></td>
								<td><?php echo $deck->numCards; ?></td>
								<td><a href="?controller=Users&action=viewProfile&userID=<?php echo $deck->user()->id; ?>"><?php echo htmlspecialchars($deck->user()->username); ?></a></td>
							</tr>
						<?php } ?>
					</table>
				</div>
				</p>
			</div>
		</div>
	</div>
</section>