<?php

namespace Database\Seeders;
use Database\Factories;
use Illuminate\Database\Seeder;
use DB;

class MiddlemanQuestionnaireOptionsTableSeeder extends Seeder {
    /**
    * Run the database seeds.
    *
    * @return void
    */

    public function run() {
        DB::table( 'middleman_questionnaire_options' )->delete();
        $questionnaireOptions 		 = 	[
            [
                'id' =>1,
                'questionnaire_id' =>1,
                'option_label'  =>'<span>Yes</span>',
                'option_value'  =>'Yes',
                'option_target' =>'2',
                'live_id'=>'1',
                'crm_id'=>'1'

            ],
            [
                'id' =>2,
                'questionnaire_id' =>1,
                'option_label' =>'<span>No</span>',
                'option_value' =>'No',
                'option_target' =>null,
                'live_id'=>'2',
                'crm_id'=>'2'
            ],
            [
                'id' =>3,
                'questionnaire_id' =>2,
                'option_label'  =>'<span>Me</span>',
                'option_value'  =>'Me',
                'option_target' =>'3',
                'live_id'=>'3',
                'crm_id'=>'3'


            ],
            [
                'id' =>4,
                'questionnaire_id' =>2,
                'option_label' =>'<span>Partner</span>',
                'option_value' =>'My Partner',
                'option_target' =>'4',
                'live_id'=>'4',
                'crm_id'=>'4'
            ],
            [
                'id' =>5,
                'questionnaire_id' =>3,
                'option_label' =>'<span>Yes</span>',
                'option_value' =>'Yes',
                'option_target' =>'5',
                'live_id'=>'5',
                'crm_id'=>5
            ],
            [
                'id' =>6,
                'questionnaire_id' =>3,
                'option_label' =>'<span>Not Sure</span>',
                'option_value' =>'Not Sure',
                'option_target' =>'5',
                'live_id'=>'6',
                'crm_id'=>6
            ],
            [
                'id' =>7,
                'questionnaire_id' =>3,
                'option_label' =>'<span>No</span>',
                'option_value' =>'No',
                'option_target' =>null,
                'live_id'=>'7',
                'crm_id'=>7
            ],
            [
                'id' =>8,
                'questionnaire_id' =>4,
                'option_label' =>'<span>Yes</span>',
                'option_value' =>'Yes',
                'option_target' =>'6',
                'live_id'=>'8',
                'crm_id'=>8
            ],
            [
                'id' =>9,
                'questionnaire_id' =>4,
                'option_label' =>'<span>Not Sure</span>',
                'option_value' =>'Not Sure',
                'option_target' =>'6',
                'live_id'=>'9',
                'crm_id'=>9
            ],
            [
                'id' =>10,
                'questionnaire_id' =>4,
                'option_label' =>'<span>No</span>',
                'option_value' =>'No',
                'option_target' =>null,
                'live_id'=>'10',
                'crm_id'=>10
            ],
            [
                'id' =>11,
                'questionnaire_id' =>5,
                'option_label' =>'<span>Yes</span>',
                'option_value' =>'Yes',
                'option_target' =>'7',
                'live_id'=>'11',
                'crm_id'=>11
            ],
            [
                'id' =>12,
                'questionnaire_id' =>5,
                'option_label' =>'<span>Not Sure</span>',
                'option_value' =>'Not Sure',
                'option_target' =>'7',
                'live_id'=>'12',
                'crm_id'=>12
            ],
            [
                'id' =>13,
                'questionnaire_id' =>5,
                'option_label' =>'<span>No</span>',
                'option_value' =>'No',
                'option_target' =>null,
                'live_id'=>'13',
                'crm_id'=>13
            ],
            [
                'id' =>14,
                'questionnaire_id' =>6,
                'option_label' =>'<span>Yes</span>',
                'option_value' =>'Yes',
                'option_target' =>'7',
                'live_id'=>'14',
                'crm_id'=>14
            ],
            [
                'id' =>15,
                'questionnaire_id' =>6,
                'option_label' =>'<span>Not Sure</span>',
                'option_value' =>'Not Sure',
                'option_target' =>'7',
                'live_id'=>'15',
                'crm_id'=>15
            ],
            [
                'id' =>16,
                'questionnaire_id' =>6,
                'option_label' =>'<span>No</span>',
                'option_value' =>'No',
                'option_target' =>null,
                'live_id'=>'16',
                'crm_id'=>16
            ],
            [
                'id' =>17,
                'questionnaire_id' =>7,
                'option_label' =>'<span>Yes</span>',
                'option_value' =>'Yes',
                'option_target' =>null,
                'live_id'=>17,
                'crm_id'=>17
            ],
            [
                'id' =>18,
                'questionnaire_id' =>7,
                'option_label' =>'<span>No</span>',
                'option_value' =>'No',
                'option_target' =>null,
                'live_id'=>18,
                'crm_id'=>18
            ],
            [
                'id' =>19,
                'questionnaire_id' =>7,
                'option_label' =>'<span>Unsure</span>',
                'option_value' =>'Unsure',
                'option_target' =>null,
                'live_id'=>19,
                'crm_id'=>19
            ],
            [
                'id' =>20,
                'questionnaire_id' =>8,
                'option_label' =>'<span>Yes</span>',
                'option_value' =>'Yes',
                'option_target' =>null,
                'live_id'=>20,
                'crm_id'=>20
            ],
            [
                'id' =>21,
                'questionnaire_id' =>8,
                'option_label' =>'<span>No</span>',
                'option_value' =>'No',
                'option_target' =>null,
                'live_id'=>21,
                'crm_id'=>21
            ],
            [
                'id' =>22,
                'questionnaire_id' =>8,
                'option_label' =>'<span>Unsure</span>',
                'option_value' =>'Unsure',
                'option_target' =>null,
                'live_id'=>22,
                'crm_id'=>22
            ],
            [
                'id' =>23,
                'questionnaire_id' =>9,
                'option_label' =>'<span>Yes</span>',
                'option_value' =>'Yes',
                'option_target' =>null,
                'live_id'=>23,
                'crm_id'=>23
            ],
            [
                'id' =>24,
                'questionnaire_id' =>9,
                'option_label' =>'<span>No</span>',
                'option_value' =>'No',
                'option_target' =>null,
                'live_id'=>24,
                'crm_id'=>24
            ],
            [
                'id' =>25,
                'questionnaire_id' =>9,
                'option_label' =>'<span>Unsure</span>',
                'option_value' =>'Unsure',
                'option_target' =>null,
                'live_id'=>25,
                'crm_id'=>25
            ],
            [
                'id' =>26,
                'questionnaire_id' =>10,
                'option_label' =>'<span>Yes</span>',
                'option_value' =>'Yes',
                'option_target' =>null,
                'live_id'=>26,
                'crm_id'=>26
            ],
            [
                'id' =>27,
                'questionnaire_id' =>10,
                'option_label' =>'<span>No</span>',
                'option_value' =>'No',
                'option_target' =>null,
                'live_id'=>27,
                'crm_id'=>27
            ],
            [
                'id' =>28,
                'questionnaire_id' =>10,
                'option_label' =>'<span>Unsure</span>',
                'option_value' =>'Unsure',
                'option_target' =>null,
                'live_id'=>28,
                'crm_id'=>28
            ],
            [
                'id' =>29,
                'questionnaire_id' =>11,
                'option_label' =>'<span>Yes</span>',
                'option_value' =>'Yes',
                'option_target' =>null,
                'live_id'=>29,
                'crm_id'=>30
            ],
            [
                'id' =>30,
                'questionnaire_id' =>11,
                'option_label' =>'<span>No</span>',
                'option_value' =>'No',
                'option_target' =>null,
                'live_id'=>30,
                'crm_id'=>31
            ],
            [
                'id' =>31,
                'questionnaire_id' =>11,
                'option_label' =>'<span>Unsure</span>',
                'option_value' =>'Unsure',
                'option_target' =>null,
                'live_id'=>31,
                'crm_id'=>31
            ],
            [
                'id' =>32,
                'questionnaire_id' =>12,
                'option_label' =>'<span>Yes</span>',
                'option_value' =>'Yes',
                'option_target' =>null,
                'live_id'=>32,
                'crm_id'=>32
            ],
            [
                'id' =>33,
                'questionnaire_id' =>12,
                'option_label' =>'<span>No</span>',
                'option_value' =>'No',
                'option_target' =>null,
                'live_id'=>33,
                'crm_id'=>33
            ],
            [
                'id' =>34,
                'questionnaire_id' =>12,
                'option_label' =>'<span>Unsure</span>',
                'option_value' =>'Unsure',
                'option_target' =>null,
                'live_id'=>34,
                'crm_id'=>34
            ],
            [
                'id' =>35,
                'questionnaire_id' =>13,
                'option_label' =>'<span>Yes</span>',
                'option_value' =>'Yes',
                'option_target' =>null,
                'live_id'=>35,
                'crm_id'=>35
            ],
            [
                'id' =>36,
                'questionnaire_id' =>13,
                'option_label' =>'<span>No</span>',
                'option_value' =>'No',
                'option_target' =>null,
                'live_id'=>36,
                'crm_id'=>36
            ],
            [
                'id' =>37,
                'questionnaire_id' =>13,
                'option_label' =>'<span>Unsure</span>',
                'option_value' =>'Unsure',
                'option_target' =>null,
                'live_id'=>37,
                'crm_id'=>37
            ],
            [
                'id' =>38,
                'questionnaire_id' =>14,
                'option_label' =>'<span>Yes</span>',
                'option_value' =>'Yes',
                'option_target' =>null,
                'live_id'=>38,
                'crm_id'=>39
            ],
            [
                'id' =>39,
                'questionnaire_id' =>14,
                'option_label' =>'<span>No</span>',
                'option_value' =>'No',
                'option_target' =>null,
                'live_id'=>39,
                'crm_id'=>39
            ],
            [
                'id' =>40,
                'questionnaire_id' =>14,
                'option_label' =>'<span>Unsure</span>',
                'option_value' =>'Unsure',
                'option_target' =>null,
                'live_id'=>40,
                'crm_id'=>40
            ],
        ];
        DB::table( 'middleman_questionnaire_options' )->insert( $questionnaireOptions );
    }
}
