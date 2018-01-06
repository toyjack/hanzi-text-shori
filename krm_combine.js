//liuguanwei

var fs=require('fs')

fs.readFile(process.argv[2],"utf-8",(error,data)=>{
    if (error){
        return;
    }
    var data_lines=data.toString().split("\r\n")
    var count=1;
    var data=[];
    for(var i=1;i<data_lines.length;i++){
        let line= data_lines[i].split("\t");
        data.push({
            krid:line[0],
            kr2id:line[1],
            entry:line[2]
        });
    }
    console.log(data);
    // fs.writeFileSync( "output.txt" , results.join("\r\n") )    
});

