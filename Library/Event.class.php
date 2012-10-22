<?php

/**
 * 基于事件原理的PHP框架
 * @author wenbin.wu@foxmail.com
 * @copyright 2012
 */

class Event {

    /**
     * 事件字符串;{路径},{分组}可不填;默认值都是'.'
     * 结构:{路径}|{分组}@{模块}:{操作}
     */


    /**
     * # 事件列表
     * ['路径']['node']['分组']['node']['模块:操作']['node'][] = '事件字符串'
     * ['路径']['path'] = '对应物理路径'
     * @var array
     */
    public static $list = array();


    /**
     * # 事件处理
     * @param $e string 事件字符串
     * @return void
     */
    public static function dispose($e = 'Main:index') {
        // 格式校验
        if(!preg_match('/^((\w+|\.)\|)?((\.|(\w+\/)*(\w+))@)?(\w+):(\w+)$/', $e, $match)) return;
        // 对象数组
        static $o = array();
        // 路径
        $path = ($match[2] === '') ? '.' : $match[2];
        // 分组
        $group = ($match[4] === '') ? '.' : $match[4];
        // 模块
        $model = $match[7];
        // 操作
        $action = $match[8];
        // 类名
        $class = ($group == '.') ? $model : str_replace('/', '_', $group).'_'.$model;
        // 方法名
        $method = $action;

        // 调用事件函数
        if(!isset($o[$class])) {
            // 根路径地址
            $root_path = isset(self::$list[$path]['path']) ? self::$list[$path]['path'] : './';
            // 模块文件
            $model_file = $root_path.'/'.$group.'/'.$model.'.class.php';
            // 加载模块类
            is_file($model_file) && @include_once($model_file);
            if(!class_exists($class) || !method_exists($class, $method)) return;
            $o[$class] = new $class();
        }
        $o[$class]->$method();
        // 处理回调函数
        if(isset(self::$list[$path]['node'][$group]['node'][$model.':'.$action]['node'])) {
            $node = &self::$list[$path]['node'][$group]['node'][$model.':'.$action]['node']; // 节点
            if(is_array($node)) foreach($node as &$v) self::dispose($v);
        }
    }
}
