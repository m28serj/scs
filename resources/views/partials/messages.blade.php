<div class="row">
    @foreach($messageGroups as $messageGroup => $messages)
        <div class="col-md-{{12 / count($messageGroups)}}">
            @foreach($messages as $message)
                <div class="alert alert-success">
                    {{$message}}
                </div>
            @endforeach
        </div>
    @endforeach
</div>
