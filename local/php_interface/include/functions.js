/**
* Функция для показа даты в параметрах компонента
*/

function CsCalendar(parameters)
{
	var opt = JSON.parse(parameters.data),
		label = parameters.oCont.appendChild(BX.create('SPAN', {html: parameters.oInput.value}));
		btn = parameters.oCont.appendChild(BX.create('BUTTON', {html: opt['name_fld']}));
		reset = parameters.oCont.appendChild(BX.create('BUTTON', {html: opt['reset']}));
	
	btn.onclick = BX.delegate(function(){
		BX.calendar({
			node: btn,
			value: parameters.oInput.value,
			field: parameters.oInput,
			callback_after: function(){
				label.innerHTML = parameters.oInput.value;
			}
		});
		return false;
	});	
	reset.onclick = function(){
		label.innerHTML = '';
		parameters.oInput.value = '';
		return false;
	};	
}
