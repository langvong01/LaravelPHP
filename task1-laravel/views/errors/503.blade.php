<?php
?>
<!DOCTYPE html>
<html lang="en">
</head>
<head>
    <body>
            <div class="container">
                <div class="content">


                @if(count($errors)>0)
                    <div class="alert alert-danger">
                        <h3 class="text-muted">Đã có Lỗi xảy ra</h3>
                    </div>
                    </br>
                    <ul>
                        @foreach($errors as $error)
                            <li> {{$error}}</li>
                        @endforeach
                    </ul>
                    @endif
            </div>
            </div>
    </body>
</html>

