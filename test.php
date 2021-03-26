not want to list in app store while version 8 as well as 5 inches
procedure to submit app in playstore and app store
expo 1 acc is paid -> dev 
<?php/////////////////////////////////////////////////////////

SELECT user_id, users.email,previous_address_no,previous_postcode,previous_address_line1,previous_address_line2,previous_address_line3,previous_address_city,previous_address_province,previous_address_country,previous_address_company
FROM esign_extra_details
inner join users on users.id = esign_extra_details.user_id
WHERE user_id IN (53568,53776,53800,53815,53966,54020,54069,54073,54072,54071,54074,54079,54078,54082,54081,54083,54087,54085,54091,54090,54089,54097,54096,54095,54094,54103,54102,54101,54107,54105,54104,54111,54110,54109,54143,54142,54147,54146,54153,54152,54151,54155,54172,54171,54167,54166,54165,54161,54160,54158,54157,54180,54178,54177,54176,54175,54174,54173,54187,54186,54184,54183,54182,54203,54202,54200,54199,54198,54195,54194,54193,54192,54191,54210,54209,54207,54220,54219,54218,54215,54214,54212,54223,54227,54232,54229,54228,54234,54243,54240,54244,54248,54247,54251,54250,54253,54256,54255,54260,54259,54258,54257,54265,54261,54267,54274,54273,54272,54270,54276,54283,54278,54284,54289,54290,54292,54297,54298,54300,54302,54308,54307,54309,54311,54313,54312,54316,54315,54314,54317,54320,54319,54325,54329,53659,54333,54332,54330,54335,54336,54338,54343,54344,54346,54353,54018)

142,157,158,159,160,161,162,196
158,159,161,162,196
477,536,620,641,651,761,816,1030
user_flow_logs
userid,visitor,carno,vehicletableid,type
M123TAP,BX66ZNM,M44TEB,R88BCH,G3uae,WN67HSV,Sj10zpv,C2ljj
//Generate PDF - loe
                $s3_path_loe        = $s3_rewrite_path.$s3_basic_path."fpc_loe_".$user_id.".pdf";
                $s3_pdf_loe         = $this->saveFileIntoS3("fpc_loe_".$user_id.".pdf", $path_pdf_loe, $s3_basic_path);
                // dd($s3_path_loe);
                if(file_exists($path_pdf_loe)){

                    $local_path['loe']    = $path_pdf_loe;
                    $s3_results['loe']    = $s3_path_loe;
                    $s3_base['loe'][0]    = $s3_path_loe;
                    $s3_base['loe'][1]    = base64_encode(file_get_contents($path_pdf_loe));
                    
                    $xml_loe          = $xml_storage_path."fpc_loe_".$user_id.".xml";
                    
                    $s3_path_loe_xml  = $s3_rewrite_path.$s3_basic_path."fpc_loe_".$user_id.".xml";

                    $xml = new SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><ClientDetails></ClientDetails>');
                    $xml->addAttribute('version', '1.0');
                    $xml->addChild('loe_signed', $s3_base['loe'][1] );
                    $xml->saveXML($xml_loe);
                    // dd($xml_loe);
                    $s3_xml_loe         = $this->saveFileIntoS3("fpc_loe_".$user_id.".xml", $xml_loe, $s3_basic_path);
                    // dd($s3_xml_loe);
                    if(file_exists($xml_loe)){
                        $s3_base['loe'][2]    = $s3_path_loe_xml;
                    }
                }

                //Generate PDF - dba
                $s3_path_dba        = $s3_rewrite_path.$s3_basic_path."fpc_dba_".$user_id.".pdf";
                $s3_pdf_dba         = $this->saveFileIntoS3("fpc_dba_".$user_id.".pdf", $path_pdf_dba, $s3_basic_path);
                // dd($s3_path_dba);
                if(file_exists($path_pdf_dba)){

                    $local_path['dba']    = $path_pdf_dba;
                    $s3_results['dba']    = $s3_path_dba;
                    $s3_base['dba'][0]    = $s3_path_dba;
                    $s3_base['dba'][1]    = base64_encode(file_get_contents($path_pdf_dba));
                    
                    $xml_dba          = $xml_storage_path."fpc_dba_".$user_id.".xml";
                    
                    $s3_path_dba_xml  = $s3_rewrite_path.$s3_basic_path."fpc_dba_".$user_id.".xml";

                    $xml = new SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><ClientDetails></ClientDetails>');
                    $xml->addAttribute('version', '1.0');
                    $xml->addChild('dba_signed', $s3_base['dba'][1] );
                    $xml->saveXML($xml_dba);
                    // dd($xml_dba);
                    $s3_xml_dba         = $this->saveFileIntoS3("fpc_dba_".$user_id.".xml", $xml_dba, $s3_basic_path);
                    // dd($s3_xml_dba);
                    if(file_exists($xml_dba)){
                        $s3_base['dba'][2]    = $s3_path_dba_xml;
                    }
                }

                //Generate PDF - tob
                $s3_path_tob        = $s3_rewrite_path.$s3_basic_path."fpc_tob_".$user_id.".pdf";
                $s3_pdf_tob         = $this->saveFileIntoS3("fpc_tob_".$user_id.".pdf", $path_pdf_tob, $s3_basic_path);
                // dd($s3_path_tob);
                if(file_exists($path_pdf_tob)){

                    $local_path['tob']    = $path_pdf_tob;
                    $s3_results['tob']    = $s3_path_tob;
                    $s3_base['tob'][0]    = $s3_path_tob;
                    $s3_base['tob'][1]    = base64_encode(file_get_contents($path_pdf_tob));
                    
                    $xml_tob          = $xml_storage_path."fpc_tob_".$user_id.".xml";
                    
                    $s3_path_tob_xml  = $s3_rewrite_path.$s3_basic_path."fpc_tob_".$user_id.".xml";

                    $xml = new SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><ClientDetails></ClientDetails>');
                    $xml->addAttribute('version', '1.0');
                    $xml->addChild('tob_signed', $s3_base['tob'][1] );
                    $xml->saveXML($xml_tob);
                    // dd($xml_tob);
                    $s3_xml_tob         = $this->saveFileIntoS3("fpc_tob_".$user_id.".xml", $xml_tob, $s3_basic_path);
                    // dd($s3_xml_tob);
                    if(file_exists($xml_tob)){
                        $s3_base['tob'][2]    = $s3_path_tob_xml;
                    }
                }


, 
                'loe_s3_path' => $s3_base['loe'][0], 'loe_s3_xml_path' => $s3_base['loe'][2],
                'dba_s3_path' => $s3_base['dba'][0], 'dba_s3_xml_path' => $s3_base['dba'][2], 
                'tob_s3_path' => $s3_base['tob'][0], 'tob_s3_xml_path' => $s3_base['tob'][2]


removed UpdateUserCarDetails fn from 2 split store fn
added UpdateUserCarDetails in usercontroller after storeuser fn
commended status,splitid in vehicle lookup query
added new table UserFlowLog and entry with vehicle_table_id, carregno


mbemissionsclaim
WXUxAdWMuedW5hXd
https://mbemissionsclaim.co.uk/horizon



manufacture year mismatch
year

$resourcePath = "http://localhost:8080/funeral/funeral-planning.co.uk/prod-web/funeral-planning.co.uk/advertorials/2020/01/Funerals/FP_W6.5.1/dist/";


select count(user.id) from users as user inner join lead_docs as lds on lds.user_id = user.id and lds.pdf_file is null where user.id not in (select followup_strategy_db.cancel_scheduled_api_record.user_id from followup_strategy_db.cancel_scheduled_api_record where followup_strategy_db.cancel_scheduled_api_record.domain_id = 57 and followup_strategy_db.cancel_scheduled_api_record.source = 'CRM') and user.record_status = 'LIVE' and user.telephone like "07%" and user.is_qualified != 0 and user.created_at between '2020-04-10 00:00:00' and '2020-06-01 23:59:59'


10/04/2020 - 01/06/2020 -> 666
01/06/2020 - 01/09/2020 -> 5038
01/09/2020 - 01/12/2020 -> 12612
01/12/2020 - 21/01/2021 -> 9

10/04/2020 - 01/08/2020 -> 2394
01/08/2020 - 01/10/2020 -> 7295
01/10/2020 - 01/11/2020 -> 6063
01/11/2020 - 14/01/2021 -> 2967


10/04/2020 - 20/08/2020 -> 4206
20/08/2020 - 25/09/2020 -> 4223
25/09/2020 - 17/10/2020 -> 4283
17/10/2020 - 05/11/2020 -> 4145
05/11/2020 - 14/01/2021 -> 1996



10/04/2020 - 28/08/2020 -> 5173
28/08/2020 - 04/10/2020 -> 5291
04/10/2020 - 01/11/2020 -> 5307
01/11/2020 - 14/01/2021 -> 2967



Rahul@hp MINGW64 /c/xampp/htdocs/reportlf.com/report






///////////////////////////////////////////////////////////////////////
<div class="row col-3">
    <i class=" btnclose" data-index="1"> 
        <div style="max-width:275px;max-height:163px;">
            <div style="position: relative;padding-bottom: 59.1%;height: auto;overflow: hidden;">
                <iframe frameborder="0" scrolling="no" allowTransparency="true" src="https://cdn.yoshki.com/iframe/55845r.html"; style="border:0px; margin:0px; padding:0px; backgroundColor:transparent; top:0px; left:0px; width:100%; height:100%; position: absolute;">
                </iframe>
            </div>
        </div>
        <img src="{{$resourcePath}}img/sra-logo.png" alt="" > 
    </i>
</div>
////////////////////////////////////////////////////////////////////////
SQLSTATE[42S22]: Column not found: 1054 Unknown column 'buyer_api_responses.claim_id' in 'where clause' (SQL: select count(*) as aggregate from users left join visitors on users.visitor_id = visitors.id left join split_info on visitors.split_id = split_info.id left join domain_details on domain_details.id = split_info.domain_id left join site_flag_masters on site_flag_masters.id = visitors.site_flag_id left join tracker_masters on tracker_masters.id = visitors.tracker_master_id left join thrive_visitors on thrive_visitors.visitor_id = visitors.id left join adtopia_visitors on adtopia_visitors.visitor_id = visitors.id left join visitors_extra_details on visitors_extra_details.visitor_id = visitors.id left join buyer_api_responses on buyer_api_responses.user_id = users.id where buyer_api_responses.claim_id is null and buyer_api_responses.api_one_response is not null and (split_info.split_name = 0602SB01-QM.php and domain_details.domain_name = https://dev.senior-benefits.co.uk/) and users.created_at between 2021-01-14 00:00:00 and 2021-01-14 23:59:59)
/////////////////////////////////////////////////////////////////////
SELECT user_id, users.email,previous_address_no,previous_postcode,previous_address_line1,previous_address_line2,previous_address_line3,previous_address_city,previous_address_province,previous_address_country,previous_address_company
FROM esign_extra_details
inner join users on users.id = esign_extra_details.user_id
WHERE user_id IN (48314,48429,48527,49335,49441,49557,49558,49562,49570,49567,49574,49572,49571,49580,49584,49588,49587,49586,49591,49590,49592,49595,49600,49603,49601,49610,49609,49608,49607,49616,49614,49619,49622,49626,49625,49623,49629,49631,49630,49636,49638,49641,49639,49643,49642,49646,49645,49650,49647,49651,49654,49653,49656,49658,49657,49663,49662,49667,49666,49670,49675,49679,49681,49680,49684,49685,49687,49690,49689,49695,49699,49697,49705,49701,49706,49708,49707,49716,49718,49723,49720,49725,49727,49731,49737,49736,49742,49744,49746,49759,49760,49761,49763,49764,49766,49769,49770,49774,49777,49785,49784,49783,49790,49788,49795,49798,49599)


48314,48429,48527,49335,49441,49557,49558,49562,49570,49567,49574,49572,49571,49580,49584,49588,49587,49586,49591,49590,49592,49595,49600,49603,49601,49610,49609,49608,49607,49616,49614,49619,49622,49626,49625,49623,49629,49631,49630,49636,49638,49641,49639,49643,49642,49646,49645,49650,49647,49651,49654,49653,49656,49658,49657,49663,49662,49667,49666,49670,49675,49679,49681,49680,49684,49685,49687,49690,49689,49695,49699,49697,49705,49701,49706,49708,49707,49716,49718,49723,49720,49725,49727,49731,49737,49736,49742,49744,49746,49759,49760,49761,49763,49764,49766,49769,49770,49774,49777,49785,49784,49783,49790,49788,49795,49798,49599

//////////////////////////////////////////////////////////////////////
select DISTINCT(case when is_qualified = 1 then users.id else null end) as qualified_user_count from users left join user_questionnaire_meta as uq on uq.user_id = users.id left join user_milestone_stats as mile on mile.user_id = users.id and mile.source = 'LIVE' left join user_questionnaire_stats as uqsta on uqsta.user_id = users.id and uqsta.source = 'LIVE' left join users_transactions as ut on ut.user_id = users.id left join adtopia_visitors as avis on avis.visitor_id = users.visitor_id left join user_banks as usb on usb.user_id = users.id where ut.record_status = 'LIVE' and uq.version is not null and users.created_at between '2021-01-05 23:00:00' and '2021-01-06 23:59:59' group by version order by version asc

48357,48358,48359,48361,48363,48364,48365,48367,48372,48374,48376,48377,48379,48380,48383,48384,48385,48387,48389,48392,48393,48394,48395,48396,48398,48399,48400,48401,48402,48403,48404,48405,48406,48407,48408,48410,48411
//////////////////////////////////////////////////////////////////////////
select DISTINCT(case when mile.signature = 1 then mile.user_id else null end) as signature_count  from users left join user_questionnaire_meta as uq on uq.user_id = users.id left join user_milestone_stats as mile on mile.user_id = users.id and mile.source = 'LIVE' left join user_questionnaire_stats as uqsta on uqsta.user_id = users.id and uqsta.source = 'LIVE' left join users_transactions as ut on ut.user_id = users.id left join adtopia_visitors as avis on avis.visitor_id = users.visitor_id left join user_banks as usb on usb.user_id = users.id where ut.record_status = 'LIVE' and uq.version is not null and users.created_at between '2021-01-05 23:00:00' and '2021-01-06 23:59:59'


48359,48360,48361,48362,48365,48366,48367,48371,48376,48377,48378,48380,48381,48383,48384,48385,48388,48389,48390,48392,48393,48394,48399,48401,48405,48407,48408,48409,48411


48359,48361,48365,48367,48376,48377,48380,48383,48384,48385,48389,48392,48393,48394,48399,48401,48405,48407,48408,48411


48360,48362,48366,48371,48378,48381,48388,48390,48409
///////////////////////////////////////////////////////////////////////////////
select uq.version, count(DISTINCT(case when is_qualified = 1 then users.id else null end)) as qualified_user_count, count(DISTINCT(case when mile.completed = 1 then mile.user_id else null end)) as completed_count , count(DISTINCT(case when mile.signature = 1 then mile.user_id else null end)) as signature_count , count(DISTINCT(case when mile.bank_sort_code = 1 then mile.user_id else null end)) as bank_sort_code_count, count(DISTINCT(case when mile.bank_account_no = 1 then mile.user_id else null end)) as bank_account_no_count, count(DISTINCT(case when mile.questions = 1 then mile.user_id else null end)) as questions_count, count(uqsta.user_id) as questions_contr from users left join user_questionnaire_meta as uq on uq.user_id = users.id left join user_milestone_stats as mile on mile.user_id = users.id and mile.source = 'LIVE' left join user_questionnaire_stats as uqsta on uqsta.user_id = users.id and uqsta.source = 'LIVE' left join users_transactions as ut on ut.user_id = users.id left join adtopia_visitors as avis on avis.visitor_id = users.visitor_id left join user_banks as usb on usb.user_id = users.id where ut.record_status = 'LIVE' and uq.version is not null and users.created_at between '2021-01-05 23:00:00' and '2021-01-06 23:59:59' group by version order by version asc
////////////////////////////////////////////////////////////////////
SELECT user_id, users.email,previous_address_no,previous_postcode,previous_address_line1,previous_address_line2,previous_address_line3,previous_address_city,previous_address_province,previous_address_country,previous_address_company
FROM esign_extra_details
inner join users on users.id = esign_extra_details.user_id
WHERE user_id IN (48400,49124,49123,49125,49126,49130,49129,49128,49132,49131,49135,49141,49147,49146,49145,49157,49156,49153,49162,49161,49169,49167,49171,49173,49176,49179,49185,49187,49191,49195,49198,49201,49208,49207,49209,49210,49217,49219,49224,49222,49220,49227,49225,49231,49230,49236,49239,49245,49244,49243,49242,49246,49249,49253,49252,49259,49255,49254,49263,49269,49276,49275,49274,49277,49280,49282,49284,49286,49289,49295,49293,49297,49300,49301,49303,49304,49306,49311,49310,49316,49320,48257,48252,49197,49199)

////////////////////////////////////////////////////////////////
48400,49124,49123,49125,49126,49130,49129,49128,49132,49131,49135,49141,49147,49146,49145,49157,49156,49153,49162,49161,49169,49167,49171,49173,49176,49179,49185,49187,49191,49195,49198,49201,49208,49207,49209,49210,49217,49219,49224,49222,49220,49227,49225,49231,49230,49236,49239,49245,49244,49243,49242,49246,49249,49253,49252,49259,49255,49254,49263,49269,49276,49275,49274,49277,49280,49282,49284,49286,49289,49295,49293,49297,49300,49301,49303,49304,49306,49311,49310,49316,49320,48257,48252,49197,49199
/////////////////////////////////////////////////////////////////////

48384,48471,48487,48504,48520,48557,48559,48560,48562,48568,48569,48571,48570,48572,48575,48579,48582,48581,48587,48589,48588,48592,48594,48610,48624,48625,48632,48631,48640,48650,48649,48656,48662,48664,48665,48666,48669,48667,48670,48671,48674,48683,48688,48692,48694,48695,48700,48703,48708,48707,48710,48720,48719,48726,48734,48735,48736,48741,48738,48748,48755,48754,48752,48759,48761,48764,48771,48776,48777,48781,48780,48779,48782,48788,48790,48789,48791,48793,48796,48802,48801,48803,48809,48808,48807,48806,48805,48818,48817,48816,48821,48825,48828,48835,48838,48841,48849,48856,48858,48860,48864,48865,48871,48887,48886,48885,48888,48894,48902,48908,48906,48912,48915,48917,48920,48922,48936,48935,48934,48933,48932,48938,48937,48944,48943,48956,48955,48964,48963,48971,48974,48980,48992,48990,49000,48998,48997,49002,49004,49005,49007,49011,49016,49021,49020,49024,49025,49029,49033,49032,49035,49038,49036,49040,49046,49044,49054,49062,49068,49066,49069,49073,49075,49080,49084,49083,49081,49089,49086,49091,49092,49095,49097,49096,49100,49101,49107,49106,49113,49117,49121,48258,48324,48379,48405

////////////////////////////////////////////////////////////////////////////
48624,48622,48621,48616,48614,48611,48609,48606,48604,48597,48596,48595,48592,48591,48589,48588,48587,48583,48582,48581,48580,48579,48573,48572,48570,48569,48568,48564,48563,48562
//////////////////////////////////////////////////////////////////////////
full completed
user_id=48598
user_id=48600

basic details only
user_id=48601

with signature
user_id=48602
user_id=48603

user_id=48608

46477,46480,46481,46482,46483,46485
/////////////////////////////////////////////////////////////////////////
SELECT user_id, users.email,previous_address_no,previous_postcode,previous_address_line1,previous_address_line2,previous_address_line3,previous_address_city,previous_address_province,previous_address_country,previous_address_company
FROM esign_extra_details
inner join users on users.id = esign_extra_details.user_id
WHERE user_id IN (48325,48398,48410,48427,48430,48431,48433,48435,48291,48292,48304,48312,48317,48326,48348,48437,48442,48408,48444,48445,48454,48460,48461,48464,48468,48465,48469,48470,48472,48476,48484,48483,48486,48490,48489,48495,48498,48503,48505,48509,48512,48516,48518,48521,48523,48525,48526,48528,48529,48532,48534,48535,48536,48556)

48325,48398,48410,48427,48430,48431,48433,48435,48291,48292,48304,48312,48317,48326,48348,48437,48442,48408,48444,48445,48454,48460,48461,48464,48468,48465,48469,48470,48472,48476,48484,48483,48486,48490,48489,48495,48498,48503,48505,48509,48512,48516,48518,48521,48523,48525,48526,48528,48529,48532,48534,48535,48536,48556

previous_address_08-01-2021
signature table previous
previous_name_08-01-2021
/////////////////////////////////////////////////////////////////////
a:3:{s:4:"code";s:1:"1";s:3:"msg";s:5:"error";s:6:"errors";a:1:{s:5:"error";s:25:"No Qualified Buyers Found";}}
////////////////////////////////////////////////////////////////////////////
1hr
https://dev.purplelegalclaims.co.uk/questionnaire?visitor_id=1586&user_id=1859
userid = 1859
filled ques with qualify options, after 1 hr reload questionnaire and filled with unqualified options and got unqualified thank you page
userid = 1860
filled ques with unqualified options and got unqualified thank you page, after 1 hr reload questionnaire and filled with qualified options

userid = 1861
filled ques with qualify options, after 1 1/2 hr reload questionnaire and filled with unqualified options and got unqualified thank you page
userid = 1862
filled ques with unqualified options and got unqualified thank you page, after 1 1/2 hr reload questionnaire and filled with qualified options
https://dev.purplelegalclaims.co.uk/questionnaire?visitor_id=1586&user_id=1860
1.5 hr
https://dev.purplelegalclaims.co.uk/questionnaire?visitor_id=1586&user_id=1861
https://dev.purplelegalclaims.co.uk/questionnaire?visitor_id=1586&user_id=1862
/////////////////////////////////////////////////////////////////////////
INSERT INTO questionnaire_options (id, questionnaire_id, label, value, target, type, class, flow, rank, status, created_at, updated_at) VALUES (NULL, '60', '<span>B</span> Opened in the bank', 'Opened in the bank', '61', 'radio', NULL, '1', '2', '1', '2019-12-09 19:01:06', '2019-12-09 19:01:06');
UPDATE questionnaire_options SET label = '<span>A</span> It was upgraded without my knowledge', rank = '1' WHERE questionnaire_options.id = 194;
UPDATE questionnaire_options SET label = '<span>D</span> I applied online', rank = '4' WHERE questionnaire_options.id = 333;
UPDATE questionnaire_options SET label = '<span>C</span> Telephone', rank = '3' WHERE questionnaire_options.id = 334;
INSERT INTO questionnaire_options (id, questionnaire_id, label, value, target, type, class, flow, rank, status, created_at, updated_at) VALUES (NULL, '60', '<span>E</span> Other', 'Other', '61', 'radio', NULL, '1', '5', '1', '2019-12-09 19:01:06', '2019-12-09 19:01:06');
//////////////////////////////////////////////////////////////////////////////
[{"user_id":"48408","questionnaire_id":85,"questionnaire_option_id":"330","input_answer":null},{"user_id":"48408","questionnaire_id":60,"questionnaire_option_id":"194","input_answer":null},{"user_id":"48408","questionnaire_id":61,"questionnaire_option_id":"195","input_answer":null},{"user_id":"48408","questionnaire_id":62,"questionnaire_option_id":"203","input_answer":null},{"user_id":"48408","questionnaire_id":63,"questionnaire_option_id":"206","input_answer":null},{"user_id":"48408","questionnaire_id":64,"questionnaire_option_id":"212","input_answer":null},{"user_id":"48408","questionnaire_id":65,"questionnaire_option_id":"216","input_answer":null},{"user_id":"48408","questionnaire_id":67,"questionnaire_option_id":"235","input_answer":null},{"user_id":"48408","questionnaire_id":69,"questionnaire_option_id":"269","input_answer":null},{"user_id":"48408","questionnaire_id":70,"questionnaire_option_id":"273","input_answer":null},{"user_id":"48408","questionnaire_id":71,"questionnaire_option_id":"274","input_answer":null},{"user_id":"48408","questionnaire_id":72,"questionnaire_option_id":"277","input_answer":null},{"user_id":"48408","questionnaire_id":73,"questionnaire_option_id":"280","input_answer":null},{"user_id":"48408","questionnaire_id":74,"questionnaire_option_id":"283","input_answer":null},{"user_id":"48408","questionnaire_id":75,"questionnaire_option_id":"287","input_answer":null},{"user_id":"48408","questionnaire_id":76,"questionnaire_option_id":"307","input_answer":null},{"user_id":"48408","questionnaire_id":79,"questionnaire_option_id":294,"input_answer":"523003"},{"user_id":"48408","questionnaire_id":80,"questionnaire_option_id":297,"input_answer":"XXXX 4560"}]
[{"user_id":"48408","questionnaire_id":76,"questionnaire_option_id":"307","input_answer":null},{"user_id":"48408","questionnaire_id":79,"questionnaire_option_id":294,"input_answer":"523003"},{"user_id":"48408","questionnaire_id":80,"questionnaire_option_id":297,"input_answer":"XXXX 4560"}]
[{"user_id":"48408","questionnaire_id":73,"questionnaire_option_id":"280","input_answer":null},{"user_id":"48408","questionnaire_id":74,"questionnaire_option_id":"283","input_answer":null}]
[{"user_id":"48408","questionnaire_id":71,"questionnaire_option_id":"274","input_answer":null},{"user_id":"48408","questionnaire_id":72,"questionnaire_option_id":"277","input_answer":null}]
================================================================================================
[{"user_id":"48317","questionnaire_id":67,"questionnaire_option_id":"234","input_answer":null},{"user_id":"48317","questionnaire_id":68,"questionnaire_option_id":"238","input_answer":null}]
[{"user_id":"48317","questionnaire_id":71,"questionnaire_option_id":"274","input_answer":null},{"user_id":"48317","questionnaire_id":72,"questionnaire_option_id":"278","input_answer":null}]
[{"user_id":"48317","questionnaire_id":73,"questionnaire_option_id":"280","input_answer":null},{"user_id":"48317","questionnaire_id":74,"questionnaire_option_id":"284","input_answer":null}]
[{"user_id":"48317","questionnaire_id":76,"questionnaire_option_id":"307","input_answer":null},{"user_id":"48317","questionnaire_id":79,"questionnaire_option_id":294,"input_answer":"601434"},{"user_id":"48317","questionnaire_id":80,"questionnaire_option_id":297,"input_answer":"XXXX 0229"}]
[{"user_id":"48317","questionnaire_id":85,"questionnaire_option_id":"330","input_answer":null},{"user_id":"48317","questionnaire_id":60,"questionnaire_option_id":"194","input_answer":null},{"user_id":"48317","questionnaire_id":61,"questionnaire_option_id":"195","input_answer":null},{"user_id":"48317","questionnaire_id":62,"questionnaire_option_id":"203","input_answer":null},{"user_id":"48317","questionnaire_id":63,"questionnaire_option_id":"205","input_answer":null},{"user_id":"48317","questionnaire_id":64,"questionnaire_option_id":"212","input_answer":null},{"user_id":"48317","questionnaire_id":65,"questionnaire_option_id":"216","input_answer":null},{"user_id":"48317","questionnaire_id":67,"questionnaire_option_id":"234","input_answer":null},{"user_id":"48317","questionnaire_id":68,"questionnaire_option_id":"238","input_answer":null},{"user_id":"48317","questionnaire_id":69,"questionnaire_option_id":"269","input_answer":null},{"user_id":"48317","questionnaire_id":70,"questionnaire_option_id":"271","input_answer":null},{"user_id":"48317","questionnaire_id":71,"questionnaire_option_id":"274","input_answer":null},{"user_id":"48317","questionnaire_id":72,"questionnaire_option_id":"278","input_answer":null},{"user_id":"48317","questionnaire_id":73,"questionnaire_option_id":"280","input_answer":null},{"user_id":"48317","questionnaire_id":74,"questionnaire_option_id":"284","input_answer":null},{"user_id":"48317","questionnaire_id":75,"questionnaire_option_id":"287","input_answer":null},{"user_id":"48317","questionnaire_id":76,"questionnaire_option_id":"307","input_answer":null},{"user_id":"48317","questionnaire_id":79,"questionnaire_option_id":294,"input_answer":"601434"},{"user_id":"48317","questionnaire_id":80,"questionnaire_option_id":297,"input_answer":"XXXX 0229"}]

/////////////////////////////////////////////////////////////////////
	48252,48256,48259,48261
/////////////////////////////////////////////////////////////////////
INSERT INTO questionnaires (id, bank_id, title, is_required, is_displayed, form_type, default_id, parent, status, created_at, updated_at) VALUES (NULL, '0', 'Did you pay a monthly fee for this account?', 'yes', '1', 'radio', NULL, '85', '1', '2020-08-06 00:22:58', '2020-08-06 00:22:58');
////////////////////////////////////////////////////////////////////////////
INSERT INTO questionnaire_options (id, questionnaire_id, label, value, target, type, class, flow, rank, status, created_at, updated_at) VALUES (NULL, '85', '<span>A</span> Yes', 'Yes', '60', 'radio', NULL, '1', '0', '1', '2020-08-06 00:24:03', '2020-08-06 00:24:03');
INSERT INTO questionnaire_options (id, questionnaire_id, label, value, target, type, class, flow, rank, status, created_at, updated_at) VALUES (NULL, '85', '<span>B</span> No', 'No', '60', 'radio', NULL, '1', '0', '1', '2020-08-06 00:24:03', '2020-08-06 00:24:03');
INSERT INTO questionnaire_options (id, questionnaire_id, label, value, target, type, class, flow, rank, status, created_at, updated_at) VALUES (NULL, '85', '<span>C</span> Not Sure', 'Not Sure', '60', 'radio', NULL, '1', '0', '1', '2020-08-06 00:24:03', '2020-08-06 00:24:03');
////////////////////////////////////////////////////////////////////////////
INSERT INTO questionnaire_ranks (id, questionnaire_id, bank_id, version, rank, created_at, updated_at) VALUES (NULL, '85', '0', 'questionnaire.v1', '95', '2019-12-10 06:22:00', '2019-12-10 06:22:00');
INSERT INTO questionnaire_ranks (id, questionnaire_id, bank_id, version, rank, created_at, updated_at) VALUES (NULL, '85', '0', 'questionnaire.v2', '95', '2019-12-10 06:22:00', '2019-12-10 06:22:00');
INSERT INTO questionnaire_ranks (id, questionnaire_id, bank_id, version, rank, created_at, updated_at) VALUES (NULL, '85', '0', 'questionnaire.v2b', '95', '2019-12-10 06:22:00', '2019-12-10 06:22:00');
INSERT INTO questionnaire_ranks (id, questionnaire_id, bank_id, version, rank, created_at, updated_at) VALUES (NULL, '85', '0', 'questionnaire.v3', '95', '2019-12-10 06:22:00', '2019-12-10 06:22:00');
INSERT INTO questionnaire_ranks (id, questionnaire_id, bank_id, version, rank, created_at, updated_at) VALUES (NULL, '85', '0', 'questionnaire.v4', '95', '2019-12-10 06:22:00', '2019-12-10 06:22:00');
INSERT INTO questionnaire_ranks (id, questionnaire_id, bank_id, version, rank, created_at, updated_at) VALUES (NULL, '85', '0', 'questionnaire.v5', '95', '2019-12-10 06:22:00', '2019-12-10 06:22:00');
/////////////////////////////////////////////////////////////////////////

UPDATE questionnaire_options SET target='85' WHERE questionnaire_id='82' AND target='60';
////////////////////////////////////////////////////////////////////////////////////

second ques
UPDATE questionnaires SET title = 'How did you come to have this account?' WHERE questionnaires.id = 60;
UPDATE questionnaire_options SET status = '0' WHERE questionnaire_options.id = 192;
INSERT INTO questionnaire_options (id, questionnaire_id, label, value, target, type, class, flow, rank, status, created_at, updated_at) VALUES (NULL, '60', '<span>A</span> I applied online', 'I applied online', '61', 'radio', NULL, '1', '1', '1', '2019-12-09 19:00:32', '2019-12-09 19:00:32');


UPDATE questionnaire_options SET status = '0' WHERE questionnaire_options.id = 193;

INSERT INTO questionnaire_options (id, questionnaire_id, label, value, target, type, class, flow, rank, status, created_at, updated_at) VALUES (NULL, '60', '<span>B</span> Telephone', 'Telephone', '61', 'radio', NULL, '1', '2', '1', '2019-12-09 19:01:06', '2019-12-09 19:01:06');

third ques
UPDATE questionnaire_options SET status = '0' WHERE questionnaire_options.id = 199;

fourth ques
UPDATE questionnaire_options SET status = '0' WHERE questionnaire_options.id = 222;

fifth ques
UPDATE questionnaire_options SET status = '0' WHERE questionnaire_options.id = 247;
UPDATE questionnaire_options SET status = '0' WHERE questionnaire_options.id = 249;
UPDATE questionnaire_options SET status = '0' WHERE questionnaire_options.id = 251;
UPDATE questionnaire_options SET status = '0' WHERE questionnaire_options.id = 253;

UPDATE questionnaire_options SET status = '0' WHERE questionnaire_options.id = 308;
INSERT INTO questionnaire_options (id, questionnaire_id, label, value, target, type, class, flow, rank, status, created_at, updated_at) VALUES (NULL, '68', 'Severe Liver Disease', 'Severe Liver Disease', '69', 'checkbox', NULL, '1', '17', '1', '2020-03-27 18:22:18', '2020-03-27 18:22:18');



UPDATE questionnaire_options SET status = '0' WHERE questionnaire_options.id = 309;
INSERT INTO questionnaire_options (id, questionnaire_id, label, value, target, type, class, flow, rank, status, created_at, updated_at) VALUES (NULL, '68', 'Kidney Failure', 'Kidney Failure', '69', 'checkbox', NULL, '1', '17', '1', '2020-03-27 18:22:18', '2020-03-27 18:22:18');




=========================================================================================================

INSERT INTO questionnaires (id, bank_id, title, is_required, is_displayed, form_type, default_id, parent, status, created_at, updated_at) VALUES (NULL, '0', 'Did you pay a monthly fee for this account?', 'yes', '1', 'radio', NULL, '85', '1', '2020-08-06 00:22:58', '2020-08-06 00:22:58');



UPDATE questionnaire_options SET status = '0' WHERE questionnaire_options.id = 192;
INSERT INTO questionnaire_options (id, questionnaire_id, label, value, target, type, class, flow, rank, status, created_at, updated_at) VALUES (NULL, '60', '<span>A</span> I applied online', 'I applied online', '61', 'radio', NULL, '1', '1', '1', '2019-12-09 19:00:32', '2019-12-09 19:00:32');


UPDATE questionnaire_options SET status = '0' WHERE questionnaire_options.id = 193;

INSERT INTO questionnaire_options (id, questionnaire_id, label, value, target, type, class, flow, rank, status, created_at, updated_at) VALUES (NULL, '60', '<span>B</span> Telephone', 'Telephone', '61', 'radio', NULL, '1', '2', '1', '2019-12-09 19:01:06', '2019-12-09 19:01:06');



























UPDATE questionnaire_options SET status = '0' WHERE questionnaire_options.id = 308;
INSERT INTO questionnaire_options (id, questionnaire_id, label, value, target, type, class, flow, rank, status, created_at, updated_at) VALUES (NULL, '68', 'severe liver disease', 'severe liver disease', '69', 'checkbox', NULL, '1', '17', '1', '2020-03-27 18:22:18', '2020-03-27 18:22:18');



UPDATE questionnaire_options SET status = '0' WHERE questionnaire_options.id = 309;
INSERT INTO questionnaire_options (id, questionnaire_id, label, value, target, type, class, flow, rank, status, created_at, updated_at) VALUES (NULL, '68', 'kidney failure', 'kidney failure', '69', 'checkbox', NULL, '1', '17', '1', '2020-03-27 18:22:18', '2020-03-27 18:22:18');



========================================================================================================
INSERT INTO questionnaires (id, bank_id, title, is_required, is_displayed, form_type, default_id, parent, status, created_at, updated_at) VALUES (NULL, '0', 'Did you pay a monthly fee for this account?', 'yes', '1', 'radio', NULL, '85', '1', '2020-08-06 00:22:58', '2020-08-06 00:22:58');

INSERT INTO questionnaire_options (id, questionnaire_id, label, value, target, type, class, flow, rank, status, created_at, updated_at) VALUES (NULL, '85', '<span>A</span> Yes', 'Yes', '60', 'radio', NULL, '1', '1', '1', '2020-08-06 00:24:03', '2020-08-06 00:24:03');
INSERT INTO questionnaire_options (id, questionnaire_id, label, value, target, type, class, flow, rank, status, created_at, updated_at) VALUES (NULL, '85', '<span>B</span> No', 'No', '60', 'radio', NULL, '1', '2', '1', '2020-08-06 00:24:03', '2020-08-06 00:24:03');
INSERT INTO questionnaire_options (id, questionnaire_id, label, value, target, type, class, flow, rank, status, created_at, updated_at) VALUES (NULL, '85', '<span>C</span> Not Sure', 'Not Sure', '60', 'radio', NULL, '1', '3', '1', '2020-08-06 00:24:03', '2020-08-06 00:24:03');

INSERT INTO questionnaire_ranks (id, questionnaire_id, bank_id, version, rank, created_at, updated_at) VALUES (NULL, '85', '0', 'questionnaire.v1', '95', '2019-12-10 06:22:00', '2019-12-10 06:22:00');
INSERT INTO questionnaire_ranks (id, questionnaire_id, bank_id, version, rank, created_at, updated_at) VALUES (NULL, '85', '0', 'questionnaire.v2', '95', '2019-12-10 06:22:00', '2019-12-10 06:22:00');
INSERT INTO questionnaire_ranks (id, questionnaire_id, bank_id, version, rank, created_at, updated_at) VALUES (NULL, '85', '0', 'questionnaire.v2b', '95', '2019-12-10 06:22:00', '2019-12-10 06:22:00');
INSERT INTO questionnaire_ranks (id, questionnaire_id, bank_id, version, rank, created_at, updated_at) VALUES (NULL, '85', '0', 'questionnaire.v3', '95', '2019-12-10 06:22:00', '2019-12-10 06:22:00');
INSERT INTO questionnaire_ranks (id, questionnaire_id, bank_id, version, rank, created_at, updated_at) VALUES (NULL, '85', '0', 'questionnaire.v4', '95', '2019-12-10 06:22:00', '2019-12-10 06:22:00');
INSERT INTO questionnaire_ranks (id, questionnaire_id, bank_id, version, rank, created_at, updated_at) VALUES (NULL, '85', '0', 'questionnaire.v5', '95', '2019-12-10 06:22:00', '2019-12-10 06:22:00');

UPDATE questionnaire_options SET target='85' WHERE questionnaire_id='82' AND target='60';

UPDATE questionnaires SET title = 'How did you come to have this account?' WHERE questionnaires.id = 60;

UPDATE questionnaire_options SET status = '0' WHERE questionnaire_options.id = 192;

INSERT INTO questionnaire_options (id, questionnaire_id, label, value, target, type, class, flow, rank, status, created_at, updated_at) VALUES (NULL, '60', '<span>A</span> I applied online', 'I applied online', '61', 'radio', NULL, '1', '1', '1', '2019-12-09 19:00:32', '2019-12-09 19:00:32');

UPDATE questionnaire_options SET status = '0' WHERE questionnaire_options.id = 193;

INSERT INTO questionnaire_options (id, questionnaire_id, label, value, target, type, class, flow, rank, status, created_at, updated_at) VALUES (NULL, '60', '<span>B</span> Telephone', 'Telephone', '61', 'radio', NULL, '1', '2', '1', '2019-12-09 19:01:06', '2019-12-09 19:01:06');

UPDATE questionnaire_options SET status = '0' WHERE questionnaire_options.id = 199;

UPDATE questionnaire_options SET status = '0' WHERE questionnaire_options.id = 222;

UPDATE questionnaire_options SET status = '0' WHERE questionnaire_options.id = 247;
UPDATE questionnaire_options SET status = '0' WHERE questionnaire_options.id = 249;
UPDATE questionnaire_options SET status = '0' WHERE questionnaire_options.id = 251;
UPDATE questionnaire_options SET status = '0' WHERE questionnaire_options.id = 253;

UPDATE questionnaire_options SET label = 'Severe Liver Disease', value = 'Severe Liver Disease' WHERE questionnaire_options.id = 308;
UPDATE questionnaire_options SET label = 'Kidney Failure', value = 'Kidney Failure' WHERE questionnaire_options.id = 309;
=======================================================================================================


https://
dev.purplelegalclaims.co.uk/thankyou-unqualified?user_id=1768&visitor_id=1544&vu_id=MTU0NF89XzE3Njg&utm_source=&utm_medium=&utm_campaign=&utm_term=

https://dev.purplelegalclaims.co.uk/followup?tracker=ADTOPIA2&pixel=dsb_26468&atp_source=DSB&atp_vendor=direct-site-buys&atp_sub1=8_1&atp_sub2=&atp_sub3=&atp_sub4=&url_id=767&lp_id=


$strThankyouPage        =   FrontendClass::redirectToThankyouUnqualifiedWeb('thankyou-unqualified',array("userId"=>$request->user_id,"visitorId"=>$request->visitor_id));
                return $strThankyouPage;


   var strAjaxUrl = jsGetSiteUrl() + 'ajax/is_qualify';
     var strParam = '?user_id=' + user_id + '&visitor_id=' + visitor_id+ '&claim=' + claim+ '&filedbankrupt=' + filedbankrupt;
     $.ajax({
       url: strAjaxUrl + strParam,
     }).done(function (result) {
         window.location.href = result;
     });


<span  class="line-break-span" >A</span> <p class="line-break">I applied online</p>
<span>B</span> I applied online
<span>B</span> Telephone
<span>B</span> I applied online


UPDATE questionnaire_options SET label = '<span>B</span> I applied online' WHERE questionnaire_options.id = 192;


https://
dev.purplelegalclaims.co.uk/questionnaire-redirection?user_id=1732&visitor_id=1514&vu_id=MTUxNF89XzE3MzI&utm_source=&utm_medium=&utm_campaign=&utm_term=
///////////////////////////////////////////////////////////////
select b.id as bank_id, V.ip_address, V.campaign, V.tracker_master_id, V.sub_tracker, U.created_at, U.title, U.first_name, U.last_name, U.email, U.telephone, U.dob, T.result_detail, T.is_pixel_fire, T.is_fb_pixel_fired, T.is_voluumtrk2_pixel_fired, T.result, T.record_status, T.lead_value, T.lead_id, V.adv_visitor_id, V.pid, V.adv_redirect_domain, T.lead_buyer_id, T.track_counter, UD.street, UD.town, UD.county, UD.postcode, UD.housenumber, UD.country, UD.housename, UD.address3, b.bank_name as bankname, (2020 - YEAR(STR_TO_DATE(U.dob, '%d/%m/%Y'))) AS dobYearDiff from visitors as V left join users as U on V.id = U.visitor_id left join users_transactions as T on U.id = T.user_id left join user_banks as ub on U.id = ub.user_id left join banks as b on ub.bank_id = b.id left join user_details as UD on U.id = UD.user_id where V.id = 8 and U.id = 10 limit 1
////////////////////////////////////////////////////////////////////////////
85788,56887,95229
//////////////////////////////////////////////////////////////////
95547,95549,95563,95565,95586,95587,95591
///////////////////////////////////////////////////////////////////////
kseb bill
https://prnt.sc/w4l9qk
https://prnt.sc/w4lcbr

/////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////
"2020-11-21 00:00:00" and "2020-11-21 23:59:59"
266,599,600--,604--,606--,616,617,618,619,620,632,636,639,644,645--,813,819--
/////////////////////////////////////////////////
b383db16-b693-48eb-ba9a-4afed1fe3f6e
////////////////////////////////////////////////////
60499,63606,84793,85756,86333,92334,92752
/////////////////////////////
34925,64519,76874,79712,87429,92896---,93114,93117,93187,93387----,93430
/////////////////////////
34925,64519,76874,79712,87429,93114,93117,93187,93430
///////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////
SELECT t1.user_id, count(t1.user_id) AS total,
 sum(case when t1.user_signature = 1 then 1 else 0 end) AS user_signature,
 sum(case when t1.partner_signature = 1 then 1 else 0 end) AS partner_signature,
 sum(case when t1.questions = 1 then 1 else 0 end) AS questions,
 sum(case when t1.partner_questions = 1 then 1 else 0 end) AS partner_questions,
 sum(case when t1.partner_details = 1 then 1 else 0 end) AS partner_details,
 sum(case when t1.user_insurance_number = 1 then 1 else 0 end) AS user_insurance_number,
 sum(case when t1.spouses_insurance_number = 1 then 1 else 0 end) AS spouses_insurance_number,
 sum(case when t1.identification_type = 1 then 1 else 0 end) AS identification_type,
 sum(case when t1.identification_image = 1 then 1 else 0 end) AS identification_image,
 sum(case when t1.completed = 1 then 1 else 0 end) AS completed
FROM user_milestone_stats t1 
INNER JOIN (SELECT ums_1.* FROM user_milestone_stats ums_1 LEFT JOIN user_milestone_stats ums_2 
	ON ( ums_1.user_id = ums_2.user_id AND ums_1.id < ums_2.id )
   WHERE ums_2.id IS NULL and ums_1.source like '%CRM%' ) 
t2 ON t1.user_id = t2.user_id inner join user_milestone_stats as newm on t1.user_id = newm.user_id and newm.source like '%CRM%' inner join users as ut on ut.id = t1.user_id and ut.is_qualified in (1, 2) and ut.record_status = 'LIVE' where newm.created_at between "2020-10-20 00:00:00" and "2020-10-20 23:59:59" group by t1.user_id
having  user_signature > 0
 and partner_signature > 0
 and questions > 0
 and partner_questions > 0
 and partner_details > 0
 and user_insurance_number > 0
 and spouses_insurance_number > 0
 and identification_type = 0
 and identification_image = 0
 and completed = 0
////////////////////////////////////////////////////////////////////////////////
SELECT t1.user_id,
count(t1.user_id) AS total,
sum(case when t1.user_signature = 1 then 1 else 0 end) AS user_signature,
sum(case when t1.partner_signature = 1 then 1 else 0 end) AS partner_signature,
sum(case when t1.questions = 1 then 1 else 0 end) AS questions,
sum(case when t1.partner_questions = 1 then 1 else 0 end) AS partner_questions,
sum(case when t1.partner_details = 1 then 1 else 0 end) AS partner_details,
sum(case when t1.user_insurance_number = 1 then 1 else 0 end) AS user_insurance_number,
sum(case when t1.identification_type = 1 then 1 else 0 end) AS identification_type
FROM user_milestone_stats t1 INNER JOIN (SELECT ums_1.* FROM user_milestone_stats ums_1 LEFT JOIN user_milestone_stats ums_2 ON (ums_1.user_id = ums_2.user_id AND ums_1.id < ums_2.id) WHERE ums_2.id IS NULL and ums_1.source like '%FLP%') t2 ON t1.user_id = t2.user_id group by t1.user_id having identification_type = 0 and user_signature > 0 and partner_signature > 0 and questions > 0 and partner_questions > 0 and partner_details > 0 and user_insurance_number > 0
//////////////////////////////////////////////////////////////////////
$query = Users::select('users.id', 'users.user_name','answers.created_at as last_activity_date')
->leftJoin('answers', function($query) {
                    $query->on('users.id','=','answers.user_id')
                        ->whereRaw('answers.id IN (select MAX(a2.id) from answers as a2 join users as u2 on u2.id = a2.user_id group by u2.id)');
})
->where('users.role_type_id', Users::STUDENT_ROLE_TYPE)->get();
//////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////
27083,43261,75760,83547,94180,94633,94642--,94733,94735,94770
///////////////////////////////////////////////////////////////////////
43261,83547,94180,94633,94642---,94733,94735,94770----
////////////////////////////////
43261,44802,83547,94180,94633,94733,94735
///////////////////////////////////////////////
43261,83547,94180,94633,94733,94735
/////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////
adto_db atp_redirect_url
ALTER TABLE atp_redirect_urls ADD channel_id BIGINT(21) NULL AFTER url_type;
add new table followup_channels
'2020-04-08 16:53:34' and '2020-04-08 16:53:34'/////////////////
94817
58460
88858
94869
94780
95112
94741
94583
////////////////////////////////////////////////////////////
94817
41304/
58460
88858
94869
94780
95112
58804/
94741
64170/
94583
////////////////////////////////////////////////////////////////////////////////
2502,5340,11966,13852,14406,20699,22515,22543,25024,25248,28366,30128,35755,
///////////////////////////////////////////////////////////////////
prod crm abi count
16904,80664 
////////////////////////////////////////////////////////////////////////
380,429,438,442,460,545,603,622,648
///////////////////////////////////////////////////////////////////////
266,599,600,604,606,616,617,618,619,620,632,636,639,644,645,813,819
//////////////////////////////////////////////////////////////////////////////
380,429,438,442,460,545,599,600,603,604,606,616,617,618,619,620,622,632,636,639,644,645,648
/////////////////////////////////////////////////////////////////////////////////
599,600,604,606,616,617,618,619,620,632,636,639,644,645
///////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////
SELECT t1.user_id,
count(t1.user_id) AS total,
sum(case when t1.user_signature = 1 then 1 else 0 end) AS user_signature,
sum(case when t1.partner_signature = 1 then 1 else 0 end) AS partner_signature,
sum(case when t1.questions = 1 then 1 else 0 end) AS questions,
sum(case when t1.partner_questions = 1 then 1 else 0 end) AS partner_questions,
sum(case when t1.partner_details = 1 then 1 else 0 end) AS partner_details,
sum(case when t1.user_insurance_number = 1 then 1 else 0 end) AS user_insurance_number,
sum(case when t1.identification_type = 1 then 1 else 0 end) AS identification_type
FROM user_milestone_stats t1 INNER JOIN (SELECT ums_1.* FROM user_milestone_stats ums_1 LEFT JOIN user_milestone_stats ums_2 ON (ums_1.user_id = ums_2.user_id AND ums_1.id < ums_2.id) WHERE ums_2.id IS NULL and ums_1.source like '%FLP%') t2 ON t1.user_id = t2.user_id group by t1.user_id having identification_type = 0 and user_signature > 0 and partner_signature > 0 and questions > 0 and partner_questions > 0 and partner_details > 0 and user_insurance_number > 0
/////////////////////////////////////////////////////////////////////////////////////
SELECT t1.user_id,
count(t1.user_id) AS total,
sum(case when t1.user_signature = 1 then 1 else 0 end) AS user_signature,
sum(case when t1.partner_signature = 1 then 1 else 0 end) AS partner_signature,
sum(case when t1.questions = 1 then 1 else 0 end) AS questions,
sum(case when t1.partner_questions = 1 then 1 else 0 end) AS partner_questions,
sum(case when t1.partner_details = 1 then 1 else 0 end) AS partner_details,
sum(case when t1.user_insurance_number = 1 then 1 else 0 end) AS user_insurance_number,
sum(case when t1.identification_type = 1 then 1 else 0 end) AS identification_type
FROM user_milestone_stats t1 INNER JOIN (SELECT ums_1.* FROM user_milestone_stats ums_1 LEFT JOIN user_milestone_stats ums_2 ON (ums_1.user_id = ums_2.user_id AND ums_1.id < ums_2.id) WHERE ums_2.id IS NULL and ums_1.source like '%FLP%') t2 ON t1.user_id = t2.user_id group by t1.user_id having identification_type = 0 and user_signature > 0 and partner_signature > 0 and questions > 0 and partner_questions > 0 and partner_details > 0 and user_insurance_number > 0

//////////////////////////////////////////////////////////////////////////////


57333,59386,1829,2075
flp_53 - 1
flp_54 - 2
flp_55 - 1
flp_91 - 35
-----------------------------
followup visitors count diff report to query 
nov 26
FLP_80 - 1
FLP_91 - 5
nov 25
FLP_53 - 3
FLP_91 - 4
FLP_93 - 1
//////////////////////////////////////////////////////////////////////////////////////////////


+91-8921168356, stp970@yahoo.com 
+91-9495523231, jesty.sam5@gmail.com 
+91-7777043591, prafulmathew4@gmail.com


6699,6699,6699,6699,6997,6997,6997,6997,6961,6961,6961,6961,6917,6917,6665,6749,6749,6915,6749,3298,6979,7018,2707,2679,2714,7049,2824,2837,6951,3115,2659,7046,3104,3104,2824,7174,3104,6778,6982,,6982,3104,7159,7160,7114,6339,5425,2659,7109,7159,6984,2659,7159,6982,6574,3115,6914,3104,7120,7120,6914,7209,3115,6924,2707,6952,7109,2848,2754,2888,2888,2888,3124,3124,3124,7024,2754,7022,6624,6624,2707,2707,6951,6778,6778

6699,6997,6961,6917,6665,6749,6915,3298,6979,7018,2707,2679,2714,7049,2824,2837,6951,3115,2659,7046,3104,7174,6778,6982,7159,7160,7114,6339,5425,7109,6984,6574,6914,7120,7209,6924,6952,2848,2754,2888,3124,7024,7022,6624

6339
6574
6665
6699
6778
6914
6915
6917
6924
6951
6952
6979
6984
6997
7018
7022
7024
7049
7109
7114
7160
7174
select
count(followup_visit.user_id) as followup_user_count,
count(case when mile.completed = 1 then 1 else null end) as completed_count,
count(case when mile.signature = 1 then 1 else null end) as signature_count,
count(uqsta.user_id) as questions_count,
count(case when mile.bank_sort_code = 1 then 1 else null end) as
bank_sort_code_count,
count(case when mile.bank_account_no = 1 then 1 else null end) as
bank_account_no_count
from followup_visit
left join user_milestone_stats as mile on mile.user_id =
followup_visit.user_id and mile.source = followup_visit.source
left join user_questionnaire_stats as uqsta on uqsta.user_id =
followup_visit.user_id and uqsta.source = followup_visit.source
where followup_visit.source = 'FLP'
and followup_visit.created_at between '2020-04-17 00:00:00'
and '2020-04-17 23:59:59'


query full 5th - 26
query with both 1 5th - 41
167110 - 8015 - no flp
167761 - 8214 partner =1 , user = null
167691 - 7530 
167635 - 7546 partner =1, user =null
167732 - 8149 user = partner =1 flp
167600 - 3829 user =1 crm - partner =1 flp
163118 - 6275 (167437, 	167744)
167017 - 6991 
167037 - 7983
167045 - 7992
167089 - 6569
167110 - 8015
167111 - 7992 -(167120, 167122, 167175, 167177, 167270, 169056)
167620 - 7739
167695 - 8040
167726 - 8168 - 9167712)
167600 - 3829 
167657 - 8035 -
167691 - 7530
167207 - 7709
167238 - 8044 - (167217 , 167239)

followup_vendor_pixel_firing
dsb_163118,dsb_167017,dsb_167037,dsb_167043,dsb_167045,dsb_167089,dsb_167109,dsb_167110,dsb_167111,dsb_167112,dsb_167116,dsb_167119,dsb_167121,dsb_167167,dsb_167195,dsb_167202,dsb_167205,dsb_167207,dsb_167217,dsb_167219,dsb_167232,dsb_167238,dsb_167239,dsb_167276,dsb_167278,dsb_167279,dsb_167284,dsb_167343,dsb_167363,dsb_167364,dsb_167369,dsb_167370,dsb_167372,dsb_167378,dsb_167382,dsb_167383,dsb_167384,dsb_167385,dsb_167391,dsb_167412,dsb_167417,dsb_167431,dsb_167437,dsb_167453,dsb_167458,dsb_167476,dsb_167485,dsb_167494,dsb_167495,dsb_167497,dsb_167502,dsb_167503,dsb_167506,dsb_167515,dsb_167519,dsb_167523,dsb_167527,dsb_167529,dsb_167568,dsb_167574,dsb_167575,dsb_167577,dsb_167587,dsb_167595,dsb_167598,dsb_167600,dsb_167608,dsb_167616,dsb_167620,dsb_167622,dsb_167632,dsb_167635,dsb_167641,dsb_167657,dsb_167674,dsb_167678,dsb_167691,dsb_167695,dsb_167712,dsb_167715,dsb_167719,dsb_167720,dsb_167721,dsb_167726,dsb_167731,dsb_167732,dsb_167744,dsb_167761,dsb_25621
dsb_


6275,6991,7983,7763,7992,6569,8015,8015,7992,8015,7718,7585,7585,7182,7416,8035,8036,7709,8044,7325,8045,8044,8044,7717,8062,8062,8067,7579,7900,7366,7565,7661,7276,7629,7565,7229,7570,7629,7366,7366,7480,7867,6275,7766,7366,7718,7766,7747,7747,7366,7570,7570,7366,7718,7746,7391,7649,7446,7546,7788,7788,7788,7578,7879,8056,3829,7579,7506,7739,7546,8112,7546,8099,8035,8131,8117,7530,8040,8168,7879,8066,7218,7218,8168,8172,8149,6275,8214
and user_completed =1 and partner_completed= 1

SELECT user_id FROM user_milestone_stats WHERE user_id IN (6275,6991,7983,7763,7992,6569,8015,8015,7992,8015,7718,7585,7585,7182,7416,8035,8036,7709,8044,7325,8045,8044,8044,7717,8062,8062,8067,7579,7900,7366,7565,7661,7276,7629,7565,7229,7570,7629,7366,7366,7480,7867,6275,7766,7366,7718,7766,7747,7747,7366,7570,7570,7366,7718,7746,7391,7649,7446,7546,7788,7788,7788,7578,7879,8056,3829,7579,7506,7739,7546,8112,7546,8099,8035,8131,8117,7530,8040,8168,7879,8066,7218,7218,8168,8172,8149,6275,8214) AND source LIKE '%FLP%' AND user_completed = 1 AND partner_completed = 1

6275
NULL
6991

163118,167017,167037,167043,167045,167089,167109,167110,167111,167112,167116,167119,167121,167167,167195,167202,167205,167207,167217,167219,167232,167238,167239,167276,167278,167279,167284,167343,167363,167364,167369,167370,167372,167378,167382,167383,167384,167385,167391,167412,167417,167431,167437,167453,167458,167476,167485,167494,167495,167497,167502,167503,167506,167515,167519,167523,167527,167529,167568,167574,167575,167577,167587,167595,167598,167600,167608,167616,167620,167622,167632,167635,167641,167657,167674,167678,167691,167695,167712,167715,167719,167720,167721,167726,167731,167732,167744,167761

 Sucessfully Updated the Pixel :-159904 on stage :-LP at:-2020-05-15 20:29:47  Method:- Direct Pixel Firing.



https://prnt.sc/syoe4z

agent crm report





completed_count
9986,9992,9959,9193,9199,9921,9250,10086,10096,10124,10137,9595,10193,10239,10238


https://prnt.sc/t0qcgt
https://prnt.sc/t0qcqn
https://prnt.sc/t0qd13
https://prnt.sc/t0qdbe

tvs kottayam 9633524474


7811,11995,747,3827,2154,11884,1221,1088,9623

7811,11995,747,3827,2154,11884,1221,1088,9623,11150

1326,910,11532,1487,440,11884,7786,35,133,1879,1293,9623,1702,129,1167,11893,6090,1016



1487,910,1879

tbl_advertorial_updates
SQL: insert into adv_thrive_details (adv_visitor_id, thr_source, thr_sub1, thr_sub2, thr_sub3, thr_sub4, thr_sub5, thr_sub6, thr_sub7, thr_sub8, thr_sub9, thr_sub10) values (3, , , , , , , , , , , )

tbl_advertorial

Changes in db-tables- tbl_advertorial,adv_visitors_count,adv_pixel_firing, tracker_masters (new table cretaed)
Updated code - tables - Adv_info, AdvPixelFiring(adv_vis_id,page_type),SplitSetting 
updated models - AdvVisitorsCount, SplitSetting


ALTER TABLE adv_pixel_firing ADD updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP AFTER created_at;

hr - 9846888946
mathruktm@gmail.com


select ums.*, user.id, user.first_name, user.last_name, user.email, user.telephone, user.token, user.created_at as created_date from users as user inner join user_milestone_stats as ums on ums.user_id = user.id and ums.source = ? where user.record_status = ? and user.is_qualified in (1, 2) and (ums.user_signature is null or ums.questions is null or ums.user_insurance_number is null or ums.identification_type is null or ums.user_signature is null) and user.created_at between "2020-04-29 11:23:23" and "2020-06-29 11:23:23" group by user.id

"2020-06-29 11:23:23"
select tbl_advertorial.id from tbl_advertorial left join tbl_advertorial_updates as tau on tau.adv_visitor_id = tbl_advertorial.id and tau.tracker_id = ? and tau.adv_id = ? and tau.site_flag_id = ? where tbl_advertorial.remote_ip = ? and tbl_advertorial.browser = ? and tbl_advertorial.country = ? and tau.tracker_unique_id = ?

<p>&lt;p&gt;&amp;lt;!-- Anti-flicker snippet (recommended) &aaamp;nbsp;--&amp;gt;&lt;br /&gt;&amp;lt;style&amp;gt;.async-hide { opacity: 0 !important} a&amp;lt;/style&amp;gt;&lt;br /&gt;&amp;lt;script&amp;gt;(function(a,s,y,n,c,h,i,d,e){s.className+=' '+y;h.start=1*new Date;&lt;br /&gt;h.end=i=function(){s.className=s.className.replace(RegExp(' ?'+y),'')};&lt;br /&gt;(a[n]=a[n]||[]).hide=h;setTimeout(function(){i();h.end=null},c);h.timeout=c;&lt;br /&gt;})(window,document.documentElement,'async-hide','dataLayer',4000,&lt;br /&gt;{'GTM-KH5XT32':true});&amp;lt;/script&amp;gt;&lt;br /&gt;&amp;lt;!-- Global site tag (gtag.js) - Google Analytics --&amp;gt;&lt;br /&gt;&amp;lt;script async src="&lt;a class="Xx" dir="ltr" tabindex="-1" href="https://www.google.com/url?q=https://www.googletagmanager.com/gtag/js?id%3DUA-136555147-2&amp;amp;sa=D&amp;amp;source=hangouts&amp;amp;ust=1573908362383000&amp;amp;usg=AFQjCNHkfjsuVyFHoMZi_8F64m7YLStobw" target="_blank" rel="nofollow noreferrer noopener" data-display="https://www.googletagmanager.com/gtag/js?id=UA-136555147-2" data-sanitized="https://www.google.com/url?q=https://www.googletagmanager.com/gtag/js?id%3DUA-136555147-2&amp;amp;sa=D&amp;amp;source=hangouts&amp;amp;ust=1573908362383000&amp;amp;usg=AFQjCNHkfjsuVyFHoMZi_8F64m7YLStobw"&gt;https://www.googletagmanager.com/gtag/js?id=UA-136555147-2&lt;/a&gt;"&amp;gt;&amp;lt;/script&amp;gt;&lt;br /&gt;&amp;lt;script&amp;gt;&lt;br /&gt;window.dataLayer = window.dataLayer || [];&lt;br /&gt;function gtag(){dataLayer.push(arguments);}&lt;br /&gt;gtag('js', new Date());&lt;br /&gt;&lt;br /&gt;gtag('config', 'UA-136555147-2', { 'optimize_id': 'GTM-KH5XT32'});&lt;br /&gt;&amp;lt;/script&amp;gt;&lt;/p&gt;</p>

aaaaaaaaaaaaaabcdefghji o9iiii0987654321abaaaaaacdefghijklmnopqrstuvwxyz4713691 +
++-+-++5




 ////////////////////////////////////////////////////////////////////////////
a4b93b7c-b450-1cf8-0f9a-14365df65c01 , 3edef7de-a329-1691-05e0-14365d8ce401 , 5a57d2ed-2eac-18d8-0156-14365c328401 , a31d00e3-c0dc-125e-0f3e-14365c2f4801 , c684b0f4-2f93-1e29-05d3-14365bf5b281 , ad8c8525-ec78-1f13-03e4-14365bf02381 , 071dee35-edbf-1a2b-03f6-14365be42801 , 36f9c362-0af0-1169-0e11-14365bddde81


//////////////////////////////////////////////////////////////////////////////


11c84ce9-48a0-14be-0816-1433ff734581 , a56f6c06-c0e7-16a5-047f-1433ff585081 , e8b8d39c-e76d-12c3-0c71-14365c328501 , af1a02e9-2c58-135c-0eb2-1433ff442481 , 05946d6d-ea03-1a71-002d-14365bf5b381 , 266218fe-bb9b-1a1c-018c-14365bf02401 , b8e87f27-a1a8-1b49-058d-14365be42901 , 03fcc9f5-363b-1445-0105-14365bdde081 , 309421e9-68f2-13c1-0a2a-14365bd27301 , 18d654d4-9f7c-1f73-0c92-14365bccda81 , baccac69-9309-16d1-05f2-14365bc0b101 , 215d089a-0981-1072-0211-14365bb8d201 , eefa29cc-ca48-1759-0aef-14365badb601 , 8f6e6061-c893-1b29-0aa5-14365ba88981 , 7bdcfe5c-50b8-1d61-0e7c-14365b9ecf81 , 642c9759-d4d8-1263-092a-14365b9a1f81 , 8b9db22c-16df-1ba8-05e5-14365b8d0d81 , bd8e2bcd-9544-15f4-05a3-14365b86ba81 , 54bca8d5-08b6-1687-07b1-14365b781081 , 5ca40b5e-6a7c-15b6-00b9-14365b6ed181



pixel=2500392397
visitor_id: '2007180'


count(case when ld.tax_payer = "me" and uqsta.questionnaire_id IN (7,8,9,10) then uqsta.user_id when ld.tax_payer = "partner" and uqsta.questionnaire_id IN (11,12,13,14) then uqsta.user_id else null end) as partner_questions_count, 
DISTINCT(case when mile.partner_questions = 1 then mile.user_id else null end) as partner_attribution_count

select DISTINCT(case when mile.partner_questions = 1 then mile.user_id else null end) as partner_attribution_count from followup_visit 
left join user_milestone_stats as mile on mile.user_id = followup_visit.user_id and mile.source = followup_visit.source 
left join user_questionnaire_stats as uqsta on uqsta.user_id = followup_visit.user_id and uqsta.source = followup_visit.source 
left join users as ut on ut.id = followup_visit.user_id left join lead_docs as ld on ld.user_id = followup_visit.user_id 
where followup_visit.source = 'CRM_58' and followup_visit.created_at between '2020-07-07 00:00:00' and '2020-07-07 23:59:59' and ut.is_qualified in (1, 2) and ut.record_status = 'LIVE'


select case when ld.tax_payer = "me" and uqsta.questionnaire_id IN (7,8,9,10) then uqsta.user_id when ld.tax_payer = "partner" and uqsta.questionnaire_id IN (11,12,13,14) then uqsta.user_id else null end, ld.tax_payer, uqsta.questionnaire_id from followup_visit 
left join user_milestone_stats as mile on mile.user_id = followup_visit.user_id and mile.source = followup_visit.source 
left join user_questionnaire_stats as uqsta on uqsta.user_id = followup_visit.user_id and uqsta.source = followup_visit.source 
left join users as ut on ut.id = followup_visit.user_id left join lead_docs as ld on ld.user_id = followup_visit.user_id 
where followup_visit.source = 'CRM_58' and followup_visit.created_at between '2020-07-07 00:00:00' and '2020-07-07 23:59:59' and ut.is_qualified in (1, 2) and ut.record_status = 'LIVE'

arrtbn july 7

794,11127,9729,8097,16313,16322,12864,13299,3368,15941,13080,7442,7302,12294,4959

arrtbn july 7
794,16313,16322,15941,7302
without entries in user_ques_status but enries in user_ques_ans : 11127, 9729, 8097, 12864, 13299, 3368, 13080, 7442, 12294, 4959

contrbn july 7
794,16266,16313,16295,16322,15941,7302

https://pre.marriage.taxallowanceawareness.co.uk/ajax/ajax-save-questionnaire?user_id=16438&question_id=8&option_id=21&source_from=CRM_58&history_source=FLP

///////////////////////////////////////////////
july 7 partner  attribuitipin
794,16313,16322,15941

11127,9729,8097,12864,13080,4959,
13299,3368,7442,12294

13299,12294


partner contribution

794,16313,16322,15941

16266,16295,16378,16398,16392,3000,

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

attribn july 12
16378,1004,3438,6903
contribtn july 12
16378
Hi,



Please note my logged in time today is 03:00 PM

////////////////////////////////////////////////////////////////////////////////////////////////////////////////
794,16313,16322,15941,7302,11127,9729,8097,12864,13299,3368,13080,7442,12294,4959


https://marriage.taxallowanceawareness.co.uk/api/v1//lead/{id}



diff july 1
15906,15914


Updated followup api call with saving all data to new table
New table created in local and tested ok for all conditions in api call.



user_id,type,user_type,,requset,response,created_at,updated_at


{"oauth_consumer_key":null,"oauth_token":null,"oauth_signature_method":"HMAC-SHA1","oauth_timestamp":"1589467095","oauth_nonce":"3IyIJr","oauth_version":"1.0","oauth_signature":"w6yxUAy4jU+JDIVeJ08fOORPNDk=","ylb_reference_id":"199","contact":"rahulperumpallil@gmail.com","type":"email","message":"ddduser second {adtourl}","subject":"sample","user_type":"self"}

{"status":"Success","response":202}






APP_NAME=Laravel
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=

BROADCAST_DRIVER=log
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_DRIVER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=mt1

MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"




https://
cars.tatamotors.com/cars/tiago?utm_source=google_search_brand&utm_medium=cpc&utm_campaign=TML_Tiago_June_2020&gclid=CjwKCAjwjLD4BRAiEiwAg5NBFvzQ4KnYgBKvl5NtZUYLDdvuifH8HU0v6oBPbBqMfSnxpMe-2aXHyhoCFD4QAvD_BwE



amma - 91 8943986049
my bsnl - 91 9446804762
mob - 07914258484

Theroyalexchange.Gold >> Some leads from TGE_1 split came in with Country field blank
Leads from this below postcode:
BN411SN
ML118SW
WF133RT
CM12WT
N80DR
CF119BZ
PE78LP

BN411SN,ML118SW,WF133RT,CM12WT,N80DR,CF119BZ,PE78LP

No Qualified Buyers - 11
Duplicate Lead - 6
Service Unavailable - 14
b0 error - 138

http://dev.report.leadfinery.com/artisan/
username: reportleadfinery password: reportleadfinery
http://pre.report.leadfinery.com/artisan/
username: reportleadfinery
password: 5{}Ga^xpqjHG*F%J

https://freeplevincheck.online/horizon/

freeplevincheck
HBc5kivXqW2A


icici 


Transaction Reference Number:58537520
 

Transaction typePayment To ICICI Bank Credit-Card

Date of transaction03/03/2021

From ICICI bank accountxxxxxxxxxx05-V R SUDHA JT1

Payee nick nameRAHUL

Transaction amount (INR)INR 500.00

User id : 290- Lead id :E8D0BBD7 User id : 291- Lead id :06E61CA7

kseb
https://prnt.sc/zpix11
https://prnt.sc/zpj7br
offer_price
id,userid,offerprice,netprice,source,cer,upd
user_id=
1 - 48341
2 - 48342
3 - 48343
http://dev.report.leadfinery.com/horizon/
username: reportleadfinery password: 5{}Ga^xpqjHG*F%J
SELECT * FROM users_transactions WHERE result = 'Error' AND record_added_on BETWEEN '2020-07-23 00:00:00.000000' AND '2020-07-23 23:59:59.999999'SELECT * FROM users_transactions WHERE result = 'Error' AND record_added_on BETWEEN '2020-07-23 00:00:00.000000' AND '2020-07-23 23:59:59.999999'


laravel blade timer count down counter

let timer = function (date) {
    let timer = Math.round(new Date(date).getTime()/1000) - Math.round(new Date().getTime()/1000);
		let minutes, seconds;
		setInterval(function () {
            if (--timer < 0) {
				timer = 0;
			}
			days = parseInt(timer / 60 / 60 / 24, 10);
			hours = parseInt((timer / 60 / 60) % 24, 10);
			minutes = parseInt((timer / 60) % 60, 10);
			seconds = parseInt(timer % 60, 10);

			days = days < 10 ? "0" + days : days;
			hours = hours < 10 ? "0" + hours : hours;
			minutes = minutes < 10 ? "0" + minutes : minutes;
			seconds = seconds < 10 ? "0" + seconds : seconds;

			document.getElementById('cd-days').innerHTML = days;
			document.getElementById('cd-hours').innerHTML = hours;
			document.getElementById('cd-minutes').innerHTML = minutes;
			document.getElementById('cd-seconds').innerHTML = seconds;
		}, 1000);
	}
 
//using the function
const today = new Date()
const tomorrow = new Date(today)
tomorrow.setDate(tomorrow.getDate() + 1)
timer(tomorrow);

---------------------------------------------
<span id="cd-days">00</span> Days 
<span id="cd-hours">00</span> Hours
<span id="cd-minutes">00</span> Minutes
<span id="cd-seconds">00</span> Seconds

1.2 s 8.89

1.2 e 8.07
popular hyndai kanjirapally
6.33 51-down
emi 7 yr- 9874
realtime_followup

sujatha chennai  - 9600680715 , 9962609189
SE109NX,BT154BA,WS31HB,FK29DX

391,392,394,387

SE10 9NX
BT15 4BA
WS3 1HB
FK2 9DX

BN41 1SN
 ML11 8SW
 WF13 3RT
 CM1 2WT
 N8 0DR
 CF11 9BZ
 PE7 8LP




 SE10 9NX,BT15 4BA,WS3 1HB,FK2 9DX,BN41 1SN, ML11 8SW, WF13 3RT, CM1 2WT, N8 0DR, CF11 9BZ, PE7 8LP
http://thegoldexchange.london/cash_for_gold/TGE_1.5?adv_page=&adv_vis_id=&atp_source=614363275873172&atp_sub1=6_2&atp_sub2=&atp_sub3=%7Batp_sub3%7D&atp_sub4=&atp_vendor=facebook&domain=thegoldexchange.london&lp_id=&pid=789884861543840&pixel=2505656745&s2=2505656745&token=bGNCQmorNkJob1NxMTNVeTV3bEI4VjMzYzM3UlNtZHJsbWQxQTVBdkhuRT0%3D&tracker=ADTOPIA2&url_id=1333&utm_campaign=THE_ROYAL_EXCHANGE_V1_JMS&utm_medium=614363275873172&utm_source=FACEBOOK&utm_term=thegoldexchange.london

nandana98@gmail.com

NaturalOpen Tasks ProjectsArticles.senior-benefits.co.uk

849374,849440,849540,849548,849720,849759,849774,849847,849871,849978


godaddy
username : rahul254771
password : Rahul254771

git hub
username : rahul254771@gmail.com   
password :rahul8414
AWS
user : rahul254771@gmail.com
password : rahul@8414
https://github.com/rahul4771/myawesomelife.banque.git

git@github.com:rahul4771/myawesomelife.banque.git

https://vandalay.bitrix24.com/
rahul.v@vandalayglobal.com
Rahul@4771


https://www.asiaregistry.com/
username: rahul8414
rahul254771@gmail.com
pass: 


https://dev.dieselgateclaims.com/horizon
dieselgateclaims
CZ&8<Y7N!&FaTarW

https://pre.dieselgateclaims.com/horizon
dieselgateclaims
P8zP3hxqcQuvQW7h

https://dieselgateclaims.com/horizon
dieselgateclaims
t7cNCJuWjHRumAwz

https://dev.dieselgate.claims/horizon
dieselgate
CZ&8<Y7N!&FaTarWtrd

https://pre.dieselgate.claims/horizon
dieselgate
CZ&8<Y7N!&FaTarWtrd


https://dev.freeplevincheck.online/horizon
freeplevincheck
wj2BvyNzANG4Uw6U

sentry login credentials
username: rahul.v@vandalayglobal.com
name : Rahul V
password : vandalay254771

VEHICLE_DATA_KEY      = 9a0c3e8c-d2d1-4adf-ae59-d609e4702dc7

https://panel.ukvehicledata.co.uk/
rahuldon.v@gmail.comrahul254771

https://uk1.ukvehicledata.co.uk/api/datapackage/VehicleData?v=2&api_nullitems=1&auth_apikey=6207f93a-275c-40c4-a89f-c8a1f2818353&user_tag=&key_VRM=OE65OOA

9a0c3e8c-d2d1-4adf-ae59-d609e4702dc7

6207f93a-275c-40c4-a89f-c8a1f2818353

https://uk1.ukvehicledata.co.uk/api/datapackage/VehicleData?v=2&api_nullitems=1&auth_apikey=9a0c3e8c-d2d1-4adf-ae59-d609e4702dc7&user_tag=&key_VRM=OE65OOA

samagradigitalhub - github credentials

git@github.com:rahul4771/samagradigitalhub.co.git
git@github.com:rahul4771/samagradigitalhub.co.git

https://github.com/rahul4771/samagradigitalhub.co.git

canara bank net banking
customerid: 106913175 
password  : Rahul@4771

Hdfc netbanking credentials
customerid : 118770974
password : Rahul@4771 / Rahul@8414

Icici netbanking credentials
customerid : B574286492
password : Rahul@8414 -(current) / Rahul@4771 / 
ACC NO : 094101001505




com.amazonaws.services.cloudfront.model.InvalidViewerCertificateException: To add an alternate domain name (CNAME) to a CloudFront distribution, you must attach a trusted certificate that validates your authorization to use the domain name. For more details, see: https://docs.aws.amazon.com/AmazonCloudFront/latest/DeveloperGuide/CNAMEs.html#alternate-domain-names-requirements (Service: AmazonCloudFront; Status Code: 400; Error Code: InvalidViewerCertificate; Request ID: df4c9782-b27c-444a-90a2-a9b86deb17db; Proxy: null)


function postcodeVal(flFocus, flForCountry) {
    let txtPostCode = $.trim($("#txtPostCode").val());
    let visitor_id = $('#visitor_id').val();
    prevPostcode = txtPostCode;
    if (flForCountry) {
      flCallGetCountry = true;
    }

    if (txtPostCode != '' && !flPostCodeValidation) {
      $("#txtPostCode").next(".tick").hide();
      $("#loader-txtPostCode").show();
      flPostCodeValidation = true;
      let strAjaxUrl = lib.jsGetSiteUrl() + 'ajax/ajax-postcode-val';
      let strParam = '?postcode=' + txtPostCode + '&visitor_id=' + visitor_id;
      $.ajax({
        url: strAjaxUrl + strParam,
      }).done(function(result) {
        $("#loader-txtPostCode").hide();
        flPostCodeValidation = false;
        if (result == 0) { 
          $("#postcode_err").text("Please Enter Valid Postcode").show(); 
          $("#next02").prop("disabled", true);
          $('#currentAddressCollapse').hide();
          if (flFocus) {
              $("#txtPostCode").focus();
          }
          jsShowHideTick($("#txtPostCode"), "N");
        } else {
          //if(flCallGetCountry){
          getcounty(txtPostCode);

          $('#currentAddressCollapse').show();
          $('#postbtndiv').hide();
          //}
          $("#postcode_err").text('').hide();
          $("#next02").prop("disabled", false);
          jsShowHideTick($("#txtPostCode"), "Y");
          $("#address1").addClass('animated-effect');
        }
      });
    }
  }

select count(*) from analytics_visits where date(created_at) = '2020-08-04';


inspectlet

select id, created_at from adv_visitors_temp where created_at < '2020-08-03' order by created_at asc limit 10


&& $token_arr->record_status == 'LIVE' 
ktm 9895790650

https://yourtaxrebates.com/



ME103US
NG11NH
DE35LP
CB21RJ
6500+680+100+


22966 - FLP_31_V3 


ALTER TABLE atp_redirect_urls CHANGE atp_redirect_url atp_redirect_url VARCHAR(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL;
ALTER TABLE atp_redirect_urls CHANGE content content TEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL;

              $("#post_err").text("");
              $("#applynow04").prop('disabled', false);
              jsShowHideTick($(this), "Y");




select visitors.id as visitor_id, user_extra_details.addressid, users.record_status, users.title, users.first_name, users.last_name, users.dob, user_extra_details.postcode, users.telephone, users.email, user_extra_details.housenumber, user_extra_details.address, user_extra_details.street, user_extra_details.county, user_extra_details.town, user_extra_details.housename, user_extra_details.address3, user_extra_details.udprn, user_extra_details.pz_mailsort, user_extra_details.country as user_country, user_extra_details.deliverypointsuffix, users.recent_visit, visitors.country as countryCode, users.response_result, uqa.questionnaire_option_id from users inner join user_extra_details on users.id = user_extra_details.user_id inner join visitors on users.visitor_id = visitors.id left join user_questionnaire_answers as uqa on uqa.user_id = users.id and uqa.questionnaire_id = ? where users.id = 1

ALTER TABLE tbl_digital_marketing ADD company VARCHAR(150) NULL AFTER phonenumber;

define('DB_SERVER', 'localhost:8080');




http://
thopecive.org/d.ashx?ckm_campaign_id=4334&
ckm_key=oFlAbP6hjNE&
userid=90&
first_name=nigel&
last_name=newman&
address1=&
house_name=&
county=Somerset&
city=Bath&
town=Bath&
address2=&
address3=&
udprn=&
msc=&
dps=&
postcode=BA17DW&
email_address=newmannigelpeter%40gmail.com&
phone_home=&
mobile=07547287571&
phone=07547287571&
Fname=Nigel&
Lname=Newman&
ip_address=84.51.187.249&
country=UK&
contry=England&
transid=2535397311&
campaign=&
ckm_subid=google-display&
ckm_subid_2=1&
ckm_subid_3=2535397311&
ckm_subid_4=DieselGate_Display_Direct_KE&
ckm_subid_5=atp%23%23DieselGate_Display_Direct_KE%23%232535397311&
split_id=DGC_A1.php&
domain_name=dieselgateclaims.com&
publisher_name=&
publisher_url=&
vendor=google-display&
vendor_source=DieselGate_Display_Direct_KE&
reg_number=cu65uso&
vehicle_name=seat&
purchase_type=yes&
vehicle_litre=yes

            



select split_info.split_path, split_info.split_name from visitors inner join split_info on visitors.split_id = split_info.id where visitors.id = 2637


> comment cake posting in userclass
> created queue job
    - php artisan make:job CakePosting
> update job with cake posting by passing userid
> dispatch job CakePosting with delay of 10 seconds in confirm controller
> change QUEUE_CONNECTION in config/queue.php from 'sync' to 'database'
> run queue worker
   -  php artisan queue:work

http://
thopecive.org/d.ashx?ckm_test=1&ckm_campaign_id=4333&ckm_key=zzfZ1bPN12o&userid=196&first_name=testfname&last_name=testlname&address1=Apartment+604&house_name=&county=Nottinghamshire&city=Nottingham&town=Nottingham&address2=Marco+Island&address3=Huntingdon+Street&udprn=27829506&msc=42297&dps=1E&postcode=NG11AS&email_address=testemail%40922.com&phone_home=01777777779&phone=01777777779&Fname=Testfname&Lname=Testlname&ip_address=UNKNOWN&country=UK&contry=England&transid=0&campaign=&ckm_subid=&ckm_subid_2=&ckm_subid_3=0&ckm_subid_4=&ckm_subid_5=UNKNOWN&split_id=DGC_A1.php&domain_name=dieselgateclaims.com&reg_number=dfgdf4545&vehicle_name=vw&purchase_type=yes&vehicle_litre=yes

          // dd($i);
//////////////////////////////////////////////////////////////////////////////////////////
          // dd($data['questionnaire']);
          // parse_str($data['questionnaire'], $params);
    //       // dd($data['questionnaire']);
    //       $count = 0;
    //       $data = array(
    //     'apple'=>0,
    //     'orange'=>5,
    //     'mango'=>0
    // );

    //       $fruit = array_keys(array_filter($data));

          sort($questionnaires_id_query1_array);
          foreach( $data['questionnaire'] as $key=>$value){
            // if($key == 0 || $key == 1|| $key == 2|| $key == 3|| $key == 4|| $key == 5|| $key == 6|| $key == 7|| $key == 8|| $key == 9|| $key == 10|| $key == 11|| $key == 12|| $key == 13|| $key == 14|| $key == 15|| $key == 16|| $key == 17|| $key == 18|| $key == 19|| $key == 20){
                                foreach( $data['questionnaire'][$key]['options'] as $key2=>$value2){
                                    // $questionnaire_id =  $data['questionnaire'][$key]['options'][$key2]->questionnaire_id;
                                      $i = $data['questionnaire'][$key]['options'][$key2]->target;
                                      // if($i> 80){print_r($i."---".$questionnaire_id."===".$data['questionnaire'][$key]['options'][$key2]);}
                                      // if($questionnaire_id != 80 && $questionnaire_id != 78 && $questionnaire_id != 59)
                                      //   { 
                                            // print_r($i."/");
                                            // $a=0;
                                            
                                            foreach ($questionnaires_id_query1_array as $a) {
                                                if ($a >= $i) break;
                                            }
                                            // dd($a);
                                      //print_r($data['questionnaire'][$key]['options'][$key2]->target);
                                      // for($j=0; !in_array($i, $questionnaires_id_query1_array) && !is_null($i) && $i ==63 ; $j++) { $i++; print_r("ddfksdlng");
                                      // }
                                      // print_r($i."---");
                                  // }
                                      
                                    //$data['questionnaire'][$key]['options'][$key2]->target = $a;
                                    
                                    //dd($data['questionnaire'][$key]['options'][$key2]->target);
                                }
                                // dd($data['questionnaire'][$key]['options']);
                            // }
            }

// dd("knsndfs");
// $i = $data['questionnaire'][$key]['options'][$key2]->target;
                                    // print_r($questionnaires_id_query1_array);
                                    // if(!in_array($i, $questionnaires_id_query1_array)){ echo "afhkd"; }
                                    // dd($i);
                                    // // for($j=1;!in_array($i, $questionnaires_id_query1_array);$j++){
                                    // //     dd($i);
                                    // //     $i++;
                                    // // }
// $r=!in_array($i, $questionnaires_id_query1_array);
                                      // dd($r);
// $r=!in_array($i, $questionnaires_id_query1_array);
///////////////////////////////////////////////////////////////////////////////////////////////


            ################ SECOND CRM QUERY START ################

            $this->Connection->OtherDbConnection();                       

            $query2 = DB::connection('mysql_verticals')
            ->table('user_milestone_stats')
            ->select('user_milestone_stats.source')
            ->leftJoin('user_questionnaire_stats as uqsta', function($joine){
                  $joine->on('uqsta.user_id', '=', 'user_milestone_stats.user_id')
                  ->on('uqsta.source', '=', 'user_milestone_stats.source');
                  })
            ->leftjoin('users as us','us.id','=','user_milestone_stats.user_id')
            // ->leftJoin('user_milestone_stats as mile', function($join){
            //       $join->on('mile.user_id', '=', 'us.id')
            //       ->where('mile.source', '=', 'LIVE');
            //       })
            // ->leftjoin('users_transactions as ut','ut.user_id','=','user_milestone_stats.user_id')
            ->leftjoin('adtopia_visitors as avis','avis.visitor_id','=','us.visitor_id')
            ->leftjoin('user_banks as usb','usb.user_id','=','user_milestone_stats.user_id')
            ->selectRaw('count(DISTINCT user_milestone_stats.user_id) as qualified_user_count')
            ->selectRaw('count(DISTINCT(case when user_milestone_stats.completed = 1 then user_milestone_stats.user_id else null end)) as completed_count')
            ->selectRaw('count(DISTINCT(case when user_milestone_stats.user_signature = 1 then user_milestone_stats.user_id else null end)) as signature_count')
            //->selectRaw('count(case when mile.questions = 1 then 1 else null end) as questions_counta')
            ->selectRaw('count(DISTINCT(case when user_milestone_stats.questions = 1 then user_milestone_stats.user_id else null end)) as questions_counta')
            ->selectRaw('count(uqsta.user_id) as questions_count')
            //->where('users.is_qualified','=','1')
            ->where('us.record_status','=','LIVE')
            ->where('user_milestone_stats.source','=','CRM')
            ->whereBetween('user_milestone_stats.created_at', array($sdate, $edate))
            ->groupBy('user_milestone_stats.source');

            if($vendor != 'Select') {
                $query2->where('avis.atp_vendor','=',$vendor);
            }  

            if($lender != 'Select') {
                $query2->where('usb.bank_id','=',$lender);
            }              

            $db_array1 = $query2->get();



            foreach ($db_array1 as $key => $value) {
                
                foreach ($value as $keys => $values) {

                    switch ($keys) {

                        case 'strategy_name':
                            $strate = str_replace("- (Purple Legal)","",$values);
                            $dataFinalArry[$i][$keys]  = $strate;
                            $dataFetch['strategy_name'] = $values;
                            break;

                        case 'source':
                            $strate = str_replace("CRM_","",$values);
                            if($strate == 'CRM') {
                            $strate = str_replace("CRM","Direct",$strate);
                            } else {
                                $strate = $this->getstrategyname($strate);
                            }
                            
                            $dataFinalArry[$i][$keys]  = $strate;
                            $dataFetch['source'][$i] = $values;
                            break;  

                        case 'qualified_user_count':
                            $dataFinalArry[$i][$keys]  = $values;
                            $totalArry[$keys]  = $totalArry[$keys] + $values; 
                            break;

                        case 'questions_count':
                            $countval = $this->getquestioncount($values);
                            $dataFinalArry[$i][$keys] = $countval;
                            $totalArry[$keys]  = $totalArry[$keys] + $values; 
                            break;                       
                                
                        default:
                            $qualified = isset($dataFinalArry[$i]['qualified_user_count']) ? $dataFinalArry[$i]['qualified_user_count'] : null;
                            
                            $percentage = $this->getpercentage($values,$qualified);
                            $per_array[$i][$keys] = $percentage;
                            $target = $values." (".$percentage."%)";
                            $dataFinalArry[$i][$keys]  = $target;
                            $keysPer = $keys."_per";
                            $totalArry[$keys]  = $totalArry[$keys] + $values;
                            break;
                    }                                      
                    
                }                

                $i++;
            }

            //dd($dataFinalArry);

            ################ SECOND CRM QUERY END ################



            tables

            
            adtopia_visitors
            user_banks


            lead_docs
            followup_visit
            user_milestone_stats
            user_questionnaire_stats
            users




kl 35 k 4193






https://
uk1.ukvehicledata.co.uk/api/datapackage/VehicleData?v=2&api_nullitems=1&auth_apikey=6207f93a-275c-40c4-a89f-c8a1f2818353&user_tag=&key_VRM=NU04XAR





https://uk1.ukvehicledata.co.uk/api/datapackage/VehicleData?v=2&api_nullitems=1&auth_apikey=6207f93a-275c-40c4-a89f-c8a1f2818353&user_tag&key_VRM=NU04XAR






Error: MySQL shutdown unexpectedly. This may be due to a blocked port, missing dependencies, improper privileges, a crash, or a shutdown by another method. Press the Logs button to view error logs and check the Windows Event Viewer for more clues If you need more help, copy and post this entire log window on the forums



http://thopecive.org/d.ashx?ckm_test=1&ckm_campaign_id=4333&ckm_key=zzfZ1bPN12o&userid=24&first_name=testfname&last_name=testlname&address1=Apartment+609&house_name=&county=Nottinghamshire&city=Nottingham&town=Nottingham&address2=Marco+Island&address3=Huntingdon+Street&udprn=27829511&msc=42297&dps=1L&postcode=NG11AS&email_address=testest%40922.com&phone_home=01777777779&phone=01777777779&Fname=Testfname&Lname=Testlname&ip_address=157.46.180.53&country=UK&contry=England&transid=0&campaign=&ckm_subid=&ckm_subid_2=&ckm_subid_3=0&ckm_subid_4=&ckm_subid_5=UNKNOWN&split_id=DGCM_A3.php&domain_name=dieselgate.claims&reg_number=nu04xar&vehicle_name=volkswagen&purchase_type=yes&vehicle_litre=no&co2emission=143&colour=SILVER&fueltype=DIESEL&model=VOLKSWAGEN+BORA+SE+TDI&yearofmanufacture=2004



netstat -an | find str ":8080"




https://uk1.ukvehicledata.co.uk/api/datapackage/VehicleData?v=2&api_nullitems=1&auth_apikey=9a0c3e8c-d2d1-4adf-ae59-d609e4702dc7&user_tag&key_VRM=nu04%20xar












var $modal = $('#loade');
 function carRegNoVal(){
   
   let carRegNo = $.trim($("#carRegNo").val()).replace(/\s+/g, '');
   let visitor_id = $('#visitor_id').val();
   if (carRegNo != '') {
     let strAjaxUrl = lib.jsGetSiteUrl() + 'ajax/ajax-carno-val';
     let strParam = '?carRegNo=' + carRegNo + '&visitor_id=' + visitor_id;
     $.ajax({
       url: strAjaxUrl + strParam,
     }).done(function(result) {
       $("#loader-txtPostCode").hide();
       flPostCodeValidation = false;
       /*if (result == 0) {
         $("#car_reg_err").text("Please Enter Valid Car Registration Number");
         $("#car_reg_err").show();
         $(".carRegNo_wrap .validate_success").hide();
         $(".carRegNo_wrap .validate_error").show();
         $("#carRegNo_wrap").focus();
       } else {
         $(".carRegNo_wrap .validate_success").show();
         $(".carRegNo_wrap .validate_error").hide();

         $("html, body").animate({
           scrollTop: 170
         }, "100");
         $('#loade').modal('hide');
         $("#slide6").hide();
         $("#slide4").show();
       }
       */

       //$('#loade').modal('hide');
       //$('#loade').modal('toggle');
       if (result.validity == 0) {
         $("#car_reg_err").text("Please Enter Valid Car Registration Number");
         $("#car_reg_err").show();
         $(".carRegNo_wrap .validate_success").hide();
         $(".carRegNo_wrap .validate_error").show();
         $("#carRegNo_wrap").focus();
       } else {
         $(".carRegNo_wrap .validate_success").show();
         $(".carRegNo_wrap .validate_error").hide();

         $("html, body").animate({
           scrollTop: 170
         }, "100");
         console.log(result.vehicleData.Make.toLowerCase());
         if (result.vehicleData.Make && result.vehicleData.Make.toLowerCase()=='mercedes-benz') {
           $('.vehicleModel').html(result.vehicleData.MakeModel);
           $(".vehicleYes").show();
           $(".vehicleNo").hide();
           $("#slide6").hide();
           $("#slide31").show();
           //$("#loade").modal('hide');

         } else {
           $(".vehicleYes").hide();
           $(".vehicleNo").show();
           $("#slide6").hide();
           $("#slide31").show();
           //$("#loade").modal('hide');
         }

         //$modal.modal('hide');
         $(".close" ).trigger( "click" );
         //$("#loade").modal('hide');
         //$('#loade').modal('hide');
         //$('#loade').hide();
         //$('#loade').modal({show: false});
         // $('body').removeClass('modal-open');
         // $(".modal-backdrop").hide();
         //$("#loade").hide();
            
-------------
<!-- ========= Car Registration Number Analyzing Pop up Start ========= -->
 <div class="modal load_mode fade" id="loade">
   <div class="modal-dialog" role="document">
     <div class="modal-content custm_cont">
       <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <div class="modal-body custm_bdy">
         <h6>Validating Your Car Registration Number</h6>
         <div class="col-lg-12 text-center p-0">
           <img src="{{ $resourcePath }}img/lod.gif" alt="" class="lo_gif">
         </div>
       </div>
     </div>
   </div>
 </div>
------------
Ajax contoller
$response_data = json_encode($json_data['Response']);
       
           $VehicleData                        =  new VehicleDataLookup;
           $VehicleData->visitor_id            =  $visitor_id;
           $VehicleData->Colour                =  $Colour;
           $VehicleData->YearOfManufacture     =  $YearOfManufacture;
           $VehicleData->DateFirstRegistered   =  $DateFirstRegistered;
           $VehicleData->Make                  =  $Make;
           $VehicleData->MakeModel             =  $MakeModel;
           $VehicleData->Co2Emissions          =  $Co2Emissions;
           $VehicleData->FuelType              =  $FuelType;
           $VehicleData->NominalEngineCapacity =  $NominalEngineCapacity;
           $VehicleData->status                =  $validity;
           $VehicleData->response              =  $response_data;
           $VehicleData->save();
       // Write the contents back to the file
       $strFileContent = '\n----------\n Date: ' . date( 'Y-m-d H:i:s' ) . "\n Content : " . json_encode( $json_data ) . '  \n';

       //Function call for write log
       $logWrite   = LogClass::writeLog( '-getDataListCarRegNumAPI', $strFileContent );

       //return $validity;
       

       //$validity = 0;
       //$validity = 1;
       if($validity==1) {
           $vehicleData = array(
               'Colour'            => $Colour,
               'YearOfManufacture' => $YearOfManufacture,
               'Make'              => $Make,
               'MakeModel'         => $MakeModel,
               'FuelType'          => $FuelType,
               'NominalEngineCapacity'=> $NominalEngineCapacity,
               );
           /*$vehicleData = array(
               'Colour'            => 'SILVER',
               'YearOfManufacture' => 2004,
               'Make'              => 'MERCEDES-BENZ',
               'MakeModel'         => 'VOLKSWAGEN BORA SE TDI',
               'FuelType'          => 'DIESEL',
               'NominalEngineCapacity'=> 1.9,
               );*/
       } else {
           $vehicleData = array();
       }
       
       return response()->json([
           'validity' => $validity,
           'vehicleData' => $vehicleData,
       ]);



BT -> 
DGC_A1 - no email & phone val
DGCM_A2 - no email val, phone validating in db
DGCM_A3 - no email val, phone validating in db

Milberg ->
MDG_A1 - no email & phone val
MDG_A2 - no email & phone val
DGCM_A3 - no email val, phone validating in db

Your tax rebates ->
YTR_A - no email & phone val
YTR_B - no phone val, 
----------------------------------------------------
BT ->
DGC_A1 - no phone val, email validating in db
DGC_A2 - email & phone validating in db
DGC_A2 - email & phone validating in db

Milberg ->
MDG_A1 - no phone val, email validating in db
MDG_A2 - no phone val, email validating in db
DGCM_A3 - email & phone validating in db

Your tax rebates ->
YTR_A - no phone val, email validating in db
YTR_B - no phone val, email validating in db

Gold exchange london ->
TGE_1 - email & phone validating in db
TGE_1.5 - email & phone validating in db
TGE_1_old - email & phone validating in db
TGE_2 - email & phone validating in db
TGE_3- email & phone validating in db
TGE_4 - email & phone validating in db
TGE_5 - email & phone validating in db
TGE_OLD_1_5 - email & phone validating in db
TRE_CFG_A1 - email & phone validating in db

funeral planning - core ->
0602FP00-A - email & phone validating in db
0602FP00-B - email & phone validating in db
0602FP00-C - email & phone validating in db
0602FP00-D - email & phone validating in db
0602FP00-D1 - email & phone validating in db
0602FP00-E - email & phone validating in db
0602FP00-F - email & phone validating in db
0602FP00-G - email & phone validating in db
0602FP00-H - email & phone validating in db
0602FP00-H1 - email & phone validating in db
0602FP00-H2 - email & phone validating in db
0602FP00-I - email & phone validating in db
0602FP00-J - email & phone validating in db
0602FP00-K - email & phone validating in db
0602FP00-L - email & phone validating in db
0602FP00-M - email & phone validating in db
0602FP00-P - email & phone validating in db
0602FP00-Q - email & phone validating in db
0602FP00-Q.1 - email & phone validating in db
0602FP00-Q1 - email & phone validating in db
0602FP00-Q2 - email & phone validating in db
0602FP00-Q2.1 - email & phone validating in db
0602FP00-QT2.5 - email & phone validating in db
0602FP00-R - email & phone validating in db
0602FP00-S - email & phone validating in db
0602FP00-W - email & phone validating in db
0602FP01-F - email & phone validating in db

MOB SPLITS
0602FP01-PM - email & phone validating in db
0602FP01-PM-Copy - email & phone validating in db
0602FP01-QM - email & phone validating in db
0602FP01-QM1 - email & phone validating in db
0602FP01-QM2 - email & phone validating in db
0602FP01-RM - email & phone validating in db

0602FP02-F - email & phone validating in db

--------------------------------------------------------------
0602FP00-P.php - email & phone validating in db
0602FP01-PM.php - email & phone validating in db
0602FP00-QT2.5.php - email & phone validating in db
0602PP00-A.php - email & phone validating in db
0602FP01-RM.php - email & phone validating in db
0602FP00-Q.php - email & phone validating in db




live status = live
lead docs = pdf_file = null
before 7 days = users created at

{First Name}, thanks your inquiry with  Due to COVID-19, we request everyone use our FastTrack processing link below


username=info@carwoodaccountancy.co.uk&account=EX0311130&password=Pa55word.99AB
z&recipient=07917260724&body=test, thanks your inquiry with  Due to COVID-19, we
 request everyone use our FastTrack processing link below&plaintext=1


 0 => {#3032
      +"id": 83
    }
    1 => {#3031
      +"id": 2,4,6,11,14,16,18,25,28,29,30,31,32,33,34,36
    }
    2 => {#3034
      +"id": 4
    }
    3 => {#3028
      +"id": 6
    }
    4 => {#3026
      +"id": 11
    }
    5 => {#3030
      +"id": 14
    }
    6 => {#3029
      +"id": 16
    }
    7 => {#3035
      +"id": 18
    }
    8 => {#3036
      +"id": 25
    }
    9 => {#3037
      +"id": 28
    }
    10 => {#3038
      +"id": 29
    }
    11 => {#3039
      +"id": 30
    }
    12 => {#3040
      +"id": 31
    }
    13 => {#3041
      +"id": 32
    }
    14 => {#3042
      +"id": 33
    }
    15 => {#3043
      +"id": 34
    }
    16 => {#3044
      +"id": 36




select user.id from users as user inner join lead_docs as lds on lds.user_id = user.id and lds.pdf_file is null where user.record_status = 'LIVE' and user.created_at < "2020-10-22"



select user.id from users as user inner join lead_docs as lds on lds.user_id = user.id and lds.pdf_file is null inner join followup_strategy_db.cancel_scheduled_api_record on followup_strategy_db.cancel_scheduled_api_record.user_id != user.id and followup_strategy_db.cancel_scheduled_api_record.domain_id != 57 where user.record_status = 'LIVE' and user.created_at < "2020-10-22"


select user.id from users as user inner join lead_docs as lds on lds.user_id = user.id and lds.pdf_file is null left join followup_strategy_db.cancel_scheduled_api_record on followup_strategy_db.cancel_scheduled_api_record.user_id != user.id and followup_strategy_db.cancel_scheduled_api_record.domain_id != 57 where user.record_status = 'LIVE' and user.created_at < "2020-10-22"


select user.id from users as user inner join lead_docs as lds on lds.user_id = user.id and lds.pdf_file is null left join followup_strategy_db.cancel_scheduled_api_record on followup_strategy_db.cancel_scheduled_api_record.user_id = user.id and followup_strategy_db.cancel_scheduled_api_record.domain_id != 57 where user.record_status = 'LIVE' and user.created_at < "2020-10-22"


->whereNotIn('user_name',function($query) {

   $query->select('user_name')->from('buy_courses');


select count(user.id) from users as user inner join lead_docs as lds on lds.user_id = user.id and lds.pdf_file is null where user.id not in (select followup_strategy_db.cancel_scheduled_api_record.user_id from followup_strategy_db.cancel_scheduled_api_record) and user.record_status = 'LIVE' and user.created_at < "2020-10-22"


select user.id from users as user inner join lead_docs as lds on lds.user_id = user.id and lds.pdf_file is null where user.id not in (select followup_strategy_db.cancel_scheduled_api_record.user_id from f
ollowup_strategy_db.cancel_scheduled_api_record) and user.record_status = 'LIVE' and user.telephone like '07%' and user.created_at < "2020-10-22"




select user.id from users as user left join lead_docs as lds on lds.user_id = user.id and lds.pdf_file is null where user.id not in (select followup_strategy_db.cancel_scheduled_api_record.user_id from followup_strategy_db.cancel_scheduled_api_record where followup_strategy_db.cancel_scheduled_api_record.domain_id = 57 and followup_strategy_db.cancel_scheduled_api_record.source = 'CRM') and user.record_status = 'LIVE' and user.id like '07%' and user.created_at < "2020-10-22"



Result=OK
MessageIDs=055cc277-fb73-4af5-869e-cdde6f729a31

{"batch":{"batchid":"11800438-75be-4c5f-a8d3-356883ed8d88","messageheaders":[{"uri":"http://api.esendex.com/v1.0/messageheaders/821fbb35-b480-4eab-9616-6fe2645a74ff","id":"821fbb35-b480-4eab-9616-6fe2645a74ff"},{"uri":"http://api.esendex.com/v1.0/messageheaders/eba3e25f-c328-4764-89c6-cd5225e2fac5","id":"eba3e25f-c328-4764-89c6-cd5225e2fac5"}]},"errors":null}




"{ "to":"919074341520", "body":"three, you’re 1 step away from completing your Marriage Tax Benefit. Please provide missing details here (link)." }, { "to":"918943986049", "body":"Test, you’re 1 step away from completing your Marriage Tax Benefit. Please provide missing details here (link)." },{ "to":"919074341520", "body":"Our Clients have received over £100,000 this past week alone! Wh
at are you waiting for? Act Now. Let's get you Paid." }, { "to":"918943986049","body":"Our Clients have received over £100,000 this past week alone! What are you waiting for? Act Now. Let's get you Paid." }"




select user.id as user_id, user.telephone as telephone, user.first_name as first_name, user.token as token, user.created_at as created_date from users as user inner join lead_docs as lds on lds.user_id = user.id and lds.pdf_file is null where user.id not in (select followup_strategy_db.cancel_scheduled_api_record.user_id from followup_strategy_db.cancel_scheduled_api_record where followup_strategy_db.cancel_scheduled_api_record.domain_id = 62 and followup_strategy_db.cancel_scheduled_api_record.source = 'CRM') and user.record_status = 'TEST' and user.telephone like "91%" and user.id in (4, 5)



select user.id as user_id, user.telephone as telephone, user.first_name as first_name, user.token as token, user.created_at as created_date from users as user inner join lead_docs as lds on lds.user_id = user.id and lds.pdf_file is null where user.id not in (select followup_strategy_db.cancel_scheduled_api_record.user_id from followup_strategy_db.cancel_scheduled_api_record where followup_strategy_db.cancel_scheduled_api_record.domain_id = 57 and followup_strategy_db.cancel_scheduled_api_record.source = 'CRM') and user.record_status = 'LIVE' and user.telephone like "07%" and user.created_at < "2020-10-24"


"2020-10-24"

here



"{ "to":"918943986049", "body":"testsa, you’re 1 step away from completing your Marriage Tax Benefit. Please provide missing details here ( adto.uk/5f83a57104/60)." },
 { "to":"919746308992", "body":"appu, you’re 1 step away from completing your Marriage Tax Benefit. Please provide missing details here ( adto.uk/54f689fc81/60)." },
 { "to":"918943986049", "body":"Our Clients have received over £100,000 this past week alone! What are you waiting for? Act Now. Let's get you Paid." },
 { "to":"919746308992", "body":"Our Clients have received over £100,000 this past week alone! What are you waiting for? Act Now. Let's get you Paid." }"." }"





select user.id as user_id, user.telephone as telephone, user.first_name as first_name, user.token as token, user.created_at as created_date from users as user inner join lead_docs as lds on lds.user_id = user.id and lds.pdf_file is null where user.id not in (select followup_strategy_db.cancel_scheduled_api_record.user_id from followup_strategy_db.cancel_scheduled_api_record where followup_strategy_db.cancel_scheduled_api_record.domain_id = 57 and followup_strategy_db.cancel_scheduled_api_record.source = 'CRM') and user.record_status = 'LIVE' and user.telephone like "07%" and user.is_qualified != 0 and user.created_at < "2020-10-24"


User ID =-=-= 3492=---- is_sign -=-=-1-----1111111------2222222------sms44444444------55555555------status -SENT

<br/>Purple Legal Claims: dfgdfg, congratulations on taking the first step towar
ds claiming back your monthly packaged bank fees!<br/>

status -SENT

<br/>To proceed with your claim against NatWest, please click  secure.plclaims.uk/0141c0c3f3/36. Phone us on 08081961383 if you have any questions
<br/>

[2020-12-30 17:27:17] local.ERROR: SQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry '0' for key 'PRIMARY' (SQL: insert into sms_scheduleds (use
r_id, created_at, updated_at, status, response, atp_url_id) values (3492, 2020-12-30 17:27:12, 2020-12-30 17:27:12, SENT, Result=OK
MessageIDs=bd4e4bae-caad-4192-855d-410ffa015118, 36))


   Illuminate\Database\QueryException  : SQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry '0' for key 'PRIMARY' (SQL: insert into sms_scheduleds (user_id, created_at
, updated_at, status, response, atp_url_id) values (3492, 2020-12-30 17:27:12, 2020-12-30 17:27:12, SENT, Result=OK
MessageIDs=bd4e4bae-caad-4192-855d-410ffa015118, 36))

  at C:\xampp\htdocs\reportlf.com\report.leadfinery.com\prod-web\report.leadfinery.com\vendor\laravel\framework\src\Illuminate\Database\Connection.php:664
    660|         // If an exception occurs when attempting to run a query, we'll format the error
    661|         // message to include the bindings with SQL, which will make this exception a
    662|         // lot more helpful to the developer instead of just the database's errors.
    663|         catch (Exception $e) {
  > 664|             throw new QueryException(
    665|                 $query, $this->prepareBindings($bindings), $e
    666|             );
    667|         }
    668|

  Exception trace:

  1   PDOException::("SQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry '0' for key 'PRIMARY'")
      C:\xampp\htdocs\reportlf.com\report.leadfinery.com\prod-web\report.leadfinery.com\vendor\laravel\framework\src\Illuminate\Database\Connection.php:458

  2   PDOStatement::execute()
      C:\xampp\htdocs\reportlf.com\report.leadfinery.com\prod-web\report.leadfinery.com\vendor\laravel\framework\src\Illuminate\Database\Connection.php:458

  Please use the argument -v to see more details.









User ID =-=-= 3492=---- is_sign -=-=-1-----1111111------2222222------sms44444444------55555555------status -SENT<br/>

Purple Legal Claims: dfgdfg, congratulations on taking the first step towar
ds claiming back your monthly packaged bank fees!<br/>status -SENT<br/>

To proceed with your claim against NatWest, please click  secure.plclaims.uk/0141c0c3f3/36. Phone us on 08081961383 if yo
u have any questions<br/><br/>

Private Message: Important Update about your claim against NatWest| Click Here to Read  secure.plclaims.uk/0141c0c3f3/37<br/>

2648,2659,2660,2664,2764,2823
https://api.esendex.com/v1.1/messagebatches



{"batch":{"batchid":"7d216dbe-562d-4f1a-9b26-8a3a2702d2d9","messageheaders":[{"uri":"http://api.esendex.com/v1.0/messageheaders/9db57e13-4d78-4ed2-b2bd-9ed0ef7f32d0","id":"9db57e13-4d78-4ed2-b2bd-9ed0ef7f32d0"}]},"errors":null}

st
dClass Object
(
    [batch] => stdClass Object
        (
            [batchid] => 7d216dbe-562d-4f1a-9b26-8a3a2702d2d9
            [messageheaders] => Array
                (
                    [0] => stdClass Object
                        (
                            [uri] => http://api.esendex.com/v1.0/messageheaders/9db57e13-4d78-4ed2-b2bd-9ed0ef7f32d0
                            [id] => 9db57e13-4d78-4ed2-b2bd-9ed0ef7f32d0
                        )

                )

        )

    [errors] =>
)
<br/>dfgdfg, we will have to close your file if we don’t hear from you in 48 hours. Phone: 08081961383; Web: secure.plclaims.uk/0141c0c3f3/38<br/>{"batch":{"batchid":"0da84ec7-2a60-422f-b10d-d
daef05d263a","messageheaders":[{"uri":"http://api.esendex.com/v1.0/messageheaders/4675267d-aa0e-4644-a514-3e2185f8cbb6","id":"4675267d-aa0e-4644-a514-3e2185f8cbb6"}]},"errors":null}stdClass Ob
ject
(
    [batch] => stdClass Object
        (
            [batchid] => 0da84ec7-2a60-422f-b10d-ddaef05d263a
            [messageheaders] => Array
                (
                    [0] => stdClass Object
                        (
                            [uri] => http://api.esendex.com/v1.0/messageheaders/4675267d-aa0e-4644-a514-3e2185f8cbb6
                            [id] => 4675267d-aa0e-4644-a514-3e2185f8cbb6
                        )

                )

        )

    [errors] =>
)
SMS




https://api.esendex.com/v1.0/messagebatches/b8649058-113a-447d-a5b2-d0ec61f106e3

/////////////////////////////////////////////////////////////////////////////////////////////

https://api.esendex.com/v1.0/messagebatches/3a2a8bf9-d59c-4b13-877a-d5a05706d947
<acknowledged> 0
<authorisationfailed> 0
<connecting> 0
<delivered>4295
<failed>324
<partiallydelivered>0
<rejected>0
<scheduled>0
<sent>502
<submitted>0
<validityperiodexpired>0
<cancelled>0

https://api.esendex.com/v1.0/messagebatches/c75717b5-9d1e-43c4-8ca8-c2503e23b203
<acknowledged>0
<authorisationfailed>0
<connecting>0
<delivered>4583
<failed>291
<partiallydelivered>0
<rejected>0
<scheduled>0
<sent>319
<submitted>0
<validityperiodexpired>0
<cancelled>0


https://api.esendex.com/v1.0/messagebatches/9e2774d4-1c66-40f3-b500-61c7a69bb350
<acknowledged>0
<authorisationfailed>0
<connecting>0
<delivered>4474
<failed>278
<partiallydelivered>0
<rejected>0
<scheduled>0
<sent>364
<submitted>0
<validityperiodexpired>0
<cancelled>0


https://api.esendex.com/v1.0/messagebatches/4f5f234a-d37e-43e4-b28d-3f25914ce722
<acknowledged>0
<authorisationfailed>0
<connecting>0
<delivered>2403
<failed>131
<partiallydelivered>0
<rejected>0
<scheduled>0
<sent>160
<submitted>0
<validityperiodexpired>0
<cancelled>0


select * from cache where key = laravel_cache5c785c036466adea360111aa28563bfd556b5fba limit 1

////////////////////////////////////////////////////////////////////////////////////////////////




select DISTINCT(case when mile.user_signature = 1 then mile.user_id else null end) from followup_visit left join user_milestone_stats as mile on mile.user_id = followup_visit.user_id and mile.source = followup_visit.source left join user_questionnaire_stats as uqsta on uqsta.user_id = followup_visit.user_id and uqsta.source = followup_visit.source left join followup_list as flst on flst.user_id = followup_visit.user_id left join followup_strategy_db.followup_list on followup_strategy_db.followup_list.user_id = followup_visit.user_id and followup_strategy_db.followup_list.domain_id = 57 left join sms_email_strategy_config as sesc on sesc.id = followup_strategy_db.followup_list.strategy_type left join users as ut on ut.id = followup_visit.user_id left join adtopia_visitors as avis on avis.visitor_id = followup_visit.visitor_id left join lead_docs as ld on ld.user_id = followup_visit.user_id where followup_visit.source like '%FLP_91%' and ut.is_qualified in (1, 2) and ut.record_status = 'LIVE' and followup_visit.created_at between '2020-10-31 22:59:59' and '2020-11-01 23:00:00'



19621,1651,25843,28676,20485,15611,18135,54187,34715,3591,50494,48116,57543,39546,33878,44403,50229,47789,31901,66765,55277,18726,68035,8275,28592,61280,66513,59055,41280,63621,47382,56843,63609,41659,45126,42970,41995,28448,16167,33106,66960,66467,34012,34221,25537,48813,12740,46097,31231,61854,61231,4596,38188,17647,61199,40311,37797,59592,42409,44987,19297,40070,51265,56556,480,4057423859,42782,33758,65606,53665,47079,13743,12935,32021,67621,51614,63397,37429,22526,21535,33081,56250,54907,68733,38419,46442,16627,64587,50926,34917,28745,18845,56780,45052,53756,18256,65281


20485,46376,55355,67780,50153,46395,68035,63621,42970,68423,28448,66960,34012,15458,37566,23513,32633,38188,17647,37742,49044,30689,42409,58962,58469,64540,23859,65606,53665,47079,6009,52518,45581,58798,68126,39612,24045,68314,56250,68733,38419,34532,41286,52754,49827,64587,20120,60739,53194,61020,56780,68057,10608




[2020-11-02 10:38:19] live.ERROR: Trying to get property 'visitor_id' of non-object {exception":"[object] (ErrorException(code: 0): Trying to get property 'visitor_id' of non-object at /var/www/html/prod-web/financial.senior-benefits.co.uk/app/Helpers/CakeClass.php:34) [stacktrace] #0 /var/www/html/prod-web/financial.senior-benefits.co.uk/app/Helpers/CakeClass.php(34): Illuminate\\Foundation\\Bootstrap\\HandleExceptions->handleError(8, 'Trying to get p...', '/var/www/html/p...', 34, Array) #1 /var/www/html/prod-web/financial.senior-benefits.co.uk/app/Helpers/UserClass.php(603): App\\Helpers\\CakeClass::cakePost(23785, 1) #2 /var/www/html/prod-web/financial.senior-benefits.co.uk/app/Http/Controllers/Splits/Mobile/Split_0602SB01_PM_Controller.php(63): App\\Helpers\\UserClass::storeUser(Object(App\\Http\\Requests\\Split_0602SB01), 'LIVE') #3 [internal function]: App\\Http\\Controllers\\Splits\\Mobile\\Split_0602SB01_PM_Controller->store(Object(App\\Http\\Requests\\Split_0602SB01)) #4 /var/www/html/prod-web/financial.senior-benefits.co.uk/vendor/laravel/framework/src/Illuminate/Routing/Controller.php(54): call_user_func_array(Array, Array) #5 /var/www/html/prod-web/financial.senior-benefits.co.uk/vendor/laravel/framework/src/Illuminate/Routing/ControllerDispatcher.php(45): Illuminate\\Routing\\Controller->callAction('store', Array) #6 /var/www/html/prod-web/financial.senior-benefits.co.uk/vendor/laravel/framework/src/Illuminate/Routing/Route.php(219): Illuminate\\Routing\\ControllerDispatcher->dispatch(Object(Illuminate\\Routing\\Route), Object(App\\Http\\Controllers\\Splits\\Mobile\\Split_0602SB01_PM_Controller), 'store') #7 /var/www/html/prod-web/financial.senior-benefits.co.uk/vendo





splitid, leadid, user_id
car num fetch in cake post
add car num in lookup/uservehicle

crm inter - user + car reg num -> cake post with 'crm'
add split id in tables

submit il new db carnum update cheyanam


ALTER TABLE vehicle_data_lookup ADD user_id BIGINT(20) NULL AFTER id;

ALTER TABLE vehicle_data_lookup ADD split_id BIGINT(20) NULL AFTER visitor_id, ADD source BIGINT(20) NULL AFTER split_id, ADD car_reg_no BIGINT(20) NULL AFTER source;



ALTER TABLE user_vehicle_details CHANGE status status ENUM('0','1','2') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '0';

ALTER TABLE vehicle_data_lookup CHANGE status status ENUM('0','1','2') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '0';


ALTER TABLE user_vehicle_details CHANGE status status ENUM('0','1','2') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '0';

ALTER TABLE vehicle_data_lookup CHANGE status status ENUM('0','1','2') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '0';



a:17:{s:12:"reference_id";s:2:"48";s:9:"firstname";s:10:"ytrtyrtyyt";s:8:"lastname";s:7:"erywert";s:13:"email_address";s:18:"test987654@922.com";s:12:"phone_number";s:11:"01777777779";s:12:"created_date";s:10:"2021-03-03";s:9:"user_from";s:7:"LeadGen";s:3:"dob";s:10:"1984-11-14";s:5:"ccode";s:2:"IN";s:7:"address";s:65:"Apartment 604, Marco Island, Nottingham, Nottinghamshire, England";s:20:"address_house_number";s:13:"Apartment 604";s:14:"address_street";s:12:"Marco Island";s:12:"address_city";s:10:"Nottingham";s:16:"address_postcode";s:6:"NG11AS";s:13:"address_state";s:15:"Nottinghamshire";s:15:"address_country";s:2:"UK";s:6:"claims";a:1:{i:0;a:7:{s:4:"make";s:8:"MERCEDES";s:5:"model";s:7:"E-Class";s:10:"manufactur";s:1:"0";s:3:"vin";s:17:"WDD2130042A010197";s:19:"registration_number";s:7:"KP16VFD";s:5:"owner";s:7:"current";s:10:"claim_from";s:7:"LeadGen";}}}

if($("#purchase_finance_lease").prop("checked") == false) {
            $("#purchase_err").html("Please Tick Checkbox").show();
            valid = false;
          } else {
            $("#purchase_err").hide();
          }
          if($("#joinanother").prop("checked") == false) {
            $("#join_err").html("Please Tick Checkbox").show();
            valid = false;
          } else {
            $("#join_err").hide();
          }
          if(valid){
            $('#cust_info').submit();
          }

http://127.0.0.1:8018/followup?tracker=ADTOPIA&pixel=2543189719&atp_source=Test_mbemissionsclaim_HFDC_V1_Native&atp_vendor=taboola&adtopia_cid=2240&atp_sub1=ggfgh&atp_sub2=7204f936ce&atp_sub3=sdfsd&atp_sub4=dfgdf&url_id=45&lp_id=1002
157,158,159,160,161,162
159,161
142,157,158,159,160,161,162

https://dev.mbemissionsclaim.co.uk/followup?tracker=ADTOPIA&pixel=2543189719&atp_source=Test_mbemissionsclaim_HFDC_V1_Native&atp_vendor=taboola&adtopia_cid=2240&atp_sub1=&atp_sub2=329050a9d0


https://pre.mbemissionsclaim.co.uk/followup?tracker=ADTOPIA&pixel=2543189719&atp_source=Test_mbemissionsclaim_HFDC_V1_Native&atp_vendor=taboola&adtopia_cid=2240&atp_sub1=&atp_sub2=af99be8d69


https://mbemissionsclaim.co.uk/followup?tracker=ADTOPIA&pixel=2543189719&atp_source=Test_mbemissionsclaim_HFDC_V1_Native&atp_vendor=taboola&adtopia_cid=2240&atp_sub1=&atp_sub2=330323ed5a


&atp_sub3=sdfsd&atp_sub4=dfgdf&url_id=45&lp_id=1002


https://dev.mbemissionsclaim.co.uk/followup?tracker=ADTOPIA&pixel=2543189719&atp_source=Test_mbemissionsclaim_HFDC_V1_Native&atp_vendor=taboola&adtopia_cid=2240&atp_sub1=ggfgh&atp_sub2=06a34abfdf&atp_sub3=sdfsd&atp_sub4=dfgdf&url_id=45&lp_id=1002


https://dev.mbemissionsclaim.co.uk/followup?atp_sub2=d7c2a53958


users mtr sunday - 08/03
4982+5139+5041+2832 = 17994


delivered-4119
failed-361
sent-502

delivered-4492
failed-330
sent-317

delivered-4395
failed-303
sent-343

delivered-2507
failed-153
sent-172



delivered-15513
failed-1147
sent-1334




sn66xmz
kp14kyj






<p class="info_note">
Before clicking 'CLAIM NOW', please read and understand what you are signing up to.Here is a simple explanation of our signing documents as a <a href="https://checkmycar.net/assets/pdf/Milberg-Mercedes-Plain-English.pdf" target="_blank">summary in plain English</a> and here are the full <a href="https://checkmycar.net/assets/pdf/Milberg-Mercedes-CFA-and-STB.pdf" target="_blank">signup documents.</a> By clicking ʻCLAIM NOWʼ you confirm that you agree to these terms with Milberg
</p>


Updated with send mail notification on UK Vehicle data lookup limit exceeds in dev and tested


kottayam ephatha 
04812562526
9645079538


$users = DB::connection('mysql_verticals')
        ->table("users as user")
        ->join('user_milestone_stats as ums', function($join)
          {
              $join->on('ums.user_id', '=', 'user.id')
              ->Where('ums.source', '=', "live");

          })
//        ->leftjoin('followup_list as fl','fl.user_id', '=', 'user.id')
        ->select('ums.*','user.id','user.first_name','user.last_name','user.email','user.telephone','user.token','user.created_at as created_date')
        ->where('user.record_status','TEST')
        ->where('user.is_qualified','!=','0')
        // ->whereIn('user.is_qualified',['1','2'])
        ->where(function($q){$q->whereNull('ums.questions')
          ->orwhereNull('ums.user_insurance_number')
          // ->orwhereNull('ums.identification_type')
          // ->orwhereNull('ums.identification_image')
          ->orwhere(function($r){$r->whereNull('ums.identification_image')
            ->whereNull('ums.user_income_verification');})
          ->orwhereNull('ums.user_signature');})
        ->whereBetween('user.created_at', [$startDate, $endDate])
        ->groupBy('user.id')
        ->get();
dd($users);


INSERT INTO followup_strategy_config (id, strategy_name, percentage, strategy_type, created_at) VALUES ('1', 'SMS Followup Strategy', '100', 'sms', CURRENT_TIMESTAMP);
INSERT INTO followup_strategy_config (id, strategy_name, percentage, strategy_type, created_at) VALUES ('2', 'SMS Strategy', '100', 'sms', CURRENT_TIMESTAMP);
INSERT INTO followup_strategy_config (id, strategy_name, percentage, strategy_type, created_at) VALUES ('4', 'SMS Strategy one', '100', 'sms', CURRENT_TIMESTAMP);


http://
127.0.0.1:8008/v3/followupsummarylegaldetails?flag=followup&sdate=2020-10-01&edate=2021-02-23&vendor=Select&date_type=1&vendor=Select&source=FLP_97&strategy_name=sample


select sesc.strategy_name, followup_visit.source, count(DISTINCT followup_visit.user_id) as qualified_user_count, count(DISTINCT(case when uvd.car_reg_no IS NOT NULL then uvd.user_id else null end)) as car_reg_no_count from followup_visit left join user_milestone_stats as mile on mile.user_id = followup_visit.user_id and mile.source = followup_visit.source left join user_questionnaire_stats as uqsta on uqsta.user_id = followup_visit.user_id and uqsta.source = followup_visit.source left join followup_list as flst on flst.user_id = followup_visit.user_id left join followup_strategy_db.followup_list on followup_strategy_db.followup_list.user_id = followup_visit.user_id and followup_strategy_db.followup_list.domain_id = 71 left join followup_strategy_config as sesc on sesc.id = followup_strategy_db.followup_list.strategy_type left join users as ut on ut.id = followup_visit.user_id left join adtopia_visitors as avis on avis.visitor_id = followup_visit.visitor_id left join lead_docs as ld on ld.user_id = followup_visit.user_id left join user_vehicle_details as uvd on uvd.user_id = followup_visit.user_id where followup_visit.source like ? and followup_visit.created_at between ? and ? group by followup_visit.source

{"StatusCode":400,"Message":"ae2@922.com already used."}







select sesc.strategy_name, followup_visit.source, count(DISTINCT followup_visit.user_id) as qualified_user_count, count(DISTINCT(case when uvd.car_reg_no IS NOT NULL then uvd.user_id else null end)) as car_reg_no_count from followup_visit left join user_milestone_stats as mile on mile.user_id = followup_visit.user_id and mile.source = followup_visit.source left join user_questionnaire_stats as uqsta on uqsta.user_id = followup_visit.user_id and uqsta.source = followup_visit.source left join followup_list as flst on flst.user_id = followup_visit.user_id left join followup_strategy_db.followup_list on followup_strategy_db.followup_list.user_id = followup_visit.user_id and followup_strategy_db.followup_list.domain_id = ? left join followup_strategy_config as sesc on sesc.id = followup_strategy_db.followup_list.strategy_type left join users as ut on ut.id = followup_visit.user_id left join adtopia_visitors as avis on avis.visitor_id = followup_visit.visitor_id left join lead_docs as ld on ld.user_id = followup_visit.user_id left join user_vehicle_details as uvd on uvd.user_id = followup_visit.user_id where followup_visit.source like ? and followup_visit.created_at between ? and ? group by followup_visit.source



BUYER_API_KEY : lUGxiJUhqu27uwkDkGwVz6j60Eo4Llbr1JOF8rhO

POSTING URL : https://api.mercedesemissionsclaim.co.uk/claim

user id : 197

params:

a:17:{s:12:"reference_id";s:3:"197";s:9:"firstname";s:5:"David";s:8:"lastname";s:6:"Brogan";s:13:"email_address";s:23:"davidtechcast@gmail.com";s:12:"phone_number";s:11:"07913541615";s:12:"created_date";s:10:"2021-03-09";s:9:"user_from";s:7:"LeadGen";s:3:"dob";s:10:"1950-09-28";s:5:"ccode";s:2:"GB";s:7:"address";s:56:"381 Richmond Road, , Sheffield, South Yorkshire, England";s:20:"address_house_number";s:17:"381 Richmond Road";s:14:"address_street";s:0:"";s:12:"address_city";s:9:"Sheffield";s:16:"address_postcode";s:7:"S13 8LT";s:13:"address_state";s:15:"South Yorkshire";s:15:"address_country";s:2:"UK";s:6:"claims";a:1:{i:0;a:7:{s:4:"make";s:8:"Mercedes";s:5:"model";s:7:"E-CLASS";s:10:"manufactur";s:4:"2017";s:3:"vin";s:17:"WDD2132042A304529";s:19:"registration_number";s:7:"J999MEP";s:5:"owner";s:7:"current";s:10:"claim_from";s:7:"LeadGen";}}}

api response:

s:130:"{"error":0,"message":"Success","url":"https://www.mercedesemissionsclaim.co.uk/reset-password?e=bd7209eb5b4bec1d07cb23dfd0681958"}";


user id : 199

params :

a:17:{s:12:"reference_id";s:3:"199";s:9:"firstname";s:10:"David john";s:8:"lastname";s:7:"Lishman";s:13:"email_address";s:20:"davman1949@gmail.com";s:12:"phone_number";s:11:"07895666909";s:12:"created_date";s:10:"2021-03-09";s:9:"user_from";s:7:"LeadGen";s:3:"dob";s:10:"1949-09-21";s:5:"ccode";s:2:"GB";s:7:"address";s:51:"14 Brantfell Road, , Blackburn, Lancashire, England";s:20:"address_house_number";s:17:"14 Brantfell Road";s:14:"address_street";s:0:"";s:12:"address_city";s:9:"Blackburn";s:16:"address_postcode";s:6:"BB18DN";s:13:"address_state";s:10:"Lancashire";s:15:"address_country";s:2:"UK";s:6:"claims";a:1:{i:0;a:7:{s:4:"make";s:8:"Mercedes";s:5:"model";s:7:"C-CLASS";s:10:"manufactur";s:4:"2018";s:3:"vin";s:17:"WDD2053082F744396";s:19:"registration_number";s:7:"KS18FFN";s:5:"owner";s:7:"current";s:10:"claim_from";s:7:"LeadGen";}}}

api response :

s:130:"{"error":0,"message":"Success","url":"https://www.mercedesemissionsclaim.co.uk/reset-password?e=5dbf133bbe84e312fbd59b0f7515b26b"}";





select sp.split_name, sp.id as split_id, count(DISTINCT(visitors.id)) as visitors_count, count(DISTINCT(case when vehicle_extra.car_reg_no IS NULL then users.id else null end)) as not_regno, count(DISTINCT(case when users.record_status IS NOT NULL then users.id else null end)) as user_count from split_info as sp left join visitors on visitors.split_id = sp.id left join users on users.visitor_id = visitors.id left join user_vehicle_details as vehicle_extra on vehicle_extra.user_id = users.id where visitors.created_at between '2021-03-01 00:00:00' and '2021-03-10 23:59:59' group by sp.id





select DISTINCT(case when vehicle_extra.car_reg_no IS NULL then users.id else null end) from split_info as sp left join visitors on visitors.split_id = sp.id left join users on users.visitor_id = visitors.id left join user_vehicle_details as vehicle_extra on vehicle_extra.user_id = users.id where visitors.created_at between '2021-03-01 00:00:00' and '2021-03-10 23:59:59' group by sp.id



43,78,79,84,110,109,44,45,113




4974+5132+5028+2989=18123

delivered-16236
failed-571
sent-1316

https://api.esendex.com/v1.0/messagebatches/8bd72a05-124b-4e0c-bb6b-866d13788371

delivered-4218
failed-255
sent-501

https://api.esendex.com/v1.0/messagebatches/747b85bc-fbbe-466e-8ffe-cac816e57bbe

delivered-4659
failed-163
sent-310

https://api.esendex.com/v1.0/messagebatches/0243dac8-c0df-4744-8dbd-f4749bcafaf2

delivered-4582
failed-107
sent-339

https://api.esendex.com/v1.0/messagebatches/95ff5e71-c68b-40d5-952e-8815af834143

delivered-2777
failed-46
sent-166


    public function convertXmlToArrayzzz($str, $postion, $places)
    {
        $arr_split = str_split($str);
        $arr_pos = $postion - 1;
        if(isset($arr_split[$arr_pos])){
            $shift = $arr_split[$arr_pos];
            unset($arr_split[$arr_pos]);
            $shift_pos = $arr_pos + $places;
            if(isset($arr_split[$shift_pos])){
                array_splice($arr_split, $shift_pos, 0, $shift);
            }
        }
        $return_arr = implode("", $arr_split);
        return $return_arr;

    }


11/3 - 17/3 users
269,270,271,273,274,275,276,285,286,307,313,314

user vehicle table
269 - no cake
273 - D805DDE2
274 - 8977586C
275 - no cake
285 - 975BA236
286 - no cake
307 - D598CDBB

not in user vehicle table
270,271,276,313,314
2309,2384,3059,3960,4056


user id - vis id
270 - 2309
271 - 2384
276 - 3059
313 - 3960
314 - 4056

not in visitor vehicle table
vis id - 2384,3960

1. Acquisition Date
2. Did you purchase, finance or lease the vehicle in England or Wales between 2009 and 2018?
3. Have you joined another Mercedes Emissions Claim?
4. Starting your diesel claims check is easy and 100% online. Select your Mercedes-Benz class
below to begin.



https://127.0.0.1:8007/offer-page?tracker=ADTOPIA&pixel=2518663379&atp_source=Test_thegoldexchange_offer-page_Native&atp_vendor=taboola&adtopia_cid=1330&atp_sub1=1_1&atp_sub2=d6ae958add&atp_sub3=&url_id=875&lp_id=&lp_custom=&ext_var1=&token=ekp6eXBYbU9LNkcrRG9VeTZJK1dzR09MZzZoQkhQVmhMa3U3NzRMb1Q5Yz0=&atp_sub4=





INSERT INTO `questionnaires` (`id`, `bank_id`, `title`, `is_required`, `type`, `form_type`, `default_id`, `parent`, `extra_param`, `status`, `created_at`, `updated_at`) VALUES (NULL, NULL, 'Acquisition Date', 'yes', 'questionnaire1', NULL, NULL, NULL, NULL, '1', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO `questionnaires` (`id`, `bank_id`, `title`, `is_required`, `type`, `form_type`, `default_id`, `parent`, `extra_param`, `status`, `created_at`, `updated_at`) VALUES (NULL, NULL, 'Did you purchase, finance or lease the vehicle in England or Wales', 'yes', 'questionnaire1', NULL, NULL, NULL, NULL, '1', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO `questionnaires` (`id`, `bank_id`, `title`, `is_required`, `type`, `form_type`, `default_id`, `parent`, `extra_param`, `status`, `created_at`, `updated_at`) VALUES (NULL, NULL, 'Have you joined another Mercedes Emissions Claim', 'yes', 'questionnaire1', NULL, NULL, NULL, NULL, '1', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO `questionnaires` (`id`, `bank_id`, `title`, `is_required`, `type`, `form_type`, `default_id`, `parent`, `extra_param`, `status`, `created_at`, `updated_at`) VALUES (NULL, NULL, 'Select your Mercedes-Benz class', 'yes', 'questionnaire1', NULL, NULL, NULL, NULL, '1', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);



{"StatusCode":"Success","StatusMessage":"Success","StatusInformation":{"Lookup":{"StatusCode":"SuccessWithDataIntegrityWarning","StatusMessage":"The data held on this vehicle may not be entirely up to date and correct.","AdviceTextList":["VRM is currently void.","There is no DVLA registration for this vehicle.","VRM is currently void."]}},"DataItems":{"TechnicalDetails":{"Dimensions":{"UnladenWeight":null,"RigidArtic":"RIGID","BodyShape":"NA","PayloadVolume":null,"PayloadWeight":null,"Height":1301,"NumberOfDoors":2,"NumberOfSeats":2,"KerbWeight":1470,"GrossTrainWeight":null,"FuelTankCapacity":60,"LoadLength":null,"DataVersionNumber":null,"WheelBase":2430,"CarLength":4134,"Width":1810,"NumberOfAxles":2,"GrossVehicleWeight":1785,"GrossCombinedWeight":null},"Safety":{"EuroNcap":{"Child":null,"Adult":null,"Pedestrian":null}},"General":{"Engine":{"FuelCatalyst":"C","Stroke":85,"PrimaryFuelFlag":"Y","ValvesPerCylinder":4,"Aspiration":"Turbocharged","FuelSystem":"P DI Turbo Cat Euro 5","NumberOfCylinders":4,"CylinderArrangement":"I","ValveGear":"DOHC","Location":"FRONT","Description":"M 271 E18DE LA","Bore":82,"Make":"MERCEDES CARS","FuelDelivery":"Direct Injection","Code":{"CodeCount":1,"CodeList":[{"EngineCode":"M271.861","StartStop":null,"Make":"MERCEDES-BENZ","Model":"SLK200 AMG SPORT BLUE-CIE","TechPowerBhp":184,"BodyType":"CONVERTIBLE","EngineCapacity":1796,"StartYear":null,"EndYear":null}]}},"PowerDelivery":"NORMAL","TypeApprovalCategory":"M1","ElectricVehicleBattery":{"Capacity":null,"ChargePort":null,"ChargeTime":null,"Type":null},"SeriesDescription":"R172","DriverPosition":"R","DrivingAxle":"RWD","DataVersionNumber":null,"EuroStatus":"5","IsLimitedEdition":false},"Performance":{"Torque":{"FtLb":199,"Nm":270,"Rpm":4600},"NoiseLevel":null,"DataVersionNumber":null,"Power":{"Bhp":184,"Rpm":5250,"Kw":135},"MaxSpeed":{"Kph":236.573568,"Mph":147},"Co2":151,"Particles":null,"Acceleration":{"Mph":7,"Kph":null,"ZeroTo60Mph":7,"ZeroTo100Kph":null}},"Consumption":{"ExtraUrban":{"Lkm":5.3,"Mpg":53.3},"UrbanCold":{"Lkm":8.6,"Mpg":32.8},"Combined":{"Lkm":6.5,"Mpg":43.5}}},"ClassificationDetails":{"Smmt":{"Make":"MERCEDES","Mvris":{"ModelCode":"GOH","MakeCode":"M2"},"Trim":"SLK200 BLUEEFFICIENCY AMG SPOR","Range":"SLK"},"Dvla":{"Model":"SLK200 AMG SPORT BLUE-CIE","Make":"MERCEDES-BENZ"},"Ukvd":{"IsElectricVehicle":false}},"VehicleStatus":{"MotVed":{"VedRate":{"FirstYear":{"SixMonth":null,"TwelveMonth":null},"PremiumVehicle":{"YearTwoToSix":{"TwelveMonth":null,"SixMonth":null}},"Standard":{"SixMonth":null,"TwelveMonth":null}},"VedCo2Emissions":151,"MotDue":null,"VedBand":null,"VedCo2Band":null,"TaxDue":null,"Message":null,"VehicleStatus":null}},"VehicleHistory":{"V5CCertificateCount":0,"PlateChangeCount":1,"NumberOfPreviousKeepers":0,"V5CCertificateList":null,"KeeperChangesCount":0,"VicCount":0,"ColourChangeCount":null,"ColourChangeList":null,"KeeperChangesList":null,"PlateChangeList":[{"CurrentVRM":"CB02MAL","TransferType":"Marker","DateOfReceipt":"2015-08-05T00:00:00","PreviousVRM":"AV62FHG","DateOfTransaction":"2015-08-05T00:00:00"}],"VicList":null},"VehicleRegistration":{"DateOfLastUpdate":null,"Colour":"WHITE","VehicleClass":"Car","CertificateOfDestructionIssued":null,"EngineNumber":"27186130605609","EngineCapacity":"1796","TransmissionCode":"A","Exported":false,"YearOfManufacture":"0","WheelPlan":null,"DateExported":null,"Scrapped":false,"Transmission":"AUTO 7 GEARS","DateFirstRegisteredUk":"2012-11-23T00:00:00","Model":"SLK200 AMG SPORT BLUE-CIE","GearCount":7,"ImportNonEu":false,"PreviousVrmGb":null,"GrossWeight":0,"DoorPlanLiteral":"CONVERTIBLE","MvrisModelCode":"GOH","Vin":"WDD1724482F060185","Vrm":"AV62FHG","DateFirstRegistered":"2012-11-23T00:00:00","DateScrapped":null,"DoorPlan":"04","YearMonthFirstRegistered":"2012-11","VinLast5":"60185","VehicleUsedBeforeFirstRegistration":false,"MaxPermissibleMass":0,"Make":"MERCEDES-BENZ","MakeModel":"MERCEDES-BENZ SLK200 AMG SPORT BLUE-CIE","TransmissionType":"Automatic","SeatingCapacity":null,"FuelType":"PETROL","Co2Emissions":151,"Imported":false,"MvrisMakeCode":"M2","PreviousVrmNi":null,"VinConfirmationFlag":null},"SmmtDetails":{"Range":"SLK","FuelType":"Petrol","EngineCapacity":"1796","MarketSectorCode":"AA","CountryOfOrigin":"GERMANY","ModelCode":"381","ModelVariant":"SLK200 BLUEEFFICIENCY AMG SPORT","DataVersionNumber":null,"NumberOfGears":7,"NominalEngineCapacity":1.8,"MarqueCode":"MM","Transmission":"AUTOMATIC","BodyStyle":"CONVERTIBLE","VisibilityDate":"01\/05\/2011","SysSetupDate":"01\/05\/2011","Marque":"Mercedes-Benz","CabType":"NA","TerminateDate":null,"Series":"R172","NumberOfDoors":2,"DriveType":"4X2"},"UkvdEnhancedData":{"Identification":{"IsElectricVehicle":false}}}}



\\n----------\\n Date: 2021-03-18 09:33:51\n URL: http:\/\/thopecive.org\/d.ashx?ckm_campaign_id=4365&ckm_key=EzyUaMm7TrQ&userid=324&first_name=Sidney&last_name=Crutchley&address1=12+Martingale+Close&house_name=&county=West+Midlands&city=Walsall&town=Walsall&street=&address2=&address3=&udprn=26917478&msc=49214&dps=1E&postcode=WS5+4QB&email_address=Sidney%40crutchleyhistory.co.uk&phone_home=&mobile=07455893774&phone=07455893774&Fname=Sidney&Lname=Crutchley&ip_address=92.40.171.108&country=England&Contry=England&dob=1943-06-10&affiliate_id=&aff_sub=&offer_id=&transid=2544314976&campaign=&ckm_subid=google-display&ckm_subid_2=1&ckm_subid_3=2544314976&ckm_subid_4=Hausfeld_Diesel_Display_Direct_KLY&ckm_subid_5=atp%23%23Hausfeld_Diesel_Display_Direct_KLY%23%232544314976&split_id=HFDC_V3.php&domain_name=mbemissionsclaim.co.uk&publisher_name=&publisher_url=&vender=google-display&vendor=google-display&vendor_source=Hausfeld_Diesel_Display_Direct_KLY&user_agent=Mozilla%2F5.0+%28Linux%3B+Android+5.1.1%3B+D2303+Build%2F18.6.A.0.182%29+AppleWebKit%2F537.36+%28KHTML%2C+like+Gecko%29+Chrome%2F68.0.3440.91+Mobile+Safari%2F537.36&reg_number=BV10EZX&vehicle_name=MERCEDES&co2emission=180&colour=SILVER&fueltype=Diesel&model=C350+BLUE-CY+SPORT+CDI+A&yearofmanufacture=0&purchase_type=Yes&another_claim=No \n Result: a:3:{s:4:\"code\";s:1:\"1\";s:3:\"msg\";s:5:\"error\";s:6:\"errors\";a:1:{s:5:\"error\";s:25:\"No Qualified Buyers Found\";}} \\n Num : 000333-805- \\n Submitted Data: a:53:{s:6:\"userid\";s:3:\"324\";s:5:\"title\";N;s:10:\"first_name\";s:6:\"Sidney\";s:9:\"last_name\";s:9:\"Crutchley\";s:8:\"address1\";s:19:\"12 Martingale Close\";s:10:\"house_name\";s:0:\"\";s:6:\"county\";s:13:\"West Midlands\";s:4:\"city\";s:7:\"Walsall\";s:4:\"town\";s:7:\"Walsall\";s:6:\"street\";s:0:\"\";s:8:\"address2\";s:0:\"\";s:8:\"address3\";s:0:\"\";s:5:\"udprn\";s:8:\"26917478\";s:3:\"msc\";s:5:\"49214\";s:3:\"dps\";s:2:\"1E\";s:8:\"postcode\";s:7:\"WS5 4QB\";s:13:\"email_address\";s:29:\"Sidney@crutchleyhistory.co.uk\";s:10:\"phone_home\";s:0:\"\";s:6:\"mobile\";s:11:\"07455893774\";s:5:\"phone\";s:11:\"07455893774\";s:5:\"Fname\";s:6:\"Sidney\";s:5:\"Lname\";s:9:\"Crutchley\";s:10:\"ip_address\";s:13:\"92.40.171.108\";s:7:\"country\";s:7:\"England\";s:6:\"Contry\";s:7:\"England\";s:3:\"dob\";s:10:\"1943-06-10\";s:12:\"affiliate_id\";s:0:\"\";s:7:\"aff_sub\";s:0:\"\";s:8:\"offer_id\";s:0:\"\";s:7:\"transid\";s:10:\"2544314976\";s:8:\"campaign\";s:0:\"\";s:9:\"ckm_subid\";s:14:\"google-display\";s:11:\"ckm_subid_2\";i:1;s:11:\"ckm_subid_3\";s:10:\"2544314976\";s:11:\"ckm_subid_4\";s:34:\"Hausfeld_Diesel_Display_Direct_KLY\";s:11:\"ckm_subid_5\";s:51:\"atp##Hausfeld_Diesel_Display_Direct_KLY##2544314976\";s:8:\"split_id\";s:11:\"HFDC_V3.php\";s:11:\"domain_name\";s:22:\"mbemissionsclaim.co.uk\";s:14:\"publisher_name\";s:0:\"\";s:13:\"publisher_url\";s:0:\"\";s:6:\"vender\";s:14:\"google-display\";s:6:\"vendor\";s:14:\"google-display\";s:13:\"vendor_source\";s:34:\"Hausfeld_Diesel_Display_Direct_KLY\";s:10:\"user_agent\";s:140:\"Mozilla\/5.0 (Linux; Android 5.1.1; D2303 Build\/18.6.A.0.182) AppleWebKit\/537.36 (KHTML, like Gecko) Chrome\/68.0.3440.91 Mobile Safari\/537.36\";s:10:\"reg_number\";s:7:\"BV10EZX\";s:12:\"vehicle_name\";s:8:\"MERCEDES\";s:11:\"co2emission\";i:180;s:6:\"colour\";s:6:\"SILVER\";s:8:\"fueltype\";s:6:\"Diesel\";s:5:\"model\";s:24:\"C350 BLUE-CY SPORT CDI A\";s:17:\"yearofmanufacture\";s:1:\"0\";s:13:\"purchase_type\";s:3:\"Yes\";s:13:\"another_claim\";s:2:\"No\";}\\n" [] []








