<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.6.3.js"
        integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <title>Ilias | Innovamat</title>
</head>
<body class="vw-100 vh-100 position-relative">
    @php
        $activityTime = $apiRequest['activity']->time;
        $cont = 0;
    @endphp

    <div class="p-5 bg-secondary text-white d-flex justify-content-between align-items-center">
        <h2>{{ $user->name }} | {{ $apiRequest['activity']->name }}</h2>
        <div class="d-flex timeLeft">
            <p>Tiempo restante:&nbsp;</p>
            <p id="activityTime"></p>
            <p>s</p>
        </div>
    </div>
    <div class="position-absolute top-20 end-0 p-3">
        <a role="button" href="{{ route('user.logout') }}" class="btn btn-danger"><i class="bi bi-box-arrow-right"></i></a>
    </div>

    <div class="position-absolute top-50 start-50 translate-middle">
        <form id="activityForm" action="{{ route('activity.activity-check') }}" method="POST">
            @csrf
            @foreach($apiRequest['exercices'] as $exercice)
            @if($exercice->question == 'Yes')
            <div class="form-group mt-4">
                <label for="ex{{ $cont }}">{{ $exercice->question }}</label>
                <select class="form-control" name="ex{{ $cont }}" required>
                    <option value="" selected disabled hidden>Selecciona una opción</option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
            </div>
            @else
            <div class="form-group mt-4">
                <label for="ex{{ $cont }}">{{ $exercice->question }}</label>
                <input type="text" class="form-control" name="ex{{ $cont }}" required>
            </div>
            @endif
            @php
                $cont++
            @endphp
            @endforeach
            <input class="d-none" type="checkbox" name="timeOut" id="timeOut">
            <button type="submit" class="btn btn-primary w-100 mt-4">Enviar</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
    <script>
        $(document).ready(function(){
            var activityTime = @json($activityTime);
            $('#activityTime').text(activityTime);
            var timer = setInterval(() => {
                if(activityTime == 1){
                    clearInterval(timer);
                    $( "#timeOut" ).prop( "checked", true );
                    $('#activityForm').submit();
                }
                if(activityTime == 15){
                    $('.timeLeft').addClass('text-danger');
                }
                activityTime--;
                $('#activityTime').text(activityTime);
            }, 1000);
        });
    </script>
</body>
</html>