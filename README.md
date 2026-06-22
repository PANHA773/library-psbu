# PSBU Library Management System

## Requirements

- [Docker](https://www.docker.com/get-started) & Docker Compose
- Git

## Services

| Service    | Container              | Port          |
|------------|------------------------|---------------|
| App        | `library_psbu_app`     | 8080 → 80     |
| MySQL 8.0  | `library_psbu_mysql`   | 3307 → 3306   |
| phpMyAdmin | `library_psbu_phpmyadmin` | 8081 → 80  |

## Quick Start

### 1. Clone the repository

```bash
git clone <repository-url>
cd old_project
```

### 2. Start the containers

```bash
docker compose up -d
```

On first run, Docker will:
- Build the PHP 8.2 + Nginx image
- Install Composer dependencies
- Run database migrations automatically
- Seed SQL files from `./sqlfile/`

### 3. Open the app

- **App** → http://127.0.0.1:8080
- **phpMyAdmin** → http://127.0.0.1:8081

> Use `127.0.0.1:8080` (not `localhost:8080`) — the license is bound to `127.0.0.1`.

---

## Environment Variables

Key variables are set directly in `docker-compose.yml`:

| Variable       | Default                  | Description               |
|----------------|--------------------------|---------------------------|
| `APP_KEY`      | *(set in compose file)*  | Laravel encryption key    |
| `APP_URL`      | `http://127.0.0.1:8080`  | Used by `asset()` helper  |
| `DB_DATABASE`  | `library_psbu`           | Database name             |
| `DB_USERNAME`  | `laravel`                | Database user             |
| `DB_PASSWORD`  | `secret`                 | Database password         |

To override defaults, set them in your shell before running `docker compose up`:

```bash
export DB_DATABASE=my_db
export DB_PASSWORD=mypassword
docker compose up -d
```

---

## Common Commands

### View logs

```bash
docker compose logs -f app
docker compose logs -f mysql
```

### Run Artisan commands

```bash
docker exec library_psbu_app php artisan <command>

# Examples
docker exec library_psbu_app php artisan migrate
docker exec library_psbu_app php artisan cache:clear
docker exec library_psbu_app php artisan config:clear
docker exec library_psbu_app php artisan route:clear
```

### Open a shell inside the container

```bash
docker exec -it library_psbu_app bash
```

### Rebuild after code changes

```bash
docker compose build --no-cache app
docker compose up -d
```

### Stop all containers

```bash
docker compose down
```

### Stop and remove volumes (⚠ deletes database data)

```bash
docker compose down -v
```

---

## Database

- SQL seed files in `./sqlfile/` are loaded automatically on first run by MySQL's `docker-entrypoint-initdb.d`.
- To re-seed, remove the MySQL volume and restart:

```bash
docker compose down -v
docker compose up -d
```

- Connect via phpMyAdmin at http://127.0.0.1:8081
  - Host: `mysql`
  - Username: `root`
  - Password: `rootsecret` *(or your `DB_PASSWORD`)*

---

## Storage & Cache

Two host directories are mounted as volumes so data persists across container restarts:

| Host path          | Container path                    |
|--------------------|-----------------------------------|
| `./storage`        | `/var/www/html/storage`           |
| `./bootstrap/cache`| `/var/www/html/bootstrap/cache`   |

If you see stale config errors after changing environment variables, clear the cache:

```bash
docker exec library_psbu_app php artisan config:clear
docker exec library_psbu_app php artisan cache:clear
```

---

## License

The app uses a domain-locked license stored at:

```
storage/protected/.../license.key
```

The license is validated against the request hostname. Always access the app via `http://127.0.0.1:8080` to match the license identifier.

To activate a new license, visit: http://127.0.0.1:8080/contact-license/activate-license
