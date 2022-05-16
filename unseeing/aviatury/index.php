<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Авиатуры во все страны мира с ЦЕНТРКУРОРТ!");
$APPLICATION->SetTitle("Авиатуры | ЦЕНТРКУРОРТ");
?><h2>Авиатуры</h2>
 Компания РУП "ЦЕНТРКУРОРТ" предлагает авиатуры с отдыхом на море во все страны мира.&nbsp;<br>
 <br>
 Операторские направления:<br>
<ul>
	<li>Болгария</li>
</ul>
 Гостеприимная Болгария –&nbsp;один из лучших вариантов пляжного отдыха. Растущая популярность Болгарии среди белорусских туристов только подтверждает это.&nbsp;<br>
 Местные отели и курорты постоянно работают над повышением уровня сервиса, теперь в Болгарии можно найти даже варианты «все включено».&nbsp; При этом цены на отдых в Болгарии пока что остаются экономичными.&nbsp; Мы предлагаем туры для качественного пляжного отдыха на любой бюджет – от эконом-класса до VIP-уровня.<br>
<ul>
	<li>Греция<br>
 </li>
</ul>
 Греция - страна удивительной красоты, где яркое солнце согревает жителей практически круглый год. Лазурное море, золотистые пляжи, белые дома, аромат крепкого кофе и хвойных растений - неповторимая атмосфера Греции располагает к незабываемому и потрясающему отдыху.&nbsp;<br>
<ul>
	<li>Кипр</li>
</ul>
 Кипр манит туристов чистейшими пляжами и прозрачной голубой водой, насыщенной развлекательной программой и комфортным средиземноморским климатом. Отдых на Кипре – это возможность узнать об обычаях и нравах страны, убедиться в легендарном гостеприимстве и радушии киприотов, а также познакомиться с уникальными достопримечательностями.<br>
 В «высокий» сезон цены на отели Кипра высоки и для многих недоступны, а горящих туров на Кипр практически не бывает. Однако бронирование тура по акции «Раннее бронирование Кипр&nbsp;2019» существенно сэкономит Ваш бюджет.&nbsp;<br>
 Уже в апреле можно отправиться в тур на Кипр с вылетом из Минска.&nbsp;<br>
<ul>
	<li>Турция (Кушадасы)</li>
</ul>
 Отдых в Турции – это не только аниматоры, система «Все включено»,&nbsp;многолюдные пляжи. В первую очередь, это возможность погрузиться в атмосферу уголка планеты, где строились и распадались величайшие древние цивилизации, оставившие для нас неоценимое историческое и культурное наследие в виде величественных фортификаций и роскошных резиденций, сакральных памятников и удивительных статуй, интереснейших мифов и захватывающих легенд.<br>
<ul>
</ul>
 <br>
<ul>
</ul>
 <br>

<style>
	input[type='text'] { font-size: 20px; margin-bottom: 10px;}
	input[type='date'] { font-size: 18px; margin-bottom: 10px; }
	input[type='button'] { font-size: 18px; margin-bottom: 10px;}
	textarea { font-size: 20px; margin-bottom: 10px; }
</style>

<div style="border: 2px solid black; width: 45%; padding: 2%;">
	<h3>Форма для заявки</h3>
	<form id="feedback" method="post" action="">
		<input type="hidden" name="feedback_avia"/>
		<span>* ФИО: </span><input type="text" name="fio"/><br>
		<span>* Страна: </span><input type="text" name="country"/><br>
		<span>* Период вылета: </span><input type="date" name="calendar_start"> - <input type="date" name="calendar_end"><br>
		<span>* Телефон для связи: </span><input type="text" name="number"/><br>
		<textarea cols="33" rows="6" name="comment" placeholder="Комментарий"></textarea><br>
		<center><input type="button" id="sbmt" value="Оставить заявку"/></center>
	</form> <br>
	<span>* - Поля, обязательные для заполнения.</span><br>
	<span id="feedback_avia_result"></span>
</div>

<script>
$(document).ready(function() {
    $("#sbmt").click(
		function(){
			$.ajax({
				url:		"../ajax/feedback_unseeing.php",//url страницы (action_ajax_form.php)
       			type:		"POST",							//метод отправки
        		dataType:	"html",							//формат данных
        		data:		$("#feedback").serialize(),	// Сеарилизуем объект
        		success:	function(response) {			//Данные отправлены успешно
								if(response == '')
								{
									$('#feedback').remove();
        							$('#feedback_avia_result').html('Заявка оставлена успешно.');
								}
								else
									$('#feedback_avia_result').html(response);
    						},
    			error:		function(response) {			// Данные не отправлены
								$('#feedback_avia_result').html('Ошибка. Данные не отправлены.');
    						}
 			});
			return false;
		}
	);
});
</script>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>