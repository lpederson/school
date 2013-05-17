	var questions = new Array();
		questions[0] = "Number of Students";
		questions[1] = "Is User over 18?";
		questions[2] = "Total Price";
		questions[3] = "Multiple Choice Options for a Quiz";
		questions[4] = "User's Weight";
		questions[5] = "GPA";
		questions[6] = "User's Age";
		questions[7] = "True/False Options for a Quiz";
		questions[8] = "User's Zip Code";
		questions[9] = "User's Initial for Middle Name";
	var answers = new Array();
		answers[0] = "1";
		answers[1] = "3";
		answers[2] = "4";
		answers[3] = "2";
		answers[4] = "1";
		answers[5] = "4";
		answers[6] = "1";
		answers[7] = "3";
		answers[8] = "1";
		answers[9] = "2";
	var input = new Array();
		input[0] = "0";
		input[1] = "0";
		input[2] = "0";
		input[3] = "0";
		input[4] = "0";
		input[5] = "0";
		input[6] = "0";
		input[7] = "0";
		input[8] = "0";
		input[9] = "0";

		
		
   var stage = new Kinetic.Stage({
        container: 'container',
        width: 575,
        height: 250
      });
      var layer = new Kinetic.Layer();

      var simpleText = new Kinetic.Text({
        x: stage.getWidth() / 2,
        y: 35,
        text: 'Number of Students',
        fontSize: 30,
        fontFamily: 'Calibri',
        fill: '#555'
      });

      // to align text in the middle of the screen, we can set the
      // shape offset to the center of the text shape after instantiating it
      simpleText.setOffset({
        x: simpleText.getWidth() / 2
      });
	
      var intText = new Kinetic.Text({
        x: 10,
        y: 175,
        text: 'int',
        fontSize: 18,
        fontFamily: 'Calibri',
        fill: 'blue',
        width: 130,
        padding: 20,
        align: 'center'
      });
      var charText = new Kinetic.Text({
        x: 150,
        y: 175,
        text: 'char',
        fontSize: 18,
        fontFamily: 'Calibri',
        fill: 'blue',
        width: 130,
        padding: 20,
        align: 'center'
      });
	  var boolText = new Kinetic.Text({
        x: 290,
        y: 175,
        text: 'bool',
        fontSize: 18,
        fontFamily: 'Calibri',
        fill: 'blue',
        width: 130,
        padding: 20,
        align: 'center'
      });
      var doubleText = new Kinetic.Text({
        x: 430,
        y: 175,
        text: 'double',
        fontSize: 18,
        fontFamily: 'Calibri',
        fill: 'blue',
        width: 130,
        padding: 20,
        align: 'center'
      });
      
      var correct = new Kinetic.Text({
        x: 100,
        y: 15,
        text: 'CORRECT\n\n Very Good!',
        fontSize: 18,
        fontFamily: 'Calibri',
        fill: 'green',
        width: 380,
        padding: 20,
        align: 'center'
      });
	  var incorrect = new Kinetic.Text({
        x: 100,
        y: 15,
        text: 'INCORRECT\n\n That answer is not correct.',
        fontSize: 18,
        fontFamily: 'Calibri',
        fill: 'red',
        width: 380,
        padding: 20,
        align: 'center'
      });
      var rect = new Kinetic.Rect({
        x: 100,
        y: 15,
        stroke: '#555',
        strokeWidth: 5,
        fill: '#ddd',
        width: 380,
        height: correct.getHeight(),
        shadowColor: 'black',
        shadowBlur: 10,
        shadowOffset: [10, 10],
        shadowOpacity: 0.2,
        cornerRadius: 10
      });

	  var intButton = new Kinetic.Rect({
        x: 10,
        y: 175,
        stroke: '#555',
        strokeWidth: 5,
        fill: '#ddd',
        width: 130,
        height: 50,
        shadowColor: 'black',
        shadowBlur: 10,
        shadowOffset: [10, 10],
        shadowOpacity: 0.2,
        cornerRadius: 10
      });
	  var charButton = new Kinetic.Rect({
        x: 150,
        y: 175,
        stroke: '#555',
        strokeWidth: 5,
        fill: '#ddd',
        width: 130,
        height: 50,
        shadowColor: 'black',
        shadowBlur: 10,
        shadowOffset: [10, 10],
        shadowOpacity: 0.2,
        cornerRadius: 10
      });
	  var boolButton = new Kinetic.Rect({
        x: 290,
        y: 175,
        stroke: '#555',
        strokeWidth: 5,
        fill: '#ddd',
        width: 130,
        height: 50,
        shadowColor: 'black',
        shadowBlur: 10,
        shadowOffset: [10, 10],
        shadowOpacity: 0.2,
        cornerRadius: 10
      });
	  var doubleButton = new Kinetic.Rect({
        x: 430,
        y: 175,
        stroke: '#555',
        strokeWidth: 5,
        fill: '#ddd',
        width: 130,
        height: 50,
        shadowColor: 'black',
        shadowBlur: 10,
        shadowOffset: [10, 10],
        shadowOpacity: 0.2,
        cornerRadius: 10
      });
	  
	 intButton.on('click', function() {
        addInt(1);
      });
	 charButton.on('click', function() {
        addChar(2);
      });
	 boolButton.on('click', function() {
        addBool(3);
      });
	 doubleButton.on('click', function() {
        addDouble(4);
      });
	  
      // add the shapes to the layer
      layer.add(simpleText);
      layer.add(rect);
	  layer.add(intButton);
	  layer.add(charButton);
      layer.add(boolButton);
	  layer.add(doubleButton);
	  layer.add(incorrect);
	  layer.add(intText);
	  layer.add(charText);
	  layer.add(boolText);
	  layer.add(doubleText);
	  stage.add(layer);