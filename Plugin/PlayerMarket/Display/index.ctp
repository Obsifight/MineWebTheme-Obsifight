<section>
  <div class="container">
    <div class="row">
      <?php if ($state): ?>
        <?php if (isset($canViewMarket) && !$canViewMarket): ?>
          <div class="alert alert-danger">
            <h4 style="margin-bottom:5px;">Erreur</h4> Vous ne pouvez pas accéder à la boutique sans être connecté sur le site et vous être connecté au moins une fois en jeu.
          </div>
          <br><br><br><br><br><br><br><br><br>
        <?php else: ?>
          <div class="col-md-<?= $isConnected && $mySales ? '10' : '12' ?>">
            <div class="alert alert-info">
              <b>Informations : </b>Les articles affichés ici sont mis en vente depuis le jeu. Vous pouvez acheter des items aux autres joueurs depuis cette interface.
            </div>
          </div>
          <div class="col-md-2"<?= $isConnected && $mySales ? '' : ' style="display: none;"' ?>>
            <a href="#mySales" data-toggle="modal" class="btn btn-info btn-lg btn-block">Mes ventes</a>
          </div>
          <div class="col-md-12">

            <table class="table dataTable">
              <thead>
                <th>Icône</th>
                <th>Vendeur</th>
                <th>Nombre d'articles</th>
                <th>Fin de l'achat</th>
                <th></th>
              </thead>
              <tbody>
                <?php
                  foreach ($sales as $sale) {
                    echo '<tr class="sale" data-selling-id=' . $sale['id_selling'] . ' data-items-list=\'' . json_encode($sale['items']) . '\'>';
                      echo '<td>' . $this->Html->image($sale['icon_texture_path'], array('class' => 'img-rounded', 'width' => '32', 'onerror' => '$(this).parent().html(\'<div style="width:32px;text-align: center;"><i class="fa fa-question fa-2x"></i></div>\')')) . '</td>';
                      echo '<td><span class="uuid" data-uuid="' . $sale['seller'] . '"></span>';
                      echo '<td>' . count($sale['items']) . ' article(s)</td>';
                      echo '<td class="moment-to" style="font-weight: bold;">';
                        echo date('Y-m-d H:i:s', strtotime('+72 hours', strtotime($sale['start_of_sale'])));
                      echo '</td>';
                      echo '<td>';
                        echo '<a href="#" class="btn btn-3d btn-reveal btn-red view" data-selling-id="' . $sale['id_selling'] . '" data-price-money="' . $sale['price_money'] . '" data-price-point="' . $sale['price_point'] . '">';
                          echo '<i class="fa fa-eye"></i>';
                          echo '<span>Voir la vente</span>';
                        echo '</a>';
                      echo '</td>';
                    echo '</tr>';
                  }
                ?>
              </tbody>
            </table>

          </div>
        <?php endif; ?>
      <?php else: ?>
        <div class="col-md-12">
          <div class="alert alert-danger">
            Le WebMarket est temporairement désactivé.
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/locale/fr.js"></script>
<script type="text/javascript">
  var date = moment()
  var currentTime = Date.now()
  date.locale('fr')
  $('.moment-to').each(function () {
    var element = $(this)
    var eventTime = (new Date(element.html())).getTime()
    var calcul = function () {
      currentTime = Date.now()
      var diffTime = eventTime - currentTime
      var duration = moment.duration(diffTime, 'milliseconds')
      element.html(
        duration.days() +
        ' jours ' +
        (duration.hours().toString().length === 1 ? '0' : '') + duration.hours() +
        ' heures ' +
        (duration.minutes().toString().length === 1 ? '0' : '') + duration.minutes() +
        ' minutes ' +
        (duration.seconds().toString().length === 1 ? '0' : '') + duration.seconds() +
        ' secondes'
      )
    }
    calcul()

    setInterval(calcul, 1000) // each seconds
  })
</script>
<script type="text/javascript">
function uuid() {
  console.log('Update uuid')
  var uuidToFind = []
  $('.uuid:not(.uuid-setted)').each(function (span) {
    uuidToFind.push($(this).attr('data-uuid'))
  }).promise().done(function () {
    $.post('<?= $this->Html->url('/market/uuids') ?>', {uuids: uuidToFind, 'data[_Token][key]': '<?= $csrfToken ?>'}, function (data) {
      if (!data.status) return

      for (var uuid in data.body.users) {
        if (data.body.users.hasOwnProperty(uuid)) {
          $('.uuid[data-uuid="' + uuid + '"]').addClass('uuid-setted').html('<img class="img-rounded" src="https://skins.obsifight.net/head/' + data.body.users[uuid] + '/32">&nbsp;&nbsp;' + data.body.users[uuid])
          $('.uuid[data-uuid="' + uuid + '"]').parent().parent().attr('data-seller-username', data.body.users[uuid])
        }
      }
    })
  })
}
uuid()

$(function () {
  $('[data-toggle="tooltip"]').tooltip({html: true})

  $('.view').on('click', function (e) {
    // vars
    e.preventDefault()
    var btn = $(this)
    var id = parseInt(btn.attr('data-selling-id'))
    var priceMoney = parseFloat(btn.attr('data-price-money'))
    var pricePoint = parseFloat(btn.attr('data-price-point'))
    var saleDiv = $('.sale[data-selling-id="' + id + '"]')
    var itemsList = JSON.parse(saleDiv.attr('data-items-list'))
    var seller = saleDiv.attr('data-seller-username')

    // btns
    $('#confirmBuy #confirmBtn').removeClass('disabled').attr('disabled', false)
    if (priceMoney <= '<?= ($user) ? $user['money'] : 0 ?>')
      $('#confirmBuy .buy[data-pay-mode="point"]').attr('data-selling-id', id)
    else
      $('#confirmBuy .buy[data-pay-mode="point"]').addClass('disabled').attr('disabled', true)
    $.get('<?= $this->Html->url('/market/user/money') ?>', function (data) {
      if ((!data.status || data.money >= priceMoney) && <?= ($user) ? 'true' : 'false' ?>)
        $('#confirmBuy .buy[data-pay-mode="money"]').attr('data-selling-id', id)
      else
        $('#confirmBuy .buy[data-pay-mode="money"]').addClass('disabled').attr('disabled', true)
      next()
    })

    //
    function next() {
      // items list
      $('#confirmBuy .items-list').html('<table class="table"><tbody></tbody></table>')
      var content = ''
      for (var i = 0; i < itemsList.length; i++) {
        content = '<tr>'
          content += '<td>'
            if (itemsList[i].img_path)
              content += '<img src="' + itemsList[i].img_path + '" width="32">&nbsp;&nbsp;'
            else
              content += '<div style="width:32px;display: inline-block;text-align: center;"><i class="fa fa-question fa-2x"></i></div>&nbsp;&nbsp;'
            content += itemsList[i].name_parsed
            if (itemsList[i].durability > 0) {
              if (itemsList[i].durability < 25)
                var progressClass = 'danger'
              else if (itemsList[i].durability < 50)
                var progressClass = 'warning'
              else if (itemsList[i].durability < 75)
                var progressClass = 'info'
              else
                var progressClass = 'success'
              content += '</td><td style="width: 30%"><div class="progress" style="margin-top: 5px;text-align: center;">'
                content += '<div class="progress-bar progress-bar-' + progressClass + '" role="progressbar" style="width: ' + itemsList[i].durability + '%">'
                  content += '<span>' + Math.round(itemsList[i].durability) + '% de durabilité</span>'
                content += '</div>'
              content += '</div></td>'
            }
          content += '</td>'
        content += '</tr>'
        $('#confirmBuy .items-list table tbody').append(content)
      }

      // price
      $('#confirmBuy .buy').show()
      if (pricePoint > 0 && (!seller || seller != '<?= ($user) ? $user['pseudo'] : 'null' ?>'))
        $('#confirmBuy .buy[data-pay-mode="point"] .price').html(pricePoint + ' <?= $Configuration->getMoneyName() ?>')
      else
        $('#confirmBuy .buy[data-pay-mode="point"]').hide()
      if (priceMoney > 0 && (!seller || seller != '<?= ($user) ? $user['pseudo'] : 'null'  ?>'))
        $('#confirmBuy .buy[data-pay-mode="money"] .price').html(priceMoney + '$')
      else
        $('#confirmBuy .buy[data-pay-mode="money"]').hide()
      $('#confirmBuy .buy[data-pay-mode="point"]').attr('data-price', pricePoint)
      $('#confirmBuy .buy[data-pay-mode="money"]').attr('data-price', priceMoney)
      $('#confirmBuy .buy').attr('data-selling-id', id)

      // seller
      if (seller)
        $('#confirmBuy .seller').html('<img class="img-rounded" src="https://skins.obsifight.net/head/' + seller + '">')

      // show
      $('#confirmBuy').modal('show')
    }
  })

  $('#confirmBuy .buy').on('click', function (e) {
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
  $('#mySales .get').on('click', function (e) {
    e.preventDefault();
    var btn = $(this)
    var id = parseInt(btn.attr('data-selling-id'))
    btn.attr('disabled', true).addClass('disabled')

    // request to server
    $.get('<?= $this->Html->url(array('controller' => 'purchase', 'action' => 'recovery', 'id' => '{ID}')) ?>'.replace('{ID}', id), function (data) {
      btn.attr('disabled', false).removeClass('disabled')
      if (data.status) {
        // success
        $('.sale[data-selling-id="' + id + '"]').fadeOut(150)
        toastr.success('Vous avez récupéré ces articles !')
      } else {
        toastr.error(data.msg)
      }
    }).error(function () {
      btn.attr('disabled', false).removeClass('disabled')
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
        <div class="seller" style="text-align: center;margin-bottom: 20px;"></div>
        <em>Voulez-vous vraiment acheter ces articles ?</em>
        <br>
        <br>
        <div class="items-list"></div>
      </div>
      <div class="modal-footer">
        <div class="row">
          <div class="col-md-6">
            <a href="#" class="btn btn-block btn-3d btn-reveal btn-red buy" data-pay-mode="money" data-selling-id data-price title="Acheter en dollars (monnaie du jeu)">
              <i class="fa fa-dollar"></i>
              <span>Acheter et payer <b class="price"></b></span>
            </a>
          </div>
          <div class="col-md-6">
            <a href="#" class="btn btn-block btn-3d btn-reveal btn-red buy" data-pay-mode="point" data-selling-id data-price title="Acheter en <?= $Configuration->getMoneyName() ?> (monnaie du site)">
              <i class="fa fa-shopping-cart"></i>
              <span>Acheter et payer <b class="price"></b></span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" tabindex="-1" id="mySales" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Mes ventes</h4>
      </div>
      <div class="modal-body">
        <?php
          if (empty($mySales))
            echo '<div class="alert alert-danger">Aucune vente en cours.</div>';
          else {
            echo '<table class="table">';
              echo '<thead>';
                echo '<th>Icône</th>';
                echo '<th>Nombre d\'articles</th>';
                echo '<th></th>';
              echo '</thead>';
              echo '<tbody>';
                foreach ($mySales as $sale) {
                  echo '<tr class="sale" data-selling-id=' . $sale['id_selling'] . ' data-items-list=\'' . json_encode($sale['items']) . '\'>';
                    echo '<td>' . $this->Html->image($sale['icon_texture_path'], array('class' => 'img-rounded', 'width' => '32', 'onerror' => '$(this).parent().html(\'<i class="fa fa-question"></i>\')')) . '</td>';
                    echo '<td><span data-toggle="tooltip" data-title="';
                      $items = array();
                      foreach ($sale['items'] as $item) {
                        $items[] = $item['amount'] . ' ' . $item['name'];
                      }
                      echo implode(', ', $items);
                    echo '">' . count($sale['items']) . ' article(s)</span></td>';
                    echo '<td>';
                      if (strtotime('+48 hours', strtotime($sale['start_of_sale'])) < time()):
                        echo '<a href="#" class="btn btn-3d btn-reveal btn-red get" data-selling-id="' . $sale['id_selling'] . '" data-toggle="tooltip" data-placement="top" title="Supprime la mise en vente">';
                          echo '<i class="fa fa-hand-rock-o"></i>';
                          echo '<span>Récupérer</span>';
                        echo '</a>';
                        echo '&nbsp;';
                      endif;
                    echo '</td>';
                  echo '</tr>';
                }
              echo '</tbody>';
            echo '</table>';
          }
        ?>
      </div>
    </div>
  </div>
</div>
<?= $this->Html->css('dataTables.bootstrap.css'); ?>
<?= $this->Html->script('jquery.dataTables.min.js') ?>
<?= $this->Html->script('dataTables.bootstrap.min.js') ?>
<script>
$(function () {
  $('table.dataTable').on('page.dt search', function () {
    setTimeout(uuid, 20)
  })
  var table = $('table.dataTable').DataTable({
    paging: true,
    lengthChange: false,
    searching: false,
    ordering: false,
    info: false,
    autoWidth: false,
    searching: true,
    language: {
      infoEmpty: "Aucun article trouvés",
      loadingRecords: "Chargement des articles en cours...",
      search: "Rechercher:",
      zeroRecords: "Aucun article trouvés",
      paginate: {
        first: "Premier",
        last: "Dernier",
        next: "Suivant",
        previous: "Précédent"
      },
    },
  })
})
</script>
<style media="screen">
  div#DataTables_Table_0_filter.dataTables_filter {
    float: right;
  }
</style>
