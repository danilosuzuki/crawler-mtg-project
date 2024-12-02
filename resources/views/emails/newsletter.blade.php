<!DOCTYPE html>
<html>
<head>
    <title>Newsletter TRF-1 Rank</title>
    <style>
        .container {
            text-align: center;
            margin-top: 50px;
        }
        .square {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }
        .card {
            width: 20%; /* Default width for very small screens */
        }
        @media (max-width: 600px) {
        .card {
        width: 50%; /* Width for tablets and larger phones */
        }
        }
        @media (min-width: 1024px) {
        .card {
        width: 20%; /* Width for desktops */
        }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Most popular Commanders this week</h1>
        <div class="square">
            @foreach ($content as $card)
                @if($card['is_commander'])
                    <div class="card">
                        <img src="{{ $card['image'] }}" alt="{{ $card['name'] }}" style="width:100%;"/>
                    </div>
                @endif
            @endforeach
        </div>
        <h2>Most used Cards this week</h2>
        <div class="square">
            @foreach ($content as $card)
            @if(!$card['is_commander'])
            <div class="card">
                <h3>{{ $card['value'] }}x</h3>
                <img src="{{ $card['image'] }}" alt="{{ $card['name'] }}" style="width:100%;"/>
            </div>
            @endif
            @endforeach
        </div>
    </div>
</body>
</html>