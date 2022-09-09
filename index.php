<?php
$telegram_ip_ranges = [['lower' => '149.154.160.0', 'upper' => '149.154.175.255'],['lower' => '91.108.4.0',    'upper' => '91.108.7.255']];
$ip_dec = (float) sprintf("%u", ip2long($_SERVER['REMOTE_ADDR']));
$ok=false;
foreach ($telegram_ip_ranges as $telegram_ip_range) if (!$ok) {
//-
$lower_dec = (float) sprintf("%u", ip2long($telegram_ip_range['lower']));
$upper_dec = (float) sprintf("%u", ip2long($telegram_ip_range['upper']));
if ($ip_dec >= $lower_dec and $ip_dec <= $upper_dec) $ok=true;}
if (!$ok) die();
date_default_timezone_set('Asia/Tehran');
error_reporting(0);
define('API_KEY','توکن'); 
// توکن ربات
function bot($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);}}
function Botinfo($what){
    return bot('GetMe',[])->result->$what;}
//━━//
$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$reply_msgid = $message->reply_to_message->message_id;
$chat_id = $message->chat->id;
$message_id = $message->message_id;
$from_id = $message->from->id;
$text = $message->text;
$first_name = $message->from->first_name;
$last_name = $message->from->last_name;
$username = $message->from->username;
$tc = $update->message->chat->type;
$data = $update->callback_query->data;
$messageid = $update->callback_query->message->message_id;
$chatid = $update->callback_query->message->chat->id;
$fromid = $update->callback_query->from->id;
$textt = $update->callback_query->message->text;
$inline = $update->inline_query->query;
$inline_message_id = $update->callback_query->inline_message_id;
$new_chat_member_id = $update->message->new_chat_member->id;
$new_chat_member_username = $update->message->new_chat_member->username;
$rpto = $update->message->reply_to_message->forward_from->id;
//┅┅//
$admins = array("918222513","000000000");
// ایدی عددی مدیران👆
$bottag = "sponzy_bot"; // یوزرنیم ربات بدون @
$channel = "sponzy_ir"; // یوزرنیم چنل بدون @
//┅┅//
$bugun = date('d-M Y',strtotime('3 hour'));
$name_bot = Botinfo('first_name');
$forchaneel = json_decode(file_get_contents("https://api.telegram.org/bot".API_KEY."/getChatMember?chat_id=@$channel&user_id=".$chat_id));
$user = json_decode(file_get_contents("data/users/$from_id.json"),true);
$stats_n = json_decode(file_get_contents("https://api.telegram.org/bot".API_KEY."/getChatMember?chat_id=$chat_id&user_id=".$from_id),true);
$statjsonq = json_decode(file_get_contents("https://api.telegram.org/bot".API_KEY."/getChatMember?chat_id=$chatid&user_id=".$fromid),true);
$setp = $user['step']; // User STEP
$status_n = $stats_n['result']['status']; // STATS
$statusq = $statjsonq['result']['status']; // STATS
$tch = $forchaneel->result->status; // True Channel
$all_gaps = file_get_contents("data/allgap.txt");
$all_users = file_get_contents("data/allusers.txt");
$yadauto = file_get_contents("data/autoYAD.txt");
if(isset($data)){
$fid = $update->callback_query->from->id;}
if(isset($message->from)){
$fid = $message->from->id;}
//=== dev : @virtualdev ===\\
function deletefolder($path){
 if($handle=opendir($path)){
  while (false!==($file=readdir($handle))){
   if($file<>"." AND $file<>".."){
    if(is_file($path.'/'.$file)){ 
     @unlink($path.'/'.$file); } 
    if(is_dir($path.'/'.$file)) { 
     deletefolder($path.'/'.$file); 
     @rmdir($path.'/'.$file); }} } }}
function step($from_id,$step){
$user = json_decode(file_get_contents("data/users/$from_id.json"),true);
$user["step"] = "$step";
$outjson = json_encode($user,true);
file_put_contents("data/users/$from_id.json",$outjson);
return true;
}
function rand_string( $length ){
$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789#@";
return substr(str_shuffle($chars),0,$length);
}
//━━//
if($yadauto == null ){
file_put_contents("data/autoYAD.txt","⬜");
}
if($tc == "private" ){
$all_users2 = explode("\n",$all_users); 
if(!in_array($chat_id,$all_users2)){
$tctctct = fopen("data/allusers.txt", "a") or die("Unable to open file!");
fwrite($tctctct, "$chat_id\n");
fclose($tctctct);}}
$user_flood = file_get_contents("data/spam/$fid.txt");
if($user_flood < time()){ 
$spamtime = 0.09; // تایم اسپم پشت سرهم
$tt = time() + $spamtime;
file_put_contents("data/spam/$fid.txt",$tt);
//━━//
if($text == "/start"){
if($tc == "private" ){
if($tch != 'member' && $tch != 'creator' && $tch != 'administrator' ){
bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"❗️کاربر گرامی برای استفاده از ربات و حمایت از ما ابتدا در چنل زیر عضو شوید و سپس /start را ارسال کنید!",
 'reply_markup' => json_encode([
 'inline_keyboard' => [
    [['text' => "🛎️ عضویت در کانال️", 'url' => "https://t.me/$channel"]],
]])
]);
}else{
step($chat_id,"none");
 bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"👋🏻 سلام [$first_name](tg://user?id=$from_id)
خوش اومدی 🥳
میخوای گروهت جذاب شه؟ $name_bot ! تو گروهت اد کن😎
برا اجرای دستوراتم از دکمه ها استفاده کن 😇",
 'parse_mode'=>"MarkDown",
  'reply_markup'=>json_encode([
            'inline_keyboard'=>[
                [['text'=>"💞 افزودن $name_bot به گروه 💞",'url'=>"https://t.me/$bottag?startgroup=new"]],
              [['text'=>"📧 یاد دادن کلمه",'callback_data'=>'addkalame'],['text'=>"🪄 راهنمای نصب",'callback_data'=>'sar']],
  ] ]) ]);  }}}

	if(strpos($text,"'") !== false or strpos($text,'"') !== false or strpos($text,"}") !== false or strpos($text,"{") !== false or strpos($text,")'") !== false or strpos($text,"(") !== false){	
	if($tc == "private" ){
	$tt = time() + 9999999999999999;
file_put_contents("data/spam/$from_id.txt",$tt);
if(!in_array($chat_id,$admins)){
step($chat_id,"none");
  bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"🔔 به دلیل ارسال کد مخرب به ربات، بلاک شدید!",
 'parse_mode'=>"HTML",
  'reply_to_message_id'=>$message_id,
]); 
 bot('sendMessage',[
 'chat_id'=>$admins[0],
 'text'=>"[▫️ این کاربر کد مخرب ارسال کرد!](tg://user?id=$from_id)",
 'parse_mode'=>"MarkDown",
]); 
}else{
 bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"🔰 شما از ربات به دلیل به خطر انداختن امنیت مسدود شدید!",
 'parse_mode'=>"HTML",
  'reply_to_message_id'=>$message_id,
 ]); }}}
elseif($data == "back"){
step($chatid,"none");
bot('editMessagetext',[
 'chat_id'=>$chatid,
'message_id'=>$messageid,
            'text' => "📱 به منوی اصلی بازگشتید

برا اجرای دستوراتم از دکمه ها استفاده کن 😇",
 'parse_mode'=>"MarkDown",
  'reply_markup'=>json_encode([
            'inline_keyboard'=>[
                [['text'=>"💞 افزودن $name_bot به گروه 💞",'url'=>"https://t.me/$bottag?startgroup=new"]],
              [['text'=>"📧 یاد دادن کلمه",'callback_data'=>'addkalame'],['text'=>"🪄 راهنمای نصب",'callback_data'=>'sar']],
              ]]) ]);}

/*
بخش راهنما نصب
*/
elseif($data == "sar"){
bot('editMessagetext',[
 'chat_id'=>$chatid,
'message_id'=>$messageid,
            'text' => "فقط کافیه من رو تو گروه اضافه کنی و مدیرم کنی",
 'parse_mode'=>"MarkDown",
  'reply_markup'=>json_encode([
            'inline_keyboard'=>[
                [['text'=>"🤍 اشتراک گزاری",'switch_inline_query'=>"All you have to do is add me to the group and admin me"]],
              [['text'=> "🏛 منوی اصلی", 'callback_data'=>"back"]],
              ]
        ])
        ]);}
elseif($data == "addkalame"){
	step($chatid,"addkalame");
bot('editMessagetext',[
 'chat_id'=>$chatid,
'message_id'=>$messageid,
            'text' => "🎓 کلمه مورد نظر را ارسال کنید:",
 'parse_mode'=>"MarkDown",
  'reply_markup'=>json_encode([
            'inline_keyboard'=>[
[['text'=> "🏛 منوی اصلی", 'callback_data'=>"back"]],
              ]
        ])
        ]);}

elseif($user["step"] == "addkalame" && $tc == "private"){
if(!file_exists("data/kalamat/$text.txt")){
if(strlen($text) < 160 ){
$user["kalame"] = $text;
$user["step"] = "adduwgw";
$outjson = json_encode($user,true);
file_put_contents("data/users/$from_id.json",$outjson);
	bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"🧾 جواب را ارسال کنید
 
 📔 میتوانید جواب های رندوم هرکدام در یک خط ارسال کنید!",
 'parse_mode'=>"MarkDown",
  'reply_markup'=>json_encode([
            'inline_keyboard'=>[
[['text'=> "🏛 منوی اصلی", 'callback_data'=>"back"]],
              ]
        ])
 ]); }else{
bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"💬 کلمه شما بیش از اندازه طولانی است
کلمه ای دیگر ارسال کنید:",
 'parse_mode'=>"MarkDown",
  'reply_markup'=>json_encode([
            'inline_keyboard'=>[
[['text'=> "🏛 منوی اصلی", 'callback_data'=>"back"]],
              ]])
]); }}else{
bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"💬 این کلمه از قبل در ربات موجود است
کلمه ای دیگر ارسال کنید:",
 'parse_mode'=>"MarkDown",
  'reply_markup'=>json_encode([
            'inline_keyboard'=>[[['text'=> "🏛 منوی اصلی", 'callback_data'=>"back"]],]
        ]) ]); }}
elseif($user["step"] == "adduwgw" && $tc == "private"){
if(strlen($text) < 250 ){
$user["step"] = "none";
$outjson = json_encode($user,true);
file_put_contents("data/users/$from_id.json",$outjson);
$Kalame = $user["kalame"];
if($yadauto == "⬜"){
file_put_contents("data/kalamat/$Kalame.txt",$text);
bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"🎀 کلمه ارسالی شما در ربات ثبت شد
🌹 با تشکر",
 'parse_mode'=>"MarkDown",
  'reply_markup'=>json_encode([
            'inline_keyboard'=>[
[['text'=> "🏛 منوی اصلی", 'callback_data'=>"back"]],
              ]
        ])
 ]);  }else{
$r = rand(11111111,999999999);
$rand = $r;
$users = json_decode(file_get_contents("data/int/$rand.json"),true);
$users["id"] = $chat_id;
$users["kalame"] = $Kalame;
$users["javab"] = $text;
$outjsons = json_encode($users,true);
file_put_contents("data/int/$rand.json",$outjsons);
bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"🦋 کلمه ارسالی شما به لیست تایید پیوست!

⚠️ <b>( از ارسال مجدد این کلمه خود داری کنید )</b>
🪄 پس از تایید به شما اعلام میشود! سپاس از شما🙏🏻🌹",
 'parse_mode'=>"HTML",
  'reply_markup'=>json_encode([
            'inline_keyboard'=>[[['text'=> "🏛 منوی اصلی", 'callback_data'=>"back"]],]])
 ]); 
 $yaro = "[Open Profile](tg://user?id=$from_id)";
bot('sendMessage',[
 'chat_id'=>$admins[0],
 'text'=>"📯 کلمه ( `$Kalame` ) توسط ( $yaro )
با پاسخ های:
`$text`

❗️ به لیست انتظار پیوست!",
 'parse_mode'=>"MarkDown",
  'reply_markup'=>json_encode([
            'inline_keyboard'=>[
[['text'=> "🤍 تایید", 'callback_data'=>"ta_$rand"],['text'=> "🖤 رد کردن", 'callback_data'=>"la_$rand"]],
[['text'=> "💔 مسدود کردن شخص 💔", 'callback_data'=>"ba_$from_id"]],
              ]
        ])
 ]);  }}else{
bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"💬 جواب ارسالی شما بیش از اندازه طولانی است!
پاسخی دیگر ارسال کنید:",
 'parse_mode'=>"MarkDown",
  'reply_markup'=>json_encode([
            'inline_keyboard'=>[
[['text'=> "🏛 منوی اصلی", 'callback_data'=>"back"]],
  ]
        ])
 ]);}}
elseif(strpos($data,"la_") !== false ){
$ok = str_replace("la_","",$data);
$users = json_decode(file_get_contents("data/int/$ok.json"),true);
$id = $users['id'];
$kalam = $users['kalame'];
bot('sendMessage',[
 'chat_id'=>$id,
'text'=>"💗 کاربر گرامی، کلمه $kalam تایید نشد!
🖋 از ارسال مجدد آن خودداری کنید.",
 ]); 
 unlink("data/int/$ok.json");
bot('editMessagetext',[
 'chat_id'=>$chatid,
'message_id'=>$messageid,
            'text' => "💘 کلمه رد شد!",
 'parse_mode'=>"MarkDown",
        ]); }
 elseif(strpos($data,"ta_") !== false ){
 $ok = str_replace("ta_","",$data);
$users = json_decode(file_get_contents("data/int/$ok.json"),true);
$kalam = $users['kalame'];
$jav = $users['javab'];
$id = $users['id'];
file_put_contents("data/kalamat/$kalam.txt",$jav);
bot('sendMessage',[
 'chat_id'=>$id,
 'text'=>"🌹کاربر گرامی، کلمه $kalam به ربات اضافه شد.
با تشکر 🙏🏻",
 ]); 
unlink("data/int/$ok.json");
bot('editMessagetext',[
 'chat_id'=>$chatid,
'message_id'=>$messageid,
            'text' => "💌 کلمه با موفقیت تایید شد!",
 'parse_mode'=>"MarkDown",
        ]); }
//=== dev : @virtualdev ===\\
 elseif(strpos($data,"ba_") !== false ){
 $ok = str_replace("ba_","",$data);
$tt = time() + 9999999999999999;
file_put_contents("data/spam/$ok.txt",$tt);
	bot('sendMessage',[
 'chat_id'=>$ok,
 'text'=>"🛡️ شما از ربات توسط مدیریت مسدود شدید!",
 'parse_mode'=>"MarkDown",
	 ]); 
bot('editMessagetext',[
 'chat_id'=>$chatid,
'message_id'=>$messageid,
            'text' => "🎭 کاربر از ربات مسدود شد!",
 'parse_mode'=>"MarkDown",
        ]); }
//━━کامل━//
if($text == "panel" or $text == "پنل"){
   $id_bot = bot('GetMe',[]) -> result -> id;
	$stats_b = json_decode(file_get_contents("https://api.telegram.org/bot".API_KEY."/getChatMember?chat_id=$chat_id&user_id=".$id_bot),true);
$status_b = $stats_b['result']['status'];
if ($status_b == 'creator' or $status_b == 'administrator' ){
if ($status_n == 'creator' or $status_n == 'administrator' ){
 bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"⚙️ در این بخش شما میتوانید دستورات مختلف ربات را مشاهده و استفاده کنید:
📆: $bugun",
 'parse_mode'=>"MarkDown",
  'reply_to_message_id'=>$message_id,
  'reply_markup'=>json_encode([
            'inline_keyboard'=>[[['text'=>"🤔 راهنما نصب",'switch_inline_query'=>"All you have to do is add me to the group and admin me"],
 ['text'=>"📚 راهنما ربات",'callback_data'=>'help_g']],
[['text'=>"⭐️ افزودن $name_bot به گروه ⭐️",'url'=>"t.me/$bottag?startgroup=new"]],
]]) ]); 
}else{
 bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"🤨 شما ادمین گروه نیستید!",
 'parse_mode'=>"MarkDown",
  'reply_to_message_id'=>$message_id,
 ]); }
}else{
bot('sendMessage',[
'chat_id' =>$chat_id,
'text' => "⚠️ برای فعالیت در گروه ابتدا من را ادمین کنید!",
 'parse_mode'=>"MarkDown",
 'reply_to_message_id'=>$message_id,
]);}}
if($data == "back_g"){
if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$admins) ){
bot('editMessagetext',[
 'chat_id'=>$chatid,
'message_id'=>$messageid,
            'text' =>"🔁 به پنل اصلی بازگشتید!
⚙️ در این بخش شما میتوانید دستورات مختلف ربات را مشاهده و استفاده کنید:",
 'parse_mode'=>"MarkDown",
  'reply_markup'=>json_encode([
            'inline_keyboard'=>[
[['text'=>"📚 راهنما ربات",'callback_data'=>'help_g']],
[['text'=>"⭐️ افزودن $name_bot به گروه ⭐️",'url'=>"t.me/$bottag?startgroup=new"]],
[['text'=>"️🗨 پشتیبانی 🗨",'url'=>"t.me/virtualdev"]], // آیدی پشتیبانی
              ]
       ])
        ]);}else{
	bot('answercallbackquery', [
        'callback_query_id' => $update->callback_query->id,
        'text' => "🤨 شما ادمین گروه نیستید!",
        'show_alert' => false
    ]);}}
elseif($data == "help_g"){
if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$admins) ){
bot('editMessagetext',[
 'chat_id'=>$chatid,
'message_id'=>$messageid,
          'text' => "📖 راهنمای دستورات $name_bot گروه!

~ دریافت اطلاعات شما:
• me - من

~ دریافت فال:
• fal - فال

~ دریافت قیمت گوشی:
• mobile - قیمت گوشی
> مثال : قیمت گوشی Samsung

~ ساخت گیف با متن مورد نظر:
• gif - گیف

~ دریافت متن برای بیو‌گرافی:
• bio - بیوگرافی

~ دریافت دانستنی:
• Bilmoq - دانستنی

~ دریافت معنی کلمات فارسی:
• معنی

~ دریافت اوقات شرعی:
• azan - اذان

~ محاسبه سن دقیق شما:
• age - محاسبه سن

> مثال: age 1378/11/15

~ دریافت فونت موردنظر:
> هر دو دستور فارسی و انگلیسی مخصوص فونت انگلیسی هستند

• font - فونت - Font

~ دریافت زمان:
• time - ساعت

~ ایجاد پسورد تصادفی
• pass - پسورد

~ جوک خنده دار و تصادفی
• jok - جوک

~ الکی مثلا همه چیش الکیه
• fake - الکی مثلا

~ ساخت لوگو با نام شما
• /photo متن شما
> مثال :
/photo Hossein
",
 'parse_mode'=>"MarkDown",
  'reply_markup'=>json_encode([
            'inline_keyboard'=>[
[['text'=> "🏛 منوی اصلی️", 'callback_data'=>"back_g"]],
              ]])
        ]);}else{
bot('answercallbackquery', [
        'callback_query_id' => $update->callback_query->id,
        'text' => "🤨 شما ادمین گروه نیستید!",
        'show_alert' => false
    ]);}}
//=== dev : @virtualdev ===\\
if($tc == "supergroup" or $tc == "group" ){
$all_gaps2 = explode("\n",$all_gaps); 
if(!in_array($chat_id,$all_gaps2)){
$tctctct = fopen("data/allgap.txt", "a") or die("Unable to open file!");
fwrite($tctctct, "\n$chat_id");
fclose($tctctct);
bot('sendMessage',[
  'chat_id' =>$chat_id,
  'text' => "🔅 ربات $name_bot نصب شد!

📚 <b>ابتدا ربات را ادمین گروه کرده و سپس کلمه پنل را ارسال کنید!</b>

⚠️ <b>تا زمانی که ادمین گروه نباشم نمیتوانم فعالیتی انجام دهم!</b>",
 'parse_mode'=>"HTML",
]);
bot('sendMessage',[
            'chat_id' =>$admins[0],
'text' => "⚜ گروه `$chat_id` به ربات اضافه شد!",
 'parse_mode'=>"MarkDown",
]);}
if($text && file_exists("data/kalamat/$text.txt")){
$file = file_get_contents("data/kalamat/$text.txt");
$ex = explode("\n",$file);
$jrand = $ex[rand(0, count($ex)-1)];
bot('sendMessage',[
    'chat_id' =>$chat_id,
    'text' =>$jrand,
'reply_to_message_id'=>$message_id,
]);}
//===. dev : @virtualdev ===\\
if(preg_match('/^[!\/#]?(mobile|قیمت گوشی) (.*)$/i',$text,$match)){
$get = file_get_contents("http://alpha-soft.ir/MobilePrice/v2/ShowPrice.php?Source=emalls&Model=".$match[2]);
$result = json_decode($get, true);
if(count($result['result']) > 1){
foreach($result['result'] as $key => $value){
$model = $value['Model'];
$price = $value['Price'];
$photo = $value['PIC'];
if(strlen($string) < 4000){
$string .= "📱 مدل دقیق : $model\n🛍 قیمت : $price\n\n\n";
}else{
$string1 .= "📱 مدل دقیق : $model\n🛍 قیمت : $price\n\n\n";}}
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"💻 قیمت روز گوشی های ".$match[2]." :\n$string", 'parse_mode'=>'MarkDown','reply_to_message_id'=>$message_id]);
}else{
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"🕹 یافت نشد!", 'parse_mode'=>'MarkDown','reply_to_message_id'=>$message_id]);}}
//===. dev : @virtualdev. ===\\
elseif($text =="بیوگرافی" or $text == "bio"){
$bio = file_get_contents("https://api.codebazan.ir/bio/");
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"❡ متن بیوگرافی ⇩
 
$bio

برای کپی شدن متن بیو آن را لمس کنید !",
'reply_to_message_id'=>$message_id,
'parse_mode'=>'MarkDown',
'reply_markup'=>$or,
]);}
elseif($text =="اذان" or $text == "azan"){
$text = file_get_contents("https://prayer.aviny.com/api/prayertimes/1");
$getchat = json_decode($text, true);
$city = $getchat["CityName"];
$sobeh = $getchat["Imsaak"];
$toloe = $getchat["Sunrise"];  
$zoher = $getchat["Noon"]; 
$qurob = $getchat["Sunset"]; 
$maghreb = $getchat["Maghreb"]; 
$nime = $getchat["Midnight"]; 
$rmroz = $getchat["Today"];
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"🕋 اوقات شرعی $city :
 
⿻ اذان صبح : $sobeh
⿻ طلوع افتاب : $toloe
⿻ اذان ظهر : $zoher
⿻ غروب افتاب : $qurob
⿻ اذان مغرب : $maghreb
⿻ نیمه شب : $nime

● تاریخ امروز : $rmroz",
'reply_to_message_id'=>$message_id,
'parse_mode'=>'MarkDown',
'reply_markup'=>$or,
]);}
//----------//////-----------
if(preg_match('/^[!\/#]?(age|محاسبه سن) (\d+)\/(\d+)\/(\d+)$/i',$text,$match)){
$get = file_get_contents("http://api.novateamco.ir/age/?year=".$match[2]."&month=".$match[3]."&day=".$match[4]);
if($match[2] < 1000 or $match[3] >= 13 or $match[4] >= 32 or $match[2] >= 1400){
  bot('sendmessage',[
    'chat_id'=>$chat_id,
    'text'=>"لطفا ابتدا از صحت فرمت وارد شده اطمینان حاصل کنید و مجددا امتحان کنید !",'reply_to_message_id'=>$message_id,]);
}else{
$result = json_decode($get, true);
if($result['ok'] === true){
 bot('sendmessage',[
    'chat_id'=>$chat_id,
    'text'=>"⚖️ محاسبه سن انجام شد !
🌏 کل روز های سپری شده : ".$result['other']['days']."\n🤤 حیوان سال شما : ".$result['other']['year_name']."\n🦅 روز های مانده به تولد بعدی شما : ".$result['other']['to_birth']."\n\n• Ch : @$channel", 'MarkDown','reply_to_message_id'=>$message_id]);}}}
//=== dev : @virtualdev ===\\
if(preg_match('/^(font|Font|فونت) (.*)/s', $text, $mtch)){
$matn = strtoupper("$mtch[2]");
$Eng = ['Q','W','E','R','T','Y','U','I','O','P','A','S','D','F','G','H','J','K','L','Z','X','C','V','B','N','M'];
$Font_0 = ['𝐐','𝐖','𝐄','𝐑','𝐓','𝐘','𝐔','𝐈','𝐎','𝐏','𝐀','𝐒','𝐃','𝐅','𝐆','𝐇','𝐉','𝐊','𝐋','𝐙','𝐗','𝐂','𝐕','𝐁','𝐍','𝐌'];
$Font_1 = ['𝑸','𝑾','𝑬','𝑹','𝑻','𝒀','𝑼','𝑰','𝑶','𝑷','𝑨','𝑺','𝑫','𝑭','𝑮','𝑯','𝑱','𝑲','𝑳','𝒁','𝑿','𝑪','𝑽','𝑩','𝑵','𝑴'];
$Font_2 = ['𝑄','𝑊','𝐸','𝑅','𝑇','𝑌','𝑈','𝐼','𝑂','𝑃','𝐴','𝑆','𝐷','𝐹','𝐺','𝐻','𝐽','𝐾','𝐿','𝑍','𝑋','𝐶','𝑉','𝐵','𝑁','𝑀'];
$Font_3 = ['𝗤','𝗪','𝗘','𝗥','𝗧','𝗬','𝗨','𝗜','𝗢','𝗣','𝗔','𝗦','𝗗','𝗙','𝗚','𝗛','𝗝','𝗞','𝗟','𝗭','𝗫','𝗖','𝗩','𝗕','𝗡','𝗠'];
$Font_4 = ['𝖰','𝖶','𝖤','𝖱','𝖳','𝖸','𝖴','𝖨','𝖮','𝖯','𝖠','𝖲','𝖣','𝖥','𝖦','𝖧','𝖩','𝖪','𝖫','𝖹','𝖷','𝖢','𝖵','𝖡','𝖭','𝖬'];
$Font_5 = ['𝕼','𝖂','𝕰','𝕽','𝕵','𝚼','𝖀','𝕿','𝕺','𝕻','𝕬','𝕾','𝕯','𝕱','𝕲','𝕳','𝕴','𝕶','𝕷','𝖅','𝖃','𝕮','𝖁','𝕭','𝕹','𝕸'];
$Font_6 = ['𝔔','𝔚','𝔈','ℜ','𝔍','ϒ','𝔘','𝔗','𝔒','𝔓','𝔄','𝔖','𝔇','𝔉','𝔊','ℌ','ℑ','𝔎','𝔏','ℨ','𝔛','ℭ','𝔙','𝔅','𝔑','𝔐'];
$Font_7 = ['𝙌','𝙒','𝙀','𝙍','𝙏','𝙔','𝙐','𝙄','𝙊','𝙋','𝘼','𝙎','𝘿','𝙁','𝙂','𝙃','𝙅','𝙆','𝙇','𝙕','𝙓','𝘾','𝙑','𝘽','𝙉','𝙈'];
$Font_8 = ['𝘘','𝘞','𝘌','𝘙','𝘛','𝘠','𝘜','𝘐','𝘖','𝘗','𝘈','𝘚','𝘋','𝘍','𝘎','𝘏','𝘑','𝘒','𝘓','𝘡','𝘟','𝘊','𝘝','𝘉','𝘕','𝘔'];
$Font_9 = ['Q̶̶','W̶̶','E̶̶','R̶̶','T̶̶','Y̶̶','U̶̶','I̶̶','O̶̶','P̶̶','A̶̶','S̶̶','D̶̶','F̶̶','G̶̶','H̶̶','J̶̶','K̶̶','L̶̶','Z̶̶','X̶̶','C̶̶','V̶̶','B̶̶','N̶̶','M̶̶'];
$Font_10 = ['Q̷̷̶̶','W̷̷̶̶','E̷̷̶̶','R̷̷̶̶','T̷̷̶̶','Y̷̷̶̶','U̷̷̶̶','I̷̷̶̶','O̷̷̶̶','P̷̷̶̶','A̷̷̶̶','S̷̷̶̶','D̷̷̶̶','F̷̷̶̶','G̷̷̶̶','H̷̷̶̶','J̷̷̶̶','K̷̷̶̶','L̷̷̶̶','Z̷̷̶̶','X̷̷̶̶','C̷̷̶̶','V̷̷̶̶','B̷̷̶̶','N̷̷̶̶','M̷̷̶̶'];
$Font_11 = ['Q͟͟','W͟͟','E͟͟','R͟͟','T͟͟','Y͟͟','U͟͟','I͟͟','O͟͟','P͟͟','A͟͟','S͟͟','D͟͟','F͟͟','G͟͟','H͟͟','J͟͟','K͟͟','L͟͟','Z͟͟','X͟͟','C͟͟','V͟͟','B͟͟','N͟͟','M͟͟'];
$Font_12 = ['Q͇͇','W͇͇','E͇͇','R͇͇','T͇͇','Y͇͇','U͇͇','I͇͇','O͇͇','P͇͇','A͇͇','S͇͇','D͇͇','F͇͇','G͇͇','H͇͇','J͇͇','K͇͇','L͇͇','Z͇͇','X͇͇','C͇͇','V͇͇','B͇͇','N͇͇','M͇͇'];
$Font_13 = ['Q̤̤','W̤̤','E̤̤','R̤̤','T̤̤','Y̤̤','Ṳ̤','I̤̤','O̤̤','P̤̤','A̤̤','S̤̤','D̤̤','F̤̤','G̤̤','H̤̤','J̤̤','K̤̤','L̤̤','Z̤̤','X̤̤','C̤̤','V̤̤','B̤̤','N̤̤','M̤̤'];
$Font_14 = ['Q̰̰','W̰̰','Ḛ̰','R̰̰','T̰̰','Y̰̰','Ṵ̰','Ḭ̰','O̰̰','P̰̰','A̰̰','S̰̰','D̰̰','F̰̰','G̰̰','H̰̰','J̰̰','K̰̰','L̰̰','Z̰̰','X̰̰','C̰̰','V̰̰','B̰̰','N̰̰','M̰̰'];
$Font_15 = ['디','山','乇','尺','亇','丫','凵','工','口','ㄗ','闩','丂','刀','下','彑','⼶','亅','片','乚','乙','乂','亡','ム','乃','力','从'];
$Font_16= ['ዓ','ሠ','ይ','ዩ','ፐ','ሃ','ሀ','ፗ','ዐ','የ','ል','ና','ሏ','ፑ','ፘ','ዘ','ጋ','ኸ','ረ','ጓ','ጰ','ር','ህ','ፎ','በ','ጠ'];
$Font_17= ['Ꭷ','Ꮃ','Ꭼ','Ꮢ','Ꭲ','Ꭹ','Ꮜ','Ꮖ','Ꮻ','Ꮲ','Ꭺ','Ꮪ','Ꭰ','Ꮀ','Ꮐ','Ꮋ','Ꭻ','Ꮶ','Ꮮ','Ꮓ','Ꮱ','Ꮯ','Ꮩ','Ᏼ','N','Ꮇ'];
$Font_18= ['Ǫ','Ѡ','Σ','Ʀ','Ϯ','Ƴ','Ʋ','Ϊ','Ѳ','Ƥ','Ѧ','Ƽ','Δ','Ӻ','Ǥ','ⴼ','Ɉ','Ҟ','Ɫ','Ⱬ','Ӽ','Ҁ','Ѵ','Ɓ','Ɲ','ᛖ'];
$Font_19= ['ꐎ','ꅐ','ꂅ','ꉸ','ꉢ','ꌦ','ꏵ','ꀤ','ꏿ','ꉣ','ꁲ','ꌗ','ꅓ','ꊰ','ꁅ','ꍬ','ꀭ','ꂪ','꒒','ꏣ','ꉧ','ꊐ','ꏝ','ꃃ','ꊮ','ꂵ'];
$Font_20= ['ᘯ','ᗯ','ᕮ','ᖇ','ᙢ','ᖻ','ᑌ','ᖗ','ᗝ','ᑭ','ᗩ','ᔕ','ᗪ','ᖴ','ᘜ','ᕼ','ᒍ','ᖉ','ᒐ','ᘔ','᙭','ᑕ','ᕓ','ᗷ','ᘉ','ᗰ'];
$Font_21= ['ᑫ','ᗯ','ᗴ','ᖇ','Ꭲ','Ꭹ','ᑌ','Ꮖ','ᝪ','ᑭ','ᗩ','ᔑ','ᗞ','ᖴ','Ꮐ','ᕼ','ᒍ','Ꮶ','Ꮮ','Ꮓ','᙭','ᑕ','ᐯ','ᗷ','ᑎ','ᗰ'];
$Font_22= ['ℚ','Ꮤ','℮','ℜ','Ƭ','Ꮍ','Ʋ','Ꮠ','Ꮎ','⅌','Ꭿ','Ꮥ','ⅅ','ℱ','Ꮹ','ℋ','ℐ','Ӄ','ℒ','ℤ','ℵ','ℭ','Ꮙ','Ᏸ','ℕ','ℳ'];
$Font_23= ['Ԛ','ᚠ','ᛊ','ᚱ','ᛠ','ᚴ','ᛘ','ᛨ','θ','ᚹ','ᚣ','ᛢ','ᚦ','ᚫ','ᛩ','ᚻ','ᛇ','ᛕ','ᚳ','Z','ᚷ','ᛈ','ᛉ','ᛒ','ᚺ','ᚥ'];
$Font_24= ['𝓠','𝓦','𝓔','𝓡','𝓣','𝓨','𝓤','𝓘','𝓞','𝓟','𝓐','𝓢','𝓓','𝓕','𝓖','𝓗','𝓙','𝓚','𝓛','𝓩','𝓧','𝓒','𝓥','𝓑','𝓝','𝓜'];
$Font_25= ['𝒬','𝒲','ℰ','ℛ','𝒯','𝒴','𝒰','ℐ','𝒪','𝒫','𝒜','𝒮','𝒟','ℱ','𝒢','ℋ','𝒥','𝒦','ℒ','𝒵','𝒳','𝒞','𝒱','ℬ','𝒩','ℳ'];$Font_26= ['ℚ','𝕎','𝔼','ℝ','𝕋','𝕐','𝕌','𝕀','𝕆','ℙ','𝔸','𝕊','𝔻','𝔽','𝔾','ℍ','𝕁','𝕂','𝕃','ℤ','𝕏','ℂ','𝕍','𝔹','ℕ','𝕄'];
$Font_27= ['Ｑ','Ｗ','Ｅ','Ｒ','Ｔ','Ｙ','Ｕ','Ｉ','Ｏ','Ｐ','Ａ','Ｓ','Ｄ','Ｆ','Ｇ','Ｈ','Ｊ','Ｋ','Ｌ','Ｚ','Ｘ','Ｃ','Ｖ','Ｂ','Ｎ','Ｍ'];
$Font_28= ['ǫ','ᴡ','ᴇ','ʀ','ᴛ','ʏ','ᴜ','ɪ','ᴏ','ᴘ','ᴀ','s','ᴅ','ғ','ɢ','ʜ','ᴊ','ᴋ','ʟ','ᴢ','x','ᴄ','ᴠ','ʙ','ɴ','ᴍ'];
$Font_29= ['𝚀','𝚆','𝙴','𝚁','𝚃','𝚈','𝚄','𝙸','𝙾','𝙿','𝙰','𝚂','𝙳','𝙵','𝙶','𝙷','𝙹','𝙺','𝙻','𝚉','𝚇','𝙲','𝚅','𝙱','𝙽','𝙼'];
$Font_30= ['ᵟ','ᵂ','ᴱ','ᴿ','ᵀ','ᵞ','ᵁ','ᴵ','ᴼ','ᴾ','ᴬ','ˢ','ᴰ','ᶠ','ᴳ','ᴴ','ᴶ','ᴷ','ᴸ','ᶻ','ˣ','ᶜ','ⱽ','ᴮ','ᴺ','ᴹ'];
$Font_31= ['Ⓠ','Ⓦ','Ⓔ','Ⓡ','Ⓣ','Ⓨ','Ⓤ','Ⓘ','Ⓞ','Ⓟ','Ⓐ','Ⓢ','Ⓓ','Ⓕ','Ⓖ','Ⓗ','Ⓙ','Ⓚ','Ⓛ','Ⓩ','Ⓧ','Ⓒ','Ⓥ','Ⓑ','Ⓝ','Ⓜ'];
$Font_32= ['🅀','🅆','🄴','🅁','🅃','🅈','🅄','🄸','🄾','🄿','🄰','🅂','🄳','🄵','🄶','🄷','🄹','🄺','🄻','🅉','🅇','🄲','🅅','🄱','🄽','🄼'];
$Font_33= ['🅠','🅦','🅔','🅡','🅣','🅨','🅤','🅘','🅞','🅟','🅐','🅢','🅓','🅕','🅖','🅗','🅙','🅚','🅛','🅩​','🅧','🅒','🅥','🅑','🅝','🅜'];
$Font_34= ['🆀','🆆','🅴','🆁','🆃','🆈','🆄','🅸','🅾','🅿','🅰','🆂','🅳','🅵','🅶','🅷','🅹','🅺','🅻','🆉','🆇','🅲','🆅','🅱','🅽','🅼'];
$Font_35= ['🇶 ','🇼 ','🇪 ','🇷 ','🇹 ','🇾 ','🇺 ','🇮 ','🇴 ','🇵 ','🇦 ','🇸 ','🇩 ','🇫 ','🇬 ','🇭 ','🇯 ','🇰 ','🇱 ','🇿 ','🇽 ','🇨 ','🇻 ','🇧 ','🇳 ','🇲 '];
//===. dev : @virtualdev ===\\
$nn = str_replace($Eng,$Font_0,$matn);
$a = str_replace($Eng,$Font_1,$matn);
$b = str_replace($Eng,$Font_2,$matn);
$c = trim(str_replace($Eng,$Font_3,$matn));
$d = str_replace($Eng,$Font_4,$matn);
$e = str_replace($Eng,$Font_5,$matn);
$f = str_replace($Eng,$Font_6,$matn);
$g = str_replace($Eng,$Font_7,$matn);
$h = str_replace($Eng,$Font_8,$matn);
$i = str_replace($Eng,$Font_9,$matn);
$j = str_replace($Eng,$Font_10,$matn);
$k = str_replace($Eng,$Font_11,$matn);
$l = str_replace($Eng,$Font_12,$matn);
$m = str_replace($Eng,$Font_13,$matn);
$n = str_replace($Eng,$Font_14,$matn);
$o = str_replace($Eng,$Font_15,$matn);
$p= str_replace($Eng,$Font_16,$matn);
$q= str_replace($Eng,$Font_17,$matn);
$r= str_replace($Eng,$Font_18,$matn);
$s= str_replace($Eng,$Font_19,$matn);
$t= str_replace($Eng,$Font_20,$matn);
$u= str_replace($Eng,$Font_21,$matn);
$v= str_replace($Eng,$Font_22,$matn);
$w= str_replace($Eng,$Font_23,$matn);
$x= str_replace($Eng,$Font_24,$matn);
$y= str_replace($Eng,$Font_25,$matn);
$z= str_replace($Eng,$Font_26,$matn);
$aa= str_replace($Eng,$Font_27,$matn);
$ac= str_replace($Eng,$Font_28,$matn);
$ad= str_replace($Eng,$Font_29,$matn);
$af= str_replace($Eng,$Font_30,$matn);
$ag= str_replace($Eng,$Font_31,$matn);
$ah= str_replace($Eng,$Font_32,$matn);
$am= str_replace($Eng,$Font_33,$matn);
$as= str_replace($Eng,$Font_34,$matn);
$pol= str_replace($Eng,$Font_35,$matn);
bot('sendmessage',[
'chat_id'=>$chat_id,
'text' => "
1 - $nn
2 - $a
3 - $b
4 - $c
5 - $d
6 - $e
7 - $f
8 - $g
9 - $h
10 - $i
11 - $j
12 - $k
13 - $l
14 - $m
15 - $n
16 - $o
17 - $p
18 - $q
19 - $r
20 - $s
21 - $t
22 - $u
23 - $v
24 - $w
25 - $x
26 - $y
27 - $z
28 - $aa
29 - $ac
30 - $ad
31 - $af
32 - $ag
33 - $ah
34 - $am
35 - $as
36 - $pol

فونت شما آماده شد : $mtch[2] ♥

دقت کنید که فقط از متن های انگلیسی یا لاتین میتوانید استفاده کنید ." ,
'parse_mode'=>'MarkDown',
]);}
if(preg_match('~^معنی (.+)~s',$text,$match) and $match=$match[1]) {
preg_match('~<p class="">(.+?)</p>~si',file_get_contents('https://www.vajehyab.com/?q='.urlencode($match)),$p);
$p=trim(strip_tags(preg_replace(['~<[a-z0-9]+?>.+?</[a-z0-9]+?>|&.+?;~','~<br.+?>~s'],['',"\n"],$p[1])));
if($p)
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"کلمه اولیه : $match
 معنی: 
$p",'reply_to_message_id'=>$message_id, 'reply_markup'=>$or,]);
else
$bot = [
"خب بسه برو پنج دقه دیگه بیا 😐",
"مسخره کردی منو😕",
"نیست آقا ، خانم نیست 🤬",
];
$r = $bot[rand(0, count($bot)-1)];
bot('sendMessage',[
'chat_id' =>$chat_id,
'text' => "$r",
'reply_to_message_id'=>$message_id,
'reply_markup'=>$or,
]);}
//=== dev : @virtualdev ===\\
if($text=="دانستنی" or $text == "Bilmoq"){
$get = file_get_contents("http://api.novateamco.ir/danestani/");
$result = json_decode($get, true);
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"• دانستنی ~ ".$result['result']."\n💬 شماره : *".$result['code']."*",
'reply_to_message_id'=>$message_id,
'parse_mode'=>'MarkDown',
'reply_markup'=>$or,
]);}
//=== dev : @virtualdev ===\\
if(preg_match('/^(gif|گیف) (.*)/s', $text, $mtch)){
//===. dev : @virtualdev ===\\
$matn = strtoupper("$mtch[2]");
$bot = [
"https://www.flamingtext.com/net-fu/proxy_form.cgi?imageoutput=true&script=alien-glow-anim-logo&text=$matn&doScale=true&scaleWidth=240&scaleHeight=120",
"https://www.flamingtext.com/net-fu/proxy_form.cgi?imageoutput=true&script=flash-anim-logo&text=$matn&doScale=true&scaleWidth=240&scaleHeight=120",
"https://www.flamingtext.com/net-fu/proxy_form.cgi?imageoutput=true&script=shake-anim-logo&text=$matn&doScale=true&scaleWidth=240&scaleHeight=120",
"https://www.flamingtext.com/net-fu/proxy_form.cgi?imageoutput=true&script=highlight-anim-logo&text=$matn&doScale=true&scaleWidth=240&scaleHeight=120",
"https://www.flamingtext.com/net-fu/proxy_form.cgi?imageoutput=true&script=blue-fire&text=$matn&doScale=true&scaleWidth=240&scaleHeight=120",
"https://www.flamingtext.com/net-fu/proxy_form.cgi?imageoutput=true&script=burn-in-anim-logo&text=$matn&doScale=true&scaleWidth=240&scaleHeight=120",
"https://www.flamingtext.com/net-fu/proxy_form.cgi?imageoutput=true&script=whirl-anim-logo&text=$matn&doScale=true&scaleWidth=240&scaleHeight=120",
"https://www.flamingtext.com/net-fu/proxy_form.cgi?imageoutput=true&script=inner-fire-anim-logo&text=$matn&doScale=true&scaleWidth=240&scaleHeight=120",
"https://www.flamingtext.com/net-fu/proxy_form.cgi?imageoutput=true&script=glitter-anim-logo&text=$matn&doScale=true&scaleWidth=240&scaleHeight=120",
"https://www.flamingtext.com/net-fu/proxy_form.cgi?imageoutput=true&script=flaming-logo&text=$matn&doScale=true&scaleWidth=240&scaleHeight=120",
"https://www.flamingtext.com/net-fu/proxy_form.cgi?imageoutput=true&script=memories-anim-logo&text=$matn&doScale=true&scaleWidth=240&scaleHeight=120",
];
$r = $bot[rand(0, count($bot)-1)];
bot('senddocument',[
'chat_id'=>$chat_id,
'document'=>"$r",
'caption'=>"@$channel",
'reply_to_message_id'=>$message_id,
]);}
//-------
if($text == "me" or $text == "من" ){
$profile = "https://telegram.me/$username";
 bot('sendphoto',[
'chat_id' => $chat_id,
'photo'=>$profile,
'caption' =>"🔖 مشخصات شما:
🪅 شناسه شما: $from_id
🪅 شناسه گپ: $chat_id",
  'reply_markup'=>json_encode([
 'inline_keyboard'=>[
[['text'=>"🪄 یوزرنیم شما", "callback_data"=>"text"],['text'=>"@$username", "callback_data"=>"text"]],
[['text'=>"🪄 نام شما", "callback_data"=>"text"]],[['text'=>"$first_name $last_name", "callback_data"=>"text"]],
[['text'=>"💞 افزودن $name_bot به گروه 💞",'url'=>"https://t.me/$bottag?startgroup=new"]],]]) ]);}
//--------//////--------/////-----
if($text == "fal" or $text == "فال"){
$add = "http://www.beytoote.com/images/Hafez/".rand(1,149).".gif";
bot('sendphoto', [
'chat_id' => $chat_id,
'photo'=>$add,
'caption' =>"📜 فال شما ارسال شد!",
'reply_to_message_id'=>$message_id,
]); }
//=== dev : @virtualdev ===\\
if($text == "time" or $text == "ساعت" ){
bot('sendMessage',[
 'chat_id'=>$chat_id,
'text'=>date('H:i:s'),
 'reply_to_message_id'=>$message_id,
 ]); }

if($text == "جوک" or $text == "jok"){
$jok = file_get_contents("http://api.codebazan.ir/jok");
 bot('sendmessage',[
 'chat_id'=>$chat_id,
 'text'=>"
 ➖➖➖➖🤣➖➖➖➖
 
 $jok
 
 ➖➖➖➖➖➖➖➖➖
",
'reply_to_message_id'=>$message_id,
]); }
 
 if($text == "پسورد" or $text == "pass"){
 $passwordSaz = file_get_contents("http://api.codebazan.ir/password/?length=12");
 bot('sendmessage',[
 'chat_id'=>$chat_id,
 'text'=>"
 ➖➖➖➖🔐➖➖➖➖
 
 پسورد قدرتمند شما : $passwordSaz
 
 ➖➖➖➖➖➖➖➖➖
",
'reply_to_message_id'=>$message_id,
]); }
 
 if($text == "الکی مثلا" or $text == "fake"){
 $alakimasalan = file_get_contents("http://api.codebazan.ir/jok/alaki-masalan/");
 bot('sendmessage',[
 'chat_id'=>$chat_id,
 'text'=>"
 ➖➖➖➖💣➖➖➖➖
 
 $alakimasalan
 
 ➖➖➖➖➖➖➖➖➖
",
'reply_to_message_id'=>$message_id,
]); }

elseif(strpos($text,"/photo") !== false){
 $text = explode(" ",$text);
 $textn = $text['1'];
bot('sendphoto', [
'chat_id' => $chat_id,
 'photo'=>"https://assets.imgix.net/examples/clouds.jpg?blur=150&w=500&h=500&fit=crop&txt=$textn&txtsize=100&txtclr=ff2e4357&txtalign=middle,center&txtfont=Futura%20Condensed%20Medium&mono=ff6598cc",
 'caption'=>"☝️ لوگوی شما با نام $textn ساخته شد✅",
   'reply_to_message_id'=>$message_id,
 ]);
 }
}}
//=== dev : @virtualdev ===\\
if($text == "/panel"){
if($tc == "private" ){
if(in_array($chat_id,$admins)){
step($chat_id,"none");
 bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"💒 به پنل مدیریتی ربات خوش آمدید.",
 'parse_mode'=>"MarkDown",
  'reply_markup'=>json_encode([
 'inline_keyboard'=>[
//===. dev : @virtualdev ===\\
 [['text'=>"🪄 پاکسازی لیست انتظار 🪄",'callback_data'=>'delint']],
[['text'=>"📗 تایید اجباری کلمه : $yadauto",'callback_data'=>'setAuto']],
 [['text'=>"📊 آمار کلی",'callback_data'=>'stats'],['text'=>"🗑 حذف کلمه",'callback_data'=>'delkalame']],
 [['text'=>"❓ بلاک شخص",'callback_data'=>'black'],['text'=>"❔ آنبلاک شخص",'callback_data'=>'unblack']],
[['text'=>"📨 فوروارد به گروه ها",'callback_data'=>'forgp'],['text'=>"📨 فوروارد به کاربران",'callback_data'=>'foruser']],
[['text'=>"🗳 ارسال به گروه ها",'callback_data'=>'sendgp'],['text'=>"🗳 ارسال به کاربران",'callback_data'=>'senduser']],
[['text'=>"📮 ارسال به همه",'callback_data'=>'sendall'],['text'=>"📮 فوروارد به همه",'callback_data'=>'forall']],
[['text'=> "🖥 منوی استارت", 'callback_data'=>"back"]],]])
]); }}}
if($data == "stats" ){
$ex1 = explode("\n",$all_users);
$ex2 = explode("\n",$all_gaps);
$c1 = count($ex1)-1;
$c2 = count($ex2)-1;
$document = 'data/kalamat';
$scan = scandir($document);
$scan = array_diff($scan, ['.','..']);
$fil = count($scan);
$ca = count($admins);
bot('editMessagetext',[
 'chat_id'=>$chatid,
'message_id'=>$messageid,
 'text'=>"📊 آمار ربات شما:
 
🚻 کاربران: $c1
🛗 گروه ها: $c2
🛃 ادمین ها: $ca
🛄 کلمات: $fil",
 'parse_mode'=>"MarkDown",
  'reply_markup'=>json_encode([
            'inline_keyboard'=>[
                  [['text'=>"🪄 پاکسازی لیست انتظار 🪄",'callback_data'=>'delint']],
[['text'=>"📗 تایید اجباری کلمه : $yadauto",'callback_data'=>'setAuto']],
            [['text'=>"📊 آمار کلی",'callback_data'=>'stats'],['text'=>"🗑 حذف کلمه",'callback_data'=>'delkalame']],
          [['text'=>"❓ بلاک شخص",'callback_data'=>'black'],['text'=>"❔ آنبلاک شخص",'callback_data'=>'unblack']],
         [['text'=>"📨 فوروارد به گروه ها",'callback_data'=>'forgp'],['text'=>"📨 فوروارد به کاربران",'callback_data'=>'foruser']],
         [['text'=>"🗳 ارسال به گروه ها",'callback_data'=>'sendgp'],['text'=>"🗳 ارسال به کاربران",'callback_data'=>'senduser']],
         [['text'=>"📮 ارسال به همه",'callback_data'=>'sendall'],['text'=>"📮 فوروارد به همه",'callback_data'=>'forall']],
         [['text'=> "🖥 منوی استارت", 'callback_data'=>"back"]],
  ]
        ])
 ]); }
if($data == "back_p" ){
step($chatid,"none");
bot('editMessagetext',[
 'chat_id'=>$chatid,
'message_id'=>$messageid,
 'text'=>"💒 به منوی اصلی پنل مدیریت بازگشتید!",
 'parse_mode'=>"MarkDown",
  'reply_markup'=>json_encode([
            'inline_keyboard'=>[
[['text'=>"🪄 پاکسازی لیست انتظار 🪄",'callback_data'=>'delint']],
[['text'=>"📗 تایید اجباری کلمه : $yadauto",'callback_data'=>'setAuto']],
[['text'=>"📊 آمار کلی",'callback_data'=>'stats'],['text'=>"🗑 حذف کلمه",'callback_data'=>'delkalame']],
[['text'=>"❓ بلاک شخص",'callback_data'=>'black'],['text'=>"❔ آنبلاک شخص",'callback_data'=>'unblack']],
[['text'=>"📨 فوروارد به گروه ها",'callback_data'=>'forgp'],['text'=>"📨 فوروارد به کاربران",'callback_data'=>'foruser']],
[['text'=>"🗳 ارسال به گروه ها",'callback_data'=>'sendgp'],['text'=>"🗳 ارسال به کاربران",'callback_data'=>'senduser']],
[['text'=>"📮 ارسال به همه",'callback_data'=>'sendall'],['text'=>"📮 فوروارد به همه",'callback_data'=>'forall']],
[['text'=> "🖥 منوی استارت", 'callback_data'=>"back"]],]]) ]); }
elseif($data == "setAuto" ){
if($yadauto == "✅"){
file_put_contents("data/autoYAD.txt","⬜");}
if($yadauto == "⬜"){
file_put_contents("data/autoYAD.txt","✅");}
bot('editMessagetext',[
 'chat_id'=>$chatid,
'message_id'=>$messageid,
 'text'=>$textt,
 'parse_mode'=>"MarkDown",
  'reply_markup'=>json_encode([
            'inline_keyboard'=>[
                  [['text'=>"🪄 پاکسازی لیست انتظار 🪄",'callback_data'=>'delint']],
[['text'=>"📗 تایید اجباری کلمه : $yadauto",'callback_data'=>'setAuto']],
                  [['text'=>"📊 آمار کلی",'callback_data'=>'stats'],['text'=>"🗑 حذف کلمه",'callback_data'=>'delkalame']],
                  [['text'=>"❓ بلاک شخص",'callback_data'=>'black'],['text'=>"❔ آنبلاک شخص",'callback_data'=>'unblack']],
         [['text'=>"📨 فوروارد به گروه ها",'callback_data'=>'forgp'],['text'=>"📨 فوروارد به کاربران",'callback_data'=>'foruser']],
                  [['text'=>"🗳 ارسال به گروه ها",'callback_data'=>'sendgp'],['text'=>"🗳 ارسال به کاربران",'callback_data'=>'senduser']],
                  [['text'=>"📮 ارسال به همه",'callback_data'=>'sendall'],['text'=>"📮 فوروارد به همه",'callback_data'=>'forall']],
                  [['text'=> "🖥 منوی استارت", 'callback_data'=>"back"]],
              ]
        ])
]); 
bot('answercallbackquery', [
        'callback_query_id' => $update->callback_query->id,
        'text' => "✅ تغییرات انجام شد.",
        'show_alert' => false
    ]);}
if($data == "delint"){
deletefolder("data/int");
bot('answercallbackquery', [
        'callback_query_id' => $update->callback_query->id,
        'text' => "🗑️ لیست انتظار پاکسازی شد!",
        'show_alert' => true
    ]);}
//=== dev : @virtualdev ===\\
if($data == "forall" ){
step($chatid,"forall");
bot('editMessagetext',[
 'chat_id'=>$chatid,
'message_id'=>$messageid,
 'text'=>"📥 پیام را فوروارد کنید:",
 'parse_mode'=>"MarkDown",
  'reply_markup'=>json_encode([
            'inline_keyboard'=>[[['text'=>"🏛 منوی اصلی️",'callback_data'=>'back_p']],]])
]); }
elseif($user['step'] == "forall"  && $tc == "private"){
if($tc == "private" && in_array($chat_id,$admins)){
 bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"📳 در حال انجام، لطفا صبر کنید ...",
 'parse_mode'=>"MarkDown",
 ]); 
      $ex = explode("\n",$all_users);
    foreach($ex as $key){
bot('ForwardMessage',[
'chat_id'=>$key,
'from_chat_id'=>$chat_id,
'message_id'=>$message_id
]);}
 $exs = explode("\n",$all_gaps);
          foreach($exs as $key){
 bot('ForwardMessage',[
'chat_id'=>$key,
'from_chat_id'=>$chat_id,
'message_id'=>$message_id
]);}
bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"📑 پیام برای همه فوروارد شد!",
 'parse_mode'=>"MarkDown",
  'reply_markup'=>json_encode([
            'inline_keyboard'=>[
                  [['text'=>"🏛 منوی اصلی️",'callback_data'=>'back_p']],
              ]
       ]) ]);  } }
	if($data == "sendall" ){
step($chatid,"sendall");
bot('editMessagetext',[
 'chat_id'=>$chatid,
'message_id'=>$messageid,
 'text'=>"📥 پیام را ارسال کنید:",
 'parse_mode'=>"MarkDown",
  'reply_markup'=>json_encode([
            'inline_keyboard'=>[
                  [['text'=>"🏛 منوی اصلی️",'callback_data'=>'back_p']],
              ]
        ]) ]); }

	elseif($user['step'] == "sendall"  && $tc == "private"){
	if($tc == "private" && in_array($chat_id,$admins)){
	 bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"📳 در حال انجام، لطفا صبر کنید ...",
 'parse_mode'=>"MarkDown",
	 ]); 
                $ex = explode("\n",$all_users);
               foreach($ex as $key){
 bot('sendMessage',[
 'chat_id'=>$key,
 'text'=>$text,
   'disable_web_page_preview'=>true,
]);}
$exs = explode("\n",$all_gaps);
            foreach($exs as $key){
bot('sendMessage',[
 'chat_id'=>$key,
 'text'=>$text,
   'disable_web_page_preview'=>true,
]);}
bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"📑 پیام برای همه ارسال شد!",
 'parse_mode'=>"MarkDown",
  'reply_markup'=>json_encode([
            'inline_keyboard'=>[
                  [['text'=>"🏛 منوی اصلی️",'callback_data'=>'back_p']],
              ]
        ]) ]);  } }
	if($data == "senduser" ){
step($chatid,"senduser");
bot('editMessagetext',[
 'chat_id'=>$chatid,
'message_id'=>$messageid,
 'text'=>"📥 پیام را ارسال کنید:",
 'parse_mode'=>"MarkDown",
  'reply_markup'=>json_encode([
            'inline_keyboard'=>[
                  [['text'=>"🏛 منوی اصلی️",'callback_data'=>'back_p']],
              ]
        ]) ]); }
	elseif($user['step'] == "senduser"  && $tc == "private"){
	if($tc == "private" && in_array($chat_id,$admins)){
	 bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"📳 در حال انجام، لطفا صبر کنید ...",
 'parse_mode'=>"MarkDown",
	 ]); 
     $ex = explode("\n",$all_users);
      foreach($ex as $key){
  bot('sendMessage',[
 'chat_id'=>$key,
 'text'=>$text,
   'disable_web_page_preview'=>true,
	]);}
bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"📑 پیام به همه کاربران ارسال شد!",
 'parse_mode'=>"MarkDown",
  'reply_markup'=>json_encode([
            'inline_keyboard'=>[
                  [['text'=>"🏛 منوی اصلی️",'callback_data'=>'back_p']],
              ]  ]) ]);  } }
if($data == "sendgp" ){
step($chatid,"sendgp");
bot('editMessagetext',[
 'chat_id'=>$chatid,
'message_id'=>$messageid,
 'text'=>"📥 پیام را ارسال کنید:",
 'parse_mode'=>"MarkDown",
  'reply_markup'=>json_encode([
            'inline_keyboard'=>[
                  [['text'=>"🏛 منوی اصلی️",'callback_data'=>'back_p']],
  ]
  ])
 ]); }
//=== .dev : @virtualdev ===\\

elseif($user['step'] == "sendgp"  && $tc == "private"){
if($tc == "private" && in_array($chat_id,$admins)){
 bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"📳 در حال انجام، لطفا صبر کنید ...",
 'parse_mode'=>"MarkDown",
	 ]); 
 $ex = explode("\n",$all_gaps);
 foreach($ex as $key){
 bot('sendMessage',[
 'chat_id'=>$key,
 'text'=>$text,
   'disable_web_page_preview'=>true,
	]);}
bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"📑 پیام به همه گروه ها ارسال شد!",
 'parse_mode'=>"MarkDown",
  'reply_markup'=>json_encode([
            'inline_keyboard'=>[
                  [['text'=>"🏛 منوی اصلی️",'callback_data'=>'back_p']],
              ] ]) ]);  } }
if($data == "foruser" ){
step($chatid,"foruser");
bot('editMessagetext',[
 'chat_id'=>$chatid,
'message_id'=>$messageid,
 'text'=>"📥 پیام را فوروارد کنید:",
 'parse_mode'=>"MarkDown",
  'reply_markup'=>json_encode([
            'inline_keyboard'=>[
                  [['text'=>"🏛 منوی اصلی️",'callback_data'=>'back_p']],
              ] ]) ]); }
elseif($user['step'] == "foruser"  && $tc == "private"){
if($tc == "private" && in_array($chat_id,$admins)){
bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"📳 در حال انجام، لطفا صبر کنید ...",
 'parse_mode'=>"MarkDown", ]); 
   $ex = explode("\n",$all_users);
   foreach($ex as $key){
   bot('ForwardMessage',[
'chat_id'=>$key,
'from_chat_id'=>$chat_id,
'message_id'=>$message_id
]);}
bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"📑 پیام به همه کاربران فوروارد شد!",
 'parse_mode'=>"MarkDown",
  'reply_markup'=>json_encode([
            'inline_keyboard'=>[
    [['text'=>"🏛 منوی اصلی️",'callback_data'=>'back_p']],
              ] ]) ]);  } }
if($data == "forgp" ){
step($chatid,"forgp");
bot('editMessagetext',[
 'chat_id'=>$chatid,
'message_id'=>$messageid,
 'text'=>"📥 پیام را فوروارد کنید:",
 'parse_mode'=>"MarkDown",
  'reply_markup'=>json_encode([
            'inline_keyboard'=>[
                  [['text'=>"🏛 منوی اصلی️",'callback_data'=>'back_p']],
              ]
        ]) ]); }
elseif($user['step'] == "forgp"  && $tc == "private"){
if($tc == "private" && in_array($chat_id,$admins)){
bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"📳 در حال انجام، لطفا صبر کنید ...",
 'parse_mode'=>"MarkDown",
 ]); 
  $ex = explode("\n",$all_gaps);
  foreach($ex as $key){
  bot('ForwardMessage',[
'chat_id'=>$key,
'from_chat_id'=>$chat_id,
'message_id'=>$message_id
]);}
bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"📑 پیام به همه گروه ها فوروارد شد!",
 'parse_mode'=>"MarkDown",
  'reply_markup'=>json_encode([
            'inline_keyboard'=>[
                  [['text'=>"🏛 منوی اصلی️",'callback_data'=>'back_p']],
              ]
       ]) ]);  } }
//=== dev : @virtualdev ===\\

if($data == "unblack" ){
step($chatid,"unblack");
bot('editMessagetext',[
 'chat_id'=>$chatid,
'message_id'=>$messageid,
 'text'=>"🎓 شناسه کاربر را ارسال کنید:",
 'parse_mode'=>"MarkDown",
  'reply_markup'=>json_encode([
            'inline_keyboard'=>[
                  [['text'=>"🏛 منوی اصلی️",'callback_data'=>'back_p']],
              ]
        ]) ]); }

elseif($user['step'] == "unblack"  && $tc == "private"){
if($tc == "private" && in_array($chat_id,$admins)){
$tt = time();
file_put_contents("data/spam/$text.txt",$tt);
bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"🗑️ کاربر از بلاک لیست خارج شد!",
 'parse_mode'=>"MarkDown",
  'reply_markup'=>json_encode([
            'inline_keyboard'=>[
                  [['text'=>"🏛 منوی اصلی️",'callback_data'=>'back_p']],
              ]
        ]) ]); 
 bot('sendMessage',[
 'chat_id'=>$text,
 'text'=>"♥️ شما توسط مدیریت از لیست بلاک خارج شدید!",
 'parse_mode'=>"MarkDown",
	 ]);  } }
if($data == "black" ){
step($chatid,"black");
bot('editMessagetext',[
 'chat_id'=>$chatid,
'message_id'=>$messageid,
 'text'=>"🎓 شناسه کاربر را ارسال کنید:",
 'parse_mode'=>"MarkDown",
  'reply_markup'=>json_encode([
            'inline_keyboard'=>[
                  [['text'=>"🏛 منوی اصلی️",'callback_data'=>'back_p']],
              ]
       ]) ]); }
elseif($user['step'] == "black"  && $tc == "private"){
if($tc == "private" && in_array($chat_id,$admins)){
$tt = time() + 9999999999999999999;
file_put_contents("data/spam/$text.txt",$tt);
bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"🛡️ کاربر از ربات بلاک شد!",
 'parse_mode'=>"MarkDown",
  'reply_markup'=>json_encode([
            'inline_keyboard'=>[
                  [['text'=>"🏛 منوی اصلی️",'callback_data'=>'back_p']],
              ]
       ]) ]); 
 bot('sendMessage',[
 'chat_id'=>$text,
 'text'=>"💬 شما توسط مدیریت از ربات مسدود شدید!",
 'parse_mode'=>"MarkDown",
 ]);  } }
if($data == "delkalame" ){
step($chatid,"delkalame");
bot('editMessagetext',[
 'chat_id'=>$chatid,
'message_id'=>$messageid,
 'text'=>"🎓 کلمه مورد نظر را ارسال کنید:",
 'parse_mode'=>"MarkDown",
  'reply_markup'=>json_encode([
            'inline_keyboard'=>[
                  [['text'=>"🏛 منوی اصلی️",'callback_data'=>'back_p']],
              ]
      ]) ]); }
elseif($user['step'] == "delkalame"  && $tc == "private"){
if($tc == "private" && in_array($chat_id,$admins)){
if(file_exists("data/kalamat/$text.txt")){
unlink("data/kalamat/$text.txt");
bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"🗑️ کلمه ارسالی از لیست ربات حذف شد!",
 'parse_mode'=>"MarkDown",
  'reply_markup'=>json_encode([
            'inline_keyboard'=>[ [['text'=>"🏛 منوی اصلی️",'callback_data'=>'back_p']],
 ]
       ])
 ]); 
}else{
bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"🎓 این کلمه از قبل در ربات ثبت نشده!",
 'parse_mode'=>"MarkDown",
  'reply_markup'=>json_encode([
            'inline_keyboard'=>[[['text'=>"🏛 منوی اصلی️",'callback_data'=>'back_p']], ]  ]) ]);  } }}
?>