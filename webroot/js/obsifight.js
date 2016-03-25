function kFormatter(num) {
  //num = num > 999 ? (num/1000).toFixed(1) + 'k' : num
  if(num > 999) {
    num = (num/1000).toFixed(1);
    if(num.split('.')[1] !== undefined && num.split('.')[1] == '0') {
      num = num.split('.')[0];
    }
    num = num + 'k';
  } else {
    num = Math.round(num, 1);
  }
  return num
}

function addSmooth(element, data, round, duration) {
  if(duration === undefined) {
    var duration = 5000;
  }
  if(round === undefined) {
    round = false;
  }
  $({someValue: 0}).animate({someValue: data}, {
      duration: duration,
      easing:'swing', // can be anything
      step: function() { // called on every step
          // Update the element's text with rounded-up value:
          var value = (round) ? Math.round(this.someValue) : kFormatter(this.someValue);
          $(element).html(value);
      }
  });
}

function refreshCountTo() {
  $('.countTo').each(function(e) {
    var val = $(this).html();
    $(this).html('0');

    var el = $(this);
    var init = ($(el).hasClass('counted')) ? true : false;

    if(!init) {
      $(el).addClass('counted');

      if(isScrolledIntoView(el)) {
        addSmooth($(el), val, false, parseInt($(el).attr('data-speed')));
        init = true;
      }

      $(document).scroll(function(e) {
        if(!init) {
          if(isScrolledIntoView(el)) {
            addSmooth($(el), val, false, parseInt($(el).attr('data-speed')));
            init = true;
          }
        }
      });
    }
  })
}

refreshCountTo();

function isScrolledIntoView(elem)
{
    var $elem = $(elem);
    var $window = $(window);

    var docViewTop = $window.scrollTop();
    var docViewBottom = docViewTop + $window.height();

    var elemTop = $elem.offset().top;
    var elemBottom = elemTop + $elem.height();

    return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
}


function debounce(callback, delay) {
    var timer = null;
    return function(){
        var context = this;
        var args = arguments;
        clearTimeout(timer);
        timer = setTimeout(function(){
            callback.apply(context, args);
        }, delay);
    }
}

function validateEmail(email) {
    var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
    return re.test(email);
}

var _arr = {};
function loadScript(e, t) {
  if (_arr[e])
    t && t();
  else {
    _arr[e]=!0;
    var a = document.getElementsByTagName("body")[0], r = document.createElement("script");
    r.type = "text/javascript", r.src = e, r.onload = t, a.appendChild(r)
  }
}
var e = jQuery(".piechart");
e.length > 0 && loadScript("/theme/Obsifight/js/jquery.easypiechart.min.js", function() {
  jQuery(".piechart").each(function() {
    var e = jQuery(this), t = e.attr("data-size") || 150, a = e.attr("data-animate") || "3000";
    e.easyPieChart({
      size: t,
      animate: a,
      scaleColor: !1,
      trackColor: e.attr("data-trackcolor") || "rgba(0,0,0,0.04)",
      lineWidth: e.attr("data-width") || "2",
      lineCap: "square",
      barColor: e.attr("data-color") || "#0093BF"
    }), jQuery("span", this).attr("style", "line-height:" + t + "px !important; height:" + t + "px; width:" + t + "px"), jQuery("i", this).attr("style", "line-height:" + t + "px !important; height:" + t + "px; width:" + t + "px")
  })
})
