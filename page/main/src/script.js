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

	console.log(errorText);
};



$( document ).ready(function() {
	p_main.watch();

});