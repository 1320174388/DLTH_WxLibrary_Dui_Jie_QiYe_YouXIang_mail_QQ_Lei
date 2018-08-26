<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  TencentMailAdministrativeDepartment.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/08/21 11:41
 *  文件描述 :  腾讯企业邮箱：管理部门
 *  历史记录 :  -----------------------
 */
class ManagementmemberDepartment
{
    /**
     * 名 称 : $AdministrativeConfig
     * 功 能 : 管理部门配置信息
     * 创 建 : 2018/08/21 11:41
     */
    private static $AdministrativeConfig = array(

        'DepartmentList' => // 创建成员
        'https://api.exmail.qq.com/cgi-bin/user/create',

        'DepartmentUpdate' => // 更新成员
        'https://api.exmail.qq.com/cgi-bin/user/update',

        'DepartmentDel' => // 删除成员
        'https://api.exmail.qq.com/cgi-bin/user/delete',

        'DepartmentCheck' => // 获取成员
        'https://api.exmail.qq.com/cgi-bin/user/get',

        'ObtaintmentList' => // 获取部门成员
        'https://api.exmail.qq.com/cgi-bin/user/simplelist',

        'DetailstmentList' => // 获取部门成员(详情)
            'https://api.exmail.qq.com/cgi-bin/user/list',

        'DetailstmentFind' => // 批量查找
        'https://api.exmail.qq.com/cgi-bin/user/batchcheck',

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
     * 名  称 : listRequest()
     * 功  能 : 创建成员
     * 输  入 : (String) $AccessToken => 'Access_Token接口凭证';
     * 输  入 : (String) $Userid          => '成员UserID。企业邮帐号名，邮箱格式';
     * 输  入 : (String) $Name          => '成员名称。长度为1~64个字节';
     * 输  入 : (String) $Department          => '成员所属部门id列表，不超过20个';
     * 输  入 : (String) $Position          => '职位信息。长度为0~64个字节';
     * 输  入 : (String) $Mobile          => '手机号码';
     * 输  入 : (String) $Tel          => '座机号码';
     * 输  入 : (String) $Extid          => '编号';
     * 输  入 : (String) $Gender          => '性别。1表示男性，2表示女性';
     * 输  入 : (String) $Slaves          => '别名列表 1.Slaves 上限为5个 2.Slaves 为邮箱格式';
     * 输  入 : (String) $Password          => '	密码';
     * 输  入 : (String) $Cpwd_login          => '用户重新登录时是否重设密码, 登陆重设密码后，该标志位还原。0表示否，1表示是，缺省为0';
     * 输  出 : ['msg'=>'success','data'=>true]
     * 创  建 : 2018/08/21 10:23
     */
    public static function listRequest($AccessToken,$Userid,$Name,$Department,$Position,$Mobile,$Tel,$Extid,$Gender,$Slaves,$Password,$Cpwd_login)
    {
        // 获取URL地址
        $url = self::$AdministrativeConfig['DepartmentList'];
        // 处理URL地址信息
        $url.= '?access_token='.$AccessToken;
        // 处理发送数据
        $data = json_encode([
            'userid'  => $Userid,
            'name' => $Name,
            'department' => $Department,
            'position' => $Position,
            'mobile' => $Mobile,
            'tel' => $Tel,
            'extid' => $Extid,
            'gender' => $Gender,
            'slaves' => $Slaves,
            'password' => $Password,
            'cpwd_login' => $Cpwd_login
        ],320);
        self::push_create_replace($data);
        // 获取数据
        $res = self::curl($url,$data,'POST');
        $resArr = json_decode($res,true);
        // 判断数据是否正确
        $R = self::validate($resArr,'获取数据失败');
        if($R['msg']=='error') return $R;
        // 返回正确数据
        return self::returnArray('success',$resArr);
    }



    /**
     * 名  称 : UpdateRequest()
     * 功  能 : 更新成员
     * 输  入 : (String) $AccessToken => 'Access_Token接口凭证';
     * 输  入 : (String) $Userid          => '成员UserID。企业邮帐号名，邮箱格式';
     * 输  入 : (String) $Name          => '成员名称。长度为1~64个字节';
     * 输  入 : (String) $Department          => '成员所属部门id列表，不超过20个';
     * 输  入 : (String) $Position          => '职位信息。长度为0~64个字节';
     * 输  入 : (String) $Mobile          => '手机号码';
     * 输  入 : (String) $Extid          => '编号';
     * 输  入 : (String) $Gender          => '性别。1表示男性，2表示女性';
     * 输  入 : (String) $Password          => '	密码';
     * 输  入 : (String) $Cpwd_login          => '用户重新登录时是否重设密码, 登陆重设密码后，该标志位还原。0表示否，1表示是，缺省为0';
     * 输  出 : ['msg'=>'success','data'=>true]
     * 创  建 : 2018/08/21 10:23
     */
    public static function UpdateRequest($AccessToken,$Userid,$Name,$Department,$Position,$Mobile,$Gender,$Enable,$Password,$Cpwd_login)
    {
        // 获取URL地址
        $url = self::$AdministrativeConfig['DepartmentUpdate'];
        // 处理URL地址信息
        $url.= '?access_token='.$AccessToken;
        // 处理发送数据
        $data = json_encode([
            'userid'  => $Userid,
            'name' => $Name,
            'department' => $Department,
            'position' => $Position,
            'mobile' => $Mobile,
            'gender' => $Gender,
            'enable' => $Enable,
            'password' => $Password,
            'cpwd_login' => $Cpwd_login
        ],320);
        self::push_create_replace($data);
        // 获取数据
        $res = self::curl($url,$data,'POST');
        $resArr = json_decode($res,true);
        // 判断数据是否正确
        $R = self::validate($resArr,'更新数据失败');
        if($R['msg']=='error') return $R;
        // 返回正确数据
        return self::returnArray('success',$resArr);
    }


    /**
     * 名  称 : delRequest()
     * 功  能 : 删除成员
     * 输  入 : (String) $AccessToken => 'Access_Token接口凭证';
     * 输  入 : (String) $Userid          => '成员UserID。企业邮帐号名，邮箱格式';
     * 输  出 : ['msg'=>'success','data'=>true]
     * 创  建 : 2018/08/21 10:23
     */
    public static function delRequest($AccessToken,$Userid)
    {
        // 获取URL地址
        $url = self::$AdministrativeConfig['DepartmentDel'];
        // 处理URL地址信息
        $url.= '?access_token='.$AccessToken;
        // 处理发送数据
        $data = json_encode([
            'userid'  => $Userid
        ],320);
        // 获取数据
        $res = self::curl($url,$data,'GET');
        // 解析数据
        $resArr = json_decode($res,true);
        // 判断数据是否正确
        $R = self::validate($resArr,'删除数据失败');
        if($R['msg']=='error') return $R;
        // 返回正确数据
        return self::returnArray('success',$resArr);
    }


    /**
     * 名  称 : checkRequest()
     * 功  能 : 获取成员
     * 输  入 : (String) $AccessToken => 'Access_Token接口凭证';
     * 输  入 : (String) $Userid          => '成员UserID。企业邮帐号名，邮箱格式';
     * 输  出 : ['msg'=>'success','data'=>true]
     * 创  建 : 2018/08/21 10:23
     */
    public static function checkRequest($AccessToken,$Userid)
    {
        // 获取URL地址
        $url = self::$AdministrativeConfig['DepartmentCheck'];
        // 处理URL地址信息
        $url.= '?access_token='.$AccessToken;
        // 处理发送数据
        $data = json_encode([
            'userid'  => $Userid
        ],320);
        // 获取数据
        $res = self::curl($url,$data,'GET');
        // 解析数据
        $resArr = json_decode($res,true);
        // 判断数据是否正确
        $R = self::validate($resArr,'获取数据失败');
        if($R['msg']=='error') return $R;
        // 返回正确数据
        return self::returnArray('success',$resArr);
    }

    /**
     * 名  称 : obtainRequest()
     * 功  能 : 获取部门成员
     * 输  入 : (String) $AccessToken => 'Access_Token接口凭证';
     * 输  入 : (String) $Userid          => '成员UserID。企业邮帐号名，邮箱格式';
     * 输  入 : (String) $Cpwd_login          => '用户重新登录时是否重设密码, 登陆重设密码后，该标志位还原。0表示否，1表示是，缺省为0';
     * 输  出 : ['msg'=>'success','data'=>true]
     * 创  建 : 2018/08/21 10:23
     */
    public static function obtainRequest($AccessToken,$DepartmentId,$Department)
    {
        // 获取URL地址
        $url = self::$AdministrativeConfig['ObtaintmentList'];
        // 处理URL地址信息
        $url.= '?access_token='.$AccessToken;
        // 处理发送数据
        $data = json_encode([
            'department_id'  => $DepartmentId,
            'fetch_child' => $Department
        ],320);
        // 获取数据
        $res = self::curl($url,$data,'GET');
        // 解析数据
        $resArr = json_decode($res,true);
        // 判断数据是否正确
        $R = self::validate($resArr,'获取数据失败');
        if($R['msg']=='error') return $R;
        // 返回正确数据
        return self::returnArray('success',$resArr);
    }


    /**
     * 名  称 : detailsRequest()
     * 功  能 : 获取部门成员(详情)
     * 输  入 : (String) $AccessToken => 'Access_Token接口凭证';
     * 输  入 : (String) $Userid          => '成员UserID。企业邮帐号名，邮箱格式';
     * 输  入 : (String) $Cpwd_login          => '用户重新登录时是否重设密码, 登陆重设密码后，该标志位还原。0表示否，1表示是，缺省为0';
     * 输  出 : ['msg'=>'success','data'=>true]
     * 创  建 : 2018/08/21 10:23
     */
    public static function detailsRequest($AccessToken,$DepartmentId,$Department)
    {
        // 获取URL地址
        $url = self::$AdministrativeConfig['DetailstmentList'];
        // 处理URL地址信息
        $url.= '?access_token='.$AccessToken;
        // 处理发送数据
        $data = json_encode([
            'department_id'  => $DepartmentId,
            'fetch_child' => $Department
        ],320);
        // 获取数据
        $res = self::curl($url,$data,'GET');
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
     * 名  称 : FindRequest()
     * 功  能 : 批量检查帐号
     * 输  入 : (String) $AccessToken => 'Access_Token接口凭证';
     * 输  入 : (String) $Userid          => '成员UserID。企业邮帐号名，邮箱格式';
     * 输  入 : (String) $Userlist          => '成员帐号，每次检查不得超过20个';
     * 输  出 : ['msg'=>'success','data'=>true]
     * 创  建 : 2018/08/21 10:23
     */
    public static function FindRequest($AccessToken,$Userlist)
    {
        // 获取URL地址
        $url = self::$AdministrativeConfig['DetailstmentFind'];
        // 处理URL地址信息
        $url.= '?access_token='.$AccessToken;
        // 处理发送数据
        $data = json_encode([
            'userlist'  => $Userlist
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
     * 名  称 : push_create_replace()
     * 功  能 : 正则替换后数据数组
     * 创  建 : 2018/08/26 14:19
     */
    private static function push_create_replace(&$data)
    {
        preg_match("/\"department\":.\"(.*?)\".,\"position\"/",$data,$arr);
        $arr[0] = preg_replace("/\"department\":.\"/", "\"department\":[", $arr[0]);
        $arr[0] = preg_replace("/\".,\"position\"/", "],\"position\"", $arr[0]);
        $arr[0] = preg_replace("/\",\"/", ",", $arr[0]);
        $data   = preg_replace("/\"department\":.\"(.*?)\".,\"position\"/", $arr[0], $data);
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