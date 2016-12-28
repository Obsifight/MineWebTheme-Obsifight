<?php if ($restrictAccount): ?>
  <section>
    <div class="container">
      <div class="alert alert-warning">
        <b>Votre compte est restreint</b>
        <p>
          Vous avez émis un litige PayPal contre ObsiFight, de ce fait, vous n'avez plus accès à cette partie du site pour des raisons de sécurités.
        </p>
      </div>
    </div>
  </section>
<?php else: ?>
  <style>
    .nav.nav-pills.thumbnail {
      padding: 0;
    }
    section .nav-pills>li>a:hover, section .nav-pills>li>a:focus, section .nav-pills>li.active>a, section .nav-pills>li.active>a:hover, section .nav-pills>li.active>a:focus {
      background-color: transparent!important;
    }
    .nav.nav-pills li.active {
      background: #A94545;
    }
    .nav.nav-pills li.active a h4,
    .nav.nav-pills li.active a p {
      color: #fff;
    }
    .nav.nav-pills li.checked {
      background: #f3f3f3;
    }
    .nav.nav-pills li.checked h4:after {
      content: ' \f00c';
      font-family: 'FontAwesome';
    }

    .price-table {
      border: 2px solid transparent;
      transition: border .2s, box-shadow .2s;
      border-left-width: 2px!important;
    }
    .price-table:hover {
      cursor: pointer;
      border-color: #A94545;
      -moz-box-shadow: 5px 5px 5px -5px #656565;
      -webkit-box-shadow: 5px 5px 5px -5px #656565;
      -o-box-shadow: 5px 5px 5px -5px #656565;
      box-shadow: 5px 5px 5px -5px #656565;
      transition: border .2s, box-shadow .2s;
    }

    .btn-pay {
      -webkit-transition: border .4s;
      -moz-transition: border .4s;
      -ms-transition: border .4s;
      -o-transition: border .4s;
      transition: border .4s;
      border: 2px solid #DADADA;
      border-radius: 5px;
      padding: 14px 14px;
      display: inline-block;
      background: #FCFCFC;
      color: #777;
      margin-top: 5px;
      cursor: pointer;
      width: 100%;
    }
    .btn-pay:hover,
    .btn-pay.active {
      border: 2px solid #A94545;
    }
    .btn-pay.active h5,
    .btn-pay.active p {
      color: #A94545;
    }
    .btn-pay i {
      font-size: 60px;
      color: #A94545;
    }
    .btn-pay h5 {
      font-size: 20px;
      font-weight: bold;
      font-family: 'Lato';
      color: #777;
      margin-bottom: 0;
    }
    .btn-pay span {
      font-size: 15px;
      font-weight: normal;
      color: #777;
    }
  </style>
  <section>
    <div class="container">
    	<div class="row form-group">
        <div class="col-xs-12">
          <ul class="nav nav-pills nav-justified thumbnail setup-panel">
            <li class="active"><a href="#step-1">
              <h4 class="list-group-item-heading"><?= $Lang->get('SHOPPLUS__STEP_TITLE', array('{NB}' => 1)) ?></h4>
              <p class="list-group-item-text"><?= $Lang->get('SHOPPLUS__STEP_1_TITLE') ?></p>
            </a></li>
            <li class="disabled"><a href="#step-2">
              <h4 class="list-group-item-heading"><?= $Lang->get('SHOPPLUS__STEP_TITLE', array('{NB}' => 2)) ?></h4>
              <p class="list-group-item-text"><?= $Lang->get('SHOPPLUS__STEP_2_TITLE') ?></p>
            </a></li>
            <li class="disabled"><a href="#step-3">
              <h4 class="list-group-item-heading"><?= $Lang->get('SHOPPLUS__STEP_TITLE', array('{NB}' => 3)) ?></h4>
              <p class="list-group-item-text"><?= $Lang->get('SHOPPLUS__STEP_3_TITLE', array('{MONEY_NAME}' => $Configuration->getMoneyName())) ?></p>
            </a></li>
          </ul>
        </div>
    	</div>
      <div class="row setup-content" id="step-1">
        <div class="col-xs-12">
          <div class="col-md-12 text-center">

            <div class="row pricetable-container">

              <?php if(!empty($paypalOffers)): ?>
                <div class="col-md-3 price-table" data-payment-method="paypal">
                  <h3><?= $Lang->get('SHOPPLUS__PAYMENT_METHOD_PAYPAL') ?></h3>
                  <p style="padding-top: 20px;">
                    <?= $this->Html->image('/theme/Obsifight/img/paypal-logo.png', array('style' => 'height: 100px')) ?>
                  </p>
                </div>
              <?php endif; ?>

              <?php if($dedipassStatus): ?>
                <div class="col-md-3 price-table" data-payment-method="dedipass">
                  <h3><?= $Lang->get('SHOPPLUS__PAYMENT_METHOD_DEDIPASS') ?></h3>
                  <p style="padding-top: 20px;">
                    <?= $this->Html->image('/theme/Obsifight/img/dedipass-logo.png', array('style' => 'height: 100px')) ?>
                  </p>
                </div>
              <?php endif; ?>

              <?php if(isset($paysafecardCurrency)): ?>
                <div class="col-md-3 price-table" data-payment-method="paysafecard">
                  <h3><?= $Lang->get('SHOPPLUS__PAYMENT_METHOD_PAYSAFECARD') ?></h3>
                  <p style="padding-top: 20px;">
                    <?= $this->Html->image('/theme/Obsifight/img/paysafecard-logo2.png', array('style' => 'height: 100px')) ?>
                  </p>
                </div>
              <?php endif; ?>

              <?php if($stripe): ?>
                <div class="col-md-3 price-table" data-payment-method="stripe">
                  <h3><?= $Lang->get('SHOPPLUS__PAYMENT_METHOD_STRIPE') ?></h3>
                  <p style="padding: 0px;">
                    <?= $this->Html->image('/theme/Obsifight/img/credit-card-logo.png', array('style' => 'height: 150px')) ?>
                  </p>
                </div>
              <?php endif; ?>

            </div>
          </div>
        </div>
      </div>
      <div class="row setup-content" id="step-2" style="display: none;">
        <div class="col-xs-12">
          <div class="col-md-12">

            <div class="step-2-method" data-payment-method="paypal" style="display:none;">
              <div class="row">

                <?php
                foreach ($paypalOffers as $offer) {
                  echo '<div class="col-md-3" style="padding: 5px;">';
                    echo '<a class="btn-pay" data-amount="'.$offer['Paypal']['price'].'" data-paypal-email="'.$offer['Paypal']['email'].'">';
                      echo '<i class="pull-left fa fa-eur"></i>';
                      echo '<h5>'.$offer['Paypal']['price'].' €</h5>';
                      echo '<span>Obtenez '.number_format($offer['Paypal']['money'], 0, ',', ' ').' '.$Configuration->getMoneyName().'</span>';
                    echo '</a>';
                  echo '</div>';
                }
                ?>

              </div>
              <div class="row margin-top-20">
                <div class="col-md-9">
                  <div class="alert alert-info">
                    <?= $Lang->get('SHOPPLUS__PAYPAL_INFO') ?>
                  </div>
                </div>
                <div class="col-md-3">
                  <a href="#" class="btn btn-3d btn-lg btn-reveal btn-red disabled step3" data-payment-method="paypal" style="font-size: 20px;width: 100%;">
                    <i class="fa fa-cc-paypal"></i>
                    <span><?= $Lang->get('SHOPPLUS__BTN_PAY_EMPTY') ?></span>
                  </a>
                </div>
              </div>
            </div>

            <div class="step-2-method" data-payment-method="stripe" style="display:none;">
              <div class="col-md-offset-2 col-md-8 col-sm-offset-1 col-sm-10">
                <div class="form-group">
                  <label><?= $Lang->get('SHOPPLUS__STRIPE_FORM__AMOUNT') ?></label>
                  <div class="input-group">
                    <input class="form-control input-lg" type="number" step="1.00" min="5" name="amount" value="5">
                    <div class="input-group-addon">€</div>
                  </div>
                </div>

                <div class="form-group">
                  <label><?= $Lang->get('SHOPPLUS__STRIPE_FORM__CREDITS', array('{MONEY_NAME}' => $Configuration->getMoneyName())) ?></label>
                  <div class="input-group">
                    <input class="form-control input-lg" type="number" name="credits" value="<?= (isset($stripeCreditFor1)) ? floatval($stripeCreditFor1) * 5 : '' ?>" disabled>
                    <div class="input-group-addon"><?= $Configuration->getMoneyName() ?></div>
                  </div>
                </div>

                <?= $this->Html->image('/theme/Obsifight/img/stripe-logo.png', array('height' => '40px')) ?>
                <div class="pull-right">
                  <a href="#" class="btn btn-3d btn-lg btn-reveal btn-red step3" data-payment-method="stripe" style="font-size: 20px;width: 100%;">
                    <i class="fa fa-credit-card"></i>
                    <span><?= $Lang->get('SHOPPLUS__BTN_PAY_EMPTY') ?></span>
                  </a>
                </div>
              </div>
            </div>

            <div class="step-2-method" data-payment-method="paysafecard" style="display:none;">

              <div class="col-md-offset-2 col-md-8 col-sm-offset-1 col-sm-10">
                <div class="form-group">
                  <label for="disabledTextInput"><?= $Lang->get('PAYSAFECARD__AMOUNT') ?></label>
                  <input class="form-control input-lg" type="number" step="0.1" name="amount" value="10">
                </div>

                <div class="form-group">
                  <label for="disabledTextInput"><?= $Lang->get('PAYSAFECARD__CURRENCY') ?></label>
                  <input class="form-control input-lg" type="text" name="currency" value="<?= $paysafecardCurrency ?>" disabled>
                </div>

                <?= $this->Html->image('Paysafecard.logo_paysafecard.png', array('height' => '40px')) ?>
                <div class="pull-right">
                  <a href="#" class="btn btn-3d btn-lg btn-reveal btn-red step3" data-payment-method="paysafecard" style="font-size: 20px;width: 100%;">
                    <i class="fa fa-eur"></i>
                    <span><?= $Lang->get('SHOPPLUS__BTN_PAY_EMPTY') ?></span>
                  </a>
                </div>
              </div>

            </div>

          </div>
        </div>
      </div>
      <div class="row setup-content" id="step-3" style="display: none;">
        <div class="col-xs-12">
          <div class="col-md-12">

            <div class="step-3-method" data-payment-method="paypal" style="display:none;">

              <h3>
                <?= $Lang->get('SHOPPLUS__PAYPAL_TERMS_TITLE') ?>
                <br><small class="text-muted"><em><?= $Lang->get('SHOPPLUS__PAYPAL_TERMS_SUBTITLE') ?></em></small>
              </h3>

              <label class="checkbox nomargin" style="padding-top:0;">
                <input class="checked-agree" type="checkbox" name="paypal_term_1"><i></i>
                <?= $Lang->get('SHOPPLUS__PAYPAL_TERM_1') ?>
              </label>

              <label class="checkbox nomargin" style="padding-top:0;">
                <input class="checked-agree" type="checkbox" name="paypal_term_2"><i></i>
                <?= $Lang->get('SHOPPLUS__PAYPAL_TERM_2') ?>
              </label>

              <label class="checkbox nomargin" style="padding-top:0;">
                <input class="checked-agree" type="checkbox" name="paypal_term_3"><i></i>
                <?= $Lang->get('SHOPPLUS__PAYPAL_TERM_3', array('{MONEY_NAME}' => $Configuration->getMoneyName(), '{WEBSITE_NAME}' => $Configuration->getKey('name'))) ?>
              </label>

              <div class="alert alert-info margin-top-10">
                <?= $Lang->get('SHOPPLUS__PAYPAL_TERMS_INFO') ?>
              </div>

              <div class="text-center">
                <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
                  <input name="currency_code" type="hidden" value="EUR" />
                  <input name="shipping" type="hidden" value="0.00" />
                  <input name="tax" type="hidden" value="0.00" />
                  <input name="return" type="hidden" value="<?= $this->Html->url(array('controller' => 'shop', 'action' => 'index', 'return'), true) ?>" />
                  <input name="cancel_return" type="hidden" value="<?= $this->Html->url(array('controller' => 'shop', 'action' => 'index', 'error'), true) ?>" />
                  <input name="notify_url" type="hidden" value="<?= $this->Html->url(array('controller' => 'payment', 'action' => 'ipn'), true) ?>" />
                  <input name="cmd" type="hidden" value="_xclick" />
                  <input name="business" type="hidden" value="" />
                  <input name="amount" type="hidden" value="" />
                  <input name="item_name" type="hidden" value="Des <?= $Configuration->getMoneyName() ?> sur <?= $Configuration->getKey('name') ?>" />
                  <input name="no_note" type="hidden" value="1" />
                  <input name="lc" type="hidden" value="FR" />
                  <input name="custom" type="hidden" value="<?= $user['id'] ?>">
                  <input name="bn" type="hidden" value="PP-BuyNowBF" />
                  <input type="hidden" name="cbt" value="<?= $Lang->get('SHOP__PAYPAL_RETURN_MSG', array('{WEBSITE_NAME}' => $Configuration->getKey('name'))) ?>">
                  <input type="hidden" name="charset" value="UTF-8">
                  <button type="submit" class="btn btn-3d btn-lg btn-reveal btn-red disabled pay" data-payment-method="paypal" style="font-size: 25px;">
                    <i class="fa fa-cc-paypal"></i>
                    <span><?= $Lang->get('SHOPPLUS__BTN_PAY_EMPTY') ?></span>
                  </button>
                </form>
              </div>

            </div>

            <div class="step-3-method" data-payment-method="dedipass" style="display:none;">
              <div data-dedipass="<?= isset($dedipassPublicKey) ? $dedipassPublicKey : '' ?>">
                <div class="alert alert-info"><?= $Lang->get('GLOBAL__LOADING') ?>...</div>
              </div>
              <script src="//api.dedipass.com/v1/pay.js"></script>
            </div>

            <div class="step-3-method text-center" data-payment-method="paysafecard" style="display:none;">
              <div class="alert alert-info">
                <?= $Lang->get('SHOPPLUS__PAYSAFECARD_INFO', array('{MONEY_NAME}' => $Configuration->getMoneyName())) ?>
              </div>
              <form method="POST" action="/shop/paysafecard/pay/">
                <input type="hidden" name="amount" value="10">
                <input type="hidden" name="currency" value="<?= $paysafecardCurrency ?>">
                <input type="hidden" name="customer_id" class="form-control" value="<?= $user['id'] ?>">
                <input type="hidden" name="data[_Token][key]" value="<?= $csrfToken ?>">
                <button type="submit" class="btn btn-3d btn-lg btn-reveal btn-red pay" data-payment-method="paysafecard" style="font-size: 25px;">
                  <i class="fa fa-eur"></i>
                  <span><?= $Lang->get('SHOPPLUS__BTN_PAY_EMPTY') ?></span>
                </button>
              </form>
            </div>

            <div class="step-3-method" data-payment-method="stripe" style="display:none;">
              <div class="success-message"></div>
              <div id="stripe-hide-after-success">
                <div class="alert alert-info">
                  <?= $Lang->get('SHOPPLUS_STRIPE_INFO_BEFORE_BUY', array('{MONEY_NAME}' => $Configuration->getMoneyName())) ?>
                </div>

                <div class="row text-center">
                  <div class="col-md-offset-2 col-md-4">
                    <div class="card-wrapper"></div>
                    <span style="color:#2C9600;margin-top:10px;display:block;" data-toggle="tooltip" data-placement="top" title="<?= $Lang->get('SHOPPLUS_STRIPE_INFO_SECURITY_PLUS_BEFORE_BUY') ?>">
                      <i class="fa fa-lock"></i>&nbsp;
                      <?= $Lang->get('SHOPPLUS_STRIPE_INFO_SECURITY_BEFORE_BUY') ?>
                    </span>
                  </div>
                  <form class="stripe">
                    <div class="col-md-4">
                      <div class="panel panel-default">
                        <div class="panel-body">
                          <div class="error-message"></div>
                          <div class="row">
                            <div class="col-xs-7 col-md-7">
                              <div class="form-group">
                                <label for="cardNumber"><?= $Lang->get('SHOPPLUS__STRIPE_FORM_NUMBER') ?></label>
                                <input type="text" class="form-control" name="number" placeholder="<?= $Lang->get('SHOPPLUS__STRIPE_FORM_NUMBER') ?>" required autofocus>
                              </div>
                            </div>
                            <div class="col-xs-5 col-md-5 pull-right">
                              <div class="form-group">
                                <label for="cardNumber"><?= $Lang->get('SHOPPLUS__STRIPE_FORM_NAME') ?></label>
                                <input type="text" class="form-control" name="name" placeholder="<?= $Lang->get('SHOPPLUS__STRIPE_FORM_NAME') ?>" required>
                              </div>
                            </div>
                          </div>
                          <div class="row" style="margin-bottom:0px;">
                            <div class="col-xs-7 col-md-7">
                              <div class="form-group">
                                <label for="expityMonth"><?= $Lang->get('SHOPPLUS__STRIPE_FORM_EXPIRY') ?></label>
                                <input type="text" class="form-control" name="expiry" placeholder="MM/YY" required>
                              </div>
                            </div>
                            <div class="col-xs-5 col-md-5 pull-right">
                              <div class="form-group">
                                <label for="cvCode"><?= $Lang->get('SHOPPLUS__STRIPE_FORM_CVC') ?></label>
                                <input type="text" class="form-control" name="cvc" placeholder="<?= $Lang->get('SHOPPLUS__STRIPE_FORM_CVC') ?>" required>
                              </div>
                            </div>
                          </div>
                          <small><em class="text-muted"><?= $Lang->get('SHOPPLUS_STRIPE_INFO_BEFORE_BUY_STORE') ?></em></small>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 text-center">
                      <button type="submit" class="btn btn-3d btn-lg btn-reveal btn-red disabled pay" data-payment-method="stripe" style="font-size: 25px;">
                        <i class="fa fa-credit-card"></i>
                        <span><?= $Lang->get('SHOPPLUS__BTN_PAY_EMPTY') ?></span>
                      </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </section>
  <?= $this->Html->script('jquery.card') ?>
  <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
  <script type="text/javascript">
  $(document).ready(function() {
    // =====
    // INIT : VARS
    // =====
    var paymentMethod = ''
    var amount = 0.0
    var infos = {}

    // =====
    // STEP 1 : CHOOSE PAYMENTS METHOD
    // =====
    $('.price-table').on('click', function (e) {
      var method = $(this)
      paymentMethod = method.attr('data-payment-method')

      // hide step
      $('#step-1').fadeOut(150, function () {
        $('a[href="#step-1"]').parent().removeClass('active').addClass('checked')
        // display step 2
        if (paymentMethod != 'dedipass') {
          $('.step-2-method[data-payment-method="' + paymentMethod + '"]').fadeIn(150)
          $('#step-2').fadeIn(150)
          $('a[href="#step-2"]').parent().addClass('active').removeClass('disabled')
        } else {
          // set step 2 as completed
          $('a[href="#step-2"]').parent().removeClass('active').addClass('checked')
          // display step 3
          $('.step-3-method[data-payment-method="' + paymentMethod + '"]').fadeIn(150)
          $('#step-3').fadeIn(150)
          $('a[href="#step-3"]').parent().addClass('active').removeClass('disabled')
        }
      })
    })

    // =====
    // STEP 2 : CHOOSE PAYMENTS AMOUNT
    // =====

    // PAYPAL
    $('.step-2-method[data-payment-method="paypal"] .btn-pay').on('click', function (e) {
      var btn = $(this)
      amount = parseFloat(btn.attr('data-amount'))
      infos.paypalEmail = btn.attr('data-paypal-email')

      // edit classess
      $('.step-2-method[data-payment-method="paypal"] .btn-pay').removeClass('active')
      btn.addClass('active')

      // edit btn
      $('.step3[data-payment-method="paypal"]').removeClass('disabled')
      $('.step3[data-payment-method="paypal"] span').html('<?= $Lang->get('SHOPPLUS__BTN_PAY') ?>'.replace('{AMOUNT}', amount))
    })
    // stripe
    $('.step-2-method[data-payment-method="stripe"] input[name="amount"]').on('change', function (e) {
      var input = $(this)
      amount = parseFloat(input.val())
      var credits = Math.round(amount * parseFloat('<?= (isset($stripeCreditFor1)) ? $stripeCreditFor1 : '' ?>'))

      // edit credits
      $('.step-2-method[data-payment-method="stripe"] input[name="credits"]').val(credits)

      // edit btn
      $('.step3[data-payment-method="stripe"] span').html('<?= $Lang->get('SHOPPLUS__BTN_PAY') ?>'.replace('{AMOUNT}', amount))
    })
    // global
    $('.step3').on('click', function (e) {
      e.preventDefault()
      var btn = $(this)

      // hide step
      $('#step-2').fadeOut(150, function () {
        $('a[href="#step-2"]').parent().removeClass('active').addClass('checked')
        // display step 2
        if (paymentMethod == 'paypal') {
          $('.step-3-method[data-payment-method="paypal"] form input[name="amount"]').val(amount)
          $('.step-3-method[data-payment-method="paypal"] form input[name="business"]').val(infos.paypalEmail)
        }
        if (paymentMethod == 'paysafecard') {
          amount = parseFloat($('.step-2-method[data-payment-method="paysafecard"] .form-group input[name="amount"]').val())
          infos.currency = $('.step-2-method[data-payment-method="paysafecard"] .form-group input[name="currency"]').val()
          $('.step-3-method[data-payment-method="paysafecard"] form input[name="amount"]').val(amount)
          $('.step-3-method[data-payment-method="paysafecard"] form input[name="currency"]').val(infos.currency)
          // info
          var alertDiv = $('.step-3-method[data-payment-method="paysafecard"] .alert.alert-info')
          var alertContent = alertDiv.html()
          var credits = Math.round(amount * parseFloat('<?= (isset($paysafecardCreditFor1)) ? $paysafecardCreditFor1 : '' ?>'))
          alertDiv.html(alertContent.replace('{AMOUNT}', amount).replace('{CREDITS}', credits))
        }
        if (paymentMethod == 'stripe') {
          // amount
          amount = parseFloat($('.step-2-method[data-payment-method="stripe"] input[name="amount"]').val())
          infos.credits = parseFloat($('.step-2-method[data-payment-method="stripe"] input[name="credits"]').val())
          // form
          $('form.stripe').card({
            container: '.card-wrapper',
          });
          $('[data-toggle="tooltip"]').tooltip()
          // stripe
          Stripe.setPublishableKey('<?= (isset($stripePublishableKey)) ? $stripePublishableKey : '' ?>');
          // info
          var alertDiv = $('.step-3-method[data-payment-method="stripe"] .alert.alert-info')
          var alertContent = alertDiv.html()
          alertDiv.html(alertContent.replace('{AMOUNT}', amount).replace('{CREDITS}', infos.credits))
        }
        $('.step-3-method[data-payment-method="' + paymentMethod + '"]').fadeIn(150)
        $('#step-3').fadeIn(150)
        $('a[href="#step-3"]').parent().addClass('active').removeClass('disabled')
      })
    })

    // =====
    // STEP 3 : PAY
    // =====

    // paypal terms
    $('input[name^="paypal_term_"]').on('change', function () {
      if ($('input[name="paypal_term_1"]:checked').length === 1 && $('input[name="paypal_term_2"]:checked').length === 1 && $('input[name="paypal_term_3"]:checked').length === 1)
        $('.pay[data-payment-method="paypal"]').removeClass('disabled')
      else
        $('.pay[data-payment-method="paypal"]').addClass('disabled')
    })

    // stripe form inputs
    $('form.stripe input').on('keyup', function () {
      if ($('input[name="number"]').val().length >= 18 && $('input[name="name"]').val().length >= 3 && $('input[name="expiry"]').val().length === 9 && $('input[name="cvc"]').val().length >= 3) {
        var expiry = $('input[name="expiry"]').val().split(' / ')
        var expiryMonth = expiry[0]
        var expiryYear = expiry[1]
        if (
          expiryYear < ((new Date()).getFullYear() + 10) && // 10years max
          (
            (expiryYear == (new Date()).getFullYear() && expiryMonth > ((new Date()).getMonth())) // expire this year but in next months
            ||
            (expiryYear > (new Date()).getFullYear()) // expire in future
          )
        )
          $('.pay[data-payment-method="stripe"]').removeClass('disabled')
        else
          $('.pay[data-payment-method="stripe"]').addClass('disabled')
      } else {
        $('.pay[data-payment-method="stripe"]').addClass('disabled')
      }
    })

    $('form.stripe').on('submit', function (e) {
      e.preventDefault()
      var form = $(this)
      var btn = form.find('[type="submit"]')
      var btnContent = btn.html()

      btn.addClass('disabled')
      btn.html('<?= $Lang->get('SHOPPLUS__BTN_PAY_LOADING') ?>').removeClass('btn-reveal')

      Stripe.card.createToken({
        name: form.find('input[name="name"]').val(),
        number: form.find('input[name="number"]').val().replace(/ /g,''),
        cvc: form.find('input[name="cvc"]').val(),
        exp_month: form.find('input[name="expiry"]').val().split(' / ')[0],
        exp_year: form.find('input[name="expiry"]').val().split(' / ')[1],
      }, function (status, response) {
        if (response.error) {
          form.find('.error-message').hide().html('<div class="alert alert-danger"><b><?= $Lang->get('GLOBAL__ERROR') ?> : </b>' + response.error.message + '</div>').fadeIn(150)
          btn.removeClass('disabled').html(btnContent).addClass('btn-reveal')
        } else {
          // post to check it
          $.post('<?= $this->Html->url(array('controller' => 'stripe', 'action' => 'charge', 'plugin' => 'ShopPlus')) ?>', {
            token: response.id,
            amount: amount,
            'data[_Token][key]': '<?= $csrfToken ?>'
          }, function (data) {
            if (data.status) {
              $('a[href="#step-3"]').parent().removeClass('active').addClass('checked')
              $('#stripe-hide-after-success').slideUp(150)
              $('.step-3-method[data-payment-method="stripe"] .success-message').hide().html('<div class="alert alert-success"><b><?= $Lang->get('GLOBAL__SUCCESS') ?> : </b><b>' + data.msg + '</b></div>').slideDown(150)
            } else {
              form.find('.error-message').hide().html('<div class="alert alert-danger"><b><?= $Lang->get('GLOBAL__ERROR') ?> : </b><b>' + data.msg + '</b></div>').fadeIn(150)
              btn.removeClass('disabled').html(btnContent).addClass('btn-reveal')
            }
          }).error(function () {
            form.find('.error-message').hide().html('<div class="alert alert-danger"><b><?= $Lang->get('GLOBAL__ERROR') ?> : </b><b><?= $Lang->get('ERROR__INTERNAL_ERROR') ?></b></div>').fadeIn(150)
            btn.removeClass('disabled').html(btnContent).addClass('btn-reveal')
          })
        }
      })
    })

  })
  </script>
<?php endif; ?>
