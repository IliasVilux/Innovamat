<p align="center"><a href="https://https://clicko.es/" target="_blank"><img src="https://www.boxmotions.com/blog/wp-content/uploads/2021/12/Innovamat.jpg"></a></p>

# **Instalación**
Con GIT clonamos el repositorio:
```
git clone https://github.com/IliasVilux/Innovamat.git
Instalamos composer
```
```
composer install
```
Creamos el archivo .env
```
cp .env.example .env
```
Y modificamos los campos de la base de datos:
```
DB_CONNECTION=mysql
DB_HOST=mysql-ilias.alwaysdata.net
DB_PORT=3306
DB_DATABASE=ilias_innovamat
DB_USERNAME=ilias_innovamat
DB_PASSWORD=user2023
```
Ahora ya tenemos todo configurado, por lo que podemos ejecturar el servidor:
```
php artisan serve
```