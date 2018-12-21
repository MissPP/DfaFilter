<?php

class DFA
{
    public $arrHashMap = [];
    public $filePath = 'sensive_word_demo_1.xml';
//    public $filePath = 'chinese_word_list.txt';
    public $fileType = '2'; //  可选 1.txt  2.xml    ( Txt空格分隔，Xml 可用Excel转换, Xml敏感词存放于第一张表第一列中 )
    public $keyWord = [];
    public $content = '';

    public function __construct($content) {
        $this->content = $content;
        $this->keyWord = $this->getKeyWord();
//        echo "关键字总数量:".count($this->keyWord)."<br>".PHP_EOL;
        foreach ($this->keyWord as $k => $v) {
            $this->addKeyWord($v);
        }
    }

    public function getKeyWord() {
        $data = [];
        //txt文件读取
        if (1 == $this->fileType) {
            $str = file_get_contents($this->filePath);

            $eol = array("\r\n", "\n", "\r");
            $str = str_replace($eol, '', $str);
            $data = explode(' ', $str);
            $this->utf8_encoding($data);

        } else if (2 == $this->fileType) {
            //xml文件读取
            require_once 'PHPExcel/Classes/PHPExcel.php';
            require_once 'PHPExcel/Classes/PHPExcel/IOFactory.php';
            $objReader = PHPExcel_IOFactory::createReader('Excel2003XML');
            $objPHPExcel = $objReader->load($this->filePath);
            $sheet = $objPHPExcel->getSheet(0);

            $highestRowNum = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();
            $highestColumnNum = PHPExcel_Cell::columnIndexFromString($highestColumn);

            $filed = array();
            for ($i = 0; $i < $highestColumnNum; $i++) {
                $cellName = PHPExcel_Cell::stringFromColumnIndex($i) . '1';
                $cellVal = $sheet->getCell($cellName)->getValue();//取得列内容
                $filed [] = $cellVal;
            }

            for ($i = 1; $i <= $highestRowNum; $i++) {
                for ($j = 0; $j < $highestColumnNum; $j++) {
                    $cellName = PHPExcel_Cell::stringFromColumnIndex($j) . $i;
                    $cellVal = $sheet->getCell($cellName)->getValue();
                    $data[] = $cellVal;
                }
            }
        }

        $this->utf8_encoding($data);
        return $data;
    }

    public function utf8_encoding(&$arr) {
        foreach ($arr as $k => &$v) {
            if (!mb_detect_encoding($v, 'utf-8', true)) {
                $v = iconv('gbk', 'utf-8', $v);
            } else {
                //TODO if the encoding is utf-8
            }
        }
    }

    public function getHashMap() {
        echo json_encode($this->arrHashMap);
    }

    // 分隔字的索引存在 end = 1 不存在 end = 0
    public function addKeyWord($strWord) {
        $len = mb_strlen($strWord, 'UTF-8');

        $arrHashMap = &$this->arrHashMap;
        for ($i = 0; $i < $len; $i++) {
            $word = mb_substr($strWord, $i, 1, 'UTF-8');

            if (isset($arrHashMap[$word])) {
                if ($i == ($len - 1)) {
                    $arrHashMap[$word]['end'] = 1;
                }
            } else {
                if ($i == ($len - 1)) {
                    $arrHashMap[$word] = [];
                    $arrHashMap[$word]['end'] = 1;
                } else {
                    $arrHashMap[$word] = [];
                    $arrHashMap[$word]['end'] = 0;
                }
            }
            $arrHashMap =  &$arrHashMap[$word]; //origin
        }
    }

    public function splitWithKeyWord($strWord, $isAllowDuplicate = 1) {
        $len = mb_strlen($strWord, 'UTF-8');
        $arrHashMap = $this->arrHashMap;
        $allBadWord = [];
        $badWord = '';
        for ($i = 0; $i < $len; $i++) {
            $word = mb_substr($strWord, $i, 1, 'UTF-8');

            if (!isset($arrHashMap[$word])) {
                // reset hashmap
                $arrHashMap = $this->arrHashMap;
                if (!empty($badWord)) $i--;
                $badWord = '';
                continue;
            } else {
                $badWord .= $word;
            }

            if ($arrHashMap[$word]['end']) {
                if ($isAllowDuplicate || !in_array($badWord, $allBadWord)) {
                    $allBadWord[] = $badWord;
                }
                $result = true;
            }
            $arrHashMap = $arrHashMap[$word];
        }
        return $allBadWord;
    }

    public function replaceKeyWord($strWord, $replace = '*') {
        $len = mb_strlen($strWord, 'UTF-8');
        $arrHashMap = $this->arrHashMap;

        $content = '';
        $badWord = '';
        $repeatCount = [];
        for ($i = 0; $i < $len; $i++) {
            $word = mb_substr($strWord, $i, 1, 'UTF-8');

            if (!in_array($i, $repeatCount)) {
                $content .= $word;
            }

            $repeatCount[] = $i;

            if (!isset($arrHashMap[$word])) {
                // reset hashmap
                $arrHashMap = $this->arrHashMap;
                if (!empty($badWord)) $i--;
                $badWord = '';
                continue;
            } else {
                $badWord .= $word;
            }

            if ($arrHashMap[$word]['end']) {
                $badWordLength = mb_strlen($badWord);
                $contentLentgh = mb_strlen($content);

                $content = mb_substr($content, 0, $contentLentgh - $badWordLength, 'UTF-8');

                $replaceContent = '';
                for ($b = 0; $b < $badWordLength; $b++) {
                    $replaceContent .= $replace;
                }
                $content .= $replaceContent;
            }
            $arrHashMap = $arrHashMap[$word];
        }
        return $content;
    }

    public function origin($content) {
        $count = [];
        foreach ($this->keyWord as $k => $v) {
            if (strpos($content, $v) > 0) {
                $count[] = $v;
            }
        }
        return $count;
    }
}




