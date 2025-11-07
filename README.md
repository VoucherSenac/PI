# Sistema de Gerenciamento Hospitalar

Sistema completo para gerenciamento de pacientes, triagens, consultas e atendimentos médicos.

## Requisitos

- **PHP 8.2 ou superior**
- **Composer** (Gerenciador de dependências PHP)
- **Node.js** (Para compilação de assets)
- **SQLite** (Banco de dados padrão)

## Instalação Automática

1. **Baixe ou clone o projeto**
2. **Execute o setup automático**:
   ```
   setup.bat
   ```
   Este script irá:
   - Instalar todas as dependências PHP (Composer)
   - Instalar dependências Node.js (npm)
   - Compilar os assets (CSS/JS)
   - Configurar o ambiente (.env)
   - Gerar chave da aplicação
   - Executar migrações do banco
   - Popular o banco com dados de exemplo (seeders)

## Executar o Sistema

Após o setup, execute:
```
run.bat
```

Ou manualmente:
```
php artisan serve
```

Acesse: http://localhost:8000

## Funcionalidades

### 👥 Gestão de Pacientes
- Cadastro completo de pacientes
- Busca e paginação
- Edição de dados

### 📋 Triagem
- Avaliação inicial de pacientes
- Sinais vitais (pressão, frequência cardíaca, temperatura, peso, altura)
- Classificação por gravidade (vermelho, laranja, amarelo, verde, azul)
- Hábitos e histórico médico

### 🏥 Consultas
- Agendamento de consultas
- Atendimento médico
- Registro de diagnósticos e medicamentos
- Histórico de consultas

### 📊 Fila de Atendimento
- Ordenação por prioridade de gravidade
- Gerenciamento da fila

## Estrutura do Banco

O sistema utiliza as seguintes tabelas principais:
- `users` - Usuários do sistema
- `pacientes` - Dados dos pacientes
- `medicos` - Profissionais médicos
- `triagems` - Avaliações iniciais
- `consultas` - Consultas e atendimentos
- `consultorios` - Salas de atendimento

## Desenvolvimento

### Comandos Úteis

```bash
# Instalar dependências
composer install
npm install

# Compilar assets para desenvolvimento
npm run dev

# Compilar assets para produção
npm run build

# Executar migrações
php artisan migrate

# Popular banco com dados de exemplo
php artisan db:seed

# Limpar cache
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

## Tecnologias Utilizadas

- **Laravel 12** - Framework PHP
- **Tailwind CSS** - Framework CSS
- **Alpine.js** - Framework JavaScript
- **SQLite** - Banco de dados
- **Blade** - Template engine

## Licença

Este projeto é para fins educacionais.

---

**SENAC - Sistema de Gerenciamento Hospitalar**
