<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Электронная рассылка");
?>
<h4><span style="color: #f16c4d;">Подписаться на рассылку</span></h4>

<form method="POST" action="https://cp.unisender.com/ru/subscribe?hash=5axxiaaiwskq91shm5zgxkptnyb8wzy579bhhjj4osmocwmib4phy" name="subscribtion_form">
    <div class="subscribe-form-item subscribe-form-item--input-email">
        <label class="subscribe-form-item__label subscribe-form-item__label--input-email subscribe-form-item__label--required">E-mail</label>
        <input class="subscribe-form-item__control subscribe-form-item__control--input-email" type="text" name="email" value="">
    </div>
    <div class="subscribe-form-item subscribe-form-item--btn-submit">
        <input class="subscribe-form-item__btn subscribe-form-item__btn--btn-submit" type="submit" value="Подписаться">
    </div>
    <input type="hidden" name="charset" value="UTF-8">
    <input type="hidden" name="default_list_id" value="7079858">
    <input type="hidden" name="overwrite" value="2">
    <input type="hidden" name="is_v5" value="1">
</form><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>