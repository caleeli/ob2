sudo apt-add-repository ppa:pinepain/libv8-5.2
sudo apt-get update
sudo apt-get -qq install libv8-5.2-dev
sudo pecl install -f v8js-1.3.3
sudo echo 'extension=v8js.so' >> /etc/php/7.1/cli/php.ini
sudo echo 'extension=v8js.so' >> /etc/php/7.1/fpm/php.ini
