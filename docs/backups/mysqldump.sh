mysqldump -u root -p clement123 --all-databases | gzip > /var/www/html/docs/backups/mysqldb_`date +%F`.sql.gz
