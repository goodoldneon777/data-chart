if (typeof m_category === 'undefined') {
  var m_category = {};




  m_category.watch = function() {
  	'use strict';


    $('body').on('change', '.m-category .category-wrap .watch', function() {
  		var changed_elem = $(this);

  		m_category.refresh(changed_elem);
  	});

    $('body').on('change', '.m-category .filter-wrap .watch', function() {
      var changed_elem = $(this);

      m_category.refreshFilter(changed_elem);
    });

  };





  m_category.refresh = function(changed_elem) {
  	'use strict';
  	var msg = '';
  	var name_id = changed_elem.val();
    var elem_expand = changed_elem.closest('.select-wrap').find(' > .elem-expand');
    var id_first_part = m_category.idFirstPartCreate(changed_elem);


  	$.ajax({
  		type: 'POST',
      url: gVar.root + '/module/category/dist/category_refresh_ajax.php',
      data: {
      	'name_id' : JSON.stringify(name_id),
        'id_first_part' : JSON.stringify(id_first_part)
      },
      dataType: 'json',
      success: function(results) {
        var html = results.html;
        var filter_type = results.filter_type;

      	elem_expand.html(html);

        m_category.filterAlter(changed_elem, filter_type);

      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
  		msg = 'Status: ' + textStatus + '\n' + 'Error: ' + errorThrown;
  		console.log(msg);
    		// dialogError(msg);
      }   
    });

  };





  // m_category.refresh = function(changed_elem) {
  //   'use strict';
  //   var msg = '';
  //   var name_id = changed_elem.val();
  //   var elem_expand = changed_elem.closest('.select-wrap').find(' > .elem-expand');
  //   var id_first_part = m_category.idFirstPartCreate(changed_elem);


  //   $.ajax({
  //     type: 'POST',
  //     url: gVar.root + '/module/form_elem/dist/ajax_receiver_elem_expand.php',
  //     data: {
  //       'name_id' : JSON.stringify(name_id)
  //     },
  //     dataType: 'json',
  //     success: function(results) {
  //       elem_expand.html(results.html);
  //       // console.log(m_category.createParamArray(changed_elem));
  //       // m_category.createCategoryFilter(changed_elem);
  //     },
  //     error: function(XMLHttpRequest, textStatus, errorThrown) {
  //     msg = 'Status: ' + textStatus + '\n' + 'Error: ' + errorThrown;
  //     console.log(msg);
  //       // dialogError(msg);
  //     }   
  //   });

  // };





  m_category.filterAlter = function(changed_elem, filter_type) {
    'use strict';
    var msg = '';
    var operator = changed_elem.val();
    var filter_wrap = changed_elem.closest('.m-category').find('.filter-wrap');


    if (filter_type === 'none') {
      filter_wrap.addClass('hidden');
    } else {
      filter_wrap.removeClass('hidden');
    }

  };





  m_category.refreshFilter = function(changed_elem) {
    'use strict';
    var msg = '';
    var operator = changed_elem.val();
    var filter_wrap = changed_elem.closest('.filter-wrap');

    if (operator === 'none') {
      filter_wrap.find('.equal-wrap').addClass('hidden');
      filter_wrap.find('.min-wrap').addClass('hidden');
      filter_wrap.find('.max-wrap').addClass('hidden');
    }

    if (operator === '='  ||  operator === '!=') {
      filter_wrap.find('.equal-wrap').removeClass('hidden');  //Don't hide min-wrap since it's also equal-wrap.
      filter_wrap.find('.min-wrap').addClass('hidden');
      filter_wrap.find('.max-wrap').addClass('hidden');
    }

    if (operator === '>'  ||  operator === '>=') {
      filter_wrap.find('.equal-wrap').addClass('hidden');
      filter_wrap.find('.min-wrap').removeClass('hidden');
      filter_wrap.find('.max-wrap').addClass('hidden');
    }

    if (operator === '<'  ||  operator === '<=') {
      filter_wrap.find('.equal-wrap').addClass('hidden');
      filter_wrap.find('.min-wrap').addClass('hidden');
      filter_wrap.find('.max-wrap').removeClass('hidden');
    }

    if (operator === 'range') {
      filter_wrap.find('.equal-wrap').addClass('hidden');
      filter_wrap.find('.min-wrap').removeClass('hidden');
      filter_wrap.find('.max-wrap').removeClass('hidden');
    }

  };





  m_category.idFirstPartCreate = function(changed_elem) {
    //Returns a string of all the selected values above, and including the changed element. In other words, this frequently returns the "partial id" of the category selections.
    'use strict';
    var elem_category = changed_elem.closest('.category-wrap');
    var id_first_part = '';


    elem_category.find('select').each(function( index ) {
      id_first_part += $(this).find('option:selected').val() + ' ';

      if ($(this).attr('class') === changed_elem.attr('class')) {
        return false; //Break the loop.
      }
    });

    id_first_part = $.trim(id_first_part);  //Trim trailing whitespace.


    return id_first_part;
  };





  // m_category.createParamArray = function(elem) {
  //     'use strict';
  //     var elem_category = elem.closest('.category-wrap');
  //     var param_array = [];


  //     elem_category.find('select option:selected').each(function( index ) {
  //       param_array.push(
  //         {
  //           value: $(this).val(),
  //           text: $(this).text()
  //         }
  //       );
  //     });


  //     return param_array;
  // };





  //The following stuff will be executed after this module is finished loading, but before the page is finished loading.
  // if (typeof m_category.watch == 'function') { 
    // yourFunctionName(); 
    m_category.watch();
  // }
}


// $('.m-category .category').last().trigger("change");    //Trigger a change on the most recent instance of this module.





