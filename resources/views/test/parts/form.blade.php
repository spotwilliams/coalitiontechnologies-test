<form id="data">
    <input type="hidden" id="id" name="id">
    <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
    <div class="form-group">
        <label for="exampleInputEmail1">Product name</label>
        <input type="text" class="form-control" id="product" name="product">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Quantity in stock</label>
        <input type="text" class="form-control" id="qty" name="qty">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Price per item</label>
        <input type="text" class="form-control" id="price" name="price">
    </div>

    <button type="submit" class="btn btn-primary pull-right" id="submit">Submit</button>
</form>

@section('js')
    <script type="text/javascript">

        window.LaravelDataTables = window.LaravelDataTables || {};
        $(document).ready(function () {
            $('#submit').on('click', function (event) {
                event.preventDefault();

                $.ajax({
                    url: '{{route('test.save')}}',
                    method: 'post',
                    data: $('form#data').serializeArray(),
                    success: function (xhr) {
                        $('input[type="text"]').val('');
                        window.LaravelDataTables['products'].ajax.reload();

                    }
                });
            });
        });
    </script>
@append
