<section>
  <div class="container">

    <div class="heading-title heading-dotted text-center">
      <h4>Classement factions</h4>
    </div>

    <div class="alert alert-info margin-bottom-10">
      <b>Informations</b> Le classement s'actualise toutes les 2 heures.<br>
      <small>Dernière actualisation à <?= date('H\hi', strtotime($lastUpdate)) ?><a class="pull-right" data-toggle="modal" data-target="#points_calcul" href="#">Voir la table des valeurs</a></small>
    </div>

    <table class="table table-vertical-middle dataTable">
			<thead>
				<tr>
          <?php
          foreach ($factionsData as $th) {
            echo '<th>'.$th['tableName'].'</th>';
          }
          ?>
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
      $('table.dataTable').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": false,
        "autoWidth": false,
        'searching': true,
        "language": {
            "infoEmpty": "Aucune factions trouvées",
            "loadingRecords": "Chargement des factions en cours...",
            "search":         "Rechercher:",
            "zeroRecords":    "Aucune factions trouvées",
            "paginate": {
                "first":      "Premier",
                "last":       "Dernier",
                "next":       "Suivant",
                "previous":   "Précédent"
            },
        },
        ajax: '<?= $this->Html->url(array('action' => 'get')) ?>',
        'columns': [
          <?php
          foreach ($factionsData as $th) {
            echo "{ data: '".addslashes($th['ajaxName'])."' },";
          }
          ?>
        ]
      });
    });
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
