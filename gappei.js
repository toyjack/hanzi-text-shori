// LIU Guanwei
var fs=require('fs')

fs.readFile(process.argv[2],"utf-8",(error,data)=>{
    if (error){
        return;
    }
    var data_arr=data.toString().split("\n")
    var results=[];
    for(var i=1;i<data_arr.length;i++){
        line= data_arr[i].split('\t');
        results.push({
            "id":line[0],
            "entry":line[1]
        })
    }
    for(var i=1;i<results.length;i++){
        if (results[i-1].id==results[i].id){
            results[i-1].entry=results[i-1].entry+results[i].entry
            results.splice(i,1)
        }
    }
    var outputs=[]
    outputs.push("KR2ID\tEntry")
    for(var i=0;i<results.length;i++){
        outputs.push(results[i].id+"\t"+results[i].entry)
    }
    fs.writeFileSync( "output.txt" , outputs.join("\n") )    
});

