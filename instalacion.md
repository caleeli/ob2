# Instalación
## Requisitos
  - Linux Debian/Ubuntu
  - PHP 7.2 o superior
  - PostgreSql 10 o superior
  - Node 8 o superior
  - Apache 2.1 o superior
## Instalación de PHP Composer
Seguir los pasos descritos en la página oficial:
https://getcomposer.org/download/

Composer ofrece un instalador escrito en PHP. Lo descargaremos, comprobaremos que no esté dañado y lo utilizaremos para instalar Composer.

Asegúrese de posicionarse en su directorio de inicio y recupere el instalador usando curl:

    cd ~
    curl -sS https://getcomposer.org/installer -o composer-setup.php

A continuación, verifique que el instalador coincida con el hash SHA-384 para el instalador más reciente encontrado en la página Composer Public Keys/Signatures. Copie el hash de esa página y almacénelo como variable de shell:

    HASH=756890a4488ce9024fc62c56153228907f1545c228516cbf63f885e036d37e9a59d27d63f46af1d4d07ee0f76181c7d3

Asegúrese de sustituir el hash más reciente por el valor resaltado.

Ahora, ejecute el siguiente script PHP para verificar que el script de instalación se ejecute de forma segura:

    php -r "if (hash_file('SHA384', 'composer-setup.php') === '$HASH') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"

Verá el siguiente resultado:
```
Installer verified
```
Si ve el mensaje Installer corrupt, tendrá que revisar nuevamente si utilizó el hash correcto y volver a descargar el script de instalación. Luego, ejecute el comando para verificar el instalador nuevamente. Una vez que cuente con un instalador verificado, podrá continuar.

Para instalar composer de manera global, utilice el siguiente comando que lo descargará e instalará en todo el sistema como un comando llamado composer, en /usr/local/bin:

    sudo php composer-setup.php --install-dir=/usr/local/bin --filename=composer

Verá el siguiente resultado:

```
All settings correct for using Composer
Downloading...

Composer (version 1.6.5) successfully installed to: /usr/local/bin/composer
Use it: php /usr/local/bin/composer
```

Para comprobar su instalación, ejecute lo siguiente:

    composer

## Descargar el codigo del repositorio

El sistema SUBCEP está desarrollado con PHP y sus dependencias y versiones son gestionadas por Composer.
A continuación descargaremos el codigo del sistema.

Se recomienda instalar el sistema en la carpeta del servidor web `/var/www/subcep`

```
cd /var/www
git clone https://gitlab.contraloria.gob.bo/subcep/subcep_aplicacion subcep
cd subcep
```
A continuación instalar las dependencias del sistema:
```
composer install
```

## Configuracion del sistema

Se debe debe crear un archivo de configuracion:

```
nano .env
```
La configuración recomendada es la siguiente:

```
APP_ENV=local
APP_DEBUG=false
APP_URL=http://subcep.com

DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=subcep
DB_USERNAME=subcep_db_user
DB_PASSWORD=***********

BROADCAST_DRIVER=log
CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_DRIVER=sync

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

PHANTOMJS=/usr/local/bin/phantomjs

HR_DB_HOST=127.0.0.1
HR_DB_PORT=5432
HR_DB_DATABASE=hoja_ruta
HR_DB_USERNAME=hoja_ruta_db_user
HR_DB_PASSWORD=*********

```

