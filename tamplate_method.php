<?php 

/**
 * Esse padrão promove a reutilização de código e a consistência,pois, a lógica comum é mantida na classe base, enquanto as 
 * variações são tratadas nas subclasses. Isso garante que os passos de um algoritmo sejam seguidos, 
 * enquanto ainda se permite flexibilidade nas implementações. 
*/

namespace App\TemplateMethod;

abstract class UsuarioNotificacao
{
    public function notificao(): void
    {
        $this->preparaNotificacao();
        $this->enviaNotificaticao();
        $this->logNotificacao();
    }

    protected abstract function preparaNotificacao(): void;

    protected function enviaNotificaticao(): void
    {
        // Lógica para enviar a notificação
        echo "Notificação enviada.\n";
    }

    protected function logNotificacao(): void
    {
        // Lógica para logar a notificação
        echo "Notificação logada.\n";
    }
}


/**
 * Aqui seria uma outra classe/outro arquivo
*/
namespace App\TemplateMethod;

class EmailNotificacao extends UsuarioNotificacao
{
    protected function preparaNotificacao(): void
    {
        // Lógica para preparar a notificação por e-mail
        echo "Notificação por e-mail preparada.\n";
    }
}