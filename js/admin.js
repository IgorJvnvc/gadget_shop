var id;


	$(".update").click(function(e){
		e.preventDefault();
		$(".updateForma").css("display","inline-block");
		 id = this.dataset.id;
	})

	$(".updateU").click(function(e){
		e.preventDefault();
			$(".updateFormaU").css("display","inline-block");
			 id = this.dataset.id;
			 
	})
	//SLANJE PODATAKA ZA UPDATE PROIZVODA
	$("#sendU").click(function(){
		var putanjaSlike = $("#productPictureU").val().split("\\")
		let json = 
		{
			id : id,
			name : $("#productNameU").val(),
			description : $("#productDescU").val(),
			price : $("#productPriceU").val(),
			picture : putanjaSlike[2],
			category : $("#productCatU").val(),
		}
		
		$.ajax({
			url : "admin2.php",
			method : "post",
			data : json,
			success : function(data){
				if(data != undefined)
				alert(data.message);
				
			},
			error(xhr,error,status){
				alert(error);	
			}
		})
	})//SLANJE PODATAKA ZA UPDATE KORISNIKA
	$("#sendUserUpdate").click(function(){
		
		var roleID = $(".ne:checked").val();
		if(roleID == "")
		roleID = 0;
		
		let json = 
		{
			idUser : id,
			username : $("#usernameU").val(),
			email : $("#emailU").val(),
			password : $("#passwordU").val(),
			roleID : roleID
		}
		
		$.ajax({
			url : "admin2.php",
			method : "post",
			data : json,
			success : function(data){
				if(data != undefined)
				alert(data.message);
				
			},
			error(xhr,error,status){
				alert(error);	
			}
		})
	})
	//DINAMICKI ISPIS MENIJA
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