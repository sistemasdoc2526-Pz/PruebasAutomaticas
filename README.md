# PruebasAutomaticas

Proyecto de práctica de **pruebas funcionales con Laravel**. Tiene tres módulos (Productos, Clientes y Categorías) y un conjunto de pruebas automáticas que irás completando durante la práctica. El objetivo es que, al ejecutar `php artisan test`, todas las pruebas salgan en verde.

Las instrucciones de la práctica están en la guía en Word que te entregó el docente. Este archivo explica solamente cómo dejar el proyecto funcionando en tu computadora, partiendo de cero.

Está escrito para Windows, que es lo que se usa en clase.

---

## 1. Qué necesitas instalar

Si no tienes nada instalado, necesitas cuatro programas. Instálalos en este orden:

| Programa | Para qué sirve | Descarga |
|---|---|---|
| Git (incluye Git Bash) | Descargar el proyecto y usar la consola | https://git-scm.com/install/ |
| XAMPP (PHP 8.2 o superior) | Trae PHP y MySQL | https://www.apachefriends.org/ |
| Composer | Instala las librerías de PHP del proyecto | https://getcomposer.org/download/ |
| Node.js (versión LTS) | Instala las librerías de JavaScript | https://nodejs.org/ |

Un editor de código como Visual Studio Code también ayuda, pero no es obligatorio.

### Git

Descarga el instalador y acepta las opciones que vienen por defecto. Al terminar, si haces clic derecho dentro de cualquier carpeta, te aparece la opción **Open Git Bash here** (Abrir Git Bash aquí). Esa es la consola que usaremos en todo el proyecto.

### XAMPP

Este proyecto usa Laravel 12, que necesita **PHP 8.2 o superior**. Descarga una versión de XAMPP que traiga PHP 8.2 como mínimo. Instálalo en la ruta por defecto, `C:\xampp`.

Cuando termine, abre el **Panel de control de XAMPP** y presiona **Start** en **Apache** y en **MySQL**. Los dos deben quedar en verde. Apache lo necesitas para entrar a phpMyAdmin, y MySQL para la base de datos.

Si MySQL no inicia, casi siempre es porque otro programa está usando el puerto 3306 (otro MySQL instalado, por ejemplo). Ciérralo o detén ese servicio y vuelve a intentar.

### PHP en la consola

Para ejecutar comandos como `php artisan` desde cualquier carpeta, Windows tiene que saber dónde está PHP:

1. Abre el menú Inicio y busca **Variables de entorno**. Elige "Editar las variables de entorno del sistema".
2. Presiona **Variables de entorno**.
3. En la lista de abajo (Variables del sistema), selecciona **Path** y presiona **Editar**.
4. Presiona **Nuevo** y escribe `C:\xampp\php`.
5. Acepta todas las ventanas.
6. Cierra cualquier consola que tengas abierta. Las que abras después ya lo reconocen.

### Extensiones de PHP

Abre el archivo `C:\xampp\php\php.ini` con el Bloc de notas y busca estas líneas. Todas deben estar **sin punto y coma (;) al inicio**. Si alguna lo tiene, bórralo:

```
extension=curl
extension=fileinfo
extension=mbstring
extension=openssl
extension=pdo_mysql
extension=pdo_sqlite
extension=sqlite3
extension=zip
```

`pdo_sqlite` y `sqlite3` son importantes: las pruebas automáticas usan una base de datos temporal en memoria que depende de ellas. Guarda el archivo.

### Composer

Ejecuta el instalador. Cuando te pida el PHP, debe detectar `C:\xampp\php\php.exe`. Si no lo encuentra, indícaselo a mano. Deja marcada la opción de agregarlo al PATH.

### Node.js

Instala la versión LTS con las opciones por defecto.

### Comprobar que todo quedó bien

Abre una consola **nueva** (Git Bash) y ejecuta estos comandos uno por uno:

```bash
git --version
php -v
composer -V
node -v
npm -v
```

Cada uno debe mostrar un número de versión. Para PHP, confirma que sea 8.2 o mayor. Si alguno dice "command not found" o "no se reconoce", ese programa no se instaló bien o falta reiniciar la consola. No sigas hasta resolverlo.

---

## 2. Instalar el proyecto

### Descargar el código

1. Crea una carpeta donde vivirá el proyecto, por ejemplo `C:\proyectos`.
2. Entra a la carpeta, haz clic derecho y elige **Open Git Bash here**.
3. Clona el repositorio:

```bash
git clone https://github.com/sistemasdoc2526-Pz/PruebasAutomaticas.git
```

4. Entra a la carpeta del proyecto:

```bash
cd PruebasAutomaticas
```

No hace falta ejecutar `git init`: el comando `git clone` ya deja la carpeta lista como repositorio.

### Configurar y preparar Laravel

Estos comandos se ejecutan dentro de la carpeta `PruebasAutomaticas`, en este orden:

```bash
cp .env.example .env
composer install
php artisan key:generate
npm install
```

- `cp .env.example .env` crea tu archivo de configuración personal.
- `composer install` descarga las librerías de PHP. Puede tardar unos minutos.
- `php artisan key:generate` crea la clave de seguridad de la aplicación.
- `npm install` descarga las librerías de JavaScript. Las páginas de esta práctica son simples y no dependen de ellas, pero el proyecto las incluye y conviene dejarlas instaladas.

---

## 3. Crear la base de datos

La aplicación guarda los datos en MySQL. Con MySQL y Apache encendidos en XAMPP:

1. Entra a http://localhost/phpmyadmin
2. Presiona **Nueva** en el panel izquierdo.
3. Escribe el nombre de la base de datos: `pruebas_funcionales`
4. En cotejamiento elige `utf8mb4_unicode_ci` y presiona **Crear**.

Ahora abre el archivo `.env` del proyecto y deja las líneas de base de datos así:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pruebas_funcionales
DB_USERNAME=root
DB_PASSWORD=
```

El nombre en `DB_DATABASE` debe ser **exactamente** el mismo que creaste en phpMyAdmin. XAMPP trae el usuario `root` sin contraseña, por eso `DB_PASSWORD` queda vacío. Revisa que no haya dos líneas `DB_CONNECTION`: si queda una vieja que dice `sqlite`, esa es la que se aplica.

Luego crea las tablas:

```bash
php artisan migrate
```

Todas las migraciones deben terminar con `DONE`. En phpMyAdmin, al refrescar la base de datos, tienen que aparecer las tablas `productos`, `clientes` y `categorias` (además de otras propias de Laravel).

---

## 4. Comprobar que funciona

Inicia el servidor:

```bash
php artisan serve
```

Déjalo corriendo en esa consola y abre en el navegador:

- http://127.0.0.1:8000/productos
- http://127.0.0.1:8000/clientes
- http://127.0.0.1:8000/categorias

Abre una segunda consola (Git Bash, dentro de la carpeta del proyecto) y ejecuta las pruebas:

```bash
php artisan test
```

Al principio vas a ver las pruebas de Productos en verde y varias pruebas de Clientes y Categorías como pendientes o con fallas. Eso es lo esperado: son las que vas a resolver en la práctica.

Las pruebas **no usan tu base de datos MySQL**. Trabajan con una base temporal en memoria que se borra al terminar, por eso los datos que ellas crean nunca aparecen en phpMyAdmin.

---

## 5. Trabajar en las pruebas

Los archivos de pruebas están en `tests/Feature`. Para esta práctica vas a trabajar en:

```
tests/Feature/ProductoTest.php     (ya resuelto, úsalo como modelo)
tests/Feature/ClienteTest.php      (lo completas tú)
tests/Feature/CategoriaTest.php    (lo completas tú)
```

Para ejecutar solo un archivo:

```bash
php artisan test --filter=ClienteTest
```

Si quieres crear un archivo de pruebas adicional:

```bash
php artisan make:test NombreDeLaPruebaTest
```

El nombre debe terminar en `Test`, la clase dentro del archivo debe llamarse igual que el archivo, y cada método de prueba tiene que empezar con `test_`. Si no cumples eso, PHPUnit no lo reconoce y la prueba no aparece.

---

## 6. Si algo falla

| Lo que ves | Qué revisar |
|---|---|
| `php` no se reconoce como comando | Falta agregar `C:\xampp\php` al Path. Cierra y abre la consola después de hacerlo. |
| `composer install` falla por una extensión | Revisa las extensiones de `php.ini` de la sección 1 (en especial `zip`, `mbstring` y `openssl`). |
| `could not find driver` | Falta activar `pdo_mysql` (o `pdo_sqlite` para las pruebas) en `php.ini`. Reinicia la consola. |
| `Connection refused` o `Access denied` | MySQL no está encendido en XAMPP, o el usuario/contraseña del `.env` no coinciden. |
| `Unknown database` | El nombre de `DB_DATABASE` no coincide con la base creada en phpMyAdmin. |
| `Table ... doesn't exist` | No se ejecutaron las migraciones. Corre `php artisan migrate`. |
| `Table ... already exists` | Hay dos migraciones que crean la misma tabla. Borra la que sobra en `database/migrations` y ejecuta `php artisan migrate:fresh`. |
| `table ... has no column named ...` | La migración se ejecutó cuando estaba incompleta. Ejecuta `php artisan migrate:fresh`. |
| `View [...] not found` | El archivo de la vista no está en la carpeta correcta o tiene el nombre mal. Debe ser `index.blade.php`. Luego `php artisan view:clear`. |
| Cambié el `.env` y no se nota | Ejecuta `php artisan config:clear` y reinicia `php artisan serve`. |
| Mi prueba no aparece al ejecutar | Revisa que el archivo termine en `Test.php`, que la clase se llame igual y que los métodos empiecen con `test_`. |
| Una prueba sale como `INCOMPLETE` | Todavía tiene la línea `markTestIncomplete`. Reemplaza el contenido del método con tu prueba. |

Nota: `php artisan migrate:fresh` borra todas las tablas y las vuelve a crear. En este proyecto no pierdes nada importante, pero recuerda que elimina los datos que hayas guardado a mano desde el navegador.

---

## 7. Comandos que vas a usar seguido

```bash
php artisan serve                         # iniciar el servidor local
php artisan test                          # ejecutar todas las pruebas
php artisan test --filter=ClienteTest     # ejecutar un solo archivo
php artisan migrate                       # crear las tablas
php artisan migrate:fresh                 # rehacer todas las tablas desde cero
php artisan migrate:status                # ver qué migraciones se ejecutaron
php artisan config:clear                  # limpiar la configuración guardada
php artisan view:clear                    # limpiar las vistas guardadas
```

Para detener el servidor, presiona `Ctrl + C` en la consola donde está corriendo.
