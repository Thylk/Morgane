    let isActiveAdd = false;

    let getAdd = document.getElementById("show-add");
    let getClose = document.getElementById("close-add");
    let getAddBox = document.getElementById("add-article-box");

    document.getElementById("show-add").addEventListener("click",

        function() {

            if (isActiveAdd === false) {

                getAddBox.style.display = "flex";
                isActiveAdd = true;

            } 
            
        }

    );

    document.getElementById("close-add").addEventListener("click",

        function() {

            if (isActiveAdd === true) {

                getAddBox.style.display = "none";
                isActiveAdd = false;

            }
            
        }

    );

    // ---------------------------- //

    let isActiveVisu = false;

    let getShowVisu = document.getElementById("show-visu");
    let getCloseVisu = document.getElementById("close-visu");
    let getImgBox = document.getElementById("img-container");

    document.getElementById("show-visu").addEventListener("click",

        function() {

            if (isActiveVisu === false) {

                getImgBox.style.display = "flex";
                isActiveVisu = true;

            } 
            
        }

    );

    document.getElementById("close-visu").addEventListener("click",

        function() {

            if (isActiveVisu === true) {

                getImgBox.style.display = "none";
                isActiveVisu = false;

            }
            
        }

    );