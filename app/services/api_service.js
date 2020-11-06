app.service('httpService', function($http) {

    /**
     * @todo send request to the server.
     * @param ('GET/POST', 'API url', {object data})
     * @return data from server.
     **/
    this.call = function(method, url, data) {

        var promise = {};

        if (method === 'get') {

            $http.get(url).then(function success(e) {
                promise.data = e.data.results.list;
                promise.message = e.data.results.message;
            });

        } else {

            $http.post(url, data).then(function success(e) {
                promise.data = e.data.results.list;
                promise.message = e.data.results.message;
            });
        }

        return promise;
    }
});