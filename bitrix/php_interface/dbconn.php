<? define("SHORT_INSTALL_CHECK", true);?><?
/* Ansible managed: /etc/ansible/roles/web/templates/dbconn.php.j2 modified on 2015-11-06 08:19:05 by root on topkupon.by */
define("DBPersistent", false);
$DBType = "mysql";
$DBHost = "localhost";
$DBLogin = "usernew";
$DBPassword = "9RXpvAuU6wwPxBq";
$DBName = "dbnew";
$DBDebug = false;
$DBDebugToFile = false;

define("DELAY_DB_CONNECT", true);
define("CACHED_b_file", 3600);
define("CACHED_b_file_bucket_size", 10);
define("CACHED_b_lang", 3600);
define("CACHED_b_option", 3600);
define("CACHED_b_lang_domain", 3600);
define("CACHED_b_site_template", 3600);
define("CACHED_b_event", 3600);
define("CACHED_b_agent", 3660);
define("CACHED_menu", 3600);

define("BX_FILE_PERMISSIONS", 0664);
define("BX_DIR_PERMISSIONS", 0775);
@umask(~BX_DIR_PERMISSIONS);

define("MYSQL_TABLE_TYPE", "INNODB");
define("SHORT_INSTALL", true);
define("VM_INSTALL", true);

define("BX_UTF", true);
define("BX_CRONTAB_SUPPORT", true);
define("BX_COMPRESSION_DISABLED", true);

?>
