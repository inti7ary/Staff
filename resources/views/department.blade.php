@extends('grid')

@section('title')
{{$department->name}}

@endsection

@section('body')
</br>
<h3> {{$department->name}}</h3>
</br>
@parent

<script>
controller = {
    loadData: () => $.ajax({
                    url: '{{route("api.department", ":id")}}'.replace(":id", "{{$id}}"),
                    method: "GET",
                    dataType: "json",
                }),
    
}


$("#jsGrid").jsGrid({
        height: "auto",
        width: "100%",
        sorting: true,
        paging: true,
        rowClick: $.noop,
        sorting: true,
        paging: false,
        autoload: true,
        noDataContent: "N/A",

        rowClick: function(args){
            url = '{{route("employee", ":id")}}';
            url = url.replace(":id", args.item.id);
            window.location.href = url;
        },
        onDataLoaded: function(args){
            
            this.data = this.data.employees;
            this.refresh();
        },
        controller: controller,
        
        fields: [
            { name: "full_name", title: "ФИО", type: "text",  width: 150,
                itemTemplate: function(value, item){
                    full_name = item.surname + " " + item.first_name + " " + item.patronymic;
                    url = '{{route("employee", ":id")}}';
                    url = url.replace(":id", item.id);
                    markup = '<a href=":url">:text</a>';
                    markup = markup.replace(":url", url).replace(":text", full_name);
                    return markup;
                }},
                { name: "position.name", title: "Должность", type: "text", width: 150 }
            /*{ name: "phone_number", itemTemplate: function(value, item){return value === null ? "N/A" : value;}, title: "Телефон", type: "text", width: 150 },
            { name: "count", title: "Количество сотрудников", type: "number", readOnly: true,  width: 90 },
            { type: "control"}*/
        ]
    });
    
</script>

@endsection