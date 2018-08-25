<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

abstract class Repository
{
    /** @var string $className */
    protected $className = '';

    /** @var string $table  */
    protected $table = null;

    /**
     * Repository constructor.
     * @param string $className
     */
    public function __construct(string $className)
    {
        $this->className = $className;
    }

    /**
     * @param Model|array $data
     */
    public function save($data): void
    {
        if (true === is_a($data, Model::class)) {
            $data->save();

            return;
        }

        if (true === is_array($data)) {
            /** @noinspection PhpUndefinedMethodInspection */
            $this->className::create($data);

            return;
        }

        //@TODO Exception
    }

    /**
     * @param mixed $id
     * @return Model|null
     */
    public function find($id): ?Model
    {
        /** @noinspection PhpUndefinedMethodInspection */
        return $this->className::find($id);
    }

    /**
     * @return Collection|Model[]
     */
    public function findAll(): Collection
    {
        /** @noinspection PhpUndefinedMethodInspection */
        return $this->className::all();
    }

    /**
     * @param Model $model
     */
    public function touch(Model $model): void
    {
        $model->touch();
    }

    /**
     * @return string
     */
    public function getTable(): string
    {
        if (null === $this->table) {
            /** @var Model $entity */
            $entity = new $this->className();
            $this->table = $entity->getTable();
        }

        return $this->table;
    }
}
