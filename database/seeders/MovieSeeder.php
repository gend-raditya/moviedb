<?php
// database/seeders/MovieSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Movie;

class MovieSeeder extends Seeder
{
    public function run(): void
    {
        $movies = [
            [
                'title' => 'The Matrix',
                'slug' => 'the-matrix',
                'year' => 1999,
                 'cover_image' => 'https://img.englishcinemakyiv.com/BVZBaq6fsTow7KZmdNWUFoEOT1GThWYfAprhqMDZEi4/resize:fill:800:450:1:0/gravity:sm/aHR0cHM6Ly9leHBhdGNpbmVtYXByb2QuYmxvYi5jb3JlLndpbmRvd3MubmV0L2ltYWdlcy9lMTA1YjhlNi1hOTcyLTQxMmMtYmRiMy0yZmJkYWE1NDA2OWYuanBn.jpg',
                'category_id' => 4, // Sci-Fi
            ],
            [
                'title' => 'Titanic',
                'slug' => 'titanic',
                'year' => 1997,
                'cover_image' => 'https://www.justologist.com/content/images/2023/08/p20056_v_h10_ab.jpg',
                'category_id' => 5, // Romance
            ],
            [
                'title' => 'Avengers: Endgame',
                'slug' => 'avengers-endgame',
                'year' => 2019,
                'cover_image' => 'https://awsimages.detik.net.id/community/media/visual/2018/03/19/1af717fe-3c85-4836-8a4b-e48f2fa00a50_169.png?w=650',
                'category_id' => 1, // Action
            ],
              [
                'title' => 'Kang Mak',
                'slug' => 'kang-mak',
                'year' => 2024,
                'cover_image' => 'https://statik.tempo.co/data/2024/07/20/id_1320552/1320552_720.jpg',
                'category_id' => 2, // Horror Comedy
            ],
             [
                'title' => 'Home Sweet Loan',
                'slug' => 'home-sweet-loan',
                'year' => 2024,
                'cover_image' => 'https://linebank.co.id/blog/wp-content/uploads/2024/10/home-sweet-loan-lb-blog.webp',
                'category_id' => 3, // Drama
            ],
              [
                'title' => 'Avatar',
                'slug' => 'avatar',
                'year' => 2023,
                'cover_image' => 'https://img1.wsimg.com/isteam/ip/d6a3e7a7-e920-4711-bf09-856dd846af78/AVATAR2.jpg',
                'category_id' => 6, // Adventure
            ],
        ];

        foreach ($movies as $movie) {
            Movie::create($movie);
        }
    }
}
