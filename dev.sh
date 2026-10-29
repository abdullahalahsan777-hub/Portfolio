# Portfolio - Laravel Development Server Launcher for Git Bash
echo -e "\033[1;36m===================================================\033[0m"
echo -e "\033[1;36m     Portfolio - Laravel Development Server (Git Bash) \033[0m"
echo -e "\033[1;36m===================================================\033[0m"
echo ""

# Ensure we are in the project root directory
SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
cd "$SCRIPT_DIR" || exit 1

# Ensure PHP is in PATH if in XAMPP
if ! command -v php &> /dev/null; then
    if [ -d "/c/xampp/php" ]; then
        export PATH="/c/xampp/php:$PATH"
        echo "[INFO] Added /c/xampp/php to PATH"
    fi
fi

# Ensure Composer is in PATH if in C:/composer
if ! command -v composer &> /dev/null; then
    if [ -d "/c/composer" ]; then
        export PATH="/c/composer:$PATH"
    fi
fi

# Read server port and app url from .env
SERVER_PORT="8000"
APP_URL="http://127.0.0.1"

if [ -f .env ]; then
    ENV_PORT=$(grep -E '^SERVER_PORT=' .env | cut -d '=' -f2 | tr -d '\r')
    if [ -n "$ENV_PORT" ]; then
        SERVER_PORT="$ENV_PORT"
    fi
    ENV_URL=$(grep -E '^APP_URL=' .env | cut -d '=' -f2 | tr -d '\r')
    if [ -n "$ENV_URL" ]; then
        APP_URL="$ENV_URL"
    fi
fi

echo -e "\033[1;32m[INFO] Local Server URL: ${APP_URL}:${SERVER_PORT}\033[0m"
echo ""

# Execute dev server
if command -v composer &> /dev/null; then
    echo -e "\033[1;34m[INFO] Executing: composer run dev\033[0m"
    echo ""
    composer run dev
else
    echo -e "\033[1;33m[WARN] Composer not found directly. Running via npx concurrently...\033[0m"
    echo ""
    npx concurrently -c "#93c5fd,#c4b5fd,#fdba74" \
        "php artisan serve --host=127.0.0.1 --port=${SERVER_PORT}" \
        "php artisan queue:listen --tries=1 --timeout=0" \
        "npm run dev" \
        --names=server,queue,vite --kill-others
fi

STATUS=$?
if [ $STATUS -ne 0 ]; then
    echo ""
    echo -e "\033[1;31m[ERROR] Process exited with status code ${STATUS}.\033[0m"
fi

