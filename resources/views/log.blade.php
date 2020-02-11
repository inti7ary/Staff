@extends('grid')

@section('title', 'Журнал')

@section('body')
@parent

<script>

controller = {
    loadData: () => $.ajax({
                    url: "{{route('api.log')}}",
                    method: "GET",
                    dataType: "json",

                })         
}


$("#jsGrid").jsGrid({
        height: "auto",
        width: "100%",
        onDataLoaded: () => $("#jsGrid").jsGrid('sort', {field: 'created_at', order: 'desc'}),
        inserting: false,
        editing: false,
        sorting: false,
        paging: true,

        sorting: true,
        paging: false,
        autoload: true,
        noDataContent: "N/A",
        controller: controller,
 
        fields: [
            { name: "created_at", title: "Дата", type: "text",  width: 120 },
            { name: "employee.fullname",title: "ФИО", type: "text", sorting: false, width: 150,
             itemTemplate: function(value, item){
              var full_name = item.employee.surname + " " + item.employee.first_name + " " + item.employee.patronymic;
              var url = '{{route("employee", ":id")}}';
              url = url.replace(":id", item.employee.id);
              var markup = '<a href=":url">:text</a>';
              markup = markup.replace(":url", url).replace(":text", full_name);
              return markup;
            }},
            { name: "department.name", title: "Отдел", sorting: false, type: "text", width: 150,
            itemTemplate: function(value, item){
              if(value === null) return "N/A";
              var url = '{{route("department", ":id")}}';
              url = url.replace(':id', item.department.id);
              var markup = '<a href=":url">:text</a>';
              markup = markup.replace(':url', url).replace(':text', value);
              return markup;
            }},
            { name: "position.name", title: "Должность", type: "text", sorting: false, width: 150 }
        ]
    });

   
</script>

@endsection