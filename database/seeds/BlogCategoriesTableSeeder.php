<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

/**
 * Class BlogCategoriesTableSeeder
 */
class BlogCategoriesTableSeeder extends Seeder
{
    /**
     * Генерируем таблицу с категориями для постов блога.
     *
     * @return void
     */
    public function run()
    {
        $categories = [];
        $cName = 'Без категории';

        // первоначальный масив с первым пустым значением
        $categories[] = [
            'title' => $cName,
            'slug' => Str:: slug($cName),
            'parent_id' => 0,
        ];

        // в цикле наполняем массив 10 значениями
        for ($i = 1; $i <= 10; $i++) {
            $cName = 'Категория #' . $i;
            $parentId = ($i > 4) ? rand(1, 4) : 1;

            $categories[] = [
                'title' => $cName,
                'slug' => Str:: slug($cName),
                'parent_id' => $parentId,
            ];
        }

        \DB::table('blog_categories')->insert($categories);
    }
}
