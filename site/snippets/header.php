<!DOCTYPE html>
<html lang="en" class="no-js">
<head>

	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="dns-prefetch" href="//www.google-analytics.com">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<link rel="canonical" href="<?php echo html($page->url()) ?>" />
	<?php if($page->isHomepage()): ?>
		<title><?= $site->title()->html() ?></title>
	<?php else: ?>
		<title><?= $page->title()->html() ?> | <?= $site->title()->html() ?></title>
	<?php endif ?>
	<?php if($page->isHomepage()): ?>
		<meta name="description" content="<?= $site->description()->html() ?>">
	<?php else: ?>
		<meta name="DC.Title" content="<?= $page->title()->html() ?>" />
		<?php if(!$page->text()->empty()): ?>
			<meta name="description" content="<?= $page->text()->excerpt(250) ?>">
			<meta name="DC.Description" content="<?= $page->text()->excerpt(250) ?>"/ >
			<meta property="og:description" content="<?= $page->text()->excerpt(250) ?>" />
		<?php else: ?>
			<meta name="description" content="">
			<meta name="DC.Description" content=""/ >
			<meta property="og:description" content="" />
		<?php endif ?>
	<?php endif ?>
	<meta name="robots" content="index,follow" />
	<meta name="keywords" content="<?= $site->keywords()->html() ?>">
	<?php if($page->isHomepage()): ?>
		<meta itemprop="name" content="<?= $site->title()->html() ?>">
		<meta property="og:title" content="<?= $site->title()->html() ?>" />
	<?php else: ?>
		<meta itemprop="name" content="<?= $page->title()->html() ?> | <?= $site->title()->html() ?>">
		<meta property="og:title" content="<?= $page->title()->html() ?> | <?= $site->title()->html() ?>" />
	<?php endif ?>
	<meta property="og:type" content="website" />
	<meta property="og:url" content="<?= html($page->url()) ?>" />
	<?php if($page->content()->name() == "project"): ?>
		<?php if (!$page->featured()->empty()): ?>
			<meta property="og:image" content="<?= resizeOnDemand($page->image($page->featured()), 1200) ?>"/>
		<?php endif ?>
	<?php else: ?>
		<?php if(!$site->ogimage()->empty()): ?>
			<meta property="og:image" content="<?= $site->ogimage()->toFile()->width(1200)->url() ?>"/>
		<?php endif ?>
	<?php endif ?>

	<meta itemprop="description" content="<?= $site->description()->html() ?>">
	<!-- <link rel="shortcut icon" href="<?php //url('assets/images/favicon.ico') ?>">
	<link rel="icon" href="<?php //url('assets/images/favicon.ico') ?>" type="image/x-icon"> -->

	<?php 
	echo css('assets/css/build/build.min.css');
	echo js('assets/js/vendor/modernizr.min.js');
	?>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="<?= url('assets/js/vendor/jquery.min.js') ?>">\x3C/script>')</script>
	<style>
		body, #loader, #intro {
			background-color:<?= $site->introbackground() ?>;
		}
		#intro {
			color:<?= $site->introtext() ?>;
		}
	</style>

	<?php if(!$site->customcss()->empty()): ?>
		<style type="text/css">
			<?php echo $site->customcss()->html() ?>
		</style>
	<?php endif ?>

</head>
<body>

<div id="loader">
	<!-- <div class="spinner">
		<svg class="circular" viewBox="25 25 50 50">
		<circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="1" stroke-miterlimit="10" style="stroke:<?= $site->introtext() ?>;"></circle>
		</svg>
	</div> -->
</div>

<div id="intro">
	<?php if($site->introtitle()->isNotEmpty()): ?>
	<span><?= $site->introtitle()->html() ?></span>
	<?php else: ?>
	<span><?= $site->title()->html() ?></span>
	<?php endif ?>
</div>

<div id="wrapper">

<header>

	<div id="project-select">
		<?php $projects = $pages->find('work')->children()->visible() ?>
		<div id="current-project">
			<?php 
			if($page->isHomepage()){ 
				$current = $projects->first();
			} else {
				$current = $page;
			} 
			?>
			<h2>
				<?= str_pad($current->sort(), 2, '0', STR_PAD_LEFT).'. '; ?>
				<?= $current->title()->html() ?>
			</h2>
		</div>
		
		<div id="project-list">
		<?php $idx = 0 ?>
		<?php foreach ($projects as $key => $project): ?>
		
			<div class="project-link<?php if($page->isHomepage() && $idx == 0) { echo ' active'; } else if($project->isOpen()) { echo ' active'; } ?>">
				<a href="<?= $project->url() ?>" data-title="<?= $project->title()->html() ?>" data-target="project">
					<div class="project-title">
						<h2>
							<?= str_pad($project->sort(), 2, '0', STR_PAD_LEFT).'. '; ?>
							<?= $project->title()->html() ?>
						</h2>
					</div>
				</a>
			</div>
		
		<?php $idx++ ?>
		
		<?php endforeach ?>
		
		</div>
	</div>

	<a id="site-title" href="<?= $site->url() ?>" data-target="about">
		<span>Oisin</span><span> </span><span>Orlandi</span>
	</a>
</header>

<div id="about">
<?php $about = $pages->find('about') ?>
	<div id="infos">
		<div id="site-description"><?= $about->text()->kt() ?></div>
	</div>
	<div id="footer"><?= $about->footer()->kt() ?></div>
</div>