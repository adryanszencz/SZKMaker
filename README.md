# SZK Maker — Landing Page

Página pública profissional conectada ao seu sistema de gestão.

## Como funciona

- **Catálogo automático:** as peças cadastradas no `/print3d/` aparecem aqui sozinhas
- **Botões WhatsApp:** todos abrem direto sua conversa com a mensagem pronta
- **Formulário de orçamento:** envia direto pro WhatsApp com tudo organizado
- **Slogan e nome:** vem do que você configurou no painel

## Como instalar no Hostinger

### 1. Editar config.php

Abra `includes/config.php` e coloque as **MESMAS** credenciais do banco que você usou no `/print3d/`:

```php
define('DB_NAME', 'u363376205_seubanco');
define('DB_USER', 'u363376205_seuuser');
define('DB_PASS', 'sua_senha');
```

(Use exatamente as mesmas que estão em `/print3d/includes/config.php`)

### 2. Subir os arquivos

No **Gerenciador de Arquivos do Hostinger**, suba todos os arquivos para a **raiz** do `public_html`:

```
public_html/
├── index.php           ← este aqui é a landing
├── .htaccess
├── assets/
│   ├── css/style.css
│   └── img/icone.png
├── includes/
│   └── config.php      ← edite com suas credenciais
└── print3d/            ← seu sistema (já está aqui)
```

### 3. Configurar o WhatsApp no sistema

1. Acessa `seudominio.com/print3d/`
2. Vai em **Configurações**
3. Coloca o **WhatsApp padrão** (ex: `41999999999`)
4. Salva

Pronto! A landing já vai usar esse número em todos os botões.

## URLs do projeto

- **Landing pública:** `https://adryanszenczuk.com.br/`
- **Sistema admin:** `https://adryanszenczuk.com.br/print3d/`

## Personalização

### Adicionar/remover peças do catálogo

Cadastra/exclui no painel `/print3d/peças`. Aparece automaticamente.

### Mudar slogan, nome da loja

Edita em `/print3d/configurações`. A landing pega de lá.

### Trocar depoimentos

Os depoimentos estão fixos no `index.php`. Procure por `<!-- ===== DEPOIMENTOS ===== -->` e edite os textos diretamente.

### Trocar fotos das peças

Atualmente o catálogo mostra um ícone genérico. Para mostrar fotos reais, será necessário adicionar upload de imagem no sistema (próxima evolução).

---

**Site online:** sua marca SZK Maker no ar! 🚀
