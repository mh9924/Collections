<section id="about">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 mx-auto">
				<h2>Cards</h2>
				<p class="lead">
				
				Your search returned <?php echo sizeof($cards); if (sizeof($cards) != 1) echo " results"; else echo " result"; ?>.
				<form method="GET">
					<input type="hidden" name="controller" value="Cards">
					<input type="hidden" name="action" value="search">
					<div class="form-group">
						<label for="searchQuery">Search:</label>
						<input type="text" class="form-control" name="searchQuery">
					</div>
					<button type="submit" class="btn btn-default" style="margin-bottom: 10px;">Search</button>
				</form>
				
				<?php foreach ($cards as $card){ ?>
					<div class="card" style="width: 24rem;margin: 0 auto;margin-bottom:10px;">
						<?php if (!empty($card->imageFile)) { ?>
						<img style ="width: 50%;margin: 0 auto;margin-top: 10px;" class="card-img-top" src="img/cards/<?php echo $card->imageFile; ?>" alt="Card image cap">
						<?php } else { ?>		
						No image yet.
						<?php } ?>
						<div class="card-body">
								<h5 class="card-title"><?php echo $card->name; ?></h5>
								<p class="card-text">Added On: <?php echo $card->addDate; ?></p>
								<p class="card-text">Rarity: <?php echo $card->rarity; ?></p>
								<p class="card-text">Rating: <?php echo $card->rating; ?></p>
								<p class="card-text">Comment: <?php echo $card->rarityComment; ?></p>
								<a href="#" class="btn btn-primary">View deck</a>
						</div>
					</div>
				<?php } ?>
					
				</p>
			</div>
		</div>
	</div>
</section>