$ sudo apt-get install composer git php7.0 php7.0-mbstring

$ git clone https://github.com/Lonwi10/Truittar2.0

$ cd Truittar2.0

$ composer install

$ cp .env.example .env

$ php artisan key:generate Modificar .env:

DB_CONNECTION=mysql DB_DATABASE=twitter DB_USERNAME=root DB_PASSWORD=tucontraseña

Migrar la base de datos y poner en marcha:

$ php artisan migrate $ php artisan db:seed $ php artisan serve
