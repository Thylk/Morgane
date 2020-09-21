let isActiveSidebar = false;
let getSideBar = document.getElementById("nav-sidebar");
let getForm = document.getElementById("register-box");

document.getElementById("menu-icon").addEventListener("click",

    function() {

        if (isActiveSidebar === false) {
            getSideBar.style.visibility = "visible";
            getSideBar.style.display = "flex";
            // getSideBar.style.zIndex = "2";
            // if (getForm != null) {
            //     getForm.style.zIndex = "-1";
            // }
            isActiveSidebar = true;
        } else {
            getSideBar.style.visibility = "hidden";
            getSideBar.style.display = "none";
            // getSideBar.style.zIndex = "-1";
            // if (getForm != null) {
            //     getForm.style.zIndex = "2";
            // }
            isActiveSidebar = false;
        }
        
    }

);
