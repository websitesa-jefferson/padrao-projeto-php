<?php

namespace App\Estrutura\Bridge;

/**
 * A implementação declara um conjunto de métodos "reais", "ocultos" e "de plataforma".
 * Nesse caso, a Implementação lista os métodos de renderização que podem ser usados ​​para compor qualquer página da web.
 * Diferentes abstrações podem usar diferentes métodos de implementação.
 */
interface Renderer
{
    public function renderTitle(string $title): string;

    public function renderTextBlock(string $text): string;

    public function renderImage(string $url): string;

    public function renderLink(string $url, string $title): string;

    public function renderHeader(): string;

    public function renderFooter(): string;

    public function renderParts(array $parts): string;
}
