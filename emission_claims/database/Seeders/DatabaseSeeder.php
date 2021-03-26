<?php

namespace Database\Seeders;
use Database\Factories;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SiteFlagMastersTableSeeder::class);
        $this->call(TrackerTableSeeder::class);
        $this->call(BuyerDetailsTableSeeder::class);
        $this->call(QuestionnairesTableSeeder::class);
        $this->call(MiddlemanQuestionnairesTableSeeder::class);
        $this->call(QuestionnaireOptionsTableSeeder::class); 
        $this->call(MiddlemanQuestionnaireOptionsTableSeeder::class); 
        $this->call(SiteConfigTableSeeder::class); 
    }
}
