/*-------------------------------------------------------------------------------------------------
Demo 1) Getting JSON data as a result and letting JS decide where to put the data on the page
-------------------------------------------------------------------------------------------------*/
$('#search-json').click(function() {
	$.ajax({
		type: 'POST',
		url: '/book/search',
		success: function(response) { 
			
			// Clear the results from the last query
			$('#results').html('');
			
			// Parse through the response
			$.each(response, function( index, value ) {
				var author = response[index]['author']['name'];
				var title  = response[index]['title'];
				$('#results').append(title + ' by ' + author + '<br><br>');
			});
		
		},
		data: {
			format: 'json',
		    query: $('input[name=query]').val(),
		},
	}); 
});


/*-------------------------------------------------------------------------------------------------
Demo 2) Getting HTML/A View as a result and just throwing it in to the response div
-------------------------------------------------------------------------------------------------*/
$('#search-html').click(function() {
	$.ajax({
		type: 'POST',
		url: '/book/search',
		success: function(response) { 
			$('#results').html(response);
		},
		data: {
			format: 'html',
		    query: $('input[name=query]').val(),
		},
	}); 
});
