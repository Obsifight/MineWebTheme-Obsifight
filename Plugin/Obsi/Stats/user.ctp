<section class="page-header page-header-lg parallax parallax-3" style="padding-top:40px;background-image: url('/theme/Obsifight/img/spawn4.png');padding-bottom: 40px;">
	<div class="overlay dark-2"><!-- dark overlay [1 to 9 opacity] --></div>

	<div class="container">

		<h1>Statistiques</h1>
    <?php /*
		<!-- breadcrumbs -->
		<ol class="breadcrumb">
      <li><a href="<?= $this->Html->url('/') ?>"><?= $Lang->get('GLOBAL__HOME') ?></a></li>
			<li><a href="<?= $this->Html->url('/stats') ?>">Statistiques</a></li>
      <li class="active"><?= $findUser['User']['pseudo'] ?></li>
		</ol><!-- /breadcrumbs -->
    */ ?>

	</div>
  <?php /*
  <div class="container margin-top-30">
		<div class="row">

			<div class="col-md-6">
				<div class="row">

					<div class="col-md-3 pull-left hidden-xs">
						<img class="img-rounded stat-img" src="<?= $this->Html->url(array('controller' => 'ObsiAPI', 'action' => 'getHeadSkin', 'plugin' => 'obsi', $findUser['User']['pseudo'], 105)) ?>" alt="<?= $findUser['User']['pseudo'] ?>">
					</div>
					<div class="col-md-9 without-padding-right margin-bottom-10">
						<span class="stat-username-label"><?= $rankUser ?></span>
						<span class="stat-username"><?= $findUser['User']['pseudo'] ?></span>
					</div>
					<div class="col-md-9 without-padding-right">
						<span class="stat-faction-label label label-info"><?= $playerFaction ?></span>
					</div>

				</div>
			</div>
			<div class="col-md-6">
				<div class="heading-title heading-border heading-inverse heading-color" style="margin-bottom: 0;">
					<h4 style="background:transparent;">Dernière <span>connexion</span></h4>
					<p class="font-lato size-16"><?= $lastLogin ?></p>
				</div>
				<div class="heading-title heading-border heading-inverse heading-color">
					<h4 style="background:transparent;">Temps <span>joués</span></h4>
					<p class="font-lato size-16"><?= $onlineTime ?></p>
				</div>
			</div>

		</div>
  </div>*/ ?>

</section>
<section>
	<div class="container">

    <div class="row">

			<div class="col-md-6 col-sm-6 hidden-xs">

				<div class="error-404">
					Soon
				</div>

			</div>

			<div class="col-md-6 col-sm-6">

				<h3 class="nomargin">Désolé, <strong>Cette page arrive très bientôt !</strong></h3>

				<div class="divider nomargin-bottom"><!-- divider --></div>

				<a class="size-16 font-lato" href="<?= $this->Html->url('/stats') ?>"><i class="glyphicon glyphicon-menu-left margin-right-10 size-12"></i> Retourner sur les statistiques</a>

			</div>

		</div>
    <br><br><br><br><br><br><br><br><br><br><br><br><br>
    <?php /*
		<div class="row countTo-md text-center">

			<div class="col-xs-6 col-sm-3">
				<i><img src="/theme/Obsifight/img/kill.png" width="50"></i>
				<span class="count countTo" data-speed="3000"><?= $userKills ?></span>
				<h5>Kills</h5>
			</div>

			<div class="col-xs-6 col-sm-3">
				<i><img src="/theme/Obsifight/img/death.png" width="50"></i>
				<span class="count countTo" data-speed="3000"><?= $userDeaths ?></span>
				<h5>Morts</h5>
			</div>

			<div class="col-xs-6 col-sm-3">
				<i><img src="/theme/Obsifight/img/destroy.png" width="50"></i>
				<span class="count countTo" data-speed="3000"><?= $userBlocksDestroyed ?></span>
				<h5>Blocs détruits</h5>
			</div>

			<div class="col-xs-6 col-sm-3">
				<i><img src="/theme/Obsifight/img/place.png" width="50"></i>
				<span class="count countTo" data-speed="3000"><?= $userBlocksPlaced ?></span>
				<h5>Blocs construits</h5>
			</div>

		</div>
    */ ?>
	</div>
</section>
<?php /*
<section class="alternate">
	<div class="container">
		<div class="row">

			<div class="col-md-4">

				<div class="panel panel-default">
					<div class="panel-heading">
						<h2 class="panel-title">Informations sur <?= $findUser['User']['pseudo'] ?></h2>
					</div>
					<div class="table-responsive">
						<table class="table">
							<thead></thead>
							<tbody>
									<tr>
										<td>Inscrit le <?= $registerDate ?> (<?= (!$isRegisterV5) ? 'Avant V5' : 'Après V5' ?>)</td>
									</tr>
									<tr>
										<td>
											<?php
											if($isOnline) {
												echo '<span class="text-success">Actuellement en ligne</span>';
											} else {
												echo '<span class="text-danger">Actuellement hors ligne</span>';
												if(!$hasConnectedV5) {
													echo '(Pas connecté à la V5)';
												}
											}
											?>
										</td>
									</tr>
									<tr>
										<td>Ratio de <?= $userRatio ?></td>
									</tr>
							</tbody>
						</table>
					</div>
				</div>

			</div>

		</div>
	</div>
</section>
<section class="padding-xxs">
	<div class="container">
		<div class="divider divider-dotted"><!-- divider --></div>
	</div>
</section>
<style media="screen">
	.stat-username {
		display: inline-block;
		font-size: 20px;
		padding: 3px 8px;
		color: #FFF;
		background: #333;
		margin-left: -4px;

		border-top-right-radius: .25em;
		border-bottom-right-radius: .25em;
	}
	.stat-username-label span.label {
		font-size: 18px;
		border-top-right-radius: 0;
		border-bottom-right-radius: 0;
	}
	.stat-faction-label {
		font-size: 15px;
	}
	.without-padding-right {
		padding-left: 0px;
	}
</style>
*/ ?>
