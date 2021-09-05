<?php

namespace App\Contracts\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Interface BaseService.
 *
 * @package namespace App\Contracts\Services;
 */
interface BaseService
{
    public function all(): Collection;
    public function get(int $id): ?Model;
    public function delete(int $id): void;
}
