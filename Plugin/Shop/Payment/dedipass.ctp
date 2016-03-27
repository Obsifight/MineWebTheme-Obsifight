<section>
  <div class="container">

    <div class="heading-title heading-dotted">
  	  <h2>Créditer son compte avec <span>Dédipass</span></h2>
    </div>

    <div data-dedipass="<?= $dedipassPublicKey ?>">
      <div class="alert alert-info"><?= $Lang->get('GLOBAL__LOADING') ?>...</div>
    </div>
    <script src="//api.dedipass.com/v1/pay.js"></script>
  </div>
</section>
