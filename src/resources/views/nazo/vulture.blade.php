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
	<title>VULTURE</title>
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
	<script src="{{ asset('threex/threex-arsmoothedcontrols.js') }}"></script>
</head>

<body style='margin : 0px; overflow: hidden; font-family: Monospace;'>

<!--
  Example created by Lee Stemkoski: https://github.com/stemkoski
  Based on the AR.js library and examples created by Jerome Etienne: https://github.com/jeromeetienne/AR.js/
-->

<script>

var scene, camera, renderer, clock, deltaTime, totalTime;

var arToolkitSource, arToolkitContext, smoothedControls;

var markerRoot1, markerRoot2;

var portal, portalMaterial;

initialize();
animate();

function initialize()
{
	scene = new THREE.Scene();

	let ambientLight = new THREE.AmbientLight( 0xcccccc, 0.5 );
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
	kanjiMarker = new THREE.Group();
	scene.add(kanjiMarker);

	let markerControls1 = new THREEx.ArMarkerControls(arToolkitContext, kanjiMarker, {
		type : 'pattern',
		patternUrl : "{{ asset('data/pattern-hiero_5.patt') }}",
	})

	// interpolates from last position to create smoother transitions when moving.
	// parameter lerp values near 0 are slow, near 1 are fast (instantaneous).
	let smoothedRoot = new THREE.Group();
	scene.add(smoothedRoot);
	smoothedControls = new THREEx.ArSmoothedControls(smoothedRoot, {
		lerpPosition: 0.5,
		lerpQuaternion: 0.5,
		lerpScale: 1,
		// minVisibleDelay: 1,
		// minUnvisibleDelay: 1,
	});

	////////////////////////////////////////////////////////////
	// setup scene
	////////////////////////////////////////////////////////////

	let loader = new THREE.TextureLoader();

	// material for portal (for debugging)

	let defaultMaterial = new THREE.MeshBasicMaterial({
		map: loader.load("{{ asset('image/portal/sphere-colored.png') }}"),
		color: 0x444444,
		side: THREE.DoubleSide,
		transparent: true,
		opacity: 0.6
	});

	let portalWidth = 4;
	let portalHeight = 4;
	let portalBorder = 0.1;

	portal = new THREE.Mesh(
		new THREE.PlaneGeometry(portalWidth, portalHeight),
		defaultMaterial
	);
	portal.position.y = 0;
	portal.rotation.x = Math.PI/2;
	portal.layers.set(1);
	smoothedRoot.add(portal);

	camera.layers.enable(1);

	portalMaterial = new THREE.MeshBasicMaterial({ color: 0xffff00, side: THREE.DoubleSide, transparent:true, opacity: 0.75 });


	let portalBorderMesh = new THREE.Mesh(
		new THREE.PlaneGeometry(portalWidth + 2*portalBorder, portalHeight + 2*portalBorder),
		portalMaterial
	);
	portalBorderMesh.position.y = portal.position.y;
	portalBorderMesh.rotation.x = Math.PI/2
	portalBorderMesh.layers.set(0);
	smoothedRoot.add(portalBorderMesh);

	// the world beyond the portal

	// textures from http://www.humus.name/
	let skyMaterialArray = [
		new THREE.MeshBasicMaterial( { map: loader.load("{{ asset('image/portal/posx.png') }}"), side: THREE.BackSide } ),
		new THREE.MeshBasicMaterial( { map: loader.load("{{ asset('image/portal/negx.png') }}"), side: THREE.BackSide } ),
		new THREE.MeshBasicMaterial( { map: loader.load("{{ asset('image/portal/posy.jpg') }}"), side: THREE.BackSide } ),
		new THREE.MeshBasicMaterial( { map: loader.load("{{ asset('image/portal/posz.png') }}"), side: THREE.BackSide } ),
		new THREE.MeshBasicMaterial( { map: loader.load("{{ asset('image/portal/negy.jpg') }}"), side: THREE.BackSide } ),
		new THREE.MeshBasicMaterial( { map: loader.load("{{ asset('image/portal/posy.jpg') }}"), side: THREE.BackSide } ),
	];
	let skyMesh = new THREE.Mesh(
		new THREE.CubeGeometry(30,30,30),
		skyMaterialArray );
	skyMesh.layers.set(2);
	smoothedRoot.add(skyMesh);

}


function update()
{
	// portal ring color cycle
	portalMaterial.color.setHSL( totalTime/10 % 1, 1, 0.75 );

	// update artoolkit on every frame
	if ( arToolkitSource.ready !== false )
		arToolkitContext.update( arToolkitSource.domElement );

	// additional code for smoothed controls
	smoothedControls.update(kanjiMarker);
}


function render()
{
	//renderer.render( scene, camera );

	let gl = renderer.context;

	// clear buffers now: color, depth, stencil
	renderer.clear(true,true,true);
	// do not clear buffers before each render pass
	renderer.autoClear = false;

	// FIRST PASS
	// goal: using the stencil buffer, place 1's in position of first portal (layer 1)

	// enable the stencil buffer
	gl.enable(gl.STENCIL_TEST);

	// layer 1 contains only the first portal
	camera.layers.set(1);

	gl.stencilFunc(gl.ALWAYS, 1, 0xff);
	gl.stencilOp(gl.KEEP, gl.KEEP, gl.REPLACE);
	gl.stencilMask(0xff);

	// only write to stencil buffer (not color or depth)
	gl.colorMask(false,false,false,false);
	gl.depthMask(false);

	renderer.render( scene, camera );

	// SECOND PASS
	// goal: render skybox (layer 2) but only through portal

	gl.colorMask(true,true,true,true);
	gl.depthMask(true);

	gl.stencilFunc(gl.EQUAL, 1, 0xff);
	gl.stencilOp(gl.KEEP, gl.KEEP, gl.KEEP);

	camera.layers.set(2);
	renderer.render( scene, camera );

	// FINAL PASS
	// goal: render the rest of the scene (layer 0)

	// using stencil buffer simplifies drawing border around portal
	gl.stencilFunc(gl.NOTEQUAL, 1, 0xff);
	gl.colorMask(true,true,true,true);
	gl.depthMask(true);

	camera.layers.set(0); // layer 0 contains portal border mesh
	renderer.render( scene, camera );

	// set things back to normal
	renderer.autoClear = true;
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