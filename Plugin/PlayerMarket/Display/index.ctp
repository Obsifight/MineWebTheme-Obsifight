<section>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="alert alert-info">
          <b>Informations : </b>Les articles affichés ici sont mis en vente depuis le jeu. Vous pouvez acheter des items aux autres joueurs depuis cette interface.
        </div>
        <div class="row">
          <?php
          $i = 0;
          foreach ($sales as $sale) {
            $i++;
          ?>

            <div class="col-md-3 col-sm-3 sale" data-selling-id="<?= $sale['id_selling'] ?>">
              <div class="price-clean">
                <h4>
                  <?= $this->Html->image($sale['icon_texture_path'], array('class' => 'img-rounded', 'style' => 'width: 100px;margin-bottom: 10px;')) ?>
                </h4>
                <h5><small>Par</small> <?= $sale['seller'] ?> </h5>
                <hr>
                <div style="text-align: left;">
                  <p><b>Contient :</b></p>
                  <ul>
                    <?php
                    foreach ($sale['items'] as $item) {
                      echo '<li data-toggle="tooltip" data-placement="top" title="'.$item['durability'].'% de durabilité">';
                        echo $item['name'];
                        if (!empty($item['enchantments'])) {
                          echo '&nbsp;(<em>'.implode(', ', array_map(function ($enchant) {
                            return implode(' ', $enchant);
                          }, $item['enchantments'])).'</em>)';
                        }
                      echo '</li>';
                    }
                    ?>
                  </ul>
                </div>
                <hr>
                <?php if ($sale['price_money'] > 0 && $isConnected && strtolower(trim($sale['seller'])) != strtolower(trim($user['pseudo']))): ?>
                  <a href="#" class="btn btn-3d btn-reveal btn-red buy" data-pay-mode="money" data-selling-id="<?= $sale['id_selling'] ?>" data-price="<?= $sale['price_money'] ?>" data-toggle="tooltip" data-placement="top" title="Acheter en dollars (monnaie du jeu)">
                    <i class="fa fa-dollar"></i>
                    <span><?= $sale['price_money'] ?>$</span>
                  </a>
                  &nbsp;
                <?php endif; ?>
                <?php if ($sale['price_point'] > 0 && $isConnected && strtolower(trim($sale['seller'])) != strtolower(trim($user['pseudo']))): ?>
                  <a href="#" class="btn btn-3d btn-reveal btn-red buy" data-pay-mode="point" data-selling-id="<?= $sale['id_selling'] ?>" data-price="<?= $sale['price_point'] ?>" data-toggle="tooltip" data-placement="top" title="Acheter en points boutique">
                    <i class="fa fa-shopping-cart"></i>
                    <span><?= $sale['price_point'] ?> <?= $Configuration->getMoneyName() ?></span>
                  </a>
                <?php endif; ?>
              </div>
            </div>
            <?= ($i % 4 == 0) ? '</div><div class="row" style="margin-top: 10px;">' : ''; ?>
          <?php } ?>
        </div>

      </div>
    </div>
  </div>
</section>
<script type="text/javascript">
$(function () {
  $('[data-toggle="tooltip"]').tooltip()

  $('.buy[data-pay-mode]').on('click', function (e) {
    e.preventDefault()
    var btn = $(this)
    var price = parseFloat(btn.attr('data-price'))
    var id = parseInt(btn.attr('data-selling-id'))
    var payMode = btn.attr('data-pay-mode')

    $('#confirmBuy #confirmBtn').removeClass('disabled').attr('disabled', false)
    if (payMode == 'point') {
      if (price <= '<?= ($user) ? $user['money'] : 0 ?>') {
        $('#confirmBuy #confirmBtn').attr('data-selling-id', id).attr('data-pay-mode', payMode)
        $('#confirmBuy .cant').hide()
        $('#confirmBuy .can').show()
      } else {
        $('#confirmBuy #confirmBtn').addClass('disabled').attr('disabled', true)
        $('#confirmBuy .can').hide()
        $('#confirmBuy .cant').show()
      }
      $('#confirmBuy #confirmBtn span').html(price + ' <?= $Configuration->getMoneyName() ?>')
    } else {
      $.get('<?= $this->Html->url('/market/user/money') ?>', function (data) {
        if (!data.status || data.money >= price) {
          $('#confirmBuy #confirmBtn').attr('data-selling-id', id).attr('data-pay-mode', payMode)
          $('#confirmBuy .cant').hide()
          $('#confirmBuy .can').show()
        } else {
          $('#confirmBuy #confirmBtn').addClass('disabled').attr('disabled', true)
          $('#confirmBuy .can').hide()
          $('#confirmBuy .cant').show()
        }
        $('#confirmBuy #confirmBtn span').html(price + '$')
      })
    }
    $('#confirmBuy').modal('show')
  })
  $('#confirmBuy #confirmBtn').on('click', function (e) {
    e.preventDefault();
    var btn = $(this)
    var id = parseInt(btn.attr('data-selling-id'))
    var payMode = btn.attr('data-pay-mode')
    $('#confirmBuy').modal('hide')

    if (payMode == 'point')
      var url = '<?= $this->Html->url(array('controller' => 'purchase', 'action' => 'buyWithPoints', 'plugin' => 'PlayerMarket', 'id' => '{ID}')) ?>'
    else
      var url = '<?= $this->Html->url(array('controller' => 'purchase', 'action' => 'buyWithMoney', 'plugin' => 'PlayerMarket', 'id' => '{ID}')) ?>'

    // request to server
    $.get(url.replace('{ID}', id), function (data) {
      if (data.status) {
        // success
        $('.sale[data-selling-id="' + id + '"]').fadeOut(150)
        toastr.success('Vous avez bien acheté ces articles !')
      } else {
        toastr.error(data.msg)
      }
    }).error(function () {
      toastr.error("L'article demandé est introuvable.")
    })
  })
})
</script>
<div class="modal fade" tabindex="-1" id="confirmBuy" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Confirmer l'achat</h4>
      </div>
      <div class="modal-body">
        <div class="can">
          <em>Voulez-vous vraiment acheter ces articles ?</em>
        </div>
        <div class="cant">
          <div class="alert alert-danger">
            <b>Erreur : </b>
            Vous n'avez pas assez de solde pour pouvoir acheter ces articles.
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
        <button type="button" class="btn btn-success" id="confirmBtn">Acheter et payer <span></span></button>
      </div>
    </div>
  </div>
</div>
