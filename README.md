# Truittar2.0
Proyecte Sintesis

$ sudo apt-get install composer git php7.0 php7.0-mbstring

$ git clone https://github.com/Lonwi10/Truittar2.0

$ cd Truittar2.0

$ composer install

$ cp .env.example .env


 
$ php artisan key:generate Modificar .env:

DB_CONNECTION=mysql DB_DATABASE=truittar DB_USERNAME=root DB_PASSWORD=tucontraseña


Bajamos hasta abajo que salga la parte de mailtrap y colocaremos lo siguiente:
	MAIL_DRIVER=smtp
	MAIL_HOST=smtp.mailtrap.io
	MAIL_PORT=2525
	MAIL_USERNAME=5ad7a8c82b426f
	MAIL_PASSWORD=949dc29923caa6


Migrar la base de datos y poner en marcha:

$ php artisan migrate $ php artisan db:seed $ php artisan serve
