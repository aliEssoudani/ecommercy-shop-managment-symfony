<?php


namespace App\servecies;


use App\Entity\Categories;

class CategoryService
{
    public function __construct($worker)
    {
        $this->manager = $worker;
    }


    public function add($name, $store)
    {
        $category = new Categories();
        $category->setTitle($name);
        $category->setStores($store);
        $this->manager->persist($category);
        $this->manager->flush();
    }

    public function update($name, Categories $category)
    {
        $category->setTitle($name);
        $this->manager->flush();
    }

    public function delete($id)
    {
       $toRemove = $this->manager->find($id);
        $this->manager->remove($toRemove);
        $this->manager->flush();
    }
}