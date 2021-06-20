//autocompletion
$( function() {
    var availableTags = [
      "ActionScript",
      "AppleScript",
      "Asp",
      "BASIC",
      "C",
      "C++",
      "Clojure",
      "COBOL",
      "ColdFusion",
      "Erlang",
      "Fortran",
      "Groovy",
      "Haskell",
      "Java",
      "JavaScript",
      "Lisp",
      "Perl",
      "PHP",
      "Python",
      "Ruby",
      "Scala",
      "Scheme"
    ];
    $( "#auto_per" ).autocomplete({
      source: availableTags
    });
  } );


   //add for entrées
   $(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_buttonEN'); //Add button selector
    var wrapper = $('.field_wrapperEN'); //Input field wrapper
    var fieldHTML = '<div class="row" style="margin:15px">'
    +'<a href="javascript:void(0);" class="remove_buttonEN">'
    +'<img src="{{ asset("img/remove-icon.png") }}"/>'
    +'</a>'
        
    +'<div class="col-lg-6 col-md-6 col-xs-6" style="padding:10px">'
    +'<select name="med_id[]" id="med_id[]" class="form-control shadow" required>'
    +'<option value="">Choisir le médicament</option>'
    +'@foreach ($medicams as $medicam)'
    +'<option value="{{ $medicam->id }}">{{ $medicam->med_name }} - {{ $medicam->med_price }}</option>'
    +'@endforeach'
    +'</select>'
    +'</div>'
    +'<div class="col-lg-3 col-md-3 col-xs-3" style="padding:10px">'
    +'<select name="mp_condition[]" id="mp_condition[]" class="form-control qte shadow">'
    +'<option value="">Détail ou boite ?</option>'
    +'<option value="Detail">Détail</option>'
    +'<option value="Boite">Boite</option>'
    +'</select>'
    +'</div>'
    +'<div class="col-lg-2 col-md-2 col-xs-2" style="padding:10px">Posologie :  '      
    +'</div>'
    +'<div class="col-lg-2 col-md-2 col-xs-2">'
    +'<select name="mp_prise[]" id="mp_prise[]" class="form-control qte shadow">'
    +'<option value="">Prises</option>'
    +'<option value="1">1</option>'
    +'<option value="2">2</option>'
    +'<option value="3">3</option>'
    +'<option value="4">4</option>'
    +'<option value="5">5</option>'
    +'</select>        '
    +'</div>'
    +'<div class="col-lg-2 col-md-2 col-xs-2">'
    +'<select name="mp_type[]" id="mp_type[]" class="form-control qte shadow">'
    +'<option value="">Types</option>'
    +'<option value="Comprimés">Comprimés</option>'
    +'<option value="Gellules">Gellules</option>'
    +'<option value="Injections">Injections</option>'
    +'<option value="Cuillères">Cuillères</option>'
    +'<option value="Ampoules">Ampoules</option>'
    +'<option value="Sachets">Sachets</option>'
    +'</select>'        
    +'</div>'
    +'<div class="col-lg-2 col-md-2 col-xs-2">'
    +'<select name="mp_fois[]" id="mp_fois[]" class="form-control qte shadow">'
    +'<option value="">Fois</option>'
    +'<option value="1">1</option>'
    +'<option value="2">2</option>'
    +'<option value="3">3</option>'
    +'<option value="4">4</option>'
    +'<option value="5">5</option>'
    +'</select>'
    +'</div>'
    +'<div class="col-lg-2 col-md-2 col-xs-2">'
    +'<select name="mp_jour[]" id="mp_jour[]" class="form-control qte shadow">'
    +'<option value="">Jour</option>'
    +'<option value="par Jour">par Jour</option>'
    +'<option value="après 1 jour">après 1 jour</option>'
    +'<option value="Après 2 jours">Après 2 jours</option>'
    +'<option value="Après 3 jours">Après 3 jours</option>'
    +'<option value="Après 5 jours">Après 5 jours</option>'
    +'<option value="Après 7 jours">Après une semaine</option>'
    +'</select>'        
    +'</div>'
    +'<div class="col-lg-2 col-md-2 col-xs-2">'
    +'<select name="mp_periode[]" id="mp_periode[]" class="form-control qte shadow">'
    +'<option value="">Periode</option>'
    +'<option value="Matin / Soir">Matin / Soir</option>'
    +'<option value="Matin / Midi / Soir">Matin / Midi / Soir</option>'
    +'<option value="Tous les matins">Tous les matins</option>'
    +'<option value="Tous les soirs">Tous les soirs </option>'                      
    +'</select>'        
    +'</div>'
    +'<div class="col-lg-2 col-md-2 col-xs-2">'
    +'<select name="mp_duree[]" id="mp_duree[]" class="form-control qte shadow">'
    +'<option value="">Durée</option>'
    +'<option value="1">1 jour</option>'
    +'<option value="2">2 jours</option>'
    +'<option value="3">3 jours</option>'
    +'<option value="4">4 jours</option>'
    +'<option value="5">5 jours</option>'
    +'<option value="7">7 jours</option>'
    +'<option value="10">10 jours</option>'
    +'</select>'        
    +'</div>'
    
    +'</div>';

    //Once add button is clicked
    var change_emp = $('#per_id');
    $(change_emp).change(function(){
        console.log(change_emp.val());
        var id = change_emp.val();
        $('#per_name').text("Nom Agent");
        $('#per_matricule').text("Matricule");
        $('#per_naiss').text("1990-06-18");
        /* $.ajax({
            url: '/autoPerson/'+id,
            type: 'GET',
            dataType: "json",
            success: function(result){
                
                $('#per_matricule').text(result.per_matricule);
                // document.location.href='/tactic?id='+id;
                //location.href = "{{route('ordonan')}}";
            },
            error: function(error) {
                console.log('error:' + JSON.stringify(error));
            }
        }); */
    });

    var x = 1; //Initial field counter is 1
    
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });

    //Once remove button is clicked
    $(wrapper).on('click', '.remove_buttonEN', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});

$(document).ready(function(){
            $('#prodtable').DataTable({
            serverSide: true,
            ajax: 'getordonan',
            columns: [
                { data: 'id', name: 'id','visible':false },
                { data: 'per_name', name: 'per_name' },
                { data: 'name', name: 'name' },
                { data: 'per_matricule', name: 'per_matricule' },
                { data: 'cen_name', name: 'cen_name' },
                { data: 'prix_total', name: 'prix_total' },
                { data: 'per_poste', name: 'per_poste' },
                { data: 'created_at', name: 'created_at' },
                {data: 'action', name: 'action', orderable: false}
                  ],order: [[0, 'desc']]
         });
      });
    

