$(document).ready(function(){
	window.HomeIndex = {
		init: function(){
			$(".btn-remove").on("click", function(){
				var url = $(this).attr("url");
				bootbox.confirm("Ông có muốn xóa thật không :'( ", function(result) {
				  if(result){
				  	window.location.href = url;
				  }
				}); 
			});
		}
	}
})