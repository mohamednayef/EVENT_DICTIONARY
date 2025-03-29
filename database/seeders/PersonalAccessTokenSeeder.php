<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PersonalAccessToken;

class PersonalAccessTokenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PersonalAccessToken::firstOrCreate([
            'tokenable_type' => 'App\Models\User',
            'tokenable_id' => '1',
            'name' => 'ApiToken',
            'token' => '01a2a856130331ff38d316d8a39f56aa6197409eee01427b970e9e0bb62d1053',
            'abilities' => '["*"]',
        ]);
        PersonalAccessToken::firstOrCreate([
            'tokenable_type' => 'App\Models\User',
            'tokenable_id' => '2',
            'name' => 'ApiToken',
            'token' => 'feb3c176b13f109ec8d9b0e15ce31b0f78a215777fe7376cb3c881f89a1a3776',
            'abilities' => '["*"]',
        ]);
    }
}
// Token     => 1|L9LDmmRta5rG30ZgSh1xW9wEP45RHRaYhglYbUyp31e4a1e9
// HashToken => 2b306b9781d428967d01b1a772ee8806cbbe3630f58c1390b3b0fdf593bc7f4a