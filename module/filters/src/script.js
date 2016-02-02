if (typeof m_filters === 'undefined') {	//Prevents multiple instances of this script/
	var m_filters = {

	};





	m_filters.watch = function() {
		'use strict';


		$('.m-filters').on('change', '.category', function() {
			var changed_elem = $(this);

			// console.log(changed_elem.val());

			// m_category.refresh(changed_elem);

			m_filters.filterItemNoneClear(changed_elem);

			

		});
	};





	m_filters.filterItemCreate = function(module_elem) {
		'use strict';
		// var module_elem = changed_elem.closest('.m-filters');
		// var category_elem_all = module_elem.find('.category');


		$.ajax({
			type: 'POST',
	    url: gVar.root + '/module/filters/dist/filter_item_ajax.php',
	    data: {},
	    dataType: 'json',
	    success: function(results) {
	      var html = results;

	    	module_elem.append(html);
	    },
	    error: function(XMLHttpRequest, textStatus, errorThrown) {
				var msg = 'Status: ' + textStatus + '\n' + 'Error: ' + errorThrown;
				console.log(msg);
	  		// dialogError(msg);
	    }   
	  });

	};





	m_filters.filterItemNoneClear = function(changed_elem) {
		'use strict';
		var module_elem = changed_elem.closest('.m-filters');
		var category_elem_all = module_elem.find('.category');


		category_elem_all.each(function( index ) {
			if ($(this).val() === 'none') {
				$(this).closest('.filter-item-wrap').remove();
			}
		});

		m_filters.filterItemCreate(module_elem);
	};






	m_filters.watch();

}