let testtype = [];
function service(id=1){
    fetch('http://localhost/labora/home/getService')
    .then((res)=>res.json())
    .then(response=>{
        let output = '';
        let des = '';
        let pre = '';

        for(let i in response){
            output += '<li onclick="service('+response[i].id+')" id="'+response[i].id+'">'+response[i].Test_type+'</li>';
            testtype.push([response[i].Test_type , response[i].id]);
            if(response[i].id==id){
                des = response[i].Description;
                pre = response[i].Preparation;
            }
        }
        document.getElementById("service-list").innerHTML = output;
        document.getElementById("dis").innerHTML = des;
        document.getElementById("pre").innerHTML = pre;
        document.getElementById(id).style.color ="white";
        document.getElementById(id).style.backgroundColor ="rgba(89, 51, 255, 0.8)";
        }
    ).catch(error=>console.log(error));
}

// start dyanamic search

const searchInput = document.getElementById('search1');

searchInput.addEventListener("input",e => {
        const value = e.target.value.toLowerCase();
        testtype.forEach(test => {
            if(test[0].toLowerCase().includes(value)){
                document.getElementById(test[1]).style.display ="block";
            }else{
                document.getElementById(test[1]).style.display ="none";
            }
        })
})

// end daynamic search