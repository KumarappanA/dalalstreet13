$(document).ready(function() { 
    
    $("[rel=tooltip]").tooltip();
    
    bubblesMain(new Object({
		  type : 'radial',
		  revolve : 'center',
		  minSpeed : 100,
		  maxSpeed : 600,
		  minSize : 35,
		  maxSize : 100,
		  num : 120,
          colors : new Array('#1E90FF','#000000','#BBBBBB')
	}));
    
});