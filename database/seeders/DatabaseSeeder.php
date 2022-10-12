<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Author;
use App\Models\Collection;
use App\Models\Item;
use App\Models\Subject;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;
use function Sodium\randombytes_buf;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::factory()->create([
            'username' => 'admin',
            'role' => 'Admin',
            'first_name' => 'Daniel',
            'last_name' => 'Parlea',
            'email' => 'daniel.parlea@bcub.ro',
            'password' => bcrypt('123asd'),
            'location' => 'BCU Carol I',
        ]);



        // Collection::factory('10')->create([
        //    'created_by' => $user->id,
        // ]);

        //Subject::factory(500)->create();

        Author::factory()->create([
            'created_by'=>$user->id,
            'first_name'=> 'Unknown',
            'last_name' => 'Author',
            'fullname' => 'Unknown Author',

        ]);

        //Item::factory(2000)->hasCollections(3, ['created_by' => '1'])->hasAuthors(3, ['created_by' => '1'])->hasSubjects(3)->create([
       //     'created_by'=>$user->id,
        //    'pdf_path'=>'item/2022/Aug/Quis nemo aut in rem/HFakIg6GRAhmTDUfaiK9EwTrmX2FLdVcTiC0bVqv.pdf'
       // ]);

        Collection::factory(10)->create(['created_by' => $user->id])->each(function($collection) use($user) {
            $collection->update(['slug' => Str::slug($collection->title)]);
            $collection->items()
                ->saveMany(Item::factory(1000) -> make(['created_by' => $user->id]))
                ->each(function($item) use($user) {
                    $item->update(['slug' => Str::slug($item->title)]);
                    $item->authors()->saveMany(Author::factory(random_int(1,6))->make([
                        'created_by' => $user->id,
                    ]));
                    $item->subjects()->saveMany(Subject::factory(random_int(1,6))->make());
                });
        });
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }

    // Used to generate slugs for authors
    function generateRandomString($itemTitle, $length = 10) {
        return str_shuffle($itemTitle) . substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length) ;
    }
}
