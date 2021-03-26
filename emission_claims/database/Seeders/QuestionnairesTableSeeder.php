<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use DB as DBS;

class QuestionnairesTableSeeder extends Seeder {
    /**
    * Run the database seeds.
    *
    * @return void
    */

    public function run() {
        DBS::table( 'questionnaires' )->delete();
        $questionnaire 		 = 	[
            [
                'id' =>1,
                // 'bank_id' =>1,
                'title' =>'Are you married or in a civil partnership?',
                'is_required'=>'yes',
                'type'=>'questionnaire0',
                'form_type'=>'select',
                'default_id'=>1,
                'parent' =>0,
                'extra_param' =>null,
                'status' =>1
            ],
            [
                'id' =>2,
                // 'bank_id' =>4,
                'title' =>'Over the past 4 years, who has been the highest earner?',
                'is_required'=>'yes',
                'type'=>'questionnaire0',
                'form_type'=>'select',
                'default_id'=>2,
                'parent' =>0,
                'extra_param' =>null,
                'status' =>1
            ],
            [
                'id' =>3,
                // 'bank_id' =>1,
                'title'	=>'Over the past 4 years, was your income between £12,501 and £50,000 a year?',
                'is_required'=>'yes',
                'type'=>'questionnaire0',
                'form_type'=>'select',
                'default_id'=>3,
                'parent' =>0,
                'extra_param' =>null,
                'status' =>1
            ],
            [
                'id' =>4,
                // 'bank_id' =>1,
                'title' =>' Over the past 4 years, were you unemployed or earning less than £12,500 a year?',
                'is_required'=>'yes',
                'type'=>'questionnaire0',
                'form_type'=>'select',
                'default_id'=>4,
                'parent' =>0,
                'extra_param' =>null,
                'status' =>1
            ],
            [
                'id' =>5,
                // 'bank_id' =>1,
                'title' =>'Over the past 4 years, was your partner unemployed or earning less than £12,500 a year?',
                'is_required'=>'yes',
                'type'=>'questionnaire0',
                'form_type'=>'select',
                'default_id'=>5,
                'parent' =>0,
                'extra_param' =>null,
                'status' =>1
            ],
            [
                'id' =>6,
                // 'bank_id' =>1,
                'title' =>'Over the past 4 years, was your partner earning between £12,501 and £50,000 a year?',
                'is_required'=>'yes',
                'type'=>'questionnaire0',
                'form_type'=>'select',
                'default_id'=>6,
                'parent' =>0,
                'extra_param' =>null,
                'status' =>1
            ],
            [
                'id' =>7,
                // 'bank_id' =>1,
                'title' =>'For the tax year 2016/17, was your income less than £11,000?',
                'is_required'=>'yes',
                'type'=>'questionnaire1',
                'form_type'=>'radio',
                'default_id'=>7,
                'parent' =>0,
                'extra_param' =>'section1',
                'status' =>1
            ],
            [
                'id' =>8,
                // 'bank_id' =>1,
                'title' =>'For the tax year 2017/18, was your income less than £11,500?',
                'is_required'=>'yes',
                'type'=>'questionnaire1',
                'form_type'=>'radio',
                'default_id'=>8,
                'parent' =>0,
                'extra_param' =>'section1',
                'status' =>1
            ],
            [
                'id' =>9,
                // 'bank_id' =>1,
                'title' =>'For the tax year 2018/19, was your income less than £11,850?',
                'is_required'=>'yes',
                'type'=>'questionnaire1',
                'form_type'=>'radio',
                'default_id'=>9,
                'parent' =>0,
                'extra_param' =>'section1',
                'status' =>1
            ],
            [
                'id' =>10,
                // 'bank_id' =>1,
                'title' =>'For the tax year 2019/20, was your income less than £12,500?',
                'is_required'=>'yes',
                'type'=>'questionnaire1',
                'form_type'=>'radio',
                'default_id'=>10,
                'parent' =>0,
                'extra_param' =>'section1',
                'status' =>1
            ],
            [
                'id' =>11,
                // 'bank_id' =>1,
                'title' =>'For the tax year 2016/17, was your income between £11,001 and £43,000, and did you pay tax?',
                'is_required'=>'yes',
                'type'=>'questionnaire1',
                'form_type'=>'radio',
                'default_id'=>11,
                'parent' =>0,
                'extra_param' =>'section2',
                'status' =>1
            ],
            [
                'id' =>12,
                // 'bank_id' =>1,
                'title' =>'For the tax year 2017/18, was your income between £11,501 and £45,000, and did you pay tax?',
                'is_required'=>'yes',
                'type'=>'questionnaire1',
                'form_type'=>'radio',
                'default_id'=>12,
                'parent' =>0,
                'extra_param' =>'section2',
                'status' =>1
            ],
            [
                'id' =>13,
                // 'bank_id' =>1,
                'title' =>'For the tax year 2018/19, was your income between £11,851 and £46,350, and did you pay tax?',
                'is_required'=>'yes',
                'type'=>'questionnaire1',
                'form_type'=>'radio',
                'default_id'=>13,
                'parent' =>0,
                'extra_param' =>'section2',
                'status' =>1
            ],
            [
                'id' =>14,
                // 'bank_id' =>1,
                'title' =>'For the tax year 2019/20, was your income between £12,501 and £50,000, and did you pay tax?',
                'is_required'=>'yes',
                'type'=>'questionnaire1',
                'form_type'=>'radio',
                'default_id'=>14,
                'parent' =>0,
                'extra_param' =>'section2',
                'status' =>1
            ],
            [
                'id' =>15,
                // 'bank_id' =>1,
                'title' =>'Have you or your partner already registered for Marriage Allowance?',
                'is_required'=>'yes',
                'type'=>'questionnaire0',
                'form_type'=>'select',
                'default_id'=>15,
                'parent' =>0,
                'extra_param' =>null,
                'status' =>1
            ],
        ];

        DBS::table( 'questionnaires' )->insert( $questionnaire );
    }
}
