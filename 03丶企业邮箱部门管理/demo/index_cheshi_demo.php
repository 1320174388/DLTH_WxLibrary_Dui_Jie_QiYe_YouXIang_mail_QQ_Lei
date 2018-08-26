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
include('../library/TencentMailAdministrativeDepartment.php');

// ------ 获取success_token ------
$accessTokenArr = TencentMailAccessTokenRequest::mailRequest(
    'wmf4dd6b39827e8d9f',
    '8u_oWbQRn81-BDy65S4YcRfIyNVR8XD-3psUhN2WHkwUuI9EfrAWExQWrHFUoDui',
    './Mail_SuccessToken/'
);

// ------ 获取部门列表数据 ------
print_r(
    TencentMailAdministrativeDepartment::listRequest(
        $accessTokenArr['data']['access_token'],'7366057299320244895'
    )
);

// ------ 查找部门信息 ------
//print_r(
//    TencentMailAdministrativeDepartment::searchRequest(
//        $accessTokenArr['data']['access_token'],
//        '狼穴',
//        1
//    )
//);

// ------ 创建部门信息 ------
//print_r(
//    TencentMailAdministrativeDepartment::createRequest(
//        $accessTokenArr['data']['access_token'],
//        '狼穴1号',
//        '7366057299320244895',
//        3
//    )
//);

// ------ 更新部门信息 ------
//print_r(
//    TencentMailAdministrativeDepartment::updateRequest(
//        $accessTokenArr['data']['access_token'],
//        "7366057299320248211",
//        '狼穴4号',
//        '7366057299320244895',
//        3
//    )
//);

// ------ 删除部门信息 ------
//print_r(
//    TencentMailAdministrativeDepartment::deleteRequest(
//        $accessTokenArr['data']['access_token'],
//        '7366057299320248215'
//    )
//);