(function ($) {
	Drupal.behaviors.mainmenu = {
		attach: function (context, settings) {
			var nav = $('#navigation');
			$('.menu-toggle').click(function() {
				nav.toggleClass('toggled-on');
			});

			var quick_links = $('#quick-links');
			$('.ql-toggle').click(function() {
				$('.ql-container').slideToggle('fast', function() {
					if (quick_links.hasClass('toggled-on')) {
						quick_links.removeClass('toggled-on');
					} else {
						quick_links.addClass('toggled-on');
					}
				});
			});

			$(document).keyup(function(e) {
				var key = e.keyCode || event.which;

				if (key === 27) {
					if ($('#quick-links').hasClass('toggled-on')) {
						$('#quick-links').toggleClass('toggled-on');
					}
				}
			});

			// First-tier navigation UL.
			var nav_menu = $('#navigation ul.menu').first();
			var top_level_links = nav_menu.find('> li > a');
			// Remove tab index from any second level links until menu is open.
			$(top_level_links).next('ul').find('a').attr('tabIndex', -1);
			$(top_level_links).parent().hover(function() {
				// Hide any other open second level menus and remove second level menu item tab indexes.
				$(this).find('a').first().closest('ul').find('.show-menu').removeClass('show-menu').find('a').attr('tabIndex', -1);
				var next = $(this).find('a').first().next('ul');
				// Show second level menu and give its items tab index.
				next.addClass('show-menu').find('a').attr('tabIndex', 0);
				// Check if any third levels exist in this menu.
				if (next.find('li ul').length > 0) {
					var second_level_links = next.find('> li > a');
					// Remove tab index from any third level links until menu is open.
					$(second_level_links).next('ul').find('a').attr('tabIndex', -1);
					$(second_level_links).parent().hover(function() {
						// Hide any other open third level menus and remove third level menu item tab indexes.
						$(this).find('a').first().closest('ul').find('.show-menu').removeClass('show-menu').find('a').attr('tabIndex', -1);
						// Show third level menu and give its items tab index.
						$(this).find('a').first().next('ul').addClass('show-menu').find('a').attr('tabIndex', 0);
					});
				}
			}, function() {
				// Hide menu on hover exit.
				$(this).find('a').first().next('ul').removeClass('show-menu');
			});
			$(top_level_links).focus(function() {
				// Hide any other open second level menus and remove second level menu item tab indexes.
				$(this).closest('ul').find('.show-menu').removeClass('show-menu').find('a').attr('tabIndex', -1);
				// Show second level menu and give its items tab index.
				$(this).next('ul').addClass('show-menu').find('a').attr('tabIndex', 0);
				var next = $(this).parent().find('a').first().next('ul');
				// Check if any third levels exist in this menu.
				if (next.find('li ul').length > 0) {
					var second_level_links = next.find('> li > a');
					// Remove tab index from any third level links until menu is open.
					$(second_level_links).next('ul').find('a').attr('tabIndex', -1);
					$(second_level_links).focus(function() {
						// Hide any other open third level menus and remove third level menu item tab indexes.
						$(this).parent().find('a').first().closest('ul').find('.show-menu').removeClass('show-menu').find('a').attr('tabIndex', -1);
						// Show third level menu and give its items tab index.
						$(this).parent().find('a').first().next('ul').addClass('show-menu').find('a').attr('tabIndex', 0);
					});
				}
			});
			// Hide menu if focus is lost.
			$(nav_menu).find('a').last().keydown(function(e) {
				if (e.keyCode === 9) {
					$('.show-menu').removeClass('show-menu').find('a').attr('tabIndex', -1);
				}
			});
			// Hide menu if user clicks somewhere on the page.
			$(document).click(function() {
				$('.show-menu').removeClass('show-menu').find('a').attr('tabIndex', -1);
			});

			// Click navigation bar to scroll to top.
			$('#navigation').click(function(e) {
				if ('navigation' == e.target.id) {
					$('html, body').animate({scrollTop: 0}, 'fast');
				}
			});

			/*
			 * Makes "skip to content" link work correctly in IE9 and Chrome for better
			 * accessibility.
			 *
			 * @link http://www.nczonline.net/blog/2013/01/15/fixing-skip-to-content-links/
			 */
			if ('onhashchange' in window) {
				window.onhashchange = function() {
					var element = document.getElementById(location.hash.substring(1));

					if (element) {
						if (!/^(?:a|select|input|button|textarea)$/i.test(element.tagName)) {
							element.tabIndex = -1;
						}
						element.focus();
					}
				};
			} else {
				var prevHash = window.location.hash;
				window.setInterval(function() {
					if (window.location.hash != prevHash) {
						prevHash = window.location.hash;
						var element = document.getElementById(location.hash.substring(1));

						if (element) {
							if (!/^(?:a|select|input|button|textarea)$/i.test(element.tagName)) {
								element.tabIndex = -1;
							}
							element.focus();
						}
					}
				}, 100);
			}

			$('.search-button2').on("click", function(){ $("#yeb13searchfield2").focus() });

			/*
			 * Setup code tags for prism.js
			 */
			$('code').each(function() {
				var codeClass = $(this).attr('class');
				var parent = $(this).parent();
				if (parent.get(0).tagName == 'PRE') {
					parent.addClass('line-numbers');

					if (!codeClass || codeClass == 'language-html') {
						if (codeClass == 'language-html') $(this).removeClass('language-html');
						$(this).addClass('language-markup');
					}
				}
			});
		}
	}
})(jQuery);