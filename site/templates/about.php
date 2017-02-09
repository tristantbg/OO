<?php snippet('header') ?>

<div id="container">

	<div class="inner">

	<?php if($page->text()->isNotEmpty()): ?>
	<section id="about" class="text-content">
		<?= $page->text()->kt() ?>
	</section>
	<?php endif ?>

	<?php if($page->contact()->isNotEmpty()): ?>
	<section id="contact">
		<?= $page->contact()->kt() ?>
	</section>
	<?php endif ?>

	<?php $sections = $page->children()->visible() ?>
	<?php foreach ($sections as $key => $section): ?>

		<section class="text-content">
			<div class="section-title"><?= $section->title()->html() ?></div>
			
			<?php $items = $section->sections()->toStructure() ?>
			
			<?php foreach ($items as $key => $item): ?>
			
				<div class="content"><?= $item->itemtext()->kt() ?></div>
				<div class="date"><?= substr($item->itemdate(), 0, -6) ?></div>
			
			<?php endforeach ?>
		</section>


	<?php endforeach ?>

	<section id="credits">
		<p>
		© <?= date('Y') ?>, All rights reserved by <?= $site->title()->html() ?>
		<br>Design & development by <a href="http://www.tristanbagot.com" target="_blank">Tristan Bagot</a>
		</p>
	</section>

	</div>
	
</div>

<?php snippet('footer') ?>