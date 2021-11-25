<?php

namespace App\Model;

class TagManager extends AbstractManager
{
    public const TABLE = 'tag';

    public function selectInstrumentFromTag(int $id): array
    {
        $query = "SELECT i.*
                FROM instrument_tag i_t
                INNER JOIN instrument i
                ON i_t.instrument_id = i.id
                WHERE i_t.tag_id = :id";

        $statement = $this->pdo->prepare($query);
        $statement->bindValue("id", $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }
}
