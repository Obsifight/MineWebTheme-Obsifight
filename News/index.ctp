<section>
	<div class="container">

		<div class="row">

			<!-- LEFT -->
			<div class="col-md-9 col-sm-9">

				<h1 class="blog-post-title"><?= $news['News']['title'] ?></h1>
				<ul class="blog-post-info list-inline">
					<li>
						<a href="#">
							<i class="fa fa-clock-o"></i>
							<span class="font-lato">Le <?= $Lang->date($news['News']['created']); ?></span>
						</a>
					</li>
					<li>
						<a href="#">
							<i class="fa fa-comment-o"></i>
							<span class="font-lato"><?= $news['News']['count_comments'] ?> Commentaires</span>
						</a>
					</li>
					<li>
						<a href="#">
							<i class="fa fa-user"></i>
							<span class="font-lato"><?= $news['News']['author'] ?></span>
						</a>
					</li>
				</ul>

				<!-- article content -->
        <article>
          <p><?= $news['News']['content'] ?></p>
        </article>

        <div class="pull-right">
          <?php if($Permissions->can('LIKE_NEWS')) { ?>
              <button id="<?= $news['News']['id'] ?>" type="button" class="btn btn-danger like<?= ($news['News']['liked']) ? ' active' : '' ?>"<?= (!$Permissions->can('LIKE_NEWS')) ? ' disabled' : '' ?>><?= $news['News']['count_likes'] ?> <i class="fa fa-thumbs-up"></i></button>
          <?php } else { ?>
              <div class="alert alert-info"><?= str_replace('%likes%', $news['News']['count_likes'], $Lang->get('NEWS__NBR_LIKES_ON_THIS_NEWS'))?></div>
          <?php } ?>
        </div>

        <div class="clearfix"></div>

				<div class="divider divider-dotted"><!-- divider --></div>


				<!-- COMMENTS -->
				<div id="comments" class="comments">

					<h4 class="page-header margin-bottom-60 size-20">
						<span><?= $news['News']['count_comments'] ?></span> Commentaires
					</h4>

          <div class="add-comment"></div>

          <?php foreach ($news['Comment'] as $k => $v) { ?>
            <div class="media" id="comment-<?= $v['id'] ?>">
              <span class="user-avatar">
                <img class="pull-left media-object" src="https://skins.obsifight.net/head/<?= $v['author'] ?>/64" width="64" height="64" alt="">
              </span>
              <div class="media-body">
                <?php if($Permissions->can('DELETE_COMMENT') OR $Permissions->can('DELETE_HIS_COMMENT') AND $user['pseudo'] == $v['Comment']['author']) { ?>
                  <a id="<?= $v['id'] ?>" title="<?= $Lang->get('GLOBAL__DELETE') ?>" class="comment-reply comment-delete btn btn-danger btn-sm"><icon class="fa fa-times"></icon></a>
                <?php } ?>
  							<h4 class="media-heading bold"><?= $v['author'] ?></h4>
  							<small class="block"><?= $Lang->date($v['created']); ?></small>
  							<?= before_display($v['content']) ?>
  						</div>
            </div>
          <?php } ?>

          <?php if($Permissions->can('COMMENT_NEWS')) { ?>

            <div id="form-comment-fade-out">
    					<h4 class="page-header size-20 margin-bottom-60 margin-top-100">
    						<?= $Lang->get('NEWS__COMMENT_TITLE') ?>
    					</h4>

              <div id="error-on-post"></div>
              <form method="POST" data-ajax="true" action="<?= $this->Html->url(array('controller' => 'news', 'action' => 'add_comment')) ?>" data-callback-function="addcomment" data-success-msg="false">
                <input name="news_id" value="<?= $news['News']['id'] ?>" type="hidden">

                <div class="row">
    							<div class="form-group">
    								<div class="col-md-12">
    									<textarea required="required" maxlength="5000" rows="5" class="form-control" name="content"></textarea>
    								</div>
    							</div>
    						</div>

                <div class="row">
                  <div class="col-md-12">

                    <button class="btn btn-3d btn-lg btn-reveal btn-black">
                      <i class="fa fa-check"></i>
                      <span><?= $Lang->get('GLOBAL__SUBMIT') ?></span>
                    </button>

                  </div>
                </div>

              </form>
            </div>

          <?php } ?>

				</div>
				<!-- /COMMENTS -->


			</div>


			<!-- RIGHT -->
			<div class="col-md-3 col-sm-3">

				<!-- side navigation -->
				<div class="side-nav margin-bottom-60 margin-top-30">

					<div class="side-nav-head">
						<button class="fa fa-bars"></button>
						<h4>Dernières actualités</h4>
					</div>
					<ul class="list-group list-group-bordered list-group-noicon uppercase">
            <?php if(isset($search_news) && !empty($search_news)) { ?>
              <?php foreach ($search_news as $key => $value) { ?>
                <li class="list-group-item"><a href="<?= $this->Html->url(array($value['News']['slug'])) ?>"><?= $value['News']['title'] ?></a></li>
              <?php } ?>
            <?php } else { ?>
              <div class="alert alert-danger">Aucune actualité à afficher</div>
            <?php } ?>
					</ul>
					<!-- /side navigation -->


				</div>

			</div>

		</div>


	</div>
</section>
<script type="text/javascript">
    $(".comment-delete").click(function() {
        comment_delete(this);
    });

    function comment_delete(e) {
        var inputs = {};
        inputs['id'] = $(e).attr('id');
        inputs["data[_Token][key]"] = '<?= $csrfToken ?>';
        $.post("<?= $this->Html->url(array('action' => 'ajax_comment_delete')) ?>", inputs, function(data) {
          if(data == 'true') {
            $('#comment-'+inputs['id']).fadeOut(500);
          } else {
            console.log(data);
          }
        });
    }

    function addcomment(data) {
      var d = new Date();
      var comment = '';
      comment += '<div class="media"';
        comment +='<span class="user-avatar">';
          comment +='<img class="pull-left media-object" src="https://skins.obsifight.net/head/<?= $user['pseudo'] ?>/64" width="64" height="64" alt="">';
        comment += '</span>';
        comment += '<div class="media-body">';
          comment += '<h4 class="media-heading bold"><?= $user['pseudo'] ?></h4>';
          comment += '<small class="block">'+d.getHours()+'h'+d.getMinutes()+'</small>';
          comment += data['content'];
        comment += '</div>';
      comment += '</div>';
      $('.add-comment').hide().html(comment).fadeIn(1500);
      $('#form-comment-fade-out').fadeOut(150)
    }
</script>
<style media="screen">
	p {
		margin-bottom: 15px;
	}
</style>
