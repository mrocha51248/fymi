<?php

namespace App\Model;

class TagManager extends AbstractManager
{
    public const TABLE = 'tag';

    public function selectInstrumentFromTag(string $name): array
    {
        $query = "SELECT i.*
                FROM instrument_tag i_t
                INNER JOIN instrument i
                ON i_t.instrument_id = i.id
                INNER JOIN tag t
                ON i_t.tag_id = t.id
                WHERE t.name = :name";

        $statement = $this->pdo->prepare($query);
        $statement->bindValue("name", $name, \PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetchAll();
    }
}
