#!/bin/bash
sshpass -p 'Allahnabi786c' scp -o StrictHostKeyChecking=no /tmp/r.php root@185.245.183.90:/tmp/r.php
sshpass -p 'Allahnabi786c' ssh -o StrictHostKeyChecking=no root@185.245.183.90 "php /tmp/r.php && rm /tmp/r.php" > /Users/mac/Desktop/fix_result.txt 2>&1
cat /Users/mac/Desktop/fix_result.txt
