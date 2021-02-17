var Width 	= 800;
var Height 	= 600;
var gl 		= null;
var zz 		= 0;

var Model_view = function(mdl) {	this.modelViewMat = mat4.create();
	this.projectionMat = mat4.create();
	this.camera = mat4.create();
	this.modelViewInvMat = mat3.create();
	this.cameraMat = mat4.create();

	//this.nullLightmap = null;

	this.cameraPosition = [-300, -100, -100];
	this.speed = 15;
	this.zAngle = 5;
	this.xAngle = 0.45;
	//this.yAngle = -45;

	this.frame = 0;
	this.pressed = new Array(128);

	this.activeShader = null;
	this.model = mdl;
	this.init();}

Model_view.prototype =
{
	init: function() {
		// initialize canvas
		var canvas = document.getElementById("viewport");
		canvas.width = Width;
		canvas.height = Height;

		//gl = getAvailableContext(canvas, ["webgl", "experimental-webgl"]);
		gl = canvas.getContext("webgl", {preserveDrawingBuffer: true, premultipliedAlpha: false});

		if (!gl)
		{
			alert("Error while obtaining WebGL Context");
		}
		else
		{
			this.initEvents();

			gl.viewportWidth = Width;
			gl.viewportHeight = Height;
			this.initGL();

			var self = this;
			//console.log("Сука: ", self.model);
			// Draw Frames in quick succession

			//this.nullLightmap = createSolidTexture(gl, [111,111,111,0]);

			setInterval(function()
			{                //$("#info").html("Frame: "+self.frame+"<b>xAngle</b>: "+self.xAngle+" <b>zAngle</b>: "+self.zAngle+" <b>cameraPosition[</b>: "+this.cameraPosition[0]+","+this.cameraPosition[1]+","+this.cameraPosition[2]+"]");
                $("#info").html(
                	"<b>Frame</b>: "+self.frame+
                	"<br><b>cameraPosition</b>:"+
                	"<br>x:"+self.cameraPosition[0]+
                	"<br>y:"+self.cameraPosition[1]+
                	"<br>z:"+self.cameraPosition[2]+
                	"<br><b>zAngle</b>: "+self.zAngle+
                	"<br><b>xAngle</b>: "+self.xAngle
                	//"<br>test: "+ JSON.stringify(self.model.header)

                	//"<br><b>pressed</b>: "+JSON.stringify(self.pressed)
                	//"<br><b>---</b>: "+JSON.stringify(self.cameraPosition)+
                 	//"<br>--"+JSON.stringify(self.modelViewMat)
                );
				self.drawFrame(self.activeShader);
				self.frame++;
			}, 15);
		}
	},

	initShaders: function(gl)
	{
		this.activeShader = createShaderProgram(gl, 'lightmap-vs', 'lightmap-fs');
	},

	initGL: function()
	{
		gl.viewport(0, 0, gl.viewportWidth, gl.viewportHeight);
        gl.clearColor(0.0, 0.0, 0.0, 0);
        gl.clearDepth(1.0);
        gl.enable(gl.DEPTH_TEST);
        //gl.disable(gl.DEPTH_TEST);
        gl.depthFunc(gl.LEQUAL);

        gl.enable(gl.CULL_FACE);
        gl.cullFace(gl.FRONT);

        gl.enable(gl.BLEND);
        gl.blendFunc(gl.SRC_ALPHA, gl.ONE_MINUS_SRC_ALPHA);

		// setup matrices
		mat4.perspective(45.0, gl.viewportWidth/gl.viewportHeight, 1.0, 5000, this.projectionMat);
		mat4.identity(this.camera);





		this.initShaders(gl);
	},

	drawModel: function(shader)
	{
		gl.activeTexture(gl.TEXTURE1);
		//gl.bindTexture(gl.TEXTURE_2D, this.nullLightmap);
		gl.uniform1i(shader.uniform.lightmap, 0);
		var e = this.model;
        zz += 0.005;
		mat4.identity(this.modelViewMat);
		mat4.rotateX(this.modelViewMat, this.xAngle-Math.PI/2);
		//mat4.rotateY(this.modelViewMat, this.yAngle-Math.PI/2);
		mat4.rotateZ(this.modelViewMat, this.zAngle);
		mat4.translate(this.modelViewMat, this.cameraPosition);
		//mat4.translate(this.modelViewMat, [0,0,0]);
		//mat4.rotateZ(this.modelViewMat, zz*Math.PI/2);
		//mat4.rotateY(modelViewMat, 90*Math.PI/2);
		gl.uniformMatrix4fv(shader.uniform.modelViewMat, false, this.modelViewMat);
		//gl.uniform1i(shader.useLightingUniform, true);
		e.draw(shader);
	},

	drawFrame: function(shader)
	{

		gl.enableVertexAttribArray(shader.attribute.position);
		gl.enableVertexAttribArray(shader.attribute.texCoord);
		gl.enableVertexAttribArray(shader.attribute.texCoord2);

		gl.enable(gl.CULL_FACE);

		if (shader.uniform.lightmap)
			{
				// Bind the lightmap texture (shared by all faces)
				gl.activeTexture(gl.TEXTURE1);
				gl.bindTexture(gl.TEXTURE_2D,  createSolidTexture(gl, [0,0,0,0]));
				gl.uniform1i(shader.uniform.lightmap, 1);
			}

			gl.uniform1f(shader.uniform.alpha, 1.0);
		gl.clear(gl.COLOR_BUFFER_BIT | gl.DEPTH_BUFFER_BIT);
        var self = this;
		// set default shader
		gl.useProgram(shader);



		// setup matrices
		//mat4.identity(self.modelViewMat);
		//mat4.rotateX(self.modelViewMat, self.xAngle-Math.PI/2);
		//mat4.rotateZ(self.modelViewMat, self.zAngle);
		//mat4.translate(self.modelViewMat, self.cameraPosition);

		//gl.uniformMatrix4fv(shader.uniform.modelViewMat, false, self.modelViewMat);
		gl.uniformMatrix4fv(shader.uniform.projectionMat, false, this.projectionMat);

		this.drawModel(shader);

	},
	initEvents: function()
	{
		var movingModel = false;
		var lastX = 0;
		var lastY = 0;
		var self = this;

		$(window).keydown(function(event) {
			self.pressed[event.keyCode] = true;
		});

		$(window).keyup(function(event) {
			self.pressed[event.keyCode] = false;
		});

			setInterval(function() {
			// This is our first person movement code. It's not really pretty, but it works
			var dir = [0, 0, 0];
			if(self.pressed['W'.charCodeAt(0)]) {
				dir[2] += self.speed;
			}
			if(self.pressed['S'.charCodeAt(0)]) {
				dir[2] -= self.speed;
			}
			if(self.pressed['A'.charCodeAt(0)]) {
				dir[0] += self.speed;
			}
			if(self.pressed['D'.charCodeAt(0)]) {
				dir[0] -= self.speed;
			}
			if(self.pressed[17]) {
				dir[1] += self.speed;
			}
			if(self.pressed[32]) {
				dir[1] -= self.speed;
			}

			mat4.identity(self.cameraMat);
			mat4.rotateX(self.cameraMat, self.xAngle-Math.PI/2);
			mat4.rotateZ(self.cameraMat, self.zAngle);
			mat4.inverse(self.cameraMat);

			mat4.multiplyVec3(self.cameraMat, dir);
			vec3.add(self.cameraPosition, dir);

		}, 33);


		$('#viewport').mousedown(function(event) {
			if(event.which == 1) {
				movingModel = true;
			}
			lastX = event.pageX;
			lastY = event.pageY;
		});

		$('#viewport').mouseup(function(event) {
			movingModel = false;
		});

		$('#viewport').mousemove(function(event) {
			var xDelta = event.pageX  - lastX;
			var yDelta = event.pageY  - lastY;
			lastX = event.pageX;
			lastY = event.pageY;


			if (movingModel) {
				self.zAngle += xDelta*0.025;
				while (self.zAngle < 0)
					self.zAngle += Math.PI*2;
				while (self.zAngle >= Math.PI*2)
					self.zAngle -= Math.PI*2;

				self.xAngle += yDelta*0.025;
				while (self.xAngle < -Math.PI*0.5)
					self.xAngle = -Math.PI*0.5;
				while (self.xAngle > Math.PI*0.5)
					self.xAngle = Math.PI*0.5;
			}
		});
	}


}