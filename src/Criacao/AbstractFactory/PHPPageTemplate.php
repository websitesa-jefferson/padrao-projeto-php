<?php

namespace App\Criacao\AbstractFactory;

/**
 * A variante PHPTemplate de todos os modelos de página.
 */
class PHPPageTemplate extends BasePageTemplate
{
    public function getTemplateString(): string
    {
        $renderedTitle = $this->titleTemplate->getTemplateString();

        return <<<HTML
        <div class="page">
            $renderedTitle
            <article class="content"><?= \$content ?></article>
        </div>
        HTML;
    }
}
