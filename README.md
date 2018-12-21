# DFA

<br>��Ч���������дʹ��ˣ��ִ���� (�ڸ����ĳ��ôʿ�)
### ����
  ��ѹ��������WEB������Ŀ¼��   
  example: /var/www/html   or /htdoc

###  ʹ�÷���
 ```
require_once 'Dfa.Class.php';

$content = '�Զ����ı�';

$dfa = new DFA($content);

$dfa->filePath = 'sensive_word_demo_1.xml';	//�ʿ�·��
$dfa->fileType = 2;							//�ʿ�����

//$res = $dfa->splitWithKeyWord($content);	//dfa�ִ�
$res = $dfa->replaceKeyWord($content);    	//���˴�

var_dump($res);
```

### ����

Ŀǰ֧��TXT��XML���ִʿ�ṹ
```
    public $filePath = 'sensive_word_demo_1.xml';
//    public $filePath = 'sensive_word_demo_2.txt';
    public $fileType = '2'; //  ��ѡ 1.txt  2.xml    ( Txt�ո�ָ���Xml ����Excelת��, Xml���дʴ���ڵ�һ�ű���һ���� )
```

###example��
#####ԭ�ģ�
```
���ռ����������һ�� �ձ�����Ⱥ�� -����Ů��
˵��Դ�ͳ�ձ�Ů�Ե�ӡ���������Ǵ���Ư���ĺͷ��ͻ��ž��µ�ױ�ݣ��Լ���ʱ�޿�͸¶�������ŵ����ʡ��ܶ�����£����Ƕ�������һЩӰ����Ʒ������Ϸ�п�������Ů�ӣ����Ǳ�ͳ��Ϊ���ռ���������Ҳ���Ǵ����ձ�Ů�ԵĹ��⡣


���Ρ������˸���Ľ�ɫ �` ���

�������У����ˡ��ֱ����˴�ͳ������÷����ȿɴ���Ů�����������ߣ���ɴ���Ů���Թ����ߡ����ռ˵ġ��ˡ���ָǰ�ߣ���Ϊ�ռ���ԭ���������������ߣ����������Խ��ס������ִ��������ѡ��ˡ���ֱ���������Խ��׷��棬��˲����ˡ��ռ��������Աܻ�ΪĿ�ĵ��ִ������뷨��

���ձ�����ʷ�ϣ�����ôһȺ���ݽ綨�ǳ�ģ����Ů�ӣ�����һ���汻��Ϊ�Գ���������ı���ĵ��½ײ㣬����һ����������ͨ�����ִ�ͳ���衢ʫ�顢����Ͳ廭�ȼ��ա����ǲ�����������֪�ġ��ռ��������Ǳ���Ϊ��Ϊ��΢�ġ���Ů����



���ձ��ĹŴ�����Щ����ƶ����Ů��Ϊ�˻���ȥ����Ϊ����Ů���������Լ���������ʱ��ı�Ǩ�����ԡ���Ů�����Ļ�����Ҫ����������࣬Ψ�о����Ͻ���ѵ����������ϯ��һЩ�󳡺ϵ��н��б��ݣ���Щ��ͥ������Ů����Ϊ�ռ�Ϊ�١�

����Ů�����ݲ�ͬʱ�����й��ܶ��ֽз����硸����Ů�������������ӡ���������Ů�������ξ����ȡ�����߼����ռ��򱻳�Ϊ��̫�򡹣�����ʱ�����֮Ϊ���������������ǵĲ��վ����ȡ��ռ���ѷɫ�����ڽ�Ϊƽ�񻯵Ļ��������ù����ġ���Ů�������õ깤���ġ���ʢŮ���Լ��ڽ�ͷ�������˵ġ�ҹӥ����


����ò����̫��

��������Ļ��ʱ�ڣ�Դ�����������ˡ���Ů�𵱡�ְ֮����ͳһ��������Ů��������Ļ�������á���Ǿ֡������Ժ��˰�Ի�����������ԡ���Ů��Ҳ���ˡ������������ǡ��ĳƺš�����Ů���Ӽ�֮���ǡ����������� 17 ����ʱ����������������ԭ�뽭���ļ�ԭ���ձ�����������ȡ�


1897 ��ļ�ԭ

�߼�����Ů��һ�㶼���Ź��˵Ĳ��գ��в��ֵĸ�����ѧ��Ů������ƽ��ʱ���ġ���Ů�����Ǵ󲿷ֶ��������������ҡ���ʱ�ձ��������������ʱ��ͻȻҪ�������ԡ�������Ϊ�ⴴ���͸裬��ʱ���ڳ��ġ���Ů�����̸���һ�׽���ʱ���Ϊ���ϵ�ϼ�ʵĸ裬���������˵��ʹ�����һ�������ۣ��ڳ�Ҳ�׷��������Ĳ�ò˫ȫ���ɼ�����Ů���ĵ�λ�ڵ�ʱ�������ء�

�����ִ�������Ů�����������������ռ���������������ǵĹ�����Ȼ�����ڸ�����ѧӰ����Ʒ���У������Ǽǵ�������Թ��ġ���Ů��ʱ����
```

#####�ִ�Ч����(splitWithKeyWord)
![image](https://github.com/MissPP/dfaFilter/raw/master/assets/images/filter0.png)
#####�������д�Ч����(replaceKeyWord)
![image](https://github.com/MissPP/dfaFilter/raw/master/assets/images/filter1.png)

#####�ײ⣺���ػ���ִ�mapЧ�ʱȽ��Դ������������� ������ʮ�����ٱ�����
 



######��ӭPR�����鷴������ӭ��ϵQQ��565378270
