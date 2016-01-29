var p_main = {};



p_main.watch = function() {
	'use strict';

	$('.submitBtn').click(function() {
		p_main.submit()
	});
};



p_main.submit = function() {
	'use strict';
	var errorText = m_axes.validate();


	if (errorText !== '') {
		console.log(errorText);
		return false;
	}


	m_axes.parse();

	console.log(m_axes.input);
	p_main.createQuery();

};



p_main.createQuery = function() {
	'use strict';


	$.ajax({
		type: 'POST',
    url: gVar.root + '/page/main/dist/sql_stuff.php',
    data: {
    	'm_axes' : JSON.stringify(m_axes.input)
    },
    dataType: 'json',
    success: function(results) {
    	var data_heat = results.data_heat;
    	var data_round = results.data_round;
        var x_datatype = results.x_datatype;
    	// console.log(results.query);
    	console.log(results.data_round);


    	m_chart.createChart(data_heat, data_round, x_datatype);
    },
    error: function(XMLHttpRequest, textStatus, errorThrown) { 
    	var msg = 'Status: ' + textStatus + '\n' + 'Error: ' + errorThrown;
  		// dialogError(msg);
  		console.log(msg);
    }   
  });
};




$( document ).ready(function() {
	p_main.watch();

});