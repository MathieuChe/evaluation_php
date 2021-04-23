<?php

namespace eCommerce\Repository;

use eCommerce\Model\User;
use PDOException;
use Simplex\Service\Hydrator;

class UserManager
{
    public $db;

    public function __construct()
    {
        $this->db = (new DBA())->getPDO();
    }

    public function addUser(User $user)
    {
        try {
            $ADD_USER = $this->db->prepare("
            INSERT INTO `user` 
            (email, encryptedPassword, firstName, lastName) VALUES " . " (:email, :encryptedPassword, :firstName, :lastName) ");

            $ADD_USER->bindValue(':email', $user->getEmail());
            $ADD_USER->bindValue(':encryptedPassword', $user->getEncryptedPassword());
            $ADD_USER->bindValue(':firstName', $user->getFirstName());
            $ADD_USER->bindValue(':lastName', $user->getLastName());

            $ADD_USER->execute();
        } catch (PDOException $e) {
            var_dump($e);
            die;
        }
    }

    public function updateUser(User $user)
    {

        try {
            $UP_USER = $this->db->prepare("
            UPDATE `user` 
            SET email=:email, firstName=:firstName, lastName=:lastName");

            $UP_USER->bindValue(':email', $user->getEmail());
            $UP_USER->bindValue(':firstName', $user->getFirstName());
            $UP_USER->bindValue(':lastName', $user->getLastName());

            if (!$UP_USER->execute()) {
                dd($UP_USER->errorInfo());
            }
        } catch (PDOException $e) {
            var_dump($e);
            die;
        }
    }

    public function deleteUser(User $user)
    {
        $USER = $this->db->prepare('DELETE FROM user WHERE id=:id');
        $USER->bindValue(':id', $user->getId());

        if (!$USER->execute()) {
            dd($USER->errorInfo());
        }
    }

    public function findByEmail(string $email)
    {
        $statement = $this->db->prepare(
            "SELECT * FROM user WHERE email=:email LIMIT 1"
        );
        $statement->bindValue('email', $email);
        $statement->execute();
        $userData = $statement->fetch(\PDO::FETCH_ASSOC);

        if (!$userData) return false;

        return Hydrator::hydrate(User::class, $userData);
    }

    public function findById(string $id)
    {
        $statement = $this->db->prepare(
            "SELECT * FROM user WHERE id=:id LIMIT 1"
        );
        $statement->bindValue('id', $id);
        $statement->execute();
        $userData = $statement->fetch(\PDO::FETCH_ASSOC);

        if (!$userData) return false;

        return Hydrator::hydrate(User::class, $userData);
    }
}
