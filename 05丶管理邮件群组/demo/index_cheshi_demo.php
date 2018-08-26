<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  index_cheshi_demo.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/08/15 20:27
 *  文件描述 :  Wx_小程序：获取授权令牌示例
 *  历史记录 :  -----------------------
 */
include('../library/ManagemailgroupsDepartment.php');
include('../library/ManagemailgroupsRequest.php');

// ------ 获取success_token ------
$accessTokenArr = ManagemailgroupsRequest::mailRequest(
    'wmf4dd6b39827e8d9f',
    '8u_oWbQRn81-BDy65S4YcRfIyNVR8XD-3psUhN2WHkwUuI9EfrAWExQWrHFUoDui',
    './Mail_SuccessToken/'
);

// ------ 创建邮箱群组 ------
print_r(
    ManagemailgroupsDepartment::searchRequest(
        $accessTokenArr['data']['access_token'],
        'shiguangyu@dlaotianhuang.com',
        'shiguangyu',
        ["shiguangyu@dlaotianhuang.com"],
        ["shirui@dlaotianhuang.com"],
        [1],
        1,
        ["shirui@dlaotianhuang.com"]

    )
);
//shirui@dlaotianhuang.com
// ------ 查找部门信息 ------
//print_r(
//    ManagemailgroupsDepartment::searchRequest(
//        $accessTokenArr['data']['access_token'],
//        '狼穴',
//        1
//    )
//);

// ------ 创建部门信息 ------
//print_r(
//    ManagemailgroupsDepartment::createRequest(
//        $accessTokenArr['data']['access_token'],
//        '狼穴8号',
//        '7366057299320244895',
//        3
//    )
//);

// ------ 更新部门信息 ------
//print_r(
//    ManagemailgroupsDepartment::updateRequest(
//        $accessTokenArr['data']['access_token'],
//        "7366057299320248211",
//        '狼穴4号',
//        '7366057299320244895',
//        3
//    )
//);

// ------ 删除部门信息 ------
//print_r(
//    ManagemailgroupsDepartment::deleteRequest(
//        $accessTokenArr['data']['access_token'],
//        '7366057299320248215'
//    )
//);