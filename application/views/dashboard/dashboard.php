<div class="row">

	<?php foreach ($dashboard as $key) { ?>
		<div class="col-lg-3 col-6">
			<div class="small-box bg-<?= $key->color ?>">
				<div class="inner">
					<h3><?= $key->total ?></h3>
					<p><?= $key->caption ?></p>
				</div>
				<div class="icon">
					<i class="<?= $key->icon ?>"></i>
				</div>
				<a href="<?= $key->url ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
			</div>
		</div>
	<?php } ?>

</div>