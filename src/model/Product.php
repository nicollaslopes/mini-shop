<?php

namespace app\model;

class Product extends Model
{
  public int $id;
  public string $name;
  public int $price;
  public string $slug;
  public int $quantity;
  public string $image;
  public static string $table = 'products';

  public function setId(int $id)
  {
    $this->id = $id;
  }

  public function setName(string $name)
  {
    $this->name = $name;
  }

  public function setPrice(int $price)
  {
    $this->price = $price;
  }

  public function setSlug(string $slug)
  {
    $this->slug = $slug;
  }

  public function setQuantity(int $quantity)
  {
    $this->quantity = $quantity;
  }

  public function getId()
  {
    return $this->id;
  }

  public function getName()
  {
    return $this->name;
  }

  public function getPrice()
  {
    return $this->price;
  }

  public function getSlug()
  {
    return $this->slug;
  }

  public function getQuantity()
  {
    return $this->quantity;
  }
}