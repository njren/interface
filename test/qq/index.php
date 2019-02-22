<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/20
 * Time: 10:07
 */
require '../function.php';
?>
<script type="text/javascript">
    var childWindow;
    function toQzoneLogin()
    {
        childWindow = window.open("frame.php","<?php echo $data['qq']['frame']?>","<?php echo $data['qq']['pro']?>");
    }
</script>
<a href="javascript:;" onclick='toQzoneLogin()'>发起登录</a>
