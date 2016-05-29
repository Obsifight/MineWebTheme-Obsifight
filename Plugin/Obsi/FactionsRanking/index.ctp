<section>
  <div class="container">

    <div class="heading-title heading-dotted text-center">
      <h4>Classement factions</h4>
    </div>

    <div class="alert alert-info margin-bottom-10">
      <b>Informations</b> Le classement s'actualise toutes les 2 heures.<br>
      <small>Dernière actualisation à <?= date('H\hi', strtotime($lastUpdate)) ?></small>
    </div>

    <table class="table table-vertical-middle dataTable">
			<thead>
				<tr>
					<th>#</th>
					<th>Nom</th>
					<th>Chef</th>
					<th>Tués</th>
          <th>Morts</th>
          <th>Ratio</th>
          <th>Pièces d'or</th>
          <th>Events end</th>
          <th>Events KingZombie</th>
          <th>Guerre</th>
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
          { data: 'position' },
          { data: 'name' },
          { data: 'leader' },
          { data: 'kills' },
          { data: 'deaths' },
          { data: 'ratio' },
          { data: 'golds_pieces' },
          { data: 'end_events' },
          { data: 'kingzombie_events' },
          { data: 'factions_war' },
          { data: 'points' }
        ]
      });
    });
</script>
<style media="screen">
  div#DataTables_Table_0_filter.dataTables_filter {
    float: right;
  }
</style>
