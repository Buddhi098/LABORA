let testtype = [];
function service(id=0 , table_id){
    baseLink = window.location.origin;
    console.log('asdsa')
    fetch(`${baseLink}/labora/home/getService/${id}/${table_id}`)
    .then((res)=>{
        if(!res.ok){
            throw new Error('Network Error Occurred');
        }

        return res.json()
    })
    .then(response=>{

        console.log(response)
        let output = '';
        let des = '';
        let pre = '';
        console.log(id , table_id)
        for(let i in response['result']){
            output += '<li onclick="service('+i+','+response['result'][i].id+')" id="'+i+'">'+response['result'][i].Test_type+'</li>';
            testtype.push([response['result'][i].Test_type , response['result'][i].id]);
            if(i==id){
                des = response['result'][i].Description;
                pre = '';
                for(let i=0 ; i<response['preparation'].length ; i++){
                    pre += `<p>${i+1}. ${response['preparation'][i].preparation}<p>`;
                }
                console.log(pre);
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