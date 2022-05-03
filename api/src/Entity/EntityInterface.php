<?php
namespace App\Entity;

interface EntityInterface
{
    public function setValue(string $key, $value);

    public function setValues($data);

    public function getValue(string $key);

    public function toJson();

    public function toArray();
}
