$(function() {

    'use strict';

    // Dashboard  

    $(".toggle-info").click( function () {

        $(this).toggleClass('selected').parent().next('.card-body').fadeToggle(100) ; 

        if($(this).hasClass('selected')) { 

            $(this).html('<i class="fa fa-plus"></i>')

        } else { 
            $(this).html('<i class="fa fa-minus"></i>')
        }
    });


    // Trigger The SelectBoxit 

    $("select").selectBoxIt({
        autoWidth: false ,

        // Uses the jQuery 'fadeIn' effect when opening the drop down
        showEffect: "fadeIn",

        // Sets the jQuery 'fadeIn' effect speed to 400 milleseconds
        showEffectSpeed: 200,

        // Uses the jQuery 'fadeOut' effect when closing the drop down
        hideEffect: "fadeOut",

        // Sets the jQuery 'fadeOut' effect speed to 400 milleseconds
        hideEffectSpeed: 200

        });

    // Hide Placeholder On Form Focus 

    $('[placeholder]').focus(function () {
        $(this).attr('data-text' ,$(this).attr('placeholder'));

        $(this).attr('placeholder' , '');
    }).blur(function() {
        $(this).attr('placeholder' , $(this).attr('data-text'));
    });

    // Add Astrisk On Require Field  ya3ni el njmeh 

    $('input').each(function () {
        if($(this).attr('required') === 'required'){
            $(this).after('<span class="astrisk">*</span>')
        }
    });

    // Convert PAssword Field To Text Field On Hover 

    var passField =  $('.password'); 

    $('.show-pass').hover(function () {

        passField.attr('type' , 'text');

    }, function () {

        passField.attr('type' , 'password');

    });


    // Confermation Message On Button 

    $('.confirm').click(function() {

        return confirm('Are You Sure?') ; 
    });

    // Category New Option 

    $('.cat h3').click(function () { 

        $(this).next('.full-view').fadeToggle(200);  

    });

    $('.option span').click(function () { 

        $(this).addClass('active').siblings('span').removeClass('active'); 

       if ($(this).data('view') === 'full') {

            $('.cat .full-view').fadeIn(200);

       }else { 

            $('.cat .full-view').fadeOut(200);

       }

    });

});