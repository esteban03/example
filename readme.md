
# Deploy

1. Crear base de datos y configurarla en .env
2. Ejecutar comandos:
    1. composer install
    2. npm install
    3. php artisan key:generate
    4. Migraciones y seeders: php artisan migrate:fresh --seed
3. Puedes correr php artisan serve o montar en un servidor como nginx

Nota: Para probar correos puedes configurar el driver de email con log o utilizar un servicio como mailtrap. Si estas en windows puedes usar laragon.

Datos de prueba

### Admin

    User: admin@admin.cl
    Pass: admin@

### Evaluador

    User: mail@enovus1.cl
    Pass: 1111

### Usuario evaluado

    User: mail@enovus3.cl
    Pass: 1111
