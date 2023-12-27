let http = new XMLHttpRequest();
function callReload(url, pageElement, callMessage) 
{
        document.getElementById(pageElement).innerHTML = callMessage;
        http.open("GET",url,true);
        http.onreadystatechange = function() {responseReload(pageElement);};
        http.send();
}

function responseReload(pageElement) 
{
        if(http.readyState == 4) {
                if(http.status == 200) 
                {
                        var output = http.responseText;
                        document.getElementById(pageElement).innerHTML = output;
                }
        }
}

//funkcja podstrony bez ładowania dla edycja
function RedirectToEdit(id, pageElement, callMessage)
{
        document.getElementById(pageElement).innerHTML = callMessage;
        
        http.open("GET","edit.php?id="+id,true)
        http.onreadystatechange = function() {responseReload(pageElement);};
        http.send();
}


function Delete(id){

        let xmlhttp = new XMLHttpRequest();   
        xmlhttp.open("GET","delete.php?id="+id,true);
        xmlhttp.send();

        callReload("admin.php","content","Trwa ładowanie strony...");
        
}

function Login(login, password)
{
        if(login =="" || password == "")
        {
                document.getElementById("error").innerHTML = "Nie uzupełniono danych";
                return;
        }
        else
        {  
        let xmlhttp = new XMLHttpRequest(); 
        xmlhttp.open("GET","loginBack.php?login="+login+"&password="+password,true);
        xmlhttp.send();
        xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) { 
                        callReload("index.php","content","Trwa ładowanie strony...");
                }

                if (this.readyState == 4 && this.status == 401) { 
                        document.getElementById("error").innerHTML = "Błędne dane logowania";
                }
            };
        }
}

function Logout()
{
        let xmlhttp = new XMLHttpRequest();   
        xmlhttp.open("GET", "logout.php", true);
        xmlhttp.send();
        callReload("index.php", "content", "Trwa ładowanie strony...");
}

async function GetSelectedValues(names) {
        let selects = document.getElementsByName(names[0]);
    
        let values = [];
        for (let i = 0; i < selects.length; i++) {
            let pizzaId = selects[i].value;
            let quantity = document.getElementsByName(names[1])[i].value;
            let size = document.getElementsByName(names[2])[i].value;
            let oldPizzaId = document.getElementsByName(names[3])[i].getAttribute('data-oldPizzaId');
    
            values.push({
                pizzaId: pizzaId,
                oldPizzaId: oldPizzaId,
                quantity: quantity,
                size: size,
                price: await CountPrice(pizzaId, quantity, size)
            });
        }
        return values;
    }

async function Edit(name, surname, phoneNumber, orderId)
{
        const reg = /[0-9]{3}-[0-9]{3}-[0-9]{3}/;

        let orderData = await GetSelectedValues(['pizzaId', 'quantity', 'size', 'oldPizzaId']);

        if(name == "" || surname == "" || phoneNumber == "" || orderData.length < 0)
        {
                document.getElementById("error").innerHTML = `<h3 class="error" >Przed wysłaniem proszę poprawić błędy:</h3> 
                                                                <span class="error"> Nie uzupełniono danych </span>`;
                return;
        }

        if(!reg.test(phoneNumber))
        {
                document.getElementById("error").innerHTML = `<h3 class="error" >Przed wysłaniem proszę poprawić błędy:</h3> 
                                                                <span class="error"> Zły format numeru telefonu </span>`;
                return;
        }
        if(phoneNumber.length > 11){
                document.getElementById("error").innerHTML = `<h3 class="error" >Przed wysłaniem proszę poprawić błędy:</h3> 
                                                                <span class="error"> Zły format numeru telefonu </span>`;
                return;
        }

        for (let i = 0; i < orderData.length; i++) {
                if(orderData[i].pizzaId == null)
                {
                        document.getElementById("error").innerHTML = `<h3 class="error" >Przed wysłaniem proszę poprawić błędy:</h3> 
                        <span class="error"> Nie uzupełniono danych </span>`;
                        return;
                }

                if(orderData[i].quantity == null)
                {
                        document.getElementById("error").innerHTML = `<h3 class="error" >Przed wysłaniem proszę poprawić błędy:</h3> 
                        <span class="error"> Nie uzupełniono danych </span>`;
                        return;
                }

                if(orderData[i].size == null)
                {
                        document.getElementById("error").innerHTML = `<h3 class="error" >Przed wysłaniem proszę poprawić błędy:</h3> 
                        <span class="error"> Nie uzupełniono danych </span>`;
                        return;
                }

                if(orderData[i].oldPizzaId == null)
                {
                        document.getElementById("error").innerHTML = `<h3 class="error" >Wystąpił błąd</h3>`;
                        return;
                }
        }

        let xmlhttp = new XMLHttpRequest(); 
        let url = "editBack.php?name="+name+"&surname="+surname+"&phoneNumber="+phoneNumber+"&orderId="+orderId

        for (let i = 0; i < orderData.length; i++) {
                url += `&orderData[${i}][pizzaId]=${encodeURIComponent(orderData[i].pizzaId)}`;
                url += `&orderData[${i}][oldPizzaId]=${encodeURIComponent(orderData[i].oldPizzaId)}`;
                url += `&orderData[${i}][quantity]=${encodeURIComponent(orderData[i].quantity)}`;
                url += `&orderData[${i}][size]=${encodeURIComponent(orderData[i].size)}`;
                url += `&orderData[${i}][price]=${encodeURIComponent(orderData[i].price)}`;
            }

        xmlhttp.open("GET",url,true);

        xmlhttp.send();
        xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) { 
                        callReload("admin.php","content","Trwa ładowanie strony...");
                }

                if (this.readyState == 4 && this.status == 400) { 
                        document.getElementById("error").innerHTML = this.responseText;
                }
        }
}
function Order(name, surname, phoneNumber, city, street, buildingNumber , apartmentNumber)
{
        let xmlhttp = new XMLHttpRequest(); 
        xmlhttp.open("GET","orderBack.php?name="+name+"&surname="+surname+"&phoneNumber="+phoneNumber+
        "&city="+city+"&street="+street+"&buildingNumber="+buildingNumber+"&apartmentNumber="+apartmentNumber,true);
        xmlhttp.send();
        xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) { 
                        callReload("index.php","content","Trwa ładowanie strony...");
                }
                if (this.readyState == 4 && this.status == 400) { 
                        document.getElementById('error').innerHTML = this.responseText;
                }
        };       
}

function CountPrice(str,str2,str3) 
{
        return new Promise((resolve, reject) => {
                if (str === "" || str2 === "" || str3 === "") {
                        reject(new Error("Missing parameters"));
                } else {
                        let xmlhttp = new XMLHttpRequest();
                        xmlhttp.onreadystatechange = function () {
                        if (this.readyState == 4 && this.status == 200) {
                                resolve(parseInt(this.responseText));
                        }
                        };
                        xmlhttp.open("GET", "countPrice.php?pizzaId=" + str + "&quantity=" + str2 + "&size=" + str3, true);
                        xmlhttp.send();
                }
                });
}

function increaseQuantity(id) 
{
        let quantityInput = document.getElementById('quantity'+id);

        quantityInput.value = parseInt(quantityInput.value, 10) + 1;
}

function decreaseQuantity(id) 
{
        let quantityInput = document.getElementById('quantity'+id);

        let currentValue = parseInt(quantityInput.value, 10);
        if (currentValue >= 1) {
                quantityInput.value = currentValue - 1;
        }
}

async function AddToCart(id, quantity, name)
{       
        let size = parseInt(document.querySelector('input[name="size' + id + '"]:checked').value, 10);

        let price = await CountPrice(id, quantity, size);
        console.log(id, quantity, price)

        let xmlhttp = new XMLHttpRequest(); 
        xmlhttp.open("GET","orderSelectBack.php?pizzaId="+id+"&quantity="+quantity+"&price="
                        +price+"&size="+size+"&name="+name,true);
        xmlhttp.send();
        xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) { 

                        let cartArray = JSON.parse(this.responseText);

                        // Sprawdzenie ilości elementów 
                        let numberOfItems = Object.keys(cartArray).length;
                        document.getElementById("cart-quantity").innerHTML = numberOfItems;
                        document.getElementById('go-next').disabled = false;
                }
                if (this.readyState == 4 && this.status == 400) { 
                        console.log(this.responseText)
                }
        };      
}

function RemoveFromCart(id, size)
{       
        let xmlhttp = new XMLHttpRequest(); 
        xmlhttp.open("GET","orderConfirmBack.php?pizzaId="+id+"&size="+size,true);
        xmlhttp.send();
        xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) { 
                        callReload('orderConfirm.php', 'content', 'Trwa ładowanie strony...')
                }
                if (this.readyState == 4 && this.status == 400) { 
                        console.log(this.responseText)
                }
        };      
}


function Validate(form)
{       
        const errorMessage = document.getElementById('error');
        const reg = /[0-9]{3}-[0-9]{3}-[0-9]{3}/;
        let formErrors = [];
        if(form.name.value == ''){
                formErrors.push("Wypełnij imie");
        }else if(form.name.value.length < 3){
                formErrors.push("Imie musi zawierać minimum 3 znaki");
        }

        if(form.surname.value == ''){
                formErrors.push("Wypełnij nazwisko");
        }else if(form.surname.value.length < 5){
                formErrors.push("Nazwisko musi zawierać minimum 5 znaków");
        }

        if(form.phoneNumber.value == ''){
                formErrors.push("Wypełnij telefon");
        }else if(!reg.test(form.phoneNumber.value)){
                formErrors.push("Poprawnie wypełnij numer telefonu");
        }else if(form.phoneNumber.value.length > 11){
                formErrors.push("Poprawnie wypełnij numer telefonu");
        }

        if(form.city.value == ''){
                formErrors.push("Wypełnij miasto");
        }

        if(form.street.value == ''){
                formErrors.push("Wypełnij ulice");
        }else if(form.street.value.length < 3){
                formErrors.push("Ulica musi zawierać minimum 5 znaków");
        }

        if(form.buildingNumber.value == ''){
                formErrors.push("Wypełnij numer budynku");
        }else if(form.buildingNumber.value < 1 || form.buildingNumber.value > 999){
                formErrors.push("Nr budynku ma zakres od 1 do 999");
        }

        if(form.apartmentNumber.value == ""){
                formErrors.push("Wypełnij numer mieszkania");
        }else if(form.apartmentNumber.value < 1 || form.apartmentNumber.value > 999){
                formErrors.push("Nr mieszkania ma zakres od 1 do 999");
        }

        if(formErrors.length == 0){
                Order(form.name.value, form.surname.value, form.phoneNumber.value, form.city.value, 
                        form.street.value, form.buildingNumber.value, form.apartmentNumber.value);
                
        }else{
                errorMessage.innerHTML = 
                `<h3>Przed zamowieniem proszę poprawić błędy:</h3>
                <ul>
                ${formErrors.map(el => `<li>${el}</li>`).join("")}
                </ul>`;
        }
}