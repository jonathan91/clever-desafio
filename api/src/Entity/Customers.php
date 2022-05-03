<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="customers")
 * @ORM\Entity(repositoryClass="App\Repository\CustomersRepository")
 */
class Customers extends AbstractEntity 
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\SequenceGenerator(sequenceName="customers_id_seq", initialValue=1, allocationSize=1)
     */
    protected $id;
    
    /**
    * @var string 
    * @ORM\Column(name="name", type="string", nullable=false)
    * 
    */
    
    protected $name;
    
    /**
    * @var string 
    * @ORM\Column(name="coutry", type="string", nullable=false, unique=true)
    * 
    */
    
    protected $coutry;
    
    /**
    * @var string 
    * @ORM\Column(name="phone", type="string", nullable=false)
    * 
    */
    
    protected $phone;
    
    public function getId(): ?int
    {
        return $this->id;
    }
    
    public function getName(): string
    {
        return $this->name;
    }
    
    public function setName(string $name): Customers
    {
        $this->name = $name;
        return $this;
    }
    
    public function getCoutry(): string
    {
        return $this->coutry;
    }
    
    public function setCoutry(string $coutry): Customers
    {
        $this->coutry = $coutry;
        return $this;
    }
    
    public function getPhone(): string
    {
        return $this->phone;
    }
    
    public function setPhone(string $phone): Customers
    {
        $this->phone = $phone;
        return $this;
    }
    
}