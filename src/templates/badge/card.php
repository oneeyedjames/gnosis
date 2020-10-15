<?php

?><div class="mdc-card">
	<div class="mdc-card__content">
		<div class="mdc-typography--subtitle2 mdc-theme--text-hint-on-light"><?php echo ucfirst($badge->type); ?></div>
		<div class="mdc-typography--subtitle1">
			<a href="<?php echo "$badge->type/$badge->id"; ?>"
				class="mdc-theme--primary" style="text-decoration: none"><?php echo $badge->title; ?></a>
		</div>
		<p class="mdc-typography--body2 line-2"><?php echo $badge->summary; ?></p>
	</div>
</div>
