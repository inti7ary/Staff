@extends('grid')

@section('title', "Сотрудники")

@section('body')

@parent

<script>


departments = []
controller = {
    loadData: function(){ 
     
        return $.ajax({
                    url: "{{route('api.employees')}}",
                    method: "GET",
                    dataType: "json",
                    
                });
                
            },
    insertItem: (item) => $.ajax({
        url: "{{route('api.create.employee')}}",
        method: "POST",
        dataType: "json",
        data: item
    }),
    updateItem: (item) => $.ajax({
        url: "{{route('api.update.employee')}}",
        method: "PUT",
        dataType: "json",
        data: item,

    }),
    deleteItem: (item) => $.ajax({
        url: "{{route('api.delete.employee')}}",
        method: "DELETE",
        dataType: "json",
        data: item
    })
                 
}

$.ajax({
            url: "{{route('api.departments')}}",
            method: "GET"}).done(function(response){
                departments = response;
            


$("#jsGrid").jsGrid({
        height: "auto",
        width: "100%",

        inserting: true,
        editing: true,
        sorting: true,
        paging: true,
        rowClick: function(args){ 
            url = '{{route('employee', ":id")}}';
            url = url.replace(":id", args.item.id);
            window.location.href = url;
        },
        sorting: true,
        paging: false,
        autoload: true,
        
        onDataLoaded: () => $('#jsGrid').jsGrid('sort', {field: 'id', order: 'desc'}),
        onItemInserted: () => $('#jsGrid').jsGrid('sort', {field: 'id', order: 'desc'}),
        controller: controller,
 
        fields: [
            {name: "id", visible: false},
            { name: "surname", title: "Фамилия", type: "text", width: 150 },
            { name: "first_name", title: "Имя", type: "text", width: 150 },
            { name: "patronymic", title: "Отчество", type: "text", width: 150 },
            { name: "email", title: "Email", 
             itemTemplate: (value, item) => value === null? "N/A" : value,
             type: "text", width: 150 },
            { name: "phone_number", title: "Телефон", 
             itemTemplate: (value, item) => value === null? "N/A" : value,
             type: "text", width: 150 },
            {  name: "department.id", title: "Отдел", type: "select",
            itemTemplate: function(value, item){
                var url = '{{route("department", ":id")}}';
                url = url.replace(':id', value);
                return item.department === null? "N/A" : '<a href="' + url + '">' + item.department.name + '</a>';
            },
            items: departments, valueField: "id", textField: "name", width: 150 },
            {  name: "position.name", title: "Должность",
                 type: "text",
                 width: 150 },
            { type: "control"}

        ]
    });
});
</script>
@endsection

    

