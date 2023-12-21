
import { React, createRoot } from '../../../reactImports.js';

// Define variable
const label = {
    reset: 'Reset',
};

// Function
export default function ResetCartButton() {

    // Reset All the button
    function resetCheckbox() {

        if (!window.confirm('Are you sure you want to reset?')) {
            return false;
        }

        localStorage.removeItem("selectedIds");

        let checkboxArray = document.querySelectorAll('input[type="checkbox"]');
        checkboxArray.forEach(checkbox => {
            checkbox.checked = false;
        })

        let valueInput = document.querySelector('#selectedCheckbox');
        valueInput.value = '';
    }

    return (
        <button type="button" className="btn btn-danger bg-danger" onClick={resetCheckbox}>{label.reset}</button>
    );
}

// Mount
if(document.querySelector('#reset-cart-button')) {
    const rootElement = document.getElementById('reset-cart-button');
    const root = createRoot(rootElement);
    root.render(<ResetCartButton />);
}

