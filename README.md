# TPC Docker Environment

This repository wraps the legacy TPC PHP application, MariaDB and phpMyAdmin inside a reproducible Docker Compose stack so you and teammates can boot the full environment with a single command.

## Requirements

- [Docker Desktop](https://www.docker.com/products/docker-desktop/) (includes Docker Compose v2)
- Git (to clone or contribute changes)

## Project Layout

```
.
├── docker-compose.yml        # Orchestrates web (PHP/Apache), db (MariaDB) and phpMyAdmin
├── Dockerfile.web            # Custom Apache image enabling mod_rewrite + PDO MySQL
├── htdocs/                   # Application code (served at http://localhost:8080/)
│   └── tpc/                  # Main PHP app
└── db/
    └── init/tpc.sql          # Seed dump imported into MariaDB on first boot
```

## Getting Started

1. Clone or copy this folder to your machine.
2. From the `xampp-docker` directory run:

   ```bash
   docker compose up -d --build
   ```

   - `web` → `http://localhost:8080/tpc`
   - `phpmyadmin` → `http://localhost:8081/` (login: `tpc_user` / `secret` or `root` / `root`)

3. When finished, stop everything with:

   ```bash
   docker compose down
   ```

   Add `-v` if you want to wipe the MariaDB data volume and re-import `db/init/tpc.sql`.

## Database Credentials

| Variable      | Value      |
| ------------- | ---------- |
| host          | `db` (inside Docker) / `localhost` from host |
| port          | `3306`     |
| database      | `tpc`      |
| user          | `tpc_user` |
| password      | `secret`   |

`htdocs/tpc/class/connexion.db.php` reads `DB_HOST`, `DB_USER`, etc., so you can override them (for example when running the code directly in XAMPP) without editing PHP files.

## Tips

- Place any new SQL dumps in `db/init/` before the **first** `docker compose up`. To re-import later, run `docker compose down -v && docker compose up -d --build`.
- If you need to work outside Docker (e.g., XAMPP), the PHP code falls back to `127.0.0.1`, user `root`, blank password.
- Version control the entire directory so teammates always get matching Docker + PHP code. Add sensitive data (e.g., `.env` files) to `.gitignore` if needed.
