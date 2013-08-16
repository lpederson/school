var stage = new Kinetic.Stage({
        container: 'container2',
        width: 600,
        height: 600
      });
      var shapesLayer = new Kinetic.Layer();
      //var shapesLayer2  = new Kinetic.Layer();
      var group_1 = new Kinetic.Group({
        draggable: true
      });
      /*
      var group_2 = new Kinetic.Group({
      	draggable: false
      });
      */

      var colors = ['red', 'orange', 'yellow', 'green', 'blue', 'purple','brown'];
	  //colors = ['green', 'green', 'green', 'green', 'green', 'green'];
      for(var n = 0; n < 7; n++) {
        // anonymous function to induce scope
        for(var m = 0 ; m < 4 ; m++) {
			(function() {
			  var i = n;
			  var j = m;
			  var box = new Kinetic.Rect({
				x: m * 50 + 200,
				y: n * 50 + 30,
				width: 50,
				height: 50,
				name: 'box',
				fill: colors[i],
				stroke: 'black',
				strokeWidth: 4
			  });

			  group_1.add(box);
			})();
		}
	  }
      //var cellIterator = 0;
      /*
     for(var a = 0; a < 7; a++) {
        // anonymous function to induce scope
        for(var b = 0 ; b < 4 ; b++) {
			(function() {
			  var r = a;
			  var t = b;
			  var cellText = new Kinetic.Text({
					x: t * 50 + 30,
					y: r * 50 + 30,
					text: '$$$$$$',
					fontSize: 18,
					fontFamily: 'Calibri',
					fill: '#555',
					name: 'text',
					width: 20,
					padding: 20,
					align: 'center'
				});
			  //cellIterator++;
			  group_1.add(cellText);
			})();
		}
      }
	*/
      shapesLayer.add(group_1);
      //shapesLayer.add(group_2):
      stage.add(shapesLayer);
   
      