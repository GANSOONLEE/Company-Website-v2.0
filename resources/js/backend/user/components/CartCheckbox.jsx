
import { React, createRoot } from '../../../reactImports.js';
// Define variable


// Function
function CartCheckbox({cart}) {

    function changeState(event) {
        let checkbox = event.target;
        let cartId = checkbox.closest('tr').querySelector('td[data-column="id"]').id;
        let selectedIds = JSON.parse(localStorage.getItem('selectedIds')) || [];
        checkbox.checked ?
            addToLocalStorage(cartId, selectedIds) :
            removeFromLocalStorage(cartId, selectedIds);
    }

    function addToLocalStorage(cartId, selectedIds) {
        selectedIds.push(cartId);
        localStorage.setItem('selectedIds', JSON.stringify(selectedIds));
        refresh();
    }

    function removeFromLocalStorage(cartId, selectedIds) {
        selectedIds = selectedIds.filter(id => id !== cartId);
        localStorage.setItem('selectedIds', JSON.stringify(selectedIds));
        refresh();
    }

    function refresh() {
        let valueInput = document.querySelector('#selectedCheckbox');
        valueInput.value = localStorage.getItem('selectedIds');
    }

    return <input data-input={cart.id} className="cursor-pointer border-1 border-solid !border-[#bbbbbb] rounded-sm" type="checkbox" onClick={changeState}></input>;
}

export default CartCheckbox;

const rootElements = document.querySelectorAll('#cart-checkbox');
rootElements.forEach(rootElement => {
    const root = createRoot(rootElement);
    const inputId = (rootElement.querySelector('input')).dataset.input;
    root.render(<CartCheckbox cart={{ id: inputId }} />);
});