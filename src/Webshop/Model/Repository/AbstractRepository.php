<?php

namespace Webshop\Model\Repository;

use Doctrine\DBAL\Connection;
use Webshop\Model\Entity\EntityInterface;

abstract class AbstractRepository
{
    /**
     * @var Connection
     */
    protected $db;

    /**
     * @return string
     */
    abstract public function tableName();

    /**
     * @return string
     */
    abstract public function tableClass();

    /**
     * @param Connection $db
     */
    public function __construct(Connection $db)
    {
        $this->db = $db;
    }

    /**
     * @return array
     */
    public function findAll()
    {
        $records = $this->db->fetchAll(
            sprintf(
                'SELECT * FROM %s',
                $this->tableName()
            )
        );

        $entities = [];
        foreach ($records as $record) {
            /** @var EntityInterface $className */
            $className = $this->tableClass();
            $entity = $className::deserialize($record);

            $entities[] = $entity;
        }

        return $entities;
    }

    /**
     * @param $id
     *
     * @return array
     */
    public function find($id)
    {
        $record = $this->db->fetchAssoc(
            sprintf(
                'SELECT * FROM %s WHERE id = ? LIMIT 1',
                $this->tableName()
            ),
            [(int) $id]
        );

        /** @var EntityInterface $className */
        $className = $this->tableClass();

        return $className::deserialize($record);
    }

    /**
     * @param array $data
     *
     * @return int
     */
    public function insert(array $data)
    {
        return $this->db->insert($this->tableName(), $data);
    }

    /**
     * @param array $data
     * @param array $identifier
     *
     * @return int
     */
    public function update(array $data, array $identifier)
    {
        return $this->db->update($this->tableName(), $data, $identifier);
    }

    /**
     * @param array $identifier
     *
     * @return int
     */
    public function delete(array $identifier)
    {
        return $this->db->delete($this->tableName(), $identifier);
    }
}
