<?php snippet('header') ?>

<?php $images = $page->medias()->toStructure() ?>
<?php $title = $page->title()->html(); ?>

<div id="container">

<div class="inner project">
	
	<div id="slider">

	<?php foreach ($images as $key => $image): ?>

		<?php $image = $image->toFile(); ?>

		<div class="cell" data-caption="<?= $image->caption()->html() ?>" data-backcolor="<?= $image->backcolor() ?>" data-textcolor="<?= $image->textcolor() ?>">
			<div class="content">
				<img class="lazy" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-flickity-lazyload="<?= resizeOnDemand($image, 1700, true) ?>" alt="<?= $title.' - © '.$site->title()->html() ?>" height="100%" width="auto" />
				<noscript>
					<img src="<?= resizeOnDemand($image, 1700, true) ?>" alt="<?= $title.' - © '.$site->title()->html() ?>" height="100%" width="auto" />
				</noscript>
			</div>
		</div>

	<?php endforeach ?>

	</div>
	
	<div id="project-description">
		<?= $page->text()->kt() ?>
	</div>

	<div id="slide-caption"></div>

</div>
	
</div>

<?php snippet('footer') ?>