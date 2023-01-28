## About Ultimate POS

Ultimate POS is a POS application by [Ultimate Fosters](http://ultimatefosters.com), a brand of [The Web Fosters](http://thewebfosters.com).

## Installation & Documentation

### Paso 1
- clonar el repositorio
- editar el archivo .env
- composer install

### paso 2
- correr sql del archivo system.sql
- correr php artisan migrate --force
- corre php artisan db:seed

### paso 3
- desde el frontend crear negocio con usuario luis.flores
- ingresa con el usuario creado
- configurar el panel de super admin

### Documentacion
- https://www.youtube.com/watch?v=wtAmMuXYUb8    (api)
- /docs  (api)

### Get Token
- https://pos.loginweb.dev/oauth/token   (url)
> grant_type : password
<br>
> client_id : 1
<br>
> username : luis.flores
> password : 123456
<br>
> client_secret : 2hjmCE4kB6OZng8YRjSOATEv4GQna3QNY2KQTgGT
<br>
- Luego de obtener el token, puede realizar consultas a la api, lee el manual


You will find installation guide and documentation in the downloaded zip file.
Also, For complete updated documentation of the ultimate pos please visit online [documentation guide](http://ultimatefosters.com/ultimate-pos/).

## Security Vulnerabilities

If you discover a security vulnerability within ultimate POS, please send an e-mail to support at thewebfosters@gmail.com. All security vulnerabilities will be promptly addressed.

## License

The Ultimate POS software is licensed under the [Codecanyon license](https://codecanyon.net/licenses/standard).
