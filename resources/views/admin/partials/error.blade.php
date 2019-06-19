@if($errors->any())
    <div class="alert alert-danger">
        <strong>输入错误：</strong>
        你的输入出现错误！<br><br>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif