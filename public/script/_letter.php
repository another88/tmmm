<?php

require dirname(__FILE__) .'/../../settings/config.php';

$letterLimit = 40;

$databaseSettings = $config['db']['params'];
mysql_connect($databaseSettings['host'],
$databaseSettings['username'],
$databaseSettings['password']) OR DIE("No database");
mysql_select_db($databaseSettings['dbname']) or die(mysql_error());
mysql_query("SET NAMES UTF8");

// Получаем список не отправленных рассылок
$sql = 'SELECT *
        FROM letter
        WHERE deleted = 0 
                AND `status` != "send"';        
$res = mysql_query($sql) or die(mysql_error());
$mailingList = array();
while( $row = mysql_fetch_assoc($res) )
    $mailingList[] = $row;

$mailingCount = count($mailingList);

//var_dump($mailingCount);exit;

if( $mailingCount > 0 )
{
    for( $mailingInd=0; $mailingInd<$mailingCount; $mailingInd++)
    {
        $currentMailing = $mailingList[$mailingInd];
        
        // обновляем статус рассылки
        $sql2="UPDATE letter 
                    SET `status` = 'sended'
                    WHERE letterId = ".(int)$currentMailing['letterId']; 
        mysql_query($sql2) or die(mysql_error());   
            
        // Получаем список не отправленных писем рассылки
        $sql = 'SELECT *
                    FROM `guest`
                    WHERE `send` = 0 AND `subs` = 1
                        AND `approved` = 1 AND `deleted` = 0 AND `email` != ""
                    ORDER by `guestId` ASC
                    LIMIT 0,'.$letterLimit;        
        $res = mysql_query($sql) or die(mysql_error());
        $letterList = array();
        while( $row = mysql_fetch_assoc($res) )
            $letterList[] = $row;  

//        var_dump($letterList);exit;
        
        $form = 'manager@ace-hookah.com';
        $dc='UTF-8';
        $sc='windows-1251';
        $type='text/html';
        //Кодируем заголовок
        $enc_subject = mime_header_encode($currentMailing['title'],$dc,$sc);

        //Оформляем заголовки письма
        $headers='';
        $headers.="Mime-Version: 1.0\r\n";
        $headers.="Content-type: ".$type."; charset=".$sc."\r\n";
        $headers.="From: ".$form."\r\n";        
        
        $currentMailing['text'] = 'Доброго времени суток,<NAME>!<br/><br/>'.$currentMailing['text'];
        $currentMailing['text'] .= '<br/><br/>Вы получили это письмо, т.к. являетесь подписчиком '
                . 'Ace Hookah shop & lounge. Если Вы не хотите получать от нас письма со специальными '
                . 'предложениями, конкурсами и розыгрышами, '
                . 'то <a href="http://ace-hookah.com/script/unsucribe.php?type=guest&id=<GUESTHASH>" target="_blank">нажмите сюда.</a><br/><br/><br/>'
                . '-----------------------------------------------------<br/>'
                . 'С уважением команда Ace Hookah shop & lounge<br/>'
                . '+7 978 200 84 46<br/>'
                . '<a href="https://vk.com/acehookah" target="_blank">Мы Вконтакте</a>';

        $sendCount = 0;
        $letterCount = count($letterList);
        for( $letterInd=0; $letterInd<$letterCount; $letterInd++)
        {
            $currentLetter = $letterList[$letterInd];

            if( !empty($currentLetter['email']) )
            {
                $guestIdHush = MD5(MD5($currentLetter['guestId'].$currentLetter['cardNumber']));
                $sendedText = $currentMailing['text'];
                $sendedText = str_replace('<NAME>', $currentLetter['name'], $sendedText);
                $sendedText = str_replace('&lt;NAME&gt;', $currentLetter['name'], $sendedText);
                $sendedText = str_replace('<GUESTHASH>', $guestIdHush, $sendedText);
                $sendedText = str_replace('&lt;GUESTHASH&gt;', $guestIdHush, $sendedText);                
                
                $enc_body = $dc == $sc?$message:iconv($dc,$sc.'//IGNORE',$sendedText);                
                //Отправляем
                $sendResult = mail($currentLetter['email'],$enc_subject,$enc_body,$headers);             
                // Если упешно отправленно
                if ($sendResult) 
                {
                    $sql2="UPDATE guest 
                                SET `send` = 1
                                WHERE guestId = ".(int)$currentLetter['guestId']; 
                    mysql_query($sql2) or die(mysql_error()); 
                    $sendCount++;
                }       
            }
        }
        // Получаем список не отправленных писем рассылки
        $sql = 'SELECT *
                    FROM guest
                    WHERE `send` = 0 AND `subs` = 1
                        AND `approved` = 1 AND `deleted` = 0 AND `email` != ""';        
        $res = mysql_query($sql) or die(mysql_error());
        $letterList = array();
        while( $row = mysql_fetch_assoc($res) )
            $letterList[] = $row;   

        $newSendLettersCount = $sendCount + (int)$currentMailing['letterCount'];
        $sql2="UPDATE letter 
                    SET `letterCount` = ".(int)$newSendLettersCount."
                    WHERE letterId = ".(int)$currentMailing['letterId']; 
        mysql_query($sql2) or die(mysql_error());        
        
        if(count($letterList) == 0)
        {
            $sql2="UPDATE letter 
                        SET `status` = 'send'
                        WHERE letterId = ".(int)$currentMailing['letterId']; 
            mysql_query($sql2) or die(mysql_error());  
            
            $sql2="UPDATE guest 
                        SET `send` = 0"; 
            mysql_query($sql2) or die(mysql_error());  
            
            $repTitle = 'Рассылка '.$currentMailing['letterId'].' завершена';
            $repText = 'Всего отправленно '.$newSendLettersCount.' писем.<br/><br/>'.$sendedText;
            $repTitle = mime_header_encode($repTitle,$dc,$sc);
            $repText = $dc == $sc?$message:iconv($dc,$sc.'//IGNORE',$repText);  
            mail('artem_zolkin@mail.ru',$repTitle,$repText,$headers);  
        }
    }
}
else
{
    exit();
}

function mime_header_encode($str, $data_charset, $send_charset){
    if($data_charset != $send_charset)
      $str=iconv($data_charset,$send_charset.'//IGNORE',$str);
    return ('=?'.$send_charset.'?B?'.base64_encode($str).'?=');
} 