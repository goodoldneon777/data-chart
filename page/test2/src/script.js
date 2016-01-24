var p_test2 = {};



p_test2.watch = function() {
	'use strict';

	$('.m-axes .submitBtn').click(function() {
		p_test2.submit()
	});
};



p_test2.submit = function() {
	'use strict';
	var errorText = m_axes.validate();


	if (errorText !== '') {
		console.log(errorText);
		return false;
	}


	m_axes.parse();

	console.log(m_axes.input);
	p_test2.createQuery();

};



p_test2.createQuery = function() {
	'use strict';


	$.ajax({
		type: 'POST',
    url: gVar.root + '/page/test2/dist/create_query.php',
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
	p_test2.watch();

});