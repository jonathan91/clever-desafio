<?php
namespace App\Service\Handler\Customers;

use App\Service\Command\AbstractCommand;
use App\Service\Handler\AbstractHandler;
use App\Entity\Customers;

class DeleteHandler extends AbstractHandler
{
    /**
     *
     * {@inheritdoc}
     * @see \App\Service\Handler\AbstractHandler::handle()
     */
    public function handle(AbstractCommand $command)
    {
        return $this->delete(new Customers(), $command);
    }
}