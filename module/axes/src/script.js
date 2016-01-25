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
		var changedElem = $(this);
		var elemExpand = $(this).closest('.select-wrap').find(' > .elem-expand');

		m_axes.refresh_elemExpand(changedElem, elemExpand);
	});


	// $('.m-axes .submitBtn').click(function() {		//Watch for clicking the submit button.
	// 	m_axes.submit();
	// });


};





// m_axes.submit = function() {
// 	'use strict';
	

// 	m_axes.validate();
// };





m_axes.validate = function() {
	'use strict';
	var errorText = '';
	var y_min = $('.m-axes .y-axis .min').val();
	var y_max = $('.m-axes .y-axis .max').val();
	var x_category = $('.m-axes .x-axis .x-category').val();
	var x_min = $('.m-axes .x-axis .min').val();
	var x_max = $('.m-axes .x-axis .max').val();
	var round_factor = $('.m-axes .x-axis .round_factor').val().toLowerCase();
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

	if (x_category === 'tap_dt') {
		if (round_factor.length > 0  &&  $.inArray(round_factor, ['day', 'week', 'month', 'year']) === -1) {
			errorText += "<li>'Round Factor' is invalid. Must be a 'day', 'week', 'month', or 'year'.</li> \n";
		}
	} else {
		if (round_factor.length > 0  &&  !$.isNumeric(round_factor)) {
			errorText += "<li>'Round Factor' is invalid. Must be a number.</li> \n";
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

	if (isValidDate(date_min)  &&  isValidDate(date_max)) {
		date_min = moment(date_min, 'M/D/YYYY');
		date_max = moment(date_max, 'M/D/YYYY');

		if (date_min > date_max) {
			errorText += "<li>'Date Min' must be before 'Date Max'.</li> \n";
		}
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
		round_factor: ifBlank(elem_xAxis.find('.round_factor').val().toLowerCase(), null)
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





m_axes.refresh_elemExpand = function(changedElem, elemExpand) {
	'use strict';
	var msg = '';
	var name_id = changedElem.val();


	if (name_id === 'tap_dt') {
		changedElem.parent().closest('.area-wrap').find('.filter-wrap').addClass('hidden');
	} else {
		changedElem.parent().closest('.area-wrap').find('.filter-wrap').removeClass('hidden');
	}

	$.ajax({
		type: 'POST',
    url: gVar.root + '/module/create_formElem/dist/create_elemExpand_ajax.php',
    data: {
    	'name_id' : JSON.stringify(name_id)
    },
    dataType: 'json',
    success: function(results) {
    	elemExpand.html(results.html);
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

	$('.m-axes .y-category').trigger("change");
	$('.m-axes .x-category').trigger("change");


});




