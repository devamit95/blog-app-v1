<?php

namespace App\Repositories;

use App\Models\Post;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface PostRepository
{
    public function recent(int $limit = 5);
    public function paginate(int $perPage = 10): LengthAwarePaginator;

}
