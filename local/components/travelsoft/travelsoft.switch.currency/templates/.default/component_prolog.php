<?$cur = getCurrenty();?>
<?if(!isset($_SESSION["current_currency"]) && isset($_GET["price_type"]) && $_GET["price_type"] == 1):?>
    <?$_SESSION['current_currency'] = $cur["RUB"]?>
<?elseif(!isset($_SESSION["current_currency"]) && isset($_GET["price_type"]) && $_GET["price_type"] == 2):?>
    <?$_SESSION['current_currency'] = $cur["EUR"]?>
<?endif;?>
<?/*if(isset($_GET["price_type"]) && $_GET["price_type"] == 1 && isset($_SESSION["current_currency"])):*/?><!--<?/*$_SESSION['current_currency'] = $cur["RUB"]*/?><?/*else:*/?><?/*$_SESSION['current_currency'] = $cur["BYN"]*/?>--><?/*endif;*/?>