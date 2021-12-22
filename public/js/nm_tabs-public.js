(function( $ ) { 
	
	'use strict';

	$(function() {

		// Set the first tab and tab content active for each tab and content container
		$('.nm-tabs-list').each(function() {
			$('.nm-tab', $(this)).each(function(index) {
				if (index == 0) {
					$(this).addClass('active-tab');					
				}
			})
		})

		$('.nm-tabs-contents').each(function() {
			$('.nm-tab', $(this)).each(function(index) {
				if (index == 0) {
					$(this).addClass('active-tab');					
				}
			})
		})
		
		$('.nm-tabs-contents').each(function() {
			$('.nm-tab-content', $(this)).each(function(index) {
				if (index == 0) {
					$(this).addClass('active-tab');
				}
			})
		})
		

		$('.nm-tab').click(function() {
			
			let id = $(this).data('id');
			let tabGroupClass = '.' + $(this).data('group');
			let clickedTab = $(this);
			
			$('.nm-tab-content' + tabGroupClass +'.active-tab').fadeOut(300, function() {
				$(this).removeClass('active-tab');
				$('.nm-tab' + tabGroupClass + '.active-tab').removeClass('active-tab');
				clickedTab.addClass('active-tab');
				$('.nm-tab-content' + tabGroupClass + '[data-id="' + id + '"]').fadeIn(300, function() {
					$(this).addClass('active-tab');
				})
			});
		})
		
		
		
	});
	
})( jQuery );
