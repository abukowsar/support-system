<?php

use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // How many create you need, defaulting to 10
        $count =10;

        $this->command->info("Creating {$count} articles/knowledge and videos.");

        // Create
        factory(App\Article::class, $count)->create();
        factory(App\Knowledge::class, $count)->create();

        $this->command->info('Articles/Knowledge and Videos is created!');
    }
}
