# hanzi-text-shori
乱七八糟
なんでもあるところ

##文字処理ユティリティ

###han2zen.php
テキストファイルの半角かなと全角英数字を全角かなと半角全数字に変更できます。  
例：
```
php han2zen.php genkai.txt
```
変換したファイルは「HANKAKU_元ファイル名」で保存します。

###num_gen1.php

例：
```
php num_gen1.php data.txt
```
生成したファイル名は「done_元ファイル名」です。　　

###num_gen2.php

```
php num_gen2.php data.txt
```
###chise-ids-json-gen

####idsdownloader

[chise-ids](http://git.chise.org/gitweb/?p=chise/ids.git;a=tree)の以下のファイルダウンロードして整形できます。
* IDS-UCS-Basic.txt
* IDS-UCS-Ext-A.txt
* IDS-UCS-Ext-B-1.txt
* IDS-UCS-Ext-B-2.txt
* IDS-UCS-Ext-B-3.txt
* IDS-UCS-Ext-B-4.txt
* IDS-UCS-Ext-B-5.txt
* IDS-UCS-Ext-B-6.txt
* IDS-UCS-Ext-C.txt
* IDS-UCS-Ext-D.txt
* IDS-UCS-Ext-E.txt

####csv2json.php

[g0v/z0y](https://github.com/g0v/z0y)の[idsdata](https://github.com/g0v/z0y/tree/master/node_modules/idsdata)モジュール用の`rawdata.js`ファイルを作成します。

## License

The hanzi-text-shori is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).