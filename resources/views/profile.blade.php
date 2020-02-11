@extends('layout')

@section('body')



<div class="container-fluid" >

<h3><span id="employee-full-name"></span></h3>
<form id="input-employee" class="readOnly">
@csrf
  <div class="form-group row">
    <label for="surname" class="col-sm-2 col-form-label">Фамилия:</label>
    <div class="col-sm-3">
      <input type="text" readonly class="form-control-plaintext" id="surname">
    </div>
  </div>

  <div class="form-group row">
    <label for="first_name" class="col-sm-2 col-form-label">Имя:</label>
    <div class="col-sm-3">
      <input type="text" readonly class="form-control-plaintext" id="first_name" >
    </div>
  </div>

  <div class="form-group row">
    <label for="patronymic" class="col-sm-2 col-form-label">Отчество:</label>
    <div class="col-sm-3">
      <input type="text" readonly class="form-control-plaintext" id="patronymic" >
    </div>
  </div>

  <div class="form-group row">
    <label for="position" class="col-sm-2 col-form-label">Должность:</label>
    <div class="col-sm-3">
      <input type="text" readonly class="form-control-plaintext" id="position">
    </div>
  </div>
@auth
  <div class="col-auto my-1">
      <button id="employee-form-btn" type="button" class="btn btn-primary">Редактировать</button>
    </div>
@endauth
</form>
<br>

<h3>Часы работы и зарплата</h3>
<form id="input-staffing-table" class="readOnly">
@csrf
  <div class="form-group row">
    <label for="work-beginning" class="col-sm-2 col-form-label">Начало рабочего дня:</label>
    <div class="col-sm-2">
      <input type="time" readonly class="form-control-plaintext" id="work-beginning" value="00:00">
    </div>
  </div>

  <div class="form-group row">
    <label for="work-end" class="col-sm-2 col-form-label">Конец рабочего дня:</label>
    <div class="col-sm-2">
      <input type="time" readonly class="form-control-plaintext" id="work-end" value="00:00">
    </div>
  </div>

  <div class="form-group row">
    <label for="salary" class="col-sm-2 col-form-label">Зарплата:</label>
    <div class="col-sm-2">
      <input type="number" readonly class="form-control-plaintext" id="salary" value="0">
    </div>
  </div>
@auth
  <div class="col-auto my-1">
      <button id="staffing-form-btn" type="button" class="btn btn-primary">Редактировать</button>
    </div>
@endauth
</form>
</div>
<script>
//edit or save employee's general info
function employeeFormButtonClicked(){
  if($("#input-employee").hasClass('readOnly')){
        $("#input-employee input")
        .removeClass('form-control-plaintext')
        .addClass('form-control')
        .attr('readonly', false);
        $("#input-employee").removeClass('readOnly');
        $("#employee-form-btn").text('Сохранить');
    }else{
        var first_name = $("#first_name").val();
        var surname = $("#surname").val();
        var patronymic = $("#patronymic").val();
        var position = {'name' : $("#position").val()};

        var data = {'id': '{{$id}}',
            'first_name' : first_name,
            'surname' : surname,
            'patronymic' : patronymic,
            'position' : position};

        $.ajax({
            url: "{{route('api.update.employee')}}",
            method: "PUT",
            data: data,
            success: function(response){
                //attaching response values to form fields
                $('#first_name').val(response.first_name);
                $('#surname').val(response.surname);
                $('#patronymic').val(response.patronymic);
                //making form read only
                $("#input-employee").addClass('readOnly');
                $("#input-employee input")
                .removeClass('form-control')
                .addClass('form-control-plaintext')
                 .attr('readonly', true);
                 $("#employee-form-btn").text('Редактировать');
            }
        });
    
    }
}

//edit or save employee's staffing table
function staffingFormButtonClicked(){
    if($("#input-staffing-table").hasClass('readOnly')){
        $("#input-staffing-table input")
        .removeClass('form-control-plaintext')
        .addClass('form-control')
        .attr('readonly', false);
        $("#input-staffing-table").removeClass('readOnly');
        $("#staffing-form-btn").text('Сохранить');
    }else{
        var work_day_beginning = $("#work-beginning").val();
        var work_day_end = $("#work-end").val();
        var salary = $("#salary").val();
        var data = {'id': '{{$id}}',
            'work_day_beginning' : work_day_beginning,
            'work_day_end' : work_day_end,
            'salary' : salary};

        $.ajax({
            url: "{{route('api.update.staffing_table', $id)}}",
            method: "PUT",
            data: data,
            success: function(response){
                //attaching response values to form fields
                $('#salary').val(response.salary);
                $('#work-beginning').val(response.work_day_beginning);
                $('#work-end').val(response.work_day_end);
                //making form read only
                $("#input-staffing-table").addClass('readOnly');
                $("#input-staffing-table input")
                .removeClass('form-control')
                .addClass('form-control-plaintext')
                 .attr('readonly', true);
                 $("#staffing-form-btn").text('Редактировать');
            }
        });
    
    }
}


$(document).ready(function(){
$.ajax({
    url: '{{route("api.staffing_table", $id)}}',
    method: 'GET',
    sync: false,
    success: function(response){
        //attaching response values to form fields
        $('#salary').val(response.salary);
        $('#work-beginning').val(response.work_day_beginning);
        $('#work-end').val(response.work_day_end);
        //attaching onclick event to edit/save button
        $('#staffing-form-btn').on('click', staffingFormButtonClicked);
}


});

$.ajax({
    url: '{{route("api.employee", $id)}}',
    method: 'GET',
    sync: false,
    success: function(response){
        //attaching response values to form fields
        var full_name = response.surname + " " + response.first_name + " " + response.patronymic;
        $('#employee-full-name').text(full_name);
        $('title').text(full_name);

        $('#surname').val(response.surname);
        $('#first_name').val(response.first_name);
        $('#patronymic').val(response.patronymic);
        $('#position').val(response.position.name);

         //attaching onclick event to edit/save button
        $('#employee-form-btn').on('click', employeeFormButtonClicked);
}


});

});
</script>

@endsection


