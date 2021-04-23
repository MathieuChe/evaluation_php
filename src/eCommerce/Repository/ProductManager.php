<?php

namespace eCommerce\Repository;

use eCommerce\Model\Product;
use PDOException;
use Simplex\Service\Hydrator;

class ProductManager
{
    private  $_db;

    public function __construct()
    {
        $this->_db = (new DBA())->getPDO();
    }

    public function addProduct(Product $product)
    {
        try {
            $ADD_PRODUCT = $this->_db->prepare("
        INSERT INTO `product` (name, price, user_id) VALUES " . " (:name, :price, :user_id) ");

            $ADD_PRODUCT->bindValue(':name', $product->getName());
            $ADD_PRODUCT->bindValue(':price', $product->getPrice());
            $ADD_PRODUCT->bindValue(':user_id', $product->getUser_id());
            $ADD_PRODUCT->execute();
        } catch (PDOException $e) {
            var_dump($e);
            die;
        }
    }

    public function getProducts(): array
    {
        $sth =  $this->_db->prepare(
            'SELECT * FROM product'
        );

        $sth->execute();
        return $sth->fetchAll();
    }

    public function updateProduct(Product $product)
    {
        try {
            $UP_PRODUCT = $this->_db->prepare("
        UPDATE `product` SET name=:name, price=:price WHERE id=:id");

            $UP_PRODUCT->bindValue(':name', $product->getName());
            $UP_PRODUCT->bindValue(':price', $product->getPrice());
            $UP_PRODUCT->bindValue(':id', $product->getId());

            if (!$UP_PRODUCT->execute()) {
                dd($UP_PRODUCT->errorInfo());
            }
        } catch (PDOException $e) {
            var_dump($e);
            die;
        }
    }

    public function getProduct($product_id)
    {
        $PRODUCT = $this->_db->prepare('SELECT * FROM product WHERE id=:id');
        $PRODUCT->bindValue(':id', $product_id);
        $PRODUCT->execute();
        return $PRODUCT->fetch(\PDO::FETCH_ASSOC);
    }

    public function getUserProducts($user_id_product)
    {
        $PRODUCT = $this->_db->prepare('SELECT * FROM product WHERE user_id=:user_id');
        $PRODUCT->bindValue(':user_id', $user_id_product);
        if (!$PRODUCT->execute()) {
            $PRODUCT->errorInfo();
        }

        return $PRODUCT->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function deleteProduct(string $product_id)
    {
        $PRODUCT = $this->_db->prepare('DELETE FROM product WHERE id=:id');
        $PRODUCT->bindValue(':id', $product_id);

        if (!$PRODUCT->execute()) {
            $PRODUCT->errorInfo();
        }
    }
}
