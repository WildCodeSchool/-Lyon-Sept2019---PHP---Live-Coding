<?php
/**
 * Created by PhpStorm.
 * User: sylvain
 * Date: 07/03/18
 * Time: 18:20
 * PHP version 7
 */

namespace App\Model;

/**
 *
 */
class TodoManager extends AbstractManager
{
    /**
     *
     */
    const TABLE = 'todo';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    /**
     * @param array $todo
     * @return int
     */
    public function insert(array $todo): int
    {
        // prepared request
        $statement = $this->pdo->prepare("INSERT INTO $this->table (`content`) VALUES (:content)");
        $statement->bindValue('content', $todo['content'], \PDO::PARAM_STR);

        if ($statement->execute()) {
            return (int)$this->pdo->lastInsertId();
        }
    }

    public function update(array $todo):bool
    {
        // prepared request
        $statement = $this->pdo->prepare("UPDATE $this->table SET `content` = :content WHERE id=:id");
        $statement->bindValue('id', $todo['id'], \PDO::PARAM_INT);
        $statement->bindValue('content', $todo['content'], \PDO::PARAM_STR);

        return $statement->execute();
    }

    /**
     * @param int $id
     */
    public function delete(int $id): void
    {
        // prepared request
        $statement = $this->pdo->prepare("DELETE FROM $this->table WHERE id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
    }
}
