<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="refresh" content="600; url=http://localhost/labora/user/logout"> -->
    <link rel="stylesheet" href="<?php echo APPROOT.'/public/css/patientdashboard/medicaltest.css'?>">
    <script src="<?php echo APPROOT.'/public/js/patientdashboard/patient.js';?>"></script>
    <!-- static icons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <!-- annimation icons -->
    <script src="https://cdn.lordicon.com/lordicon-1.1.0.js"></script>

    <!-- <script src="<?php echo APPROOT.'\public\js\home.js';?>"></script> -->
    <title>Patient dashboard</title>
</head>
<body>
    <?php require_once 'components/nevbar.php' ?>
    <div class="container_1">
        <div class="services" id="services">
            <div class="test-type">
                <div class="test-search">
                    <input id="search1" type="search" placeholder="Search here" data-search>
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <div class="test-list">
                        <ul id="service-list">
                        </ul>
                    </div>
                </div>
                <div class="test-description">
                    <h4><i class="fa-solid fa-file-prescription"></i></i> Description</h4>
                    <p id="dis" class="dis"></p>
                    <h4><i class="fa-solid fa-user-doctor"></i> Preparation</h4>
                    <p id="pre" class="pre"></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>


<script>
    document.addEventListener('onload', service('0'));


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
                testtype.push([response['result'][i].Test_type , i]);
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
</script>


