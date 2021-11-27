cardlist = document.getElementsByClassName("card");






function newListeners(){
    console.log("clicked");
    let flexes = document.querySelectorAll(".flex");
    for (let i = 0; i < flexes.length; i++) {
        const element = flexes[i].addEventListener("dblclick",openModal);   
    }
    }






const config ={attributes: true, childList: true, subtree: true};
const lookForChange = newListeners;
const observer = new MutationObserver(lookForChange);


for (let i = 0; i < cardlist.length; i++) {
    observer.observe(cardlist[i], config);
}


document.body.addEventListener("load", showAll());
document.body.addEventListener("load", showAllBenutzer());


async function showAll(){
    document.getElementById("showall").innerHTML="";
    let row = 0;
    await fetch("/ProjektPHP/getAll.php").then(response => response.json()).then(data => data.forEach(element => {
        let elm = document.createElement("div");
        elm.classList.add("flex");
        elm.innerHTML = `<div row=${row} kind="Name">Name: ${element.Name}</div> <div row=${row} kind="Preis">Preis: ${element.Preis}€ </div> <div row=${row} kind="Anzahl">Anzahl: ${element.Anzahl}</div>`;
        document.getElementById("showall").appendChild(elm);
        row++;
    })
    );
    if (window.location.href.indexOf("shop") > -1) {
        console.log("shop");
        let flexes = document.querySelectorAll(".flex");
        for (let i = 0; i < flexes.length; i++) {
            const element = flexes[i].addEventListener("dblclick",addToCart);   
        }

        
    }
}
function addToCart(clicked){
    let row = clicked.target.getAttribute("row");
    console.log(row);
    let name = document.querySelectorAll(`[row="${row}"]`)[0].innerHTML.replace('Name: ','');
    let preis = document.querySelectorAll(`[row="${row}"]`)[1].innerHTML.replace('Preis: ','');
    preis = preis.replace('€ ','');
    let item = {
        name: name,
        preis: preis,
    }
    let cart = JSON.parse(localStorage.getItem("cart"));
    if (cart == null) {
        cart = [];
    }
    cart.push(item);
    localStorage.setItem("cart", JSON.stringify(cart));
    showCart();
}
function showCart(){
    document.getElementById("cart").innerHTML="<h2>Einkaufswagen</h2>";
    let cart = JSON.parse(localStorage.getItem("cart"));
    if (cart == null) {
        cart = [];
    }
    let row = 0;
    cart.forEach(element => {
        let elm = document.createElement("div");
        elm.classList.add("flex");
        elm.innerHTML = `<div row=${row} kind="Name">Name: ${element.name}</div> <div row=${row} kind="Preis">Preis: ${element.preis}€ </div> <button row=${row} onclick="removeFromCart(event)">Entfernen</button>`;
        document.getElementById("cart").appendChild(elm);
        row++;
    });
    let btn = document.createElement("button");
    btn.innerHTML = "Bezahlen";
    btn.addEventListener("click", pay);
    document.getElementById("cart").appendChild(btn);
}

function pay(){
    let cart = JSON.parse(localStorage.getItem("cart"));
    let cartString = JSON.stringify(cart);
    localStorage.setItem("cart", JSON.stringify([]));
    document.getElementById("cart").innerHTML="";
    document.getElementById("showall").innerHTML="";
    document.getElementById("showall").innerHTML=`<h2>Vielen Dank für Ihren Einkauf!</h2>`;
    fetch(`/ProjektPHP/pay.php?cart=${cartString}`).then(response => response.text()).then(data => {
        console.log(data);
    });
    
}

function postNewUser(){

    let name = document.getElementById("bname").value;
    let mail = document.getElementById("mail").value;

    fetch("/ProjektPHP/newFrontendUser.php", {
        method: "POST",
        body: JSON.stringify({
            name: name,
            email: mail
        }),
        headers: {
            "Content-type": "application/json; charset=UTF-8"
        }
    }).then(response => response.text()).then(data => alert("Kein Mailserver, PW sollte via Mail gesendet werden. PW = "+data),showAllBenutzer());
    
}
//`name=${name}&pass=${pass}`




function showAllBenutzer(){
    document.getElementById("showallUsers").innerHTML="";
    fetch("/ProjektPHP/getAllBenutzer.php").then(response => response.text()).then(data =>{
        document.getElementById("showallUsers").innerHTML=data;
    }
    );
}






function removeFromCart(clicked){
    let row = clicked.target.getAttribute("row");
    console.log(row);
    let cart = JSON.parse(localStorage.getItem("cart"));
    cart.splice(row, 1);
    localStorage.setItem("cart", JSON.stringify(cart));
    showCart();
}

async function add() {
    let name = document.getElementById("name").value;
    let preis = document.getElementById("preis").value;
    let anz = document.getElementById("anz").value;
    await fetch(`/ProjektPHP/add.php?name=${name}&preis=${preis}&anz=${anz}`).then(response => response.text()).then(data =>
        showAll());

}




function openModal(clicked){
    console.log(clicked.target.outerHTML);





    let parent = clicked.target.parent;
    let edit = clicked.target;

    let popup = document.createElement("div");
    popup.classList.add('popup');
    popup.setAttribute("id", "changeModal");
    let kind = edit.getAttribute("kind");
    let row = edit.getAttribute("row");
    popup.innerHTML = 
   `
   <h2 id="valueToChange">${kind}</h2>
   <input type="text" id="newValue" value="${edit.innerHTML.split(': ').pop().replace('€','')}">
   <button onclick="changeInDB()">Ändern</button>
   <button onclick="deleteItem()">Löschen</button>
   <div style="visibility: hidden;" id="itemname">${row}</div>
   `
   ;
   try {
       document.getElementById("changeModal").remove();
   } catch (error) {
       
   }
    document.body.appendChild(popup);

}




async function changeInDB(){

    let change = document.getElementById("valueToChange").innerHTML;
    let withWhat = document.getElementById("newValue").value;
    let old = document.getElementById("itemname").innerHTML;
    old = document.querySelectorAll(`[row="${old}"]`)[0].innerHTML.replace('Name: ','');
    await fetch(`/ProjektPHP/updateSingle.php?change=${change}&withWhat=${withWhat}&old=${old}`).then(response => response.text()).then(data =>
        showAll());
        try {
            document.getElementById("changeModal").remove();
        } catch (error) {
            
        }
}

function deleteItem(){
    let row = document.getElementById("itemname").innerHTML;
    let name = document.querySelectorAll(`[row="${row}"]`)[0].innerHTML.replace('Name: ','');
    fetch(`/ProjektPHP/delete.php?name=${name}`).then(response => response.text()).then(data =>
        showAll());
        try {
            document.getElementById("changeModal").remove();
        } catch (error) {
            
        }
}

