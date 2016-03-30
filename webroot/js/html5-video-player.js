
/**
 *
 * HTML5 Responsive Video Player
 * For jQuery 1.7.1 and above
 *
 * @author  Rik de Vos
 * @link    http://rikdevos.com/
 * @version 1.0
 *
 * This is not free software. Visit http://codecanyon.net/user/RikdeVos to purchase a license
 *
 */

(function(e) {
    e.html5_video = function(t, n) {
        var r = this;
        r.$el = e(t);
        r.el = t;
        r.$el.data("html5_video", r);
        r.init = function() {
            r.options = e.extend({}, e.html5_video.defaultOptions, n);
            r.$el.addClass("resp");
            r.$controls = [];
            r.$title = null;
            r.$video = null;
            r.info = {
                duration: 0,
                volume: r.options.volume,
                state: "stop",
                time_drag: false,
                volume_drag: false,
                ie: r.detect_ie(),
                ie_previous_time: 0,
                touch: r.detect_touch(),
                first_load: false,
                ios: navigator.userAgent.match(/(iPad|iPhone|iPod)/g) ? true: false,
                ratio: false
            };
            r.completeloaded = false;
            r.create_video_element();
            r.create_controls();
            r.bind_controls();
            r.create_title();
            r.create_overlays();
            r.$el.hover(function() {
                r.show_controls()
            }, function() {
                if (r.options.show_controls_on_pause && r.$video[0].paused) {} else {
                    r.hide_controls()
                }
                r.hide_share()
            });
            r.init_time_slider();
            r.init_volume_slider();
            r.$video.on("canplay", r.hide_buffer);
            r.$video.on("click", r.play_pause);
            if (r.options.dblclick_fullscreen) {
                r.$video.on("dblclick", r.fullscreen)
            }
            r.$video.on("loadedmetadata", r.init_video);
            r.$video.on("timeupdate", r.video_time_update);
            r.$video.on("canplaythrough", function() {
                r.completeloaded = true
            });
            r.$video.on("ended", function() {
                r.$video[0].load();
                r.stop()
            });
            r.$video.on("seeking", function() {
                if (!r.completeloaded) {
                    r.show_buffer()
                }
            });
            r.$video.on("waiting", function() {
                r.show_buffer()
            });
            if (r.options.autoplay) {
                setTimeout(function() {
                    r.hide_controls()
                }, 1e3)
            } else {}
            if (r.options.show_controls_on_load || r.options.show_controls_on_pause) {
                r.show_controls()
            }
            if (r.info.ios) {
                r.$el.find(".resp-controls").remove();
                r.$title.css("opacity", 1);
                if (r.options.poster !== false) {
                    var t = new Image;
                    t.src = r.options.poster;
                    t.onload = function() {
                        r.info.ratio = this.width / this.height;
                        r.resize()
                    }
                }
            }
            if (r.options.width !== false) {
                r.$el.css("width", r.options.width)
            }
            if (r.info.ie !== false) {
                r.ie_fix()
            }
            e(window).on("resize", r.resize);
            r.resize();
            r.update_volume(0, r.options.volume)
        };
        r.create_video_element = function() {
            this.$video = e('<video width="100%"><p>Sorry, your browser does not support HTML5 video.</p></video>');
            if (r.options.autoplay) {
                this.$video.attr("autoplay", "autoplay")
            }
            if (this.options.poster !== false) {
                this.$video.attr("poster", this.options.poster);
                this.$el.css({
                    background: "url(" + this.options.poster + ") top left no-repeat",
                    "background-size": "100%"
                })
            }
            for (source in this.options.source) {
                e("<source />").attr("src", this.options.source[source]).attr("type", source).appendTo(this.$video)
            }
            this.$video.appendTo(this.$el)
        };
        r.create_controls = function() {
            var t = e('<div class="resp-controls"></div>');
            t.html('<div class="resp-controls-wrapper"><a href="#" class="resp-play fa fa-play"></a><div class="resp-time">00:00</div><div class="resp-bar"><div class="resp-bar-buffer"></div><div class="resp-bar-time"></div></div><div class="resp-volume"><a href="#" class="resp-volume-icon fa fa-volume-up" title="Toggle Mute"></a><div class="resp-volume-bar"><div class="resp-volume-amount"></div></div></div><a href="#" class="resp-share fa fa-share-square-o" title="Share"></a><a href="#" class="resp-fullscreen fa fa-expand" title="Toggle Fullscreen"></a></div>');
            r.$controls["play"] = t.find(".resp-play");
            r.$controls["time"] = t.find(".resp-time");
            r.$controls["time_bar"] = t.find(".resp-bar");
            r.$controls["time_bar_buffer"] = t.find(".resp-bar-buffer");
            r.$controls["time_bar_time"] = t.find(".resp-bar-time");
            r.$controls["volume"] = t.find(".resp-volume");
            r.$controls["volume_icon"] = t.find(".resp-volume-icon");
            r.$controls["volume_bar"] = t.find(".resp-volume-bar");
            r.$controls["volume_amount"] = t.find(".resp-volume-amount");
            r.$controls["share"] = t.find(".resp-share");
            r.$controls["fullscreen"] = t.find(".resp-fullscreen");
            if (!r.options.play_control) {
                r.$controls["play"].hide()
            }
            if (!r.options.time_indicator) {
                r.$controls["time"].hide()
            }
            if (!r.options.volume_control) {
                r.$controls["volume"].hide()
            }
            if (!r.options.share_control) {
                r.$controls["share"].hide()
            }
            if (!r.options.fullscreen_control) {
                r.$controls["fullscreen"].hide()
            }
            t.css({
                background: r.options.color
            });
            t.appendTo(this.$el)
        };
        r.create_title = function() {
            this.$title = e('<div class="resp-title"></div>');
            this.$title.html('<div class="resp-title-wrapper">' + this.options.title + "</div>");
            this.$title.appendTo(this.$el);
            if (r.options.title == "" || r.options.title == false) {
                r.$title.hide()
            }
        };
        r.create_overlays = function() {
            r.$loading = e('<div class="resp-loading resp-center">' + r.options.buffering_text + "</div>");
            r.$loading.appendTo(r.$el);
            if (!r.info.ios) {
                r.$loading.css("display", "inline-block")
            }
            r.$big_play = e('<a href="#" class="resp-big-play resp-center fa fa-play"></a>').click(function(e) {
                e.preventDefault();
                r.play()
            }).appendTo(r.$el);
            r.$big_replay = e('<a href="#" class="resp-big-replay resp-center fa fa-undo"></a>').click(function(e) {
                e.preventDefault();
                r.play()
            }).appendTo(r.$el);
            r.$social = e('<div class="resp-social" data-show="0"><a href="#" class="resp-social-button resp-social-google fa fa-google-plus"></a><a href="#" class="resp-social-button resp-social-twitter fa fa-twitter"></a><a href="#" class="resp-social-button resp-social-facebook fa fa-facebook"></a></div>').appendTo(r.$el);
            r.$social.find(".resp-social-facebook").click(function(e) {
                e.preventDefault();
                r.share_facebook()
            });
            r.$social.find(".resp-social-twitter").click(function(e) {
                e.preventDefault();
                r.share_twitter()
            });
            r.$social.find(".resp-social-google").click(function(e) {
                e.preventDefault();
                r.share_google()
            })
        };
        r.share_link = function() {}, r.share_facebook = function() {
            window.open("https://www.facebook.com/sharer/sharer.php?u=" + r.share_url(), "Share on Facebook", "height=300,width=600")
        }, r.share_twitter = function() {
            window.open("https://twitter.com/home?status=" + r.share_url(), "Share on Twitter", "height=300,width=600")
        }, r.share_google = function() {
            window.open("https://plus.google.com/share?url=" + r.share_url(), "Share on Google+", "height=300,width=600")
        }, r.bind_controls = function() {
            r.$controls["play"].click(function(e) {
                e.preventDefault();
                r.play_pause()
            });
            r.$controls["fullscreen"].click(function(e) {
                e.preventDefault();
                r.fullscreen()
            });
            r.$controls["volume_icon"].click(function(e) {
                e.preventDefault();
                if (r.$video[0].volume == 0) {
                    if (r.info.volume == 0) {
                        r.info.volume = r.options.volume
                    }
                    r.update_volume(0, r.info.volume)
                } else {
                    var t = r.$video[0].volume;
                    r.update_volume(0, 0);
                    r.info.volume = t
                }
            });
            r.$controls["share"].click(function(e) {
                e.preventDefault();
                r.toggle_share()
            })
        };
        r.show_controls = function() {
            r.$el.find(".resp-controls").stop().animate({
                bottom: 0
            }, 250);
            r.$title.stop().animate({
                opacity: 1
            }, 250)
        };
        r.hide_controls = function() {
            r.$el.find(".resp-controls").stop().animate({
                bottom: - 50
            }, 250);
            r.$title.stop().animate({
                opacity: 0
            }, 250)
        };
        r.init_video = function() {
            r.$video.removeAttr("controls");
            r.info.duration = r.$video[0].duration;
            setTimeout(r.start_buffer, 150);
            r.resize()
        };
        r.video_time_update = function() {
            var e = r.$video[0].currentTime;
            var t = r.$video[0].duration;
            var n = 100 * e / t;
            r.$controls["time_bar_time"].css("width", n + "%");
            r.$controls["time"].html(r.format_time(e));
            r.options.on_time_update(r.$video[0].currentTime)
        };
        r.start_buffer = function() {
            var e = r.$video[0].buffered.end(0), t = 100 * e / r.info.duration;
            if (t > 100) {
                t = 100
            }
            r.$controls["time_bar_buffer"].css("width", t + "%");
            if (e < r.info.duration) {
                setTimeout(r.start_buffer, 500)
            }
        };
        r.hide_buffer = function() {
            if (r.info.first_load == false && r.options.autoplay == false) {
                if (!r.info.ios) {
                    r.$big_play.show()
                }
                r.info.first_load = true
            }
            r.$loading.hide()
        };
        r.show_buffer = function() {
            if (r.info.ios) {
                return
            }
            r.$loading.show()
        };
        r.play_pause = function() {
            if (r.$video[0].paused || r.$video[0].ended) {
                r.play()
            } else {
                r.pause()
            }
        };
        r.play = function() {
            r.$video[0].play();
            r.info.state = "play";
            r.$controls["play"].removeClass("fa-play").addClass("fa-pause").removeClass("fa-undo");
            r.$big_play.hide();
            r.$big_replay.hide();
            r.hide_share();
            r.options.on_play()
        };
        r.pause = function() {
            r.$video[0].pause();
            r.info.state = "pause";
            r.$controls["play"].addClass("fa-play").removeClass("fa-pause").removeClass("fa-undo");
            r.$big_play.hide();
            r.$big_replay.hide();
            r.options.on_pause()
        };
        r.stop = function() {
            r.$video[0].pause();
            r.info.state = "stop";
            r.$controls["play"].removeClass("fa-play").removeClass("fa-pause").addClass("fa-undo");
            r.show_controls();
            r.$big_play.hide();
            if (!r.info.ios) {
                r.$big_replay.show()
            }
            if (r.options.share_control) {
                r.show_share()
            }
            r.options.on_stop()
        };
        r.fullscreen = function() {
            var e = r.$video[0];
            if (e.requestFullscreen) {
                e.requestFullscreen()
            } else if (e.webkitRequestFullscreen) {
                e.webkitRequestFullscreen()
            } else if (e.mozRequestFullScreen) {
                e.mozRequestFullScreen()
            } else if (e.msRequestFullscreen) {
                e.msRequestFullscreen()
            } else {
                alert("Your browser doesn't support fullscreen")
            }
        };
        r.resize = function() {
            var t = r.$el.innerWidth(), n = r.$el.innerHeight();
            var i = t - 20;
            if (r.options.play_control) {
                i -= 30
            }
            if (r.options.time_indicator) {
                i -= 58
            }
            if (r.options.volume_control) {
                i -= 110
            }
            if (r.options.share_control) {
                i -= 30
            }
            if (r.options.fullscreen_control) {
                i -= 30
            }
            i -= 18;
            r.$controls["time_bar"].css("width", i);
            r.$el.find(".resp-center").each(function() {
                var r = e(this).width(), i = e(this).height();
                e(this).css({
                    left: t / 2 - r / 2,
                    top: n / 2 - i / 2
                })
            });
            if (r.info.ios && r.info.ratio !== false) {
                r.$video.attr("height", t / r.info.ratio).css("height", t / r.info.ratio);
                r.$el.css("height", t / r.info.ratio)
            }
        };
        r.init_time_slider = function() {
            r.$controls["time_bar"].on("mousedown", function(e) {
                r.info.time_drag = true;
                r.update_time_slider(e.pageX)
            });
            e(document).on("mouseup", function(e) {
                if (r.info.time_drag) {
                    r.info.time_drag = false;
                    r.update_time_slider(e.pageX)
                }
            });
            e(document).on("mousemove", function(e) {
                if (r.info.time_drag) {
                    r.update_time_slider(e.pageX)
                }
            })
        };
        r.update_time_slider = function(e) {
            var t = r.info.duration;
            var n = e - r.$controls["time_bar"].offset().left;
            var i = 100 * n / r.$controls["time_bar"].width();
            if (i > 100) {
                i = 100
            }
            if (i < 0) {
                i = 0
            }
            r.$controls["time_bar_time"].css("width", i + "%");
            r.$video[0].currentTime = t * i / 100;
            r.options.on_seek(r.$video[0].currentTime)
        };
        r.init_volume_slider = function() {
            r.$controls["volume_bar"].on("mousedown", function(e) {
                r.info.volume_drag = true;
                r.$video[0].muted = false;
                r.$controls["volume_icon"].removeClass("fa-volume-off").addClass("fa-volume-up");
                r.update_volume(e.pageX)
            });
            e(document).on("mouseup", function(e) {
                if (r.info.volume_drag) {
                    r.info.volume_drag = false;
                    r.update_volume(e.pageX)
                }
            });
            e(document).on("mousemove", function(e) {
                if (r.info.volume_drag) {
                    r.update_volume(e.pageX)
                }
            })
        };
        r.update_volume = function(e, t) {
            var n;
            if (t) {
                n = t * 100
            } else {
                var i = e - r.$controls["volume_bar"].offset().left;
                n = 100 * i / r.$controls["volume_bar"].width()
            }
            if (n > 100) {
                n = 100
            }
            if (n < 0) {
                n = 0
            }
            r.$controls["volume_amount"].css("width", n + "%");
            r.$video[0].volume = n / 100;
            r.info.volume = r.$video[0].volume;
            if (r.$video[0].volume == 0) {
                r.$controls["volume_icon"].addClass("fa-volume-off").removeClass("fa-volume-up")
            } else {
                r.$controls["volume_icon"].removeClass("fa-volume-off").addClass("fa-volume-up")
            }
            r.options.on_volume(r.info.volume)
        };
        r.toggle_share = function() {
            if (r.$social.attr("show") == "1") {
                r.hide_share()
            } else {
                r.show_share()
            }
        };
        r.show_share = function() {
            if (r.info.ios) {
                return
            }
            r.$social.attr("show", "1").stop().animate({
                right: 10
            }, 200)
        };
        r.hide_share = function() {
            r.$social.attr("show", "0").stop().animate({
                right: - 140
            }, 200)
        };
        r.format_time = function(e) {
            var t = Math.floor(e / 60) < 10 ? "0" + Math.floor(e / 60): Math.floor(e / 60), n = Math.floor(e - t * 60) < 10 ? "0" + Math.floor(e - t * 60): Math.floor(e - t * 60);
            return t + ":" + n
        };
        r.share_url = function() {
            return window.location.href
        };
        r.detect_ie = function() {
            var e = window.navigator.userAgent;
            var t = e.indexOf("MSIE ");
            var n = e.indexOf("Trident/");
            if (t > 0) {
                return parseInt(e.substring(t + 5, e.indexOf(".", t)), 10)
            }
            if (n > 0) {
                var r = e.indexOf("rv:");
                return parseInt(e.substring(r + 3, e.indexOf(".", r)), 10)
            }
            return false
        };
        r.detect_touch = function() {
            return !!("ontouchstart"in window)||!!("onmsgesturechange"in window)
        };
        r.ie_fix = function() {
            setInterval(function() {
                var e = r.$video[0].currentTime;
                if (e - r.info.ie_previous_time == e) {} else {
                    r.hide_buffer()
                }
                r.info.ie_previous_time = e
            }, 50)
        };
        r.init()
    };
    e.html5_video.defaultOptions = {
        source: [],
        title: "",
        color: "#e6bc57",
        width: false,
        poster: false,
        buffering_text: "Buffering",
        autoplay: false,
        play_control: true,
        time_indicator: true,
        volume_control: true,
        share_control: true,
        fullscreen_control: true,
        dblclick_fullscreen: true,
        volume: .7,
        show_controls_on_load: true,
        show_controls_on_pause: true,
        on_play: function() {},
        on_pause: function() {},
        on_stop: function() {},
        on_seek: function(e) {},
        on_volume: function(e) {},
        on_time_update: function(e) {}
    };
    e.fn.html5_video = function(t) {
        return this.each(function() {
            new e.html5_video(this, t)
        })
    };
    e.fn.html5_video_play = function() {
        return this.each(function() {
            new e.html5_video_play(this)
        })
    };
    e.html5_video_play = function(t) {
        var n = e(t), r = n.data("html5_video");
        r.play()
    };
    e.fn.html5_video_pause = function() {
        return this.each(function() {
            new e.html5_video_pause(this)
        })
    };
    e.html5_video_pause = function(t) {
        var n = e(t), r = n.data("html5_video");
        r.pause()
    };
    e.fn.html5_video_stop = function() {
        return this.each(function() {
            new e.html5_video_stop(this)
        })
    };
    e.html5_video_stop = function(t) {
        var n = e(t), r = n.data("html5_video");
        n.html5_video_seek(r.info.duration)
    };
    e.fn.html5_video_seek = function(t) {
        return this.each(function() {
            new e.html5_video_seek(this, t)
        })
    };
    e.html5_video_seek = function(t, n) {
        var r = e(t), i = r.data("html5_video");
        var s = i.info.duration, o = n / s * 100;
        i.$controls["time_bar_time"].css("width", o + "%");
        i.$video[0].currentTime = n;
        i.options.on_seek(n)
    };
    e.fn.html5_video_volume = function(t) {
        return this.each(function() {
            new e.html5_video_volume(this, t)
        })
    };
    e.html5_video_volume = function(t, n) {
        var r = e(t), i = r.data("html5_video");
        i.update_volume(0, n)
    }
})(jQuery);
