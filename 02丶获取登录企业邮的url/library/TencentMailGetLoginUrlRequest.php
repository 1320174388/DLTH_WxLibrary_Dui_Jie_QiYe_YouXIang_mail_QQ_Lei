<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  TencentMailGetLoginUrlRequest.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/08/21 11:09
 *  文件描述 :  腾讯企业邮箱：获取登录企业邮的url
 *  历史记录 :  -----------------------
 */
class TencentMailGetLoginUrlRequest
{
    /**
     * 名 称 : $LoginUrlConfig
     * 功 能 : 请求接口凭证配置信息
     * 创 建 : 2018/08/21 11:10
     */
    private static $LoginUrlConfig = array(

        'LoginUrl' => // 请求登录URL地址
        'https://api.exmail.qq.com/cgi-bin/service/get_login_url'

    );

    /**
     * 名 称 : __construct()
     * 功 能 : 定义配置信息数据
     * 创 建 : 2018/08/21 11:10
     */
    private function __construct()
    {
        // TODO: 禁止外部实例化
    }

    /**
     * 名 称 : __clone()
     * 功 能 : 禁止外部克隆该实例
     * 创 建 : 2018/08/21 11:10
     */
    private function __clone()
    {
        // TODO: 禁止外部克隆该实例
    }

    /**
     * 名  称 : loginRequest()
     * 功  能 : 获取登录企业邮的url
     * 输  入 : (String) $AccessToken => 'Access_Token接口凭证';
     * 输  入 : (String) $userid      => '用户邮箱账号';
     * 输  出 : ['msg'=>'success','data'=>true]
     * 创  建 : 2018/08/21 11:10
     */
    public static function loginRequest($AccessToken,$userid)
    {
        // 请求登录URL地址
        $url = self::$LoginUrlConfig['LoginUrl'];
        // 拼接URL地址
        $url.= '?access_token='.$AccessToken;
        $url.= '&userid='.$userid;
        // 发送UTL请求,获取登录企业邮的url
        $res = self::curlGet($url);
        // 解析返回数据
        $resArr = json_decode($res,true);
        // 判断数据是否正确
        if(!$resArr) return self::returnArray(
            'error', '请求数据失败'
        );
        // 判断数据是否正确
        if(!empty($resArr['errcode'])) return self::returnArray(
            'error', json_encode($resArr)
        );
        return self::returnArray('success', $resArr);
    }

    /**
     * 名  称 : curlGet()
     * 功  能 : Curl请求发送数据
     * 创  建 : 2018/08/21 11:10
     */
    private static function curlGet($push_url)
    {
        //curl扩展
        $ch = curl_init($push_url);
        //设置请求的参数
        curl_setopt($ch, CURLOPT_URL, $push_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        $res = curl_exec($ch);
        curl_close($ch);
        //返回请求的结果
        return $res;
    }

    /**
     * 名  称 : returnArray()
     * 功  能 : 返回数据
     * 创  建 : 2018/08/21 11:10
     */
    private static function returnArray($msg,$data = false)
    {
        return [ 'msg'=>$msg , 'data'=>$data ];
    }
}