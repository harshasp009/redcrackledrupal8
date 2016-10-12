/**
 * @file
 * Allow to have dropdown submenu.
 */

(function ($, Drupal) {
  'use strict';

  /**
   * Initialize dropdown submenu.
   *
   * @type {Drupal~behavior}
   */
  Drupal.behaviors.dialog = {
    attach: function (context, settings) {
      var $context = $(context);

      $context.find('ul.dropdown-menu [data-toggle=dropdown]').on('click', function(event) {
        // Avoid following the href location when clicking.
        event.preventDefault();
        // Avoid having the menu to close when clicking.
        event.stopPropagation();
        // If a menu is already open we close it.
        //$('ul.dropdown-menu [data-toggle=dropdown]').parent().removeClass('open');
        // Opening the one you clicked on.
        $(this).parent().addClass('open');

        var menu = $(this).parent().find("ul");
        var menupos = menu.offset();
        var newpos = 0;

        if ((menupos.left + menu.width()) + 30 > $(window).width()) {
          newpos = - menu.width();
        }
        else {
          newpos = $(this).parent().width();
        }
        menu.css({ left:newpos });
      });
    }
  };

})(jQuery, Drupal);
