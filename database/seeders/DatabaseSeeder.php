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

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */

    private int $collectionNr = 0;

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

        $randomContributions = ['Autor', 'Ilustrator', 'Editor', 'Destinatar'];
        Collection::factory(10)->create(['created_by' => $user->id])->each(function($collection) use($user, $randomContributions) {
            $this->collectionNr++;
            echo chr(27).chr(91).'H'.chr(27).chr(91).'J';
            echo($this->collectionNr);
            $collection->update(['slug' => Str::slug($collection->title)]);
            $collection->items()
                ->saveMany(Item::factory(500) -> make(['created_by' => $user->id]))
                ->each(function($item) use($user, $randomContributions) {
                    $item->update(['slug' => Str::slug($item->title . $item->created_at)]);
                    $authors = Author::factory(random_int(1,6))->create([
                        'created_by' => $user->id]);
                    foreach ($authors as $author) {
                        $item->authors()->attach($author, ['contribution' => $randomContributions[array_rand($randomContributions)]]);
                    }
                    $item->subjects()->attach(Subject::factory(random_int(3,6))->create());
                    echo($item);
                });
        });
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }


}
