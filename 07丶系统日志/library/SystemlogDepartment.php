<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  SystemlogDepartment.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/08/21 11:41
 *  文件描述 :  腾讯企业邮箱：管理部门
 *  历史记录 :  -----------------------
 */
class SystemlogDepartment
{
    /**
     * 名 称 : $AdministrativeConfig
     * 功 能 : 管理部门配置信息
     * 创 建 : 2018/08/21 11:41
     */
    private static $AdministrativeConfig = array(

        'DepartmentCreate' => // 查询操作记录
        'https://api.exmail.qq.com/cgi-bin/log/operation',

        'DepartmentUpdate' => // 查询邮件
        'https://api.exmail.qq.com/cgi-bin/log/mail',

        'DepartmentDelete' => // 查询成员登陆
        ' https://api.exmail.qq.com/cgi-bin/log/login',

        'DepartmentList' => // 查询批量任务
            'https://api.exmail.qq.com/cgi-bin/log/batchjob',

        'DepartmentLists' => // 查询邮件概况
            'https://api.exmail.qq.com/cgi-bin/log/mailstatus',

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
     * 名  称 : searchRequest()
     * 功  能 : 查询记录操作
     * 输  入 : (String) $AccessToken      => 'Access_Token接口凭证';
     * 输  入 : (String) $Type          => '类型';
     * 输  入 : (String) $Begin        => '开始日期。格式为2016-10-01';
     * 输  入 : (String) $End         => '结束日期。格式为2016-10-07';
     * 输  出 : ['msg'=>'success','data'=>true]
     * 创  建 : 2018/08/23 10:23
     */
    public static function searchRequest($AccessToken,$Type,$Begin,$End)
    {
        // 获取URL地址
        $url = self::$AdministrativeConfig['DepartmentCreate'];
        // 处理URL地址信息
        $url.= '?access_token='.$AccessToken;
        // 处理发送数据
        $data = json_encode([
            'type'  => $Type,
            'begin_date' => $Begin,
            'end_date' => $End
        ],320);
        // 获取数据
        $res = self::curl($url,$data,'POST');
        // 解析数据
        $resArr = json_decode($res,true);
        // 判断数据是否正确
        $R = self::validate($resArr,'获取数据失败');
        if($R['msg']=='error') return $R;
        // 正则替换数据
        $resNew = self::replace($res);
        // 返回正确数据
        return self::returnArray('success',$resNew);
    }

    /**
     * 名  称 : updateRequest()
     * 功  能 : 查询邮件
     * 输  入 : (String) $AccessToken      => 'Access_Token接口凭证';
     * 输  入 : (String) $Begin_date          => '开始日期。格式为2016-10-01';
     * 输  入 : (String) $End_date        => '开始日期。格式为2016-10-07';
     * 输  入 : (String) $Mailtype         => '邮件类型。0:收信+发信 1:发信 2:收信';
     * 输  入 : (String) $Userid        => '筛选条件：指定成员帐号';
     * 输  入 : (String) $Subject       => '筛选条件：包含指定主题内容';
     * 输  出 : ['msg'=>'success','data'=>true]
     * 创  建 : 2018/08/21 10:23
     */
    public static function updateRequest($AccessToken,$Begin_date,$End_date,$Mailtype,$Userid,$Subject)
    {
        // 获取URL地址
        $url = self::$AdministrativeConfig['DepartmentUpdate'];
        // 处理URL地址信息
        $url.= '?access_token='.$AccessToken;
        // 处理发送数据
        $data = json_encode([
            'begin_date'  => $Begin_date,
            'end_date' => $End_date,
            'mailtype' => $Mailtype,
            'userid' => $Userid,
            'subject' => $Subject
        ],320);
        // 正则处理
        $data = self::push_replace($data);
        // 获取数据
        $res = self::curl($url,$data,'POST');
        // 解析数据
        $resArr = json_decode($res,true);
        // 判断数据是否正确
        $R = self::validate($resArr,'获取数据失败');
        if($R['msg']=='error') return $R;
        // 返回正确数据
        return self::returnArray('success', $resArr);
    }

    /**
     * 名  称 : deleteRequest()
     * 功  能 : 查询成员登陆
     * 输  入 : (String) $AccessToken => 'Access_Token接口凭证';
     * 输  入 : (String) $Userid          => '成员UserID。企业邮帐号名，邮箱格式-10-01';
     * 输  入 : (String) $Begin_date          => '开始日期。格式为2016-10-01';
     * 输  入 : (String) $End_date          => '结束日期。格式为2016-10-07';
     * 输  出 : ['msg'=>'success','data'=>true]
     * 创  建 : 2018/08/21 10:23
     */
    public static function deleteRequest($AccessToken,$Userid,$Begin_date,$End_date)
    {
        // 获取URL地址
        $url = self::$AdministrativeConfig['DepartmentDelete'];
        // 处理URL地址信息
        $url.= '?access_token='.$AccessToken;
        // 处理发送数据
        $data = json_encode([
            'userid'  => $Userid,
            'begin_date' => $Begin_date,
            'end_date' => $End_date
        ],320);
        // 正则处理
        $data = self::push_replace($data);
        // 获取数据
        $res = self::curl($url,$data,'POST');
        // 解析数据
        $resArr = json_decode($res,true);
        // 判断数据是否正确
        $R = self::validate($resArr,'获取数据失败');
        if($R['msg']=='error') return $R;
        // 返回正确数据
        return self::returnArray('success', $resArr);
    }


    /**
     * 名  称 : listRequest()
     * 功  能 : 查询批量任务
     * 输  入 : (String) $AccessToken => 'Access_Token接口凭证';
     * 输  入 : (String) $Begin_date          => '开始日期。格式为2016-10-01';
     * 输  入 : (String) $End_date          => '结束日期。格式为2016-10-07';
     * 输  出 : ['msg'=>'success','data'=>true]
     * 创  建 : 2018/08/21 10:23
     */
    public static function listRequest($AccessToken,$Begin_date,$End_date)
    {
        // 获取URL地址
        $url = self::$AdministrativeConfig['DepartmentList'];
        // 处理URL地址信息
        $url.= '?access_token='.$AccessToken;
        // 处理发送数据
        $data = json_encode([
            'begin_date' => $Begin_date,
            'end_date' => $End_date
        ],320);
        // 正则处理
        $data = self::push_replace($data);
        // 获取数据
        $res = self::curl($url,$data,'POST');
        // 解析数据
        $resArr = json_decode($res,true);
        // 判断数据是否正确
        $R = self::validate($resArr,'获取数据失败');
        if($R['msg']=='error') return $R;
        // 返回正确数据
        return self::returnArray('success', $resArr);
    }


    /**
     * 名  称 : listsRequest()
     * 功  能 : 查询邮件概况
     * 输  入 : (String) $AccessToken => 'Access_Token接口凭证';
     * 输  入 : (String) $Domain          => '域名';
     * 输  入 : (String) $Begin_date          => '开始日期。格式为2016-10-01';
     * 输  入 : (String) $End_date          => '结束日期。格式为2016-10-07';
     * 输  出 : ['msg'=>'success','data'=>true]
     * 创  建 : 2018/08/21 10:23
     */
    public static function listsRequest($AccessToken,$Domain,$Begin_date,$End_date)
    {
        // 获取URL地址
        $url = self::$AdministrativeConfig['DepartmentLists'];
        // 处理URL地址信息
        $url.= '?access_token='.$AccessToken;
        // 处理发送数据
        $data = json_encode([
            'domain' => $Domain,
            'begin_date' => $Begin_date,
            'end_date' => $End_date
        ],320);
        // 正则处理
        $data = self::push_replace($data);
        // 获取数据
        $res = self::curl($url,$data,'POST');
        // 解析数据
        $resArr = json_decode($res,true);
        // 判断数据是否正确
        $R = self::validate($resArr,'获取数据失败');
        if($R['msg']=='error') return $R;
        // 返回正确数据
        return self::returnArray('success', $resArr);
    }

    /**
     * 名  称 : replace()
     * 功  能 : 正则替换后数据数组
     * 创  建 : 2018/08/22 14:14
     */
    private static function replace($res)
    {
        $a = preg_replace("/\"id\":/","\"id\":\"",$res);
        $b = preg_replace("/,\"name\"/","\",\"name\"",$a);
        $c = preg_replace("/\"parentid\":/","\"parentid\":\"",$b);
        $d = preg_replace("/,\"order\"/","\",\"order\"",$c);
        return json_decode($d,true);
    }

    /**
     * 名  称 : push_replace()
     * 功  能 : 正则替换后JSON
     * 创  建 : 2018/08/22 14:14
     */
    private static function push_replace($data)
    {
        $data = preg_replace("/\"id\":\"/","\"id\":",$data);
        $data = preg_replace("/\",\"name\"/",",\"name\"",$data);
        $data = preg_replace("/\"parentid\":\"/","\"parentid\":",$data);
        $data = preg_replace("/\",\"order\"/",",\"order\"",$data);
        return $data;
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
     * 创  建 : 2018/08/21 10:23
     */
    private static function returnArray($msg,$data = false)
    {
        return [ 'msg'=>$msg , 'data'=>$data ];
    }
}