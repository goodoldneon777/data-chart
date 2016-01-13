var m_axes = {
	data: {
		y_axis: {
			field: null,
			min: null,
			max: null
		},
		x_axis: {
			field: null,
			min: null,
			max: null,
			round: null
		},
		filter_main: {
			date_min: null,
			date_max: null,
			tap_grade: null
		}
	}
};



m_axes.watch = function() {
	'use strict';


	$('.m-axes .y-field').change(function() {
		m_axes.refresh_fieldExpand($(this));
	});

	$('.m-axes .x-field').change(function() {
		m_axes.refresh_fieldExpand($(this));
	});

};



m_axes.submit = function() {
	'use strict';
};



m_axes.validate = function() {
	'use strict';
	var errorText = '';
	var y_min = $('.m-axes .y-axis .min').val();
	var y_max = $('.m-axes .y-axis .max').val();
	var x_field = $('.m-axes .x-axis .x-field').val();
	var x_min = $('.m-axes .x-axis .min').val();
	var x_max = $('.m-axes .x-axis .max').val();
	var round = $('.m-axes .x-axis .round').val();
	var date_min = $('.m-axes .filter-main .date-min').val();
	var date_max = $('.m-axes .filter-main .date-max').val();


	if (y_min.length > 0  &&  !$.isNumeric(y_min)) {
		errorText += "<li>Y-axis min is invalid. Must be a number.</li> \n";
	}

	if (y_max.length > 0  &&  !$.isNumeric(y_max)) {
		errorText += "<li>Y-axis max is invalid. Must be a number.</li> \n";
	}

	if (x_min.length > 0  &&  !$.isNumeric(x_min)) {
		errorText += "<li>X-axis min is invalid. Must be a number.</li> \n";
	}

	if (x_max.length > 0  &&  !$.isNumeric(x_max)) {
		errorText += "<li>X-axis max is invalid. Must be a number.</li> \n";
	}

	if (x_field === 'tap_dt') {
		if (round.length > 0  &&  $.inArray(round, ['day', 'week', 'month', 'year']) === -1) {
			errorText += "<li>Round factor is invalid. Must be a 'day', 'week', 'month', or 'year'.</li> \n";
		}
	} else {
		if (round.length > 0  &&  !$.isNumeric(round)) {
			errorText += "<li>Round factor is invalid. Must be a number.</li> \n";
		}
	}

	if (date_min.length > 0  &&  !isValidDate(date_min)) {
		errorText += "<li>Date min is invalid. Must be a date.</li> \n";
	}

	if (date_max.length > 0  &&  !isValidDate(date_max)) {
		errorText += "<li>Date max is invalid. Must be a date.</li> \n";
	}

	// if (startDate.length === 0) {
	// 	errorText += "<li>'Start Date' is blank.</li>";
	// } else if (!isValidDate(startDate)) {
	// 	er


	return errorText;
};



m_axes.parse = function() {
	'use strict';
	



	return arr;
};



m_axes.refresh_fieldExpand = function(elem) {
	'use strict';
	var msg = '';
	var name_id = elem.val();
	var field_expand = elem.parent().find('.field-expand');


	if (name_id === 'tap_dt') {
		elem.parent().find('.filter').addClass('hidden');
	} else {
		elem.parent().find('.filter').removeClass('hidden');
	}

	$.ajax({
		type: 'POST',
    url: gVar.root + '/php/dist/create_fieldExpand.php',
    data: {
    	'name_id' : JSON.stringify(name_id)
    },
    dataType: 'json',
    success: function(results) {
    	field_expand.html(results.html);
    },
    error: function(XMLHttpRequest, textStatus, errorThrown) {
			msg = 'Status: ' + textStatus + '\n' + 'Error: ' + errorThrown;
			console.log(msg);
  		// dialogError(msg);
    }   
  });

	// return arr;
};




$( document ).ready(function() {
	m_axes.watch();

	$('.m-axes .y-field').trigger("change");
	$('.m-axes .x-field').trigger("change");


});




