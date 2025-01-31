### 📚 **Books - Sistema de Gestión de Libros**  

🛠️ **Tecnologías utilizadas:**  
- PHP 8  
- Laragon (Entorno de desarrollo local)  
- MySQL  
- Composer (Gestor de dependencias)  
- MVC (Modelo Vista Controlador)  

---

## 🚀 **Instalación y Configuración**  

### 1️⃣ **Clonar el repositorio**  
```bash
git clone https://github.com/ccmiguel/books.git
cd books
```

### 2️⃣ **Configurar el entorno en Laragon**  
- Mueve el proyecto a `C:\laragon\www\books`  
- Inicia Laragon y asegúrate de que Apache y MySQL estén activos  

### 3️⃣ **Configurar la base de datos**  
- Abre MySQL y crea la base de datos:  
```sql
CREATE DATABASE books_db;
```
- Importa el archivo `books_db.sql` (si existe en tu proyecto)  

### 4️⃣ **Instalar dependencias con Composer**  
```bash
composer install
```

---

## 📂 **Estructura del Proyecto**  

```
books/
│── config/              # Configuración general del sistema
│── controller/          # Controladores principales
│   ├── LoginController.php
│   ├── Ven_booksController.php
│── core/                # Clases y funcionalidades base del sistema
│── database/            # Conexión a la base de datos
│── model/               # Modelos para interactuar con la BD
│   ├── UserModel.php
│   ├── Ven_booksModel.php
│── public/              # Archivos accesibles públicamente (JS, CSS, imágenes)
│── reports/             # Reportes generados por el sistema
│── vendor/              # Librerías instaladas con Composer
│── view/                # Vistas (HTML + PHP)
│   ├── seguridad/       # Vistas de login y registro
│   │   ├── login.php
│   │   ├── register.php
│   ├── web/bok/         # Vistas para la gestión de libros
│   │   ├── create.php
│   │   ├── delete.php
│   │   ├── edit.php
│   │   ├── list.php
│   │   ├── view.php
│── .htaccess            # Configuración de URL amigables
│── composer.json        # Dependencias del proyecto
│── index.php            # Punto de entrada principal
```

---

## 🎯 **Funciones Principales**  
✔️ Registro e inicio de sesión de usuarios  
✔️ CRUD de libros (Crear, Leer, Actualizar, Eliminar)  
✔️ Reportes y estadísticas sobre libros registrados  

---

## 📌 **Contribución**  
Si deseas mejorar el proyecto, sigue estos pasos:  
1. Haz un **fork** del repositorio  
2. Crea una nueva rama: `git checkout -b feature-nueva-funcionalidad`  
3. Realiza tus cambios y haz un commit: `git commit -m "Añadir nueva funcionalidad"`  
4. Sube los cambios: `git push origin feature-nueva-funcionalidad`  
5. Crea un **Pull Request**  

---

## 📝 **Licencia**  
Este proyecto está bajo la licencia **MIT**. Puedes usarlo y modificarlo libremente.  

