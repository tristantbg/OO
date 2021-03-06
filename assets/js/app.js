/* globals $:false */
var width = $(window).width(),
    height = $(window).height(),
    isMobile = false,
    content,
    flkty,
    $root = '/';
$(function() {
    var app = {
        init: function() {
            $(window).resize(function(event) {});
            $(document).ready(function($) {
                $body = $('body');
                $header = $('header');
                $container = $('#container');
                $current = $('#current-project');
                $projectList = $('#project-list');
                $about = $('#about');
                app.sizeSet();
                History.Adapter.bind(window, 'statechange', function() {
                    var State = History.getState();
                    console.log(State);
                    content = State.data;
                    // if (content.type == 'index') {
                    //     app.loadContent(State.url, $container);
                    // }
                    app.loadContent(State.url, $container);
                });
                app.loadSlider();
                $('body').on('click', '[data-target]', function(e) {
                    $el = $(this);
                    target = $el.data('target');
                    e.preventDefault();
                    if (target == "project") {
                        $projectList.addClass('hidden');
                        History.pushState({
                            type: 'project',
                            title: $el.find('.project-title').html(),
                            id: $el.data('id')
                        }, $el.data('title') + " | " + $sitetitle, $el.attr('href'));
                    } else if (target == "about") {
                        $about.addClass('visible');
                    } else {
                        e.preventDefault();
                        app.goIndex();
                    }
                });
                $body.on('click touchend', '#current-project', function(event) {
                    if (isMobile) {
                        event.preventDefault();
                        $header.addClass('mobile-open');
                    }
                });
                var intro = true;
                $('#intro').click(function(event) {
                    event.preventDefault();
                    $body.addClass('intro-hidden');
                });
                $(document).bind('mousewheel', function(evt) {
                    if (intro) {
                        var delta = evt.originalEvent.wheelDelta;
                        if (delta < -10) {
                            $body.addClass('intro-hidden');
                            intro = false;
                        }
                    }
                });
                $about.click(function(event) {
                    $(this).removeClass('visible');
                });
                window.viewportUnitsBuggyfill.init();
                $(document).keyup(function(e) {
                    if (e.keyCode === 27) app.goIndex();
                    if (e.keyCode === 37 && $slider) app.goPrev($slider);
                    if (e.keyCode === 39 && $slider) {
                        if (app.checkLastCell(flkty)) {
                            app.nextProject();
                        } else {
                            app.goNext($slider);
                        }
                    }
                });
                $(window).load(function() {
                    $('#loader').fadeOut();
                });
            });
        },
        sizeSet: function() {
            width = $(window).width();
            height = $(window).height();
            if (width <= 770) isMobile = true;
            if (isMobile) {
                if (width >= 770) {
                    isMobile = false;
                }
            }
        },
        checkLastCell: function(flkty) {
            if (flkty.selectedIndex < flkty.cells.length - 1) {
                return false;
            } else {
                return true;
            }
        },
        nextProject: function() {
            var $selected = $(".project-link.active");
            var links = $('.project-link');
            $activeCat = links.eq((links.index($selected) + 1) % links.length).find('a').trigger('click');
        },
        loadSlider: function() {
            $slider = $('#slider').flickity({
                cellSelector: '.cell',
                imagesLoaded: true,
                lazyLoad: 2,
                setGallerySize: false,
                accessibility: false,
                wrapAround: false,
                prevNextButtons: false,
                pageDots: false,
                draggable: true
            });
            flkty = $slider.data('flickity');
            $caption = $('#slide-caption');
            var mainbackcolor = $slider.attr('data-backcolor');
            var maintextcolor = $slider.attr('data-textcolor');
            $slider.on('select.flickity', function() {
                if (flkty) {
                    var slidecaption = $(flkty.selectedElement).attr('data-caption');
                    if (typeof slidecaption !== typeof undefined) {
                        $caption.html(slidecaption);
                    } else {
                        $caption.empty();
                    }
                    var backcolor = $(flkty.selectedElement).attr('data-backcolor');
                    if (typeof backcolor !== typeof undefined) {} else {
                        if (typeof mainbackcolor !== typeof undefined) {
                            backcolor = mainbackcolor;
                        } else {
                            backcolor = '#fff';
                        }
                    }
                    var textcolor = $(flkty.selectedElement).attr('data-textcolor');
                    if (typeof textcolor !== typeof undefined) {} else {
                        if (typeof maintextcolor !== typeof undefined) {
                            textcolor = maintextcolor;
                        } else {
                            textcolor = '#000';
                        }
                    }
                    $current.css('background-color', backcolor);
                    $container.css('background-color', backcolor);
                    $body.css('color', textcolor);
                }
            });
            $slider.on('staticClick.flickity', function(event, pointer, cellElement, cellIndex) {
                if (!cellElement) {
                    return;
                }
                if (app.checkLastCell(flkty)) {
                    app.nextProject();
                } else {
                    app.goNext($slider);
                }
            });
            // $slider.click(function(event) {
            //     if (!isMobile) {
            //         event.preventDefault();
            //         if ($body.hasClass('hover-left')) {
            //             app.goPrev($slider);
            //         } else if ($body.hasClass('hover-right')) {
            //             app.goNext($slider);
            //         }
            //     }
            // });
        },
        goNext: function($slider) {
            $slider.flickity('next', false);
        },
        goPrev: function($slider) {
            $slider.flickity('previous', false);
        },
        goIndex: function() {
            var $first = $('#project-list .project-link').first();
            History.pushState({
                type: 'index',
                title: $first.find('.project-title').html(),
                id: $first.data('id')
            }, $sitetitle, window.location.origin + $root);
        },
        loadContent: function(url, target) {
            $body.removeClass('loaded').addClass('loading');
            setTimeout(function() {
                $body.scrollTop(0);
                $(target).load(url + ' #container .inner', function(response) {
                    setTimeout(function() {
                        app.loadSlider();
                        if (typeof content.type == typeof undefined) {
                            var $first = $('#project-list .project-link').first();
                            content.title = $first.find('.project-title').html();
                            content.id = $first.data('id');
                        }
                        setTimeout(function() {
                            $current.html(content.title);
                            $('.project-link').removeClass('active');
                            $('[data-id="' + content.id + '"]').parent().addClass('active');
                            $projectList.removeClass('hidden');
                        }, 200);
                        $header.removeClass('mobile-open');
                        $body.removeClass('loading').addClass('loaded');
                    }, 100);
                });
            }, 300);
        },
        deferImages: function() {
            var imgDefer = document.getElementsByTagName('img');
            for (var i = 0; i < imgDefer.length; i++) {
                if (imgDefer[i].getAttribute('data-src')) {
                    imgDefer[i].setAttribute('src', imgDefer[i].getAttribute('data-src'));
                }
            }
        }
    };
    app.init();
});