
import { React, createRoot } from '../../../reactImports.js';

// Define variable

// Function
function SelectAllCheckbox() {

    function changeState(event) {
        let checkbox = event.target;
        const checkboxArray = document.querySelectorAll('input[type="checkbox"]');
        let selectedIds = JSON.parse(localStorage.getItem('selectedIds')) || [];
        checkbox.checked ?
            addToLocalStorage(checkboxArray, selectedIds) :
            removeFromLocalStorage(checkboxArray, selectedIds);
    }

    function addToLocalStorage(checkboxArray, selectedIds) {
        checkboxArray.forEach(checkbox => {
            checkbox.checked = true;
            selectedIds.push(checkbox.getAttribute('data-input'));
            localStorage.setItem('selectedIds', JSON.stringify(selectedIds));
            refresh();
        });
    }
    
    function removeFromLocalStorage(checkboxArray, selectedIds) {
        checkboxArray.forEach(checkbox => {
            checkbox.checked = false;
            selectedIds = selectedIds.filter(id => id !== checkbox.getAttribute('data-input'));
            localStorage.setItem('selectedIds', JSON.stringify(selectedIds));
            refresh();
        });
    }

    function refresh() {
        let valueInput = document.querySelector('#selectedCheckbox');
        valueInput.value = localStorage.getItem('selectedIds');
    }

    return (
        <input className="cursor-pointer border-1 border-solid !border-[#bbbbbb] rounded-sm" type="checkbox" onClick={changeState}/>
    );

}

export default SelectAllCheckbox;

// Mount
const rootElement = document.querySelector('#select-all-checkbox');
const root = createRoot(rootElement);
root.render(<SelectAllCheckbox />);
