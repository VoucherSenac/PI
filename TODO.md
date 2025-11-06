# TODO: Traduzir textos das páginas abertas no VSCode para português

## Passos a serem executados:

1. **Criar arquivo de idioma geral**: Criar `resources/lang/pt_BR/app.php` com traduções para textos gerais não relacionados à autenticação.

2. **Adicionar traduções ao arquivo auth.php**: Adicionar chaves faltantes para navegação e outros textos em `resources/lang/pt_BR/auth.php`.

3. **Traduzir welcome.blade.php**: Substituir textos hardcoded em inglês por chaves de tradução em `resources/views/welcome.blade.php`.

4. **Verificar e atualizar navigation.blade.php**: Garantir que todas as chaves de tradução estejam presentes nos arquivos de idioma.

5. **Testar traduções**: Verificar se as traduções aparecem corretamente nas páginas.

6. **Adicionar botão Voltar**: Adicionar botão de voltar nas telas de autenticação (login, register, forgot-password, reset-password, verify-email, confirm-password).

7. **Adicionar botões de navegação**: Adicionar botão "Já registrado?" no cadastro (leva ao login) e "Não tem conta?" no login (leva ao cadastro).

## Status:
- [x] Passo 1: Criar resources/lang/pt_BR/app.php
- [x] Passo 2: Atualizar resources/lang/pt_BR/auth.php
- [x] Passo 3: Editar resources/views/welcome.blade.php
- [x] Passo 4: Verificar resources/views/layouts/navigation.blade.php
- [x] Passo 5: Testar (Servidor iniciado em http://127.0.0.1:8000)
- [x] Passo 6: Traduzir dashboard.blade.php
- [x] Passo 7: Traduzir navigation.blade.php (Perfil e Sair)
- [x] Passo 8: Adicionar botão Voltar nas telas de autenticação
- [x] Passo 9: Adicionar botões de navegação entre login e cadastro

# TODO: Implementar limpeza automática da fila de pacientes

## Passos a serem executados:

1. **Criar comando Artisan**: Criar um comando para limpar a fila de pacientes.

2. **Agendar execução diária**: Configurar o comando para executar diariamente às 00:00.

3. **Testar comando**: Executar o comando manualmente para verificar se funciona.

## Status:
- [x] Passo 1: Criar comando `app:clear-queue`
- [x] Passo 2: Agendar execução diária em `routes/console.php`
- [x] Passo 3: Testar comando (executado com sucesso)
