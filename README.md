# Unisuam Back-end

**Avaliação projeto Back-end** INDIQUE UM AMIGO

## Info Ambiente
- PHP 7.3
- Composer
- PostgreSQL 14.0

**Criar dois DBs**
- unisuam_backend
- unisuam_backend_test


**Configurar arquivo env**

- Renomear o arquivo .env.example => .env
- Setar a configuração do env
```
DB_CONNECTION=pgsql
DB_HOST=host
DB_PORT=porta
DB_DATABASE=unisuam_backend
DB_USERNAME=user
DB_PASSWORD=senha

DB_CONNECTION_TEST=pgsql_test
DB_HOST_TEST=host
DB_PORT_TEST=porta
DB_DATABASE_TEST=unisuam_backend_test
DB_USERNAME_TEST=user
DB_PASSWORD_TEST=senha
```
**Rodar seed e migrations**

```
- php artisan migrate
- php artisan db:seed
```

**Startar Servidor**
```
- php -S localhost:<porta> -t public
```

**Rodar Testes**
```
php ./vendor/phpunit/phpunit/phpunit
```

