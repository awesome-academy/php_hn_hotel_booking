<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Contracts\BaseRepositoryInterface;

abstract class BaseRepository implements BaseRepositoryInterface
{
    //model muốn tương tác
    protected $model;

    //khởi tạo
    public function __construct()
    {
        $this->setModel();
    }

    //lấy model tương ứng
    abstract public function getModel();

    /**
     * Set model
     */
    public function setModel()
    {
        $this->model = app()->make(
            $this->getModel()
        );
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        $result = $this->model->find($id);

        return $result;
    }

    public function create($attributes = [])
    {
        return $this->model->create($attributes);
    }

    public function update($id, $attributes = [])
    {
        $result = $this->find($id);
        if ($result) {
            $result->update($attributes);

            return $result;
        }
        return false;
    }

    public function delete($id)
    {
        $result = $this->find($id);
        if ($result) {
            $result->delete();

            return true;
        }

        return false;
    }

    public function insert($data)
    {
        return $this->model->insert($data);
    }

    public function findOrFail($id)
    {
        $result = $this->model->findOrFail($id);

        return $result;
    }

    public function pluck($colum, $conditions = [], $relations = [], $orders = [])
    {
        $query = $this->filter($conditions, $orders, $relations);

        return $query->pluck($colum)->toArray();
    }

    public function getAllWithCondition(
        $columns = array('*'),
        $conditions = [],
        $relations = [],
        $orders = [],
        $function = null
    ) {
        $query = $this->filter($conditions, $orders, $relations);

        if (empty($function)) {
            return $query->get($columns);
        }

        return $query->get($columns)->$function();
    }

    public function filter($conditions, $orders, $relations)
    {
        $model = $this->model
            ->when(!empty($orders), function ($query) use ($orders) {
                foreach ($orders as $field => $direction) {
                    $query = $query->orderBy($field, $direction);
                }
            })->when(empty($orders), function ($query) {
                $query->orderBy('created_at', 'desc');
            });

        return $this->buildQueryFromFilter($model, $conditions)
            ->when(!empty($relations), function ($query) use ($relations) {
                $query->with($relations);
            });
    }

    private function buildQueryFromFilter($query, $filter = [])
    {
        if (!empty($filter)) {
            $query->where(function ($query) use ($filter) {
                if (isset($filter['whereIn'])) {
                    foreach ($filter['whereIn'] as $key => $arr) {
                        $query->whereIn($key, $arr);
                    }
                    unset($filter['whereIn']);
                }

                if (isset($filter['whereNotIn'])) {
                    foreach ($filter['whereNotIn'] as $key => $arr) {
                        $query->whereNotIn($key, $arr);
                    }
                    unset($filter['whereNotIn']);
                }

                if (isset($filter['orWhereIn'])) {
                    foreach ($filter['orWhereIn'] as $key => $arr) {
                        $query->orWhereIn($key, $arr);
                    }
                    unset($filter['orWhereIn']);
                }

                if (isset($filter['where'])) {
                    $query->where($filter['where']);
                    unset($filter['where']);
                }

                if (isset($filter['orWhere'])) {
                    foreach ($filter['orWhere'] as $row) {
                        $query->orWhere($row[0], $row[1], $row[2]);
                    }
                    unset($filter['orWhere']);
                }

                if (isset($filter['whereNull'])) {
                    foreach ($filter['whereNull'] as $row) {
                        $query->whereNull($row);
                    }
                    unset($filter['whereNull']);
                }

                if (!empty($filter['relations'])) {
                    foreach ($filter['relations'] as $relation => $filter_2) {
                        if (!empty($filter_2['whereHas'])) {
                            $_filter = $filter_2['whereHas'];
                            $query->whereHas($relation, function ($query) use ($_filter) {
                                $this->buildQueryFromFilter($query, $_filter);
                            });
                        }

                        if (!empty($filter_2['orWhereHas'])) {
                            $_filter = $filter_2['orWhereHas'];
                            $query->orWhereHas($relation, function ($query) use ($_filter) {
                                $this->buildQueryFromFilter($query, $_filter);
                            });
                        }
                    }
                    unset($filter['relations']);
                }
            });
        }

        if (!empty($filter['conditions'])) {
            foreach ($filter['conditions'] as $row) {
                $this->buildQueryFromFilter($query, $row);
            }
        }

        return $query;
    }

    public function paginateList($per = 10, $conditions = [], $relations = [], $orders = [])
    {
        $query = $this->filter($conditions, $orders, $relations);

        return $query->paginate($per);
    }
}
