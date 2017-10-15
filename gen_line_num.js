// nodejs
// write by LIU Guanwei
//
// use: node num.js data.txt
// outpu: output.txt
//
// function:
// turn data from
// AAA              1
// AAA              2
// BBB          to  1
// CCC              1
// CCC              2

var fs=require('fs')

fs.readFile(process.argv[2],"utf-8",(error,data)=>{
    if (error){
        return;
    }
    var data_arr=data.toString().split("\r\n")
    var count=1;
    var results=[];
    for(var i=1;i<data_arr.length;i++){
        if (data_arr[i]==data_arr[i+1]){
            results.push(count.toString())
            count++
        }else{
            results.push(count.toString())
            count=1;
        }
    }
    fs.writeFileSync( "output.txt" , results.join("\r\n") )    
});

