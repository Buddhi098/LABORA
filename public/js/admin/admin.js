//serach function for user accounts
function searchTable() {
    console.log('searching');
    var input = document.getElementById('searchInput');
    var filter = input.value.toUpperCase();
    var table = document.getElementById('myTable');
    var rows = table.querySelectorAll('tbody tr');

    for (var i = 0; i < rows.length; i++) {
        var cells = rows[i].getElementsByTagName('td');
        var found = false;

        for (var j = 0; j < cells.length; j++) {
            var cellText = cells[j].innerText || cells[j].textContent;
            if (cellText.toUpperCase().indexOf(filter) > -1) {
                found = true;
                break;
            }
        }

        if (found) {
            rows[i].style.display = '';
        } else {
            rows[i].style.display = 'none';
        }
    }
}
document.getElementById('searchInput').addEventListener('input', searchTable);





//import from patient dashboard
// toggle function 

navigation = 

window.onload = function(){

    sessionStorage.setItem('toggle_flag', 0);
    toggle()
}

function toggle(){
    console.log(sessionStorage.getItem('toggle_flag'))
    if(sessionStorage.getItem('toggle_flag')==1){
        document.getElementById('nav_bar').style.width = '80px';

        document.querySelector('.navigation ul').style.marginLeft = '30px';
        document.querySelector('.logooo h2').style.display = 'none';
        titles = document.querySelectorAll('.navigation ul li a .title');
        list_items = document.querySelectorAll('.navigation ul li');
        titles.forEach(title => {
            title.style.display = 'none';
        });


        document.querySelector('.logout').style.display = 'none';

        document.querySelector('.main').style.width = 'calc(100% - 80px)'
        document.querySelector('.main').style.left = '80px'


        document.querySelector('.container_1').style.width = 'calc(100% - 80px)'
        document.querySelector('.container_1').style.left = '80px'

        sessionStorage.setItem('toggle_flag', 0);
        
    }else if(sessionStorage.getItem('toggle_flag')==0 || sessionStorage.getItem('toggle_flag')==undefined){
        document.getElementById('nav_bar').style.width = '300px';

        document.querySelector('.navigation ul').style.marginLeft = '40px';
        document.querySelector('.logooo h2').style.display = 'block';
        titles = document.querySelectorAll('.navigation ul li a .title');
        list_items = document.querySelectorAll('.navigation ul li');
        titles.forEach(title => {
            title.style.display = 'block';
        });


        document.querySelector('.logout').style.display = 'block';

        document.querySelector('.main').style.width = 'calc(100% - 300px)'
        document.querySelector('.main').style.left = '300px'


        document.querySelector('.container_1').style.width = 'calc(100% - 300px)'
        document.querySelector('.container_1').style.left = '300px'

        sessionStorage.setItem('toggle_flag', 1);
        
    }
}