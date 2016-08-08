( function( $ ) {
    $(document).ready( function() {

        if( !jQuery.browser.mozilla && typeof window.matchMedia=="function" && window.matchMedia( "(min-width: 600px)" ).matches ) {
            var footer = document.getElementById('footer');
            var footerHeight = footer.clientHeight;
            document.getElementById('primary').style.paddingBottom = footerHeight + 'px';
            footer.style.marginTop = - footerHeight + 'px';
            footer.style.position = 'absolute';
        } 

        // placeholder for older browsers
        if( jQuery.isFunction( 'placeholder' ) ) {
            $('input, textarea').placeholder();
        }

        function last_child() {
            $('#wpjb-step li:last-child').css( 'content', '3' );
        }
        if ($.browser.msie && parseInt($.browser.version, 10) <= 8) {
            last_child();
        }

        $('select').customSelect();

        $('.wpjb-expand-map').click( function(event) {
            event.preventDefault();
            $(".wpjb-expanded-map iframe").attr("src", $(this).attr("href"));
            $('.wpjb-expanded-map iframe').slideToggle( 'slow' );
            return false;
        });

        $(".wpjb-ls-type-main").click(function(e) {
            e.preventDefault();
        });
        
        if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
            $(".wpjb-ls-type-main").click(function(e) {
                $(".wpjb-sub-filters").toggle();
            });
        }
        

    });
} )( jQuery );

