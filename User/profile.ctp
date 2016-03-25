<section>
	<div class="container">

		<?= $Module->loadModules('user_profile_messages') ?>

		<!-- RIGHT -->
		<div class="col-lg-9 col-md-9 col-lg-push-3 col-md-push-3 margin-bottom-80">

			<ul class="nav nav-tabs nav-top-border">
				<li class="active"><a href="#info" data-toggle="tab">Informations sur le compte</a></li>
				<li><a href="#password" data-toggle="tab">Modifier mon mot de passe</a></li>
				<li><a href="#skin_and_cape" data-toggle="tab">Modifier mon skin & ma cape</a></li>
				<li><a href="#obsiguard" data-toggle="tab">ObsiGuard</a></li>
			</ul>

			<div class="tab-content margin-top-20">

				<!-- PERSONAL INFO TAB -->
				<div class="tab-pane fade in active" id="info">

					<form data-ajax="true" action="<?= $this->Html->url(array('controller' => 'user', 'action' => 'saveProfile', 'plugin' => 'obsi')) ?>" data-custom-function="getProfileData">

						<div class="ajax-msg" id="number_ajax-msg"></div>

						<div class="form-group">
							<label class="control-label">Pseudo</label>
							<div class="input-group">
								<input type="text" value="<?= $user['pseudo'] ?>" class="form-control disabled" disabled>
	              <div class="input-group-btn">
	                <a type="button" class="btn btn-red" href="#" data-toggle="modal" data-target="#updatePseudo_modal">Changer de pseudo</a>
	              </div>
	            </div>
						</div>
						<div class="form-group">
							<label class="control-label">Adresse email</label>
	            <div class="input-group">
				        <input type="email" value="<?= $user['email'] ?>" class="form-control disabled" disabled>
	              <div class="input-group-btn">
	                <a type="button" class="btn btn-red" href="#" data-toggle="modal" data-target="#requestEmailUpdate_modal">Changer d'email</a>
	              </div>
	            </div>
						</div>
						<div class="form-group">
							<label class="control-label">Date d'inscription</label>
							<input type="text" value="<?= $Lang->date($user['created']) ?>" class="form-control disabled" disabled>
						</div>

						<div class="form-group">
							<label class="control-label">Numéro de téléphone</label>
							<div class="input-group">
								<input type="text" placeholder="Ex: 0639****** ou +33639******" value="<?= (isset($user['obsi-number_phone'])) ? substr_replace($user['obsi-number_phone'], '****', 4, 6) : '' ?>" name="number_phone" class="form-control">
								<div class="input-group-btn">
	                <button type="button" class="btn btn-red" id="sendConfirmSMS">Envoyer le code de confirmation</button>
	              </div>
							</div>
							<small>Sera utilisé pour des alertes ObsiGuard (Si quelqu'un tente de se connecter a votre compte).<br>Uniquement les numéros français sont acceptés par cette fonctionnalité.<br><a href="<?= $this->Html->url(array('controller' => 'user', 'action' => 'deletePhoneNumber', 'plugin' => 'obsi')) ?>">Je souhaite supprimer mon numéro</a></small>
						</div>

						<div class="form-group" id="SMSConfirmCode" style="display:none;">
							<label class="control-label">Code de confirmation reçu</label>
							<input type="text" placeholder="Un SMS vous a été envoyé avec un code pour confirmer votre numéro" name="confirm_code" class="form-control">
						</div>

						<div class="margiv-top10">
							<button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Enregistrer mon numéro</button>
						</div>

					</form>

          <hr>

          <div class="info-bar info-bar-bordered">
          	<div class="container">

          		<div class="row">

                <div class="col-sm-3 text-center">
          				<i class="fa fa-money text-center" style="margin-right:0px;float:none;"></i>
          				<h3 id="user_money"><?= $user['money'] ?></h3>
          				<p><?= ucfirst($Configuration->getMoneyName()) ?></p>
          			</div>

          			<div class="col-sm-2 text-center">
          				<i class="fa fa-trophy text-center" style="margin-right:0px;float:none;"></i>
          				<h3><?= $user['vote'] ?></h3>
          				<p>Votes</p>
          			</div>

          			<div class="col-sm-3 text-center">
          				<i class="fa fa-gift text-center" style="margin-right:0px;float:none;"></i>
          				<h3><?= (isset($user['rewards_waited'])) ? $user['rewards_waited'] : '0' ?></h3>
          				<p>Récompenses en attentes</p>
          			</div>

          		</div>

          	</div>
          </div>

					<div class="row">
						<div class="col-md-6">
          		<a href="<?= $this->Html->url(array('controller' => 'voter', 'action' => 'get_reward', 'plugin' => 'obsivote')) ?>" class="btn btn-3d btn-block btn-red<?= (!isset($user['rewards_waited']) || empty($user['rewards_waited'])) ? ' disabled' : '' ?>"<?= (!isset($user['rewards_waited']) || empty($user['rewards_waited'])) ? ' disabled' : '' ?>>Récupérer mes récompenses en attente</a>
						</div>
						<div class="col-md-6">
							<a href="#" data-toggle="modal" data-target="#sendPoints_modal" class="btn btn-3d btn-block btn-red">Envoyez des <?= $Configuration->getMoneyName() ?> à un joueur</a>
						</div>
					</div>

          <?= $Module->loadModules('user_profile') ?>

				</div>
				<!-- /PERSONAL INFO TAB -->

				<!-- PASSWORD TAB -->
        <div class="tab-pane fade" id="password">

					<form action="<?= $this->Html->url(array('action' => 'change_pw')) ?>" data-ajax="true" method="post">

						<div class="form-group">
							<label class="control-label">Nouveau mot de passe</label>
							<input type="password" name="password" class="form-control">
						</div>
						<div class="form-group">
							<label class="control-label">Confirmation du mot de passe</label>
							<input type="password" name="password_confirmation" class="form-control">
						</div>

						<div class="margiv-top10">
							<button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Sauvegarder le changement</button>
						</div>

					</form>

				</div>
				<!-- /PASSWORD TAB -->

				<!-- SKIN_AND_CAPE TAB -->
				<div class="tab-pane fade" id="skin_and_cape">

          <?php if($canSkin) { ?>
            <form class="form-inline" data-ajax="true" data-upload-image="true" action="<?= $this->Html->url(array('controller' => 'skin', 'action' => 'upload', 'plugin' => 'obsi')) ?>">
              <input type="hidden" name="data[_Token][key]" value="<?= $csrfToken ?>">

              <div class="row">
                <div class="col-md-8">
                  <input class="custom-file-upload" type="file" name="image" data-btn-text="Sélectionnez votre skin" />
                  <small class="text-muted block">Le skin doit être au format PNG (Hauteur max: <?= $skinHeightMax ?>px;Largeur max: <?= $skinWidthMax ?>)px</small>
                </div>

                <div class="col-md-4">
                  <div class="pull-right">
                    <button type="submit" class="btn btn-info"><i class="fa fa-check"></i> Envoyer</button>
                  </div>
                </div>
              </div>
              <div class="clearfix"></div>
  					</form>
          <?php } else { ?>
            <div class="alert alert-danger">
              <b>Erreur : </b> Vous ne pouvez pas modifier votre skin, il vous faut au minimum 3 votes ou avoir acheté la fonctionnalité "Skin" sur la boutique.
            </div>
          <?php } ?>

          <hr>

          <?php if($canCape) { ?>
            <form class="form-inline" data-ajax="true" data-upload-image="true" action="<?= $this->Html->url(array('controller' => 'cape', 'action' => 'upload', 'plugin' => 'obsi')) ?>">
              <input type="hidden" name="data[_Token][key]" value="<?= $csrfToken ?>">

              <div class="row">
                <div class="col-md-8">
                  <input class="custom-file-upload" type="file" name="image" data-btn-text="Sélectionnez votre cape" />
                  <small class="text-muted block">La cape doit être au format PNG (Hauteur max: <?= $capeHeightMax ?>px;Largeur max: <?= $capeWidthMax ?>px)</small>
                </div>

                <div class="col-md-4">
                  <div class="pull-right">
                    <button type="submit" class="btn btn-info"><i class="fa fa-check"></i> Envoyer</button>
                  </div>
                </div>
              </div>
              <div class="clearfix"></div>
  					</form>
          <?php } else { ?>
            <div class="alert alert-danger">
              <b>Erreur : </b> Vous ne pouvez pas modifier votre cape, il vous faut avoir acheté la fonctionnalité "Cape" sur la boutique.
            </div>
          <?php } ?>


				</div>
				<!-- /SKIN_AND_CAPE TAB -->

				<!-- ObsiGuard TAB -->
				<div class="tab-pane fade" id="obsiguard">

					<div class="callout alert alert-success margin-bottom-30">

						<div class="row">

							<div class="col-md-8 col-sm-8"><!-- left text -->
								<h4>Voulez-vous <?= ($obsiguardStatus) ? 'désactiver' : 'activer' ?> <strong>ObsiGuard</strong> ?</h4>
								<p>
									Cette fonctionnalité vous permet plus de sécurité sur votre compte.
									<br><a href="#">En savoir plus</a>.
								</p>
							</div><!-- /left text -->


							<div class="col-md-4 col-sm-4 text-right"><!-- right btn -->
								<a id="toggleObsiguard" data-status="<?= ($obsiguardStatus) ? '1' : '0' ?>" class="btn btn-<?= ($obsiguardStatus) ? 'danger' : 'success' ?> btn-lg"><?= ($obsiguardStatus) ? 'Désactiver' : 'Activer' ?></a>
							</div><!-- /right btn -->

						</div>

					</div>

					<div id="obsiguardManage" style="display:<?= ($obsiguardStatus) ? 'block' : 'none' ?>;">
						<div id="addIP-ajax-msg"></div>
						<table class="table">
							<thead>
								<tr>
									<th>Vos adresses IPs</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody id="ipList">
								<?php

								if(isset($obsiguardIPs)) {
									foreach ($obsiguardIPs as $key => $value) {

										echo '<tr id="'.$key.'">';
											echo '<td>'.$value.'</td>';
											echo '<td>';
												echo '<button data-ip-id="'.$key.'" type="button" class="btn btn-danger deleteIP">'.$Lang->get('GLOBAL__DELETE').'</button>';
											echo '</td>';
										echo '</tr>';

									}
								}

								?>
								<tr>
									<td>
										<div class="form-group">
											<input type="text" class="form-control" name="ip" placeholder="IP">
										</div>
									</td>
									<td>
										<button onClick="addIP(this)" id="btn-add-ip" class="btn btn-success">Ajouter</button>
									</td>
								</tr>
							</tbody>
						</table>
						<p>Votre adresse IP : <i><?= $ip ?></i></p>

						<div class="callout alert alert-info margin-top-30">
							<div class="row">
								<div class="col-md-12 col-sm-12"><!-- left text -->
									<h4>
										<label class="checkbox" style="font-size: 18px;font-weight:500;">
											<input type="checkbox" name="dynamic_ip"<?= (isset($obsiguardDynamicIPStatus) && $obsiguardDynamicIPStatus) ? ' checked' : '' ?>>
											<i></i> &nbsp;&nbsp;J'ai une IP dynamique.
										</label>
									</h4>
									<p>
										<small>Si vous activez cette option, toute les IPs que vous avez configurée deviendront des plages d'IPs qui seront autorisés.<br> Par exemple : pour l'IP 127.0.0.1, toutes les IPs 127.0.0.* seront autorisées.</small>
									</p>
								</div><!-- /left text -->
							</div>

						</div>

					</div>

				</div>
				<!-- /ObsiGuard TAB -->

			</div>

		</div>


		<!-- LEFT -->
		<div class="col-lg-3 col-md-3 col-lg-pull-9 col-md-pull-9 hidden-sm hidden-xs" id="side-left" style="display:none;">

			<div class="thumbnail text-center">
				<img src="<?= $this->Html->url(array('controller' => 'ObsiAPI', 'action' => 'getHeadSkin', 'plugin' => 'obsi', $user['pseudo'], '230')) ?>" alt="">
			</div>

      <div class="box-image text-center">
  			<div class="image-hover lightbox block-center" style="margin-top:20px;">
          <div class="piechart" data-color="#D9534F" data-trackcolor="rgba(0,0,0,0.04)" data-size="150" data-percent="<?= (isset($profileCompletedPercentage)) ? $profileCompletedPercentage : '0' ?>" data-width="10" data-animate="1700">
            <span class="size-30">
              <span class="countTo" data-speed="3000"><?= (isset($profileCompletedPercentage)) ? $profileCompletedPercentage : '0' ?></span>%
            </span>
          </div>
  			</div>

			  <p class="font-lato weight-300">Profil complété</p>
		  </div>

		</div>

	</div>
</section>
<script type="text/javascript">
$(document).ready(function() {
  loadScript('/theme/Obsifight/js/file_upload_style.js');
});

setTimeout(function(){
  $('#side-left').fadeIn(150).addClass('animated slideInLeft');
}, 800);
</script>


<div class="modal modal-medium fade" id="requestEmailUpdate_modal" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title">Demander une modification de votre email</h4>
			</div>
			<div class="modal-body">
				<p>
					Votre demande sera traitée sous peu.
				</p>
				<form action="<?= $this->Html->url(array('controller' => 'user', 'action' => 'requestEmailUpdate', 'plugin' => 'obsi')) ?>" data-ajax="true" data-callback-function="afterRequestEmailUpdate">

					<div class="form-group">
						<label class="control-label">Quel email voulez-vous ?</label>
            <input type="text" placeholder="Nouvel email" name="newEmail" class="form-control">
					</div>

					<div class="form-group">
						<label class="control-label">Pourquoi voulez-vous changer ?</label>
						<textarea name="reason" class="form-control" rows="8" cols="20"></textarea>
					</div>

					<div class="margiv-top10">
						<button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Valider la demande</button>
					</div>

				</form>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
</div>
<div class="modal modal-medium fade" id="sendPoints_modal" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title">Envoyez <?= $Configuration->getMoneyName() ?></h4>
			</div>
			<div class="modal-body">
				<p>
					Tous les envois de <?= $Configuration->getMoneyName() ?> sont enregistrés dans un historique et sont vérifiables facilement.
				</p>
				<form action="<?= $this->Html->url(array('controller' => 'user', 'action' => 'sendPoints', 'plugin' => 'obsi')) ?>" data-ajax="true" data-callback-function="afterSendPoints">

					<div class="form-group">
						<label class="control-label">Votre mot de passe</label>
            <input type="password" placeholder="Pour confirmer la transaction" name="password" class="form-control">
					</div>

					<div class="form-group">
						<label class="control-label">À qui voulez-vous envoyez des <?= $Configuration->getMoneyName() ?> ?</label>
            <input type="text" placeholder="Pseudo du joueur" name="to" class="form-control">
					</div>

					<div class="form-group">
						<label class="control-label">Combien voulez-vous en envoyer ?</label>
            <input type="text" placeholder="Ex: 100" name="howMany" class="form-control">
					</div>

					<div class="margiv-top10">
						<button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Valider l'envoie</button>
					</div>

				</form>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
</div>




<script type="text/javascript">
	function afterRequestEmailUpdate(data, response) {
		$('#requestEmailUpdate_modal').modal('hide');
		$('#info').prepend('<div class="alert alert-success">Votre demande sera traité sous peu !</div>');
	}
</script>


<div class="modal modal-medium fade" id="updatePseudo_modal" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title">Changer de pseudo</h4>
			</div>
			<div class="modal-body">
				<p>
					Les changements de pseudos s'effectuent <b>2 fois au maximum</b> avec au minimum <b>15 jours d'intervalle</b> entre les changements. <br>
					Tous les changements sont <b>enregistrés</b> dans un <b>historique</b> et votre ancien pseudo ne pourra pas être repris par quiconque.
				</p>
				<?php if($user['obsi-can_update_pseudo']) { ?>
					<form action="<?= $this->Html->url(array('controller' => 'user', 'action' => 'updatePseudo', 'plugin' => 'obsi')) ?>" data-ajax="true" data-callback-function="afterSendPoints">

						<div class="form-group">
							<label class="control-label">Votre mot de passe</label>
	            <input type="password" placeholder="Pour confirmer le changement" name="password" class="form-control">
						</div>

						<div class="form-group">
							<label class="control-label">Votre nouveau pseudo</label>
	            <input type="text" name="pseudo" class="form-control">
						</div>

						<div class="margiv-top10">
							<button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Valider le changement</button>
						</div>

					</form>
				<?php } else { ?>
					<p>
						Vous ne pouvez pas changer de pseudo ! Vous n'en avez pas acheter un.
					</p>
					<a href="<?= $this->Html->url(array('controller' => 'shop', 'action' => 'index', 'plugin' => 'shop')) ?>" class="btn btn-block btn-primary btn-3d">Acheter un changement de pseudo</a>
				<?php } ?>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	function afterSendPoints(data, response) {
		$('#sendPoints_modal').modal('hide');
		$('#user_money').html(response.newSold);
	}
</script>


<div class="modal modal-medium fade" id="authorize_modal" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title">Confirmation par email</h4>
			</div>
				<div class="modal-body">
						<p>Un mail de vérification vous a été envoyé à l'adresse <?= $user['email'] ?>.</p>
						<p>Ce mail contient un code que vous devez entrer ci-dessous pour pouvoir effectuer cette action.</p>
						<div class="ajax-msg-ip"></div>
						<form id="authorize_modal_form" class="form-inline" data-ajax="true" data-success-msg="false" data-callback-function="" action="<?= $this->Html->url(array('controller' => 'obsiguard', 'action' => 'checkAuthorizeCode', 'plugin' => 'obsi')) ?>">
							<div class="col-lg-6">
								<div class="input-group">
									<input type="text" name="code" class="form-control" placeholder="Code de confirmation">
									<span class="input-group-btn">
										<button class="btn btn-danger" type="submit">Envoyer</button>
									</span>
								</div>
							</div>
						</form>
						<div class="clearfix"></div>
				</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	// Activation/désactivation d'ObsiGuard
		$('#toggleObsiguard').click(function(e) {

			e.preventDefault(); // On enlève le comportement par défaut

			var el = $(this);
			var status = (el.attr('data-status') == "1") ? 0 : 1; // On set le prochain status
			var url = (status) ? 'enable' : 'disable';

			// On désactive le bouton
				el.addClass('disabled');
				el.removeClass('btn-success');
				el.removeClass('btn-danger');
				el.addClass('btn-info');
				el.attr('disabled', 'disabled');
				el.html('Chargement...');

			$.get('<?= $this->Html->url(array('controller' => 'obsiguard', 'plugin' => 'obsi')) ?>/'+url, function(data) {

				if(data.statut) {

					if(status) {
						el.removeClass('disabled');
						el.addClass('btn-danger');
						el.attr('disabled', false);
						el.html('Désactiver');
						el.attr('data-status', '1');
						$('#obsiguardManage').fadeIn(150);
					} else {
						el.removeClass('disabled');
						el.addClass('btn-success');
						el.attr('disabled', false);
						el.html('Activer');
						el.attr('data-status', '0');
						$('#obsiguardManage').fadeOut(150);
					}

				} else {
					if(status) {
						el.removeClass('disabled');
						el.addClass('btn-success');
						el.attr('disabled', false);
						el.html('Activer');
					} else {
						el.removeClass('disabled');
						el.addClass('btn-danger');
						el.attr('disabled', false);
						el.html('Désactiver');

						$('#authorize_modal_form').attr('data-callback-function', 'disableCallbackObsiguard');

						$('#authorize_modal').modal();
						return;
					}
					alert('Une erreur est survenue !');
				}

			});

		});

	// Appelé après demande de confirmation (désactivation faite cette fois ci)
		function disableCallbackObsiguard(data, response) {
			$.get('<?= $this->Html->url(array('controller' => 'obsiguard', 'plugin' => 'obsi')) ?>');

			$('#authorize_modal').modal('hide');
			$('#toggleObsiguard').removeClass('btn-danger');
			$('#toggleObsiguard').addClass('btn-success');
			$('#toggleObsiguard').html('Activer');
			$('#toggleObsiguard').attr('data-status', '0');
			$('#obsiguardManage').fadeOut(150);

			$('#authorize_modal_form .ajax-msg').remove();
		}

	// Ajout d'une IP
		function addIP(btn) {
			var inputs = {};
			inputs['data[_Token][key]'] = '<?= $csrfToken ?>';
			inputs['ip'] = $('input[name="ip"]').val();

			btn = $(btn);
			btn.attr('disabled', 'disabled');
			btn.html('Chargement...');
			btn.removeClass('btn-success');
			btn.addClass('btn-info disabled');

			$.post('<?= $this->Html->url(array('controller' => 'obsiguard', 'action' => 'addIP', 'plugin' => 'obsi')) ?>', inputs, function(data) {
				if(data.statut) {
					addIPCallbackObsiguard(inputs, {}, false);
				} else if(data.modal_authorize !== undefined) {
					$('#authorize_modal_form').attr('data-callback-function', 'addIPCallbackObsiguard');
					$('#addIP-ajax-msg').fadeOut(150, function() { $(this).empty() });
					$('#authorize_modal').modal();
					btn.attr('disabled', false);
					btn.html('Ajouter');
					btn.removeClass('btn-info');
					btn.removeClass('disabled');
					btn.addClass('btn-success');
				} else {
					if(data.msg === undefined) {
						data = JSON.parse(data);
					}
					$('#addIP-ajax-msg').fadeIn(150).html('<div class="alert alert-danger"><b>Erreur : </b>'+data.msg+'</div>');
					btn.attr('disabled', false);
					btn.html('Ajouter');
					btn.removeClass('btn-info');
					btn.removeClass('disabled');
					btn.addClass('btn-success');
				}
			});
		}

	// Call après le callback (donc création cette fois)
		function addIPCallbackObsiguard(inputs, response, add) {

			if(add === undefined) {
				add = true;
			}

			var addIPInputs = {};
			addIPInputs['data[_Token][key]'] = '<?= $csrfToken ?>';
			addIPInputs['ip'] = $('input[name="ip"]').val();

			if(add) {
				$.post('<?= $this->Html->url(array('controller' => 'obsiguard', 'action' => 'addIP', 'plugin' => 'obsi')) ?>', addIPInputs);
			}

			$('#ipList tr:last').before('<tr><td>'+addIPInputs['ip']+'</td></tr>');
			$('input[name="ip"]').val('');

			$('#authorize_modal').modal('hide');

			$('#addIP-ajax-msg').fadeOut(150, function() { $(this).empty() });

			$('#btn-add-ip').attr('disabled', false);
			$('#btn-add-ip').html('Ajouter');
			$('#btn-add-ip').removeClass('btn-info');
			$('#btn-add-ip').removeClass('disabled');
			$('#btn-add-ip').addClass('btn-success');
		}

	// Suppression d'une IP
		$('.deleteIP').click(function(e) {

			e.preventDefault();

			var el = $(this);
			el.attr('disabled', 'disabled');
			el.html('Chargement...');
			el.removeClass('btn-danger');
			el.addClass('btn-info disabled');

			var id = el.attr('data-ip-id');

			$.get('<?= $this->Html->url(array('controller' => 'obsiguard', 'action' => 'removeIP', 'plugin' => 'obsi')) ?>/'+id, function(data) {

				if(data.statut) {
					$('tr#'+id).remove();
				} else {
					el.attr('disabled', false);
					el.html('Supprimer');
					el.addClass('btn-danger');
					el.removeClass('btn-info');
					el.removeClass('disabled');
					alert('Une erreur est survenue');
					console.log(data.msg);
				}

			});


		});

	// Switch de dynamic_ip
		$('input[name="dynamic_ip"]').change(function(e) {
				$.get('<?= $this->Html->url(array('controller' => 'obsiguard', 'action' => 'switchDynamicIP', 'plugin' => 'obsi')) ?>');
		});
</script>


<script type="text/javascript">
	$('#sendConfirmSMS').click(function(e) {

		e.preventDefault();

		var btn = $(this);
		btn.html('Envoie...');
		btn.removeClass('btn-red');
		btn.addClass('btn-info');
		btn.addClass('disabled');
		btn.attr('disabled', 'disabled');

		var number_phone = $('input[name="number_phone"]').val();
		number_phone = encodeURI(number_phone);
		number_phone = number_phone.replace('+', 'plus');

		$.get('<?= $this->Html->url(array('controller' => 'user', 'action' => 'sendSMSConfirmCode', 'plugin' => 'obsi')) ?>/'+number_phone, function(data) {

			if(data.statut) {

				btn.html('Envoyé !');
				btn.removeClass('btn-info');
				btn.addClass('btn-success');

				$('input[name="number_phone"]').attr('disabled', 'disabled');
				$('input[name="number_phone"]').addClass('disabled');

				//if(!$('#SMSConfirmCode').css('display') == 'none') {
					$('#SMSConfirmCode').slideDown(150);
				//}

			} else {

				btn.html('Envoyer le code de confirmation');
				btn.removeClass('btn-info');
				btn.addClass('btn-red');

				btn.removeClass('disabled');
				btn.attr('disabled', false);

				$('#number_ajax-msg').fadeIn(150).html('<div class="alert alert-danger"><b>Erreur : </b>'+data.msg+'</div>');

				//if(!$('#SMSConfirmCode').css('display') == 'block') {
					//$('#SMSConfirmCode').slideUp(150);
				//}

			}

		});

	});

	function getProfileData(form) {
		return {number_phone: form.find('input[name="number_phone"]').val(), confirm_code: form.find('input[name="confirm_code"]').val()}
	}
</script>
