var p_main = {};



p_main.watch = function() {
	'use strict';

	$('.m-axes .submitBtn').click(function() {
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
    url: gVar.root + '/page/main/dist/create_query.php',
    data: {
    	'm_axes' : JSON.stringify(m_axes.input)
    },
    dataType: 'json',
    success: function(results) {
    	console.log(results.query);
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