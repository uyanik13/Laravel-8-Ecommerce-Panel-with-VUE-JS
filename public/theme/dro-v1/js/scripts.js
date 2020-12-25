(function( $ ) {
    "use strict";
    
    $('.woocommerce-form-coupon-toggle .showcoupon').on("click", function(){
        $(this).toggleClass( "active" );
        if ($(this).hasClass( "active" )) {
            $('.woocommerce-form-coupon').stop(true, true).slideDown();
        }else{
            $('.woocommerce-form-coupon').stop(true, true).slideUp();
        }
    });

    /* --------------------------------------------------
     * counter
     * --------------------------------------------------*/

    $(window).on('scroll', function () {
        $('.ot-counter').each(function() {
            var pos_y   = $(this).offset().top - window.innerHeight;
            var $this   = $(this).find('.num'),
                countTo = $this.attr('data-to'),
                during  = parseInt( $this.attr('data-time') ),
                topOfWindow = $(window).scrollTop();

            if ( pos_y < topOfWindow ) {    
                $({
                    countNum: $this.text()
                }).animate({
                    countNum: countTo
                },
                {
                    duration: during,
                    easing: 'swing',
                    step: function() {
                        $this.text(Math.floor(this.countNum));
                    },
                    complete: function() {
                        $this.text(this.countNum);
                    }
                });
            }
        });
    });

    /* --------------------------------------------------
     * progress bar
     * --------------------------------------------------*/
    $(window).on('scroll', function () {
        $('.ot-progress').each(function() {
            var pos_y = $(this).offset().top;
            var value = $(this).find(".progress-bar").data('percent');
            var topOfWindow = $(window).scrollTop();
            if (pos_y < topOfWindow + 900) {
                $(this).find(".progress-bar").css({
                    'width': value
                }, "slow");
            }
        });
    });

    $(window).on('scroll', function () {
        $('.circle-progress').each(function() {
            var bar_color1 = $(this).data('color1');
            var bar_color2 = $(this).data('color2');
            var pos_y = $(this).offset().top;
            var topOfWindow = $(window).scrollTop();
            if (pos_y < topOfWindow + 900) {
                $(this).find('.inner-bar').easyPieChart({
                    barColor: function(percent) {
                            var ctx = this.renderer.getCtx();
                            var gradient = ctx.createLinearGradient(45,0,0,90);
                                gradient.addColorStop(0, bar_color1);
                                gradient.addColorStop(1, bar_color2);
                            return gradient;
                        },
                    trackColor: false,
                    scaleColor: false,
                    lineCap: 'round',
                    lineWidth: 20,
                    size: 195,
                    animate: 1000,
                    onStart: $.noop,
                    onStop: $.noop,
                    easing: 'easeOutBounce',
                    onStep: function(from, to, percent) {
                        $(this.el).find('.percent').text(Math.round(percent)) + '%';
                    }
                });
            }
        });
    });

    /* --------------------------------------------------
    * tabs
    * --------------------------------------------------*/
    $(window).on('load', function () {

        $('.ot-tabs').each(function() {
            $(this).find('.tabs-heading li').first().addClass('current');
            $(this).find('.tab-content').first().addClass('current');
        });

        $('.tabs-heading li').on( 'click', function(){
            var tab_id = $(this).attr('data-tab');
            $(this).siblings().removeClass('current');
            $(this).parents('.ot-tabs').find('.tab-content').removeClass('current');
            $(this).addClass('current');
            $("#"+tab_id).addClass('current');
        });
    });

    /* --------------------------------------------------
    * accordions
    * --------------------------------------------------*/
        $('.ot-accordions').each( function () {
            var allPanels = $(this).find('.acc-content');
            $(this).find('.acc-toggle').on( 'click', function(){

                var $this = $(this),
                    $target = $this.next();

                if(!$target.hasClass('active')){
                    allPanels.removeClass('active').slideUp(300);
                    allPanels.parent().removeClass('current');
                    $target.addClass('active').slideDown(300);
                    $target.parent().addClass('current');
                }

                return false;
            });
            $(this).find('.acc-toggle:first').trigger('click');
        });

    /* --------------------------------------------------
    * testimonials
    * --------------------------------------------------*/
    $('.ot-testimonials-slider').each( function () {
        $(this).slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: true,
            dots: false,
            autoplay: true,
            autoplaySpeed: 6000,
            adaptiveHeight: true,
            fade: true,                
            appendArrows: '.testicustom-slider-nav, .slider__arrows',                
            prevArrow: '<button type="button" class="prev-nav"><i class="flaticon-arrow-pointing-to-left"></i></button>',
            nextArrow: '<button type="button" class="next-nav"><i class="flaticon-arrow-pointing-to-right"></i></button>',
        });
    });


    /* --------------------------------------------------
    * Client logo
    * --------------------------------------------------*/
    $('.home-client-carousel').each( function () {
        $(this).slick({
            slidesToShow: 6,
            slidesToScroll: 1,
            arrows: false,
            autoplaySpeed: 1500,
            dots: false,
            autoplay: true,
            responsive: [
                {
                    breakpoint: 1199,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 1,
                        infinite: true,
                        arrows: false,
                        dots: false
                    }
                },
                {
                    breakpoint: 991,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 1,
                        infinite: true,
                        arrows: false,
                        dots: false
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1,
                        arrows: false,
                        dots: false
                    }
                }
            ]
        });
    });
    /* --------------------------------------------------
    * message box
    * --------------------------------------------------*/
    $(window).on('load', function () {
        $('.message-box > i').on( 'click', function() {
            $(this).parent().fadeOut();
        });
    });

    /* --------------------------------------------------
    * projects filter isotope
    * --------------------------------------------------*/
    $(window).on('load', function () {
        $('.projects-grid').each( function(){
            var $container = $(this); 
            $container.isotope({ 
                    itemSelector : '.project-item', 
                    animationEngine : 'css',
                    masonry: {
                        columnWidth: 1
                    }
            });

            var $optionSets = $('.project_filters'),
                $optionLinks = $optionSets.find('a');

            $optionLinks.on('click', function(){
                var $this = $(this);

                if ( $this.hasClass('selected') ) {
                    return false;
                }
                var $optionSet = $this.parents('.project_filters');
                    $optionSets.find('.selected').removeClass('selected');
                    $this.addClass('selected');

                var selector = $(this).attr('data-filter');
                    $container.isotope({ 
                        filter: selector 
                    });
                return false;
            });
        });
    });

    /* --------------------------------------------------
    * project carousel
    * --------------------------------------------------*/
    $('.project-slider').each( function () {
        $(this).not( '.slick-initialized' ).slick({
            slidesToShow:3,
            slidesToScroll: 3,
            arrows: false,
            dots: true,
            autoplay: true,
            autoplaySpeed: 6000,
            adaptiveHeight: true,
            prevArrow: '<button type="button" class="prev-nav"><i class="flaticon-arrow-pointing-to-left"></i></button>',
            nextArrow: '<button type="button" class="next-nav"><i class="flaticon-arrow-pointing-to-right"></i></button>',
            responsive: [
                {
                    breakpoint: 1199,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1,
                        infinite: true,
                        arrows: false,
                        dots: true
                    }
                },
                {
                    breakpoint: 991,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1,
                        infinite: true,
                        arrows: false,
                        dots: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        arrows: false,
                        dots: true
                    }
                }
            ]
        });
    } );

    //Slider product
    if ($('.slider-product, .slider-product-nav').length) {

        $('.slider-product').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: true,
            asNavFor: '.slider-product-nav',
            autoplay: false
        });

        $('.slider-product-nav').slick({
            slidesToShow: 4,
            slidesToScroll: 4,
            asNavFor: '.slider-product',
            dots: false,
            arrows: false,
            centerMode: false,
            focusOnSelect: true,
            useTransform: false


        });

    }


    /* --------------------------------------------------
    * social team
    * --------------------------------------------------*/
        $('.team-social > span').on('click', function(){
            $(this).parent().toggleClass('active');
        });

    /* --------------------------------------------------
    * team carousel
    * --------------------------------------------------*/
        $('.team-slider').each( function(){
            $(this).not( '.slick-initialized' ).slick({
                slidesToShow: 3,
                slidesToScroll: 1,
                arrows: false,
                dots: true,
                infinite: false,
                autoplay: true,
                autoplaySpeed: 6000,
                adaptiveHeight: true,
                prevArrow: '<button type="button" class="prev-nav"><i class="flaticon-arrow-pointing-to-left"></i></button>',
                nextArrow: '<button type="button" class="next-nav"><i class="flaticon-arrow-pointing-to-right"></i></button>',
                responsive: [
                    {
                        breakpoint: 1199,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1,
                            infinite: true,
                            arrows: false,
                            dots: true
                        }
                    },
                    {
                        breakpoint: 991,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1,
                            infinite: true,
                            arrows: false,
                            dots: true
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            arrows: false,
                            dots: true
                        }
                    }
                ]
            });
        } );

        $('.team-slider-h5').each( function(){
            $(this).not( '.slick-initialized' ).slick({
                slidesToShow: 5,
                slidesToScroll: 1,
                arrows: false,
                dots: true,
                infinite: false,
                autoplay: true,
                autoplaySpeed: 6000,
                adaptiveHeight: true,
                prevArrow: '<button type="button" class="prev-nav"><i class="flaticon-arrow-pointing-to-left"></i></button>',
                nextArrow: '<button type="button" class="next-nav"><i class="flaticon-arrow-pointing-to-right"></i></button>',
                responsive: [
                    {
                        breakpoint: 1199,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1,
                            infinite: true,
                            arrows: false,
                            dots: true
                        }
                    },
                    {
                        breakpoint: 991,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1,
                            infinite: true,
                            arrows: false,
                            dots: true
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            arrows: false,
                            dots: true
                        }
                    }
                ]
            });
        } );

    /* --------------------------------------------------
    * real numbers
    * --------------------------------------------------*/
    $('.real-numbers').each( function(){
        var swt = $('.real-numbers').find('.switch input');
        swt.on( 'change', function() {
            var parent = $(this).parents('.real-numbers');
            if(this.checked) {
                parent.find('.a-switch').addClass('active');
                parent.find('.b-switch').removeClass('active');
                parent.find('h2.after').fadeIn();
                parent.find('h2.before').hide();
            }else{
                parent.find('.b-switch').addClass('active');
                parent.find('.a-switch').removeClass('active');
                parent.find('h2.after').hide();
                parent.find('h2.before').fadeIn();
            }
        });
    });


    /* --------------------------------------------------
    * big tabs
    * --------------------------------------------------*/
        $('.tab-titles .title-item').on( 'click', function(){
            $('.tab-active').removeClass('tab-active');
            $(this).addClass('tab-active');
            $('#content-tabs .section-content').removeClass('active');
            $($(this).attr('href')).addClass('active');

            return false;
        });
        $('.tab-titles .title-item:first').trigger('click');

        $('.tab-titles').each( function(){
            var $selector = $(this);
            $selector.not( '.slick-initialized' ).slick({
                slidesToShow: 6,
                slidesToScroll: 1,
                arrows: false,
                infinite: false,
                autoplay: false,
                adaptiveHeight: true,
                prevArrow: '<button type="button" class="prev-nav"><i class="flaticon-arrow-pointing-to-left"></i></button>',
                nextArrow: '<button type="button" class="next-nav"><i class="flaticon-arrow-pointing-to-right"></i></button>',
                responsive: [
                    {
                        breakpoint: 1199,
                        settings: {
                            slidesToShow: 5,
                            slidesToScroll: 1,
                            dots: true,
                        }
                    },
                    {
                        breakpoint: 991,
                        settings: {
                            slidesToShow: 4,
                            slidesToScroll: 1,
                            dots: true,
                        }
                    },
                    {
                        breakpoint: 767,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1,
                            dots: true
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1,
                            dots: true
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            dots: true
                        }
                    }
                ]
            });
        } );

    $('.ot-countdown').each( function() {
        $(this).countdown({
            date: "2020/06/10 12:00",
            offset: "0",
            day: "Day",
            days: "Days",
            hour: "Hour",
            hours: "Hours",
            minute: "Minute",
            minutes: "Minutes",
            second: "Second",
            seconds: "Seconds"
        }, function () {
            alert('Done!');
        });
    });

	/*Gallery Post*/
    $('.gallery-post').each( function () {
        $(this).slick({
            infinite: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: true,
            dots: false,
            autoplay: true,
            autoplaySpeed: 7000,
            prevArrow: '<button type="button" class="prev-nav"><i class="flaticon-arrow-pointing-to-left"></i></button>',
            nextArrow: '<button type="button" class="next-nav"><i class="flaticon-arrow-pointing-to-right"></i></button>',
            responsive: []
        });
    });

    /*Popup Video*/
    var $video_play = $('.btn-play');
    if ($video_play.length > 0 ) {
        $video_play.magnificPopup({
            type: 'iframe',
            removalDelay: 160,
            preloader: true,
            fixedContentPos: true,
            callbacks: {
            beforeOpen: function() {
                    this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
                    this.st.mainClass = this.st.el.attr('data-effect');
                }
            },
        });
    }

    /* Particles */
    $(window).load( function () {
        $('.particles-js').each(function () {
            var s_id = $( this ).data('id'),
                s_color = $( this ).data('color'),
                s_color = s_color.replace(/\s/g, ''),
                e = $('<div class="onum-particles"></div>');
            $( this ).append(e);    
            e.attr('id', 'particles-' + s_id );

            var id = 'particles-' + s_id;
            var color_type = 'random_colors';
            var color = s_color;
            var color_line = '#fff';
            var number = 15;
            var lines = false;
            if (color_type == 'random_colors') {
                color = color.split(',');
                color_line = color[0]
            }
            
            particlesJS(
                id, {
                    "particles":{
                        "number":{
                            "value":number,
                            "density":{
                                "enable":true,
                                "value_area":800
                            }
                        },
                        "color":{
                            "value": color
                        },
                        "shape":{
                            "type":'circle',
                            "polygon":{
                                "nb_sides":6
                            },
                        },
                        "opacity":{
                            "value":1,
                            "random":true,
                            "anim":{
                                "enable":false,
                                "speed":1,
                                "opacity_min":1,
                                "sync":false
                            }
                        },
                        "size":{
                            "value":3,
                            "random":true,
                            "anim":{
                                "enable":false,
                                "speed":30,
                                "size_min": 1,
                                "sync":false
                            }
                        },
                        "line_linked":{
                            "enable":false,
                            "distance":150,
                            "color":color_line,
                            "opacity":0,
                            "width":1
                        },
                        "move":{
                            "enable":true,
                            "speed":2,
                            "direction":"none",
                            "random":false,
                            "straight":false,
                            "out_mode":"out",
                            "bounce":false,
                            "attract":{
                                "enable":false,
                                "rotateX":600,
                                "rotateY":1200
                            }
                        }
                    },
                    "interactivity":{
                        "detect_on":"canvas",
                        "events":{
                            "onhover":{
                                "enable":true,
                                "mode":'grab'
                            },
                            "onclick":{
                                "enable":true,
                                "mode":"push"
                            },
                            "resize":true
                        },
                        "modes":{
                            "grab":{
                                "distance":150,
                                "line_linked":{
                                    "opacity":1
                                }
                            },
                            "bubble":{
                                "distance":200,
                                "size":3.2,
                                "duration":20,
                                "opacity":1,
                                "speed":30
                            },
                            "repulse":{
                                "distance":80,
                                "duration":0.4
                            },
                            "push":{"particles_nb":4},
                            "remove":{"particles_nb":2}
                        }
                    },
                    "retina_detect":true
                });
            var update;
            update = function() {
                requestAnimationFrame(update); 
            }; 
            requestAnimationFrame(update);
        });
    });


    $(window).load( function () {
        $('.particles-js-b').each(function () {
            var s_id = $( this ).data('id'),
                s_color = $( this ).data('color'),
                s_color = s_color.replace(/\s/g, ''),
                e = $('<div class="onum-particles"></div>');
            $( this ).append(e);    
            e.attr('id', 'particles-' + s_id );

            var id = 'particles-' + s_id;
            var color_type = 'random_colors';
            var color = s_color;
            var color_line = '#fff';
            var number = 15;
            var lines = false;
            if (color_type == 'random_colors') {
                color = color.split(',');
                color_line = color[0]
            }
            
            particlesJS(
                id, {
                    "particles":{
                        "number":{
                            "value":number,
                            "density":{
                                "enable":true,
                                "value_area":800
                            }
                        },
                        "color":{
                            "value": color
                        },
                        "shape":{
                            "type":'circle',
                            "polygon":{
                                "nb_sides":6
                            },
                        },
                        "opacity":{
                            "value":1,
                            "random":true,
                            "anim":{
                                "enable":false,
                                "speed":1,
                                "opacity_min":1,
                                "sync":false
                            }
                        },
                        "size":{
                            "value":4,
                            "random":true,
                            "anim":{
                                "enable":false,
                                "speed":30,
                                "size_min": 1,
                                "sync":false
                            }
                        },
                        "line_linked":{
                            "enable":false,
                            "distance":150,
                            "color":color_line,
                            "opacity":0,
                            "width":1
                        },
                        "move":{
                            "enable":true,
                            "speed":2,
                            "direction":"none",
                            "random":false,
                            "straight":false,
                            "out_mode":"out",
                            "bounce":false,
                            "attract":{
                                "enable":false,
                                "rotateX":600,
                                "rotateY":1200
                            }
                        }
                    },
                    "interactivity":{
                        "detect_on":"canvas",
                        "events":{
                            "onhover":{
                                "enable":true,
                                "mode":'grab'
                            },
                            "onclick":{
                                "enable":true,
                                "mode":"push"
                            },
                            "resize":true
                        },
                        "modes":{
                            "grab":{
                                "distance":150,
                                "line_linked":{
                                    "opacity":1
                                }
                            },
                            "bubble":{
                                "distance":200,
                                "size":3.2,
                                "duration":20,
                                "opacity":1,
                                "speed":30
                            },
                            "repulse":{
                                "distance":80,
                                "duration":0.4
                            },
                            "push":{"particles_nb":4},
                            "remove":{"particles_nb":2}
                        }
                    },
                    "retina_detect":true
                });
            var update;
            update = function() {
                requestAnimationFrame(update); 
            }; 
            requestAnimationFrame(update);
        });
    });

    /*Portfolio Filter*/
    $(window).load( function () {
        if( $('#projects_grid').length > 0 ){
            var $container = $('#projects_grid'); 
            $container.isotope({ 
                itemSelector : '.project-item', 
                layoutMode : 'masonry'
            });

            var $optionSets = $('.project_filters'),
                $optionLinks = $optionSets.find('a');

            $optionLinks.click(function(){
                var $this = $(this);

                if ( $this.hasClass('selected') ) {
                    return false;
                }
                var $optionSet = $this.parents('.project_filters');
                    $optionSets.find('.selected').removeClass('selected');
                    $this.addClass('selected');

                var selector = $(this).attr('data-filter');
                    $container.isotope({ 
                        filter: selector 
                    });
                return false;
            });
        };    

        if( $('.blog-grid').length > 0 ){
            var $container = $('.blog-grid'); 
            $container.isotope({ 
                itemSelector : '.masonry-post-item', 
                layoutMode : 'masonry'
            });
        };
    });


})( jQuery );


