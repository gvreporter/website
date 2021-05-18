<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $post = new Post;
        $post->title = "Articolo di Milano";
        $post->slug = Str::slug("Articolo di Milano");
        $post->user_id = 1;
        $post->cover_url = "https://www.hotelalgamilano.it/sites/alga2torri.gisnet.it/files/Hotel_Santa_Barbara_Milano_01t.jpg";
        $post->save();
        Storage::disk('posts')->put($post->id . '.md', "# Articolo di test");

        $post = new Post;
        $post->title = "Articolo di Bologna";
        $post->slug = Str::slug("Articolo di Bologna");
        $post->user_id = 1;
        $post->cover_url = "https://www.prologis.it/sites/italy/files/images/2018/05/3000x2400-it_bologna-italy.jpg";
        $post->save();
        Storage::disk('posts')->put($post->id . '.md', "# Articolo di test");

        $post = new Post;
        $post->title = "Articolo di Firenze";
        $post->slug = Str::slug("Articolo di Firenze");
        $post->user_id = 1;
        $post->cover_url = "https://images.lonelyplanetitalia.it/uploads/firenze?q=80&p=slider&s=5ea359c02d3477ff82b9bed88a04a7ac";
        $post->save();
        Storage::disk('posts')->put($post->id . '.md', "# Articolo di test");
    }
}
