<?php
require_once('./line_class.php');
require_once('./unirest-php-master/src/Unirest.php');

$channelAccessToken = 'gMqU7SJUCGppP/616TUfT3+B2b16iDmhL8+gT9PDA4CCv6cpzkd/UJZFdgPXNZSTX1O5sBxSMIB30N0lvdIzINe17ouTQGVtSJ8BA3rBQ1DAN4aSfDyuv2CWqJ2BMi+x0CN1SjCzoVc8AzGs/JxeCAdB04t89/1O/w1cDnyilFU='; //sesuaikan 
$channelSecret = '0202b42df3512e6ceacd794ffb54e4a3';//sesuaikan

$client = new LINEBotTiny($channelAccessToken, $channelSecret);

$userId 	= $client->parseEvents()[0]['source']['userId'];
$groupId 	= $client->parseEvents()[0]['source']['groupId'];
$replyToken = $client->parseEvents()[0]['replyToken'];
$timestamp	= $client->parseEvents()[0]['timestamp'];
$type 		= $client->parseEvents()[0]['type'];

$message 	= $client->parseEvents()[0]['message'];
$messageid 	= $client->parseEvents()[0]['message']['id'];

$profil = $client->profil($userId);

$pesan_datang = explode(" ", $message['text']);

$command = $pesan_datang[0];
$options = $pesan_datang[1];
if (count($pesan_datang) > 2) {
    for ($i = 2; $i < count($pesan_datang); $i++) {
        $options .= '+';
        $options .= $pesan_datang[$i];
    }
}

#-------------------------[Function]-------------------------#
function translateEn($keyword) {
    $uri = "https://translate.yandex.net/api/v1.5/tr.json/translate?key=trnsl.1.1.20180926T193705Z.c703e24d71c28672.2147927d0c29e0a6a705eec6388e418ad2a1bcfc&text=" . $keyword . "&lang=id-en";

    $response = Unirest\Request::get("$uri");

    $json = json_decode($response->raw_body, true);
    $result = "English  : ";
	$result .= $json['text']['0'];
    return $result;
}

function translateId($keyword) {
    $uri = "https://translate.yandex.net/api/v1.5/tr.json/translate?key=trnsl.1.1.20180926T193705Z.c703e24d71c28672.2147927d0c29e0a6a705eec6388e418ad2a1bcfc&text=" . $keyword . "&lang=en-id";

    $response = Unirest\Request::get("$uri");

    $json = json_decode($response->raw_body, true);
    $result = "Indonesia  : ";
	$result .= $json['text']['0'];
    return $result;
}

function translateAr($keyword) {
    $uri = "https://translate.yandex.net/api/v1.5/tr.json/translate?key=trnsl.1.1.20180926T193705Z.c703e24d71c28672.2147927d0c29e0a6a705eec6388e418ad2a1bcfc&text=" . $keyword . "&lang=id-ar";

    $response = Unirest\Request::get("$uri");

    $json = json_decode($response->raw_body, true);
    $result = "Arabic  : ";
	$result .= $json['text']['0'];
    return $result;
}
function translateDe($keyword) {
    $uri = "https://translate.yandex.net/api/v1.5/tr.json/translate?key=trnsl.1.1.20180926T193705Z.c703e24d71c28672.2147927d0c29e0a6a705eec6388e418ad2a1bcfc&text=" . $keyword . "&lang=id-de";

    $response = Unirest\Request::get("$uri");

    $json = json_decode($response->raw_body, true);
    $result = "Deutch  : ";
	$result .= $json['text']['0'];
    return $result;
}
function translateZh($keyword) {
    $uri = "https://translate.yandex.net/api/v1.5/tr.json/translate?key=trnsl.1.1.20180926T193705Z.c703e24d71c28672.2147927d0c29e0a6a705eec6388e418ad2a1bcfc&text=" . $keyword . "&lang=id-zh";
    $response = Unirest\Request::get("$uri");
    $json = json_decode($response->raw_body, true);
    $result = "Chinese  : ";
	$result .= $json['text']['0'];
    return $result;
}
function translateKo($keyword) {
    $uri = "https://translate.yandex.net/api/v1.5/tr.json/translate?key=trnsl.1.1.20180926T193705Z.c703e24d71c28672.2147927d0c29e0a6a705eec6388e418ad2a1bcfc&text=" . $keyword . "&lang=id-ko";
    $response = Unirest\Request::get("$uri");
    $json = json_decode($response->raw_body, true);
    $result = "Korean  : ";
	$result .= $json['text']['0'];
    return $result;
}
function translateIt($keyword) {
    $uri = "https://translate.yandex.net/api/v1.5/tr.json/translate?key=trnsl.1.1.20180926T193705Z.c703e24d71c28672.2147927d0c29e0a6a705eec6388e418ad2a1bcfc&text=" . $keyword . "&lang=id-it";
    $response = Unirest\Request::get("$uri");
    $json = json_decode($response->raw_body, true);
    $result = "Italian  : ";
	$result .= $json['text']['0'];
    return $result;
}
function translateJa($keyword) {
    $uri = "https://translate.yandex.net/api/v1.5/tr.json/translate?key=trnsl.1.1.20180926T193705Z.c703e24d71c28672.2147927d0c29e0a6a705eec6388e418ad2a1bcfc&text=" . $keyword . "&lang=id-ja";
    $response = Unirest\Request::get("$uri");
    $json = json_decode($response->raw_body, true);
    $result = "Japan  : ";
	$result .= $json['text']['0'];
    return $result;
}



#-------------------------[Function]-------------------------#

# require_once('./src/function/search-1.php');
# require_once('./src/function/download.php');
# require_once('./src/function/random.php');
# require_once('./src/function/search-2.php');
# require_once('./src/function/hard.php');

//show menu, saat join dan command /menu
if ($type == 'join' || $command == 'menu') {
    $text = "Assalamualaikum Agan, untuk menerjemahkan, ketik (kode bahasa) (kalimat yg ingin di terjemahkan)...^_^";
    $text .= "\n atau ketik HELP untuk bantuan";
	$balas = array(
        'replyToken' => $replyToken,
        'messages' => array(
            array(
                'type' => 'text',
                'text' => $text
            )
        )
    );
}else if ($command == 'help'|| $command == 'Help'|| $command == 'HELP') {
    $text .= "Format : (Kode Bahasa Tujuan) (Kalimat)";
    $text .= "\nContoh  : EN halo, apa kabar";
    $text .= "\n\n Kode Bahasa : ";
    $text .= "\n English : En";
    $text .= "\n Indonesia : Id";
    $text .= "\n Arabic : Ar";
    $text .= "\n Deutch : De";
    $text .= "\n Chinese : Zh";
    $text .= "\n Korea : Ko";
    $text .= "\n Italy : It";
    $text .= "\n Japan : Ja";

	$balas = array(
        'replyToken' => $replyToken,
        'messages' => array(
            array(
                'type' => 'text',
                'text' => $text
            )
        )
    );
}


//pesan bergambar
if($message['type']=='text') {
    if ($command == 'id' || $command == 'Id'|| $command == 'ID') {

        $result = translateId($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => $result
                )
            )
        );
    }else if ($command == 'en'|| $command == 'En'|| $command == 'EN') {

        $result = translateEn($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => $result
                )
            )
        );    
    }else if ($command == 'ar'|| $command == 'Ar'|| $command == 'AR') {

        $result = translateAr($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => $result
                )
            )
        );    
    }else if ($command == 'de'|| $command == 'De'|| $command == 'DE') {

        $result = translateDe($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => $result
                )
            )
        );    
    }else if ($command == 'zh'|| $command == 'Zh'|| $command == 'ZH') {

        $result = translateZh($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => $result
                )
            )
        );    
    }else if ($command == 'ko'|| $command == 'Ko'|| $command == 'KO') {

        $result = translateKo($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => $result
                )
            )
        );    
    }else if ($command == 'it'|| $command == 'It'|| $command == 'IT') {

        $result = translateIt($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => $result
                )
            )
        );    
    }else if ($command == 'ja'|| $command == 'Ja'|| $command == 'JA') {

        $result = translateJa($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => $result
                )
            )
        );    
    }
	
}else if($message['type']=='sticker'){	
	$balas = array(
	'replyToken' => $replyToken,														
	'messages' => array(
		array(
		'type' => 'text',									
		'text' => 'Makasih Kak Stikernya ^_^'										
		)
	)
	);					
}
if (isset($balas)) {
    $result = json_encode($balas);
//$result = ob_get_clean();

    file_put_contents('./balasan.json', $result);


    $client->replyMessage($balas);
}
?>
