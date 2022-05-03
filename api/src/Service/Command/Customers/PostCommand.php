<?php
namespace App\Service\Command\Customers;

use App\Service\Command\AbstractCommand;
use Symfony\Component\Validator\Constraints as Assert;

class PostCommand extends AbstractCommand
{
    /**
	 * @var int
     * 
  	 */
	public $id;
    
    /**
    * @var string 
    * 
    * @Assert\NotBlank()
    * 
    * @Assert\Length(
    *    min = 0, 
    *    max = 80))
    * 
    * @Assert\Range(
    *      min = 0,
    *      max = 80,
    *      minMessage = "The min value required is {{ limit }}",
    *      maxMessage = "The max value required is {{ limit }}"
    * )
    * 
    */
    public $name;
    
    /**
    * @var string 
    * 
    * @Assert\NotBlank()
    * 
    * @Assert\Length(
    *    min = 1, 
    *    max = 4))
    * 
    * @Assert\Range(
    *      min = 1,
    *      max = 4,
    *      minMessage = "The min value required is {{ limit }}",
    *      maxMessage = "The max value required is {{ limit }}"
    * )
    * 
    */
    public $coutry;
    
    /**
    * @var string 
    * 
    * @Assert\NotBlank()
    * 
    */
    public $phone;
    
}