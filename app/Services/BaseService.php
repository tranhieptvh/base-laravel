<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Exception;

abstract class BaseService
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    protected function beginTransaction()
    {
        DB::beginTransaction();
    }

    protected function commit()
    {
        DB::commit();
    }

    protected function rollback()
    {
        DB::rollBack();
    }

    protected function handleException(Exception $e)
    {
        $this->rollback();
        throw $e;
    }

    protected function executeInTransaction(callable $callback)
    {
        try {
            $this->beginTransaction();
            $result = $callback();
            $this->commit();
            return $result;
        } catch (Exception $e) {
            $this->handleException($e);
        }
    }
} 