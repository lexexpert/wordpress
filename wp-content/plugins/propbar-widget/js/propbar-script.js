jQuery(document).ready(function ($) {

    $('#next-btn').on('click', function() {
        nextSlide();
    });

    $('#prev-btn').on('click', function() {
        prevSlide();
    });

    $('#next-btn-footer').on('click', function() {
        nextSlide_footer();
    });

    $('#prev-btn-footer').on('click', function() {
        prevSlide_footer();
    });

    /** Header block */

    var firstChild = 1;
    var lastChld = 1;
    var totalItems = 0;
    var totalMenuWidth = 0;

    function organizeNavBar() {

        var slideCount = 0;
        var propbar_header_width = 150;
        $('#propbar_header > li.propbar_li_show').map(function(){
            var $this = $(this);
            propbar_header_width += $this.outerWidth();
            slideCount++;
        });
        var window_width = $(window).width();

        $('#propbar_header > li').map(function(idx){
            var child_num = Math.floor(window_width / (propbar_header_width/slideCount));
            if(child_num>slideCount){slideCount = child_num;}
            for(var i = 1; i <= slideCount; i++){
                if(propbar_header_width > window_width && i > child_num){
                    $('#propbar_header li:nth-child('+i+')').removeClass('propbar_li_show');
                }else{
                    $('#propbar_header li:nth-child('+i+')').addClass('propbar_li_show');
                }
            }

            var $this = $(this);
            totalMenuWidth += $this.outerWidth();

            if($this.hasClass( "propbar_li_show" )){
                lastChld = idx;
            }
        });
        lastChld++;
        totalItems = $('#propbar_header').children().length;

    }

    organizeNavBar();

    $( window ).resize(function() {
        firstChild = 1;
        lastChld = 1;
        totalItems = 0;
        totalMenuWidth = 0;
        $('#prev-btn').hide();
        organizeNavBar();
    });


    function nextSlide() {
        if(lastChld < totalItems){
            lastChld++;
            $('#propbar_header li:nth-child('+firstChild+')').removeClass('propbar_li_show');
            $('#propbar_header li:nth-child('+lastChld+')').addClass('propbar_li_show');
            firstChild++;
            $('#prev-btn').show();
            if(lastChld === totalItems){$('#next-btn').hide();}
        }else{
            $('#next-btn').hide();
        }

    }

    function prevSlide() {
        if(firstChild > 1) {
            firstChild--;
            $('#propbar_header li:nth-child(' + lastChld + ')').removeClass('propbar_li_show');
            $('#propbar_header li:nth-child(' + firstChild + ')').addClass('propbar_li_show');
            lastChld--;
            $('#next-btn').show();
            if(firstChild === 1){$('#prev-btn').hide();}
        }else{
            $('#prev-btn').hide();
        }
    }


    /** Footer Block */

    var firstChild_footer = 1;
    var lastChld_footer = 1;
    var totalItems_footer = 0;
    var totalMenuWidth_footer = 0;

    function organizeNavBar_footer() {

        var slideCount_footer = 0;
        var propbar_footer_width = 150;
        $('#propbar_footer > li.propbar_li_show').map(function(){
            var $this = $(this);
            propbar_footer_width += $this.outerWidth();
            slideCount_footer++;
        });
        var window_width = $(window).width();

        $('#propbar_footer > li').map(function(idx){
            var child_num_footer = Math.floor(window_width / (propbar_footer_width/slideCount_footer));
            if(child_num_footer>slideCount_footer){slideCount_footer = child_num_footer;}
            for(var i = 1; i <= slideCount_footer; i++){
                if(propbar_footer_width > window_width && i > child_num_footer){
                    $('#propbar_footer li:nth-child('+i+')').removeClass('propbar_li_show');
                }else{
                    $('#propbar_footer li:nth-child('+i+')').addClass('propbar_li_show');
                }
            }

            var $this = $(this);
            totalMenuWidth_footer += $this.outerWidth();

            if($this.hasClass( "propbar_li_show" )){
                lastChld_footer = idx;
            }
        });
        lastChld_footer++;
        totalItems_footer = $('#propbar_footer').children().length;

    }

    organizeNavBar_footer();

    $( window ).resize(function() {
        firstChild_footer = 1;
        lastChld_footer = 1;
        totalItems_footer = 0;
        totalMenuWidth_footer = 0;
        $('#prev-btn-footer').hide();
        organizeNavBar_footer();
    });


    function nextSlide_footer() {
        if(lastChld_footer < totalItems_footer){
            lastChld_footer++;
            $('#propbar_footer li:nth-child('+firstChild_footer+')').removeClass('propbar_li_show');
            $('#propbar_footer li:nth-child('+lastChld_footer+')').addClass('propbar_li_show');
            firstChild_footer++;
            $('#prev-btn-footer').show();
            if(lastChld_footer === totalItems_footer){$('#next-btn-footer').hide();}
        }else{
            $('#next-btn-footer').hide();
        }

    }

    function prevSlide_footer() {
        if(firstChild_footer > 1) {
            firstChild_footer--;
            $('#propbar_footer li:nth-child(' + lastChld_footer + ')').removeClass('propbar_li_show');
            $('#propbar_footer li:nth-child(' + firstChild_footer + ')').addClass('propbar_li_show');
            lastChld_footer--;
            $('#next-btn-footer').show();
            if(firstChild_footer === 1){$('#prev-btn-footer').hide();}
        }else{
            $('#prev-btn-footer').hide();
        }
    }

});


