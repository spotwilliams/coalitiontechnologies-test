<table id="example" class="display" style="width:100%">
    <thead>
    <tr>
        <th>Name</th>
        <th>Qty</th>
        <th>Price</th>
        <th>Total</th>
    </tr>
    </thead>
</table>


@section('js')

    <script type="text/javascript">
        window.LaravelDataTables = window.LaravelDataTables || {};
        $(document).ready(function () {
            $.noConflict();
            window.LaravelDataTables['products'] = $('#example').DataTable({
                "ajax": '{{route('test.inform')}}',
                "columns": [
                    {"data": "name"},
                    {"data": "qty"},
                    {"data": "price"},
                    {"data": "total"},
                ],
                paging: false,
                ordering: false,
                dom: ''
            });
        });
    </script>
@append