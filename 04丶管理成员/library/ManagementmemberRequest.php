<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  TencentMailAccessTokenRequest.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/08/21 10:22
 *  文件描述 :  腾讯企业邮箱：请求接口调用凭证数据
 *  历史记录 :  -----------------------
 */
class ManagementmemberRequest
{
    /**
     * 名 称 : $AccessTokenConfig
     * 功 能 : 请求接口凭证配置信息
     * 创 建 : 2018/08/21 10:23
     */
    private static $AccessTokenConfig = array(

        'AccessTokenUrl' => // 请求授权令牌类地址
        'https://api.exmail.qq.com/cgi-bin/gettoken'

    );

    /**
     * 名 称 : __construct()
     * 功 能 : 定义配置信息数据
     * 创 建 : 2018/08/21 10:23
     */
    private function __construct()
    {
        // TODO: 禁止外部实例化
    }

    /**
     * 名 称 : __clone()
     * 功 能 : 禁止外部克隆该实例
     * 创 建 : 2018/08/21 10:23
     */
    private function __clone()
    {
        // TODO: 禁止外部克隆该实例
    }

    /**
     * 名  称 : mailRequest()
     * 功  能 : 请求Access_Token接口凭证
     * 输  入 : (String) $CorpID      => '邮箱CorpID';
     * 输  入 : (String) $CorpSecret  => '邮箱Secret秘钥';
     * 输  入 : (String) $tokenDir    => '文件保存位置';
     * 输  出 : ['msg'=>'success','data'=>true]
     * 创  建 : 2018/08/21 10:23
     */
    public static function mailRequest($CorpID,$CorpSecret,$tokenDir)
    {
        // 验证返回数据
        if(!$CorpID) return self::returnArray(
            'error', '请邮箱CorpID'
        );
        if(!$CorpSecret) return self::returnArray(
            'error', '请邮箱Secret秘钥'
        );
        // 获取文件内access_token令牌信
        $access_token_Str = file_get_contents(
            $tokenDir.'mail_access_token.text'
        );
        // 解析数据
        $access_token_Arr = json_decode($access_token_Str,true);
        // 判断令牌失效期
        if( (time() - $access_token_Arr['time']) < 3600 )
        {
            return self::returnArray('success', $access_token_Arr);
        }
        // 获取请求授权令牌类地址
        $url = self::$AccessTokenConfig['AccessTokenUrl'];
        // 拼接URL地址
        $url.= '?corpid='.$CorpID;
        $url.= '&corpsecret='.$CorpSecret;
        // 发送UTL请求,获取accessToken值
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
        $resArr['time'] = time();
        // 判断是否有令牌保存目录，如果没有执行创建
        if(!is_dir($tokenDir)) mkdir($tokenDir);
        // 将数据写入text文件
        file_put_contents(
            $tokenDir.'mail_access_token.text',
            json_encode($resArr)
        );
        return self::returnArray('success', $resArr);
    }

    /**
     * 名  称 : curlGet()
     * 功  能 : Curl请求发送数据
     * 创  建 : 2018/08/21 10:23
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
     * 创  建 : 2018/08/21 10:23
     */
    private static function returnArray($msg,$data = false)
    {
        return [ 'msg'=>$msg , 'data'=>$data ];
    }
}