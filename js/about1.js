$(document).ready(function(){
    $.ajax({
        url : "meni.php",
        method : "get",
        type : "json",
        success : function(data){
            let prom = JSON.parse(data);
            let html = "";
            for(let element of prom){
                html += `<li class ="${element.class_name}"><a href ="${element.path}">${element.name}</a></li>`;
            }
            document.getElementById("meni").innerHTML += html;
        },
        error : function(xhr,status,error){
            alert(error);
        }


    })




})