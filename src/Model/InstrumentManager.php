<?php

namespace App\Model;

class InstrumentManager extends AbstractManager
{
    public const TABLE = 'instrument';

    public function selectTagFromInstrument(int $id): array
    {
        $query = "SELECT t.*
                FROM instrument_tag i_t
                INNER JOIN tag t
                ON i_t.tag_id = t.id
                WHERE i_t.instrument_id = :id";

        $statement = $this->pdo->prepare($query);
        $statement->bindValue("id", $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }
}
