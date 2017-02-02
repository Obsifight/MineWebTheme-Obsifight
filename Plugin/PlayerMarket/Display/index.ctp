<section>
  <div class="container">
    <div class="row">
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
            <th></th>
            <th></th>
          </thead>
          <tbody>
            <?php
              foreach ($sales as $sale) {
                echo '<tr class="sale" data-selling-id=' . $sale['id_selling'] . ' data-items-list=\'' . json_encode($sale['items']) . '\'>';
                  echo '<td>' . $this->Html->image($sale['icon_texture_path'], array('class' => 'img-rounded', 'width' => '32', 'onerror' => '$(this).parent().html(\'<i class="fa fa-question"></i>\')')) . '</td>';
                  echo '<td><span class="uuid" data-uuid="' . $sale['seller'] . '"></span>';
                  echo '<td>' . count($sale['items']) . ' article(s)</td>';
                  echo '<td>';
                    if ($sale['price_money'] > 0 && $isConnected && strtolower(trim($sale['seller'])) != strtolower(trim($user['pseudo']))):
                      echo '<a href="#" class="btn btn-3d btn-reveal btn-red buy" data-pay-mode="money" data-selling-id="' . $sale['id_selling'] . '" data-price="' . $sale['price_money'] . '" data-toggle="tooltip" data-placement="top" title="Acheter en dollars (monnaie du jeu)">';
                        echo '<i class="fa fa-dollar"></i>';
                        echo '<span>' . $sale['price_money'] . '$</span>';
                      echo '</a>';
                      echo '&nbsp;';
                    endif;
                  echo '</td>';
                  echo '<td>';
                    if ($sale['price_point'] > 0 && $isConnected && strtolower(trim($sale['seller'])) != strtolower(trim($user['pseudo']))):
                      echo '<a href="#" class="btn btn-3d btn-reveal btn-red buy" data-pay-mode="point" data-selling-id="' . $sale['id_selling'] . '" data-price="' . $sale['price_point'] . '" data-toggle="tooltip" data-placement="top" title="Acheter en points boutique">';
                        echo '<i class="fa fa-shopping-cart"></i>';
                        echo '<span>' . $sale['price_point'] . ' ' . $Configuration->getMoneyName() . '</span>';
                      echo '</a>';
                    endif;
                  echo '</td>';
                echo '</tr>';
              }
            ?>
          </tbody>
        </table>

      </div>
    </div>
  </div>
</section>
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
          $('.uuid[data-uuid="' + uuid + '"]').addClass('uuid-setted').html('<img class="img-rounded" src="http://web.skins.obsifight.fr/head/' + data.body.users[uuid] + '/32">&nbsp;&nbsp;' + data.body.users[uuid])
        }
      }
    })
  })
}
uuid()

$(function () {
  $('[data-toggle="tooltip"]').tooltip()

  $('.buy[data-pay-mode]').on('click', function (e) {
    e.preventDefault()
    var btn = $(this)
    var price = parseFloat(btn.attr('data-price'))
    var id = parseInt(btn.attr('data-selling-id'))
    var payMode = btn.attr('data-pay-mode')
    var saleDiv = $('.sale[data-selling-id="' + id + '"]')
    var itemsList = JSON.parse(saleDiv.attr('data-items-list'))

    $('#confirmBuy #confirmBtn').removeClass('disabled').attr('disabled', false)
    if (payMode == 'point') {
      next((price <= '<?= ($user) ? $user['money'] : 0 ?>'))
    } else {
      $.get('<?= $this->Html->url('/market/user/money') ?>', function (data) {
        next((!data.status || data.money >= price))
      })
    }

    function next(can) {
      // display
      if (can) {
        $('#confirmBuy #confirmBtn').attr('data-selling-id', id).attr('data-pay-mode', payMode)
        $('#confirmBuy .cant').hide()
        $('#confirmBuy .can').show()
        // items list
        $('#confirmBuy .can .items-list').html('<table class="table"><tbody></tbody></table>')
        var content = ''
        for (var i = 0; i < itemsList.length; i++) {
          content = '<tr>'
            content += '<td>'
              content += itemsList[i].name_parsed
              if (itemsList[i].durability > 0)
                content += '</td><td>' + itemsList[i].durability + '% de durabilité'
            content += '</td>'
          content += '</tr>'
          $('#confirmBuy .can .items-list table tbody').append(content)
        }
      } else {
        $('#confirmBuy #confirmBtn').addClass('disabled').attr('disabled', true)
        $('#confirmBuy .can').hide()
        $('#confirmBuy .cant').show()
      }
      // price unity
      if (payMode == 'point')
        $('#confirmBuy #confirmBtn span').html(price + ' <?= $Configuration->getMoneyName() ?>')
      else
        $('#confirmBuy #confirmBtn span').html(price + '$')
      // show
      $('#confirmBuy').modal('show')
    }
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
  $('#mySales .get').on('click', function (e) {
    e.preventDefault();
    var btn = $(this)
    var id = parseInt(btn.attr('data-selling-id'))
    btn.attr('disabled').addClass('disabled')

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
        <div class="can">
          <em>Voulez-vous vraiment acheter ces articles ?</em>
          <br>
          <br>
          <div class="items-list"></div>
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
                    echo '<td>' . count($sale['items']) . ' article(s)</td>';
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
