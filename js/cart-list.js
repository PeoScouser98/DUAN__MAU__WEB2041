const tempAmount = document.querySelector("#temp-amount");
const totalAmount = document.querySelector("#total-amount");
const totalAmountLabel = totalAmount.parentElement.querySelector("#total-amount-label");
const deliveryOption = document.querySelector("#delivery");
const giftCode = document.querySelector("#gift-code");
const giftCodeMessage = document.querySelector("#gift-code-message");
// tính phí ship
var discount = 0;
// tổng tiền tạm tính (chưa có phí ship)
function calcTempAmount() {
	let totalPrice = document.querySelectorAll(".total-price");
	let sum = 0;
	for (const price of totalPrice) {
		sum += +price.innerText.slice(1, price.innerText.length);
	}
	tempAmount.innerText = `$${sum}`;
	// thay đổi tổng tiền khi thay đổi số lượng sản phẩm
	giftCode.oninput = function () {
		discount = giftCode.value == "xshop" ? 50 : 0;
		giftCodeMessage.innerText = giftCode.value == "xshop" ? "You have applied giftcode!" : "";
		calcTotalAmount();
	};
	// thay đổi tổng tiền khi thay đổi hình thức giao hàng
	deliveryOption.onchange = function () {
		calcTotalAmount();
	};
	calcTotalAmount();
}
// tính tổng tiền 1 sản phẩm
function getTotalPrice(input) {
	const totalPrice = input.parentElement.parentElement.querySelector(".total");
	const price = input.parentElement.parentElement.querySelector(".price");
	let totalLabel = input.parentElement.parentElement.parentElement.querySelector(".total-price");
	totalPrice.value = price.value * input.value;
	totalLabel.innerText = `$${totalPrice.value}`;
	calcTempAmount();
}
// tính tổng tiền phải thanh toán
function calcTotalAmount() {
	totalAmount.value = +tempAmount.innerText.slice(1, tempAmount.innerText.length) + +deliveryOption.value - discount;
	totalAmountLabel.innerText = `$${totalAmount.value}`;
	return totalAmount.value;
}
calcTempAmount();
