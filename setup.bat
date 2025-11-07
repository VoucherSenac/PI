@echo off
echo ========================================
echo   Sistema de Gerenciamento Hospitalar
echo         Setup Automático
echo ========================================
echo.

REM Verificar se o Composer está instalado
composer --version >nul 2>&1
if %errorlevel% neq 0 (
    echo ERRO: Composer não está instalado. Baixe em https://getcomposer.org/
    pause
    exit /b 1
)

REM Verificar se o Node.js está instalado
node --version >nul 2>&1
if %errorlevel% neq 0 (
    echo ERRO: Node.js não está instalado. Baixe em https://nodejs.org/
    pause
    exit /b 1
)

echo Instalando dependências PHP...
composer install
if %errorlevel% neq 0 (
    echo ERRO: Falha ao instalar dependências PHP
    pause
    exit /b 1
)

echo.
echo Instalando dependências Node.js...
npm install
if %errorlevel% neq 0 (
    echo ERRO: Falha ao instalar dependências Node.js
    pause
    exit /b 1
)

echo.
echo Compilando assets...
npm run build
if %errorlevel% neq 0 (
    echo ERRO: Falha ao compilar assets
    pause
    exit /b 1
)

echo.
echo Configurando ambiente...
if not exist .env (
    copy .env.example .env
    echo Arquivo .env criado a partir de .env.example
)

echo.
echo Gerando chave da aplicação...
php artisan key:generate
if %errorlevel% neq 0 (
    echo ERRO: Falha ao gerar chave da aplicação
    pause
    exit /b 1
)

echo.
echo Executando migrações...
php artisan migrate --force
if %errorlevel% neq 0 (
    echo ERRO: Falha ao executar migrações
    pause
    exit /b 1
)

echo.
echo Executando seeders...
php artisan db:seed --force
if %errorlevel% neq 0 (
    echo ERRO: Falha ao executar seeders
    pause
    exit /b 1
)

echo.
echo Limpando cache...
php artisan config:clear
php artisan route:clear
php artisan view:clear

echo.
echo ========================================
echo        Setup concluído com sucesso!
echo ========================================
echo.
echo Para iniciar o servidor, execute:
echo php artisan serve
echo.
echo Ou acesse diretamente:
echo http://localhost:8000
echo.
pause
