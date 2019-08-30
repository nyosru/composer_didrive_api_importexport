<?php

namespace Nyos\api;

//echo __FILE__.'<br/>';
// строки безопасности
if (!defined('IN_NYOS_PROJECT'))
    die('<center><h1><br><br><br><br>Cтудия Сергея</h1><p>Сработала защита <b>TPL</b> от злостных розовых хакеров.</p>
    <a href="http://www.uralweb.info" target="_blank">Создание, дизайн, вёрстка и программирование сайтов.</a><br />
    <a href="http://www.nyos.ru" target="_blank">Только отдельные услуги: Дизайн, вёрстка и программирование сайтов.</a>');

//echo __FILE__;

class ImportExport {

    public static $folder_temp = '0.temp';

    /**
     * создать дамп данных
     * @return type
     */
    public static function getDump() {

        $file_temp = DR . DS . self::$folder_temp . DS . 'dump.' . \f\translit($_REQUEST['action'], 'uri2') . '.' . \f\translit($_REQUEST['module'], 'uri2') . '.dump.json';
        // echo '<br/>' . $file_temp;

        if (file_exists($file_temp) && filemtime($file_temp) > $_SERVER['REQUEST_TIME'] - 3600) {

            return file_get_contents($file_temp);

            // echo '<Br/>готовый кеш';
        } else {

            $d = \Nyos\mod\items::getItemsSimple($db, $_REQUEST['module'], '');
            // \f\pa($d);

            $d['cash_creat_time'] = $_SERVER['REQUEST_TIME'];

            $e = json_encode($d);

            file_put_contents($file_temp, json_encode($d));

            // die($e);
            return $e;
            // echo '<Br/>записали';
        }
    }

}
