<?php

namespace App\Repositories\Contracts;

interface BaseRepositoryInterface
{
    public function getAll();

    /**
     * Get one
     * @param $id
     * @return mixed
     */
    public function find($id);

    /**
     * Create
     * @param array $attributes
     * @return mixed
     */
    public function create($attributes = []);

    /**
     * Update
     * @param $id
     * @param array $attributes
     * @return mixed
     */
    public function update($id, $attributes = []);

    /**
     * Delete
     * @param $id
     * @return mixed
     */
    public function delete($id);

    /**
     * Create mutiple data
     * @param array $attributes
     * @return mixed
     */
    public function insert($data);

    /**
     * Get one
     * @param $id
     * @return mixed
     */
    public function findOrFail($id);

    /**
     * Pluck columns
     * @param $column, $key, $sortColumn, $direction
     * @return mixed
     */
    public function pluck($column, $key = null, $sortColumn = null, $direction = 'asc');

    /**
     * Get all data
     * @param $columns, $conditions, $relations, $orders
     * @return mixed
     */
    public function getAllWithCondition($columns = array('*'), $conditions = [], $relations = [], $orders = []);

    /**
     * Get all data with paginate
     * @param $columns, $conditions, $relations, $orders
     * @return mixed
     */
    public function paginateList($per = 10, $conditions = [], $relations = [], $orders = []);
}
