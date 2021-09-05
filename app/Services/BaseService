<?php

namespace App\Services;

use App\Contracts\Services\BaseService as BaseServiceInterface;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Class BaseService.
 *
 * @package namespace App\Services;
 */
class BaseService implements BaseServiceInterface
{

    /**
     * @var Model
     */
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all(): Collection
    {
        return $this->model->all();
    }

    public function get(int $id): ?Model
    {
        return $this->model->find($id);
    }

    public function delete(int $id): void
    {
        $model = $this->get($id);

        if (!isset($model) || is_null($model)) {
            throw new Exception("Model not found", 404);
        }

        $model->delete();
    }
}
