<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  index_cheshi_demo.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/08/15 20:27
 *  文件描述 :  Wx_小程序：获取授权令牌示例
 *  历史记录 :  -----------------------
 */
include('../library/ManagementmemberRequest.php');
include('../library/ManagementmemberDepartment.php');

// ------ 获取success_token ------
$accessTokenArr = ManagementmemberRequest::mailRequest(
    'wmf4dd6b39827e8d9f',
    '8u_oWbQRn81-BDy65S4YcRfIyNVR8XD-3psUhN2WHkwUuI9EfrAWExQWrHFUoDui',
    './Mail_SuccessToken/'
);

// ------ 创建成员 ------
//print_r(
//    ManagementmemberDepartment::listRequest(
//        $accessTokenArr['data']['access_token'],
//        'suserssisd@dlaotianhuang.com',
//        'suserssisd',
//        ['7366057299320244895','7366057299320248242'],
//        '啊啊啊',
//        '18434646313',
//        '123456',
//        '01',
//        '1',
//        ['shiruissss@dlaotianhuang.com'],
//        'susserissd123456',
//        0
//    )
//);

//// ------ 更新成员 ------
//print_r(
//    ManagementmemberDepartment::UpdateRequest(
//        $accessTokenArr['data']['access_token'],
//        "shirui@dlaotianhuang.com",
//        "啊啊",
//        ['7366057299320244895','7366057299320248242'],
//        "拉拉",
//        "18434646313",
//        "1",
//        1,
//        "123456789aa",
//        1
//    )
//);

// ------ 删除成员 ------
//print_r(
//    ManagementmemberDepartment::delRequest(
//        $accessTokenArr['data']['access_token'],
//        "shirui@dlaotianhuang.com"
//    )
//);

// ------ 获取成员 ------
//print_r(
//    ManagementmemberDepartment::checkRequest(
//        $accessTokenArr['data']['access_token'],
//        "shirui@dlaotianhuang.com"
//    )
//);

// ------ 获取部门成员 ------
//print_r(
//    ManagementmemberDepartment::obtainRequest(
//        $accessTokenArr['data']['access_token'],
//        'shirui@dlaotianhuang.com',
//        ['1']
//    )
//);

// ------ 获取部门成员(详情) ------
//print_r(
//    ManagementmemberDepartment::detailsRequest(
//        $accessTokenArr['data']['access_token'],
//        'shirui@dlaotianhuang.com',
//        ['1']
//    )
//);


// ------ 批量检查帐号 ------
//print_r(
//    ManagementmemberDepartment::FindRequest(
//        $accessTokenArr['data']['access_token'],
//        'shirui@dlaotianhuang.com',
//         ["shirui@dlaotianhuang.com"]
//    )
//);

