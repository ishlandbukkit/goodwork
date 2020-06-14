<?php


namespace App\Untils;


class CodePayUntil
{
    public static $codepay_id;
    public static $codepay_key;
    const type_airpay='1';
    const type_qq='2';
    const type_wechat='3';
    public function __construct()
    {
        CodePayUntil::$codepay_id=env('codepay_id');
        CodePayUntil::$codepay_key=env('codepay_key');
    }

    public function pay($pay_id,$type,$price,$notify_url,$return_url){
        $data = [
            'id' => CodePayUntil::$codepay_id,
            'pay_id' => $pay_id,
            'type' => $type,
            'price' => $price,
            'param' => '',
            'notify_url' => $notify_url,
            'return_url' => $return_url,
        ];

        ksort($data);
        reset($data);

        $sign = '';
        $urls = '';

        foreach ($data AS $key => $val) {
            if ($val == '' || $key == 'sign') continue;
            if ($sign != '') {
                $sign .= '&';
                $urls .= '&';
            }
            $sign .= $key.'='.$val;
            $urls .= $key.'=' . urlencode($val);

        }
        $query = $urls . '&sign=' . md5($sign . CodePayUntil::$codepay_key);
        $url = 'https://api.xiuxiu888.com/creat_order/?'.$query;
        return redirect($url);
    }
    public function handle($request){
        ksort($request); //排序post参数
        reset($request); //内部指针指向数组中的第一个元素
        $codepay_key="这里改成您的码支付密钥"; //这是您的密钥
        $sign = '';//初始化
        foreach ($request AS $key => $val) { //遍历POST参数
            if ($val == '' || $key == 'sign') continue; //跳过这些不签名
            if ($sign) $sign .= '&'; //第一个字符串签名不加& 其他加&连接起来参数
            $sign .= "$key=$val"; //拼接为url参数形式
        }
        if (!$request['pay_no'] || md5($sign . $codepay_key) != $request['sign']) { //不合法的数据
            return null;
        } else {
            return [
                'pay_id' => $request['pay_id'],
                'money' => (float)$request['money'],
                'price' => (float)$request['price'],
                'param' => $request['param'],
                'pay_no' => $request['pay_no'],
            ];
        }
    }
}
