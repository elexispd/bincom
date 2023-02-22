$(document).ready(function() {

	$('form#store_form').on('submit', function(event) {
		event.preventDefault();

		var that = $(this),
        url = that.attr("action"),
        type = that.attr("method"),
        data = {};
	    that.find('[name]').each(function(index, value){
	        var that = $(this),
	            name = that.attr('name'),
	            value = that.val();
	            data[name] = value;
	    });

	    $.ajax({
	        url: url,
	        type: type,
	        data: data,
	        beforeSend:function(){
				$('button').text("Processing....")	            
	        },

	        complete: function() {
	        	$('button').text("submit")
	        },
	        success: function(response){
	            var resp = JSON.parse(response);


				$(".party").html(resp["party"]);
				$(".unit").html(resp["unit"]);
				$(".score").html(resp["score"]);
				$(".staff").html(resp["staff"]);

				if (resp['success'] != "") {
					$('.msg').html(resp['success']);
					$('.msg').addClass('alert-success');

					setTimeout(function() {
					    $('.success').addClass('fade');
					 }, 5000);
				}
				

				$('form').trigger('reset');
				
	        }, 
	        error: function(jqXHR, textStatus, errorThrown) {
                console.log('AJAX error: ' + textStatus + ' : ' + errorThrown);
            }
    	})

	})


})
