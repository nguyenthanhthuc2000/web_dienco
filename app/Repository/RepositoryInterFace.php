<?php

namespace App\Repository;

interface RepositoryInterface
{
    /**
     * Get all
     * @return mixed
     */
    public function get();

    /**
     * Get all
     * @return mixed
     */
    public function getAll();

    /**
     * @return mixed
     */
    public function getAllItem();

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
     * @param array $attributes
     * @return mixed
     */
    public function getByAttributes($attributes);

    /**
     * @param array $attributes
     * @return mixed
     */
    public function getByAttributesAll($attributes);

    /**
     * @param string $slug
     * @return mixed
     */
    public function getIdBySlug($slug);

    public function getAllActive();
}
