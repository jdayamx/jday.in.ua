<script src="/js/three.min.js"></script>
<script type="text/javascript" src="/js/hl1/js-struct.js"></script>
<script type="text/javascript" src="/js/hl1/hlmdl.js"></script>

<div id="glcanvas">

</div>

<script>

			var camera, scene, renderer;
			var mesh;
			var mesh2;
			var mesh3;
			//var model = new HLMDL("models/forge_tree1.mdl");

			init();
			animate();

			function init() {

				renderer = new THREE.WebGLRenderer({ antialias: true });
				renderer.setSize( 800, 600 );
				renderer.setClearColor(0x00ffff, 0.0);
				document.getElementById('glcanvas').appendChild( renderer.domElement );

				//

				camera = new THREE.PerspectiveCamera( 70,800 / 600, 1, 1000 );
				camera.position.z = 500;

				scene = new THREE.Scene();
				//scene.Fog( 0xffffff, 1, 1000 );

				var geometry = new THREE.BoxGeometry( 200, 200, 200 );
				var geometry2 = new THREE.BoxGeometry( 100, 100, 100 );
				//var geometry3 = model.;
				//geometry2.position.z

				var texture = THREE.ImageUtils.loadTexture( 'http://jday.in.ua/uploads/Textures/kz_winterdust.bsp/kz_winterdust.bsp_513c0e01f57aaafe4b9e266369a9394c.png' );
				texture.anisotropy = renderer.getMaxAnisotropy();

				var material = new THREE.MeshBasicMaterial( { map: texture } );

				mesh = new THREE.Mesh( geometry, material );
				mesh2 = new THREE.Mesh( geometry2, material );
				mesh3 = new THREE.Mesh( geometry2, material );
				mesh2.position =  new THREE.Vector3(150, 50, 0);
				mesh3.position =  new THREE.Vector3(150, 150, 0);
				scene.add( mesh );
				scene.add( mesh2 );
				scene.add( mesh3 );



				window.addEventListener( 'resize', onWindowResize, false );

			}

			function onWindowResize() {

				camera.aspect = window.innerWidth / window.innerHeight;
				camera.updateProjectionMatrix();

				renderer.setSize( window.innerWidth, window.innerHeight );

			}

			function animate() {

				requestAnimationFrame( animate );

				mesh.rotation.x += 0.005;
				mesh.rotation.y += 0.01;
				mesh2.rotation.y += 0.01;
				mesh2.rotation.z += 0.01;
                //model.draw(renderer);
				renderer.render( scene, camera );

			}

		</script>