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
                document.getElementById("Blad").innerHTML = "Nie uzupełniono danych";
                return;
        }
        else
        {  
        let xmlhttp = new XMLHttpRequest(); 
        xmlhttp.open("GET","loginBack.php?login="+login+"&$password="+password,true);
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

function Edit(name, surname, phoneNumber, pizzaId, quantity, size, recordId)
{
        const reg = /[0-9]{3}-[0-9]{3}-[0-9]{3}/;
        console.log(name, surname, phoneNumber, pizzaId, quantity, size, recordId)
        if(name == "" || surname == "" || phoneNumber == "" || pizzaId == null || quantity == null || size == null)
        {
                document.getElementById("Error").innerHTML = `<h3 class="error" >Przed wysłaniem proszę poprawić błędy:</h3> 
                                                                <span class="error"> Nie uzupełniono danych </span>`;
                document.getElementById("Error").classList.add("error")
        }
        else if(!reg.test(phoneNumber))
        {
                document.getElementById("Error").innerHTML = `<h3 class="error" >Przed wysłaniem proszę poprawić błędy:</h3> 
                                                                <span class="error"> Zły format numeru telefonu </span>`;
                document.getElementById("Error").classList.add("error")

        }else if(phoneNumber.length > 11){
                document.getElementById("Error").innerHTML = `<h3 class="error" >Przed wysłaniem proszę poprawić błędy:</h3> 
                                                                <span class="error"> Zły format numeru telefonu </span>`;
                document.getElementById("Error").classList.add("error")
        }
        else
        {  

        let xmlhttp = new XMLHttpRequest(); 

        xmlhttp.open("GET","editBack.php?name="+name+"&surname="+surname+"&phoneNumber="+phoneNumber+"&pizzaId="+pizzaId
        +"&quantity="+quantity+"&size="+size+"&recordId="+recordId,true);

        xmlhttp.send();
        xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) { 
                callReload("admin.php","content","Trwa ładowanie strony...");
                }
        };
        }
        
}
function Order(name, surname, phoneNumber, city, street, buildingNumber , apartmentNumber, pizzaId, quantity, size)
{
        let xmlhttp = new XMLHttpRequest(); 
        xmlhttp.open("GET","orderBack.php?name="+name+"&surname="+surname+"&phoneNumber="+phoneNumber+
        "&city="+city+"&street="+street+"&buildingNumber="+buildingNumber+"&apartmentNumber="+apartmentNumber+
        "&pizzaId="+pizzaId+"&quantity="+quantity+"&size="+size,true);
        xmlhttp.send();
        xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) { 
                callReload("index.php","content","Trwa ładowanie strony...");
                }
        };       
}

function CountPrice(str,str2,str3) 
{
        if (str == "" || str2 =="" || str3 =="") 
        {
                document.getElementById("Cena").innerHTML = "Cena: ";
                return;
        } 
        else
        {
            let xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) { 
                    document.getElementById("Cena").innerHTML = this.responseText;
                }
            };
        xmlhttp.open("GET","countPrice.php?pizzaId="+str+"&quantity="+str2+"&size="+str3,true);
        xmlhttp.send();
        };
}


function Validate(form)
{
        const formMessage = document.getElementById('message');
        const reg = /[0-9]{3}-[0-9]{3}-[0-9]{3}/;
        let formErrors = [];
        if(form.name.value == ''){
                formErrors.push("Wypełnij imie");
        }else if(form.name.value.length < 3){
                formErrors.push("Imie musi zawierać minimum 3 znaki");
        }

        if(form.surname.value == ''){
                formErrors.push("Wypełnij Nazwisko");
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

        if(form.pizzaId.value == ""){
                formErrors.push("Wypełnij numer pizzy");
        }else if(form.pizzaId.value < 1 || form.pizzaId.value > 29){
                formErrors.push("Nr pizzy ma zakres od 1 do 29");
        }     

        if(form.quantity.value == ""){
                formErrors.push("Wypełnij ilość");
        }else if(form.quantity.value < 1 || form.quantity.value > 99){
                formErrors.push("Można zamówić do 99 pizz");
        }      

        if(form.size.value == ""){
                formErrors.push("Wybierz rozmiar pizzy");
        }

        if(formErrors.length == 0){
                Order(form.name.value, form.surname.value, form.phoneNumber.value, form.city.value, 
                        form.street.value, form.buildingNumber.value, form.apartmentNumber.value,
                        form.pizzaId.value, form.quantity.value, form.size.value);
                //tutaj kod dla przejścia
        }else{
                formMessage.innerHTML = 
                `<h3>Przed wysłaniem proszę poprawić błędy:</h3>
                <ul>
                ${formErrors.map(el => `<li>${el}</li>`).join("")}
                </ul>`;
        }
}