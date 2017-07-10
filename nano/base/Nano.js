function Package(config) {
    return PHP.create('\\App\\Builder\\Element', config);
}
function Resource(config) {
    return PHP.create('\\App\\Builder\\Resource', config);
}
function ListOfValues(source, label, id) {
    return {
		resources: eval('(function (component) {return '+source+'})'),
		label: eval('(function (item) {return '+label+'})'),
		value: eval('(function (item) {return '+id+'})')
	};
}
function PhpCode(config) {
    return PHP.create('\\App\\Builder\\Method', config);
}