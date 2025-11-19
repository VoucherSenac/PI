@echo off
echo ========================================
echo   Sistema de Gerenciamento Hospitalar
echo ========================================
echo.

echo Abrindo navegador padrao no localhost:8000...
start cmd /c explorer "http://localhost:8000"

echo Navegando para o diretorio do projeto...
cd c:/Users/tlglab203/Documents/PI

echo Executando key:generate...
php artisan key:generate

echo Executando migrations...
php artisan migrate

echo Executando seeders...
php artisan db:seed

echo Executando composer run dev...
composer run dev

pause
