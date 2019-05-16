<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Controllers\Blog\BaseBlogController;

/**
 * Базовый контроллер для всех контроллеров управления
 * блогом в панеле администрирования.
 *
 * Должен быть родителем всех контроллеров управления блогом.
 *
 * Class BaseBlogAdminController
 * @package App\Http\Controllers\Blog\Admin
 */
abstract class BaseBlogAdminController extends BaseBlogController
{
    /**
     * BaseBlogAdminController constructor.
     */
    public function __construct()
    {
        // Инициализация общих моментов для админки
    }
}