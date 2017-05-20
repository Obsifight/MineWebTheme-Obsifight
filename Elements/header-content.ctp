<div class="heading-title heading-border">
  <h1 style="background-color:transparent;">
    <em>Ouverture dans :</em>
    <br>
    <span style="color:#fff;" id="open-date"></span>
  </h1>
  <!--<h1 style="background-color:transparent;">Le saviez-vous ?</h1>
  <p class="font-lato size-19"><?= $didYouKnow[rand(0, (count($didYouKnow)-1))] ?></p>-->
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.13/moment-timezone-with-data.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.countdown/2.2.0/jquery.countdown.min.js"></script>
<script type="text/javascript">
  $("#open-date").countdown(moment.tz("2017-05-21 16:30:00", 'Europe/Paris').toDate(), function(event) {
    $(this).text(
      event.strftime('%H heures %M minutes %S secondes')
    )
  })
</script>
