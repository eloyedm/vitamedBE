$("#signInBtn").on("click", function(event){
	$.ajax({
		method: 'POST',
		url: '/services/register',
		data: {
			email: $('input[name="Mail"]'),
			password: $('input[name="Pass"]'),
			nombre: $('input[name="Nom"]'),
			apellidoP: $('input[name="aPat"]'),
			apellidoM: $('input[name="aMat"]')
		}
		,success: function(data){
			if (data.status == 202){
				//window.location.replace = ""
				alert("Te has registrado!");
			}
		}
	});
	event.preventDefault();
})
$("#logInBtn").on("click", function(event){

	$.ajax({
		method: 'POST',
		url: '/services/login',
		data: {
			"email": $('input[name="mail"]').val(),
			"password": $('input[name="password"]').val()
		},
		success: function(data){
			if (data.status == 202){
				//window.location.replace = ""
				alert("Te has logueado!");
			}
		}
	});
});
