<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  index_cheshi_demo.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/08/15 20:27
 *  文件描述 :  Wx_小程序：获取授权令牌示例
 *  历史记录 :  -----------------------
 */
include('../library/TencentMailAccessTokenRequest.php');
include('../library/TencentMailNewEmailReminder.php');

// ------ 获取success_token ------
$accessTokenArr = TencentMailAccessTokenRequest::mailRequest(
    'wmf4dd6b39827e8d9f',
    'Vx5OF-3XymV0G9E1kOBLhtSrO73i0etQeEsiYbG7dvjCginV4nmjyG2eSAAU8Q7b',
    './Mail_SuccessToken/'
);

print_r(TencentMailNewEmailReminder::mailRequest(
    $accessTokenArr['data']['access_token'],
    'xuyafei@dlaotianhuang.com',
    '2018-07-01',
    '2018-08-22'
));

