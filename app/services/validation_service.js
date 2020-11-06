app.service('validation_service', function($http) {

    /**
     * @todo we can velidate pretty much all fields here, but in this case we will only focus on a phone_number
     * @param {object data} is passed, giving us flaxibility to validate any attributes in this object
     * @return true / false
     **/
    this.validate = function(data) {

        let validCheck = false;

        // Checking all required fields
        if (data.name !== undefined && data.email !== undefined && data.phone_number !== undefined) {

            // Validating phone number
            const phone_number = data.phone_number;
            const firstChar = phone_number.charAt(0);

            if (isNaN(phone_number)) {
                validCheck = false;
            } else {
                if (firstChar === '0') {
                    (phone_number.length < 10 || phone_number.length > 10) ? validCheck = false: validCheck = true;
                } else {
                    validCheck = false;
                }
            }

        } else {
            validCheck = false;
        }

        return validCheck;
    }
});