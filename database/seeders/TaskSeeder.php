<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;


class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 刪除已有的資料 靠模型幫忙
        Task::truncate();
        // 生成新生資料
        Task::factory()->times(100)->create();
    }
}
