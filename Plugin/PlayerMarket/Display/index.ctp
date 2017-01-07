<section>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="alert alert-info">
          <b>Informations : </b>Les articles affichés ici sont mis en vente depuis le jeu. Vous pouvez acheter des items aux autres joueurs depuis cette interface.
        </div>
        <?php foreach ($sales as $sale) { ?>

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
                    echo '<li>';
                      echo $item['custom_name'];
                    echo '</li>';
                  }
                  ?>
                </ul>
              </div>
              <hr>
              <?php if (/*$sale['price_money'] > 0*/false): ?>
                <a href="#" class="btn btn-3d btn-reveal btn-red buy-with-money" data-toggle="tooltip" data-placement="top" title="Acheter en dollars (monnaie du jeu)">
                  <i class="fa fa-dollar"></i>
                  <span><?= $sale['price_money'] ?>$</span>
                </a>
                &nbsp;
              <?php endif; ?>
              <?php if ($sale['price_point'] > 0): ?>
                <a href="#" class="btn btn-3d btn-reveal btn-red buy-with-points" data-selling-id="<?= $sale['id_selling'] ?>" data-price="<?= $sale['price_point'] ?>" data-toggle="tooltip" data-placement="top" title="Acheter en points boutique">
                  <i class="fa fa-shopping-cart"></i>
                  <span><?= $sale['price_point'] ?> <?= $Configuration->getMoneyName() ?></span>
                </a>
              <?php endif; ?>
            </div>
          </div>

        <?php } ?>

      </div>
    </div>
  </div>
</section>
<script type="text/javascript">
$(function () {
  $('[data-toggle="tooltip"]').tooltip()

  $('.buy-with-points').on('click', function (e) {
    e.preventDefault()
    var btn = $(this)
    var price = parseFloat(btn.attr('data-price'))
    var id = parseInt(btn.attr('data-selling-id'))

    $('#confirmBuy #confirmBtn').removeClass('disabled').attr('disabled', false)
    if (price <= '<?= $user['money'] ?>') {
      $('#confirmBuy #confirmBtn').attr('data-selling-id', id)
      $('#confirmBuy .cant').hide()
      $('#confirmBuy .can').show()
    } else {
      $('#confirmBuy #confirmBtn').addClass('disabled').attr('disabled', true)
      $('#confirmBuy .can').hide()
      $('#confirmBuy .cant').show()
    }
    $('#confirmBuy #confirmBtn span').html(price + ' <?= $Configuration->getMoneyName() ?>')
    $('#confirmBuy').modal('show')
  })
  $('#confirmBuy #confirmBtn').on('click', function (e) {
    e.preventDefault();
    var btn = $(this)
    var id = parseInt(btn.attr('data-selling-id'))
    $('#confirmBuy').modal('hide')

    // request to server
    $.get('<?= $this->Html->url(array('controller' => 'purchase', 'action' => 'buyWithPoints', 'plugin' => 'PlayerMarket', 'id' => '{ID}')) ?>'.replace('{ID}', id), function (data) {
      if (data.status) {
        // success
        $('.sale[data-selling-id="' + id + '"]').fadeOut(150)
        toastr.success('Vous avez bien acheté ces articles !')
      } else {
        toastr.error(data.msg)
      }
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
