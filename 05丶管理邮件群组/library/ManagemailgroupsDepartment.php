<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  ManagemailgroupsDepartment.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/08/21 11:41
 *  文件描述 :  腾讯企业邮箱：管理部门
 *  历史记录 :  -----------------------
 */
class ManagemailgroupsDepartment
{
    /**
     * 名 称 : $AdministrativeConfig
     * 功 能 : 管理部门配置信息
     * 创 建 : 2018/08/21 11:41
     */
    private static $AdministrativeConfig = array(

        'DepartmentCreate' => // 创建邮箱群组
        'https://api.exmail.qq.com/cgi-bin/group/create',

        'DepartmentUpdate' => // 修改邮箱群组
        'https://api.exmail.qq.com/cgi-bin/group/update',

        'DepartmentDelete' => // 删除邮箱群组
        ' https://api.exmail.qq.com/cgi-bin/group/delete',

        'DepartmentList' => // 获取邮箱群组
            'https://api.exmail.qq.com/cgi-bin/group/get',

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
     * 功  能 : 创建邮件群组
     * 输  入 : (String) $AccessToken      => 'Access_Token接口凭证';
     * 输  入 : (String) $Groupid          => '邮件群组名称';
     * 输  入 : (String) $Groupname        => '邮件群组名称';
     * 输  入 : (String) $Userlist         => '成员帐号，userlist，grouplist，department至少一个。成员由userlist，grouplist，department共同组成';
     * 输  入 : (String) $Grouplist        => '成员邮件群组，userlist，grouplist，department至少一个。成员由userlist，grouplist，department共同组成';
     * 输  入 : (String) $Department       => '成员部门，userlist，grouplist，department至少一个。成员由userlist，grouplist，department共同组成';
     * 输  入 : (String) $Allow            => '群发权限。0: 企业成员, 1任何人， 2:组内成员，3:指定成员';
     * 输  入 : (String) $Allserlist       => '群发权限为指定成员时，需要指定成员';
     * 输  出 : ['msg'=>'success','data'=>true]
     * 创  建 : 2018/08/21 10:23
     */
    public static function searchRequest($AccessToken,$Groupid,$Groupname,$Userlist,$Grouplist,$Department,$Allow,$Allserlist)
    {
        // 获取URL地址
        $url = self::$AdministrativeConfig['DepartmentCreate'];
        // 处理URL地址信息
        $url.= '?access_token='.$AccessToken;
        // 处理发送数据
        $data = json_encode([
            'groupid'  => $Groupid,
            'groupname' => $Groupname,
            'userlist' => $Userlist,
            'grouplist' => $Grouplist,
            'department' => $Department,
            'allow_type' => $Allow,
            'allow_userlist' => $Allserlist
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
     * 功  能 : 修改邮箱群组
     * 输  入 : (String) $AccessToken      => 'Access_Token接口凭证';
     * 输  入 : (String) $Groupid          => '邮件群组名称';
     * 输  入 : (String) $Groupname        => '邮件群组名称';
     * 输  入 : (String) $Userlist         => '成员帐号，userlist，grouplist，department至少一个。成员由userlist，grouplist，department共同组成';
     * 输  入 : (String) $Grouplist        => '成员邮件群组，userlist，grouplist，department至少一个。成员由userlist，grouplist，department共同组成';
     * 输  入 : (String) $Department       => '成员部门，userlist，grouplist，department至少一个。成员由userlist，grouplist，department共同组成';
     * 输  入 : (String) $Allow            => '群发权限。0: 企业成员, 1任何人， 2:组内成员，3:指定成员';
     * 输  入 : (String) $Allserlist       => '群发权限为指定成员时，需要指定成员';
     * 输  出 : ['msg'=>'success','data'=>true]
     * 创  建 : 2018/08/21 10:23
     */
    public static function updateRequest($AccessToken,$Groupid,$Groupname,$Userlist,$Grouplist,$Department,$Allow,$Allserlist)
    {
        // 获取URL地址
        $url = self::$AdministrativeConfig['DepartmentUpdate'];
        // 处理URL地址信息
        $url.= '?access_token='.$AccessToken;
        // 处理发送数据
        $data = json_encode([
            'groupid'  => $Groupid,
            'groupname' => $Groupname,
            'userlist' => $Userlist,
            'grouplist' => $Grouplist,
            'department' => $Department,
            'allow_type' => $Allow,
            'allow_userlist' => $Allserlist
        ],320);
        // 正则处理
        $data = self::push_replace($data);
        // 获取数据
        $res = self::curl($url,$data,'POST');
        // 解析数据
        $resArr = json_decode($res,true);
        // 判断数据是否正确
        $R = self::validate($resArr,'更新数据失败');
        if($R['msg']=='error') return $R;
        // 返回正确数据
        return self::returnArray('success', $resArr);
    }

    /**
     * 名  称 : deleteRequest()
     * 功  能 : 删除部门信息
     * 输  入 : (String) $AccessToken => 'Access_Token接口凭证';
     * 输  入 : (String) $Id          => '部门ID';
     * 输  出 : ['msg'=>'success','data'=>true]
     * 创  建 : 2018/08/21 10:23
     */
    public static function deleteRequest($AccessToken,$Groupid)
    {
        // 获取URL地址
        $url = self::$AdministrativeConfig['DepartmentDelete'];
        // 处理URL地址信息
        $url.= '?access_token='.$AccessToken;
        $url.= '&id='.$Groupid;
        // 获取数据
        $res = self::curl($url,[],'GET');
        // 解析数据
        $resArr = json_decode($res,true);
        // 判断数据是否正确
        $R = self::validate($resArr,'删除数据失败');
        if($R['msg']=='error') return $R;
        // 返回正确数据
        return self::returnArray('success', $resArr);
    }

    /**
     * 名  称 : listRequest()
     * 功  能 : 获取邮箱群组
     * 输  入 : (String) $AccessToken => 'Access_Token接口凭证';
     * 输  入 : (String) $ID          => '部门id，1获取所有部门';
     * 输  出 : ['msg'=>'success','data'=>true]
     * 创  建 : 2018/08/21 10:23
     */
    public static function listRequest($AccessToken,$Groupid)
    {
        // 获取URL地址
        $url = self::$AdministrativeConfig['DepartmentList'];
        // 处理URL地址信息
        $url.= '?access_token='.$AccessToken.'&groupid='.$Groupid;
        // 获取数据
        $res = self::curl($url,[],'GET');
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