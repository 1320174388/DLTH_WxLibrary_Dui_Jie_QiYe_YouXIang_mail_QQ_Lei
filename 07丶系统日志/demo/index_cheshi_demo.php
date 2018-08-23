<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  index_cheshi_demo.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/08/15 20:27
 *  文件描述 :  Wx_小程序：获取授权令牌示例
 *  历史记录 :  -----------------------
 */
include('../library/SystemlogDepartment.php');
include('../library/SystemlogRequest.php');

// ------ 获取success_token ------
$accessTokenArr = SystemlogRequest::mailRequest(
    'wmf4dd6b39827e8d9f',
    '5nckS3-KfGPwG7TgQ_RhburZUtG_CFJfHH2UCdMwrz2DpnwUsDaM_yz7emk-g2gT',
    './Mail_SuccessToken/'
);

// ------ 查询操作记录 ------
print_r(
    SystemlogDepartment::searchRequest(
        $accessTokenArr['data']['access_token'],
        '0',
        '2018-07-01',
        '2018-08-07'
    )
);

// ------ 查找部门信息 ------
//print_r(
//    SystemlogDepartment::updateRequest(
//        $accessTokenArr['data']['access_token'],
//        '2018-07-01',
//        '2018-08-07',
//        1,
//        'shirui@dlaotianhuang.com',
//        'test'
//    )
//);

// ------ 查询成员登陆 ------
//print_r(
//    SystemlogDepartment::deleteRequest(
//        $accessTokenArr['data']['access_token'],
//        'shiguangyu@dlaotianhuang.com',
//        '2018-07-07',
//        '2018-08-07'
//    )
//);

// ------ 查询批量任务 ------
//print_r(
//    SystemlogDepartment::listRequest(
//        $accessTokenArr['data']['access_token'],
//        '2018-07-07',
//        '2018-08-07'
//    )
//);

// ------ 查询邮件概况 ------
//print_r(
//    SystemlogDepartment::listsRequest(
//        $accessTokenArr['data']['access_token'],
//        'http://dlaotianhuang.com',
//        '2018-07-07',
//        '2018-08-07'
//    )
//);