<?php /*<section>
				<div class="container">

					<!-- LEFT -->
					<div class="col-lg-3 col-md-3 col-sm-4">

						<div class="thumbnail text-center">
							<img src="<?= $this->Html->url(array('controller' => 'ObsiAPI', 'action' => 'getHeadSkin', 'plugin' => 'obsi', $findUser['User']['pseudo'], '230')) ?>" alt="">
							<h2 class="size-18 margin-top-10 margin-bottom-0"><?= $findUser['User']['pseudo'] ?></h2>
							<h3 class="size-18 margin-top-0 margin-bottom-3 text-muted"><?= $rankUser ?></h3>
              <h3 class="size-16 margin-top-0 margin-bottom-10 text-muted" style="font-weight:400;">Membre de <span class="label label-info"><?= $playerFaction ?></span></h3>
						</div>

        		<div class="box-static box-border-top">
              <ul class="side-nav list-group">
                <li class="list-group-item"><a style="letter-spacing: 0px;cursor:default;font-size:14px;"><i class="fa fa-sign-in"></i> Inscrit depuis le <b><?= $registerDate ?></b></a></li>
                <li class="list-group-item"><a style="letter-spacing: 0px;cursor:default;font-size:14px;"><i class="fa fa-hourglass-o"></i> Dernière connexion <b><?= $lastLogin ?></b></a></li>
                <li class="list-group-item"><a style="letter-spacing: 0px;cursor:default;font-size:14px;"><i class="fa fa-trophy"></i> Nombre de votes : <b><?= $votes ?></b></a></li>
                <li class="list-group-item"><a style="letter-spacing: 0px;cursor:default;font-size:14px;">
									<?php
									if($isRegisterV5) {
										echo '<span class="label label-info" style="font-size:12px;">Inscrit à la V5</span>';
									} else {
										echo '<span class="label label-info" style="font-size:12px;">Inscrit avant la V5</span>';
									}
									?>
								</li>
                <li class="list-group-item"><a style="letter-spacing: 0px;cursor:default;font-size:14px;">
									<?php
									if($hasConnectedV5) {
										echo '<span class="label label-success" style="font-size:12px;">S\'est connecté à la V5</span>';
									} else {
										echo '<span class="label label-danger" style="font-size:12px;">Ne s\'est connecté pas à la V5</span>';
									}
									?>
								</li>
              </ul>
        		</div>


					</div>


					<!-- RIGHT -->
					<div class="col-lg-9 col-md-9 col-sm-8">

            <div class="row">

            	<div class="col-md-4">

            		<div class="box-icon box-icon-center box-icon-round box-icon-transparent box-icon-large box-icon-content">
                  <div class="box-icon-title">
            			  <i class="fa fa-hourglass"></i>
            			  <h2><?= $onlineTime ?> <br>jouées</h2>
                  </div>
            		</div>

            	</div>

            	<div class="col-md-4">

            		<div class="box-icon box-icon-center box-icon-round box-icon-transparent box-icon-large box-icon-content">
                  <div class="box-icon-title">
            			  <i class="fa fa-square"></i>
            			  <h2>5 032 <br>blocs cassés</h2>
                  </div>
            		</div>

            	</div>

            	<div class="col-md-4">

            		<div class="box-icon box-icon-center box-icon-round box-icon-transparent box-icon-large box-icon-content">
                  <div class="box-icon-title">
            			  <i class="fa fa-square"></i>
            			  <h2>10 229 <br>blocs placés</h2>
                  </div>
            		</div>

            	</div>

            </div>

					</div>



				</div>
			</section>
*/ ?>
<section class="page-header page-header-lg parallax parallax-3" style="padding-top:40px;background-image: url('/theme/Obsifight/img/spawn4.png');padding-bottom: 40px;">
	<div class="overlay dark-2"><!-- dark overlay [1 to 9 opacity] --></div>

	<div class="container">

		<h1>Statistiques</h1>

		<!-- breadcrumbs -->
		<ol class="breadcrumb">
      <li><a href="<?= $this->Html->url('/') ?>"><?= $Lang->get('GLOBAL__HOME') ?></a></li>
			<li><a href="<?= $this->Html->url('/stats') ?>">Statistiques</a></li>
      <li class="active"><?= $findUser['User']['pseudo'] ?></li>
		</ol><!-- /breadcrumbs -->

	</div>

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
  </div>

</section>
<section>
	<div class="container">

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
