function play(x, y){

	var a = {
		x: x,
		y: y,
		'0-0': null,
		'0-1': null,
		'0-2': null,
		'1-0': null,
		'1-1': null,
		'1-2': null,
		'2-0': null,
		'2-1': null,
		'2-2': null 
	}

	a[x+'-'+y] = 'X';

	
	jQuery('.cell').each(function(e){
		if(jQuery(this).hasClass('caseX')){
			a[this.id] = 'X';
		}else if(jQuery(this).hasClass('caseO')){
			a[this.id] = 'O';
		}
		
	});
	
	
	jQuery.ajax(
		{
		  method: "POST",
		  url: 'ajax/ajax.php',
		  data: a
		}
	)
	.done(
		function(html) {
			jQuery('#jeu').html(html);
		}
	);
}
