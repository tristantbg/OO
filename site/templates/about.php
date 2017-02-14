<?php snippet('header') ?>

<div id="container">

	<div class="inner">

	<div id="about">
		<div id="infos">
			<div id="site-description"><?= $page->text()->kt() ?></div>
		</div>
		<div id="footer"><?= $page->footer()->kt() ?></div>
	</div>

	</div>
	
</div>

<?php snippet('footer') ?>