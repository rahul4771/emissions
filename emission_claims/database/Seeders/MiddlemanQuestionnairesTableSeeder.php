<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
USE DB;


class MiddlemanQuestionnairesTableSeeder extends Seeder {
    /**
    * Run the database seeds.
    *
    * @return void
    */

    public function run() {
        DB::table( 'middleman_questionnaires' )->delete();
        $questionnaire 		 = 	[
            [
                'id' =>1,
                'question_title' =>'Are you married or in a civil partnership?',
                'form_type'=>'select',
                'live_id'=>1,
                'crm_id'=>1,
                'parent_id' =>0,
                'status' =>1
            ],
            [
                'id' =>2,
                // 'bank_id' =>4,
                'question_title' =>'Over the past 4 years, who has been the highest earner?',
                'form_type'=>'select',
                'live_id'=>2,
                'crm_id'=>2,
                'parent_id' =>0,
                'status' =>1
            ],
            [
                'id' =>3,
                'question_title'	=>'Over the past 4 years, was your income between £12,501 and £50,000 a year?',
                'form_type'=>'select',
                'live_id'=>3,
                'crm_id'=>3,
                'parent_id' =>0,
                'status' =>1
            ],
            [
                'id' =>4,
                'question_title' =>' Over the past 4 years, were you unemployed or earning less than £12,500 a year?',
                'form_type'=>'select',
                'live_id'=>4,
                'crm_id'=>4,
                'parent_id' =>0,
                'status' =>1
            ],
            [
                'id' =>5,
                'question_title' =>'Over the past 4 years, was your partner unemployed or earning less than £12,500 a year?',
                'form_type'=>'select',
                'live_id'=>5,
                'crm_id'=>5,
                'parent_id' =>0,
                'status' =>1
            ],
            [
                'id' =>6,
                'question_title' =>'Over the past 4 years, was your partner earning between £12,501 and £50,000 a year?',
                'form_type'=>'select',
                'live_id'=>6,
                'crm_id'=>6,
                'parent_id' =>0,
                'status' =>1
            ],
            [
                'id' =>7,
                'question_title' =>'For the tax year 2016/17, was your income less than £11,000?',
                'form_type'=>'radio',
                'live_id'=>7,
                'crm_id'=>7,
                'parent_id' =>0,
                'status' =>1
            ],
            [
                'id' =>8,
                'question_title' =>'For the tax year 2017/18, was your income less than £11,500?',
                'form_type'=>'radio',
                'live_id'=>8,
                'crm_id'=>8,
                'parent_id' =>0,
                'status' =>1
            ],
            [
                'id' =>9,
                'question_title' =>'For the tax year 2018/19, was your income less than £11,850?',
                'form_type'=>'radio',
                'live_id'=>9,
                'crm_id'=>9,
                'parent_id' =>0,
                'status' =>1
            ],
            [
                'id' =>10,
                'question_title' =>'For the tax year 2019/20, was your income less than £12,500?',
                'form_type'=>'radio',
                'live_id'=>10,
                'crm_id'=>10,
                'parent_id' =>0,
                'status' =>1
            ],
            [
                'id' =>11,
                'question_title' =>'For the tax year 2016/17, was your income between £11,001 and £43,000, and did you pay tax?',
                'form_type'=>'radio',
                'live_id'=>11,
                'crm_id'=>11,
                'parent_id' =>0,
                'status' =>1
            ],
            [
                'id' =>12,
                'question_title' =>'For the tax year 2017/18, was your income between £11,501 and £45,000, and did you pay tax?',
                'form_type'=>'radio',
                'live_id'=>12,
                'crm_id'=>12,
                'parent_id' =>0,
                'status' =>1
            ],
            [
                'id' =>13,
                'question_title' =>'For the tax year 2018/19, was your income between £11,851 and £46,350, and did you pay tax?',
                'form_type'=>'radio',
                'live_id'=>13,
                'crm_id'=>13,
                'parent_id' =>0,
                'status' =>1
            ],
            [
                'id' =>14,
                'question_title' =>'For the tax year 2019/20, was your income between £12,501 and £50,000, and did you pay tax?',
                'form_type'=>'radio',
                'live_id'=>14,
                'crm_id'=>14,
                'parent_id' =>0,
                'status' =>1
            ],
        ];

        DB::table( 'middleman_questionnaires' )->insert( $questionnaire );
    }
}
