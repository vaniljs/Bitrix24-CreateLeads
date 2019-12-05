<?
$param = json_decode($_REQUEST["param"]);

$Url = 'https://НАЗВАНИЕ_САЙТА.bitrix24.ru/rest/ID_ПОЛЬЗОВАТЕЛЯ/ВЕБХУК/crm.lead.add.json';
// описываем параметры  лида
$ParamLid = http_build_query(array(
  'fields' => array(
'TITLE' => $param->TITLE_CALLBACK, // НАЗВАНИЕ
'NAME' => $param->EMAIL_CALLBACK, // ИМЯ
'WEB' => $param->WEB, // ИМЯ
'COMMENTS' => $param->COMMENTS,
'OPENED' => 'Y', // Доступно для всех
'SOURCE_ID' => "WEB", //Источник вебсайт
'SOURCE_DESCRIPTION' => str_replace(" ","",$_POST["UTM_CALLBACK"]), // доп описание источника
'EMAIL' => Array(
"n0" => Array(
"VALUE" => str_replace(" ","",$_POST["EMAIL_CALLBACK"]),
"VALUE_TYPE" => "WORK",
),
), // Рабочая эл. почта
'UTM_SOURCE' =>  str_replace(" ","",$_POST["UTM_CALLBACK"]), // UTM метка
'ASSIGNED_BY_ID' => 1, // Ид ответственного

),
'params' => array("REGISTER_SONET_EVENT" => "Y")
));
// обращаемся к сформированному URL при помощи функции curl_exec для создания лида
$ch = curl_init();
curl_setopt_array($ch, array(
CURLOPT_SSL_VERIFYPEER => 0,
CURLOPT_POST => 1,
CURLOPT_HEADER => 0,
CURLOPT_RETURNTRANSFER => 1,
CURLOPT_URL => $Url,
CURLOPT_POSTFIELDS => $ParamLid,
));
$result2 = curl_exec($ch);
curl_close($ch);

