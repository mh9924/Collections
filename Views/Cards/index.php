<section id="about">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 mx-auto">
				<h2>Cards</h2>
	
				<p class="lead">Browse cards</p>
				Browse cards created by users. Currently, there are 
				
				<?php
				$end = array_keys($rarityCounts);
				$end = end($end);
				
				foreach ($rarityCounts as $rarity => $rarityCount) 
				{
					if ($rarity == $end)
						echo "and " . $rarityCount . " " . $rarity . " cards.";
					else
						echo $rarityCount . " " . $rarity . " cards, ";
				} 
				?>
				<br>
				<br>
				<div class="card" style="width: 49%;margin: 0 auto;margin-bottom:10px;display: inline-block;">
						<div class="card-body">
								<h6>MOST RECENT CARD</h6>
								<h5 class="card-title"><?php echo htmlspecialchars($newestCard->name); ?></h5>
								<p class="card-text">Added On: <?php echo date("Y-m-d", $newestCard->addDate); ?></p>
						</div>
				</div>
	
				<div class="card" style="width: 49%;margin: 0 auto;margin-bottom:10px;display: inline-block;">
						<div class="card-body">
								<h6>OLDEST CARD</h6>
								<h5 class="card-title"><?php echo htmlspecialchars($oldestCard->name); ?></h5>
								<p class="card-text">Added On: <?php echo date("Y-m-d", $oldestCard->addDate); ?></p>
						</div>
				</div>
				
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
						<img style ="width: 50%;margin: auto;margin-top: 10px;display: block;" class="card-img-top" src="img/error/no-image.png" alt="Card image cap">
						<?php } ?>
						<div class="card-body">
								<h5 class="card-title"><?php echo htmlspecialchars($card->name); ?></h5>
								<p class="card-text">Added On: <?php echo date("Y-m-d", $card->addDate); ?> by <?php echo htmlspecialchars($card->user()->username); ?></p>
								<p class="card-text">
								Rarity: <?php echo $card->rarity; ?>
								(<?php echo $card->rarityDenotation(); ?>)
								</p>
								<p class="card-text">
								Rating: <?php echo $card->rating; ?>
								(<?php echo $card->tierDenotation(); ?>)
								</p>
								<a href="?controller=Users&action=viewProfile&userID=<?php echo $card->user()->id; ?>" class="btn btn-primary">View user profile</a>
						</div>
					</div>
				<?php } ?>
				
				</p>
			</div>
		</div>
	</div>
</section>