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
            <a href="<?= $this->Html->url('/shop/credits/add') ?>" class="btn btn-success btn-3d btn-block"><?= $Lang->get('SHOP__ADD_MONEY') ?></a>
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

		<?php
		$flash_messages = $this->Session->flash();
		if(!empty($flash_messages)) { ?>
			<div class="container" style="margin-top:-50px;">
				<?= $flash_messages ?>
			</div>
		<?php } ?>

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

            echo '<div data-category-id="'.$category_id.'" class="category"';
            echo ($i == 0) ? ' style="display:block"' : ' style="display:none"';
            echo '>';

            $category_rank_id = 1;
						$category_item_id = 5;
						$category_options_id = 17;
            $cond_ranks = ($category_id == $category_rank_id);
            $ranks = array();

						if($category_id == $category_options_id) {
							echo '<ul class="list-group">';
						}

            foreach ($search_items as $k => $v) {

              if($v['Item']['category'] == $category_id) {

                if($cond_ranks) {

                  $ranks[$v['Item']['id']]['id'] = $v['Item']['id'];
                  $ranks[$v['Item']['id']]['name'] = $v['Item']['name'];
                  $ranks[$v['Item']['id']]['price'] = $v['Item']['price'];
                  $ranks[$v['Item']['id']]['img'] = (isset($v['Item']['img_url'])) ? $v['Item']['img_url'] : false;

                } else {

									if($v['Item']['category'] == $category_item_id) {

										echo '<div class="col-md-12">';
											echo '<div class="thumbnail" style="position:relative;">';
												echo '<img style="margin-bottom:0;" src="';
													echo (empty($v['Item']['img_url'])) ? 'http://placeholdit.imgix.net/~text?txtsize=14&txt=646x200&w=646&h=200' : $v['Item']['img_url'];
												echo '" class="pull-right">';
												echo '<div class="caption" style="position:absolute;bottom:5px;right:5px;">';
													echo '<div class="btn-group" role="group">';
														echo '<button data-item-id="'.$v['Item']['id'].'" class="btn btn-primary btn-3d display-item">Acheter</button>';
														echo '<button class="btn btn-default disabled" disabled>'.$v['Item']['price'].' '.$Configuration->getMoneyName().'</button>';
													echo '</div>';
													echo '<div class="clearfix"></div>';
												echo '</div>';
												echo '<div class="clearfix"></div>';
											echo '</div>';
										echo '</div>';

									} else if($v['Item']['category'] == $category_options_id) {

										echo '<li class="list-group-item">';
											echo '<h4 class="list-group-item-heading">';
												echo $v['Item']['name'];
												echo '<span class="pull-right">';
													echo '<button class="btn btn-primary btn-3d display-item" style="margin-top:-5px;" data-item-id="'.$v['Item']['id'].'">Acheter</button>';
												echo '</span>';
											echo '</h4>';
										echo '</li>';

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
            }

						if($category_id == $category_options_id) {
							echo '</ul>';
						}

            if($cond_ranks) { // On affiche le truc perso

							$ranks_desc = Configure::read('Obsi.shop.ranks.desc');



							echo '<div class="row mega-price-table">';

								$i_item = 0;
								foreach ($ranks as $id => $data) {

                  echo '<div class="col-md-3 col-sm-6 block">';
										echo '<div class="pricing">';

											echo '<div class="pricing-head">';
												echo '<h3>'.$data['name'].'</h3>';
												echo '<small>1 mois</small>';
											echo '</div>';

											echo '<h4>';
												echo $data['price'].'<sup>'.$Configuration->getMoneyName().'</sup>';
											echo '</h4>';

										echo '</div>';

										echo '<ul class="pricing-table list-unstyled">';

											foreach ($ranks_desc as $carac => $spec) {

												echo '<li>';

													$bool = $spec[$i_item];
													if(is_bool($bool)) {
														if($bool) {
															echo '<span class="item-have"></span>';
														} else {
															echo '<span class="item-no-have"></span>';
														}
													} else {
														echo '<div class="text-center">'.$bool.'</div>';
													}

													echo '<span>'.$carac.'</span>';

												echo '</li>';

											}

										echo '</ul>';

										echo '<a href="#" class="btn btn-primary fullwidth display-item" data-item-id="'.$id.'">Acheter</a>';

									echo '</div>';

								$i_item++;

								}

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

			<style media="screen">
				span.item-have {
					background: transparent url('/theme/obsifight/img/item-have.png') no-repeat;
					-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
					filter: alpha(opacity=100);
					-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
					filter: alpha(opacity=100);
					opacity: 1;
					width: 18px;
					height: 18px;
					display: block;
					margin-right:auto;
					margin-left: auto;
				}

				span.item-no-have {
					background: transparent url('/theme/obsifight/img/item-no-have.png') no-repeat;
					-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=20)";
					filter: alpha(opacity=20);
					-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=20)";
					filter: alpha(opacity=20);
					opacity: 0.2;
					width: 18px;
					height: 18px;
					display: block;
					margin-right:auto;
					margin-left: auto;
				}
			</style>


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
