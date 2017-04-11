<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <script src="http://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script src="{{ asset('js/bootstrapValidator.min.js') }}"></script>
</head>
<body>
    <form class="form-signin" action="" id="profileForm" method="post">
        <div class="form-group">
            <input type="text" name="username">
            <button class="btn btn-lg btn-login btn-block" type="submit">Login</button>
        </div>
    </form>

    {{--<form class="form-signin" action="" id="profileForm" method="post">--}}
        {{--<div class="form-group">--}}
            {{--<label class="control-label">Name</label>--}}
            {{--<input type="text" name="username" value="{{ old('username') }}" class="form-control"--}}
                   {{--placeholder="Teacher Numbering..">--}}
        {{--</div>--}}
        {{--<button class="btn btn-lg btn-login btn-block" type="submit">Login</button>--}}
    {{--</form>--}}
</body>

<script>
    $('#profileForm').bootstrapValidator({
        fields: {
            username: {
                // The "group" option can be set via HTML attribute
                // <input type="text" class="form-control" name="lastName" data-bv-group=".group" />
                validators: {
                    notEmpty: {
                        message: 'The last name is required and cannot be empty'
                    }
                }
            }
        }
    });
</script>
</html>