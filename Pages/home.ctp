<section>
  <div class="container">
    <div class="row">

			<div class="col-md-9">

        <?= $this->Html->image('logo.png', array('class' => 'pull-left')) ?>

				<div class="heading-title">
					<h2>ObsiFight ? C'est quoi ?</h2>
				</div>

        <p><b>ObsiFight</b> , tout d'abord, c'est plus de deux ans d'existence, sur cinq versions.</p>
        <p><b>ObsiFight</b>, c'est un serveur PvP Factions 1.7.10 moddé. Les mods ajoutent ou modifient de nombreux éléments du gameplay.</p>
        <h5><u>Comment décrire ObsiFight mieux qu'en décrivant votre arrivée ?</u></h5>

        <p>
          Lorsque vous arriverez sur le jeu, vous pourrez profiter d'<b>un spawn gigantesque</b>, où se trouve tout ce qu'il faut pour débuter. Y compris un tutoriel.
         Une fois que vous aurez traversé la <b>grande WarZone décorée</b>, vous irez faire votre base. Mais il vous faudra trouver quelques richesses pour vous protéger.
         En plus des minerais classiques, vous trouverez des <b>minerais inédits</b> tels que le Garnet, l'Améthyste, le Titanium... Vous pourrez les user pour fabriquer des armes, des armures.
         Mais certains minerais sont trop puissants pour être craftés normalement ; pour les user, vous devrez vous servir de <b>Core</b>.
         Une fois équipé des meilleurs outils, vous construirez votre base. Mais attention, l'<b>obsidienne ne résiste pas à la TNT</b> !
         Vous devrez vous servir de plusieurs murs, composés de sable, eau, ou de <b>blocs renforcés</b> qui ont la propriété de résister aux pistons !
        </p>

        <p>
          Vous voilà équipé et propriétaire d'une belle base, maintenant, c'est l'heure de conquérir la WarZone ! Invitez vos amis, et <b>fondez la meilleure des factions</b> !
          Avec eux, tentez de gagner les <b>Events réguliers</b> ! Dont la Question du Mercredi chaque semaine, l'Event End une semaine sur deux, les Event KingZombie, et tous les mini-jeux en serveur Event !
          Mais vos ennemis fuient dans leurs avant-postes... Pas de souci, il suffit de les <b>frapper</b> avec une <b>arme enchantée NoBack</b> pour qu'ils ne puissent plus s'enfuir, ni user d'Enderperles !
          Tant qu'à terrasser vos ennemis, autant les piller ! Allez chercher leur base, et pistonnez ! Usez de TNT, ainsi que de <b>TNT au Xénotium</b>, vingt fois plus puissante !
        </p>

        <p>
          Mais surtout, <b>ObsiFight</b>, c'est un serveur garanti sans aucun lag, même avec 300 connectés, pour un PvP optimal !<br>
          Rejoignez-nous, et devenez le plus fort !
        </p>

			</div>

			<div class="col-md-3 animated bounceInRight">

				<div class="box-static box-border-top margin-bottom-60">
					<div class="box-title">
						<h4>Nos objectifs</h4>
					</div>
					<ul class="list-unstyled list-icons padding-15 nopadding-bottom">
						<li class="margin-bottom-20">
							<i class="fa fa-check text-success size-18"></i>
							<span class="block bold size-18">PvP Fluide</span>
							<small>Rien de mieux que pouvoir se battre sans lag !</small>
						</li>
						<li class="margin-bottom-20">
							<i class="fa fa-check text-success size-18"></i>
							<span class="block bold size-18">Events réguliers</span>
							<small>Pouvoir vous divertir et vous aider dans votre progression !</small>
						</li>
						<li class="margin-bottom-20">
							<i class="fa fa-check text-success size-18"></i>
							<span class="block bold size-18">Nouveaux items</span>
							<small>Être original, avec de nouveaux items, blocs...</small>
						</li>
					</ul>
				</div>

			</div>
	   </div>
  </div>
</section>
<section class="padding-md parallax parallax-2" style="background-image: url('/theme/Obsifight/img/spawn5.png'); background-position: 50% 50%;">
	<div class="overlay dark-4"><!-- dark overlay [1 to 9 opacity] --></div>

	<div class="container">

		<div class="text-center">
			<h3 class="nomargin">Nous sommes actuellement en version 5 !</h3>
			<p class="font-lato weight-300 lead nomargin-top">Découvrez dès maintenant notre trailer</p>

      <div class="col-md-3 hidden-sm hidden-xs"></div>
      <div class="col-md-6">
        <div class="embed-responsive embed-responsive-16by9">
          <iframe class="embed-responsive-item" width="560" height="315" src="https://www.youtube.com/embed/CloOsij2nls?autoplay=0&amp;loop=1&amp;autohide=1&amp;controls=0&amp;theme=light" frameborder="0" allowfullscreen=""></iframe>
        </div>
      </div>
      <div class="col-md-3 hidden-sm hidden-xs"></div>
		</div>

	</div>

</section>
<div class="hidden-xs">
  <div class="row box-gradient box-red">
		<div class="col-xs-6 col-sm-3">
			<i class="fa fa-users fa-4x"></i>
			<h2 class="countTo font-raleway" data-speed="5000"><?= (isset($registered_count)) ? $registered_count : '0' ?></h2>
			<p>Inscris</p>
		</div>

		<div class="col-xs-6 col-sm-3">
			<i class="fa fa-child fa-4x"></i>
			<h2 class="countTo font-raleway" data-speed="5000"><?= ($server_infos) ? $server_infos['getPlayerCount'] : '0' ?></h2>
			<p>Joueurs connectés actuellement</p>
		</div>

		<div class="col-xs-6 col-sm-3">
			<i class="fa fa-eye fa-4x"></i>
			<h2 class="font-raleway" data-speed="5000" id="visits_count">Chargement...</h2>
			<p>Visites</p>
		</div>

		<div class="col-xs-6 col-sm-3">
			<i class="fa fa-bar-chart fa-4x"></i>
			<h2 class="font-raleway" data-speed="5000"><?= $maxPlayers ?></h2>
			<p>Joueurs maximums</p>
		</div>
	</div>
</div>
<script type="text/javascript">
  $.ajax({
    url: '<?= $this->Html->url('/obsiapi/stats/getVisits') ?>',
    dataType: 'json',
    method: 'get',
    async: true,
    success : function(data) {
      $('#visits_count').html(data.visits_all);
      $('#visits_count').addClass('countTo');
      refreshCountTo();
    }
  });
</script>
<section class="alternate">
	<div class="container">

		<div class="heading-title heading-dotted text-center">
			<h4>Nos dernières actualités</h4>
		</div>

    <?php

    if(isset($search_news) && !empty($search_news)) {

      $i = 0;
      foreach ($search_news as $k => $news) {
        $i++;

        if($i <= 3) {

          echo '<blockquote class="animated slideInLeft">';
            echo '<h4>'.$news['News']['title'].'</h4>';
      			echo '<p>'.$this->Text->truncate(strip_tags($news['News']['content']), 135, array('ellipsis' => '...', 'html' => true)).'</p>';
            echo '<p>';
              echo '<a href="'.$this->Html->url('/blog/'.$news['News']['slug']).'" class="btn btn-3d btn-reveal btn-red" style="background-color:#A94545;">';
      					echo '<i class="fa fa-plus"></i>';
      					echo '<span>Lire plus</span>';
      				echo '</a>';
            echo '</p>';
      		echo '</blockquote>';

        } else {
          break;
        }
      }

    } else {
      echo '<div class="alert alert-danger">Aucune actualité n\'a été postée !</div>';
    }

    ?>

	</div>
</section>
<section class="padding-md parallax parallax-2" style="background-image: url('/theme/Obsifight/img/header.png'); background-position: 50% 50%;">

  <div class="overlay dark-2"><!-- dark overlay [1 to 9 opacity] --></div>

	<div class="container">

		<div class="text-center">
			<h3 class="nomargin">La communauté</h3>
			<p class="font-lato weight-300 lead nomargin-top">Rejoignez-nous sur nos réseaux sociaux pour plus d'infos ou de concours !</p>
		</div>

    <div class="text-center">
  		<ul class="margin-top-80 social-icons list-unstyled list-inline">
  			<li>
  				<a target="_blank" href="<?= $facebook_link ?>">
  					<i class="fa fa-facebook"></i>
  					<h4>Facebook</h4>
  					<span>Aimez-nous</span>
  				</a>
  			</li>
  			<li>
  				<a target="_blank" href="<?= $twitter_link ?>">
  					<i class="fa fa-twitter"></i>
  					<h4>Twitter</h4>
  					<span>Suivez-nous</span>
  				</a>
  			</li>
  			<li>
  				<a target="_blank" href="<?= $youtube_link ?>">
  					<i class="fa fa-youtube"></i>
  					<h4>Youtube</h4>
  					<span>Nos vidéos</span>
  				</a>
  			</li>
  		</ul>
    </div>

	</div>

</section>
