<section>
	<div class="container">

    <?php
    foreach ($videos as $video) {
      echo '<div class="row">';
        echo '<div class="col-md-4">';
          echo '<a target="_blank" href="https://youtube.com/watch?v='.$video['YoutubeVideo']['video_id'].'"><img src="'.$video['YoutubeVideo']['thumbnail_link'].'" class="img-rounded pull-right"></a>';
        echo '</div>';
        echo '<div class="col-md-8">';
          echo '<p>';
            echo '<strong>'.$video['YoutubeVideo']['title'].'</strong>';
            if ($video['YoutubeVideo']['eligible'])
              echo '<a data-toggle="tooltip" data-placement="left" title="! Attention ! <br>Une fois la vidéo rémunéré, celle-ci ne sera plus éligible." href="'.$this->Html->url('/user/youtube/videos/remuneration/').$video['YoutubeVideo']['id'].'" class="pull-right"><em><u>Recevoir la rémunération</u></em></a>';
          echo '</p>';
          echo '<p>';
            echo '<span><i class="fa fa-eye"></i> '.$video['YoutubeVideo']['views_count'].' vues</span><br>';
            echo '<span><i class="fa fa-thumbs-up"></i> '.$video['YoutubeVideo']['likes_count'].' likes</span><br>';
            echo '<span><i class="fa fa-calendar"></i> '.$Lang->date($video['YoutubeVideo']['publication_date']).'</span><br>';
          echo '</p>';
          if ($video['YoutubeVideo']['eligible'])
            echo '<span style="color:#2C9600" data-toggle="tooltip" data-placement="top" title="Vous pouvez être rémunéré en '.$Configuration->getMoneyName().' pour cette vidéo."><i class="fa fa-check"></i> Éligible à la rémunération</span>';
          else
            echo '<span class="text-danger" data-toggle="tooltip" data-placement="top" title="Vous ne pouvez pas être rémunéré pour cette vidéo. Elle ne correspond pas à nos critères."><i class="fa fa-times"></i> Non éligible à la rémunération</span>';
        echo '</div>';
      echo '</div>';
      echo '<hr>';
    }
    ?>

  </div>
</section>
<script type="text/javascript">
$(function () {
  $('[data-toggle="tooltip"]').tooltip({html: true})
})
</script>
