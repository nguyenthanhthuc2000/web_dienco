<?php

namespace App\Repository;

use App\Repository\RepositoryInterface;

abstract class BaseRepository implements RepositoryInterface
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
        $this->model = $this->getModel();
    }

    public function get()
    {
        return $this->model->paginate();
    }

    public function getAll()
    {
        return $this->model->orderBy('id', 'DESC')->paginate();
    }

    public function getAllActive()
    {
        return $this->model->where('status', 1)->orderBy('id', 'DESC')->paginate();
    }

    public function getAllItem()
    {
        return $this->model->orderBy('id', 'DESC')->get();
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
            return $result->update($attributes);
        }
        return false;
    }

    public function delete($id)
    {
        $result = $this->find($id);
        if ($result) {
            if($result->delete()){
                return true;
            }
        }

        return false;
    }

    public function getByAttributes($attributes)
    {
        $result = $this->model->where($attributes)->orderBy('id', 'DESC')->paginate();

        return $result;
    }

    public function getByAttributesAll($attributes)
    {
        $result = $this->model->where($attributes)->orderBy('id', 'DESC')->get();

        return $result;
    }
    
    public function getIdBySlug($slug){
        return $this->model->where('slug', $slug)->first()->id;
    }
}
