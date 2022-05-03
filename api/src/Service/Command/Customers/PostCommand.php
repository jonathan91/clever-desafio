<?php
namespace App\Service\Command\Customers;

use App\Service\Command\AbstractCommand;
use App\Validator\Constraints as CustomAssert;
use Symfony\Component\Validator\Constraints as Assert;

class PostCommand extends AbstractCommand
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
    * @Assert\Choice({"CM", "ET", "MA", "MZ", "UG"})
    * @CustomAssert\Code(field="iso")
    */
    public string $iso;
    /**
    * @Assert\NotBlank()
    * @CustomAssert\Phone(field="iso")
    */
    public string $phone;
}