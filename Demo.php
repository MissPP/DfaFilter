<?php
ini_set('memory_limit', '512M');
set_time_limit(0);
require_once 'Dfa.Class.php';
//demo
$content = '「艺伎」以外的另一个 日本特殊群体 -「游女」
说起对传统日本女性的印象，她们总是穿着漂亮的和服和画着精致的妆容，以及无时无刻透露出的优雅的气质。很多情况下，我们都可以在一些影视作品或者游戏中看见这类女子，她们被统称为「艺伎」。她们也曾是代表日本女性的国粹。


手游《第五人格》里的角色 ー 红蝶

在日语中，「妓」字保留了传统汉语的用法，既可代表女性艺术表演者，亦可代表女性性工作者。而艺妓的「妓」是指前者，因为艺妓在原则上是艺术表演者，并不从事性交易。但在现代中文里，多把「妓」字直觉关联到性交易方面，因此才有了「艺伎」这种以避讳为目的的现代中文译法。

在日本的历史上，有那么一群身份界定非常模糊的女子，她们一方面被视为以出卖肉体来谋生的低下阶层，但另一方面她们又通晓各种传统歌舞、诗书、茶道和插画等技艺。她们并不是我们熟知的「艺伎」，而是被认为较为卑微的「游女」。



在日本的古代，有些出身贫困的女子为了活下去而成为「游女」来养活自己。但随着时间的变迁，社会对「游女」的文化素质要求提高了许多，唯有经过严谨的训练才能在宴席或一些大场合当中进行表演，有些家庭更会以女儿成为艺技为荣。

「游女」根据不同时代曾有过很多种叫法，如「游行女妇」、「白拍子」、「傀儡女」、「游君」等。而最高级的艺技则被称为「太夫」（江户时代亦称之为「花魁」），她们的才艺绝不比「艺技」逊色。至于较为平民化的还有在澡堂工作的「汤女」和在旅店工作的「饭盛女」以及在街头招揽客人的「夜鹰」。


年轻貌美的太夫

到了镰仓幕府时期，源赖朝更设置了「游女别当」之职，以统一管理「游女」。室畔幕府则设置「倾城局」，向妓院征税以缓解财困，所以「游女」也有了「倾国」、「倾城」的称号。「游女」居集之地是「游廓」，在 17 世纪时，大阪的新町、京都岛原与江户的吉原是日本三大官许游廊。


1897 年的吉原

高级「游女」一般都有着过人的才艺，有部分的更是文学才女。其中平安时代的「游女」更是大部分都出身于书香世家。当时日本宇多天皇宴请宾客时，突然要求众人以「鸟养」为题创作和歌，这时候在场的「游女」立刻赋了一首将天皇比喻为天上的霞彩的歌，天皇听后高兴的赏赐了她一件白内袍，众臣也纷纷赞赏她的才貌双全，可见「游女」的地位在当时颇受尊重。

到了现代，「游女」的名气渐渐被「艺伎」所替代，但她们的故事仍然出现在各大文学影视作品当中，让人们记得曾经光辉过的「游女」时代。 ';

$dfa = new DFA($content);
$start = microtime(true);
$dfa->filePath = 'sensive_word_demo_1.xml';	//词库路径
$dfa->fileType = 2;							//词库类型
$res = $dfa->splitWithKeyWord($content);//dfa分词
//$res = $dfa->replaceKeyWord($content);    //过滤词
//$res = $dfa->origin($content);          //普通strpos分词

$len = mb_strlen($content);
echo "<br>文章总长度:$len<br><br>";

$end = microtime(true);

var_dump($res);

$usedTime = $end - $start;
echo "<br><br>总耗时:$usedTime<br>";



