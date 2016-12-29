<section>
  <div class="container">


    <div class="alert alert-default">
      <p>Toutes ces statistiques sont calculés sur le serveur <b>PvP-Factions</b> et à <b>but informative</b>.</p>
    </div>

  	<div class="row">

  		<!-- LEFT -->
  		<div class="col-md-3 col-sm-3">

  			<!-- INLINE SEARCH -->
  			<div class="inline-search clearfix margin-bottom-30">
          <div class="autosuggest" data-minLength="2" data-queryURL="<?= $this->Html->url('/stats/search/user/') ?>">
  					<input type="search" placeholder="Chercher un joueur" name="src" class="form-control typeahead">
          </div>
  			</div>
  			<!-- /INLINE SEARCH -->

        <div class="divider divider-circle divider-center"><!-- divider -->
        	<i class="fa fa-users"></i>
        </div>

        <div class="heading-title heading-border-bottom">
        	<h3 style="border-bottom: 2px solid #DA3737;margin-bottom: -2px;">Administrateurs</h3>
        </div>

        <?php
        foreach ($staff['administrators'] as $key => $value) {
          echo '<a href="'.$this->Html->url('/stats/'.$value).'">';
            echo '<img width="64" heigt="64"';
            if(in_array($value, $usersOnlines)) {
              echo ' style="border-color:#27ae60;" ';
            }
            echo 'data-toggle="tooltip" data-placement="top" title="'.$value.'" src="http://web.skins.obsifight.fr/head/'.$value.'" class="img-rounded staff-img" alt="">';
          echo '</a>';
        }
        ?>

        <div class="heading-title heading-border-bottom margin-top-30">
        	<h3 style="border-bottom: 2px solid #DA3737;margin-bottom: -2px;">Développeurs</h3>
        </div>

        <?php
        foreach ($staff['developers'] as $key => $value) {
          echo '<a href="'.$this->Html->url('/stats/'.$value).'">';
            echo '<img width="64" heigt="64"';
            if(in_array($value, $usersOnlines)) {
              echo ' style="border-color:#27ae60;" ';
            }
            echo 'data-toggle="tooltip" data-placement="top" title="'.$value.'" src="http://web.skins.obsifight.fr/head/'.$value.'" class="img-rounded staff-img" alt="">';
          echo '</a>';
        }
        ?>

        <div class="heading-title heading-border-bottom margin-top-30">
        	<h3 style="border-bottom: 2px solid #2ecc71;margin-bottom: -2px;">Modérateurs</h3>
        </div>

        <?php
        foreach ($staff['moderators'] as $key => $value) {
          echo '<a href="'.$this->Html->url('/stats/'.$value).'">';
            echo '<img width="64" heigt="64"';
            if(in_array($value, $usersOnlines)) {
              echo ' style="border-color:#27ae60;" ';
            }
            echo 'data-toggle="tooltip" data-placement="top" title="'.$value.'" src="http://web.skins.obsifight.fr/head/'.$value.'" class="img-rounded staff-img" alt="">';
          echo '</a>';
        }
        ?>

        <div class="heading-title heading-border-bottom margin-top-30">
        	<h3 style="border-bottom: 2px solid #f1c40f;margin-bottom: -2px;">Supports</h3>
        </div>

        <?php
        foreach ($staff['supports'] as $key => $value) {
          echo '<a href="'.$this->Html->url('/stats/'.$value).'">';
            echo '<img width="64" heigt="64"';
            if(in_array($value, $usersOnlines)) {
              echo ' style="border-color:#27ae60;" ';
            }
            echo 'data-toggle="tooltip" data-placement="top" title="'.$value.'" src="http://web.skins.obsifight.fr/head/'.$value.'" class="img-rounded staff-img" alt="">';
          echo '</a>';
        }
        ?>

        <div class="heading-title heading-border-bottom margin-top-30">
        	<h3 style="border-bottom: 2px solid #9b59b6;margin-bottom: -2px;">Animateurs</h3>
        </div>

        <?php
        foreach ($staff['animators'] as $key => $value) {
          echo '<a href="'.$this->Html->url('/stats/'.$value).'">';
            echo '<img width="64" heigt="64"';
            if(in_array($value, $usersOnlines)) {
              echo ' style="border-color:#27ae60;" ';
            }
            echo 'data-toggle="tooltip" data-placement="top" title="'.$value.'" src="http://web.skins.obsifight.fr/head/'.$value.'" class="img-rounded staff-img" alt="">';
          echo '</a>';
        }
        ?>

  			</div>

    		<!-- RIGHT -->
    		<div class="col-md-9 col-sm-9">

          <div class="row margin-bottom-30">
            <div class="col-md-4">
              <div class="stats-block">
                <h4 class="countTo" data-speed="5000"><?= $maxPlayers ?></h4>
                <p>Record de joueurs</p>
              </div>
            </div>

            <div class="col-md-4">
              <div class="stats-block">
                <h4 class="countTo" data-speed="5000"><?= $server_infos['getPlayerCount'] ?></h4>
                <p>Joueurs en ligne</p>
              </div>
            </div>

            <div class="col-md-4">
              <div class="stats-block">
                <h4 class="countTo" data-speed="5000"><?= $usersRegistered ?></h4>
                <p>Joueurs inscrits</p>
              </div>
            </div>
          </div>

          <div class="heading-title heading-border">
          	<h2>Statistiques des <span>joueurs</span></h2>
          	<p class="font-lato size-17">Calculés sur les 7 derniers jours</p>
          </div>

            <div class="margin-bottom-30" id="players">
              <div class="alert alert-info">Chargement du graphique en cours ...</div>
            </div>

            <div class="heading-title heading-line-single">
            	<h4>Les heures avec le <span>plus de connectés</span></h4>
            </div>

            <div class="row margin-bottom-30">

              <div class="col-md-6">
                <div id="peakTimesHours">
                  <div class="alert alert-info">Chargement du graphique en cours ...</div>
                </div>
              </div>

              <div class="col-md-6">
                <div id="peakTimesDays">
                  <div class="alert alert-info">Chargement du graphique en cours ...</div>
                </div>
              </div>

            </div>

          <div class="heading-title heading-border">
          	<h2>Statistiques des <span>visites</span></h2>
          	<p class="font-lato size-17">Calculés sur les 7 derniers jours</p>
          </div>

            <div class="margin-bottom-30" id="visits">
              <div class="alert alert-info">Chargement du graphique en cours ...</div>
            </div>

          <div class="heading-title heading-border">
          	<h2>Statistiques des <span>inscriptions</span></h2>
          	<p class="font-lato size-17">Calculés sur les 7 derniers jours</p>
          </div>

            <div class="margin-bottom-30" id="register">
              <div class="alert alert-info">Chargement du graphique en cours ...</div>
            </div>

            <div class="row countTo-lg text-center">

            	<div class="col-xs-6 col-sm-4">
            		<span class="count" style="color:#9b59b6"><span class="countTo" data-speed="3000"><?= $percentageRegisteredUsersOnV6 ?></span>%</span>
            		<h4>Joueurs inscrit lors de la V6</h4>
            	</div>

            	<div class="col-xs-6 col-sm-4">
            		<span class="count" style="color:#9b59b6"><span class="countTo" data-speed="3000"><?= $percentageConnectedUsersOnV6 ?></span>%</span>
            		<h4>Joueurs s'étant connecté lors de la V6</h4>
            	</div>

            	<div class="col-xs-6 col-sm-4">
            		<span class="count" style="color:#9b59b6">+<span class="countTo" data-speed="3000"><?= $percentageRegisteredUsersThisWeek ?></span>%</span>
            		<h4>Joueurs inscrits cette semaine</h4>
            	</div>

            </div>

  		  </div>
      </div>

  	</div>


  </div>
</section>


<?= $this->Html->script('handlebars') ?>
<?= $this->Html->script('highcharts') ?>
<?= $this->Html->script('moment.min') ?>
<?= $this->Html->script('moment-timezone-with-data-2010-2020.min') ?>
<script type="text/javascript">

  /*
    Fonction de recherche
  */

    function _autosuggest() {
      _container = jQuery("div.autosuggest"), _container.length > 0 && loadScript("/theme/Obsifight/js/typeahead.bundle.js", function() {
          jQuery().typeahead && _container.each(function() {
              var e = jQuery(this), t = e.attr("data-minLength") || 1, a = e.attr("data-queryURL"), r = e.attr("data-limit") || 10, i = e.attr("data-autoload");
              if ("false" == i)
                  return !1;
              var n = new Bloodhound({
                  datumTokenizer: Bloodhound.tokenizers.obj.whitespace("value"),
                  queryTokenizer: Bloodhound.tokenizers.whitespace,
                  limit: r,
                  remote: {
                      url: a + "%QUERY",
                      wildcard: '%QUERY'
                  }
              });
              jQuery(".typeahead", e).typeahead({
                  limit: r,
                  hint: "false" == e.attr("data-hint")?!1: !0,
                  highlight: "false" == e.attr("data-highlight")?!1: !0,
                  minLength: parseInt(t),
                  cache: !1
              }, {
                  name: "_typeahead",
                  source: n,
                  templates: {
                    suggestion: function (data) {
                      return '<div><a href="<?= $this->Html->url('/stats/') ?>'+data+'">'+data+'</a></div>';
                    }
                  }
              })
          })
      })
    }
    $(function() {
      _autosuggest();

      $('input[type="search"]').keyup(function (e) {
        if (e.keyCode == 13) {
          window.location = '<?= $this->Html->url('/stats/') ?>'+$('input[name="src"]').val();
        }
      });
    });
  /*
    Tooltip des images du staff
  */

    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    });

  /*
    Graph des heures les plus populaires (5)
  */

  // Build the chart

      Highcharts.getOptions().plotOptions.pie.colors = (function () {
        var colors = [],
            base = "#49a2df",
            i;

        for (i = 0; i < 10; i += 1) {
            // Start out with a darkened base color (negative brighten), and end
            // up with a much brighter color
            colors.push(Highcharts.Color(base).brighten((i - 3) / 7).get());
        }
        return colors;
      }());

      $('#peakTimesHours').highcharts({
          chart: {
              plotBackgroundColor: null,
              plotBorderWidth: null,
              plotShadow: false,
              type: 'pie'
          },
          title: {
              text: 'Heures les plus fréquentées'
          },
          tooltip: {
              pointFormat: '{series.name}: <b>~{point.y} joueurs</b>'
          },
          plotOptions: {
              pie: {
                  allowPointSelect: true,
                  cursor: 'pointer',
                  dataLabels: {
                      enabled: false,
                      style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                      }
                  },
                  showInLegend: true
              }
          },
          series: [{
              name: 'Connectés',
              colorByPoint: true,
              <?php
              echo "data: [";
              if(isset($peakTimes['hours'])) {
                foreach ($peakTimes['hours'] as $hour => $players) {

                  echo "{";
                    echo "name: '{$hour}h',";
                    echo "y: $players";
                  echo "},";

                }
              }
              echo "]";

              ?>
          }]
      });

  /*
    Graph des jours les plus populaires (5)
  */

  Highcharts.getOptions().plotOptions.pie.colors = (function () {
    var colors = [],
        base = "#2981ba",
        i;

    for (i = 0; i < 10; i += 1) {
        // Start out with a darkened base color (negative brighten), and end
        // up with a much brighter color
        colors.push(Highcharts.Color(base).brighten((i - 3) / 7).get());
    }
    return colors;
  }());

  $('#peakTimesDays').highcharts({
      chart: {
          plotBackgroundColor: null,
          plotBorderWidth: null,
          plotShadow: false,
          type: 'pie'
      },
      title: {
          text: 'Jours les plus fréquentés'
      },
      tooltip: {
          pointFormat: '{series.name}: <b>~{point.y} joueurs</b>'
      },
      plotOptions: {
          pie: {
              allowPointSelect: true,
              cursor: 'pointer',
              dataLabels: {
                  enabled: false,
                  style: {
                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                  }
              },
              showInLegend: true
          }
      },
      series: [{
          name: 'Connectés',
          colorByPoint: true,
          <?php
          echo "data: [";
          if(isset($peakTimes['days'])) {
            foreach ($peakTimes['days'] as $day => $players) {

              echo "{";
                echo "name: '{$day}',";
                echo "y: $players";
              echo "},";

            }
          }
          echo "]";

          ?>
      }]
  });

  /*
    Graph des visites
  */

    $.get('<?= $this->Html->url('/obsiapi/stats/getVisits') ?>', function(visits) {

      Highcharts.theme = {
        colors: ["#27AE60"],
        chart: {
          backgroundColor: "#fff"
        }
      }

      Highcharts.setOptions(Highcharts.theme);

      Highcharts.setOptions({
          global: {
              getTimezoneOffset: function (timestamp) {
                  var zone = 'Europe/Paris',
                      timezoneOffset = -moment.tz(timestamp, zone).utcOffset();

                  return timezoneOffset;
              }
          }
      });

      // On set la légende (date)

      three_days_before = new Date();
      three_days_before.setDate(three_days_before.getDate()-3);

      four_days_before = new Date();
      four_days_before.setDate(four_days_before.getDate()-4);

      five_days_before = new Date();
      five_days_before.setDate(five_days_before.getDate()-5);

      six_days_before = new Date();
      six_days_before.setDate(six_days_before.getDate()-6);

      seven_days_before = new Date();
      seven_days_before.setDate(seven_days_before.getDate()-7);

      var visitsChartObj = new Highcharts.Chart({
        chart: {
            zoomType: 'x',
            type: 'column',
            renderTo: 'visits'
        },
        title: {
            text: false
        },
        subtitle: {
            text: false
        },
        xAxis: {
          categories: [
            seven_days_before.toLocaleString(),
            six_days_before.toLocaleString(),
            five_days_before.toLocaleString(),
            four_days_before.toLocaleString(),
            three_days_before.toLocaleString(),
            'Avant-hier',
            'Hier',
            'Aujourd\'hui',
          ],
          crosshair: true,
          labels: {
            enabled : false,
          },
        },
        yAxis: {
          min: 0,
          title: {
              text: 'Visites'
          }
        },
        legend: {
            enabled: false
        },
        tooltip: {
            shared: true,
            valueSuffix: ' visites',
            formatter: function() {
                var s = '<span style="font-size: 10px">'+ this.x +'</span>';
                var sortedPoints = this.points.sort(function(a, b){
                    return ((a.y > b.y) ? -1 : ((a.y < b.y) ? 1 : 0));
                });

                $.each(sortedPoints , function(i, point) {
                    s += '<br/><b>'+ point.y + " visites</b>";
                });

                return s;
            }
        },
        plotOptions: {
            spline: {
                lineWidth: 3,
                states: {
                    hover: {
                        lineWidth: 4
                    }
                },
                marker: {
                    //enabled: true
                    enabled : false
                },
            }
        },
        series: [{
            name: 'ObsiFight',
            data: [
              parseInt(visits['visits_seven_days_before']),
              parseInt(visits['visits_six_days_before']),
              parseInt(visits['visits_five_days_before']),
              parseInt(visits['visits_four_days_before']),
              parseInt(visits['visits_three_days_before']),
              parseInt(visits['visits_before_yesterday']),
              parseInt(visits['visits_yesterday']),
              parseInt(visits['visits_today'])
            ]
        }]
      });

    });

  /*
    Graph users
  */

    Highcharts.theme = {
      colors: ["#8E44AD"],
      chart: {
        backgroundColor: "#fff"
      }
    }

    Highcharts.setOptions(Highcharts.theme);

    Highcharts.setOptions({
      global: {
          getTimezoneOffset: function (timestamp) {
              var zone = 'Europe/Paris',
                  timezoneOffset = -moment.tz(timestamp, zone).utcOffset();

              return timezoneOffset;
          }
      }
    });

    // On set la légende (date)

    three_days_before = new Date();
    three_days_before.setDate(three_days_before.getDate()-3);

    four_days_before = new Date();
    four_days_before.setDate(four_days_before.getDate()-4);

    five_days_before = new Date();
    five_days_before.setDate(five_days_before.getDate()-5);

    six_days_before = new Date();
    six_days_before.setDate(six_days_before.getDate()-6);

    seven_days_before = new Date();
    seven_days_before.setDate(seven_days_before.getDate()-7);

    var usersChartObj = new Highcharts.Chart({
      chart: {
        zoomType: 'x',
        type: 'column',
        renderTo: 'register'
      },
      title: {
        text: false
      },
      subtitle: {
        text: false
      },
      xAxis: {
        categories: [
          seven_days_before.toLocaleString(),
          six_days_before.toLocaleString(),
          five_days_before.toLocaleString(),
          four_days_before.toLocaleString(),
          three_days_before.toLocaleString(),
          'Avant-hier',
          'Hier',
          'Aujourd\'hui',
        ],
        crosshair: true,
        labels: {
          enabled : false,
        },
      },
      yAxis: {
        min: 0,
        title: {
            text: 'Inscriptions'
        }
      },
      legend: {
          enabled: false
      },
      tooltip: {
        shared: true,
        valueSuffix: ' inscriptions',
        formatter: function() {
            var s = '<span style="font-size: 10px">'+ this.x +'</span>';
            var sortedPoints = this.points.sort(function(a, b){
                return ((a.y > b.y) ? -1 : ((a.y < b.y) ? 1 : 0));
            });

            $.each(sortedPoints , function(i, point) {
                s += '<br/><b>'+ point.y + " inscriptions</b>";
            });

            return s;
        }
      },
      plotOptions: {
        spline: {
          lineWidth: 3,
          states: {
            hover: {
              lineWidth: 4
            }
          },
          marker: {
            enabled : false
          },
        }
      },
      series: [{
        name: 'ObsiFight',
        data: [
          <?= $registersUsers['seven_days_before'] ?>,
          <?= $registersUsers['six_days_before'] ?>,
          <?= $registersUsers['five_days_before'] ?>,
          <?= $registersUsers['four_days_before'] ?>,
          <?= $registersUsers['three_days_before'] ?>,
          <?= $registersUsers['before_yesterday'] ?>,
          <?= $registersUsers['yesterday'] ?>,
          <?= $registersUsers['today'] ?>
        ]
      }]
    });

    console.log(usersChartObj);

  /*
    Players
  */

  Highcharts.theme = {
    colors: ["#2980B9"],
    chart: {
      backgroundColor: "#fff"
    }
  }

  Highcharts.setOptions(Highcharts.theme);

  Highcharts.setOptions({
      global: {

          getTimezoneOffset: function (timestamp) {
              var zone = 'Europe/Paris',
                  timezoneOffset = -moment.tz(timestamp, zone).utcOffset();

              return timezoneOffset;
          }
      }
  });

  var data = '<?= $onlinePlayers ?>';
  data = JSON.parse(data);
  data.reverse()

  var playersChart = new Highcharts.Chart({
    chart: {
        zoomType: 'x',
        type: 'area',
        renderTo: 'players'
    },
    title: {
        text: false
    },
    subtitle: {
        text: 'Cliquez et glissez pour zoomer.'
    },
    xAxis: {
      type: 'datetime'
    },
    yAxis: {
        title: {
            text: 'Joueurs'
        },
        floor: 0
    },
    legend: {
        enabled: false
    },
    tooltip: {
        shared: true,
        valueSuffix: ' joueurs',
        formatter: function() {
            var s = '<span style="font-size: 10px">'+ new Date(this.x).toLocaleString(); +'</span>';
            var sortedPoints = this.points.sort(function(a, b){
                return ((a.y > b.y) ? -1 : ((a.y < b.y) ? 1 : 0));
            });

            $.each(sortedPoints , function(i, point) {
                s += '<br/><b>'+ point.y + " joueurs</b>";
            });

            return s;
        }
    },
    plotOptions: {
        spline: {
            lineWidth: 3,
            states: {
                hover: {
                    lineWidth: 4
                }
            },
            marker: {
                enabled : false
            },
        }
    },
    series: [{
        name: 'ObsiFight',
        data: data
    }]
  });
  console.log(playersChart);

</script>
