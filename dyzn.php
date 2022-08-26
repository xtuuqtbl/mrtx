<?php
// 欢迎关注抖音

// 9- 长按复制此条消息，打开抖音搜索，查看TA的更多作品。 https://v.douyin.com/jxEn81T/

$appId = 'wx0e9b1f2b80e8942b'; //对应自己的appId
$appSecret = 'd2350bddd4e03e695788a3487e6c9992'; //对应自己的appSecret
$wxgzhurl = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=" . $appId . "&secret=" . $appSecret;
$access_token_Arr = https_request($wxgzhurl);
$access_token = json_decode($access_token_Arr, true);
$ACCESS_TOKEN = $access_token['access_token']; //ACCESS_TOKEN


// 什么时候恋爱的(格式别错)
$lovestart = strtotime('2022-08-24');
$end = time();
$love = ceil(($end - $lovestart) / 86400);

// 下一个生日是哪一天(格式别错)
$birthdaystart = strtotime('2023-05-08');
$end = time();
$diff_days = ($birthdaystart - $end);
$birthday = (int)($diff_days/86400);
$birthday = str_replace("-", "", $birthday);


$tianqiurl = 'https://www.yiketianqi.com/free/day?appid=52969448&appsecret=slSLQy83&unescape=1&city=曲阜'; //修改为自己的
$tianqiapi = https_request($tianqiurl);
$tianqi = json_decode($tianqiapi, true);

$qinghuaqiurl = 'https://v2.alapi.cn/api/qinghua?token=Cdt2CI6PdRSu04XM'; //修改为自己的
$qinghuaapi = https_request($qinghuaqiurl);
$qinghua = json_decode($qinghuaapi, true);


// 你自己的一句话
$yjh = '曲阜天气预报'; //可以留空 也可以写上一句

$touser = 'owlWd6S481SaNIIuhvn82taV4zK0';  //这个填你女朋友的openid
$data = array(
    'touser' => $touser,
    'template_id' => "sWOc_bLGR4X-LvFxyB-ITrVsDloIfQfxxBxefecf99I", //改成自己的模板id，在微信后台模板消息里查看
    'data' => array(
        'first' => array(
            'value' => $yjh,
            'color' => "#000"
        ),
        'keyword1' => array(
            'value' => $tianqi['wea'],
            'color' => "#000"
        ),
        'keyword2' => array(
            'value' => $tianqi['tem_day'],
            'color' => "#000"
        ),
        'keyword3' => array(
            'value' => $love . '天',
            'color' => "#000"
        ),
        'keyword4' => array(
            'value' => $birthday . '天',
            'color' => "#000"
        ),
        'remark' => array(
            'value' => $qinghua['data']['content'],
            'color' => "#FF0000"
        ),
    )
);

// 下面这些就不需要动了————————————————————————————————————————————————————————————————————————————————————————————
$json_data = json_encode($data);
$url = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=" . $ACCESS_TOKEN;
$res = https_request($url, urldecode($json_data));
$res = json_decode($res, true);

if ($res['errcode'] == 0 && $res['errcode'] == "ok") {
    echo "发送成功！<br/>";
}else {
        echo "发送失败！请检查代码！！！<br/>";
}
function https_request($url, $data = null)
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    if (!empty($data)) {
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    }
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($curl);
    curl_close($curl);
    return $output;
}
