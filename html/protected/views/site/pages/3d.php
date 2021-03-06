      <script src="/js/mathlib.js"></script>
      <script src="/js/k3d_main.js"></script>
      <script src="/js/k3d_controller.js"></script>
      <script src="/js/k3d_object.js"></script>
      <script src="/js/k3d_light.js"></script>
      <script src="/js/k3d_renderer.js"></script>

      <script>
// bind to window onload event
window.addEventListener('load', onloadHandler, false);

var bitmaps = [];
function onloadHandler()
{
   // get the images loading
   bitmaps.push(new Image());
   bitmaps.push(new Image());
   var loader = new Preloader();
   loader.addImage(bitmaps[0], '/uploads/wad/textures/zm_abyss.wad_289192ad3c421f07361e03146e3eff56.png');
   loader.addImage(bitmaps[1], '/uploads/wad/textures/zm_abyss.wad_fa171d30e45b9b82c94c5aff2a0fd315.png');
   loader.onLoadCallback(init);
}

function init()
{
   // get the canvas DOM element
   var canvas = document.getElementById('canvas');

   // bind a K3D Controller object to the canvas
   // - it is responsible for managing the K3D objects displayed within it
   var k3d = new K3D.Controller(canvas);
   // request 60 frames per second animation from the controller
   k3d.fps = 60;

   // create a K3D object for rendering
   var obj = new K3D.K3DObject();
   obj.textures.push(bitmaps[0]);
   obj.textures.push(bitmaps[1]);
   with (obj)
   {
      drawmode = "solid";     // one of "point", "wireframe", "solid"
      shademode = "lightsource";    // one of "plain", "depthcue", "lightsource" (solid drawing mode only)
      addtheta = addgamma = 1.0;
      scale = 1;
      init(
         // describe the points of a simple unit cube
         [{x:-128,y:128,z:-128}, {x:128,y:128,z:-128}, {x:128,y:-128,z:-128}, {x:-128,y:-128,z:-128}, {x:-128,y:128,z:128}, {x:128,y:128,z:128}, {x:128,y:-128,z:128}, {x:-128,y:-128,z:128}],
         // describe the edges of the cube
         [{a:0,b:1}, {a:1,b:2}, {a:2,b:3}, {a:3,b:0}, {a:4,b:5}, {a:5,b:6}, {a:6,b:7}, {a:7,b:4}, {a:0,b:4}, {a:1,b:5}, {a:2,b:6}, {a:3,b:7}],
         // describe the polygon faces of the cube
         [{color:[255,0,0],vertices:[0,1,2,3],texture:0},{color:[0,255,0],vertices:[0,4,5,1],texture:0},{color:[0,0,255],vertices:[1,5,6,2],texture:0},{color:[255,255,0],vertices:[2,6,7,3],texture:1},{color:[0,255,255],vertices:[3,7,4,0],texture:0},{color:[255,0,255],vertices:[7,6,5,4],texture:1}]
      );
   }

   // add the object to the controller
   k3d.addK3DObject(obj);

   // begin the rendering and animation immediately
   k3d.paused = false;
   k3d.frame();
}
      </script>
   </head>


  <canvas id="canvas" width="1024" height="768" style="background-color: #fff"></canvas>
