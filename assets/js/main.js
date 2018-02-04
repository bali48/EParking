		var acc = document.getElementsByClassName("accordion");
		var i;

		for (i = 0; i < acc.length; i++) {
  		acc[i].addEventListener("click", function() {
    	this.classList.toggle("active");
    	var panel = this.nextElementSibling;
    	if (panel.style.maxHeight){
      panel.style.maxHeight = null;
    	} else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    	} 
  	});
	}


  
  function myFunc1(){

    $('.add_travel').show(1000);
  }
   function myFunc2(){

    $('.add_travel').hide(1000);
  }
    function myFunc3(){

    $('.add_vahicle').show(1000);
  }
   function myFunc4(){

    $('.add_vahicle').hide(1000);
  }