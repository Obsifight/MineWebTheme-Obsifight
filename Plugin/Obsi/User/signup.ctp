<section class="alternate padding-xxs">
	<div class="container">

		<div class="heading-title heading-dotted text-center" style="margin-bottom:0;">
			<h4>Rejoignez-nous dès maintenant !</h4>
		</div>

  </div>
</section>
<section class="padding-md parallax parallax-2" style="background-image: url('/theme/Obsifight/img/spawn2.png'); background-position: 50% 50%;">

	<div class="display-table">
		<div class="display-table-cell vertical-align-middle">

			<div class="container">

				<div class="row">

					<div class="col-xs-12 col-sm-12 col-md-5 col-lg-4 col-md-push-7 col-lg-push-8">

						<!-- register form -->
						<form id="signup" class="nomargin sky-form boxed" action="<?= $this->Html->url(array('controller' => 'user', 'action' => 'ajax_register', 'plugin' => false)) ?>" method="post" data-ajax="true" data-checkData="checkData" data-redirect-url="<?= $this->Html->url(array('controller' => 'user', 'action' => 'profile', 'plugin' => false)) ?>">
							<header>
								<i class="fa fa-users"></i> <?= $Lang->get('USER__REGISTER') ?>
							</header>

              <img src="<?= $this->Html->url(array('controller' => 'API', 'action' => 'get_head_skin', 'plugin' => false, 'obsi-inscription-noob', '100')) ?>" class="img-rounded block-center" style="margin-top:10px;" alt="">

              <div class="ajax-msg" style="padding: 10px;padding-bottom: 0;"></div>

							<fieldset class="nomargin" style="padding-top:0;">
								<label class="input">
									<i class="ico-append fa fa-user"></i>
									<input type="text" name="pseudo" placeholder="<?= $Lang->get('USER__USERNAME') ?>">
									<b class="tooltip tooltip-bottom-right">Votre pseudo en jeu</b>
								</label>

                <label class="input">
									<i class="ico-append fa fa-envelope"></i>
									<input type="email" name="email" placeholder="<?= $Lang->get('USER__EMAIL') ?>">
									<b class="tooltip tooltip-bottom-right">Nécessaire pour vérifier votre compte</b>
									<input type="hidden" name="email_valided" value="0">
								</label>

								<label class="input">
									<i class="ico-append fa fa-lock"></i>
									<input type="password" name="password" placeholder="<?= $Lang->get('USER__PASSWORD') ?>">
								</label>
                <div class="progress" style="margin-bottom:5px;">
                	<div class="progress-bar progress-bar-primary" id="password-strengh" role="progressbar" style="width: 0%">
                		<span class="sr-only">5</span>
                	</div>
                </div>


								<label class="input">
									<i class="ico-append fa fa-lock"></i>
									<input type="password" name="password_confirmation" placeholder="<?= $Lang->get('USER__PASSWORD_CONFIRM') ?>">
								</label>

                <?php if($reCaptcha['type'] == "google") { ?>
                  <script src='https://www.google.com/recaptcha/api.js'></script>
                  <label class="input">
                      <div class="g-recaptcha" data-sitekey="<?= $reCaptcha['siteKey'] ?>"></div>
                  </label>
                <?php } else { ?>
                  <label class="input">
                    <?php
                      echo $this->Html->image(array('controller' => 'user', 'action' => 'get_captcha', 'plugin' => false, 'admin' => false), array('plugin' => false, 'admin' => false, 'id' => 'captcha_image'));
                      echo $this->Html->link($Lang->get('FORM__RELOAD_CAPTCHA'), 'javascript:void(0);',array('id' => 'reload'));
                    ?>
                  </label>
                  <label class="input">
                    <input type="text" name="captcha" placeholder="<?= $Lang->get('FORM__CAPTCHA_LABEL') ?>">
                  </label>
                <?php } ?>

								<div class="margin-top-20">
									<label class="checkbox nomargin"><input class="checked-agree" type="checkbox" name="terms"><i></i>J'accepte le <a href="http://forum.obsifight.fr/index.php?threads/c-g-u-dobsifight.15819/">réglement</a> d'ObsiFight</label>
								</div>
							</fieldset>

							<div class="row margin-bottom-20">
								<div class="col-md-12">
									<button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> <?= $Lang->get('USER__REGISTER') ?></button>
								</div>
							</div>

						</form>
						<!-- /register form -->

					</div>

					<div class="col-xs-12 col-md-7 col-lg-8 col-lg-pull-4 col-md-pull-5 hidden-sm hidden-xs">


						<h2 class="size-20 text-center-xs">Pourquoi s'inscrire sur ObsiFight ?</h2>

						<p>Nous avons choisi de créer un système d'inscription des joueurs, retenant leurs identifiants et autres données dans notre base de données. Cela nous permet d'ajouter de nombreuses fonctionnalités, en plus d'une protection optimale.</p>

						<ul class="list-unstyled login-features">
							<li>
								<i class="fa fa-lock"></i> Nos bases de données sont parmi les plus sûres.
							</li>
							<li>
								<i class="fa fa-shield"></i> ObsiGuard protège vos comptes des vols de mots de passe.
							</li>
							<li>
								<i class="fa fa-crosshairs"></i> Une qualité de jeu parfaite pour des combats optimaux.
							</li>
							<li>
								<i class="fa fa-question-circle"></i> Des modérateurs à l'écoute pour répondre à vos questions.
							</li>
							<li>
								<i class="fa fa-gavel"></i> Un forum complet pour partager vos exploits.
							</li>
              <li>
								<i class="fa fa-microphone"></i> Un TeamSpeak conçu pour accueillir vos channels de factions.
							</li>
              <li>
								<i class="fa fa-key"></i> Et des Events vous débloquant des avantages hors normes !
							</li>
						</ul>

					</div>

				</div>

			</div>

		</div>
	</div>

</section>
<?= $this->Html->script('mailgun_validator') ?>
<script type="text/javascript">

$(document).ready(function() {

  $('form#signup input[name="pseudo"]').focusout(function(e){
    var el = $(this);
    $.get("<?= $this->Html->url(array('action' => 'check_pseudo')) ?>/"+this.value, function(data) {
      if(data.statut) {
        el.removeClass('error');
        toastr.clear();
      } else {
        el.addClass('error');
        toastr["error"]("Ce pseudo est déjà utilisé !", "Erreur !");
      }
    });
  });

  $('form#signup input[name="email"]').focusout(function(e){
		var el = $(this);
    if(validateEmail(this.value)) {
      $.get("<?= $this->Html->url(array('action' => 'check_email')) ?>/"+this.value, function(data) {
        if(data.statut) {

				 //Trim string and autocorrect whitespace issues
				 var elementValue = el.val();
				 elementValue = $.trim(elementValue);
				 el.val(elementValue);

				 //Attach event to options
				 var options = {
						api_key: 'pubkey-0f5491e5250a78af0ac7d2e413d1e394',
						in_progress: function(e) {
							$('input[name="email_valided"]').val('0');
							console.log('In progress: ', e);
						},
						success: function(e) {
							console.log('Success call: ', e);
							if(e.is_valid) {
								$('input[name="email_valided"]').val('1');
								console.log('Success validation: ', e);
								toastr.clear();
								toastr["info"]("Votre email est bien valide !", "Vérification");
							} else {
								$('input[name="email_valided"]').val('0');
								console.log('Error validation: ', e);
								toastr.clear();
								toastr["error"]("Votre email est invalide !", "Erreur !");
							}
						},
						error: function(e) {
							if(e !== 0) {
								$('input[name="email_valided"]').val('0');
								console.log('Error: ', e);
								toastr.clear();
								toastr["error"]("Votre email est invalide ! "+e, "Erreur !");
							} else { // erreurs internes
								$('input[name="email_valided"]').val('1');
							}
						},
					}

				 options.e = e;

				 run_validator(elementValue, options, el);



          el.removeClass('error');
          toastr.clear();
        } else {
					$('input[name="email_valided"]').val('0');
          el.addClass('error');
          toastr["error"](data.error, "Erreur !");
        }
      });
    } else {
			$('input[name="email_valided"]').val('0');
      el.addClass('error');
      toastr["error"]("Votre email n'a pas un format valide !", "Erreur !");
    }
  });

  $('form#signup input[name="password"]').keyup(debounce(function(e){

    var el = $(this);
    var val = el.val();

		if(val.length == 0) {
			el.addClass('error');
			toastr["error"]("Votre mot de passe est requis !", "Erreur !");
			$('#password-strengh').animate({width: "0%"});
			return;
		}

    if(val.length > 3) {

      // Must have capital letter, numbers and lowercase letters
      var strongRegex = new RegExp("^(?=.{8,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\\W).*$", "g");

      // Must have either capitals and lowercase letters or lowercase and numbers
      var mediumRegex = new RegExp("^(?=.{7,})(((?=.*[A-Z])(?=.*[a-z]))|((?=.*[A-Z])(?=.*[0-9]))|((?=.*[a-z])(?=.*[0-9]))).*$", "g");

      // Must be at least 6 characters long
      var okRegex = new RegExp("(?=.{6,}).*", "g");

      if(strongRegex.test(val)) {

        console.log('Password strong');

        el.removeClass('error');
        toastr.clear();
        $('#password-strengh').animate({width: "100%"});
        $('#password-strengh').attr('class', '').addClass('progress-bar').addClass('progress-bar-success');

      } else if(mediumRegex.test(val)) {

        console.log('Password medium');

        el.removeClass('error');
        toastr.clear();
        $('#password-strengh').animate({width: "60%"});
        $('#password-strengh').attr('class', '').addClass('progress-bar').addClass('progress-bar-warning');

      } else if(okRegex.test(val)) {

        console.log('Password okay');

        el.removeClass('error');
        toastr.clear();
        $('#password-strengh').animate({width: "30%"});
        $('#password-strengh').attr('class', '').addClass('progress-bar').addClass('progress-bar-danger');

      } else {

        console.log('Password too weak')

        el.addClass('error');
        toastr.clear();
        toastr["error"]("Votre mot de passe est trop faible !", "Erreur !");
        $('#password-strengh').animate({width: "10%"});
        $('#password-strengh').attr('class', '').addClass('progress-bar').addClass('progress-bar-danger');

      }
    }

  }, 200));

  $('form#signup input[name="password_confirmation"]').focusout(function(e){
    var el = $(this);
    var val = el.val();

    if(val != $('form#signup input[name="password"]').val()) {
      el.addClass('error');
      toastr.clear();
      toastr["error"]("Vos mots de passe ne sont pas identiques !", "Erreur !");
    } else {
      el.removeClass('error');
      toastr.clear();
    }
  });

});

function checkData(data) {

  if(!data['terms']) {
    return {statut:false, msg:'Vous devez accepter le réglement'};
  }
	if($('input[name="email_valided"]').val() != '1') {
		return {statut:false, msg:'Vous devez avoir un email valide'};
	}

}

</script>
