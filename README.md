# Sistema de Administración de Materiales y Maquinaria - ConstruManager

---

## Descripción:

ConstruManager es una aplicación web desarrollada en Laravel diseñada para administrar eficientemente los materiales y maquinaria de una empresa de construcción. Proporciona una plataforma integral para gestionar inventarios, contratos, proveedores y seguimiento del contrato con un apartado de registros.

## Características Principales:

- **Gestión de Inventarios**: Permite mantener un registro detallado de los materiales y maquinaria disponibles, incluyendo información como nombre, precio/unidad o precio/dia y cantidad en stock.

- **Gestión de Contratos**: Permite crear contratos entre la empresa y sus clientes para la transacción de materiales y maquinaria. Los contratos incluyen el cliente con el cual se realiza, sus contactos en caso de ser varios encargados, los materiales y maquinarias solicitadas con su cantidad, el precio/unidad o precio/dia elegido en el inventario, y registros de los diferentes avances en la entrega de los items solicitados.

- **Administración de Proveedores**: Facilita la gestión de proveedores, con la capacidad de agregar, editar y eliminar proveedores, así como visualizar su información de contacto.

- **Seguimiento de Avances**: Los contratos pueden contener registros de avances en la entrega de materiales y maquinaria solicitados por los clientes. Esto permite mantener un seguimiento detallado del progreso de cada interacción con el cliente.

## Instalación:

1. Clona el repositorio desde GitHub: `git clone https://github.com/DanielRHades/ConstruManager_Laravel.git`
2. Accede al directorio del proyecto: `cd ContruManager_Laravel`
3. Instala las dependencias de Composer: `composer install`
4. Crea una copia del archivo `.env.example` y renómbrala como `.env`
5. Genera la clave de la aplicación: `php artisan key:generate`
6. Configura la base de datos en el archivo `.env`
7. Inicia el servicio de MySQL y Apache en XAMPP
8. Ejecuta las migraciones de la base de datos: `php artisan migrate`
9. Instala las dependencias de Node.js: `npm install`
10. Compila los activos de frontend: `npm run dev`
11. Inicia el servidor: `php artisan serve`
12. Accede a la aplicación desde tu navegador: `http://localhost:8000`

## Requisitos del Sistema:

- PHP >= 8.0.2
- Composer
- npm

Este README proporciona una visión general de la aplicación web ConstruManager y cómo instalarla, incluyendo el paso adicional para compilar los activos de frontend con `npm run dev`.

