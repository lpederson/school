var stage = new Kinetic.Stage({
	container: 'container',
	width: 578,
	height: 160
});
var layer = new Kinetic.Layer();

// since this text is inside of a defined area, we can center it using
// align: 'center'
var varLabel = new Kinetic.Text({
	x: 30,
	y: 0,
	text: 'int myInteger',
	fontSize: 18,
	fontFamily: 'Calibri',
	fill: '#555',
	width: 200,
	padding: 20,
	align: 'center'
});

var varContent = new Kinetic.Text({
	x: 30,
	y: 60,
	text: 'Address: 0x1000\nValue: 20',
	fontSize: 18,
	fontFamily: 'Calibri',
	fill: '#555',
	width: 200,
	padding: 10,
	align: 'center'
});

var varRect = new Kinetic.Rect({
	x: 30,
	y: 60,
	stroke: '#555',
	strokeWidth: 5,
	fill: '#ddd',
	width: 200,
	height: varContent.getHeight(),
	shadowColor: 'black',
	shadowBlur: 10,
	shadowOffset: [10, 10],
	shadowOpacity: 0.2,
	cornerRadius: 10
});


//Pointer
var pointerLabel = new Kinetic.Text({
	x: 330,
	y: 0,
	text: 'int * myPointer',
	fontSize: 18,
	fontFamily: 'Calibri',
	fill: '#555',
	width: 200,
	padding: 20,
	align: 'center'
});

var pointerContent = new Kinetic.Text({
	x: 330,
	y: 60,
	text: 'Address: 0x2000\nValue: 0x1000',
	fontSize: 18,
	fontFamily: 'Calibri',
	fill: '#555',
	width: 200,
	padding: 10,
	align: 'center'
});

var pointerRect = new Kinetic.Rect({
	x: 330,
	y: 60,
	stroke: '#555',
	strokeWidth: 5,
	fill: '#ddd',
	width: 200,
	height: pointerContent.getHeight(),
	shadowColor: 'black',
	shadowBlur: 10,
	shadowOffset: [10, 10],
	shadowOpacity: 0.2,
	cornerRadius: 10
});


// add the shapes to the layer
layer.add(varRect);
layer.add(varContent);
layer.add(varLabel);

layer.add(pointerRect);
layer.add(pointerContent);
layer.add(pointerLabel);

stage.add(layer);
