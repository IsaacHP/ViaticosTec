function fechaSeleccionada(){
    var fechaHabil = document.getElementById("habil");
    var fechaInhabil = document.getElementById("inhabil");

    if (fechaHabil.value !== "") {
        fechaInhabil.value = "";
        fechaInhabil.disabled = false;
      } else if (fechaInhabil.value !== "") {
        fechaHabil.value = "";
        fechaHabil.disabled = false;
      }
}

function calcular(){
    var fechaHabil = document.getElementById("habil");
    var fechaInhabil = document.getElementById("inhabil");
    var lugar = document.getElementById("lugar");
    var desayuno = document.getElementById("desayuno");
    var almuerzo = document.getElementById("almuerzo");
    var cena = document.getElementById("cena");
    var extencionHor = document.getElementById("extencionHor");
    var montoTotal = document.getElementById("monto");
    
    if(fechaHabil.value !== ""){
        //Habil-Habitual
        if(lugar.value == "Valparaíso" || lugar.value == "Viña del Mar" || lugar.value == "Quilpué" | lugar.value == "Villa Alemana"){
            monto = 0;
            if(desayuno.checked){
                monto = monto + 2500;
            }
            if(cena.checked){
                monto = monto + 2500;
            }
            if(extencionHor.checked){
                monto = monto + 2500;
            }
            montoTotal.value = monto; 

        //Habil - No Habitual más de 200Km
        }else if(lugar.value =="otros (sobre 200km)"){
            monto = 6000;
            if(desayuno.checked){
                monto = monto + 2500;
            }
            if(cena.checked){
                monto = monto + 10000;
            }
            if(extencionHor.checked){
                monto = monto + 2500;
            }
            montoTotal.value = monto;

        //Habil - No Habitual 50 a 200 Km    
        }else{
            monto =2500;
            if(desayuno.checked){
                monto = monto + 2500;
            }
            if(cena.checked){
                monto = monto + 4500;
            }
            if(extencionHor.checked){
                monto = monto + 2500;
            }
            montoTotal.value = monto;
        }   
    }else if(fechaInhabil.value !== ""){
        if(lugar.value == "Valparaíso" || lugar.value == "Viña del Mar" || lugar.value == "Quilpué" | lugar.value == "Villa Alemana"){
            monto = 4500;
            if(desayuno.checked){
                monto = monto + 2500;
            }
            if(cena.checked){
                monto = monto + 4500;
            }
            if(extencionHor.checked){
                monto = monto + 2500;
            }
            montoTotal.value = monto;

        }else if(lugar.value =="otros (sobre 200km)"){
            monto = 6000;
            if(desayuno.checked){
                monto = monto + 2500;
            }
            if(cena.checked){
                monto = monto + 10000;
            }
            if(extencionHor.checked){
                monto = monto + 2500;
            }
            montoTotal.value = monto;

        }else{
            monto =6000;
            if(desayuno.checked){
                monto = monto + 2500;
            }
            if(cena.checked){
                monto = monto + 6000;
            }
            if(extencionHor.checked){
                monto = monto + 2500;
            }
            montoTotal.value = monto;
        }           
    }
}

