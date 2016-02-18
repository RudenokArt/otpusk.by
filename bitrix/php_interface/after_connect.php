<?php
/* Ansible managed: /etc/ansible/roles/web/templates/after_connect.php.j2 modified on 2015-11-06 08:19:05 by root on topkupon.by */
$DB->Query("SET NAMES 'utf8'");
$DB->Query('SET collation_connection = "utf8_unicode_ci"');
