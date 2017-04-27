<?php
/**
 * 存储 用户验证码
 * 作用: 注册验证，密码更新，绑定邮箱或手机
 *
 * KEY = STRING:USER:VERIFY:CODE::[tel|email] 手机号码或邮箱
 * VALUE = 发送给用户的验证码
 * @author zhangyuchao
 */
define('STRING_USER_VERIFY_CODE_', 'STRING:USER:VERIFY:CODE:');

/**
 * 存储货品信息
 *
 * KEY = HASH:CARGO:INFO:货品ID
 * VALUE = 货品信息
 * @author zhulinjie
 */
define('HASH_CARGO_INFO_', 'HASH:CARGO:INFO:');

/**
 * 存储货品与货品规格对应关系，用于商品详情点击规格获取对应的货品ID
 *
 * KEY = STRING:CARGO:STANDARD:货品规格
 * VALUE = 货品ID
 * @author zhulinjie
 */
define('STRING_CARGO_STANDARD_', 'STRING:CARGO:STANDARD:');
