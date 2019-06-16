@if ($errors->any())
    <div class="alert alert-danger">
        <ul style="list-style:disc; margin-top:8px"> 
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif 