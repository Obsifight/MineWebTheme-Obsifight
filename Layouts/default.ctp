<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />
    <meta name="description" content="">
    <meta name="author" content="Eywek">

    <title><?= $title_for_layout; ?> - ObsiFight</title>

    <?= $this->Html->css('bootstrap.css') ?>

    <?= $this->Html->css('essentials.css') ?>
    <?= $this->Html->css('layout.css') ?>
    <?= $this->Html->css('animate.css') ?>

    <?= $this->Html->css('obsifight.css') ?>


		<!-- PAGE LEVEL SCRIPTS -->
    <?= $this->Html->css('header.css') ?>
		<?= $this->Html->css('red.css') ?>

		<!-- SWIE SLIDER -->
    <?= $this->Html->css('plugins/slider/swiper.min.css') ?>

	  <?= $this->Html->css('../font-awesome-4.1.0/css/font-awesome.min.css') ?>
	  <?= $this->Html->script('jquery-1.11.0.js') ?>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400%7CRaleway:300,400,500,600,700%7CLato:300,400,400italic,600,700" rel="stylesheet" type="text/css" />

    <link rel="icon" type="image/png" href="/theme/Obsifight/img/favicon.png" />
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div class="wrapper">

      <!-- Connexion/Inscription -->

        <?= $this->element('top-nav') ?>

      <!-- Navbar -->
        <?= $this->element('navbar') ?>

      <!-- Header -->
      <?php
      if(!isset($header) || $header) {
        echo $this->element('header');
      }
      ?>

      <!-- Flash -->
      <?php if(!empty($flash_messages) && ($this->params['controller'] !== 'shop' || $this->params['action'] != 'index')) { ?>
        <div class="container" style="margin-top:25px;margin-bottom:-70px;">
          <?= $flash_messages ?>
        </div>
      <?php } ?>

      <!-- Content -->
        <?= $this->fetch('content'); ?>


      <!-- Footer -->
        <?= $this->element('footer') ?>

    </div>


    <?= $this->element('modals') ?>

    <?= $this->Html->script('jquery-1.11.0.js') ?>
    <?= $this->Html->script('bootstrap.js') ?>
    <?= $this->Html->script('app.js') ?>
    <?= $this->Html->script('form.js') ?>
    <?= $this->Html->script('obsifight.js') ?>
    <?= $this->Html->script('jquery.appear.js') ?>
    <?= $this->Html->script('jquery.nicescroll.min.js') ?>
    <?= $this->Html->script('toastr.min.js') ?>
    <?= $this->Html->script('notification.js') ?>
    <script>
    <?php if($isConnected) { ?>
      // Notifications
      var notification = new $.Notification({
        'notification_type': 'user',
        'limit': 5,
        'url': {
          'get': '<?= $this->Html->url(array('plugin' => false, 'admin' => false, 'controller' => 'notifications', 'action' => 'getAll')) ?>',
          'clear': '<?= $this->Html->url(array('plugin' => false, 'admin' => false, 'controller' => 'notifications', 'action' => 'clear', 'NOTIF_ID')) ?>',
          'clearAll': '<?= $this->Html->url(array('plugin' => false, 'admin' => false, 'controller' => 'notifications', 'action' => 'clearAll')) ?>',
          'markAsSeen': '<?= $this->Html->url(array('plugin' => false, 'admin' => false, 'controller' => 'notifications', 'action' => 'markAsSeen', 'NOTIF_ID')) ?>',
          'markAllAsSeen': '<?= $this->Html->url(array('plugin' => false, 'admin' => false, 'controller' => 'notifications', 'action' => 'markAllAsSeen')) ?>'
        },
        'messages': {
          'markAsSeen': '<?= $Lang->get('NOTIFICATION__MARK_AS_SEEN') ?>',
          'notifiedBy': '<?= $Lang->get('NOTIFICATION__NOTIFIED_BY') ?>'
        },
        'indicator': {
          'element': '#notification-indicator',
          'class': 'label label-warning',
          'style': {},
          'defaultContent': '<i class="fa fa-bell-o"></i>'
        },
        'list': {
          'element': '#notification-container',
          'container': {
            'type': '',
            'class': '',
            'style': ''
          },
          'notification': {
            'type': 'li',
            'class': '',
            'style': 'list-style-type: none;border-bottom: solid 1px #eeeeee;text-transform: uppercase;letter-spacing: 0.08em;padding: 4px 0;',
            'content':'<a href="#" style="color: #999999;font-size: 12px;">{CONTENT}</a>',
            'from': {
              'type': '',
              'class': '',
              'style': '',
              'content': ''
            },
            'seen': {
              'element': {
                'style': '',
                'class': ''
              },
              'btn': {
                'element': '.mark-as-seen',
                'style': '',
                'class': 'hidden',
                'attr': [{'onclick': ''}],
              }
            }
          }
        }
      });
    <?php } ?>

    $(document).ready(

      function() {

        $("html").niceScroll();

      }

    );

    // Config FORM/APP.JS

    var LIKE_URL = "<?= $this->Html->url(array('controller' => 'news', 'action' => 'like')) ?>";
    var DISLIKE_URL = "<?= $this->Html->url(array('controller' => 'news', 'action' => 'dislike')) ?>";

    var LOADING_MSG = "<?= $Lang->get('GLOBAL__LOADING') ?>";
    var ERROR_MSG = "<?= $Lang->get('GLOBAL__ERROR') ?>";
    var INTERNAL_ERROR_MSG = "<?= $Lang->get('ERROR__INTERNAL_ERROR') ?>";
    var FORBIDDEN_ERROR_MSG = "<?= $Lang->get('ERROR__FORBIDDEN') ?>"
    var SUCCESS_MSG = "<?= $Lang->get('GLOBAL__SUCCESS') ?>";

    var CSRF_TOKEN = "<?= $csrfToken ?>";
    </script>

    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', '<?= $google_analytics ?>', 'auto');
      ga('send', 'pageview');
    </script>
    <?= $configuration_end_code ?>

</body>

</html>
