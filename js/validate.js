// get name of each field
const getFieldName = (input) => {
	return input.name.charAt(0).toUpperCase() + input.name.slice(1).toLowerCase();
};
// get input element

// show error message
const showError = (input, message) => {
	const errorIcon = /*html */ `<i class="bi bi-x align-center"></i>`;
	const errorMessage = input.parentElement.querySelector(".error-message");
	errorMessage.innerHTML = errorIcon + message;
	errorMessage.style.color = "var(--error)";
	input.style.border = "3px solid var(--error)";
};
// show success if value of the field is valid
const showSuccess = (input, message) => {
	const successMessage = input.parentElement.querySelector(".error-message");
	successMessage.innerHTML = message;
	input.style.border = "3px solid var(--success)";
};

/**
 * các rule thực hiện check các trường input
 */
const isRequired = (inputArray) => {
	inputArray.forEach((input) => {
		input.value.trim() != "" ? showSuccess(input, null) : showError(input, `Please enter ${getFieldName(input)}`);
		input.oninput = () => {
			input.value.trim() != "" ? showSuccess(input, null) : showError(input, `Please enter ${getFieldName(input)}`);
		};
	});
};

const isEmail = (emailInput) => {
	let regexEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
	emailInput.oninput = () => {
		regexEmail.test(emailInput.value) ? showSuccess(emailInput, null) : showError(emailInput, "Email is invalid");
	};
};

const ckMatchingValue = (input1, input2) => {
	input1.oninput = () => {
		input1.value == input2.value ? showSuccess(input1, null) : showError(input1, `${getFieldName(input1)} doesn't match !`);
	};
};

const checkLength = (input, minLength) => {
	input.oninput = () => {
		input.value.length >= minLength ? showSuccess(input, null) : showError(input, `${getFieldName(input)} must have at least ${minLength} character`);
	};
};

const isPhoneNumber = (input) => {
	input.oninput = () => {
		if (input.value == +input.value && input.value.length == 10) showSuccess(input, null);
		else showError(input, `Phone number is invalid`);
		console.log(typeof input.value);
	};
};
