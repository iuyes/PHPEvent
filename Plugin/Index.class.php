<?php

/**
 * 前台模块
 * @author wenbin.wu@foxmail.com
 * @copyright 2012
 */

class Plugin_Index {
	// 默认操作
	public function index() {
		echo "    -- 挂载回调模块 --\n";
		echo "    插件模块: .|Plugin@Index:index\n";
	}
}