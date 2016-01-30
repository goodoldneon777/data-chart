var m_category = {};




m_category.watch = function() {
	'use strict';


	$('.m-category').on('change', '.watch', function() {
		var changed_elem = $(this);
		var elem_expand = $(this).closest('.select-wrap').find(' > .elem-expand');

		m_category.refreshElemExpand(changed_elem, elem_expand);
	});

};





m_category.refreshElemExpand = function(changed_elem, elem_expand) {
	'use strict';
	var msg = '';
	var name_id = changed_elem.val();


	$.ajax({
		type: 'POST',
    url: gVar.root + '/module/form_elem/dist/ajax_receiver_elem_expand.php',
    data: {
    	'name_id' : JSON.stringify(name_id)
    },
    dataType: 'json',
    success: function(results) {
    	elem_expand.html(results.html);
    	
    	m_category.createCategoryFilter(changed_elem);
    },
    error: function(XMLHttpRequest, textStatus, errorThrown) {
			msg = 'Status: ' + textStatus + '\n' + 'Error: ' + errorThrown;
			console.log(msg);
  		// dialogError(msg);
    }   
  });

};





m_category.createCategoryFilter = function(changed_elem) {
    'use strict';
    var elem_category = changed_elem.closest('.category-wrap');
    var param_array = m_category.createParamArray(elem_category);


    $.ajax({
        type: 'POST',
    url: gVar.root + '/module/category_filter/dist/ajax_receiver.php',
    data: {
        'param_array' : JSON.stringify(param_array)
    },
    dataType: 'json',
    success: function(results) {
        elem_category.find('.filter-wrap').html(results);
    },
    error: function(XMLHttpRequest, textStatus, errorThrown) {
            var msg = 'Status: ' + textStatus + '\n' + 'Error: ' + errorThrown;
            console.log(msg);
        // dialogError(msg);
    }   
  });

};





m_category.createParamArray = function(elem) {
    'use strict';
    var param_array = [];


    elem.find('select option:selected').each(function( index ) {
        param_array.push(
            {
                value: $(this).val(),
                text: $(this).text()
            }
        );
    });


    return param_array;
};





//The following stuff will be executed after this module is finished loading, but before the page is finished loading.
m_category.watch();

$('.m-category .category').last().trigger("change");    //Trigger a change on the most recent instance of this module.





