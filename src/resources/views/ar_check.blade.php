<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <title>AR CHECK</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Libraries -->
    <script src="https://aframe.io/releases/0.9.2/aframe.min.js"></script>
    <script src="https://cdn.rawgit.com/donmccurdy/aframe-extras/v6.0.0/dist/aframe-extras.min.js"></script>
    <script src="https://raw.githack.com/jeromeetienne/AR.js/2.0.5/aframe/build/aframe-ar.js"></script>
</head>
<body style="overflow: hidden;">
    <a-scene embedded arjs="sourceType: webcam; debugUIEnabled: false;" vr-mode-ui="enabled: false" detectionMode="mono" maxDetectionRate="100">
        <a-marker type="pattern" url="{{ asset('data/pattern-ar-check.patt') }}" id="marker-ar">
            <a-entity text="value: OK!; height: 5; width: 10; align: center; color: #00ff00;" rotation="-90 0 0"></a-entity>
        </a-marker>
        <a-entity camera>
        </a-entity>
    </a-scene>
</body>
</html>
