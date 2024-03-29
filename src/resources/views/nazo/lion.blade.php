<!DOCTYPE html>
<html>
<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-151328919-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-151328919-1');
    </script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <title>LION</title>
</head>
<body style="margin: 0; overflow: hidden;">
    <!-- A-Frame ライブラリの読み込み -->
    <script src="{{ url('https://aframe.io/releases/0.9.2/aframe.min.js') }}"></script>
    <!-- AR.js ライブラリの読み込み -->
    <script src="{{ url('https://raw.githack.com/jeromeetienne/AR.js/2.0.5/aframe/build/aframe-ar.js') }}"></script>
    <!-- イベントリスナ-の登録 -->
    <script>
        AFRAME.registerComponent('marker-event', {
            init: function() {
                const marker = this.el;
​
                marker.addEventListener('markerFound', function(){
                    var markerId = marker.id;
                    console.log("marker found.", markerId);
                    document.querySelector('#maru').emit('markerfound');
                });
                marker.addEventListener('markerLost', function(){
                    var markerId = marker.id;
                    console.log("markerLost", markerId);
                    document.querySelector('#maru').emit('markerlost');
                });
​
            }
        });
    </script>
    <!-- A-FrameのVR空間にAR.jsを紐付ける（デバッグUIは非表示） -->
    <a-scene embedded arjs="sourceType: webcam; debugUIEnabled: false;" vr-mode-ui="enabled: false" detectionMode="mono" matrixCodeType="3x3">
        <!-- OBJ形式のCGモデルの読み込み -->
        <a-assets>
		<img id="maru-img" src="{{ asset('image/circle/maru.png') }}">
		<img id="siro-img" src="{{ asset('image/circle/white.png') }}">
		<img id="aka-img" src="{{ asset('image/circle/red.png') }}">
		<img id="ao-img" src="{{ asset('image/circle/blue.png') }}">
		<img id="midori-img" src="{{ asset('image/circle/green.png') }}">
		<img id="kuro-img" src="{{ asset('image/circle/black.png') }}">
		<img id="mizu-img" src="{{ asset('image/circle/light_blue.png') }}">
        </a-assets>
​
        <!-- マーカーを登録 -->
	<a-marker type="pattern" url="{{ asset('data/pattern-hiero_4.patt') }}" id="marker-ar" marker-event>
		<!-- 左から定義 -->
		<!-- 丸 -->
		<a-image id="maru" class="entity" src="#maru-img" position="-0.7 0 -1.3" rotation="-90 0 0" scale="0.35 0.35 0.35"></a-image>
		<a-image id="maru" class="entity" src="#maru-img" position="-1.3 0 -1.3" rotation="-90 0 0" scale="0.35 0.35 0.35"></a-image>
		<!-- 上 -->
		<a-image id="maru" class="entity" src="#siro-img" position="-1.3 0 -0.4" rotation="-90 0 0" scale="0.45 0.45 0.45"></a-image>
		<a-image id="maru" class="entity" src="#aka-img" position="-0.85 0 -0.3" rotation="-90 0 0" scale="0.45 0.45 0.45"></a-image>
		<a-image id="maru" class="entity" src="#ao-img" position="-2.7 0 -0.6" rotation="-90 0 0" scale="0.45 0.45 0.45"></a-image>
		<a-image id="maru" class="entity" src="#midori-img" position="-2 0 -0.6" rotation="-90 0 0" scale="0.45 0.45 0.45"></a-image>
		<a-image id="maru" class="entity" src="#kuro-img" position="2.2 0 -0.5" rotation="-90 0 0" scale="0.45 0.45 0.45"></a-image>
		<a-image id="maru" class="entity" src="#mizu-img" position="2.7.7 0 -0.0.9" rotation="-90 0 0" scale="0.45 0.45 0.45"></a-image>
		<!-- 下 -->
		<a-image id="maru" class="entity" src="#siro-img" position="-1.7 0 0.8" rotation="-90 0 0" scale="0.45 0.45 0.45"></a-image>
		<a-image id="maru" class="entity" src="#aka-img" position="-0.8 0 1" rotation="-90 0 0" scale="0.45 0.45 0.45"></a-image>
		<a-image id="maru" class="entity" src="#ao-img" position="-3 0 0.9" rotation="-90 0 0" scale="0.45 0.45 0.45"></a-image>
		<a-image id="maru" class="entity" src="#midori-img" position="-2.07 0 0.45" rotation="-90 0 0" scale="0.45 0.45 0.45"></a-image>
		<a-image id="maru" class="entity" src="#kuro-img" position="0.9 0 1.35" rotation="-90 0 0" scale="0.45 0.45 0.45"></a-image>
		<a-image id="maru" class="entity" src="#mizu-img" position="1.15 0 1.85" rotation="-90 0 0" scale="0.45 0.45 0.45"></a-image>
        </a-marker>
        <!-- AR用のカメラを置く -->
        <a-entity camera>
            <a-entity cursor="fuse: false; fuseTimeout: 500">
        </a-entity>
    </a-scene>
</body>
</html>
