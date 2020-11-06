app.filter('mask', function() {
    return function(data) {

        let stripZero = parseInt(data);

        var x = (stripZero.toString()).replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
        data = !x[2] ? x[1] : '' + x[1] + ' ' + x[2] + (x[3] ? ' ' + x[3] : '');

        return '+27 ' + data;
    };
});