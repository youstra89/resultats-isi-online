$("document").ready(function(){
    // On va commencer par remplir le niveau en fonction du regime sélectionné
    $("#regime").on("change", function(){
        var regimeUser = this.value;
        var select = document.getElementById("niveau");
        select.length = 0;
        $.ajax({
            url: 'request/selection-du-niveau.php',
            type: 'GET',
            data: 'regime=' + regimeUser,
            dataType: 'json',
            success: function (result) {
                var option = document.createElement("option");
                option.value = "";
                option.text = "Sélectionnez votre niveau";
                select.add(option, select[0]);

                for(var k in result) {
                    var option = document.createElement("option");
                    option.value = result[k].id;
                    option.text = result[k].name;
                    select.add(option, select[k]);
                  }
            },
            error: function (xhr, status, error) {
              console.log(error)
            }
          });
        
    });



    // Ici, on va afficher les classes en fonction du niveau choisi
    $("#niveau").on("change", function(){
        var nvo = this.value;
        var select = document.getElementById("classe");
        select.length = 0;
        $.ajax({
            url: 'request/selection-de-la-classe.php',
            type: 'GET',
            data: 'niveau=' + nvo,
            dataType: 'json',
            success: function (result) {
                var option = document.createElement("option");
                option.value = "";
                option.text = "Sélectionnez votre classe";
                select.add(option, select[0]);

                for(var k in result) {
                    $(select).append('<option value="' + result[k].id + '">' + result[k].name + '</option>');
                    //var option = document.createElement("option");
                    //option.value = result[k].id;
                    //option.text = result[k].name;
                    //select.add(option, select[k]);

                    //var o = new Option(result[k].name, result[k].id);
                    /// jquerify the DOM object 'o' so we can use the html method
                    //$(o).html(result[k].name);
                    //$(select).append(o);
                  }
            },
            error: function (xhr, status, error) {
              console.log(error)
            }
          });
        
    });

    $("#classe").on("change", function(){
        //alert(this.value)
    });


    // A la soumission du formulaire
    $("#sms-classe").on("click", function(){
        console.log("Formulaire soumit");
        var classe = $("#classe").value
        //if(classe == 'undefined' || classe == null)
        //{
            //$(".message")
                //.show()
               // .fadeOut(10000);
               //alert(this.value)
        //}
        //return false;
    });

    // Pour fermer les messages de notifications
    $(".close.icon").on("click", function(){
        $(".message").fadeOut(1500);
    });
    
});