<section class="page-header page-header-lg parallax parallax-3" style="padding-top:40px;background-image: url('/theme/Obsifight/img/spawn1.png');/* background-position: 50% 36px;*/">
	<div class="overlay dark-2"><!-- dark overlay [1 to 9 opacity] --></div>

	<div class="container">

		<h1><?= $title_for_layout ?></h1>

		<!-- breadcrumbs -->
		<ol class="breadcrumb">
      <?php if($this->params['controller'] == "pages" && $this->params['action'] == "display") { ?>
			  <li class="active"><?= $Lang->get('GLOBAL__HOME') ?></li>
      <?php } else { ?>
        <li><a href="<?= $this->Html->url('/') ?>"><?= $Lang->get('GLOBAL__HOME') ?></a></li>
        <li class="active"><?= $title_for_layout ?></li>
      <?php } ?>
		</ol><!-- /breadcrumbs -->

	</div>

  <div class="container animated fadeInRight" style="margin-top:20px;">
    <?= $this->element('header-content') ?>
	</div>
</section>
