<section id="one" class="section">
	<div class="container">

		<p class="text-center"><?= $this->Html->image('logo.png') ?></p>

    <p class="text-center"><u>ObsiFight, un serveur PvP Factions 1.7.10 avec des mods inédits !</u></p>

    <p class="text-center">
      Que vous préfériez être seul ou jouer avec tous vos amis, <b>ObsiFight</b> est le serveur idéal !<br>
      Rejoignez-nous dès maintenant en suivant les instructions de cette page !
    </p>

	</div>
</section>
<section id="two" class="section theme-color">
	<div class="container">

    <div class="heading-title heading-dotted text-center">
			<h4>Etape 1 : Inscrivez-vous.</h4>
		</div>

		<p class="text-center">
      Si vous l'avez déjà fait, passez directement à l'étape suivante.<br>
      Connectez-vous si vous ne l'êtes pas.
    </p>

    <p class="text-center">
      Si vous n'êtes pas encore inscrit, cliquez sur "<a href="<?= $this->Html->url('/signup') ?>">S'inscrire</a>" en haut à droite de la page et suivez les instructions.<br>
      Veillez à bien compléter le ReCaptcha, et à choisir un mot de passe moyen ou fort (en d'autres mots, qui n'est pas facile à deviner).<br>
      Choisissez une adresse mail à laquelle vous avez un accès permanent ! Créez-en une s'il le faut !
    </p>

    <p class="text-center">Si votre adresse mail est incorrecte ou si vous en avez perdu l'accès, veuillez contacter un administrateur pour la changer.</p>

	</div>
</section>
<section id="three" class="section alternate">
	<div class="container">

    <div class="heading-title heading-dotted text-center">
			<h4>Etape 2 : Téléchargez le launcher.</h4>
		</div>

		<p class="text-center">
      Cliquez sur l'icône correspondant à votre système d'exploitation.<br>
      Le téléchargement démarrera directement.
    </p>

    <p class="text-center">
      <a href="<?= $this->Html->url('/dl/ObsiFight.exe') ?>"><?= $this->Html->image('windows.png') ?></a>
      <a href="<?= $this->Html->url('/dl/ObsiFight.jar') ?>"><?= $this->Html->image('mac.png') ?></a>
      <a href="<?= $this->Html->url('/dl/ObsiFight.jar') ?>"><?= $this->Html->image('linux.png') ?></a>
    </p>

	</div>
</section>
<section id="four" class="section padding-xs">
	<div class="container">

    <div class="heading-title heading-dotted text-center">
			<h4>Etape 3 : Lancez le jeu.</h4>
		</div>

		<p class="text-center">
      Ouvrez le launcher, et entrez vos identifiants. Tout simplement.<br>
      Veillez bien à entrer votre pseudonyme IG et non pas votre adresse mail.<br>
      Le téléchargement démarrera automatiquement, et le jeu sera lancé quand tous les fichiers seront téléchargés.<br>
      En cas de problème durant l'installation, veuillez vous référer à <a href="<?= $this->Html->url('/FAQ') ?>">cette page</a>.
    </p>

	</div>
</section>
<section id="five" class="section dark">
	<div class="container">

    <div class="heading-title heading-dotted text-center">
			<h4>Détails techniques :</h4>
		</div>

		<p class="text-center">
      <ul>
        <li>ObsiFight est un serveur PvP gratuit, sans whitelist ni candidature.</li>
        <li>ObsiFight n'accepte que les inscriptions sur son site (et non pas les officielles).</li>
        <li>Ce serveur possède un système d'économie en Points Boutique (monnaie du site), et un autre en Dollars (monnaie en jeu).</li>
        <li>Ce serveur possède un système de Factions.</li>
        <li>La TNT est activée, fait des dégâts et explose sur la map principale. La TNT au Xénotium est similaire, mais plus puissante.</li>
        <li>Le pistonnage est possible dans les claims ennemis.</li>
        <li>Les explosions autres que celles de la TNT n'affectent pas le décor.</li>
        <li>Ce serveur possède des <a href="http://forum.obsifight.fr/index.php?threads/c-g-u-dobsifight.15819/">Conditions Générales d'Utilisation</a>.</li>
      </ul>
    </p>

	</div>
</section>
<nav class="smartscroll-controls">
  <a href="#" class="prev scroll"></a>
  <a href="#" class="next scroll"></a>
</nav>
<?= $this->Html->css('jquery.smartscroll') ?>
<?= $this->Html->script('jquery.smartscroll.min') ?>
<script type="text/javascript">
  $(document).smartscroll();
</script>
<style media="screen">
  nav.smartscroll-controls > a.next,
  nav.smartscroll-controls > a.prev {
    border-color: #A94545;
  }
  nav.smartscroll-controls {
    left: auto;
    right: 50px;
  }
</style>
