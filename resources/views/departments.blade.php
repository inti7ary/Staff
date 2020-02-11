@extends('grid')
@section('title', 'Отделы')

@section('body')
@parent

<script>

controller = {
    loadData: () => $.ajax({
                    url: "{{route('api.departments')}}",
                    method: "GET",
                    dataType: "json",

                }),
    insertItem: (item) => $.ajax({
        url: "{{route('api.create.department')}}",
        method: "POST",
        dataType: "json",
        data: item
    }),
    updateItem: (item) => $.ajax({
        url: "{{route('api.update.department')}}",
        method: "PUT",
        dataType: "json",
        data: item
    }),
    deleteItem: (item) => $.ajax({
        url: "{{route('api.delete.department')}}",
        method: "DELETE",
        dataType: "json",
        data: item
    })
                 
}


$("#jsGrid").jsGrid({
        height: "auto",
        width: "100%",

        inserting: true,
        editing: true,
        sorting: true,
        paging: true,
        rowClick: $.noop,
        sorting: true,
        paging: false,
        autoload: true,
        noDataContent: "N/A",
        rowClick: function(args){
            url = '{{route("department", ":id")}}';
            url = url.replace(":id", args.item.id);
            window.location.href = url;
        },
        onDataLoaded: () => $('#jsGrid').jsGrid('sort', {field: 'count', order: 'desc'}),
        controller: controller,
 
        fields: [
            { name: "name", title: "Отдел", type: "text",  width: 150,
            itemTemplate: function(value, item){
                var url = '{{route("department", ":id")}}';
                url = url.replace(':id', item.id);
                var markup = '<a href=":url">:text</a>';
                markup = markup.replace(":url", url).replace(":text", value);
                return markup;
            }
            },
            { name: "phone_number", itemTemplate: function(value, item){return value === null ? "N/A" : value;}, title: "Телефон", type: "text", width: 150 },
            { name: "count", title: "Количество сотрудников", type: "number", readOnly: true,  width: 90 },
            { type: "control"}
        ]
    });
    
</script>
@endsection