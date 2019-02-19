

$(document).ready(function(){
		$('#suppresser').on('click', function(){
			$('#suppress').removeClass('modal');
		});
		$('#canceler').on('click', function(){
			$('#suppress').addClass('modal');
		});
});