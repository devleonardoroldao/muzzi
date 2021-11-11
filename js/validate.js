
function digitado(event){
var tecla = window.event ? event.keyCode : event.which;
if(tecla == 32) {
window.alert("Por favor, não use espaço nesse campo.")
valor_input = document.form.input.value;
tamanho_input = document.form.input.value.length-1;
escreve = valor_input.substring(0,tamanho_input)
document.form.input.value=escreve;
return false;
}else{
return false;
}
}



function espaco(){
var tecla=window.event.keyCode;if (tecla==32) {
alert('Por favor, não use espaço nesse campo.'); event.keyCode=0; event.returnValue=false;
}
}
		

$(document).ready(function(){
$(".form").submit(function(e) {
e.preventDefault();
});
});
	

$(document).ready(function(){
$('.data').mask('00/00/0000');
$('.tempo').mask('00:00:00');
$('.data_tempo').mask('00/00/0000 00:00:00');
$('.cepaa').mask('00000-000' , { placeholder: "00000-000" });
$('.numero').mask('00000');
$('.tel').mask('00000-0000');
$('.ddd_tel').mask('(00) 00000-0000' , { placeholder: "Celular DDD*" });
$('.ddd_fixo').mask('(00) 0000-0000' , { placeholder: "Fixo" });
$('.cpf').mask('000.000.000-00');
$('.cnpj').mask('00.000.000/0000-00');
$('.dinheiro').mask('000.000.000.000.000,00' , { reverse : true});
$('.dinheiro2').mask("#.##0,00" , { reverse:true});
});
