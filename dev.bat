@echo off
setlocal enabledelayedexpansion

echo ========================================================
echo   Portfolio Studio - Development Environment Launcher
echo ========================================================
echo.

set SERVER_PORT=
if exist .env (
    for /f "usebackq tokens=1,2 delims==" %%A in (".env") do (
        set "KEY=%%A"
        set "VAL=%%B"
        for /f "tokens=* delims= " %%K in ("!KEY!") do set "KEY=%%K"
        if "!KEY!"=="SERVER_PORT" (
            set "SERVER_PORT=!VAL!"
        )
    )
)

if "%SERVER_PORT%"=="" (
    set SERVER_PORT=8044
)

echo [INFO] Detected SERVER_PORT from .env: %SERVER_PORT%
echo [INFO] Server URL: http://127.0.0.1:%SERVER_PORT%
echo [INFO] Launching Laravel Server, Background Queue, and Vite Asset Bundler...
echo.

npx concurrently -c "#93c5fd,#c4b5fd,#fdba74" "php artisan serve --host=127.0.0.1 --port=%SERVER_PORT%" "php artisan queue:listen --tries=1 --timeout=0" "npm run dev" --names=server,queue,vite --kill-others

if %ERRORLEVEL% NEQ 0 (
    echo.
    echo [ERROR] Dev server stopped with exit code %ERRORLEVEL%.
)

