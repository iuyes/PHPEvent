<?php

/**
 * 首页测试
 * @author wenbin.wu@foxmail.com
 * @copyright 2012
 */

define('START_TIME', microtime());
define('EVENT_PATH', dirname(__FILE__));
header('content-type:text/html; charset=utf-8');

include_once('./Library/Event.class.php');
Event::$list['.']['path'] = dirname(__FILE__);
Event::$list['.']['node']['.']['node']['Main:index']['node'][] = '.|Action@Index:index'; // 挂载前台模块
Event::$list['.']['node']['.']['node']['Main:index']['node'][] = '.|Public@Index:index'; // 挂载公共模块

echo '<pre>';
Event::dispose('Main:index');

echo "-- 事件列表 --\n";
print_r(Event::$list);

$t1 = explode(' ', START_TIME);
$t2 = explode(' ', microtime());
echo "-- 执行时间 --\n";
echo round($t2[0]+$t2[1]-$t1[0]-$t1[1], 4)."s\n";

