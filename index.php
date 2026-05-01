<?php
/**
 * Landing Page - SZK Maker
 * Conecta-se ao banco do sistema para puxar peças automaticamente
 */

require_once 'includes/config.php';

// Buscar peças do catálogo
$pecas = [];
$nome_loja = 'SZK Maker';
$slogan = 'Onde sua ideia vira realidade — camada por camada';
$subtitulo = 'Handcrafted 3D Prints';
$whatsapp = '';

try {
    $db = getDB();
    $stmt = $db->query("SELECT * FROM pecas ORDER BY criado_em DESC LIMIT 12");
    $pecas = $stmt->fetchAll();
    
    // Configurações
    $stmt = $db->query("SELECT chave, valor FROM configuracoes");
    while ($row = $stmt->fetch()) {
        if ($row['chave'] === 'nome_loja' && $row['valor']) $nome_loja = $row['valor'];
        if ($row['chave'] === 'slogan' && $row['valor']) $slogan = $row['valor'];
        if ($row['chave'] === 'subtitulo' && $row['valor']) $subtitulo = $row['valor'];
        if ($row['chave'] === 'whatsapp_padrao' && $row['valor']) $whatsapp = $row['valor'];
    }
} catch (Exception $e) {
    // Se der erro de banco, mostra a página com dados padrão
}

$whatsapp_clean = preg_replace('/\D/', '', $whatsapp);
$whatsapp_link = $whatsapp_clean ? "https://wa.me/55{$whatsapp_clean}" : 'https://wa.me/';

// URL absoluta para Open Graph
$base_url = (isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="theme-color" content="#0a0a0a">
<title><?= htmlspecialchars($nome_loja) ?> — <?= htmlspecialchars($subtitulo) ?></title>
<meta name="description" content="<?= htmlspecialchars($slogan) ?>. Impressão 3D personalizada, peças exclusivas e produtos sob encomenda no litoral do Paraná.">

<!-- Favicon -->
<link rel="icon" type="image/png" href="assets/img/icone.png">
<link rel="apple-touch-icon" href="assets/img/icone.png">

<!-- Open Graph -->
<meta property="og:type" content="website">
<meta property="og:title" content="<?= htmlspecialchars($nome_loja) ?> — <?= htmlspecialchars($subtitulo) ?>">
<meta property="og:description" content="<?= htmlspecialchars($slogan) ?>">
<meta property="og:image" content="<?= $base_url ?>/assets/img/icone.png">
<meta property="og:url" content="<?= $base_url ?>">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?= htmlspecialchars($nome_loja) ?> — <?= htmlspecialchars($subtitulo) ?>">
<meta name="twitter:description" content="<?= htmlspecialchars($slogan) ?>">
<meta name="twitter:image" content="<?= $base_url ?>/assets/img/icone.png">

<link rel="stylesheet" href="assets/css/style.css?v=3">
</head>
<body>

<!-- ===== HEADER / NAV ===== -->
<header class="navbar">
    <div class="container nav-inner">
        <a href="#topo" class="nav-logo">
            <img src="assets/img/icone.png" alt="<?= htmlspecialchars($nome_loja) ?>" width="36" height="36">
            <span><?= htmlspecialchars($nome_loja) ?></span>
        </a>
        <nav class="nav-links">
            <a href="#sobre">Sobre</a>
            <a href="#catalogo">Catálogo</a>
            <a href="#como-funciona">Como funciona</a>
            <a href="#depoimentos">Depoimentos</a>
            <a href="#faq">FAQ</a>
        </nav>
        <a href="#orcamento" class="btn btn-primary btn-sm">Orçamento</a>
        <button class="nav-toggle" onclick="toggleMenu()" aria-label="Menu">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
        </button>
    </div>
</header>

<a id="topo"></a>

<!-- ===== HERO ===== -->
<section class="hero">
    <div class="container hero-inner">
        <div class="hero-content">
            <span class="hero-badge"><?= htmlspecialchars($subtitulo) ?></span>
            <h1 class="hero-title">
                <span class="hero-eyebrow">Onde sua</span>
                <em>ideia</em>
                vira realidade
                <span class="hero-title-thin">camada por camada</span>
            </h1>
            <p class="hero-description">
                Impressão 3D personalizada com qualidade artesanal.
                Do conceito ao objeto físico — peças únicas, sob medida, feitas com cuidado em cada detalhe.
            </p>
            <div class="hero-actions">
                <a href="#orcamento" class="btn btn-brand btn-lg">Pedir orçamento</a>
                <a href="#catalogo" class="btn btn-secondary btn-lg">Ver catálogo</a>
            </div>
            <div class="hero-stats">
                <div class="hero-stat">
                    <strong><?= count($pecas) ?>+</strong>
                    <span>Modelos no catálogo</span>
                </div>
                <div class="hero-stat">
                    <strong>3D</strong>
                    <span>Tecnologia FDM</span>
                </div>
                <div class="hero-stat">
                    <strong>PR</strong>
                    <span>Litoral do Paraná</span>
                </div>
            </div>
        </div>
        <div class="hero-visual">
            <div class="hero-icon-wrapper">
                <img src="assets/img/icone.png" alt="" class="hero-icon">
            </div>
            <div class="hero-deco hero-deco-1"></div>
            <div class="hero-deco hero-deco-2"></div>
            <div class="hero-deco hero-deco-3"></div>
        </div>
    </div>
</section>

<!-- ===== DIFERENCIAIS (faixa estilo cartaz da marca) ===== -->
<section class="diferenciais">
    <div class="container">
        <div class="diferenciais-grid">
            <div class="diferencial">
                <div class="diferencial-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="14" width="7" height="6" rx="1"/>
                        <rect x="3" y="6" width="7" height="6" rx="1"/>
                        <rect x="14" y="14" width="7" height="6" rx="1"/>
                        <rect x="14" y="6" width="7" height="6" rx="1"/>
                    </svg>
                </div>
                <div class="diferencial-text">
                    <strong>Impressão 3D<br>de alta precisão</strong>
                    <span>FDM com calibração rigorosa</span>
                </div>
            </div>
            <div class="diferencial">
                <div class="diferencial-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 2L2 7l10 5 10-5-10-5z"/>
                        <path d="M2 17l10 5 10-5"/>
                        <path d="M2 12l10 5 10-5"/>
                    </svg>
                </div>
                <div class="diferencial-text">
                    <strong>Acabamento<br>profissional</strong>
                    <span>Revisão peça a peça</span>
                </div>
            </div>
            <div class="diferencial">
                <div class="diferencial-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                        <path d="M9 12l2 2 4-4"/>
                    </svg>
                </div>
                <div class="diferencial-text">
                    <strong>Qualidade<br>garantida</strong>
                    <span>Se não passar no padrão, refaço</span>
                </div>
            </div>
            <div class="diferencial">
                <div class="diferencial-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"/>
                        <path d="M12 8v4l3 2"/>
                    </svg>
                </div>
                <div class="diferencial-text">
                    <strong>Do conceito<br>ao objeto</strong>
                    <span>Te acompanho do início ao fim</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== SOBRE ===== -->
<section id="sobre" class="section section-light">
    <div class="container">
        <div class="section-header">
            <span class="section-tag">SOBRE</span>
            <h2 class="section-title">Cada peça tem uma história.<br>A sua começa aqui.</h2>
        </div>
        
        <div class="about-grid">
            <div class="about-text">
                <p class="about-lead">A <strong>SZK Maker</strong> nasceu da paixão por transformar ideias em objetos reais. Cada impressão é tratada como uma peça única — porque é.</p>
                <p>Trabalhamos com tecnologia <strong>FDM de alta precisão</strong>, materiais de qualidade e atenção artesanal a cada detalhe. Do design ao acabamento, você acompanha o processo.</p>
                <p>Atendemos pedidos personalizados, peças sob encomenda, presentes únicos, prototipagem e muito mais. Se você imagina, a gente imprime.</p>
            </div>
            <div class="about-cards">
                <div class="about-card">
                    <div class="about-card-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/>
                        </svg>
                    </div>
                    <h3>Rapidez</h3>
                    <p>Entrega em poucos dias para a maioria das peças, com prazo definido na hora do orçamento.</p>
                </div>
                <div class="about-card">
                    <div class="about-card-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="13.5" cy="6.5" r="2.5"/>
                            <circle cx="17.5" cy="10.5" r="2.5"/>
                            <circle cx="8.5" cy="7.5" r="2.5"/>
                            <circle cx="6.5" cy="12.5" r="2.5"/>
                            <path d="M12 22a10 10 0 119.99-9.84A4 4 0 0118 16h-1a2 2 0 00-1 3.75A1.3 1.3 0 0115 22h-3z"/>
                        </svg>
                    </div>
                    <h3>Personalização</h3>
                    <p>Nomes, cores, tamanhos, modelos exclusivos. Cada peça do jeito que você quer.</p>
                </div>
                <div class="about-card">
                    <div class="about-card-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M6 3h12l4 6-10 13L2 9z"/>
                            <path d="M11 3L8 9l4 13 4-13-3-6"/>
                            <path d="M2 9h20"/>
                        </svg>
                    </div>
                    <h3>Qualidade</h3>
                    <p>Acabamento artesanal e revisão peça a peça. Se não passar no nosso padrão, não sai daqui.</p>
                </div>
                <div class="about-card">
                    <div class="about-card-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"/>
                        </svg>
                    </div>
                    <h3>Atendimento direto</h3>
                    <p>Você fala diretamente com quem produz. Sem intermediários, sem complicação.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== CATÁLOGO ===== -->
<section id="catalogo" class="section">
    <div class="container">
        <div class="section-header center">
            <span class="section-tag">CATÁLOGO</span>
            <h2 class="section-title">Algumas das nossas peças</h2>
            <p class="section-description">Modelos disponíveis para encomenda. Quer algo diferente? <a href="#orcamento">Faça um pedido personalizado</a>.</p>
        </div>
        
        <?php if (count($pecas) > 0): ?>
        <div class="catalog-grid">
            <?php foreach ($pecas as $p): ?>
            <article class="catalog-card">
                <div class="catalog-card-image">
                    <svg viewBox="0 0 100 100" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M50 15L80 30v40L50 85L20 70V30L50 15z" stroke-linejoin="round"/>
                        <path d="M50 50L80 30M50 50L20 30M50 50V85" stroke-linejoin="round"/>
                    </svg>
                </div>
                <div class="catalog-card-body">
                    <h3 class="catalog-card-title"><?= htmlspecialchars($p['nome']) ?></h3>
                    <?php if ($p['descricao']): ?>
                    <p class="catalog-card-desc"><?= htmlspecialchars(mb_strimwidth($p['descricao'], 0, 80, '...')) ?></p>
                    <?php endif; ?>
                    <div class="catalog-card-meta">
                        <?php if ($p['peso_filamento']): ?>
                        <span><?= number_format($p['peso_filamento'], 0) ?>g</span>
                        <?php endif; ?>
                        <?php if ($p['tempo_impressao']): ?>
                        <span><?= number_format($p['tempo_impressao'], 1) ?>h</span>
                        <?php endif; ?>
                    </div>
                    <div class="catalog-card-footer">
                        <strong class="catalog-card-price">R$ <?= number_format($p['preco_venda'], 2, ',', '.') ?></strong>
                        <a href="<?= $whatsapp_link ?>?text=<?= urlencode("Olá! Tenho interesse na peça: " . $p['nome']) ?>" target="_blank" class="btn btn-secondary btn-sm">Pedir</a>
                    </div>
                </div>
            </article>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
        <div class="empty-catalog">
            <p>Catálogo em construção. <a href="#orcamento">Faça um pedido personalizado</a> e a gente faz pra você!</p>
        </div>
        <?php endif; ?>
    </div>
</section>

<!-- ===== COMO FUNCIONA ===== -->
<section id="como-funciona" class="section section-dark">
    <div class="container">
        <div class="section-header center">
            <span class="section-tag light">COMO FUNCIONA</span>
            <h2 class="section-title">Do pedido à entrega em 4 passos</h2>
        </div>
        
        <div class="steps">
            <div class="step">
                <div class="step-number">01</div>
                <h3>Você conta sua ideia</h3>
                <p>Manda o que precisa pelo WhatsApp ou pelo formulário. Pode ser um modelo do catálogo, uma referência ou até um STL pronto.</p>
            </div>
            <div class="step">
                <div class="step-number">02</div>
                <h3>Recebe o orçamento</h3>
                <p>Eu retorno com o valor, tempo de produção e prazo de entrega. Tudo claro, sem surpresas.</p>
            </div>
            <div class="step">
                <div class="step-number">03</div>
                <h3>Aprovou? Imprimimos</h3>
                <p>Confirmação + pagamento e a peça vai pra impressora. Acompanhamos cada camada com cuidado.</p>
            </div>
            <div class="step">
                <div class="step-number">04</div>
                <h3>Entrega ou retirada</h3>
                <p>Combinamos a melhor forma — retirada, entrega no litoral ou envio para outras regiões.</p>
            </div>
        </div>
    </div>
</section>

<!-- ===== DEPOIMENTOS ===== -->
<section id="depoimentos" class="section section-light">
    <div class="container">
        <div class="section-header center">
            <span class="section-tag">DEPOIMENTOS</span>
            <h2 class="section-title">Quem encomenda, recomenda</h2>
        </div>
        
        <div class="testimonials">
            <div class="testimonial">
                <div class="testimonial-stars">★★★★★</div>
                <p>"Plaquinha do meu cachorro ficou perfeita! Acabamento impecável e o atendimento foi muito atencioso. Já estou pensando em encomendar mais coisas."</p>
                <div class="testimonial-author">
                    <strong>Suelen</strong>
                    <span>Cliente Pet</span>
                </div>
            </div>
            <div class="testimonial">
                <div class="testimonial-stars">★★★★★</div>
                <p>"Comprei chaveiros personalizados para presentear meus amigos. Todos amaram! O preço foi justo e a qualidade muito acima do que eu esperava."</p>
                <div class="testimonial-author">
                    <strong>Cliente</strong>
                    <span>Personalizados</span>
                </div>
            </div>
            <div class="testimonial">
                <div class="testimonial-stars">★★★★★</div>
                <p>"Precisei de uma peça específica e o Adryan resolveu na hora. Profissional, rápido e o resultado superou minhas expectativas."</p>
                <div class="testimonial-author">
                    <strong>Cliente</strong>
                    <span>Sob encomenda</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== ORÇAMENTO ===== -->
<section id="orcamento" class="section">
    <div class="container">
        <div class="cta-card">
            <div class="cta-content">
                <span class="section-tag">ORÇAMENTO</span>
                <h2 class="section-title">Conta sua ideia<br>pra gente <em>começar</em></h2>
                <p class="section-description">Preenche o formulário ou chama no WhatsApp. Respondo o quanto antes com o valor e o prazo.</p>
                
                <div class="cta-actions">
                    <a href="<?= $whatsapp_link ?>?text=<?= urlencode("Olá! Gostaria de fazer um orçamento na SZK Maker.") ?>" target="_blank" class="btn btn-whatsapp btn-lg">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                        Falar no WhatsApp
                    </a>
                </div>
            </div>
            
            <form class="cta-form" id="formOrcamento" onsubmit="enviarOrcamento(event)">
                <div class="form-group">
                    <label>Seu nome *</label>
                    <input type="text" name="nome" required placeholder="Como posso te chamar?">
                </div>
                <div class="form-group">
                    <label>WhatsApp ou e-mail *</label>
                    <input type="text" name="contato" required placeholder="(41) 99999-9999 ou seu@email.com">
                </div>
                <div class="form-group">
                    <label>O que você precisa? *</label>
                    <textarea name="descricao" required rows="4" placeholder="Descreve a peça, modelo, cor, tamanho, prazo... Quanto mais detalhe, melhor!"></textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-block btn-lg">Enviar pedido pelo WhatsApp</button>
                <p class="form-note">Ao enviar, abre o WhatsApp com sua mensagem pronta.</p>
            </form>
        </div>
    </div>
</section>

<!-- ===== FAQ ===== -->
<section id="faq" class="section section-light">
    <div class="container container-narrow">
        <div class="section-header center">
            <span class="section-tag">FAQ</span>
            <h2 class="section-title">Perguntas frequentes</h2>
        </div>
        
        <div class="faq">
            <details class="faq-item">
                <summary>Quanto tempo leva pra ficar pronto?</summary>
                <p>Depende do tamanho e complexidade da peça. Itens simples ficam prontos em 1-3 dias, peças maiores ou com personalização podem levar de 5 a 10 dias. O prazo exato vai no orçamento.</p>
            </details>
            <details class="faq-item">
                <summary>Vocês imprimem em quais cores?</summary>
                <p>Trabalhamos com várias cores de PLA — preto, branco, vermelho, azul, verde, amarelo, transparente e mais. Pergunta no orçamento qual está disponível pra sua peça.</p>
            </details>
            <details class="faq-item">
                <summary>Posso enviar meu próprio modelo (STL)?</summary>
                <p>Pode sim! Se você já tem o arquivo, manda pelo WhatsApp que a gente imprime. Avalio o modelo, calcula o material e te passa o orçamento.</p>
            </details>
            <details class="faq-item">
                <summary>Atendem em qual região?</summary>
                <p>Estamos no litoral do Paraná (Matinhos e região). Fazemos entregas locais e enviamos para outras cidades pelos Correios ou transportadora.</p>
            </details>
            <details class="faq-item">
                <summary>Como funciona o pagamento?</summary>
                <p>Aceitamos PIX, transferência, dinheiro e cartão. Em geral, 50% no pedido e 50% na entrega — mas isso a gente combina.</p>
            </details>
            <details class="faq-item">
                <summary>Posso pedir uma peça única / exclusiva?</summary>
                <p>Esse é nosso forte! Trabalhamos com personalização e modelos exclusivos. Manda sua ideia, referência ou foto que a gente desenvolve junto com você.</p>
            </details>
        </div>
    </div>
</section>

<!-- ===== FOOTER ===== -->
<footer class="footer">
    <div class="container">
        <div class="footer-grid">
            <div class="footer-brand">
                <div class="footer-logo">
                    <img src="assets/img/icone.png" alt="<?= htmlspecialchars($nome_loja) ?>" width="40" height="40">
                    <div>
                        <strong><?= htmlspecialchars($nome_loja) ?></strong>
                        <span><?= htmlspecialchars($subtitulo) ?></span>
                    </div>
                </div>
                <p class="footer-slogan">"<?= htmlspecialchars($slogan) ?>"</p>
                <div class="footer-social">
                    <a href="https://instagram.com/szk.maker" target="_blank" aria-label="Instagram @szk.maker">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="2" width="20" height="20" rx="5"/>
                            <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z"/>
                            <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/>
                        </svg>
                    </a>
                    <?php if ($whatsapp): ?>
                    <a href="<?= $whatsapp_link ?>" target="_blank" aria-label="WhatsApp">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                    </a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="footer-col">
                <h4>Navegação</h4>
                <a href="#sobre">Sobre</a>
                <a href="#catalogo">Catálogo</a>
                <a href="#como-funciona">Como funciona</a>
                <a href="#faq">FAQ</a>
            </div>
            <div class="footer-col">
                <h4>Contato</h4>
                <?php if ($whatsapp): ?>
                <a href="<?= $whatsapp_link ?>" target="_blank">WhatsApp</a>
                <?php endif; ?>
                <a href="#orcamento">Pedir orçamento</a>
                <span>Litoral do Paraná</span>
            </div>
        </div>
        <div class="footer-bottom">
            <span>© <?= date('Y') ?> <?= htmlspecialchars($nome_loja) ?>. Todos os direitos reservados.</span>
            <span>Feito <span class="footer-bottom-brand">camada por camada</span></span>
        </div>
    </div>
</footer>

<!-- ===== BOTÃO FLUTUANTE WHATSAPP ===== -->
<a href="<?= $whatsapp_link ?>?text=<?= urlencode("Olá! Vim pelo site da SZK Maker.") ?>" target="_blank" class="float-whatsapp" aria-label="WhatsApp">
    <svg width="28" height="28" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
</a>

<script>
const WHATSAPP_LINK = <?= json_encode($whatsapp_link) ?>;

function toggleMenu() {
    document.querySelector('.nav-links').classList.toggle('open');
}

document.querySelectorAll('.nav-links a').forEach(a => {
    a.addEventListener('click', () => {
        document.querySelector('.nav-links').classList.remove('open');
    });
});

function enviarOrcamento(e) {
    e.preventDefault();
    const form = e.target;
    const nome = form.nome.value;
    const contato = form.contato.value;
    const descricao = form.descricao.value;
    
    let mensagem = `*Pedido de Orçamento — SZK Maker*\n\n`;
    mensagem += `👤 *Nome:* ${nome}\n`;
    mensagem += `📞 *Contato:* ${contato}\n\n`;
    mensagem += `📋 *O que preciso:*\n${descricao}\n\n`;
    mensagem += `_Enviado pelo site_`;
    
    const url = WHATSAPP_LINK + '?text=' + encodeURIComponent(mensagem);
    window.open(url, '_blank');
}

// Scroll suave
document.querySelectorAll('a[href^="#"]').forEach(link => {
    link.addEventListener('click', function(e) {
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            e.preventDefault();
            target.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    });
});

// Efeito navbar ao rolar
let lastScroll = 0;
window.addEventListener('scroll', () => {
    const nav = document.querySelector('.navbar');
    if (window.scrollY > 50) nav.classList.add('scrolled');
    else nav.classList.remove('scrolled');
});
</script>

</body>
</html>
