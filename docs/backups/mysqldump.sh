mysqldump -u root -p clement123 --all-databases | gzip > /var/www/html/backups/mysqldb_`date +%F`.sql.gz
