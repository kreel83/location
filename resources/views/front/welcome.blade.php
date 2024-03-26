@extends('layouts.front')

@section('content')

<script>
  function showResult(str) {
    if (str.length==0) {
      document.getElementById("livesearch").innerHTML="";
      document.getElementById("livesearch").style.border="0px";
      return;
    }
    var xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function() {
      if (this.readyState==4 && this.status==200) {
        document.getElementById("livesearch").innerHTML=this.responseText;
        document.getElementById("livesearch").style.border="1px solid #A5ACB2";
      }
    }
    xmlhttp.open("GET","{{ route('front.livesearch') }}?q="+str,true);
    xmlhttp.send();
  }
  </script>

<h4>Que recherchez vous ?</h4>

<div>

  <form action="{{ route('front.search') }}" method="post">
  @csrf

      <input type="text" id="recherche" name="recherche" placeholder="Outil, catégorie..." onkeyup="showResult(this.value)">

      <input type="text" id="emplacement" name="emplacement" placeholder="Où...">

      <button type="submit">Go !</button>

      <div class="mt-1 p-1" id="livesearch"></div>
      
      <input type="hidden" id="categorie_id" name="categorie_id">

  </form>

</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>

{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<select class="js-example-basic-single" name="state">

  <option value="AL">Alabama</option>
  <option value="WY">Wyoming</option>
</select>

<script>
  // In your Javascript (external .js resource or <script> tag)
  $(document).ready(function() {
      $('.js-example-basic-single').select2();
  });
</script> --}}

<script>
$(document).on('click','.res', function(e) {
  var id = $(this).data('categorie_id')
  $('#categorie_id').val(id)
  $('#recherche').val($(this).text())
  $('#livesearch').html('')
  $('#livesearch').css('border-width', '0px');
  //alert($(this).text());
  //alert(id);
  //alert($('#categorie_id').val())
});
</script>

@endsection