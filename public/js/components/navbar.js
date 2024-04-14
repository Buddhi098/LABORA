// common functions for some functionality

// window.onload = setHovered();

function sanitize(string) {
    const map = {
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#x27;',
        "/": '&#x2F;',
    };
    const reg = /[&<>"'/]/ig;
    return string.replace(reg, (match)=>(map[match]));

}


// // add hovered class to selected list item
// let list = document.querySelectorAll(".navigation li");

// function setHovered() {
//   let list = document.querySelectorAll(".navigation li");
//   console.log(list);
//   console.log("setting hovered");
//   let activeLinkid = sessionStorage.getItem("activeLinkID");
//   console.log(activeLinkid);
//   let activeLink = document.getElementById(activeLinkid);

//   if(activeLink==null){
//     activeLink = document.getElementById("1");
//   }

//   list.forEach((item) => {
//     item.classList.remove("hovered");
//   });
//   activeLink.classList.add("hovered");
// }


// function activeLink() {
//   console.log("setting active link");
//   sessionStorage.setItem("activeLinkID", this.id);
// }

// list.forEach((item) => item.addEventListener("click", activeLink));

