var propertys = new Array;
var propertyAdd = {};
function Property(name,column,operation){
	this.name = name;
	this.column= column;
	this.operation = operation;
}
function isPropertyAdd(property){
	if(propertyAdd[property.name]==null || propertyAdd[property.name]==""){
		propertyAdd[property.name]=property;
		return false;
	}else{
		return true;
	}
}