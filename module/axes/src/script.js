var m_axes = {
	input: {
		y_axis: {
			category: null,
			param: [],
			min: null,
			max: null
		},
		x_axis: {
			category: null,
			param: [],
			min: null,
			max: null,
			round_factor: null
		},
		filter_main: {
			date_min: null,
			date_max: null,
			year_min: null,
			tap_grade: null
		}
	}
};





m_axes.start = function() {
	'use strict';
	var date = moment().subtract(30, 'days').calendar();
	date = moment(date, 'M/D/YYYY').format('M/D/YYYY');


	$('.m-axes .filter-main .date-min').val(date);
};





m_axes.watch = function() {
	'use strict';


	$('.m-axes').on('change', '.watch', function() {
		var changed_elem = $(this);
		var elem_expand = $(this).closest('.select-wrap').find(' > .elem-expand');

		// m_axes.createCategoryFilter(changed_elem);

		m_axes.refreshElemExpand(changed_elem, elem_expand);
	});

};




m_axes.validate = function() {
	'use strict';
	var error_text = '';
	var y_min = $('.m-axes .y-axis .min').val();
	var y_max = $('.m-axes .y-axis .max').val();
	var x_category = $('.m-axes .x-axis .x-category').val();
	var x_min = $('.m-axes .x-axis .min').val();
	var x_max = $('.m-axes .x-axis .max').val();
	var round_factor = $('.m-axes .x-axis .round-factor').val().toLowerCase();
	var round_count = $('.m-axes .x-axis .round-count').val();
	var date_min = $('.m-axes .filter-main .date-min').val();
	var date_max = $('.m-axes .filter-main .date-max').val();


	if (y_min) {
		if (y_min.length > 0  &&  !$.isNumeric(y_min)) {
			error_text += "<li>Y-axis 'Min' is invalid. Must be a number.</li> \n";
		}
	}

	if (y_max) {
		if (y_max.length > 0  &&  !$.isNumeric(y_max)) {
			error_text += "<li>Y-axis 'Max' is invalid. Must be a number.</li> \n";
		}
	}

	if (x_min) {
		if (x_min.length > 0  &&  !$.isNumeric(x_min)) {
			error_text += "<li>X-axis 'Min' is invalid. Must be a number.</li> \n";
		}
	}

	if (x_max) {
		if (x_max.length > 0  &&  !$.isNumeric(x_max)) {
			error_text += "<li>X-axis 'Max' is invalid. Must be a number.</li> \n";
		}
	}

	if (x_category === 'tap_dt') {
		if (round_factor.length > 0  &&  $.inArray(round_factor, ['day', 'week', 'month', 'year']) === -1) {
			error_text += "<li>'Round Factor' is invalid. Must be a 'day', 'week', 'month', or 'year'.</li> \n";
		}
	} else {
		if (round_factor.length > 0  &&  !$.isNumeric(round_factor)) {
			error_text += "<li>'Round Factor' is invalid. Must be a number.</li> \n";
		}
	}

	if (round_count) {
		if (!$.isNumeric(round_count)) {
			error_text += "<li>'Round Count' is invalid. Must be a number.</li> \n";
		}
	}

	if (date_min.length === 0  &&  !isValidDate(date_min)) {
		error_text += "<li>'Date Min' is blank. You must set a minimum date.</li> \n";
	}

	if (date_min.length > 0  &&  !isValidDate(date_min)) {
		error_text += "<li>'Date Min' is invalid. Must be a date.</li> \n";
	}

	if (date_max.length > 0  &&  !isValidDate(date_max)) {
		error_text += "<li>'Date Max' is invalid. Must be a date.</li> \n";
	}

	if (isValidDate(date_min)  &&  isValidDate(date_max)) {
		date_min = moment(date_min, 'M/D/YYYY');
		date_max = moment(date_max, 'M/D/YYYY');

		if (date_min > date_max) {
			error_text += "<li>'Date Min' must be before 'Date Max'.</li> \n";
		}
	}


	return error_text;
};





m_axes.parse = function() {
	'use strict';
	var elem_yAxis = $('.m-axes .y-axis');
	var elem_xAxis = $('.m-axes .x-axis');
	var elem_filterMain = $('.m-axes .filter-main');


	//Y-axis input parse.
	m_axes.input.y_axis = {
		category: elem_yAxis.find('.y-category').val(),
		param: [],
		min: ifBlank(elem_yAxis.find('.min').val(), null),
		max: ifBlank(elem_yAxis.find('.max').val(), null)
	};

	elem_yAxis.find('select option:selected').each(function( index ) {
		m_axes.input.y_axis.param.push(
			{
				value: $(this).val(),
				text: $(this).text()
			}
		);
	});
	//End: Y-axis input parse.



	//X-axis input parse.
	m_axes.input.x_axis = {
		category: elem_xAxis.find('.x-category').val(),
		param: [],
		min: null,
		max: null,
		round_factor: ifBlank(elem_xAxis.find('.round-factor').val().toLowerCase(), null),
		round_count: ifBlank(elem_xAxis.find('.round-count').val(), null)
	};

	elem_xAxis.find('select option:selected').each(function( index ) {
		m_axes.input.x_axis.param.push(
			{
				value: $(this).val(),
				text: $(this).text()
			}
		);
	});

	if (!$('.m-axes .x-axis .filter-wrap').hasClass('hidden')) {
		m_axes.input.x_axis.min = ifBlank(elem_xAxis.find('.min').val(), null);
		m_axes.input.x_axis.max = ifBlank(elem_xAxis.find('.max').val(), null);
	}
	//End: X-axis input parse.



	//Main filter input parse.
	var date_min = ifBlank(elem_filterMain.find('.date-min').val(), null);
	date_min = moment(date_min, 'M/D/YYYY').format('YYYY-MM-DD');

	var date_max = ifBlank(elem_filterMain.find('.date-max').val(), null);
	if (date_max) {
		date_max = moment(date_max, 'M/D/YYYY').format('YYYY-MM-DD');
	}

	var year_min = moment(date_min, 'YYYY-MM-DD').format('YY');

	m_axes.input.filter_main = {
		date_min: date_min,
		date_max: date_max,
		year_min: year_min,
		tap_grade: ifBlank(elem_filterMain.find('.tap-grade').val(), null)
	};
	//End: Main filter input parse.


	return true;
};





m_axes.refreshElemExpand = function(changed_elem, elem_expand) {
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
    	
    	m_axes.createCategoryFilter(changed_elem);
    },
    error: function(XMLHttpRequest, textStatus, errorThrown) {
			msg = 'Status: ' + textStatus + '\n' + 'Error: ' + errorThrown;
			console.log(msg);
  		// dialogError(msg);
    }   
  });

};





m_axes.createCategoryFilter = function(changed_elem) {
	'use strict';
	var elem_category = changed_elem.closest('.category-wrap');
	var param_array = m_axes.createParamArray(elem_category);


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





m_axes.createParamArray = function(elem) {
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





$( document ).ready(function() {
	m_axes.start();

	m_axes.watch();

	$('.m-axes .y-category').trigger("change");
	$('.m-axes .x-category').trigger("change");


});




