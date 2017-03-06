<?php snippet('header') ?>

<?php $images = $page->medias()->toStructure() ?>
<?php $title = $page->title()->html(); ?>

<div id="container">

<div class="inner project">
	
	<div id="slider" 
	<?php if($page->backcolor()->isNotEmpty()): ?>
	data-backcolor="<?= $page->backcolor() ?>" 
	<?php endif ?>
	<?php if($page->textcolor()->isNotEmpty()): ?>
	data-textcolor="<?= $page->textcolor() ?>"
	<?php endif ?>
	>

	<?php foreach ($images as $key => $image): ?>

		<?php $image = $image->toFile(); ?>

		<div class="cell" 
		<?php if($image->caption()->isNotEmpty()): ?>
		data-caption="<?= $image->caption()->kt()->escape() ?>" 
		<?php endif ?>
		<?php if($image->backcolor()->isNotEmpty()): ?>
		data-backcolor="<?= $image->backcolor() ?>" 
		<?php endif ?>
		<?php if($image->textcolor()->isNotEmpty()): ?>
		data-textcolor="<?= $image->textcolor() ?>"
		<?php endif ?>
		>
			<div class="content">
				<img class="lazy" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-flickity-lazyload="<?= resizeOnDemand($image, 1300, true) ?>" alt="<?= $title.' - © '.$site->title()->html() ?>" height="100%" width="auto" />
				<noscript>
					<img src="<?= resizeOnDemand($image, 1500) ?>" alt="<?= $title.' - © '.$site->title()->html() ?>" height="100%" width="auto" />
				</noscript>
			</div>
		</div>

	<?php endforeach ?>

	</div>
	
	<div id="project-description">
		<?= $page->text()->kt() ?>
		<div id="share-buttons">
				Share&nbsp;
				<ul>
					<li>
						<a href="http://www.facebook.com/sharer.php?u=<?= rawurlencode ($page->url()); ?>" target="blank" title="Share on Facebook">
							Fb.
						</a>
					</li>
					<li>
						<a href="https://pinterest.com/pin/create/button/?url=<?= rawurlencode ($page->url()); ?>&media=&description=<?= rawurlencode ($site->title().' | '.$page->title()); ?>" target="blank" title="Share on Pinterest">
							Pin.
						</a>
					</li>
					<li>
						<a href="https://twitter.com/intent/tweet?source=webclient&text=<?= rawurlencode($site->title().' | '.$page->title()); ?>%20<?= rawurlencode($page->url()); ?>" target="blank" title="Tweet this">Tw.</a>
					</li>
				</ul>

		</div>
	</div>

	<div id="slide-caption"></div>

</div>
	
</div>

<?php snippet('footer') ?>