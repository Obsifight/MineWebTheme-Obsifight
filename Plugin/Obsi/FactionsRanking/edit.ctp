<section style="padding-top: 30px">
  <div class="container">
    <div id="factionData">
      <div class="row">
        <div class="col-lg-3 col-sm-3 col-xs-6" style="margin-bottom: 0">
          <div class="circle-tile ">
            <a><div class="circle-tile-heading dark-blue"><i class="fa fa-users fa-fw fa-3x"></i></div></a>
            <div class="circle-tile-content dark-blue">
              <div class="circle-tile-description text-faded"> Membres</div>
              <div class="circle-tile-number text-faded " data-faction="players.count">0</div>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-sm-3 col-xs-6" style="margin-bottom: 0">
          <div class="circle-tile ">
            <a><div class="circle-tile-heading orange"><i class="fa fa-chain-broken fa-fw fa-3x"></i></div></a>
            <div class="circle-tile-content orange">
              <div class="circle-tile-description text-faded"> Tués </div>
              <div class="circle-tile-number text-faded " data-faction="stats.kills">0</div>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-sm-3 col-xs-6" style="margin-bottom: 0">
          <div class="circle-tile ">
            <a><div class="circle-tile-heading red"><i class="fa fa-user-times fa-fw fa-3x"></i></div></a>
            <div class="circle-tile-content red">
              <div class="circle-tile-description text-faded"> Morts </div>
              <div class="circle-tile-number text-faded " data-faction="stats.deaths">0</div>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-sm-3 col-xs-6" style="margin-bottom: 0">
          <div class="circle-tile ">
            <a><div class="circle-tile-heading blue"><i class="fa fa-usd fa-fw fa-3x"></i></div></a>
            <div class="circle-tile-content blue">
              <div class="circle-tile-description text-faded"> Argent </div>
              <div class="circle-tile-number text-faded " data-faction="stats.money">0</div>
            </div>
          </div>
        </div>
      </div>
      <div class="heading-title heading-dotted">
        <h1><span data-faction="name"><i class="fa fa-refresh fa-spin"></i></span></h1>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="col-lg-9 col-sm-12 col-xs-12">
              <p class="lead" data-faction="description"><em>Chargement...</em></p>

              <hr>

              <div class="heading-title heading-border-bottom">
              	<h3 style="border-bottom: 2px solid #DA3737;margin-bottom: -2px;">Chef</h3>
              </div>

              <div id="leadersList"></div>

              <br><br>

              <div class="heading-title heading-border-bottom">
              	<h3 style="border-bottom: 2px solid #2ecc71;margin-bottom: -2px;">Membres</h3>
              </div>

              <div id="membersList"></div>

            </div>
            <div class="col-lg-3 col-sm-12 col-xs-12 pull-right">
              <div class="row">
                <div class="col-lg-12 col-md-6 col-sm-6 hidden-xs">
                  <div id="drop-area-message" style="width:320px;"></div>
                  <div id="drop-area-div" style="width:320px;height:320px;">
                    <div class="upload">
                      <h4>Déposer une image ici</h4>
                      <span>OU</span>
                      <label class="btn btn-default btn-file" style="padding-top: 7px;margin-top: 30px;">
                        Choisir une image <input type="file" style="display: none;">
                      </label>
                    </div>
                    <div class="drag">
                      <h4>Déposez l'image</h4>
                    </div>
                    <div class="preview">
                      <?php
                      $file = WWW_ROOT.DS.'img'.DS.'uploads'.DS.'factions-logo'.DS."faction-logo-$factionId.png";
                      if (file_exists($file))
                        echo $this->Html->image('uploads'.DS.'factions-logo'.DS."faction-logo-$factionId.png?_t=".time());
                      else
                        echo $this->Html->image('320x320-fake.png');
                      ?>
                    </div>
                    <div class="progress-upload"></div>
                  </div>
                  <p style="width: 320px;">
                    <em>
                      <small class="text-muted">Vous pouvez envoyer un logo pour votre faction de maximum 320px par 320px au format PNG.</small><br>
                      <small class="text-warning">Nous nous réservons le droit de supprimer votre logo à tout moment si il ne respecte pas nos règles ou la loi française, ainsi que si celui-ci nuit au site.</small>
                    </em>
                  </p>
                </div>
                <div class="col-lg-12 col-md-6 col-sm-6">
                  <div class="heading-title heading-border-bottom" id="power-progress">
                    <h3>Power : <span data-faction="powers.actual">0</span></h3>
                    <hr class="progress" style="width: 0%;">
                  </div>
                  <div class="heading-title heading-border-bottom" id="claims-progress">
                    <h3>Claims : <span data-faction="claims.count">0</span></h3>
                    <hr class="progress" style="width: 0%;background-color:#2980b9;">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>
<style media="screen">
  #drop-area-div .progress-upload {
    height: 4px;
    background-color: #2980b9;
    width: 0%;
    bottom: -2px;
    position: absolute;
    display: block;
  }
  #drop-area-div .upload,
  #drop-area-div .drag {
    display: none;
    vertical-align: middle;
    padding: 60px 30px;
    background: rgba(0, 0, 0, 0.35);
    position: absolute;

    width: 100%;
    height: 100%;
  }
  #drop-area-div .drag h4 {
    margin-top: 20px;
  }
  #drop-area-div.dragged .drag,
  #drop-area-div:hover:not(.dragged) .upload {
    display: block;
  }
  #drop-area-div {
    position: relative;
    border: 2px dotted #000;
    width: 320px;
    height: 320px;
    margin-bottom: 10px;

    color: #fff;
    text-align: center;
    font-size: 200%;
  }
  #drop-area-div h4 {
    color: #fff;
    text-align: center;
    font-size: 30px;
  }
  #drop-area-div span {
    display: block;
    font-style: italic;
    font-size: 16px;
  }
  #drop-area-div span:before,
  #drop-area-div span:after {
    content: " - ";
  }
  #drop-area-div .preview img {
    width: 100%;
    height: 100%;
  }
</style>
<?= $this->Html->script('dmuploader.min.js') ?>
<script type="text/javascript">
  $("#drop-area-div").dmUploader({
    url: '<?= $this->Html->url(array('controller' => 'FactionsRanking', 'action' => 'uploadLogo', 'plugin' => 'obsi')) ?>',
    extraData: {
      'data[_Token][key]': '<?= $csrfToken ?>'
    },
    fileName: 'image',
    allowedTypes: 'image/*',
    extFilter: 'png',
    maxFiles: 1,
    maxFileSize: 10000000,
    dataType: 'json',
    onNewFile: function(id, file){
      $('#drop-area-div .preview').html('').append('<img src="' + window.URL.createObjectURL(file) + '">')
    },
    onUploadSuccess: function(id, data){
      console.log('Succefully upload #' + id);
      console.log('Server response was:');
      console.log(data);
      if (!data.status)
        $('#drop-area-message').hide().html('<div class="alert alert-danger"><b>Erreur : </b>' + data.msg + '</div>').fadeIn(150)
      else
        $('#drop-area-message').hide().html('<div class="alert alert-success"><b>Succès : </b>' + data.msg + '</div>').fadeIn(150)
    },
    onUploadProgress: function(id, percent){
      console.log('Upload of #' + id + ' is at %' + percent);
      // do something cool here!
      $('#drop-area-div .progress-upload').css('width', percent + '%')
    },
    onUploadError: function (id, message) {
      $('#drop-area-message').hide().html('<div class="alert alert-danger"><b>Erreur : </b>Une erreur est apparue lors de l\'envoie (<em>' + message + '</em>). Veuillez réessayer</div>').fadeIn(150)
      console.log('Error trying to upload #' + id + ': ' + message);
    },
    onFileTypeError: function (file) {
      $('#drop-area-message').hide().html('<div class="alert alert-danger"><b>Erreur : </b>Le format de l\'image doit être au format PNG.</div>').fadeIn(150)
      console.log('File type of ' + file.name + ' is not allowed: ' + file.type);
    },
    onFileSizeError: function (file) {
      $('#drop-area-message').hide().html('<div class="alert alert-danger"><b>Erreur : </b>Votre image est trop lourde. Veuillez en choisir une autre ou la compresser.</div>').fadeIn(150)
    },
    onFileExtError: function (file) {
      $('#drop-area-message').hide().html('<div class="alert alert-danger"><b>Erreur : </b>L\'extension de l\'image doit être .png.</div>').fadeIn(150)
      console.log('File extension of ' + file.name + ' is not allowed');
    },
    onFilesMaxError: function(file) {
      $('#drop-area-message').hide().html('<div class="alert alert-danger"><b>Erreur : </b>Vous ne pouvez envoyer que 1 seul logo.</div>').fadeIn(150)
    }
  })
  var counter = 0;
  $('#drop-area-div').bind({
    dragenter: function (ev) {
      ev.preventDefault() // needed for IE
      counter++
      $(this).addClass('dragged')
    },
    dragleave: function () {
      counter--
      if (counter === 0) $(this).removeClass('dragged')
    },
    drop: function () {
      counter = 0
      $(this).removeClass('dragged')
    }
  })
</script>
<script type="text/javascript">
  $.get('http://factions.api.obsifight.net/data/<?= $factionId ?>', function (response) {
    // error
    if (!response.status)
      return $('#factionData').html('<div class="alert alert-danger">Un problème est survenu lors de la récupération des données de la faction.</div>')
    // global data
    var data = response.data
    function display(data, prefix) {
      for (var key in data) {
        if (typeof data[key] !== 'object')
          $('[data-faction="' + (prefix ? prefix + '.' : '') + key +'"]').html(data[key])
        else
          display(data[key], key)
      }
    }
    display(data)
    // custom
    $('[data-faction="players.count"]').html(data.players.list.length)
    // power progress
    var powerPercentage = (data.powers.actual / data.powers.max) * 100
    $('#power-progress hr').css('width', powerPercentage + '%')
    // claims progress
    var outpostPercentage = (data.claims.count / data.claims.outpost) * 100
    $('#claims-progress hr').css('width', outpostPercentage + '%')
    // list
    if (typeof data.players.leader !== 'object')
      data.players.leader = [data.players.leader]
    for (var i = 0; i < data.players.leader.length; i++) {
      $('#leadersList').append('<a href="<?= $this->Html->url('/stats') ?>/' + data.players.leader[i] + '"><img width="64" heigt="64" data-toggle="tooltip" data-placement="top" class="img-rounded staff-img" title="' + data.players.leader[i] + '" src="http://web.skins.obsifight.fr/head/' + data.players.leader[i] + '"></a>')
    }
    for (var i = 0; i < data.players.list.length; i++) {
      $('#membersList').append('<a href="<?= $this->Html->url('/stats') ?>/' + data.players.list[i] + '"><img width="64" heigt="64" data-toggle="tooltip" data-placement="top" class="img-rounded staff-img" title="' + data.players.list[i] + '" src="http://web.skins.obsifight.fr/head/' + data.players.list[i] + '"></a>')
    }
    $('[data-toggle="tooltip"]').tooltip()
  })
</script>
<style media="screen">
  .heading-title.heading-border-bottom hr.progress {
    background-color: #27ae60;
    height: 2px;
    margin: 0;
    margin-bottom: -2px;
  }

  .circle-tile {
    margin-bottom: 15px;
    text-align: center;
  }
  .circle-tile-heading {
    border: 3px solid rgba(255, 255, 255, 0.3);
    border-radius: 100%;
    color: #FFFFFF;
    height: 80px;
    margin: 0 auto -40px;
    position: relative;
    transition: all 0.3s ease-in-out 0s;
    width: 80px;
  }
  .circle-tile-heading .fa {
    line-height: 80px;
  }
  .circle-tile-content {
    padding-top: 50px;
  }
  .circle-tile-number {
    font-size: 26px;
    font-weight: 700;
    line-height: 1;
    padding: 5px 0 15px;
  }
  .circle-tile-description {
    text-transform: uppercase;
  }
  .circle-tile-footer {
    background-color: rgba(0, 0, 0, 0.1);
    color: rgba(255, 255, 255, 0.5);
    display: block;
    padding: 5px;
    transition: all 0.3s ease-in-out 0s;
  }
  .circle-tile-footer:hover {
    background-color: rgba(0, 0, 0, 0.2);
    color: rgba(255, 255, 255, 0.5);
    text-decoration: none;
  }
  .circle-tile-heading.dark-blue:hover {
    background-color: #2E4154;
  }
  .circle-tile-heading.green:hover {
    background-color: #138F77;
  }
  .circle-tile-heading.orange:hover {
    background-color: #f39c12;
  }
  .circle-tile-heading.blue:hover {
    background-color: #2473A6;
  }
  .circle-tile-heading.red:hover {
    background-color: #c0392b;
  }
  .circle-tile-heading.purple:hover {
    background-color: #7F3D9B;
  }
  .tile-img {
    text-shadow: 2px 2px 3px rgba(0, 0, 0, 0.9);
  }

  .dark-blue {
    background-color: #34495E;
  }
  .green {
    background-color: #16A085;
  }
  .blue {
    background-color: #2980B9;
  }
  .orange {
    background-color: #F39C12;
  }
  .red {
    background-color: #E74C3C;
  }
  .purple {
    background-color: #8E44AD;
  }
  .dark-gray {
    background-color: #7F8C8D;
  }
  .gray {
    background-color: #95A5A6;
  }
  .light-gray {
    background-color: #BDC3C7;
  }
  .yellow {
    background-color: #F1C40F;
  }
  .text-dark-blue {
    color: #34495E;
  }
  .text-green {
    color: #16A085;
  }
  .text-blue {
    color: #2980B9;
  }
  .text-orange {
    color: #F39C12;
  }
  .text-red {
    color: #E74C3C;
  }
  .text-purple {
    color: #8E44AD;
  }
  .text-faded {
    color: rgba(255, 255, 255, 0.7);
  }
</style>
