<?php
namespace App\Service\Command\Customers;

use App\Service\Command\AbstractCommand;
use Symfony\Component\Validator\Constraints as Assert;

class PutCommand extends AbstractCommand
{
	public int $id;
    /**
    * @Assert\NotBlank()
    * @Assert\Length(
    *    min = 0, 
    *    max = 80
    * )
    */
    public string $name;
    /**
    * @Assert\NotBlank()
    * @Assert\Length(
    *    min = 1, 
    *    max = 4
    * )
    */
    public string $coutry;
    /**
    * @Assert\NotBlank()
    * @Assert\Length(max = 2)
    */
    public string $iso;
    /**
    * @Assert\NotBlank()
    */
    public string $phone;
}