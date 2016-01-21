var m_axes = {
	input: {
		y_axis: {
			field: null,
			param: [],
			min: null,
			max: null
		},
		x_axis: {
			field: null,
			param: [],
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



m_axes.start = function() {
	'use strict';
	var date = moment().subtract(30, 'days').calendar();
	date = moment(date, 'M/D/YYYY').format('M/D/YYYY');


	$('.m-axes .filter-main .date-min').val(date);
};



m_axes.watch = function() {
	'use strict';


	$('.m-axes').on('change', '.watch', function() {
		var fieldSelect = $(this);
		var fieldExpand = $(this).closest('.select-wrap').find(' > .field-expand');

		m_axes.refresh_fieldExpand(fieldSelect, fieldExpand);
	});
	$('.m-axes .x-field').trigger("change");

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
	var round = $('.m-axes .x-axis .round').val().toLowerCase();
	var date_min = $('.m-axes .filter-main .date-min').val();
	var date_max = $('.m-axes .filter-main .date-max').val();


	if (y_min.length > 0  &&  !$.isNumeric(y_min)) {
		errorText += "<li>Y-axis 'Min' is invalid. Must be a number.</li> \n";
	}

	if (y_max.length > 0  &&  !$.isNumeric(y_max)) {
		errorText += "<li>Y-axis 'Max' is invalid. Must be a number.</li> \n";
	}

	if (!$('.m-axes .x-axis .filter-wrap').hasClass('hidden')  &&  x_min.length > 0  &&  !$.isNumeric(x_min)) {
		errorText += "<li>X-axis 'Min' is invalid. Must be a number.</li> \n";
	}

	if (!$('.m-axes .x-axis .filter-wrap').hasClass('hidden')  &&  x_max.length > 0  &&  !$.isNumeric(x_max)) {
		errorText += "<li>X-axis 'Max' is invalid. Must be a number.</li> \n";
	}

	if (x_field === 'tap_dt') {
		if (round.length > 0  &&  $.inArray(round, ['day', 'week', 'month', 'year']) === -1) {
			errorText += "<li>'Round' factor is invalid. Must be a 'day', 'week', 'month', or 'year'.</li> \n";
		}
	} else {
		if (round.length > 0  &&  !$.isNumeric(round)) {
			errorText += "<li>'Round' factor is invalid. Must be a number.</li> \n";
		}
	}

	if (date_min.length === 0  &&  !isValidDate(date_min)) {
		errorText += "<li>'Date Min' is blank. You must set a minimum date.</li> \n";
	}

	if (date_min.length > 0  &&  !isValidDate(date_min)) {
		errorText += "<li>'Date Min' is invalid. Must be a date.</li> \n";
	}

	if (date_max.length > 0  &&  !isValidDate(date_max)) {
		errorText += "<li>'Date Max' is invalid. Must be a date.</li> \n";
	}



	return errorText;
};



m_axes.parse = function() {
	'use strict';
	var elem_yAxis = $('.m-axes .y-axis');
	var elem_xAxis = $('.m-axes .x-axis');
	var elem_filterMain = $('.m-axes .filter-main');
	

	//Y-axis input parse.
	m_axes.input.y_axis = {
		field: elem_yAxis.find('.y-field').val(),
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
		field: elem_xAxis.find('.x-field').val(),
		param: [],
		min: null,
		max: null,
		round: ifBlank(elem_xAxis.find('.round').val().toLowerCase(), null)
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
	date_min = moment(date_min, 'M/D/YYYY').format('M/D/YYYY');
	var date_max = ifBlank(elem_filterMain.find('.date-max').val(), null);
	date_min = moment(date_min, 'M/D/YYYY').format('M/D/YYYY');
	m_axes.input.filter_main = {
		date_min: date_min,
		date_max: date_max,
		tap_grade: ifBlank(elem_filterMain.find('.tap-grade').val(), null)
	};
	//End: Main filter input parse.


	return true;
};



m_axes.refresh_fieldExpand = function(fieldSelect, fieldExpand) {
	'use strict';
	var msg = '';
	var name_id = fieldSelect.val();


	if (name_id === 'tap_dt') {
		fieldSelect.parent().closest('.area-wrap').find('.filter-wrap').addClass('hidden');
	} else {
		fieldSelect.parent().closest('.area-wrap').find('.filter-wrap').removeClass('hidden');
	}

	$.ajax({
		type: 'POST',
    url: gVar.root + '/module/create_formElem/dist/create_fieldExpand_ajax.php',
    data: {
    	'name_id' : JSON.stringify(name_id)
    },
    dataType: 'json',
    success: function(results) {
    	fieldExpand.html(results.html);
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
	m_axes.start();

	m_axes.watch();

	$('.m-axes .y-field').trigger("change");
	$('.m-axes .x-field').trigger("change");


});




