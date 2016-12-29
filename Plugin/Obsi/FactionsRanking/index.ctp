<section>
  <div class="container">

    <div class="heading-title heading-dotted text-center">
      <h4>Classement factions</h4>
    </div>

    <div class="alert alert-info margin-bottom-10">
      <b>Informations</b> Le classement s'actualise toutes les 2 heures.<br>
      <small>Dernière actualisation à <span id="lastModified"> <i class="fa fa-refresh fa-spin"></i></span><a class="pull-right" data-toggle="modal" data-target="#points_calcul" href="#">Voir la table des valeurs</a></small>
    </div>

    <table class="table table-vertical-middle dataTable">
			<thead>
				<tr>
          <th>#</th>
          <th>Nom</th>
          <th>Tués</th>
          <th>Morts</th>
          <th>Power</th>
          <th>Monnaie</th>
          <th>Points</th>
				</tr>
			</thead>
			<tbody>
      </tbody>
		</table>

  </div>
</section>
<?= $this->Html->css('dataTables.bootstrap.css'); ?>
<?= $this->Html->script('jquery.dataTables.min.js') ?>
<?= $this->Html->script('dataTables.bootstrap.min.js') ?>
<script>
$(function () {
  var table = $('table.dataTable').DataTable({
    paging: true,
    lengthChange: false,
    searching: false,
    ordering: false,
    info: false,
    autoWidth: false,
    searching: true,
    language: {
      infoEmpty: "Aucune factions trouvées",
      loadingRecords: "Chargement des factions en cours...",
      search:         "Rechercher:",
      zeroRecords:    "Aucune factions trouvées",
      paginate: {
        first: "Premier",
        last: "Dernier",
        next: "Suivant",
        previous: "Précédent"
      },
    },
  })

  $.get('http://factions.api.obsifight.net/data', function (data, textStatus, jqXHR) {
    var lastModified = new Date(jqXHR.getResponseHeader('Last-Modified'))
    lastModified = (lastModified.getHours().length === 1 ? 0 + lastModified.getHours() : lastModified.getHours()) + ':' + (lastModified.getMinutes().length === 1 ? 0 + lastModified.getMinutes() : lastModified.getMinutes())
    $('#lastModified').html(lastModified)

    for (var i = 0; i < data.length; i++) {
      table.row.add([
        (i + 1),
        data[i].name,
        data[i].stats.kills,
        data[i].stats.deaths,
        data[i].powers.actual,
        data[i].stats.money,
        data[i].points
      ])
    }
    table.draw()
  })
})
</script>
<style media="screen">
  div#DataTables_Table_0_filter.dataTables_filter {
    float: right;
  }
</style>

<div class="modal modal-medium fade" id="points_calcul" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span>&times;</span><span class="sr-only">Fermer</span></button>
        <h4 class="modal-title">Calcul des points</h4>
      </div>
      <div class="modal-body">

        <?php

        $pointsCalculDivided = array_chunk($pointsCalcul, 4);

        foreach ($pointsCalculDivided as $table) {

          echo '<table class="table table-hover">';
            echo '<thead>';
              echo '<tr class="info">';

                foreach ($table as $th) {
                  echo '<th>'.$th['title'].'</th>';
                }

              echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

              $tr = array();

              foreach ($table as $column) {
                $i = 0;

                foreach ($column['td'] as $key => $value) {

                  if(!isset($tr[$i])) {
                    $tr[$i] = array();
                  }

                  $tr[$i] = array_merge($tr[$i], array(array($key => $value)));

                  $i++;
                }

              }

              foreach ($tr as $k => $datas) {

                echo '<tr>';

                  foreach ($datas as $key => $v) {

                    foreach ($v as $for => $value) {

                      echo '<td>'.$for.' :<br>'.$value.'</td>';

                    }

                  }

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
