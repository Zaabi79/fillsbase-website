<?php
$p=new PDO("mysql:host=localhost;dbname=fillsbase_whmcs","fillsbase_whmcs","With786!@#");
$h=password_hash("Admin786",PASSWORD_BCRYPT);
$p->prepare("UPDATE tbladmins SET password=?,twofa_enabled=0,authmodule='local' WHERE username='admin'")->execute([$h]);
$p->exec("DELETE FROM tblbannedips");
echo "DONE hash=".$h.PHP_EOL;
