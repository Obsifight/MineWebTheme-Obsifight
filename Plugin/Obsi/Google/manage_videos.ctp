<section>
	<div class="container">

    <?php
    foreach ($videos as $video) {
      echo '<div class="row">';
        echo '<div class="col-md-4">';
          echo '<img src="'.$video['YoutubeVideo']['thumbnail_link'].'" class="img-rounded">';
        echo '</div>';
        echo '<div class="col-md-6">';
          echo '<p><strong>'.$video['YoutubeVideo']['title'].'</strong></p>';
          echo '<p>';
            echo '<span><i class="fa fa-eye"></i> '.$video['YoutubeVideo']['views_count'].' vues</span><br>';
            echo '<span><i class="fa fa-thumbs-up"></i> '.$video['YoutubeVideo']['likes_count'].' likes</span><br>';
          echo '</p>';
          if ($video['YoutubeVideo']['eligible'])
            echo '<p class="text-success" data-toggle="tooltip" data-placement="top" title="Vous pouvez être rémunéré en '.$Configuration->getMoneyName().' pour cette vidéo."><i class="fa fa-check"></i> Éligible à la rémunération</p>';
          else
            echo '<p class="text-danger" data-toggle="tooltip" data-placement="top" title="Vous ne pouvez pas être rémunéré pour cette vidéo. Elle ne correspond pas à nos critères."><i class="fa fa-times"></i> Non éligible à la rémunération</p>';
        echo '</div>';
      echo '</div>';
    }
    ?>

  </div>
</section>
<script type="text/javascript">
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>
