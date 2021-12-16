function bake_cookie(name, value) {
  var cookie = [name, '=', JSON.stringify(value), '; domain=.', window.location.host.toString(), '; path=/;'].join('');
  document.cookie = cookie;
}
function read_cookie(name) {
 var result = document.cookie.match(new RegExp(name + '=([^;]+)'));
 result && (result = JSON.parse(result[1]));
 return result;
}
function delete_cookie(name) {
  document.cookie = [name, '=; expires=Thu, 01-Jan-1970 00:00:01 GMT; path=/; domain=.', window.location.host.toString()].join('');
}
function userConstructor(name, street, city) {
// ... your code
this.dumpData = function() {
 return {
    'userConstructorUser': {
        name: this.name,
        street: this.street,
        city: this.city
     }
   }
}

var mydata = JSON.parse(read_cookie('myinstances'));
new userConstructor(mydata.name, mydata.street, mydata.city);
