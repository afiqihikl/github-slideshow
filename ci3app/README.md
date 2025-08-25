# CodeIgniter 3 Auth + CRUD Demo

This is a minimal CodeIgniter 3 app with user registration/login and a simple Items CRUD stored in SQLite.

## Requirements
- PHP 7.2+ with sqlite3 extension

## Quick start

1) Start the PHP dev server from the project root:

```bash
php -S 0.0.0.0:8000 -t /workspace/ci3app
```

2) Open the app:
- Base URL: `http://localhost:8000/`
- Register: `http://localhost:8000/index.php/register`
- Login: `http://localhost:8000/index.php/login`
- Items CRUD (requires login): `http://localhost:8000/index.php/items`

The SQLite database is stored at `application/database/ci3.sqlite`. Tables are created automatically on first use.

## Notes
- Configured in `application/config`: `config.php`, `autoload.php`, `database.php`, `routes.php`.
- Auth: `application/controllers/Auth.php`, `application/models/User_model.php`, views under `application/views/auth`.
- CRUD: `application/controllers/Items.php`, `application/models/Item_model.php`, views under `application/views/items`.
- Basic Bootstrap styling via CDN.