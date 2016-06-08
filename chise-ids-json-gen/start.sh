#!/bin/bash

filenames=(
    "IDS-UCS-Basic.txt"
    "IDS-UCS-Ext-A.txt"
    "IDS-UCS-Ext-B-1.txt"
    "IDS-UCS-Ext-B-2.txt"
    "IDS-UCS-Ext-B-3.txt"
    "IDS-UCS-Ext-B-4.txt"
    "IDS-UCS-Ext-B-5.txt"
    "IDS-UCS-Ext-B-6.txt"
    "IDS-UCS-Ext-C.txt"
    "IDS-UCS-Ext-D.txt"
    "IDS-UCS-Ext-E.txt"
)


for filename in ${filenames[@]};do
curl  "http://git.chise.org/gitweb/?p=chise/ids.git;a=blob_plain;f=${filename};hb=HEAD" > ${filename}
sed -e '1d' ./${filename} > ./${filename}.txt #最初の一行を削除
rm ./${filename}
mv ./${filename}.txt ./${filename}
done

cat ${filenames[@]} > IDS.txt

rm ${filenames[@]}

#for sed with Mac 改行しなきゃ（汗　http://unix.stackexchange.com/questions/52131/sed-on-osx-insert-at-a-certain-line
sed -e '1i\
Unicode	Entry	IDS' ./IDS.txt > ./IDS_done.txt

#重複行を削除する　http://qiita.com/arcizan/items/9cf19cd982fa65f87546
# awk '!a[$0]++' ./IDS_done.txt


awk '!x[$0]++' IDS_done.txt > Chise-IDS.txt


rm ./IDS.txt ./IDS_done.txt
