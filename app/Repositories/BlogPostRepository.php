<?php


namespace App\Repositories;

use App\Models\BlogPost as Model;
use Illuminate\Pagination\LengthAwarePaginator;

class BlogPostRepository extends CoreRepository
{

    /**
     * @return string
     */
    public function getModelClass()
    {
        return Model::class;
    }

    /**
     * Получить список всех статей для вывода в списке
     * (Админко)
     *
     * @return LengthAwarePaginator
     */
    public function getAllWithPaginate()
    {
        $columns = [
          'id', 'title', 'slug', 'is_published', 'published_at', 'user_id', 'category_id'
        ];

        $result = $this->startConditions()
            ->select($columns)
            ->orderBy('id', 'DESC')
            ->with([
                'category' => function($query) {
                    $query->select(['id', 'title']);
                },
                'user:id,name'])
            ->paginate(25);

        return $result;
    }

    /**
     * Получить модель для редактирования.
     * (Админка)
     *
     * @param integer $id
     * @return Model
     */
    public function getEdit($id)
    {
        return $this->startConditions()->find($id);
    }

}