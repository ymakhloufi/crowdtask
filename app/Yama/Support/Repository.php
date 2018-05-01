<?php

namespace Yama\Support;

use App\Exceptions\RepositoryException;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class Repository
{

    /**
     * @var Model
     */
    protected $model;


    /**
     * @throws RepositoryException
     */
    public function __construct()
    {
        $this->makeModel();
    }


    /**
     * Specify Model class name
     *
     * @return string
     */
    abstract function model(): string;


    /**
     * @param array $columns
     *
     * @return Collection|Model[]
     */
    public function all(array $columns = ['*'])
    {
        return $this->model->get($columns);
    }


    /**
     * @param int   $perPage
     * @param array $columns
     *
     * @return LengthAwarePaginator
     */
    public function paginate(int $perPage = 15, array $columns = ['*']): LengthAwarePaginator
    {
        return $this->model->paginate($perPage, $columns);
    }


    /**
     * @param array $data
     * @param bool  $unguardModel
     *
     * @return Model
     *
     */
    public function create(array $data, bool $unguardModel = false)
    {
        $wasInitiallyUnguarded = $this->model->isUnguarded();

        if ($unguardModel) {
            $this->unguard();
        }

        $obj = $this->model->create($data);

        if (!$wasInitiallyUnguarded and $unguardModel) {
            $this->reguard();
        }

        return $obj;
    }


    /**
     * @param array  $data
     * @param int    $id
     * @param string $attribute
     *
     * @return Model
     */
    public function update(array $data, int $id, string $attribute = "id")
    {
        return $this->model->where($attribute, '=', $id)->update($data);
    }


    /**
     * @param int $id
     *
     * @return int
     */
    public function delete(int $id): int
    {
        return $this->model->destroy($id);
    }


    /**
     * @param int   $id
     * @param array $columns
     *
     * @return Model
     */
    public function find(int $id, array $columns = ['*'])
    {
        return $this->model->find($id, $columns);
    }


    /**
     * @param string $attribute
     * @param mixed  $value
     * @param array  $columns
     *
     * @return Model
     */
    public function findBy(string $attribute, $value, array $columns = ['*'])
    {
        return $this->model->where($attribute, '=', $value)->first($columns);
    }


    /**
     * @param array $attributes
     * @param array $columns
     *
     * @return Model
     */
    public function findByMulti(array $attributes, array $columns = ['*'])
    {
        $query = $this->model->newQuery();
        foreach ($attributes as $attr => $val) {
            $query = $query->where($attr, $val);
        }

        return $query->first($columns);
    }


    /**
     * @throws RepositoryException
     */
    public function makeModel()
    {
        $model = app($this->model());

        if (!$model instanceof Model) {
            throw new RepositoryException("Class {$this->model()} must be an instance of " . Model::class);
        }

        $this->model = $model;
    }


    public function unguard()
    {
        $this->model->unguard();
    }


    public function reguard()
    {
        $this->model->reguard();
    }
}
