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

	
};



$( document ).ready(function() {
	p_main.watch();

});