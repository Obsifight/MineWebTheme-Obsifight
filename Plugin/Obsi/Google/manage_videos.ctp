<section style="padding-top:20px;">
	<div class="container">
    <?= $this->Session->flash(); ?>
    <div class="alert alert-info">
      Les données ne sont mises à jours que toutes les 5h.
      <button type="button" class="btn btn-info pull-right" data-toggle="popover" title="Rémunération" data-content="- Le titre doit contenir 'ObsiFight'<br>- La description doit contenir 'ObsiFight'<br>- La description doit contenir un lien vers obsifight.net<br>- Les vues de la vidéo doivent être supérieures ou égales à 100<br>- La publication de la vidéo doit être inférieur à 7 jours (avant le <?= date('d/m/Y', strtotime('-7 days')) ?>)" data-placement="top" style="margin-top:-8px;">Connaître les conditions de rémunération</button>
    </div>

    <?php
    foreach ($videos as $video) {
      $remuneration = 0.3 * $video['YoutubeVideo']['views_count'] + 0.5 * $video['YoutubeVideo']['likes_count'];
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
          if ($video['YoutubeVideo']['eligible'] && !$video['YoutubeVideo']['payed'])
            echo '<span style="color:#2C9600" data-toggle="tooltip" data-placement="top" title="Vous pouvez être rémunéré de '.$remuneration.' '.$Configuration->getMoneyName().' pour cette vidéo."><i class="fa fa-check"></i> Éligible à la rémunération</span>';
          else if (!$video['YoutubeVideo']['payed'])
            echo '<span class="text-danger" data-toggle="tooltip" data-placement="top" title="Vous ne pouvez pas être rémunéré pour cette vidéo. Elle ne correspond pas à nos critères."><i class="fa fa-times"></i> Non éligible à la rémunération</span>';
          else
            echo '<span class="text-warning" data-toggle="tooltip" data-placement="top" title="Une vidéo ne peut être rémunéré que 1 seule fois."><i class="fa fa-times"></i> Vous avez déjà été rémunéré pour cette vidéo.</span>';
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
  $('[data-toggle="popover"]').popover({html: true})
})
</script>
