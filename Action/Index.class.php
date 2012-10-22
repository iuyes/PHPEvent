<?php

/**
 * 前台模块
 * @author wenbin.wu@foxmail.com
 * @copyright 2012
 */

class Action_Index {
	// 默认操作
	public function index() {
		echo "前台模块: .|Action@Index:index\n";
		// 挂载'后台模块'
		Event::$list['.']['node']['.']['node']['Main:index']['node'][] = '.|Action@Admin:index';
		// 挂载'插件模块'
		Event::$list['.']['node']['Action']['node']['Index:index']['node'][] = '.|Plugin@Index:index';
	}
}