<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  TencentMailNewEmailReminder.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/08/22 15:58
 *  文件描述 :  腾讯企业邮箱：获取邮件未读数
 *  历史记录 :  -----------------------
 */
class TencentMailNewEmailReminder
{
    /**
     * 名 称 : $NewEmailConfig
     * 功 能 : 获取邮件未读数URL配置信息
     * 创 建 : 2018/08/22 15:59
     */
    private static $NewEmailConfig = array(

        'NewEmailURL' => // 请求授权令牌类地址
        'https://api.exmail.qq.com/cgi-bin/mail/newcount'

    );

    /**
     * 名 称 : __construct()
     * 功 能 : 定义配置信息数据
     * 创 建 : 2018/08/22 15:59
     */
    private function __construct()
    {
        // TODO: 禁止外部实例化
    }

    /**
     * 名 称 : __clone()
     * 功 能 : 禁止外部克隆该实例
     * 创 建 : 2018/08/22 15:59
     */
    private function __clone()
    {
        // TODO: 禁止外部克隆该实例
    }

    /**
     * 名  称 : mailRequest()
     * 功  能 : 获取邮件未读数
     * 输  入 : (String) $accessToken  => '调用接口凭证';
     * 输  入 : (String) $userid       => '成员UserID';
     * 输  入 : (String) $beginDate    => '开始日期。格式为2016-10-01';
     * 输  入 : (String) $endDate      => '结束日期。格式为2016-10-07';
     * 输  出 : ['msg'=>'success','data'=>true]
     * 创  建 : 2018/08/22 15:59
     */
    public static function mailRequest($accessToken,$userid,$beginDate,$endDate)
    {
        // 获取URL地址
        $url = self::$NewEmailConfig['NewEmailURL'];
        // 处理URL地址
        $url.= '?access_token='.$accessToken;
        $url.= '&userid='.$userid;
        // 处理发送数据
        $data = json_encode([
            'type'       => 0,
            'begin_date' => $beginDate,
            'end_date'   => $endDate
        ],320);
        // 获取数据
        $res = self::curl($url,$data,'GET');
        // 解析数据
        $resArr = json_decode($res,true);
        // 判断数据是否正确
        $R = self::validate($resArr,'获取数据失败');
        if($R['msg']=='error') return $R;
        // 返回正确数据
        return self::returnArray('success', $resArr);
    }

    /**
     * 名  称 : validate()
     * 功  能 : 验证数据
     * 创  建 : 2018/08/22 10:48
     */
    private static function validate($resArr,$info)
    {
        // 判断数据是否正确
        if(!$resArr) return self::returnArray(
            'error', $info
        );
        // 判断数据是否正确
        if(!empty($resArr['errcode'])) return self::returnArray(
            'error', json_encode($resArr,320)
        );
    }

    /**
     * 名  称 : curl()
     * 功  能 : Curl请求发送数据
     * 创  建 : 2018/08/15 12:29
     */
    private static function curl($url,$data=[],$method='POST')
    {
        $ch = curl_init();	 //1.初始化
        curl_setopt($ch, CURLOPT_URL, $url); //2.请求地址
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);//3.请求方式
        //4.参数如下
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);//https
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');//模拟浏览器
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER,array('Accept-Encoding: gzip, deflate'));//gzip解压内容
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');

        if($method=="POST"){//5.post方式的时候添加数据
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $tmpInfo = curl_exec($ch);//6.执行

        if (curl_errno($ch)) {//7.如果出错
            return curl_error($ch);
        }
        curl_close($ch);//8.关闭
        return $tmpInfo;
    }

    /**
     * 名  称 : returnArray()
     * 功  能 : 返回数据
     * 创  建 : 2018/08/22 15:59
     */
    private static function returnArray($msg,$data = false)
    {
        return [ 'msg'=>$msg , 'data'=>$data ];
    }
}