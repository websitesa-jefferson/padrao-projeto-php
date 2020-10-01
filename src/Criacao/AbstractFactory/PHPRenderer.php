<?php

namespace App\Criacao\AbstractFactory;

/**
 * O renderizador para modelos de PHPTemplate. Observe que esta implementação é muito básica, senão grosseira.
 * Usar a função `eval` tem muitas implicações de segurança, então use-a com cuidado em projetos reais.
 */
class PHPRenderer implements TemplateRenderer
{
    public function render(string $templateString, array $arguments = []): string
    {
        extract($arguments);

        ob_start();
        eval(' ?>' . $templateString . '<?php ');
        $result = ob_get_contents();
        ob_end_clean();

        return $result;
    }
}
