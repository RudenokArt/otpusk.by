<?if(!$USER->isAuthorized()):?>
	<a data-toggle="modal" href="#loginModal" class="btn">Вход</a>
<?else:?>
	<a href="/personal/">Мой кабинет</a><a href="?logout=yes"> / Выход</a>
<?endif?>