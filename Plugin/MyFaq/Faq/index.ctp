<section class="alternate padding-xxs">
	<div class="container">

		<div class="heading-title heading-dotted text-center" style="margin-bottom:0;">
			<h4>FAQ</h4>
		</div>

  </div>
</section>
<section>
  <div class="container">
    <?php if (empty($faqs)): ?>
      <div class="alert alert-danger">
        Aucune FAQ disponible pour le moment
      </div>
    <?php endif; ?>

    <?php foreach($faqs as $k=>$v): $v = current($v); ?>
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="heading-<?= $v['id'] ?>">
                <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse-<?= $v['id'] ?>" aria-expanded="true" aria-controls="collapse-<?= $v['id'] ?>">
                        <?= $v['question'] ?>
                    </a>
                </h4>
            </div>
            <div id="collapse-<?= $v['id'] ?>" class="panel-collapse collapse<?= ($k == 0) ? " in" : "" ?>" role="tabpanel" aria-labelledby="heading-<?= $v['id'] ?>">
                <div class="panel-body">
                    <?= $v['answer'] ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
  </div>
</section>
