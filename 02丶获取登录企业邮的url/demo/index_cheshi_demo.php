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
include('../library/TencentMailGetLoginUrlRequest.php');

// 获取success_token
$accessTokenArr = TencentMailAccessTokenRequest::mailRequest(
    'wmf4dd6b39827e8d9f',
    'twNPWJyHRaJtbjtE727n4foDtkKEMbjAbTofb7dFep_sz-zMgtoGw664BGAdiAd0',
    './Mail_SuccessToken/'
);

// 获取登录企业邮的url
$urlDataArr = TencentMailGetLoginUrlRequest::loginRequest(
    $accessTokenArr['data']['access_token'],
    'shiguangyu@dlaotianhuang.com'
);

// 打印返回信息
echo file_get_contents($urlDataArr['data']['login_url']);