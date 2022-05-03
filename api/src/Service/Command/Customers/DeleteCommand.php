<?php
namespace App\Service\Command\Customers;

use App\Service\Command\AbstractCommand;
use Symfony\Component\Validator\Constraints as Assert;

class DeleteCommand extends AbstractCommand
{
    /**
     * @Assert\NotBlank() 
  	 */
	public int $id;
    
}