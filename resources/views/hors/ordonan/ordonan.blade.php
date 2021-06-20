@extends('main')

@section('title', ' - Ordonnance')

@section('main-content')
<div class="container col-lg-10 col-md-12 col-xs-12">
    <div class="tab-content">
        @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
        @endif
        @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
        @endif
        <div class="tab-pane fade show active " id="p1">
                <br>
            <h2>Nouvelle ordonnance</h2>
            <br>
            <form method="POST" action="{{ route('saveordonan') }}"> 
                    @csrf
            <select name="per_id" id="per_id" class="form-control shadow" required>
                <option value="">Choisir l'employé malade</option>
                @foreach ($persons as $person)
                    <option value="{{ $person->id }}">{{ $person->per_name }} - {{ $person->per_matricule}}</option>
                @endforeach
            </select>
            <br/>
            
            <textarea type="text" name="observations" id="observations" placeholder="Observations"
                       class="form-control shadow"  required></textarea>
            <br/>
            <h3>Les médicaments prescrits</h3>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-xs-6">
                    <select name="med_id[]" id="med_id[]" class="form-control shadow" required>
                        <option value="">Choisir le médicament</option>
                        @foreach ($medicams as $medicam)
                            <option value="{{ $medicam->id }}">{{ $medicam->med_name }} - {{ $medicam->med_price }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-2 col-md-2 col-xs-2">
                    <select name="mp_qte[]" id="mp_qte[]" class="form-control qte shadow">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>

                <div class="col-lg-2 col-md-2 col-xs-2">
                    <a href="javascript:void(0);" class="add_buttonEN" title="Ajouter">
                    <img src="{{ asset('img/add-icon.png') }}"/></a>
                </div>
        </div>
        <br/>
        <div class="field_wrapperEN"><div>
            
        </div>
        </div>
        <br/>
                <button type="submit" class="btn btn-success shadow">Enregistrer</button>
            </form>
            <br>
            <h2>Liste des ordonnances prescrites</h2>
      <br>
      <div class="table-responsive">
          <table class="table table-bordered" id="prodtable">
              <thead>
                 <tr>
                      <th>ID </th>
                    <th>Nom patient </th>
                    <th>Médécin</th>
                    <th>Matricule</th>
                    <th>Oberservations</th>
                    <th>Prix</th>
                    <th>Poste</th>
                    <th>Date</th>
                    <th>Action</th>
                 </tr>
              </thead>
      </table>
      </div>
        </div>
    </div>
</div>
@endsection
<script type="text/javascript">
window.onload = function(){
    //add for entrées
    $(document).ready(function(){
        var maxField = 10; //Input fields increment limitation
        var addButton = $('.add_buttonEN'); //Add button selector
        var wrapper = $('.field_wrapperEN'); //Input field wrapper
        var fieldHTML = '<div class="row" style="margin:1px"><div class=" col-lg-6 col-md-6 col-xs-6 field"><select name="med_id[]" id="med_id[]" class="form-control shadow" required><option value="">Choisir le médicament</option>@foreach ($medicams as $medicam)<option value="{{ $medicam->id }}">{{ $medicam->med_name }} - {{ $medicam->med_price }}</option>@endforeach</select></div><div class="col-lg-2 col-md-2 col-xs-2 field"><select name="mp_qte[]" id="mp_qte[]" class="form-control qte shadow"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option></select></div><a href="javascript:void(0);" class="remove_buttonEN"><img src="{{ asset('img/remove-icon.png') }}"/></a></div>';

        var x = 1; //Initial field counter is 1
        
        var change_prod = $('.prod');
        var change_prix = $('.pri_total');
        var change_qte = $('.qte'); 
        
        let id = [];
        
        var pri_prod = 0;
        //Once add button is clicked
        $(change_prod).change(function(){
            
            let prix_unit = [];
            if ($(this).text() !== '' ) {
            var temp = change_prod.val().split('-');
            id.push(temp[0]);
            prix_unit.push(temp[1]);
            }
            $(change_qte).change(function(){
            var qty = change_qte.val();
            pri_prod = Number(prix_unit) * Number(qty);
            change_prix.val(pri_prod);
        });
        change_prix.val(pri_prod);
        });
        
        
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
                ajax: '{{ route('getordonan') }}',
                columns: [
                    { data: 'id', name: 'id','visible':false },
                    { data: 'per_name', name: 'per_name' },
                    { data: 'name', name: 'name' },
                    { data: 'per_matricule', name: 'per_matricule' },
                    { data: 'observations', name: 'observations' },
                    { data: 'prix_total', name: 'prix_total' },
                    { data: 'per_poste', name: 'per_poste' },
                    { data: 'created_at', name: 'created_at' },
                    {data: 'action', name: 'action', orderable: false}
                      ],order: [[0, 'desc']]
             });
          });
    
}
</script>