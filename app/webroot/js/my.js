$(document).ready(function($) {
	// $(".btn").click(function () {
	// 	agency = $("input[name='agency']").val();
	// 	staff = $("input[name='staff']").val();
	// 	woman = $("input[name='woman']").val();
	// 	if (agency[0] != 'C' || agency[0] != 'c')

	// })
	$(":password").keyboardLayout();
	

	$.validator.addMethod("agency",function (value,element){
		if (value[0] === "c" || value[0] === "C" || value[0] === "S" || value[0] === "s")
			return value;
		else return false;
	},"<span class='help-block'>Use english language</span>");
		

	$("form").validate({
		rules : {
			agency : "agency",
			staff : "agency",
			woman : "agency"
		}
	});
});