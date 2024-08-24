import './bootstrap';
import 'flowbite';

function validateNumberInput(input) {
            // Save the original value
            const originalValue = input.value;

            // Remove non-numeric characters
            const cleanedValue = originalValue.replace(/[^0-9]/g, '');

            // If the cleaned value is different from the original, update the input field
            if (cleanedValue !== originalValue) {
                alert('Please enter only numbers.');
                input.value = cleanedValue;
            }
        }

        function validateForm() {
            let valid = true;

            // Validate phone number
            const phoneNumber = document.getElementById('phone_number');
            if (/[^0-9]/.test(phoneNumber.value)) {
                alert('Please enter only numbers for Phone Number.');
                valid = false;
            }

            // Validate NISN
            const nisn = document.getElementById('nisn');
            if (/[^0-9]/.test(nisn.value)) {
                alert('Please enter only numbers for NISN.');
                valid = false;
            }

            return valid;
        }