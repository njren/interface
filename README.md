# interface－login
常用第三方接口,不同对象相互间以小差异方式封装(接口功能目前只支持快捷登录，其它功能未完待续······)
## 接口功能:
* 微博
    > 参考官方接口文档 https://open.weibo.com/wiki/API

    * 实例化工厂类
	通过 `WebService` 类实例化 ( SaeFactory ) 工厂类。

    		<?php
    	    	$class=new WebService(new SaeFactory(WB_AKEY,WB_SKEY,WB_CALLBACK_URL));
    		?>
	* 发起登录请求

			<?php
				$url=$class->comUrl();
				header('location:'.$url);
    		?>
	* 回调页面授权验证

			<?php
    	    	$class->comOAuth();
    		?>
	* 获得用户UID

			<?php
    	    	$class->getUid();
    		?>
	* 获得用户信息

			<?php
    	    	$class->getInfo();
    		?>

* QQ
    > 参考官方接口文档 http://wiki.connect.qq.com/

	* 实例化工厂类
	通过 `WebService` 类实例化 ( QFactory ) 工厂类。

    		<?php
    	    	$class=new WebService(new QFactory(CONFIG));
    		?>
	* 发起窗口登录请求

			<?php
    	    	$class->windows();
    		?>
	* 回调页面授权验证

			<?php
    	    	$class->comOAuth();
    		?>
	* 获得用户UID

			<?php
    	    	$class->getUid();
    		?>
	* 获得用户信息

			<?php
    	    	$class->getInfo();
    		?>
* 微信
    > 参考官方接口文档 https://open.weixin.qq.com/cgi-bin/showdocument?action=dir_list&t=resource/res_list&verify=1&lang=zh_CN

    * 实例化工厂类
	通过 `WebService` 类实例化 ( WxFactory ) 工厂类。

    		<?php
    	    	$class=new WebService(new WxFactory(CONFIG,API));
    		?>
	* 发起登录请求

			<?php
				$url=$class->comUrl();
				header('location:'.$url);
    		?>
	* 回调页面授权验证

			<?php
    	    	$class->comOAuth();
    		?>
	* 获得用户UID

			<?php
    	    	$class->getUid();
    		?>
	* 获得用户信息

			<?php
    	    	$class->getInfo();
    		?>
	* 验证token是否有效

			<?php
    	    	$class->authToken();
    		?>
	* 刷新token

			<?php
    	    	$class->refreshToken();
    		?>


## 接口反馈
> 10000:表示成功

    ['status'=>10000,'code'=>'']
> 异常提示：(10004)

    ['status'=>10004,'code'=>'repeat_login']

    非法调用：       illegal_url:        errors:Foundation module error
    重复登录：       repeat_login:       Tips:Already logged in, do not re-login
    方法异常：       function_error:     Method execution exception
    没有登录：       login_error：       You are not logged in
    token获取错误：  gain_token：        An error occurred during the acquisition of token
    获取消息失败：   usermsg_error：     Failure to obtain membership information
    刷新token失败：  refresh_error：     invalid refresh_token