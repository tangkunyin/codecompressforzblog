codecompressforzblog
====================
功能：一款zblogphp博客的插件，安装后就能用，无需繁琐的配置，仅适用于php版本，内含php网页源码压缩内库。 

原理：在首页加载时，开启缓冲，并在首页结束时获取缓冲区内容并压缩后输出。使用：Filter_Plugin_Index_Begin和Filter_Plugin_Index_End挂接函数。 

作者：唐坤银，网站：http://shuoit.net
