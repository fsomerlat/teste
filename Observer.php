/**
 *Padrão de projeto comportamental que permite que você defina um mecanismo de assinatura para
 *notificar múltiplos objetos sobre * quaisquer eventos que aconteçam com o objeto que eles estão observando.
*/
<?php

namespace App\Observer;

interface Observer
{
    public function update(string $event, mixed $data): void;
}

//Classe Pai
class EventManager
{
    private array $observers = [];

    public function subscribe(string $event, Observer $observer): void
    {
        $this->observers[$event][] = $observer;
    }

    public function unsubscribe(string $event, Observer $observer): void
    {
        if (!isset($this->observers[$event])) {
            return;
        }
        $this->observers[$event] = array_filter(
            $this->observers[$event],
            fn($obs) => $obs !== $observer
        );
    }

    public function notify(string $event, mixed $data): void
    {
        if (!isset($this->observers[$event])) {
            return;
        }
        foreach ($this->observers[$event] as $observer) {
            $observer->update($event, $data);
        }
    }
}

//Classe intermediadora - log

class DBLogger implements Observer
{
    public function update(string $event, mixed $data): void
    {
        echo "Log: Evento '$event' ocorreu com os dados: " . json_encode($data) . "\n";
    }
}

//Classe 2
class DBObservable
{
    private EventManager $eventManager;

    public function __construct()
    {
        $this->eventManager = new EventManager();
    }

    public function getEventManager(): EventManager
    {
        return $this->eventManager;
    }

    public function saveData(array $data): void
    {
        // Simulando a operação de salvamento no banco
        echo "Salvando dados no banco...\n";
        $this->eventManager->notify('data_saved', $data);
    }
}

// Exemplo de uso
$dbObservable = new DBObservable();
$logger = new DBLogger();

$dbObservable->getEventManager()->subscribe('data_saved', $logger);
$dbObservable->saveData(['id' => 1, 'name' => 'Teste']);