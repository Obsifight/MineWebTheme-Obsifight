<div id="topBar">
  <div class="container">

    <ul class="top-links list-inline pull-left">
      <li>
        <a target="_blank" href="<?= $facebook_link ?>" style="color:#3B5998;">
          <i style="opacity:1;" class="fa fa-facebook"></i>
          Facebook
        </a>
      </li>
      <li>
        <a target="_blank" href="<?= $twitter_link ?>" style="color:#4099FF;">
          <i style="opacity:1;" class="fa fa-twitter"></i>
          Twitter
        </a>
      </li>
      <li>
        <a target="_blank" href="<?= $youtube_link ?>" style="color:#bb0000;">
          <i style="opacity:1;" class="fa fa-youtube"></i>
          YouTube
        </a>
      </li>
      <li>
        <iframe id="radio" src="http://moveradio.fr/assets/obsifight" width="auto" height="30px" style="margin-bottom:-12px;"></iframe>
        <script type="text/javascript">
          /*$('#radio').load(function () {
            $('audio').pause();
          });*/
        </script>
      </li>
    </ul>


    <ul class="top-links list-inline pull-right">

      <?php if($isConnected) { ?>
        <li class="text-welcome hidden-xs">Bonjour, <strong><?= $user['pseudo'] ?></strong></li>

        <li>
          <a class="dropdown-toggle no-text-underline" data-toggle="dropdown" href="#"><i class="fa fa-user hidden-xs"></i> Mon compte</a>
          <ul class="dropdown-menu pull-right">
            <li><a tabindex="-1" href="<?= $this->Html->url(array('controller' => 'user', 'action' => 'profile', 'plugin' => false)) ?>"><i class="fa fa-user"></i> <?= $Lang->get('USER__PROFILE') ?></a></li>
            <?php if($Permissions->can('ACCESS_DASHBOARD')) { ?>
              <li><a class="text-danger" tabindex="-1" href="<?= $this->Html->url(array('controller' => 'admin', 'action' => 'index', 'admin' => true, 'plugin' => false)) ?>"><i class="fa fa-lock"></i> <?= $Lang->get('GLOBAL__ADMIN_PANEL') ?></a></li>
            <?php } elseif($EyPlugin->isInstalled('eywek.shop.1')) { ?>
              <li><a tabindex="-1" href="<?= $this->Html->url(array('controller' => 'shop', 'action' => 'index', 'plugin' => 'shop')) ?>"><i class="fa fa-shopping-basket"></i> <?= $Lang->get('SHOP__ADD_MONEY') ?></a></li>
            <?php } ?>
            <li class="divider"></li>
            <li><a tabindex="-1" href="<?= $this->Html->url(array('controller' => 'user', 'action' => 'logout', 'plugin' => false)) ?>"><i class="glyphicon glyphicon-off"></i> <?= $Lang->get('USER__LOGOUT') ?></a></li>
          </ul>
        </li>

      <?php } else { ?>
        <li><a href="#" data-toggle="modal" data-target="#login"><?= $Lang->get('USER__LOGIN') ?></a></li>
        <li><a href="<?= $this->Html->url('/signup') ?>"><i class="fa fa-sign-in"></i>  <?= $Lang->get('USER__REGISTER') ?></a></li>
      <?php } ?>
    </ul>

  </div>
</div>
