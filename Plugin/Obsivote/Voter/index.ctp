<section style="padding-top: 30px;">
  <div class="container">

    <div class="alert alert-info">
      <p>Nous sommes positionné <b id="rpg-position"><i class="fa fa-refresh fa-spin"></i></b> dans le classement de RPG-Paradize !</p>
      <p>
        <em>
          Vous ne savez pas <b>comment voter</b> ? C'est simple !
          <a href="#" data-toggle="modal" data-target="#tutorial" class="btn btn-info pull-right btn-sm" style="margin-top: -8px;">Voir le tutoriel</a>
        </em>
      </p>
    </div>
    <script type="text/javascript">
      $.get('/vote/position', function (data) {
        if (data.status && data.position)
          $('#rpg-position').html(data.position)
        else
          $('#rpg-position').parent().remove()
      })
    </script>

    <div class="block-center">

      <div class="row process-wizard process-wizard-danger margin-bottom-60">

        <?php if(!$isConnected) { ?>
          <div class="col-xs-3 process-wizard-step active" id="step1">
        		<div class="text-center process-wizard-stepnum">Étape 1</div>
        		<div class="progress"><div class="progress-bar"></div></div>
        		<a href="#" class="process-wizard-dot"></a>
        		<div class="process-wizard-info text-center">Votre pseudo</div>
        	</div>
        <?php } ?>

      	<div class="col-xs-<?= (!$isConnected) ? '3' : '4' ?> process-wizard-step <?= (!$isConnected) ? 'disabled' : 'active' ?>" id="step2">
      		<div class="text-center process-wizard-stepnum">Étape <?= (!$isConnected) ? '2' : '1' ?></div>
      		<div class="progress"><div class="progress-bar"></div></div>
      		<a href="#" class="process-wizard-dot"></a>
      		<div class="process-wizard-info text-center">Voter</div>
      	</div>

      	<div class="col-xs-<?= (!$isConnected) ? '3' : '4' ?> process-wizard-step disabled" id="step3"><!-- complete -->
      		<div class="text-center process-wizard-stepnum">Étape <?= (!$isConnected) ? '3' : '2' ?></div>
      		<div class="progress"><div class="progress-bar"></div></div>
      		<a href="#" class="process-wizard-dot"></a>
      		<div class="process-wizard-info text-center">Remplir l'OUT</div>
      	</div>

      	<div class="col-xs-<?= (!$isConnected) ? '3' : '4' ?> process-wizard-step disabled" id="step4"><!-- complete -->
      		<div class="text-center process-wizard-stepnum">Étape <?= (!$isConnected) ? '4' : '3' ?></div>
      		<div class="progress"><div class="progress-bar"></div></div>
      		<a href="#" class="process-wizard-dot"></a>
      		<div class="process-wizard-info text-center">Récupérer votre récompense</div>
      	</div>

      </div>

      <?php if(!$isConnected) { ?>
        <div id="step1-content">
          <div class="col-md-4 col-sm-2 col-xs-2"></div>
          <div class="col-md-4 col-sm-8 col-xs-8">
            <form data-ajax="true" action="<?= $this->Html->url(array('action' => 'setPseudo')) ?>" data-callback-function="afterSetPseudoSuccess">

              <div class="form-group">
                <label class="control-label">Pseudo</label>
                <input type="text" placeholder="Votre pseudo" name="pseudo" class="form-control">
              </div>

              <div class="margiv-top10">
                <button type="submit" class="btn btn-aqua block-center"><i class="fa fa-check"></i> Passer à l'étape suivante</button>
              </div>

            </form>
          </div>
          <div class="col-md-4 col-sm-2 col-xs-2"></div>

          <script type="text/javascript">
            function afterSetPseudoSuccess(data, response) {
              $('#step1').removeClass('active').addClass('complete');
              $('#step2').removeClass('disabled').addClass('active');
              $('#step1-content').fadeOut(150, function() {
                $('#step2-content').fadeIn(150);
              });
            }
          </script>

        </div>
      <?php } ?>

      <div id="step2-content" style="display:<?= (!$isConnected) ? 'none' : 'block' ?>;">

        <?php if(!isset($wait_time)) { ?>
          <div class="col-md-4 col-sm-2"></div>
          <div class="col-md-4 col-sm-8">
            <button type="button" id="vote" class="btn btn-danger btn-featured">
        			<span>Voter sur RPG-Paradize</span>
        			<i class="et-trophy"></i>
        		</button>
          </div>
          <div class="col-md-4 col-sm-2"></div>

          <script type="text/javascript">
            $('#vote').click(function(e) {

              e.preventDefault();

              window.open("<?= $voteURL ?>");

              var btn = $(this);
              btn.addClass('disabled').attr('disabled', true);

              $('#step2').removeClass('active').addClass('complete');
              $('#step3').removeClass('disabled').addClass('active');
              $('#step2-content').fadeOut(150, function() {
                $('#step3-content').fadeIn(150);
              });

            });
          </script>
        <?php } else { ?>
          <div class="alert alert-danger"><b>Erreur : </b>Vous avez déjà voté ! Revenez dans <?= $wait_time ?>.</div>
        <?php } ?>

      </div>

      <div id="step3-content" style="display:none;">

        <div class="col-md-4 col-sm-2 col-xs-2"></div>
        <div class="col-md-4 col-sm-8 col-xs-8">
          <form data-ajax="true" action="<?= $this->Html->url(array('action' => 'checkOut')) ?>" data-callback-function="afterCheckOutSuccess">

            <div class="form-group">
              <label class="control-label">OUT</label>
              <input type="text" placeholder="Nombre de clics sortants" name="out" class="form-control">
            </div>

            <div class="form-group">
              <script src='https://www.google.com/recaptcha/api.js'></script>
              <label class="input">
                  <div class="g-recaptcha" data-sitekey="<?= $reCaptcha['siteKey'] ?>" style="margin: 0 auto;width: 304px;"></div>
              </label>
            </div>

            <div class="margiv-top10">
              <button type="submit" class="btn btn-primary block-center"><i class="fa fa-check"></i> Vérifier</button>
            </div>

          </form>
        </div>
        <div class="col-md-4 col-sm-2 col-xs-2"></div>

        <script type="text/javascript">
          function afterCheckOutSuccess(data, response) {
            $('#step3').removeClass('active').addClass('complete');
            $('#step4').removeClass('disabled').addClass('active');

            var pseudo = <?= (!$isConnected) ? '$(\'input[name="pseudo"]\').val()' : "'".$user['pseudo']."'" ?>;

            $.ajax({
              url: '<?= $this->Html->url(array('controller' => 'voter', 'action' => 'isInGame', 'plugin' => 'obsivote')) ?>/'+pseudo,
              method: 'get',
              async: false,
              success: function(data) {
                if(data.isInGame) {
                  $('#reward-now').removeClass('btn-brown').removeClass('disabled').attr('disabled', false).addClass('btn-success');
                } else {
                  $('#reward-later').removeClass('btn-brown').removeClass('disabled').attr('disabled', false).addClass('btn-success');
                }
              },
              error : function(xhr) {
                $('#reward-later').removeClass('btn-brown').removeClass('disabled').attr('disabled', false).addClass('btn-success');
              }
            });

            $('#step3-content').fadeOut(150, function() {
              $('#step4-content').fadeIn(150);
            });
          }
        </script>

      </div>

      <div id="step4-content" style="display:none;">


        <div id="reward-msg"></div>

        <div class="col-md-4 col-sm-2 hidden-xs"></div>
        <div class="col-md-4 col-sm-8 col-xs-12">
          <a href="#" id="reward-now" class="get-reward btn btn-3d btn-xlg btn-reveal btn-brown btn-block disabled" disabled>
            <i class="fa fa-gift"></i>
            <span>Récupérer ma récompense en jeu</span>
          </a>

          <a href="#" id="reward-later" class="get-reward btn btn-3d btn-xlg btn-reveal btn-brown btn-block disabled" disabled>
            <i class="fa fa-gift"></i>
            <span>Stocker ma récompense</span>
          </a>
        </div>
        <div class="col-md-4 col-sm-2 hidden-xs"></div>

        <script type="text/javascript">
          $('.get-reward').click(function(e) {

            e.preventDefault();

            var btn = $(this);
            var btn_content = btn.html();
            btn.addClass('disabled').attr('disabled', true).html('Chargement...').removeClass('btn-success').addClass('btn-info');

            $.get('<?= $this->Html->url(array('controller' => 'voter', 'action' => 'getRewards', 'plugin' => 'obsivote')) ?>', function(data) {

              if(data.statut) {
                btn.html('Récupéré').removeClass('btn-info').addClass('btn-success');
                $('#reward-msg').fadeIn(150).html('<div class="alert alert-success"><b>Succès : </b>'+data.msg+'</div>');
              } else {
                btn.removeClass('disabled').attr('disabled', false).html(btn_content).addClass('btn-success').removeClass('btn-info');
                $('#reward-msg').fadeIn(150).html('<div class="alert alert-danger"><b>Erreur : </b>'+data.msg+'</div>');
              }

            });

          })
        </script>

      </div>

    </div>
  </div>
</section>
<section class="padding-md parallax parallax-2" style="background-image: url('/theme/Obsifight/img/spawn6.png'); background-position: 50% 50%;">
  <div class="container">

    <h3 class="nomargin">Classement <span>des meilleurs voteurs</span></h3>

    <table class="table table-vertical-middle">
			<thead>
				<tr>
					<th>Position</th>
					<th>Pseudo</th>
					<th>Nbr. votes</th>
					<th>Gain</th>
				</tr>
			</thead>
			<tbody>
        <?php
        $i = 0;
        foreach ($ranking as $key => $value) {
          echo '<tr>';
            echo '<td>#'.($i+1).'</td>';
            echo '<td>'.$value['User']['pseudo'].'</td>';
            echo '<td>'.$value['User']['vote'].'</td>';
            $html = explode(',', $kits[$kits_keys[$i]]);
            $html = implode('<br>-', $html);
            echo '<td style="position:relative;"><button class="btn btn-success" data-html="true" data-placement="left" data-toggle="popover" title="Contenu du kit" data-content="- '.$html.'"> Kit voteur '.($i+1).'</button></td>';
            unset($html);
          echo '</tr>';
          $i++;
        }
        ?>
      </tbody>
		</table>
    <style media="screen">
      .popover-title {
        font-size: 14px !important;
        color: black !important;
      }
      .popover-content {
        color: black!important;
      }
    </style>
    <script type="text/javascript">
      function isMobile() {
        try{ document.createEvent("TouchEvent"); return true; }
        catch(e){ return false; }
      }
      $(function () {
        if(!isMobile()) {
          $('[data-toggle="popover"]').popover({
            trigger:'hover',
            template:'<div class="popover" style="display: block;top: -108px;position: absolute;right: 110px;" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>'
          });
        }
      })
    </script>
  </div>
</section>

<section class="alternate">
  <div class="container">

    <div class="heading-title heading-line-single">
    	<h2>Liste des <span>récompenses</span></h2>
    </div>

    <div class="table-responsive">
    	<table class="table table-bordered table-striped">
    		<thead>
    			<tr>
    				<th>Nom de la récompense</th>
    				<th>Chance</th>
    			</tr>
    		</thead>
    		<tbody>
    			<?php

          foreach ($rewards as $key => $value) {

            if($value['proba'] <= 5) {
              $label_type = 'danger';
            } elseif($value['proba'] <= 10) {
              $label_type = 'warning';
            } elseif($value['proba'] <= 30) {
              $label_type = 'success';
            } else {
              $label_type = 'default';
            }

            echo '<tr>';
              echo '<td>'.$value['name'].'</td>';
              echo '<td><span class="label label-'.$label_type.'">'.$value['proba'].'%</span></td>';
            echo '</tr>';

          }

          ?>
    		</tbody>
    	</table>
    </div>

  </div>
</section>
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="tutorial">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
        <h4 class="modal-title">Tutoriel de vote</h4>
      </div>
      <div class="modal-body">
        <p>Voici le tutoriel vidéo pour vous expliquer comment voter simplement !</p>
        <div class="player-vid"></div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?= $this->Html->script('html5-video-player') ?>
<?= $this->Html->css('html5-video-player') ?>
<script type="text/javascript">
$(document).ready(function() {
  $('.player-vid').html5_video({
    source : {
      "video/mp4"  : "http://obsifight.net/video/tutorial_vote.mp4",
    },
    title: 					'',
    color: 					'#A94545',
    width: 					false,
    poster: 				'/theme/Obsifight/img/tutorial_vote_poster.jpg',
    buffering_text: 		'Chargement...',
    autoplay: 				false,
    play_control: 			true,
    time_indicator: 		true,
    volume_control: 		false,
    share_control: 			false,
    fullscreen_control: 	true,
    dblclick_fullscreen: 	true,

    volume: 				0.0,

    show_controls_on_load: 	true,
    show_controls_on_pause: true,
  });

});
</script>
