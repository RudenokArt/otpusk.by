<?php
/* Ansible managed: /etc/ansible/roles/web/templates/after_connect_d7.php.j2 modified on 2015-11-06 08:19:05 by root on topkupon.by */
$connection = \Bitrix\Main\Application::getConnection();

$connection->queryExecute("SET NAMES 'utf8'");
$connection->queryExecute("SET collation_connection = 'utf8_unicode_ci'");
$connection->queryExecute("SET sql_mode=''");

