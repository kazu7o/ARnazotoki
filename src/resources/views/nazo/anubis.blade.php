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
    <title>ANUBIS</title>
    <!-- include three.js library -->
    <script src="{{ asset('js/three.js') }}"></script>
    <!-- include jsartookit -->
    <script src="{{ asset('jsartoolkit5/artoolkit.min.js') }}"></script>
    <script src="{{ asset('jsartoolkit5/artoolkit.api.js') }}"></script>
    <!-- include threex.artoolkit -->
    <script src="{{ asset('threex/threex-artoolkitsource.js') }}"></script>
    <script src="{{ asset('threex/threex-artoolkitcontext.js') }}"></script>
    <script src="{{ asset('threex/threex-arbasecontrols.js') }}"></script>
    <script src="{{ asset('threex/threex-armarkercontrols.js') }}"></script>
    <!-- include Tween.js -->
    <script src="{{ asset('js/Tween.js') }}"></script>
</head>
<body style="margin: 0px; overflow: hidden;">
    <script>
        var scene, camera, renderer, cube, materials;
        var arToolkitSource, arToolkitContext;
        var markerRoot1, markerControls1;
        var cube_size = 1, counter = 0;
        var i = 0, timer;
        var vector = [
            [0, 0, 0],
            [0, 0, -1],
            [0, -1, 0],
            [1, 0, 0],
            [0, 1, 0]
        ];

        initialize();
        animate();
        render();
        TWEEN.autoPlay(true);
        flow();
        setInterval(flow, 17000)

        function initialize() {
            //シーン
            scene = new THREE.Scene();
            let ambientLight = new THREE.AmbientLight(0xffffff, 1.0);
            scene.add(ambientLight);

            //カメラ
            camera = new THREE.Camera();
            scene.add(camera);

            //レンダラー
            renderer = new THREE.WebGLRenderer({
                antialias: true,
                alpha: true
            });
            renderer.setClearColor(new THREE.Color(0xffffff), 0);
            renderer.setSize(window.innerWidth, window.innerHeight);
            renderer.domElement.style.position = 'absolute';
            renderer.domElement.style.top = '0px';
            renderer.domElement.style.left = '0px';
            document.body.appendChild(renderer.domElement);

            clock = new THREE.Clock();
            deltaTime = 0;
            totalTime = 0;

            //arToolkitの設定
            arToolkitSource = new THREEx.ArToolkitSource({
                sourceType: 'webcam',
            });

            function onResize() {
                arToolkitSource.onResizeElement();
                arToolkitSource.copyElementSizeTo(renderer.domElement);
                if (arToolkitContext.arController !== null) {
                    arToolkitSource.copyElementSizeTo(arToolkitContext.arController.canvas);
                }
            }

            arToolkitSource.init(function onReady(){
                onResize();
            });

            window.addEventListener('resize', function(){
                onResize();
            });

            arToolkitContext = new THREEx.ArToolkitContext({
                cameraParametersUrl: "{{ asset('data/camera_para.dat')}}",
                detectionMode: 'mono'
            });

            arToolkitContext.init(function onCompleted(){
                camera.projectionMatrix.copy(arToolkitContext.getProjectionMatrix());
            });

            //ここからマーカーの設定
            markerRoot1 = new THREE.Group();
            scene.add(markerRoot1);
            markerControls1 = new THREEx.ArMarkerControls(arToolkitContext, markerRoot1, {
                type: 'pattern', patternUrl: "{{ asset('data/pattern-hiero_2.patt') }}",
            })

            //キューブ
            let geometry = new THREE.BoxGeometry(1, 1, 1);
            materials = [
                new THREE.MeshLambertMaterial({map: new THREE.TextureLoader().load("{{ asset('image/cube/up.png') }}"), transparent: true}), // right
                new THREE.MeshLambertMaterial({map: new THREE.TextureLoader().load("{{ asset('image/cube/left.png') }}"), transparent: true}), // left
                new THREE.MeshLambertMaterial({map: new THREE.TextureLoader().load("{{ asset('image/cube/left.png') }}"), transparent: true}), // front
                new THREE.MeshLambertMaterial({map: new THREE.TextureLoader().load("{{ asset('image/cube/up.png') }}"), transparent: true}), // back
                new THREE.MeshLambertMaterial({map: new THREE.TextureLoader().load("{{ asset('image/cube/down.png') }}"), transparent: true}), // top
                new THREE.MeshLambertMaterial({map: new THREE.TextureLoader().load("{{ asset('image/cube/up.png') }}"), transparent: true}), // bottom
            ];
            cube = new THREE.Mesh(geometry, materials);
            cube.position.set(0, 1, 0);
            materials[0].opacity = 0;
            materials[1].opacity = 0;
            materials[2].opacity = 0;
            materials[3].opacity = 0;
            materials[4].opacity = 0;
            materials[5].opacity = 0;
            markerRoot1.add(cube);

            //キューブの軸線
            let line_size = 1;
            let add_line = (obj, end_pos, color) => {
                let start_pos = new THREE.Vector3(0, 0, 0);
                let g = new THREE.Geometry();
                g.vertices.push(start_pos);
                g.vertices.push(end_pos);
                let material = new THREE.LineBasicMaterial({linewidth: 4, color: color});
                let line = new THREE.Line(g, material);
                obj.add(line);
            }
            // add_line(cube, new THREE.Vector3(line_size, 0, 0), "#ff0000");
            // add_line(cube, new THREE.Vector3(0, line_size, 0), "#00ff00");
            // add_line(cube, new THREE.Vector3(0, 0, line_size), "#0000ff");

        }

        function update() {
            if (arToolkitSource.ready !== false) {
                arToolkitContext.update(arToolkitSource.domElement);
            }
        }

        function render() {
            renderer.render(scene, camera);
        }

        // 回転
        function quaternion() {
            return new Promise((resolve, reject) => {
                let origin_quaternion = cube.quaternion.clone();
                let axis = new THREE.Vector3();
                let from_param = {x: 0};    // Tween開始時の値
                let to_param = {x: 1};      // Tween終了時の値
                let duration = 1000;         // アニメーションする時間（ms）
                let tween = new TWEEN.Tween(from_param)
                    .to(to_param, duration)
                    .easing(TWEEN.Easing.Linear)
                    .on('update', ({x}) => {
                        // 回転
                        let new_q = origin_quaternion.clone();
                        let target = new THREE.Quaternion();
                        let rad = (Math.PI / 2) * x;
                        axis['x'] = vector[i][0];
                        axis['y'] = vector[i][1];
                        axis['z'] = vector[i][2];
                        target.setFromAxisAngle(axis, rad);
                        new_q.multiply(target);
                        cube.quaternion.copy(new_q);
                    });
                tween.start();
                i++;
                if (i === 4) {
                    clearInterval(timer);
                }
                resolve();
            })
        }

        function up() {
            return new Promise((resolve, reject) => {
                let origin_pos = cube.position.clone();
                let move_axis = 'y';
                let move_offset = 2;
                let from_param = {x: 0};
                let to_param = {x: 1};
                let duration = 3000;
                let tween1 = new TWEEN.Tween(from_param)
                    .to(to_param, duration)
                    .easing(TWEEN.Easing.Linear)
                    .on('update', ({x}) => {
                        cube.position[move_axis] = origin_pos[move_axis] + (x * 1 * move_offset);
                    }).start();
                resolve();
            })
        }

        function down() {
            return new Promise((resolve, reject) => {
                let origin_pos = cube.position.clone();
                let move_axis = 'y';
                let move_offset = 2;
                let from_param = {x: 0};
                let to_param = {x: 1};
                let duration = 3000;
                let tween1 = new TWEEN.Tween(from_param)
                    .to(to_param, duration)
                    .easing(TWEEN.Easing.Linear)
                    .on('update', ({x}) => {
                        cube.position[move_axis] = origin_pos[move_axis] - (x * 1 * move_offset);
                    }).start();
                resolve();
            })
        }

        function f1() {
            return new Promise((resolve, reject) => {
                console.log("[start]");
                resolve();
            })
        }

        function opacity_easeIn() {
            return new Promise((resolve, reject) => {
                setTimeout(() => {
                    let from_param = {x: 0};
                    let to_param = {x: 1};
                    let duration = 3000;
                    let tween = new TWEEN.Tween(from_param)
                        .to(to_param, duration)
                        .easing(TWEEN.Easing.Linear)
                        .on('update', ({x}) => {
                            materials[0].opacity = x;
                            materials[1].opacity = x;
                            materials[2].opacity = x;
                            materials[3].opacity = x;
                            materials[4].opacity = x;
                            materials[5].opacity = x;
                        }).start();
                }, 2000)
                resolve();
            })
        }

        function opacity_easeOut() {
            return new Promise((resolve, reject) => {
                setTimeout(() => {
                    let from_param = {x: 1};
                    let to_param = {x: 0};
                    let duration = 3000;
                    let tween = new TWEEN.Tween(from_param)
                        .to(to_param, duration)
                        .easing(TWEEN.Easing.Linear)
                        .on('update', ({x}) => {
                            materials[0].opacity = x;
                            materials[1].opacity = x;
                            materials[2].opacity = x;
                            materials[3].opacity = x;
                            materials[4].opacity = x;
                            materials[5].opacity = x;
                        }).start();
                }, 15000)
                resolve();
            })
        }

        function kaiten() {
            return new Promise((resolve, reject) => {
                setTimeout(() => {
                    i = 0;
                    timer = setInterval(quaternion, 2000);
                }, 3000)
                resolve();
            })
        }

        function flow() {
            f1()
            .then(opacity_easeIn)
            .then(kaiten)
            .then(opacity_easeOut)
            .then((response) => {
                console.log("[end]");
            })
        }

        function animate() {
            requestAnimationFrame(animate);
            deltaTime = clock.getDelta();
            totalTime += deltaTime;
            update();
            render();
        }
    </script>
</body>
</html>
