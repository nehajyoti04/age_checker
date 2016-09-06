// /**
//  * @file age_checker.js
//  *
//  * Provides client-side validations for the Age Gate.
//  */

// var age_checker = {};

// (function ($) {
//     'use strict';


(function($, Drupal, drupalSettings) {


    Drupal.behaviors.age_checker = {
      attach: function(context, settings) {
        $(document).ready(function() {

            alert("hello");
            console.log('Loaded');
          }
        };
      })(jQuery, Drupal, drupalSettings);


    // })(jQuery);

    // function getCookie(cname) {
    //     'use strict';
    //     var name = cname + "=";
    //     var ca = document.cookie.split(';');
    //     for (var i = 0; i < ca.length; i++) {
    //         var c = ca[i];
    //         while (c.charAt(0) === ' ') {
    //             c = c.substring(1);
    //         }
    //         if (c.indexOf(name) === 0) {
    //             return c.substring(name.length, c.length);
    //         }
    //     }
    //     return "";
    // }

    // function setCookie(cname, cvalue, exdays) {
    //     'use strict';
    //     var d = new Date();
    //     d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    //     var expires = "expires=" + d.toUTCString();
    //     document.cookie = cname + "=" + cvalue + "; " + expires;
    // }
