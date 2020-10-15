<div class="row">
	<?php foreach ($badges as $badge) : ?>
		<div class="col-4">
			<?php $this->load('card', $resource, compact('badge')); ?>
		</div>
	<?php endforeach; ?>
</div>
