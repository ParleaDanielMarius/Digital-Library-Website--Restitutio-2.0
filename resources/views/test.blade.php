<!DOCTYPE html>
<html>
<head>
    <title>Test</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('/assets/vendor/Virtual-select/css/virtual-select.min.css')}}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

</head>
<body>

<div class="container">
    <a href="{{route('test')}}"><h1>Test</h1></a>

    <div id="multipleSelect"></div>
    <div id="table_data">
        @include('testTable')
    </div>
</div>

<!-- Modal -->


</body>

<script src="{{asset('/assets/vendor/Virtual-select/js/virtual-select.min.js')}}"></script>
{{--<script type="text/javascript">--}}
{{--    VirtualSelect.init({--}}
{{--        ele: '#multipleSelect',--}}
{{--        labelKey:'fullname',--}}
{{--        valueKey:'id',--}}
{{--        search:true,--}}
{{--        multiple:true,--}}
{{--        showValueAsTags: true,--}}
{{--        onServerSearch: authorsSearch,--}}
{{--    });--}}

{{--    // const searchAuthor = debounce(function(searchValue, virtualSelect) {--}}
{{--    //     authorsSearch(searchValue, virtualSelect)--}}
{{--    // }, 1000)--}}
{{--    //--}}
{{--    // function pointToAuthors(searchValue, virtualSelect) {--}}
{{--    //     searchAuthor(searchValue, virtualSelect)--}}
{{--    // }--}}

{{--    function authorsSearch(searchValue, virtualSelect) {--}}
{{--        getAuthorsFromServer(searchValue).then(function(newOptions) {--}}
{{--            virtualSelect.setServerOptions(newOptions)--}}

{{--        });--}}
{{--    }--}}

{{--    function getAuthorsFromServer(searchValue) {--}}
{{--        var author = '/test-show/';--}}

{{--        return $.ajax({--}}
{{--            url: search ,--}}
{{--            type: 'GET',--}}
{{--            dataType: 'json',--}}
{{--        });--}}
{{--    }--}}

{{--    function debounce(cb, delay = 250) {--}}
{{--        let timeout--}}

{{--        return (...args) => {--}}
{{--            clearTimeout(timeout)--}}
{{--            timeout = setTimeout(() => {--}}
{{--                cb(...args)--}}
{{--            }, delay)--}}
{{--        }--}}
{{--    }--}}

{{--</script>--}}
<script>
    $(document).ready(function(){

        $(document).on('click', '.pagination a', function(event){
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            fetch_data(page);
        });

        function fetch_data(page)
        {
            $.ajax({
                url:"/test-show?page="+page,
                success:function(data)
                {
                    $('#table_data').html(data);
                }
            });
        }

    });
</script>


</html>
