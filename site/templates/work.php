<?php snippet('header') ?>

<?php $first = $pages->find('work')->children()->visible()->first() ?>
<?php $images = $first->medias()->toStructure() ?>
<?php $title = $first->title()->html(); ?>

<div id="container">

<div class="inner project">
	
	<div id="slider">

	<?php foreach ($images as $key => $image): ?>

		<?php $image = $image->toFile(); ?>

		<div class="cell" data-caption="<?= $image->caption()->kt()->escape() ?>" data-backcolor="<?= $image->backcolor() ?>" data-textcolor="<?= $image->textcolor() ?>">
			<div class="content">
				<img class="lazy" src="<?= resizeOnDemand($image, 100) ?>" data-flickity-lazyload="<?= resizeOnDemand($image, 1700, true) ?>" alt="<?= $title.' - © '.$site->title()->html() ?>" height="100%" width="auto" />
				<noscript>
					<img src="<?= resizeOnDemand($image, 1700, true) ?>" alt="<?= $title.' - © '.$site->title()->html() ?>" height="100%" width="auto" />
				</noscript>
			</div>
		</div>

	<?php endforeach ?>

	</div>
	
	<div id="project-description">
		<?= $first->text()->kt() ?>
	</div>

	<div id="slide-caption"></div>

</div>
	
</div>

<?php snippet('footer') ?>