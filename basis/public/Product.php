<?php

class Product
{

	private $name;
	private $description;
	private $image;
	private $price;

	public function __construct($name, $description, $price, $image = null)
	{
		$this->name = $name;
		$this->description = $description;
		$this->price = $price;
		$this->image = $image;
	}

	public function getName()
	{
		return $this->name;
	}

	public function getDescription()
	{
		return $this->description;
	}

	public function getImage()
	{
		return $this->image;
	}

	public function getPrice()
	{
		return $this->price;
	}

}