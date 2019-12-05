<!DOCTYPE html>
<head>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-151328919-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-151328919-1');
	</script>

	<meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
	<title>COW</title>
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
</head>

<body style='margin : 0px; overflow: hidden; font-family: Monospace;'>

<!--
  Example created by Lee Stemkoski: https://github.com/stemkoski
  Based on the AR.js library and examples created by Jerome Etienne: https://github.com/jeromeetienne/AR.js/
-->


<script>

var scene, camera, renderer, clock, deltaTime, totalTime;

var arToolkitSource, arToolkitContext;

var markerRoot1;

var material1, mesh1;

initialize();
animate();

function initialize()
{
	scene = new THREE.Scene();

	camera = new THREE.Camera();
	scene.add(camera);

	renderer = new THREE.WebGLRenderer({
		antialias : true,
		alpha: true
	});
	const width = window.innerWidth;
	const height = window.innerHeight;
	console.log(width, height);
	renderer.setClearColor(new THREE.Color('lightgrey'), 0)
	renderer.setSize( 640, 480 );
	renderer.domElement.style.position = 'absolute'
	renderer.domElement.style.top = '0px'
	renderer.domElement.style.left = '0px'
	document.body.appendChild( renderer.domElement );

	clock = new THREE.Clock();
	deltaTime = 0;
	totalTime = -1.5;

	////////////////////////////////////////////////////////////
	// setup arToolkitSource
	////////////////////////////////////////////////////////////

	arToolkitSource = new THREEx.ArToolkitSource({
		sourceType : 'webcam',
	});

	function onResize()
	{
		arToolkitSource.onResizeElement()
		arToolkitSource.copyElementSizeTo(renderer.domElement)
		if ( arToolkitContext.arController !== null )
		{
			arToolkitSource.copyElementSizeTo(arToolkitContext.arController.canvas)
		}
	}

	arToolkitSource.init(function onReady(){
		onResize()
	});

	// handle resize event
	window.addEventListener('resize', function(){
		onResize()
	});

	////////////////////////////////////////////////////////////
	// setup arToolkitContext
	////////////////////////////////////////////////////////////

	// create atToolkitContext
	arToolkitContext = new THREEx.ArToolkitContext({
		cameraParametersUrl: "{{ asset('data/camera_para.dat') }}",
		detectionMode: 'mono'
	});

	// copy projection matrix to camera when initialization complete
	arToolkitContext.init( function onCompleted(){
		camera.projectionMatrix.copy( arToolkitContext.getProjectionMatrix() );
	});

	////////////////////////////////////////////////////////////
	// setup markerRoots
	////////////////////////////////////////////////////////////

	// build markerControls
	markerRoot1 = new THREE.Group();
	scene.add(markerRoot1);
	let markerControls1 = new THREEx.ArMarkerControls(arToolkitContext, markerRoot1, {
		type: 'pattern', patternUrl: "{{ asset('data/pattern-hiero_3.patt') }}",
	})

	////////////////////////////////////////////////////////////
	// setup scene
	////////////////////////////////////////////////////////////

	renderer.shadowMap.enabled = true;
	renderer.shadowMap.type = THREE.PCFSoftShadowMap;

	let loader = new THREE.TextureLoader();

	let sceneGroup = new THREE.Group();
	markerRoot1.add(sceneGroup);

	let floorGeometry = new THREE.PlaneGeometry( 20,20 );
	let floorMaterial = new THREE.ShadowMaterial();
	floorMaterial.opacity = 0.3;
	let floorMesh = new THREE.Mesh( floorGeometry, floorMaterial );
	floorMesh.rotation.x = -Math.PI/2;
	floorMesh.receiveShadow = true;
	sceneGroup.add( floorMesh );


	ballMeshArray = [];
	let ballTexture = loader.load("{{ asset('image/ball/basketball-gray.png') }}");
	let ballColors = [ 0xff0000, 0x009900, 0xff8800 ];
	let p = 1;
	let ballPositions = [ new THREE.Vector3(1,1,1), new THREE.Vector3(0,0,0), new THREE.Vector3(0,0,0)];
	for (let n = 0; n < 3; n++)
	{
		let ballMesh = new THREE.Mesh(
			new THREE.SphereGeometry(0.05, 32, 32),
			new THREE.MeshLambertMaterial({
				map: ballTexture,
				color: ballColors[n]
			})
		);
		ballMesh.position.copy(ballPositions[n]);
		ballMesh.castShadow = true;
		sceneGroup.add( ballMesh );
		ballMeshArray[n] = ballMesh;
	}

	let light = new THREE.PointLight( 0xffffff, 1, 100 );
	light.position.set( 0,15,0 ); // default; light shining from top
	light.castShadow = true;
	sceneGroup.add( light );

	let lightSphere = new THREE.Mesh(
		new THREE.SphereGeometry(0.1),
		new THREE.MeshBasicMaterial({
			color: 0xffffff,
			transparent: true,
			opacity: 0.8
		})
	);
	lightSphere.position.copy( light.position );
	sceneGroup.add( lightSphere );

	let ambientLight = new THREE.AmbientLight( 0x666666 );
	sceneGroup.add( ambientLight );
	// let helper = new THREE.CameraHelper( light.shadow.camera );
	// sceneGroup.add( helper );
}

function update()
{
	// update artoolkit on every frame
	if ( arToolkitSource.ready !== false )
		arToolkitContext.update( arToolkitSource.domElement );

	ballMeshArray[0].position.y = 1.1 * (Math.abs(Math.sin(Math.PI * totalTime / 2)) + 0);
	ballMeshArray[1].position.y = 1.3 * (Math.abs(Math.sin(Math.PI * totalTime / 2)) + 0);
	ballMeshArray[2].position.y = 1.5 * (Math.abs(Math.sin(Math.PI * totalTime / 2)) + 0);

	if ( 0<= totalTime && totalTime<2 )
	{
		ballMeshArray[0].position.x = 1.08 * totalTime / 2 ;
		ballMeshArray[1].position.x = 0.328 * totalTime / 2 ;
		ballMeshArray[2].position.x = -0.772 * totalTime / 2 ;

		ballMeshArray[0].position.z = 2.4 * totalTime / 2 ;
		ballMeshArray[1].position.z = 2.4 * totalTime / 2 ;
		ballMeshArray[2].position.z = 0.9 * totalTime / 2 ;
	}

	if ( 2<= totalTime && totalTime<4 )
	{
		ballMeshArray[0].position.x = 0.15 * (totalTime - 2 ) + 1.08 ;
		ballMeshArray[1].position.x = -0.55 * (totalTime - 2 ) + 0.328 ;
		ballMeshArray[2].position.x = 0.9 * (totalTime - 2) - 0.772;

		ballMeshArray[0].position.z = 2.4 ;
		ballMeshArray[1].position.z = -0.75 * (totalTime - 2 ) + 2.4 ;
		ballMeshArray[2].position.z = 0.34 * (totalTime - 2 ) + 0.9 ;
	}

	if ( 4<= totalTime && totalTime<6 )
	{
		ballMeshArray[0].position.x = - 1.43 * (totalTime - 4 ) + 1.38 ;
		ballMeshArray[1].position.x = 0.55 * (totalTime - 4 ) - 0.772 ;
		ballMeshArray[2].position.x = -1.25 * (totalTime - 4 ) +  1.028 ;

		ballMeshArray[0].position.z = -0.55 * (totalTime - 4 ) + 2.4 ;
		ballMeshArray[1].position.z = 0.75 * (totalTime - 4 ) + 0.9 ;
		ballMeshArray[2].position.z = -0.35 * (totalTime - 4 ) + 1.58 ;
	}

}


function render()
{
	renderer.render( scene, camera );
}


function animate()
{
	requestAnimationFrame(animate);
	deltaTime = clock.getDelta();
	totalTime += deltaTime;
	update();
	render();

	if (totalTime >=7)
	{
		totalTime = 0;
	}
}

</script>

</body>
</html>
