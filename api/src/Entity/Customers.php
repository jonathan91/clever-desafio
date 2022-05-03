<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="customers")
 * @ORM\Entity(repositoryClass="App\Repository\CustomersRepository")
 */
class Customers extends AbstractEntity 
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected int $id;
    /**
    * @ORM\Column(name="name", type="string", nullable=false)
    */
    protected string $name;
    /**
    * @ORM\Column(name="coutry_code", type="string", nullable=false, unique=true)
    */
    protected string $coutry;
    /**
    * @ORM\Column(name="iso_code", type="string", nullable=false, unique=true)
    */
    protected string $iso;
    /**
    * @ORM\Column(name="phone", type="string", nullable=false)
    */
    protected string $phone;

    /**
    * @ORM\Column(name="status", type="string", nullable=false)
    */
    protected string $status;
    
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

    public function getIso(): string
    {
        return $this->iso;
    }

    public function setIso(string $iso): Customers
    {
        $this->iso = $iso;
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

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): Customers
    {
        $this->status = $status;
        return $this;
    }
}