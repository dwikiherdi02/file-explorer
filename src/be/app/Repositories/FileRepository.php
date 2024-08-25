<?php

namespace App\Repositories;

use App\Models\File;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class FileRepository
{
    /**
     * get one of directory data
     * @version 1.0.0
     * @author Dwiki Herdiansyah <github: dwikiherdi02>
     * @param array $selects
     * @param array $wheres
     * @param array $orders
     * @return null|object
     */
    public function find(array $selects = [], array $wheres = [], array $orders = []): null|object
    {
        $model = File::query();

        if (!empty($selects)) {
            $model->select($selects);
        }

        if (!empty($wheres)) {
            foreach ($wheres as $col => $val) {
                $model->where($col, $val);
            }
        }

        if (!empty($orders)) {
            foreach ($orders as $col => $dir) {
                $model->orderBy($col, $dir);
            }
        }

        $model->limit(1);

        return $model->get()->first();
    }

    /**
     * get directory data from ID
     * @version 1.0.0
     * @author Dwiki Herdiansyah <github: dwikiherdi02>
     * @param string $id
     * @return null|object
     */
    public function findByID(string $id, array $selects = []): null|object
    {
        return $this->find(wheres: ['id' => $id], selects: $selects);
    }

    /**
     * get all of directory data
     * @version 1.0.0
     * @author Dwiki Herdiansyah <github: dwikiherdi02>
     * @param string $id
     * @return null|object
     */
    public function findAll(
        array $selects = [],
        array $wheres = [],
        array $orders = [],
        int $limit = 10,
        int $offset = 0
    ): null|object {
        $model = File::query();

        if (!empty($selects)) {
            $model->select($selects);
        }

        if (!empty($wheres)) {
            foreach ($wheres as $col => $val) {
                $model->where($col, $val);
            }
        }

        if (!empty($orders)) {
            foreach ($orders as $col => $dir) {
                $model->orderBy($col, $dir);
            }
        }

        if ($limit > 0) {
            $model->limit($limit);

            if ($offset > 0) {
                $model->offset($offset);
            }
        }

        return $model->get();
    }

    public function storing(array $data = []): bool
    {
        if ($data) {
            DB::beginTransaction();
            try {
                $model = new File();

                $model->fill($data)->save();

                DB::commit();
                return true;
            } catch (\Exception $e) {
                DB::rollback();
                return false;
            }
        }

        return false;
    }
}
