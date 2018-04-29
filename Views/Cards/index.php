<section id="about">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 mx-auto">
				<h2>Cards</h2>
	
				<div class="card" style="width: 49%;margin: 0 auto;margin-bottom:10px;display: inline-block;">
						<div class="card-body">
								<h6>MOST RECENT CARD</h6>
								<h5 class="card-title"><?php echo $newestCard->name; ?></h5>
								<p class="card-text">Added On: <?php echo date("Y-m-d", $newestCard->addDate); ?></p>
								<a href="#" class="btn btn-primary">View user's decks</a>
						</div>
				</div>
	
				<div class="card" style="width: 49%;margin: 0 auto;margin-bottom:10px;display: inline-block;">
						<div class="card-body">
								<h6>OLDEST CARD</h6>
								<h5 class="card-title"><?php echo $oldestCard->name; ?></h5>
								<p class="card-text">Added On: <?php echo date("Y-m-d", $oldestCard->addDate); ?></p>
								<a href="#" class="btn btn-primary">View user's decks</a>
						</div>
				</div>
					
				<p class="lead">Browse cards</p>
				<form method="GET">
					<input type="hidden" name="controller" value="Cards">
					<input type="hidden" name="action" value="search">
					<div class="form-group">
						<label for="searchQuery">Search:</label>
						<input type="text" placeholder="Name" class="form-control" name="searchQuery">
					</div>
					<button type="submit" class="btn btn-default" style="margin-bottom: 10px;">Search</button>
				</form>
				
				<?php foreach ($cards as $card){ ?>
					<div class="card" style="width: 49%;margin: 0 auto;margin-bottom:10px;display: inline-block;">
						<?php if (!empty($card->imageFile)) { ?>
						<img style ="width: 50%;margin: auto;margin-top: 10px;display: block;" class="card-img-top" src="img/cards/<?php echo $card->imageFile; ?>" alt="Card image cap">
						<?php } else { ?>		
						No image yet.
						<?php } ?>
						<div class="card-body">
								<h5 class="card-title"><?php echo $card->name; ?></h5>
								<p class="card-text">Added On: <?php echo date("Y-m-d", $card->addDate); ?> by <?php echo $card->user()->username; ?></p>
								<p class="card-text">
								Rarity: <?php echo $card->rarity; ?>
								<?php if (!empty($card->rarityDenotation())) { ?>
								(<?php echo $card->rarityDenotation(); ?>)
								<?php } ?>
								</p>
								<p class="card-text">
								Rating: <?php echo $card->rating; ?>
								<?php if (!empty($card->tierDenotation())) { ?>
								(<?php echo $card->tierDenotation(); ?>)
								<?php } ?>
								</p>
								<a href="#" class="btn btn-primary">View user's decks</a>
						</div>
					</div>
				<?php } ?>
				
				</p>
			</div>
		</div>
	</div>
</section>