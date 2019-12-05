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
	<title>DUCK</title>
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

var mesh1;

initialize();
animate();

function initialize()
{
	scene = new THREE.Scene();

	let ambientLight = new THREE.AmbientLight( 0xcccccc, 1.0 );
	scene.add( ambientLight );

	camera = new THREE.Camera();
	scene.add(camera);

	renderer = new THREE.WebGLRenderer({
		antialias : true,
		alpha: true
	});
	renderer.setClearColor(new THREE.Color('lightgrey'), 0)
	renderer.setSize( 640, 480 );
	renderer.domElement.style.position = 'absolute'
	renderer.domElement.style.top = '0px'
	renderer.domElement.style.left = '0px'
	document.body.appendChild( renderer.domElement );

	clock = new THREE.Clock();
	deltaTime = 0;
	totalTime = 0;

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
	markerRoot1.name = 'marker1';
	scene.add(markerRoot1);
	let markerControls1 = new THREEx.ArMarkerControls(arToolkitContext, markerRoot1, {
		type : 'pattern',
		patternUrl : "{{ asset('data/pattern-hiero_1.patt') }}",
	})

	// the inside of the hole
	let geometry1	= new THREE.CubeGeometry(2,2,2);
	let loader = new THREE.TextureLoader();
	let texture_1 = loader.load(" {{ asset('image/number/Group_1.png') }} ");
	let texture_2 = loader.load(" {{ asset('image/number/Group_5.png') }} ");
	let texture_3 = loader.load(" {{ asset('image/number/Group_3.png') }} ");
	let texture_4 = loader.load(" {{ asset('image/number/Group_4.png') }} ");
	let texture_5 = loader.load(" {{ asset('image/number/Group_2.png') }} ");
	let texture_6 = loader.load(" {{ asset('image/number/Group_5.png') }} ");
	let material1	= [new THREE.MeshLambertMaterial({
		transparent : true,
		map: texture_1,
		side: THREE.BackSide
	}),new THREE.MeshLambertMaterial({
		transparent : true,
		map: texture_2,
		side: THREE.BackSide
	}),new THREE.MeshLambertMaterial({
		transparent : true,
		map: texture_6,
		side: THREE.BackSide
	}),new THREE.MeshLambertMaterial({
		transparent : true,
		map: texture_3,
		side: THREE.BackSide
	}),new THREE.MeshLambertMaterial({
		transparent : true,
		map: texture_4,
		side: THREE.BackSide
	}),new THREE.MeshLambertMaterial({
		transparent : true,
		map: texture_5,
		side: THREE.BackSide
	}),];

	mesh1 = new THREE.Mesh( geometry1, material1 );
	mesh1.position.y = -1;

	markerRoot1.add( mesh1 );

	// the invisibility cloak (box with a hole)
	let geometry0 = new THREE.BoxGeometry(2,2,2);
	geometry0.faces.splice(4, 2); // make hole by removing top two triangles

	let material0 = new THREE.MeshBasicMaterial({
		colorWrite: false
	});

	let mesh0 = new THREE.Mesh( geometry0, material0 );
	mesh0.scale.set(1,1,1).multiplyScalar(1.01);
	mesh0.position.y = -1;
	markerRoot1.add(mesh0);
}


function update()
{
	// update artoolkit on every frame
	if ( arToolkitSource.ready !== false )
		arToolkitContext.update( arToolkitSource.domElement );
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
}

</script>

</body>
</html>