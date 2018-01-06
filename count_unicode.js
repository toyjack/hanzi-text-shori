// copyright LIU Guanwei

let fs = require('fs')
let _ = require('lodash')
let codePoint = require('code-point')


const cjk_start = parseInt("4E00",16),
    cjk_end = parseInt("9FD5",16),
    extA_start = parseInt("3400",16),
    extA_end = parseInt("4DBF",16),
    extB_start = parseInt("20000",16),
    extB_end = parseInt("2A6FF",16),
    extC_start = parseInt("2A700",16),
    extC_end = parseInt("2B734",16),
    extD_start = parseInt("2B740",16),
    extD_end = parseInt("2B81F",16),
    extE_start = parseInt("2B820",16),
    extE_end = parseInt("2CEAF",16),
    extF_start = parseInt("2CEB0",16),
    extF_end = parseInt("2EBE0",16);


function checkext(cp) {
    if (cp >= cjk_start && cp <= cjk_end) {
        return "CJK";
    } else if (cp >= extA_start && cp <= extA_end) {
        return "Ext.A";
    }else
    if (cp >= extB_start && cp <= extB_end) {
        return "Ext.B";
    }else
    if (cp >= extC_start && cp <= extC_end) {
        return "Ext.C";
    }else
    if (cp >= extD_start && cp <= extD_end) {
        return "Ext.D";
    }else
    if (cp >= extE_start && cp <= extE_end) {
        return "Ext.E";
    }else
    if (cp >= extF_start && cp <= extF_end) {
        return "Ext.F";
    }else{
        return "Not CJK";
    }
}

function countArr(arr){
    let counts={
        'CJK':0,
        'Ext.A':0,
        'Ext.B':0,
        'Ext.C':0,
        'Ext.D':0,
        'Ext.E':0,
        'Ext.F':0,
        'Not CJK':0,
        'nocjk':[]
    }
    let nocjk=[]
    for (let i = 0; i <arr.length; i++) {
        let temp=checkext(arr[i])
        counts[temp]++
        if(temp=="Not CJK"){
            counts['nocjk'].push(arr[i].toString(16))
        }
    }
    return counts;
}

fs.readFile(process.argv[2], "utf-8", (error, data) => {
    if (error) {
        return;
    }
    let data_arr = data.toString().split("\r\n");
    let data_uniq= _.uniq(data_arr);
    let cp=[]
    let cp_uniq=[]
    data_arr.forEach(function(element){
        cp.push(codePoint(element))
    })
    data_uniq.forEach(function(element){
        cp_uniq.push(codePoint(element))
    })


    let result=countArr(cp)
    let resultUniq=countArr(cp_uniq)

    console.log('延べ数:\n',result)
    console.log('異なり数:\n',resultUniq)
});