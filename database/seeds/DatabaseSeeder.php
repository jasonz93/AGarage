<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(BlogSeeder::class);
    }
}

class BlogSeeder extends \Illuminate\Database\Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $topic = \AGarage\BlogTopic::create([
            'name' => 'Test Topic 1'
        ]);
        for ($i = 0; $i < 10; $i ++) {
            $article = \AGarage\BlogArticle::create([
                'title' => 'Test Article '.$i,
                'content' => "# This is test article $i\n## This is first point\nblahblahblah...\n## This is second point\n"
            ]);
            $topic->articles()->attach($article);
        }
        $topic = \AGarage\BlogTopic::create([
            'name' => 'Test Topic 2'
        ]);
        $topic->articles()->create([
            'title' => 'Test Article XXX',
            'content' => '# This is a special test article'
        ]);

    }
}