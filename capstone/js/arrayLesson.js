var stage = new Kinetic.Stage({
        container: 'container',
        width: 578,
        height: 400
      });
      var shapesLayer = new Kinetic.Layer();
      var group_1 = new Kinetic.Group({
        draggable: true
      });
      var group_2 = new Kinetic.Group({
        draggable: true
      });
      var group_3 = new Kinetic.Group({
        draggable: true
      });
      var colors = ['red', 'orange', 'yellow', 'green', 'blue', 'purple'];
	  colors = ['green', 'green', 'green', 'green', 'green', 'green'];
      for(var n = 0; n < 6; n++) {
        // anonymous function to induce scope
        (function() {
          var i = n;
          var box = new Kinetic.Rect({
            x: 30 + 210,
            y: i * 50 + 30,
            width: 100,
            height: 50,
            name: colors[i],
            fill: 'green',
            stroke: 'black',
            strokeWidth: 4
          });

          group_1.add(box);
        })();
        
        //Text - Index numbers
      	(function() {
          var i = n;
          var box = new Kinetic.Rect({
            x: 30 + 210,
            y: i * 50 + 30,
            width: 100,
            height: 50,
            name: colors[i],
            fill: 'green',
            stroke: 'black',
            strokeWidth: 4
          });

          group_1.add(box);
        })();
      
      
      }
      for(var n = 0; n < 6; n++) {
        // anonymous function to induce scope
        (function() {
          var i = n;
          var box = new Kinetic.Rect({
            x: 30 + 400,
            y: i * 50 + 30,
            width: 100,
            height: 50,
            name: colors[i],
            fill: 'red',
            stroke: 'black',
            strokeWidth: 4
          });
        group_2.add(box);
    })()}
    for(var n = 0; n < 6; n++) {
	// anonymous function to induce scope
        (function() {
          var i = n;
          var box = new Kinetic.Rect({
            x: 30 + 20,
            y: i * 50 + 30,
            width: 100,
            height: 50,
            name: colors[i],
            fill: 'blue',
            stroke: 'black',
            strokeWidth: 4
          });
          group_3.add(box);
        })();
      }
      /*var hexagon = new Kinetic.RegularPolygon({
        x: stage.getWidth() / 2,
        y: stage.getHeight() / 2,
        sides: 6,
        radius: 70,
        fill: 'red',
        stroke: 'black',
        strokeWidth: 4
      });*/

      shapesLayer.add(group_1);
      shapesLayer.add(group_2);
      shapesLayer.add(group_3);
      //shapesLayer.add(hexagon);
      stage.add(shapesLayer);

      var amplitude = 150;
      // in ms
      var period = 2000;
      var centerX = stage.getWidth() / 2;

		//group_1.on('mouseover', function() {
        //document.body.style.cursor = 'pointer';
      //});
      //group.on('mouseout', function() {
        //document.body.style.cursor = 'default';
      //});
      /*var anim = new Kinetic.Animation(function(frame) {
        hexagon.setX(amplitude * Math.sin(frame.time * 2 * Math.PI / period) + centerX);
      }, shapesLayer);

      document.getElementById('start').addEventListener('click', function() {
        anim.start();
      }, false);
      
      document.getElementById('stop').addEventListener('click', function() {
        anim.stop();
      }, false);*/