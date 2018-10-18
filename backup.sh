#!/bin/sh
pg_dump -U postgres subcep > backup/backup.pgsql
tar cfz backup/backup.tar.gz backup/backup.pgsql storage/app/public/ public/documentacion/normativa/ public/documentacion/empresas/ public/documentacion/referencias/ public/documentacion/tareas/
rm backup/backup.pgsql
chmod 644 backup/backup.tar.gz
mv backup/backup.tar.gz $1

