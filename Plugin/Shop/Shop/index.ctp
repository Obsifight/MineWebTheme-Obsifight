<?= $this->Html->css('Shop.jquery.bootstrap-touchspin.css') ?>
<?= $this->Html->css('layout-shop') ?>
<section class="page-header page-header-lg parallax parallax-3" style="padding-top:40px;background-image: url('/theme/Obsifight/img/spawn4.png');/* background-position: 50% 36px;*/">
	<div class="overlay dark-2"><!-- dark overlay [1 to 9 opacity] --></div>

	<div class="container">

		<h1>Acheter des articles</h1>

		<!-- breadcrumbs -->
		<ol class="breadcrumb">
      <li><a href="<?= $this->Html->url('/') ?>"><?= $Lang->get('GLOBAL__HOME') ?></a></li>
      <li class="active">Boutique</li>
		</ol><!-- /breadcrumbs -->

	</div>

  <div class="container margin-top-60">
    <div class="row">
      <div class="col-md-9">

        <div class="heading-title heading-border">
    			<h1 style="background-color:transparent;">Le saviez-vous ?</h1>
    			<p class="font-lato size-19"><?= $didYouKnow[rand(0, (count($didYouKnow)-1))] ?></p>
    		</div>

      </div>
      <div class="col-md-3">
        <?php if($isConnected AND $Permissions->can('CREDIT_ACCOUNT')) { ?>
            <a href="#" data-toggle="modal" data-target="#addmoney" class="btn btn-success btn-3d btn-block"><?= $Lang->get('SHOP__ADD_MONEY') ?></a>
        <?php } ?>
        <?php if($isConnected) { ?>
          <a href="#" data-toggle="modal" data-target="#cart-modal" class="btn btn-primary btn-3d btn-block"><?= $Lang->get('SHOP__BUY_CART') ?></a>
        <?php } ?>
      </div>
    </div>
  </div>

</section>

<section>
  <div class="container">

  	<div class="row">

  		<!-- LEFT -->
  		<div class="col-lg-9 col-md-9 col-sm-9">

        <?= $vouchers->get_vouchers() // Les promotions en cours ?>

  			<ul class="shop-item-list row list-inline nomargin">

          <?php
          $i = 0;

          foreach ($search_categories as $key => $value) {

            $category_name = $value['Category']['name'];
            $category_id = $value['Category']['id'];

            echo '<div data-category-id='.$category_id.' class="category"';
            echo ($i == 0) ? ' style="display:block"' : ' style="display:none"';
            echo '>';

            $category_rank_id = 3;
            $cond_ranks = ($category_id == $category_rank_id);
            $ranks_desc = array(
              '<ul class="list-unstyled">
                <li><i class="fa fa-check text-success"></i> ipsum dolor sit amet</li>
                <li><i class="fa fa-check text-success"></i> consectetur adipiscing</li>
                <li><i class="glyphicon glyphicon-remove text-danger"></i> tempor incididunt ut</li>
                <li><i class="fa fa-check text-success"></i> dolore magna aliqua</li>
                <li><i class="glyphicon glyphicon-remove text-danger"></i> enim ad minim veniam</li>
                <li><i class="fa fa-check text-success"></i> nostrud exercitation</li>
                <li><i class="glyphicon glyphicon-remove text-danger"></i> ullamco laboris nisi ut</li>
              </ul>',
              '<ul class="list-unstyled">
                <li><i class="fa fa-check text-success"></i> ipsum dolor sit amet</li>
                <li><i class="fa fa-check text-success"></i> consectetur adipiscing</li>
                <li><i class="glyphicon glyphicon-remove text-danger"></i> tempor incididunt ut</li>
                <li><i class="fa fa-check text-success"></i> dolore magna aliqua</li>
                <li><i class="glyphicon glyphicon-remove text-danger"></i> enim ad minim veniam</li>
                <li><i class="fa fa-check text-success"></i> nostrud exercitation</li>
                <li><i class="glyphicon glyphicon-remove text-danger"></i> ullamco laboris nisi ut</li>
              </ul>',
              '<ul class="list-unstyled">
                <li><i class="fa fa-check text-success"></i> ipsum dolor sit amet</li>
                <li><i class="fa fa-check text-success"></i> consectetur adipiscing</li>
                <li><i class="glyphicon glyphicon-remove text-danger"></i> tempor incididunt ut</li>
                <li><i class="fa fa-check text-success"></i> dolore magna aliqua</li>
                <li><i class="glyphicon glyphicon-remove text-danger"></i> enim ad minim veniam</li>
                <li><i class="fa fa-check text-success"></i> nostrud exercitation</li>
                <li><i class="glyphicon glyphicon-remove text-danger"></i> ullamco laboris nisi ut</li>
              </ul>'
            ); // Pour les rangs
            $ranks = array();

            foreach ($search_items as $k => $v) {

              if($v['Item']['category'] == $category_id) {

                if($cond_ranks) {

                  $ranks[$v['Item']['id']]['id'] = $v['Item']['id'];
                  $ranks[$v['Item']['id']]['name'] = $v['Item']['name'];
                  $ranks[$v['Item']['id']]['price'] = $v['Item']['price'];
                  $ranks[$v['Item']['id']]['img'] = (isset($v['Item']['img_url'])) ? $v['Item']['img_url'] : false;

                } else {

                  echo '<div class="col-sm-4 col-lg-4 col-md-4">';
                    echo '<div class="thumbnail">';
                      if(isset($v['Item']['img_url'])) {
                        echo '<img src="'.$v['Item']['img_url'].'" alt="">';
                      }
                      echo '<div class="caption">';

                        echo '<div class="text-center">';
                          echo '<div class="heading-title heading-border-bottom heading-color" style="display: inline-block;">';
                          	echo '<h3 style="padding:0;">'.before_display($v['Item']['name']).'</h3>';
                          echo '</div>';
                        echo '</div>';

                        echo '<div class="text-center">';
                          echo '<div class="btn-group" role="group">';
                            if($isConnected AND $Permissions->can('CAN_BUY')) {
                              echo '<button type="button" class="btn btn-3d btn-success display-item" data-item-id="'.$v['Item']['id'].'">';
                                echo $Lang->get('SHOP__BUY');
                              echo '</button>';
                            }
                            echo '<button type="button" class="btn btn-teal disabled" disabled>';
                              echo $v['Item']['price'];
                              echo ($v['Item']['price'] == 1) ? ' '.$singular_money : ' '.$plural_money;
                            echo '</button>';
                          echo '</div>';
                        echo '</div>';

                        echo '<div class="clearfix"></div>';

                      echo '</div>';
                    echo '</div>';
                  echo '</div>';

                }

              }
            }

            if($cond_ranks) { // On affiche le truc perso

              echo '<div class="table-responsive">';
                echo '<table class="shop-compare table table-bordered" style="border: 0!important;">';
                  echo '<tbody>';
                    echo '<tr>';
                      echo '<td class="text-right shop-compare-title" style="background:transparent;border: 0!important;"></td>';

                        foreach ($ranks as $id => $data) {

                          echo '<td class="text-center">';
                            echo '<a class="shop-compare-item display-item" data-item-id="'.$id.'" href="#">';
                              echo '<img class="img-responsive" src="'.$data['img'].'" alt="shop first image">';
                            echo '</a>';
                          echo '</td>';

                        }

                    echo '</tr>';
                    echo '<tr>';

                      echo '<td class="text-right shop-compare-title">Prix</td>';

                      foreach ($ranks as $id => $data) {

                        echo '<td class="text-center size-20">'.$data['price'].' '.$Configuration->getMoneyName().'</td>';

                      }

                    echo '</tr>';

                    echo '<tr>';

                      echo '<td class="text-right shop-compare-title">Caractéristiques</td>';

                      foreach ($ranks_desc as $k => $data) {
                        echo '<td>';
                          echo $data;
                        echo '</td>';
                      }

                    echo '</tr>';

                    echo '<tr class="text-center">';

                      echo '<td class="text-right shop-compare-title" style="background:transparent;border: 0!important;"><!-- leave empty --></td>';

                        foreach ($ranks as $id => $data) {

                          echo '<td>';
                            echo '<a class="btn btn-red btn-3d nomargin display-item" data-item-id="'.$id.'"><i class="fa fa-cart-plus"></i> Acheter</a>';
                          echo '</td>';

                        }

                    echo '</tr>';

                  echo '</tbody>';
                echo '</table>';
              echo '</div>';


            }

            echo '</div>';

            unset($category_name);
            unset($category_id);

            $i++;

          }

          ?>

  			</ul>

  		</div>


  		<!-- RIGHT -->
  		<div class="col-lg-3 col-md-3 col-sm-3">

  			<!-- CATEGORIES -->
  			<div class="side-nav margin-bottom-60">

  				<div class="side-nav-head">
  					<button class="fa fa-bars"></button>
  					<h4>Catégories</h4>
  				</div>

  				<ul class="list-group list-group-bordered list-group-noicon uppercase">

            <?php
            $i = 0;
            foreach ($search_categories as $k => $v) {
              $i++;
            ?>
              <li class="list-group-item<?= (isset($category) AND $v['Category']['id'] == $category OR !isset($category) AND $i == 1) ? ' active' : ''; ?>">
                <a href="#" class="toggle-category" data-category-id="<?= $v['Category']['id'] ?>"><?= before_display($v['Category']['name']) ?></a>
              </li>
            <?php } ?>

  				</ul>

  			</div>
  			<!-- /CATEGORIES -->

  		</div>

  	</div>

  </div>
  </section>
  <script type="text/javascript">
    $('.toggle-category').on('click', function(e) {

      e.preventDefault();

      var el = $(this);
      var category = el.attr('data-category-id');
      var category_div = $('.category[data-category-id="'+category+'"]');

      $('.toggle-category').parent().closest('.active').removeClass('active');

      $('.category').each(function(e) {
        if($(this).css('display') == "block") {

          $(this).fadeOut(150, function(e) {
            category_div.fadeIn(150);
          });

          el.parent().addClass('active');

        }
      });

    })
  </script>
  <script type="text/javascript">
    var LOADING_MSG = '<?= $Lang->get('GLOBAL__LOADING') ?>';
    var ADDED_TO_CART_MSG = '<?= $Lang->get('SHOP__BUY_ADDED_TO_CART') ?> <i class="fa fa-check"></i>';
    var CART_EMPTY_MSG = '<?= $Lang->get('SHOP__BUY_CART_EMPTY') ?>';
    var ITEM_GET_URL = '<?= $this->Html->url(array('controller' => 'shop/ajax_get', 'plugin' => 'shop')); ?>/';
    var VOUCHER_CHECK_URL = '<?= $this->Html->url(array('action' => 'checkVoucher')) ?>/';
    var BUY_URL = '<?= $this->Html->url(array('action' => 'buy_ajax')) ?>';

    var CART_ITEM_NAME_MSG = '<?= $Lang->get('SHOP__ITEM_NAME') ?>';
    var CART_ITEM_PRICE_MSG = '<?= $Lang->get('SHOP__ITEM_PRICE') ?>';
    var CART_ITEM_QUANTITY_MSG = '<?= $Lang->get('SHOP__ITEM_QUANTITY') ?>';
    var CART_ACTIONS_MSG = '<?= $Lang->get('GLOBAL__ACTIONS') ?>';

    var CSRF_TOKEN = '<?= $csrfToken ?>';
  </script>
  <?= $this->Html->script('Shop.jquery.cookie') ?>
  <?= $this->Html->script('Shop.shop') ?>
  <?= $this->Html->script('Shop.jquery.bootstrap-touchspin.js') ?>
  <div class="modal fade" id="buy-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title"><?= $Lang->get('SHOP__BUY_CONFIRM') ?></h4>
        </div>
        <div class="modal-body">
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="cart-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title"><?= $Lang->get('SHOP__BUY_CART') ?></h4>
        </div>
        <div class="modal-body">
        </div>
        <div class="modal-footer">
          <div class="pull-left">
            <input name="cart-voucher" type="text" class="form-control" autocomplete="off" id="cart-voucher" style="width:245px;" placeholder="<?= $Lang->get('SHOP__BUY_VOUCHER_ASK') ?>">
          </div>
          <button class="btn disabled"><?= $Lang->get('SHOP__ITEM_TOTAL') ?> : <span id="cart-total-price">0</span>  <?= $Configuration->getMoneyName() ?></button>
          <button type="button" class="btn btn-primary" id="buy-cart"><?= $Lang->get('SHOP__BUY') ?></button>
        </div>
      </div>
    </div>
  </div>
  <?= $this->element('payments_modal') ?>
